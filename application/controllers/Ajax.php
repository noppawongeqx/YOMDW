<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

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
	public function ulsearch()
	{
		$sql = "SELECT underlying FROM otherdw  WHERE dw_Id not like 'S50%' and  last_trading_date >=  DATE(NOW()) GROUP BY underlying order by underlying asc";
		$query = $this->db->query($sql);
		$result = array();
		foreach($query->result_array() as $row){
			$result[] = $row['underlying'];
		}

		header('Content-Type: application/json');
		echo json_encode($result);
	}
	public function otherdwSearch()
	{
		$query = $this->input->get('searchdw');
		$sql = "SELECT dw_Id,brokerno FROM otherdw  WHERE dw_Id not like 'S50%' and  last_trading_date >=  DATE(NOW()) and (dw_Id like '".strtoupper($query)."%' or underlying like '".strtoupper($query)."%')  order by underlying,callputflag asc";
		$query = $this->db->query($sql);
		$result24 = array();
		$result = array();
		foreach($query->result_array() as $row){
			if($row['brokerno']=='24'){
				$result24[] = $row['dw_Id'];
			}else{
				$result[] = $row['dw_Id'];	
			}

		}
		$result = array_merge( $result24,$result); 
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	// public function timeline($dw_Id = '')
	// {
	// 	$result = array();
	// 	$sql = "select *,datediff(now(),last_trading_date), FROM otherdw WHERE dw_Id = '".$dw_Id."'";
	// 	$query = $this->db->query($sql);
	// 	foreach ($query->result_array() as $row) {
	// 		$result[]  =
	// 	}
	// }

	public function impliedvolLine($dw_Id = '')
	{

		$result = array();
		$result['data'] = array();
		
		if(!empty($dw_Id)){
			$sql= 'SELECT * FROM  pricing_history p where stock = "'.$dw_Id.'" order by date asc;';
			$sql2='SELECT MIN(impliedvol) as miniv,MAX(impliedvol) as maxiv,STD(impliedvol) as std,AVG(impliedvol) as avg FROM pricing_history where stock = "'.$dw_Id.'" ; ';
			$query_1 = $this->db->query($sql);
			$query_2 = $this->db->query($sql2);
			foreach ($query_2->result_array() as $row) {
				$result['miniv'] = $row['miniv'];
				$result['maxiv'] = $row['maxiv'];
				$result['std'] = number_format($row['std'],4,'.','');
				$result['avg'] = $row['avg'];
				break;
			}
			foreach ($query_1->result_array() as $row) {
				$result['data'][] = array('x'=>$row['date'],'y'=>number_format(floatval($row['impliedvol']) * 100,2,'.',''));

			}

		}

		header('Content-Type: application/json');
		echo json_encode($result);

	}
	public function moneyflowin()
	{

		$sql= 'select  a.stock as stock,ifnull(a.value,0)-ifnull(b.value,0) as value,a.uptime from moneyflow a left join moneyflow b on a.stock = b.stock and a.side = "S"  and b.side ="B"
		where a.stock like "%24%" and a.side="S"   order by ifnull(a.value,0)-ifnull(b.value,0) desc limit 5;';
		$query_1 = $this->db->query($sql);
		$result = array();
		$min = 9999999;
		$max = 0;
		foreach ($query_1->result_array() as $row) {
			if($row['value'] > 0){
					$result['data'][] = array("dw"=>trim($row['stock']),"value"=>$row['value']/1000000);
					$result['uptime'] =date('d-M-Y H:i:s',strtotime($row['uptime']));
					if($row['value']/1000000> $max)
					{
						$max = $row['value']/1000000;
					}
					if($row['value']/1000000< $min && $row['value']/1000000 > 0)
					{
						$min = $row['value']/1000000;
					}
			}
			
		}
		$sql= 'select  a.stock as stock ,ifnull(a.value,0)-ifnull(b.value,0) as value,a.uptime from moneyflow a left join moneyflow b on a.stock = b.stock and a.side = "B"  and b.side ="S" where a.stock like "%24%" and a.side ="B" order by ifnull(a.value,0)-ifnull(b.value,0) desc limit 5;';
		$query_2 = $this->db->query($sql);
		foreach ($query_2->result_array() as $row) {
				//$result['data'][] = array("dw"=>trim($row['stock']),"value"=>$row['value']/1000000);
				//$result['uptime'] =date('d-M-Y H:m:s',strtotime($row['uptime']));
			
				if($row['value']/1000000> $max)
				{
					$max = $row['value']/1000000;
				}
				if($row['value']/1000000< $min && $row['value']/1000000 > 0)
				{
					$min = $row['value']/1000000;
				}
		}
		$result['max'] = $max;
		$result['min'] = $min;

		header('Content-Type: application/json');
		echo json_encode($result);
	}
	public function moneyflowout()
	{

		$sql= 'select  a.stock as stock ,ifnull(a.value,0)-ifnull(b.value,0) as value,a.uptime from moneyflow a left join moneyflow b on a.stock = b.stock and a.side = "B"  and b.side ="S" where a.stock like "%24%" and a.side ="B" order by ifnull(a.value,0)-ifnull(b.value,0) desc limit 5;';
		$query_1 = $this->db->query($sql);
		$min = 9999999;
		$max = 0;
		$result = array();
		foreach ($query_1->result_array() as $row) {
				if($row['value'] > 0){
					$result['data'][] = array("dw"=>trim($row['stock']),"value"=>$row['value']/1000000);
					$result['uptime'] =date('d-M-Y H:i:s',strtotime($row['uptime']));
					if($row['value']/1000000> $max)
					{
						$max = $row['value']/1000000;
					}
					if($row['value']/1000000< $min  && $row['value']/1000000 > 0)
					{
						$min = $row['value']/1000000;
					}
				}

		}

		$sql= 'select  a.stock as stock,ifnull(a.value,0)-ifnull(b.value,0) as value,a.uptime from moneyflow a left join moneyflow b on a.stock = b.stock and a.side = "S"  and b.side ="B"
		where a.stock like "%24%" and a.side="S"  order by ifnull(a.value,0)-ifnull(b.value,0) desc limit 5;';
		$query_2 = $this->db->query($sql);
		foreach ($query_2->result_array() as $row) {
				//$result['data'][] = array("dw"=>trim($row['stock']),"value"=>$row['value']/1000000);
				//$result['uptime'] =date('d-M-Y H:m:s',strtotime($row['uptime']));
			
				if($row['value']/1000000> $max)
				{
					$max = $row['value']/1000000;
				}
				if($row['value']/1000000< $min  && $row['value']/1000000 > 0)
				{
					$min = $row['value']/1000000;
				}
		}
		
		$result['max'] = $max;
		$result['min'] = $min;
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	public function topoutstanding()
	{
		$sql = 'select  *,no_of_issue - volume as value from outstanding inner join no_of_issue on no_of_issue.DW_dw_Id = outstanding.secsymbol inner join dw dw on dw.dw_Id = no_of_issue.DW_dw_Id where dw.last_trading_date >=  DATE(NOW())  order by no_of_issue - volume  desc limit 5';
		$query_1 = $this->db->query($sql);
		foreach ($query_1->result_array() as $row) {
			if($row['value']/1000000 < 14.0){

				$result['data'][] = array("value"=>round($row['value']/1000000,2),"dw"=>trim($row['DW_dw_Id']));

			}else{
				$result['data'][] = array("value"=>18.5,"dw"=>trim($row['DW_dw_Id']));
				$result['more'][trim($row['DW_dw_Id'])] = $row['value']/1000000;
			}

				$result['uptime'] =date('d-M-Y H:i:s',strtotime($row['uptime']));
			
		}

		header('Content-Type: application/json');
		echo json_encode($result);
	}
	public function pricecal($shortname = ''){
		$sql = "SELECT * from dw d  inner join strike s on s.DW_dw_Id = d.dw_Id  WHERE dw_Id = '".$shortname."' order by s.effective_date desc";
		$query = $this->db->query($sql);
		$obj = array();   
		$arrayRes = array(); 
		$requestPrice = array(); 
		$url= 'stockPrice3/';
		$shiftPrice = $this->input->post('shiftPrice');
		$shiftDate = $this->input->post('shiftDate');
		$stock_param = array();

		foreach($query->result_array() as $row){

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
		$data_date = '';
		foreach ($queryPrice->result_array() as $row) {
			$resultPrice[$row['stock']] = $row['bid'];
			$data_date =date('j-M-Y g:i A',strtotime($row['create_date']));
		}
		foreach($query->result_array() as $row){ 
			$resultObj = array();
			$resultObj['dw'] = $row['dw_Id'];
			if(isset($resultPrice[$row['underlying']])){
				$spotBid =floatval($resultPrice[$row['underlying']]);
				if(!empty($shiftPrice)){
					$spotBid = $this->utils->getSharePrice($spotBid,$shiftPrice);
				}
				$strike = $row['strike'];
				$conversion = $row['conversion'];
				$last_trading_date = $row['last_trading_date'];
				$current_date = date('Y-m-d');
				$rf = $row['rf'];
				$implyVol = $row['imply_volatillity'];
				$response = array();
				$response[number_format($spotBid,2)]=array();

				$display_date = $this->getdatefrombase($shiftDate);
				for($j =0 ; $j < sizeof($display_date); $j++ ){
					if($this->utils->dateDiff($display_date[$j] , $last_trading_date) > 0){
						$response[number_format($spotBid,2)][]=('N/A');	
					}else{

						$show_date = $display_date[$j];	
						$ttm = $this->utils->dateDiff( $last_trading_date,$show_date);	

						$show_code_date = strtotime($show_date);
						$hard_code_date = strtotime('2017-04-29');
						if($row['dw_Id'] == 'DELT24C1704A'||$row['dw_Id'] == 'IVL24C1704A'){
							if($show_code_date <= $hard_code_date)
							{
								$ttm = $this->utils->dateDiff('2017-04-29',$show_date);	
							}
						}


						$theoprice =$this->utils->VanillaPrice($spotBid,$strike,$rf/100.00,$implyVol/100.00,$ttm/365.00,$row['type'])/$conversion;
								//+,-5 spread price 
						if($theoprice > 2 ){
							$response[number_format($spotBid,2)][]=number_format($this->utils->getSharePrice($theoprice ,0),2);
						}else{ 
							$response[number_format($spotBid,2)][]=number_format(floatval(round($theoprice * 100) / 100),2); 
						}
					}
				} 
				for($i = 1 ; $i<= 7 ; $i++ ){  
					$uptickPrice = $this->utils->getSharePrice($spotBid,$i);
					$downtickPrice = $this->utils->getSharePrice($spotBid,(-1)*$i); 
					$response[number_format($uptickPrice,2)] = array();
					$response[number_format($downtickPrice,2)] = array();   

					for($j =0 ; $j < sizeof($display_date); $j++ ){  	   
						if($this->utils->dateDiff($display_date[$j] , $last_trading_date) > 0){
							$response[number_format($uptickPrice,2)][]='N/A';	
							$response[number_format($downtickPrice,2)][]= 'N/A';	
						}else{

							$show_date = $display_date[$j]; 
							$ttm = $this->utils->dateDiff( $last_trading_date,$show_date);	
							
							$show_code_date = strtotime($show_date);
							$hard_code_date = strtotime('2017-04-29');
							if($row['dw_Id'] == 'DELT24C1704A'||$row['dw_Id'] == 'IVL24C1704A'){
								if($show_code_date <= $hard_code_date)
								{
									$ttm = $this->utils->dateDiff('2017-04-29',$show_date);	
								}
							}

							$upTprice =$this->utils->VanillaPrice($uptickPrice,$strike,$rf/100.00,$implyVol/100.00,$ttm/365.00,$row['type'])/$conversion;
							$downTprice =$this->utils->VanillaPrice($downtickPrice,$strike,$rf/100.00,$implyVol/100.00,$ttm/365.00,$row['type'])/$conversion;

							if($downTprice > 2 ){
								$response[number_format($downtickPrice,2)][]=number_format($this->utils->getSharePrice($downTprice ,0),2);
							}else{
								$response[number_format($downtickPrice,2)][]=number_format(floatval(round($downTprice * 100) / 100),2); 
							}
							if($upTprice > 2 ){
								$response[number_format($uptickPrice,2)][]=number_format($this->utils->getSharePrice($upTprice ,0),2);
							}else{
								$response[number_format($uptickPrice,2)][]=number_format(floatval(round($upTprice * 100) / 100),2); 
							}			
						}  
					}
				}

				$content = array();
				krsort($response);
				$content['table'] =$response;
				$content['timeOfEvent'] =  $data_date;
				$content['currentBid'] =floatval($resultPrice[$row['underlying']]);
				$datelist = $display_date;
				$content['datelist'] = $datelist;
				$content['dw'] = $resultObj['dw'];
				header('Content-Type: application/json');
				echo json_encode($content);
					//$this->template->load('template', 'product/pricecal',$content);
			}
		}
	}


    public function feature($shortname = ''){
	$sql = "SELECT * from dw d  inner join strike s on s.DW_dw_Id = d.dw_Id  WHERE dw_Id = '".$shortname."' order by s.effective_date desc";
	$query = $this->db->query($sql);
	$obj = array();   
	$arrayRes = array(); 
	$requestPrice = array(); 
	$url= 'stockPrice3/';
	$stock_param = array();

	foreach($query->result_array() as $row){

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
	foreach ($queryPrice->result_array() as $row) {
		$resultPrice[$row['stock']] = $row['bid'];
	}

	foreach($query->result_array() as $row){
		$resultObj = array();
		$resultObj['dw'] = $row['dw_Id'];
		$spotBid = ''; 
		if(isset($resultPrice[$row['underlying']]))
		{
			$spotBid =floatval($resultPrice[$row['underlying']]);
					 //.0spotBid = 164
			   		  //	 console.log(spotBid);
			$underlying = $row['underlying'];	 
			$dw = $row['dw_Id'];
			$strike = $row['strike'];
			$conversion = $row['conversion']; 
			$exp_date = $row['expire_date'];
			$last_trading_date = $row['last_trading_date'];
			$current_date = date('Y-m-d');
			$rf = $row['rf'];
			$implyVol = $row['imply_volatillity'];
			$type = $row['type'];

			$response = array();
			$response['spotBid']=array(); 


			$display_date = $this->getdatefrombase();
			$show_date = $display_date[0]; 
			$ttm = $this->utils->dateDiff($last_trading_date,$show_date);			   	
			$delta =$this->utils->VanillaDelta($spotBid,$strike,$rf/100.00,$implyVol/100.00,$ttm/365.00,$row['type']); 

			$theoprice =$this->utils->VanillaPrice($spotBid,$strike,$rf/100.00,$implyVol/100.00,$ttm/365.00,$row['type'])/$conversion;
			$theta = $this->utils->VanillaTheta($spotBid,$strike,$rf/100.00,$implyVol/100.00,$ttm/365.00,$row['type'])/$conversion;
					//+,-5 spread price 
			$response = array();  
			$response["dw"] = $dw;
			$response["spot"] = $spotBid; 
			$response["underlying"] = $underlying;
			$response["type"] = 'Call';
			$response["strike"] = $strike;
			$response["last_trading_date"] = date('d-M-Y',strtotime($last_trading_date));
			$response["exp_date"] =date('d-M-Y',strtotime($exp_date));
			$response["conversion"] = $conversion;
			$response["implyVol"] = sprintf("%.2f%%",$implyVol);
			$response["delta"]=sprintf("%.2f%%",$delta);
			$theo = 0;
			if($theoprice > 2 ){
				$theo = $this->utils->getSharePrice($theoprice,0);
			}else{
				$theo =number_format(floatval(round($theoprice * 100) / 100),2);
			}

			$gearing = (($delta * $spotBid)/$conversion)/$theo;
			if(is_nan($gearing)|| is_infinite($gearing)){
				$response["gearing"] = 'N/A';	
			}else{
				$response["gearing"]= number_format($gearing,2);

			}
			$timedecay = ($theta/365)/$theo *100;
			if(is_nan($timedecay) || is_infinite($timedecay)){
				$response["timedecay"]='N/A';
			}else{
				$response["timedecay"]=sprintf("%.2f%%",$timedecay);
			}
			$response["sens"]=  $this->utils->sensitivity($delta,$this->utils->getSpreadPrice($spotBid),$conversion,$this->utils->getSpreadPrice($this->utils->getSharePrice($theoprice,0)));
			$response["intrinsic"]=(($spotBid - $strike)>0)?number_format((($spotBid-$strike)/$conversion),2):0.00;
					//console.log("moneyness");
					//console.log((spotBid/strike));
					//response["moneyness"]=(((spotBid/strike) -1)*100).toFixed(2) + "%   " + (((spotBid/strike) -1 > 0)?"ITM":"OTM");
			if(($spotBid/$strike) -1  > 0){
				$response["moneyness"]=number_format(((($spotBid/$strike) -1)*100),2) ."% ITM";

			}else if(($spotBid/$strike) -1  == 0){
				$response["moneyness"]=number_format(((($spotBid/$strike) -1)*100),2) . "% ATM";

			}else{
				$response["moneyness"]=number_format(((($spotBid/$strike) -1)*100),2) . "% OTM";

			}
			$response["ttm"]=$ttm;		


			header('Content-Type: application/json');
			echo json_encode($response);
			break;

		}
	}
}

function listdw(){
	$sql ='select * from dw as d left join strike as s on d.dw_Id = s.DW_dw_Id and s.effective_date = (select str.effective_date from strike str where str.DW_dw_Id = d.dw_Id order by effective_date desc limit 1) where d.last_trading_date >= (NOW())';
	$query = $this->db->query($sql);
	$obj = array();
	$arrayRes =array();
	$requestPrice = array();
	$url= 'stockPrice3/';
	$stock_param = array();

	foreach($query->result_array() as $row){

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
	foreach ($queryPrice->result_array() as $row) {
		$resultPrice[$row['stock']] = $row['bid'];
	}

	foreach ($query->result_array() as $row){
		$resultObj = array(); 
		$resultObj['predw'] = substr($row['dw_Id'],0,strlen($row['dw_Id'])-8);
		$resultObj['postdw'] =  substr($row['dw_Id'],strlen($row['dw_Id'])-8,8);
		$resultObj['dw'] = $row['dw_Id'];
		$spotBid = '' ;
		if(isset($resultPrice[$row["underlying"]])){
			$spotBid =floatval($resultPrice[$row['underlying']]);
			$underlying = $row['underlying'];	 
			$dw = $row['dw_Id'];
			$strike = $row['strike'];
			$conversion = $row['conversion'];
			$exp_date = date('d-M-Y',strtotime($row['expire_date']));
			$last_trading_date =  date('d-M-Y',strtotime($row['expire_date']));
			$current_date = date('d-M-Y');
			$rf = $row['rf']; 
			$implyVol = $row['imply_volatillity'];
			$type = $row['type'];

			$sql3 = "SELECT * FROM display_date WHERE required = 'Y'";
			$display_date = $this->getdatefrombase();
			$show_date = $display_date[0]; 
			$ttm = $diff = $this->utils->dateDiff($row['last_trading_date'],$show_date);			   	
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
			$gearing = null;
			$timedecay = null;
			$sensitivity = null;
			if($theo > 0){
				$gearing = (($delta * $spotBid)/$conversion)/$theo;
			}
			if(is_nan($gearing)|| !is_finite($gearing)){ 
				$resultObj["gearing"] = 'N/A';	
			}else{ 
				$resultObj["gearing"]= number_format($gearing,2);

			}
			if($theo > 0){
				$timedecay = ($theta/365)/$theo *100;
			}
			if(is_nan($timedecay) || !is_finite($timedecay)|| $timedecay == null){
				$resultObj["timedecay"]='N/A';
			}else{
				$resultObj["timedecay"]=sprintf("%.2f%%",$timedecay);
			}
			$resultObj['ul'] = $underlying;
			if($theoprice > 0){
				$sensitivity = $this->utils->sensitivity($delta,$this->utils->getSpreadPrice($spotBid),$conversion,$this->utils->getSpreadPrice($this->utils->getSharePrice($theoprice)));
			}	
			if(is_nan($sensitivity) || !is_finite($sensitivity) || $sensitivity == null){
				$resultObj["sens"]="N/A";
			}else{
				$resultObj["sens"]=$sensitivity;
				}   		  //resultObj["timedecay"]=((theta/365)/theo *100).toFixed(2)+"%";
				$resultObj["exp_date"] =$last_trading_date;
				$resultObj["implyVol"] =sprintf("%.2f%%",$implyVol);
				$arrayRes[] = $resultObj;
			}
			$obj["res"] = $arrayRes;


		}


		header('Content-Type: application/json');
		echo json_encode($obj);
	}
	public function getdatefrombase($shift = 0)
	{
		$sql = "select *  from display_date";
		$query = $this->db->query($sql);
		$i = 0;
		$display_date= array();	
		$result = [];	
		$revDate = date('Y-m-d');

		if($shift>0){

			//$shiftstr = "+".$shift;
			while($shift > 0){
				$revDate = date('Y-m-d',strtotime($revDate." +1 days"));
				$startholidays = true;
				while($startholidays){
					foreach($query->result_array() as $row){
						if($this->utils->dateDiff($revDate,$row['display_date']) == 0  || date('w',strtotime($revDate)) == 0 ||  date('w',strtotime($revDate)) == 6){
							$revDate = date('Y-m-d',strtotime($revDate." +1 days"));
							continue;
						}else{
							$startholidays = false;
							break;
						}
					}
				}
				$shift--;
			}
			
			
		}else if($shift < 0){
			//$shiftstr = "-".$shift;
			while($shift < 0){
				$revDate = date('Y-m-d',strtotime($revDate." -1 days"));
				$startholidays = true;
				while($startholidays){
					foreach($query->result_array() as $row){

						if($this->utils->dateDiff($revDate,$row['display_date']) == 0 || date('w',strtotime($revDate)) == 0 ||  date('w',strtotime($revDate)) == 6){
							$revDate = date('Y-m-d',strtotime($revDate." -1 days"));
							continue;
						}else{
							$startholidays = false;
							break;
						}
					}

				}
				$shift++;
			}
		}
		while(sizeof($display_date) < 5){
			$nextDate = date('Y-m-d', strtotime($revDate." +".($i)." days"));;
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

	public function  getdate(){
		echo json_encode($this->getdatefrombase());
	}


}
