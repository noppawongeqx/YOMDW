<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{

		$content = array();
		$sql = "select * from slideshow order by position";
		$sql_underlying = "SELECT underlying FROM otherdw  WHERE dw_Id not like 'S50%' and  last_trading_date >  NOW() GROUP BY underlying order by underlying asc";
		$sql_dw = "SELECT dw_Id FROM otherdw  WHERE dw_Id like '%24%' and  last_trading_date >=  DATE(NOW()) ORDER BY dw_Id asc";
		
		$sql_news = "select * from news order by create_date desc";
		$query_slide = $this->db->query($sql);
		$query_news = $this->db->query($sql_news);
		$query_ul = $this->db->query($sql_underlying);
		$query_dw = $this->db->query($sql_dw);
		$sqlother = array("SELECT    * ",
				"FROM      dw24.otherdw oth",
			"WHERE oth.dw_Id NOT LIKE 'S50%' and oth.last_trading_date >=  DATE(NOW()) " );

		$sql = implode('  ',$sqlother);
		$sql2 = "SELECT * FROM display_date WHERE required = 'Y' ;";
		$sql3 = "SELECT * FROM timedecay_setup;";
		//echo $sql;
		$query = $this->db->query($sql);
		$query2 = $this->db->query($sql2);
		$query3 = $this->db->query($sql3);
		$stock_param = array();

		foreach($query->result_array() as $row){
		 		 $requestPrice[]= array('ul'=>$row['underlying'],'dw'=>$row['dw_Id']);	

		 		 if(!in_array("'".$row['underlying']."'",$stock_param)){

					 $stock_param[] ="'".$row['underlying']."'";
		 		 }
				if(!in_array("'".$row['dw_Id']."'",$stock_param)){
				 	$stock_param[] ="'".$row['dw_Id']."'";   	 		
				 } 
		}
		$sqltime="SELECT min(create_date) as uptime FROM dw24.marketdata where create_date >= DATE_SUB(NOW(), INTERVAL 15 MINUTE) union SELECT max(create_date) as uptime FROM dw24.marketdata;";
		$time_query = $this->db->query($sqltime);
		$intime = false;
		if(!empty($time_query->result_array()[0]['uptime']))$intime=true;

		$sqlPrice ='select * from marketdata where stock in ('.implode(',',$stock_param).') and create_date = (select max(create_date) from marketdata)';
		
		if($intime)
		{
			$sqlPrice ='select * from marketdata where stock in ('.implode(',',$stock_param).') and create_date = "'.($time_query->result_array()[0]['uptime']).'"';
			
		}

		$queryPrice = $this->db->query($sqlPrice);
	
		$resultPrice = array();
		$bidOffer = array();
		$timedecay_setups = array();
		foreach ($queryPrice->result_array() as $row) {
			$resultPrice[$row['stock']] = $row['bid'];
			$bidOffer[$row['stock']] = $row['bidvol'] + $row['offervol'];
		}
		foreach($query2->result_array() as $row){
		  		  $holidays[] = $row['display_date'];	
				    	 		 
		}
		foreach($query3->result_array() as $row){
		 		  $timedecay_setups[]= $row['broker_id'];					    	 		 
		}

		$gearingMkt  = $this->findAvgIVandGearing($resultPrice,$query,$timedecay_setups,$holidays);
		$bidOfferMkt = $this->findAvgBidOffer($bidOffer,$query);

		$content['feature'] = $gearingMkt;
		$content['AVGBidOffer'] = $bidOfferMkt;
		$content['slideshows'] = $query_slide;
		$content['newslist'] = $query_news;
		$content['underlying'] = $query_ul;
		$content['dw'] = $query_dw;
		$result = $this->listdw();
		$content['listgear'] = array_slice($result['gearing'], 0, 5);
		$content['listpick'] = $result['toppick'];  
		$content['listall'] = $result['gearing'];
		$this->template->load('template', 'home',$content);
	}
	public function findAvgBidOffer($markets,$query){

		$resultObj  = array();
		$result24 = array();
		
		foreach($query->result_array() as $row){


			if($row['brokerno'] == "24"){
					if(isset($markets[$row['dw_Id']])){
					$result24[] = $markets[$row['dw_Id']];
				}
			}
			if(isset($markets[$row['dw_Id']])){

				$resultObj[] = $markets[$row['dw_Id']];
			}

		}

			$avgBidOffer24= array_sum($result24)/sizeof($result24);
			$avgBidOfferMkt= array_sum($resultObj)/sizeof($resultObj);
			return array('bidoffer24'=>$avgBidOffer24,'bidofferMkt'=>$avgBidOfferMkt);
	}
	public function findAvgIVandGearing($markets,$query,$timedecay_setups,$holidays){

		$resultObj  = array();
		$result24 = array();
		$resultObjIV = array();
		$result24IV =array();
		$resultT24 = array();
		$resultTMkt = array();
 		
		$this->load->library('bs');												
		foreach($query->result_array() as $row){
			$spotUnderlying =floatval ($markets[$row['underlying']]);
			$spotDw = 0.0;
			if(isset($markets[$row['dw_Id']])){

				$spotDw =floatval ($markets[$row['dw_Id']]);
			}
			
			$impliedvol = 0.0;
			$ttm = 0.0;  
			$workdayYear = 0.0;
			$now =date('Y-m-d');

			if(!empty($timedecay_setups) && array_search($row['brokerno'],$timedecay_setups)){
				$workdayYear = $this->utils->getWorkingDays($row['trading_date'],$row['last_trading_date'],$holidays);
				$diff = $this->utils->getWorkingDays($now,$row['last_trading_date'],$holidays);
				$ttm = ($diff)/($workdayYear);
			}else{

				$diff = $this->utils->dateDiff($row['last_trading_date'],$now);
				$workdayYear = 365;
				$ttm = ($diff)/($workdayYear);
			}
			if($ttm == 0)
			{
				$ttm = 1/365;
			}
			if($row['callputflag'] == 'C'){ 
				$impliedvol = $this->bs->BSImplied_0($spotUnderlying,$row['exercise_price'],0.03,$spotDw * $row['conversion'],$ttm,false);
			}else{
				$impliedvol = $this->bs->BSImplied_0($spotUnderlying,$row['exercise_price'],0.03,$spotDw * $row['conversion'],$ttm,true);
			}	
			$delta =null;
			$theoprice=null;
			$gearing = null;
			$time = null;
			$sensitivity = null;
			if(floatval($impliedvol['value']) > 0){
				$delta =$this->utils->VanillaDelta($spotUnderlying,$row['exercise_price'],0.03,$impliedvol['value'],$ttm,strtolower($row['callputflag']));
			}
			//console.log(delta);
			if($impliedvol['value'] > 0){
				$theoprice =$this->utils->VanillaPrice($spotUnderlying,$row['exercise_price'],0.03,$impliedvol['value'],$ttm,strtolower($row['callputflag']))/$row['conversion'];
			}			if($impliedvol['value'] > 0){
				$theta = $this->utils->VanillaTheta($spotUnderlying,$row['exercise_price'],0.03,$impliedvol['value'],$ttm,strtolower($row['callputflag']));
			}	
			if($theoprice > 0 && $this->utils->getSharePrice($theoprice,0) > 0 ){
					$gearing = $this->utils->gearing($delta,$spotUnderlying,$row['conversion'],$this->utils->getSharePrice($theoprice,0));
					if($row['callputflag'] == 'P')
					{
						$gearing = abs($gearing);	
					}
				
				$sensitivity = $this->utils->sensitivity($delta,$this->utils->getSpreadPrice($spotUnderlying),$row['conversion'],$this->utils->getSpreadPrice($spotDw));
			
			}

			if(!empty($theta)){
				$time = $this->utils->timevalue($theta,$row['conversion'],$workdayYear);
			}
			
		
			if($row['brokerno'] == "24"){
				$result24[] = $gearing;
				$result24IV[] =floatval($impliedvol['value']);
				$resultT24[] = $time;
			}
			$resultObj[] = $gearing;  
			$resultObjIV[] = floatval($impliedvol['value']);
			$resultTMkt[] = $time;
		}

			$avgGearing24= array_sum($result24)/sizeof($result24);
			$avgGearingMkt= array_sum($resultObj)/sizeof($resultObj);
			$avgIV24 =  array_sum($result24IV)/sizeof($result24IV);
			$avgIVMkt =  array_sum($resultObjIV)/sizeof($resultObjIV);
			$avgTime24 = array_sum($resultT24)/sizeof($resultT24);
			$avgTimeMkt = array_sum($resultTMkt)/sizeof($resultTMkt);

			return array('gearing24'=>$avgGearing24,'gearingMkt'=>$avgGearingMkt,'iv24'=>$avgIV24,'ivMkt'=>$avgIVMkt,'time24'=>$avgTime24,'timeMkt'=>$avgTimeMkt);
	}
	public function news_view($id = "")
	{

		$content = array();
		$this->load->model('news_model');
		if(!empty($id)){
			$news = $this->news_model->get($id);
			if(isset($news))
			{
				$content = array_merge($content,$news);
			}
			$this->template->load('template','news/view',$content);
		}else{
			show_404();
		}

	}

	public function listdw(){
		$sql ='select * from dw as d left join strike as s on d.dw_Id = s.DW_dw_Id and s.effective_date = (select str.effective_date from strike str where str.DW_dw_Id = d.dw_Id order by effective_date desc limit 1) where last_trading_date >= DATE(NOW())';
		$sql_pick = $this->db->query("SELECT dw_Id FROM toppick");
		$query = $this->db->query($sql);
		$obj = array();
		$arrayRes =array();
		$arrayPick = array();
		$toppick = array();
		foreach ($sql_pick->result_array() as $row) {
			$toppick[] = $row['dw_Id'];
		}
		$requestPrice = array();
		foreach ($query->result_array() as $row) {
			
		 		 if(!in_array("'".$row['underlying']."'",$requestPrice)){

					 $requestPrice[] ="'".$row['underlying']."'";
		 		 }
				if(!in_array("'".$row['dw_Id']."'",$requestPrice)){
				 	$requestPrice[] ="'".$row['dw_Id']."'";   	 		
				 } 
		}
		$sqlPrice ='select * from marketdata where stock in ('.implode(',',$requestPrice).') and create_date = (select max(create_date) from marketdata)';

		$queryPrice = $this->db->query($sqlPrice);
		$resultPrice = array();
		foreach ($queryPrice->result_array() as $row) {
			$resultPrice[$row['stock']] = $row['bid'];
		}


		foreach ($query->result_array() as $row){
			$resultObj = array(); 
			$resultObj['dw'] = $row['dw_Id'];
			$spotBid = '' ;
			if(isset($resultPrice[$row["underlying"]])){
				$spotBid =floatval($resultPrice[$row['underlying']]);

				$underlying = $row['underlying'];	 
				$dw = $row['dw_Id'];
				$strike = $row['strike'];
				$conversion = $row['conversion'];
				$exp_date = date('d-M-Y',strtotime($row['last_trading_date']));
				$last_trading_date =  date('d-M-Y',strtotime($row['last_trading_date']));
				$resultObj['exp_date'] = $last_trading_date;
				$current_date = date('d-M-Y');
				$rf = $row['rf']; 
				$implyVol = $row['imply_volatillity'];
				$type = $row['type'];

				$sql3 = "SELECT * FROM display_date WHERE required = 'Y'";
				$display_date = $this->getdatefrombase();
				$show_date = $display_date[0]; 
				$ttm = $diff = $this->utils->dateDiff($row['last_trading_date'],$show_date);	
				if($diff ==0){
					$ttm =1;
				}	
				$delta =$this->utils->VanillaDelta($spotBid,$strike,$rf/100.00,$implyVol/100.00,$ttm/365.00,$row['type']);
			
				$theoprice =$this->utils->VanillaPrice($spotBid,$strike,$rf/100.00,$implyVol/100.00,$ttm/365.00,$row['type'])/$conversion;
				if($ttm/365 != 0){
	   			
					$theta = $this->utils->VanillaTheta($spotBid,$strike,$rf/100.00,$implyVol/100.00,$ttm/365.00,$row['type'])/$conversion;
				}
				$theo = 0;  
				if($theoprice > 2 ){ 
					$theo =number_format($this->utils->getSharePrice($theoprice ,0),2);
				}else{ 
					$theo = number_format(floatval(round($theoprice * 100) / 100),2); ;
				}

				$sensitivity = $this->utils->sensitivity($delta,$this->utils->getSpreadPrice($spotBid),$row['conversion'],$this->utils->getSpreadPrice($theo));
				
				$gearing = null;
				$timedecay = null;
				if($theo > 0){
					$gearing = (($delta * $spotBid)/$conversion)/$theo;
				}
				if(is_nan($gearing)|| !is_finite($gearing)){ 
					$resultObj["gearing"] = 'N/A';	
				}else{ 
					$resultObj["gearing"]= number_format($gearing,2);

				}
				$resultObj["implyVol"] =sprintf("%.2f%%",$implyVol);
				$resultObj['underlying'] = $row['underlying'];
				$resultObj['strike'] = $row['strike'];
				$resultObj['type'] = ($type=='c')?"Call":"Put";
				$resultObj['sensitivity'] = $sensitivity;
				$arrayRes[] = $resultObj;
				if(in_array($row['dw_Id'],$toppick))
				{
					$arrayPick[] = $resultObj;
				}
			}
			$gearings = array();
			foreach ($arrayRes as $key => $row)
			{
			    $gearings[$key] = $row['gearing'];
			}



		}

			array_multisort($gearings, SORT_DESC, $arrayRes);
			$obj["gearing"] = $arrayRes;
			$obj['toppick'] = $arrayPick;
		return $obj;
	}
	public function outstanding()
	{
		$content = array();
		$sql = 'select  *,no_of_issue - volume as value from outstanding inner join no_of_issue on no_of_issue.DW_dw_Id = outstanding.secsymbol 
		inner join dw dw on dw.dw_Id = no_of_issue.DW_dw_Id where dw.last_trading_date >= NOW() order by no_of_issue - volume  desc';
		$query_1 = $this->db->query($sql);
		$content['outstanding'] = $query_1;
		$this->template->load('template', 'outstanding',$content);

	}
	public function getdatefrombase()
	{
		$sql = "select *  from display_date";
		$query = $this->db->query($sql);
		$i = 0;
		$display_date= array();	
		$result = [];	
		while(sizeof($display_date) < 7){
			$revDate = date('Y-m-d');
			$nextDate = date('Y-m-d', strtotime("+".($i)." days"));;
			$isWorkday = false; 
					//console.log('nextDate');					
					//console.log(nextDate.format('YYYY-MM-DD'));
			if( date('w',strtotime($nextDate)) != 0 &&  date('w',strtotime($nextDate)) != 6){
				$isWorkday = true;
			}else{ 
				$isWorkday = false; 
			}

			foreach($query->result_array() as $row){
				if($this->utils->dateDiff($nextDate,$row['display_date']) == 0){
							//console.log('holidays');
					$isWorkday = false;
					break;
				}
			}
			if($isWorkday){
				$display_date[] = date('d-M-Y',strtotime($nextDate));
			}
			$i++;
		}


			for( $i = 0 ; $i < sizeof($display_date); $i++ ){

				$result[] =date('d-M-Y',strtotime($display_date[$i]));
				
			}

			return $result;
	}
	public function moneyflow()
	{
		$content = array();
		$sql= 'select  a.stock as stock,ifnull(a.value,0)-ifnull(b.value,0) as value from moneyflow a left join moneyflow b on a.stock = b.stock and a.side = "S"  and b.side ="B"
		where a.stock like "%24%"  and a.side ="S" and (ifnull(a.value,0)-ifnull(b.value,0))  > 0  order by abs(ifnull(a.value,0)-ifnull(b.value,0)) desc;';
		$query_1 = $this->db->query($sql);
		$content['table_flowin'] = $query_1;
		

		$sql= 'select  a.stock as stock,ifnull(a.value,0)-ifnull(b.value,0) as value from moneyflow a left join moneyflow b on a.stock = b.stock and a.side = "B"  and b.side ="S"
		where a.stock like "%24%"  and a.side ="B" and (ifnull(a.value,0)-ifnull(b.value,0))  > 0 order by abs(ifnull(a.value,0)-ifnull(b.value,0)) desc;';
		$query_2= $this->db->query($sql);
		$content['table_flowout'] = $query_2;

		$this->template->load('template', 'moneyflow',$content);
	}
	public function logchat()
	{
			$message_log = $this->db->query("select *,DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%e %b %Y %h:%i:%s') AS date_formatted from message_log message_log inner join users on message_log.from_id = users.id order by timestamp  asc");
			$messages = array();
			foreach ($message_log->result_array() as $row) {
				$messages[] = $row;
			}
			 header('Content-Type: application/json');
   			 echo json_encode( $messages );
		
	}

}
