<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/HttpRequest.php';
class Product extends CI_Controller {

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

	public function detail($dw_Id='')
	{

		if(empty($dw_Id)){
			 show_404();
		}

		$query =array("SELECT    * ",
				"FROM      dw24.otherdw oth",
				"WHERE dw_Id = '".strtoupper($dw_Id)."' and oth.last_trading_date >=  date(NOW()); ",
		);

		$sql24_arr =array("SELECT    * ",
				"FROM      dw24.dw oth left join strike s on oth.dw_Id = s.DW_dw_Id ",
				"WHERE dw_Id = '".strtoupper($dw_Id)."' and oth.last_trading_date >=  date(NOW()); ",
		);

		$sql  = implode(' ',$query);
		$sql24 = implode(' ',$sql24_arr);
		$sql2 = "SELECT * FROM timedecay_setup";
		$sql3 = "SELECT * FROM display_date WHERE required = 'Y'";
		$query = $this->db->query($sql);
		$query2= $this->db->query($sql2);
		$query3= $this->db->query($sql3);
		$query24 = $this->db->query($sql24);
		$result = $query->result_array();
		$result24 = $query24->result_array(); 
		if(isset($result) || isset($result24)){
			if(sizeof($result) <= 0 ){
				$query = $query24;
			}

			$row = $query->result_array()[0];
			$timedecay_setups = array();
			$holidays = array();
			$resultObj = array();
			foreach($query3->result_array() as $row){
		  		$holidays[] = $row['display_date'];	
				    	 		 
			}
			foreach($query2->result_array() as $row){
			    $timedecay_setups[]= $row['broker_id'];					    	 		 
			}
			$requestPrice[] = "'".$query->result_array()[0]['underlying']. "'";
			$requestPrice[] =  "'".$query->result_array()[0]['dw_Id']. "'";
			$sqltime="SELECT min(create_date) as uptime FROM dw24.marketdata where create_date >= DATE_SUB(NOW(), INTERVAL 15 MINUTE) union SELECT max(create_date) as uptime FROM dw24.marketdata;";
			$time_query = $this->db->query($sqltime);
			$intime = false;
			if(!empty($time_query->result_array()[0]['uptime']))$intime=true;

				$sqlPrice ='select * from marketdata where stock in ('.implode(',',$requestPrice).') and create_date = (select max(create_date) from marketdata)';
			
			if($intime)
			{
				$sqlPrice ='select * from marketdata where stock in ('.implode(',',$requestPrice).') and create_date = "'.($time_query->result_array()[0]['uptime']).'"';
				
			}

			$queryPrice = $this->db->query($sqlPrice);
			$resultPrice = array();
			foreach ($queryPrice->result_array() as $row) {
				if($row['stock'] == $query->result_array()[0]['underlying']){
					$resultPrice['ulbid'] = $row['bid'];
					$resultPrice['uloffer'] = $row['offer'];
					$resultPrice['ulbidvol'] = $row['bidvol'];
					$resultPrice['uloffervol'] = $row['offervol'];
					$tradingObject = json_decode($row['last']);
					if(isset($tradingObject)){

						$resultPrice['ullast'] = $tradingObject->lastTradePrice;
						$resultPrice['ultotal'] = $tradingObject->totalvolume;
						$resultPrice['ulchange'] = $tradingObject->percentChange;
					}else{
						$resultPrice['ullast'] = null;
						$resultPrice['ultotal'] = null;
						$resultPrice['ulchange'] = null;
					}
				}
				if($row['stock'] == $query->result_array()[0]['dw_Id']){
				
					$resultPrice['dwbid'] = $row['bid'];
					$resultPrice['dwoffer'] = $row['offer'];
					$resultPrice['dwbidvol'] = $row['bidvol'];
					$resultPrice['dwoffervol'] = $row['offervol'];
					$tradingObject = json_decode($row['last']);				
					if(isset($tradingObject) && !empty($tradingObject)){

						$resultPrice['dwtotal'] = $tradingObject->totalvolume;	
						if(isset($tradingObject->percentChange)){

							$resultPrice['dwchange'] = $tradingObject->percentChange;
						}else{
							$resultPrice['dwchange'] = null;
						}
						if(isset($tradingObject->lastTradePrice)){

							$resultPrice['dwlast'] = $tradingObject->lastTradePrice;
						}else{

							$resultPrice['dwlast'] = null;
						}
					}else{
						$resultPrice['dwlast'] = null;
						$resultPrice['dwtotal'] = null;
						$resultPrice['dwchange'] = null;
					}
				}
				
			}
			if(!isset($resultPrice['dwoffer']))
			{
					$resultPrice['dwbid'] = 0.0;
					$resultPrice['dwoffer'] =  0.0;
					$resultPrice['dwbidvol'] = 0;
					$resultPrice['dwoffervol'] = 0;
					$tradingObject = array();				
					$resultPrice['dwlast'] = 1.00;
					$resultPrice['dwtotal'] = 0;	
					$resultPrice['dwchange'] =0.0;
			}

			$content = array();
			$content = array_merge($content,($this->responseDetail($resultPrice,$query->result_array()[0],$timedecay_setups,$holidays)));
			$sql = "select *,datediff(last_trading_date,date(now())) as remain ,datediff(now(),trading_date) as usedate,datediff(expire_date,last_trading_date) as exprange ,datediff(last_trading_date,trading_date) as overall FROM otherdw WHERE dw_Id = '".$dw_Id."'";
			$query = $this->db->query($sql);
			foreach ($query->result_array() as $row) {
				$content['trading_date'] = date('d-M-Y',strtotime($row['trading_date']));
				$content['remain'] = $row['remain'];
				$content['use'] = $row['usedate'];
				$content['overall'] = $row['overall'];
				$content['exprange'] = $row['exprange'];
 			}
 			$sql = 'select dw_Id from otherdw where last_trading_date > date(now())';
 			$query = $this->db->query($sql);
 			$content['dws'] = $query;
		
			$this->template->load('template', 'product/detail',$content);
		}else{
			 show_404();
		}

	}

	function responseDetail  ($body,$row,$timedecay_setups,$holidays){
				
				$spotUnderlying =floatval($body['ulbid']);
				if($spotUnderlying == null)
				{
					$spotUnderlying =floatval($body['uloffer']);
				}

	 			$spotDw =floatval($body['dwbid']);
				$impliedvol = 0.0;
	 			$ttm = 0.0;
	 			$workdayYear = 0.0;
	 			$diff = 0.0;
	 			if(!isset($row['brokerno']))
	 			{
	 				$row['brokerno'] = '24';
	 			}
	 			if(!isset($row['callputflag']))
	 			{
	 				$row['callputflag'] = 'C';
	 			}
	 			if(!isset($row['exercise_price']))
	 			{
	 				$row['exercise_price'] = $row['strike'];
	 			}
	 			if(!isset($row['trading_date'])){
	 			  $row['trading_date'] =	$row['effective_date'] ;
	 			}
				if(array_search($row['brokerno'],$timedecay_setups)){
					$now = date('Y-m-d');
					$workdayYear = $this->utils->getWorkingDays($row['trading_date'],$row['last_trading_date'],$holidays);
					$diff = $this->utils->getWorkingDays($now,$row['last_trading_date'],$holidays);
					$ttm = ($diff)/($workdayYear);
				}else{
					$now = date('Y-m-d');
					$diff = $this->utils->dateDiff($row['last_trading_date'],$now);
					$workdayYear = 365;
					$ttm = ($diff)/($workdayYear);
				}
				$strike = 0;
				$conversion = 0;
				if($row['brokerno'] == 24){

					$query_strike = $this->db->query('select * from strike where DW_dw_Id = "'.$row['dw_Id'].'" ');
					foreach ($query_strike->result_array() as $row_in) {
						$strike = $row_in['strike'];
						$conversion = $row_in['conversion'];
						break;		
					}
					
				}else{
					$strike = $row['exercise_price'];
					$conversion = $row['conversion'];
				}
				if($row['callputflag'] == 'C'){ 
						if($diff == 0.0){
							$ttm = 1/365;
						}
					
					if($row['brokerno'] == '24'){
						$sql_im = $this->db->query('select * from dw where dw_Id = "'.$row['dw_Id'].'"');
						$impliedvol  = array("value" => $sql_im->result_array()[0]['imply_volatillity']/100);
					}else{
						$impliedvol = $this->bs->BSImplied_0($spotUnderlying,$strike,0.03,$spotDw * $conversion,$ttm,false);
					}
				}else{
					if($diff == 0.0){
							$ttm = 1/365;
						}

					$impliedvol = $this->bs->BSImplied_0($spotUnderlying,$strike,0.03,$spotDw * $conversion,$ttm,true);
				}	
	 			$delta =null;
				$theoprice=null;
				$theta = null;
				$gearing = null;
				$time = null;
				$timevalue = null;
				$sensitivity = null;
				if(floatval($impliedvol['value']) > 0){
					$delta =$this->utils->VanillaDelta($spotUnderlying,$strike,0.03,$impliedvol['value'],$ttm,strtolower($row['callputflag']));
				}
				//console.log(delta);
				if($impliedvol['value'] > 0){
					$theoprice =$this->utils->VanillaPrice($spotUnderlying,$strike,0.03,$impliedvol['value'],$ttm,strtolower($row['callputflag']))/$conversion;
				}
				//console.log($this->utils->getSpreadPrice(theoprice));
				if($impliedvol['value'] > 0){
					$theta = $this->utils->VanillaTheta($spotUnderlying,$strike,0.03,$impliedvol['value'],$ttm,strtolower($row['callputflag']));
				}	
				if($theoprice > 0 && $this->utils->getSharePrice($theoprice,0) > 0){			
					$gearing = $this->utils->gearing($delta,$spotUnderlying,$conversion,$this->utils->getSharePrice($theoprice,0));
				}
				$spreadDW =0.0;
				if($spotDw == 0){
					$spreadDW = 0.01;
				}else{
					$spreadDW = $this->utils->getSpreadPrice($spotDw);
				}
				$sensitivity = $this->utils->sensitivity($delta,$this->utils->getSpreadPrice($spotUnderlying),$conversion,$spreadDW);
				
				if($theoprice > 0 && !empty($theta) && $this->utils->getSharePrice($theoprice,0) > 0){
					$time = $this->utils->timedecay($theta,$this->utils->getSharePrice($theoprice,0),$conversion,$workdayYear);
				}
				if($spotUnderlying - $row['exercise_price']>0)
				{
					$timevalue = $spotDw - ($spotUnderlying - $row['exercise_price']);
				}else{
					$timevalue = $spotDw;
				}

			
				$no_of_issue = 0;
				$outstanding = 0;
				
				$resp = array();
				$resp['dw'] = $row['dw_Id'];
				$resp['underlying'] = $row['underlying'];
				$resp['exercise']  = $strike;
				$resp['no_of_issue'] = $no_of_issue;
				$resp['outstanding']  = $outstanding;
				$resp['ttl']  = $diff;
				$resp['type'] =$row['callputflag'];
				$resp['delta'] =  (is_nan($delta))?"N/A":sprintf("%.2f%%",$delta*100);
				$resp['impliedvol'] = (is_nan($impliedvol['value']))?"N/A":sprintf("%.2f%%",$impliedvol['value']*100);
				$resp['timedecay'] =  (is_nan($time))?"N/A":sprintf("%.2f%%",$time);
				$resp['conversion'] = $conversion;
				$resp['last_trading_date'] = date_format(date_create($row['last_trading_date']),'d-M-Y');
				$resp['trading_date'] = date_format(date_create($row['trading_date']),'d-M-Y');
				$resp['intrinsic' ]= (($spotUnderlying - $strike)>0)?number_format((($spotUnderlying-$strike)/ $conversion),2):0.00;
				$resp['sensitivity'] = $this->utils->sensitivity($delta,$this->utils->getSpreadPrice($spotUnderlying),$conversion,$this->utils->getSpreadPrice($spotDw));
				$resp['timevalue'] =(is_nan($timevalue))?"N/A":number_format($timevalue,2);
				
 				if($row['callputflag'] == 'C'){
 					if($spotUnderlying > 0){

					$resp["moneyness"]=number_format(((1  - ($strike/$spotUnderlying ) )*100),2)."%  " .((1- ( $strike/$spotUnderlying)  > 0)?"ITM":"OTM");
						$resp['moneynessFlag'] = ((1- ( $strike/$spotUnderlying)  > 0)?"ITM":"OTM");
					}else{
						$resp["moneyness"]="N/A";
						$resp['moneynessFlag'] = "";
					}
				
				}else{
	 				$resp["moneyness"]=number_format(((($strike/$spotUnderlying) -1)*100),2)."%  " . ((($strike/$spotUnderlying) -1  > 0)?"ITM":"OTM");
					$resp['moneynessFlag'] = ((($strike/$spotUnderlying) -1  > 0)?"ITM":"OTM");
	 			}
				$resp['gearing'] = number_format($gearing,2);


				$resp['ulbidvol'] = (!empty($body['ulbidvol']))?number_format($body['ulbidvol'],0,"",","):"N/A";
				$resp['uloffervol'] = (!empty($body['uloffervol']))?number_format($body['uloffervol'],0,"",","):"N/A";
				$resp['dwbidvol'] = (!empty($body['dwbidvol']))?number_format($body['dwbidvol'],0,"",","):"N/A";
				$resp['dwoffervol'] = (!empty($body['dwoffervol']))?number_format($body['dwoffervol'],0,"",","):"N/A"; 
				$resp['ulchange'] = (!empty($body['ulchange']))?sprintf("%.2f%%",$body['ulchange']):"N/A"; 
				if(!is_nan($body['dwchange'])){
					$resp['dwchange'] =sprintf("%.2f%%",$body['dwchange']); 
				}else{
					$resp['dwchange'] =sprintf("%.2f%%",0); 
				}

				$resp['ulbid'] = (!empty($body['ulbid']))?number_format($body['ulbid'],2):"N/A"; 
				$resp['uloffer'] =(!empty($body['uloffer']))? number_format($body['uloffer'],2):"N/A";
	 
				$resp['dwbid'] = (!empty($body['dwbid']))?number_format($body['dwbid'],2):"N/A"; 
				$resp['dwoffer'] = (!empty($body['dwoffer']))?number_format($body['dwoffer'],2):"N/A";
				$resp['ullast'] = (!empty($body['ullast']))?number_format($body['ullast'],2):"N/A";
				$resp['ultotal'] = (!empty($body['ultotal']))?number_format($body['ultotal'],0,"" ,","):"N/A"; 
				if(!is_nan($body['dwlast'])){
				
					$resp['dwlast'] = number_format($body['dwlast'],2); 
				}else{
					$resp['dwlast'] = number_format(0,2);
				}
				
				if(!is_nan($body['dwtotal'])){
				
					$resp['dwtotal'] = number_format($body['dwtotal'],0,"",",");
				}else{
					$resp['dwtotal'] = number_format(0,2);
				}
				$resp['expire'] = date_format(date_create($row['expire_date']),'d-M-Y');
				if($row['brokerno'] == 24){
					$resp['dw24'] = "Y";
				}else{
					$resp['dwother'] = $this->getlink( $row['dw_Id'], $row['brokerno'],$row['callputflag']);
					$resp['brokerno'] = $row['brokerno'];
				}

			   	return $resp;
	} 
	
	public function get28link($dw,$callputflag)
	{
			$stringCuttOf = strpos($dw,'28');
			$chg = substr_replace($dw,'',$stringCuttOf+3,1);
			$base = 'https://www.thaidw.com/LiveMatrixJSON?mode=1&ric='.$chg.'.BK&qid='.time();
			
			$options = array(
		        CURLOPT_RETURNTRANSFER => true,     // return web page
		        CURLOPT_HEADER         => false,    // don't return headers
		        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
		        CURLOPT_ENCODING       => "",       // handle all encodings
		        CURLOPT_USERAGENT      => "spider", // who am i
		        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
		        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
		        CURLOPT_TIMEOUT        => 120,      // timeout on response
		        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
		        CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		    );

		    $ch      = curl_init( $base );
		    curl_setopt_array( $ch, $options );
		    $content = curl_exec( $ch );
		    $err     = curl_errno( $ch );
		    $errmsg  = curl_error( $ch );
		    $header  = curl_getinfo( $ch );
		    curl_close( $ch );
		    $content = json_decode($content,true);
		    $ret_table = '';
            $ric_data = $content['ric_data'];
            $midpoint='';
            $tablecontent= '';
            $ubidask = ($ric_data['type'] == 'PUT') ? "underlying_ask" : "underlying_bid";
            // var tableElement = that.$five_day_table.children('tbody');
            // tableElement.empty();

            $hide_matrix="";
            $hide_date = "";
            $ftnm;
            foreach($content['symbols'] as $value){
            	if($chg == $value){
            		$hide_matrix = $value['hide_matrix'];
            		$hide_date = $value['hide_date'];
                    $ftnm = $value['future_dsply_name'];
            	}
            }
            $tableElement='<table id="five_day_table" class="table lbtable" style="">';
            // $.each(that.symbols, function (index, symbol) {
            //     if (symbol.ric === that.ric) {
            //         hide_matrix = symbol.hide_matrix;
            //         hide_date = symbol.hide_date;
            //         ftnm = symbol.future_dsply_name;
            //     }
            // });
            if ($hide_matrix != "1") {
                $hide_date = "";
            }

            //update quote data and description
            // that.updatePage(ric_data);
            // if (data.last_update) {
            //     $("#last_update span").html(printFormattedDate(data.last_update, true));
            // }
            if ($ric_data['BID'] <= 0.03) {
               // tableElement.html(that.$tr_livematrix_fiveday_unavailable.clone());
              //  return;'
            	$ret_table='<table class="table_livematrix_fiveday_unavailable"><tbody><tr><td colspan="6" class="text-content">ในกรณีที่ DW มีมูลค่าต่ำกว่า 0.03 บาท ไม่สามารถแสดงตารางราคา 5 วันทำการได้</td></tr></tbody></table>';
				return array('html'=>$ret_table,'credit'=>'http://www.mqwarrants.co.th/');
            }
            $tablecontent = '';
            $livematrix = $content['livematrix'];
            if (sizeof($livematrix) == 0) {
               $ret_table='<table class="table_livematrix_fiveday_empty"><tbody><tr><td colspan="6" class="text-content">ไม่สามารถแสดงตารางราคาได้ เนื่องจาก DW ไม่มีมูลค่า ณ ระดับราคาหลักทรัพย์อ้างอิงปัจจุบันนี้</td></tr></tbody></table>';
				return array('html'=>$ret_table,'credit'=>'http://www.mqwarrants.co.th/');
            }
            $date_keys = $content['date_keys'];
            $total_keys = sizeof($date_keys);
            $holidays = $content['holidays'];
            $midpoint = $this->findMidPoint($livematrix, $ric_data['lmuprice'], $content['is_compressed'], true, $ric_data['type']);
                $livematrixlimit = 9;
                $th_tmpl = '<tr>
                <th style="border-right:1px solid #ccc">Bid ของหลักทรัพย์อ้างอิง</th>';
                for ($i = $total_keys - 1; $i >= 0; $i--) {
                   $th_tmpl.='<th class="date_$i">'.$date_keys[$i].'</th>';            		
                }
                $th_tmpl .= '</tr>';
                $tableElement.='<thead>'.$th_tmpl.'</thead>';
                //tableElement.append($th_tmpl);
                $livematrixdata;
                $livematrixindex = $midpoint['index'];
                if ($livematrixindex == 0) {
                   ceil(sizeof($livematrix)/ 2);
                }
                for ($i = (sizeof($livematrix) - 1); $i >= 0; $i--) {
                    if ($i > $livematrixindex - $livematrixlimit && $i < $livematrixindex + $livematrixlimit) {
                        $rowclass = "";
                        $livematrixdata = $livematrix[$i];

                        foreach($livematrixdata as $key=>$value) {
                            $bids = $livematrixdata[$key];
                            for ($j = ($total_keys - 1); $j >= 0; $j--) {
                                if ($bids[$date_keys[$j]] <= 0.03) {
                                    $rowclass = "rownotdisplay ";
                                    break;
                                }
                            }
                        }
    					foreach($livematrixdata as $key=>$value) {
                            $tablecontent .= "<tr class=" . $rowclass . ">";
                            $tablecontent .= "<td style='border-right:1px solid #ccc'>" . $key . "</td>";
                            $bids = $livematrixdata[$key];
                            for ($j = ($total_keys - 1); $j >= 0; $j--) {
                                $hide_class = "";
                                if ($j < 2) {
                                    $hide_class = "hide-xs-portrait";
                                }
                                if (in_array($date_keys[$j],$holidays)) {
                                    $tablecontent .= "<td class='bgcolor-01 " . $hide_class . "'>" . (($bids[$date_keys[$j]] === 'undefined')? '-' : number_format($bids[$date_keys[$j]],2,'.','.')). "</td>";
//                                    tablecontent += "<td class='bgcolor-01 " + hide_class + "'>" + key + "</td>";
                                } else if (!empty($hide_date) && $hide_date == $date_keys[$j]) {
                                    $tablecontent .= "<td class='bgcolor-02 " . $hide_class . "'>" .(($bids[$date_keys[$j]] === 'undefined')? '-' : number_format($bids[$date_keys[$j]],2,'.','.')) . "</td>";
//                                    tablecontent += "<td class='bgcolor-02 " + hide_class + "'>" + key + "</td>";
                                } else {
                                    $tablecontent .= "<td class='" . $hide_class . "'>" .(($bids[$date_keys[$j]] === 'undefined')? '-' :number_format($bids[$date_keys[$j]],2,'.','.')) . "</td>";
//                                    tablecontent += "<td class='bgcolor-07 " + hide_class + "'>" + key + "</td>";
                                }
                            }
                            $tablecontent .= "</tr>";
                        }
                    }
                }
                $tableElement.='<tbody>'.$tablecontent.'</tbody></table>';
                //$(".rownotdisplay").hide();
                // if (tableElement.find('tr.rownotdisplay').size() + 1 == tableElement.find("tr").size()) {
                //     tableElement.html(that.$tr_livematrix_fiveday_empty.clone());
                // } else {
                //     tableElement.find('tr:visible').filter(':even').addClass('bgcolor-08');
                // }
        //     }
        // }
		 //    $resultObj = json_decode($content,true);
		 //    $date_keys = $resultObj['date_keys'];
		 //    function compare_func($a, $b)
			// {
			//     // CONVERT $a AND $b to DATE AND TIME using strtotime() function
			//     $t1 = strtotime($a);
			//     $t2 = strtotime($b);

			//     return ($t1 - $t2);
			// }
			// usort($date_keys, "compare_func");
		 //    $strbody = "";
		   
		
			return array('html'=>$tableElement,'credit'=>'http://www.thaidw.com/');
	}
	public function  findMidPoint($lmdata, $lmprice, $iscompress, $isfiveday, $type) {
        $mp = array(
            'price'=> -1,
            'diff'=> -1,
            'index'=> -1
        );
        //console.log(lmdata)
        for ($i = 0; $i < sizeof($lmdata); $i++) {
            if ($iscompress && !($i % 2 == 0)) { //for compressed data, process only even data
                continue;
            }
            $ubid;
            if ($isfiveday && !$iscompress) {
                $ubid = array_keys($lmdata[$i])[0];
            } else {
                $ubid = $lmdata[$i][($type == 'PUT') ? "underlying_ask" : "underlying_bid"];
            }
            $diff = abs($lmprice - $ubid);
            if ($mp['index'] === -1 || $mp['diff'] > $diff) {
                $mp['diff'] = $diff;
                $mp['price'] = $ubid;
               $mp['index'] = $i;
            }
        }
        return $mp;
    }
	public function curlGet($url)
	{
			$base = $url;
			
			$options = array(
		        CURLOPT_RETURNTRANSFER => true,     // return web page
		        CURLOPT_HEADER         => false,    // don't return headers
		        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
		        CURLOPT_ENCODING       => "",       // handle all encodings
		        CURLOPT_USERAGENT      => "spider", // who am i
		        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
		        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
		        CURLOPT_TIMEOUT        => 120,      // timeout on response
		        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
		        CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		    );

		    $ch      = curl_init( $base );
		    curl_setopt_array( $ch, $options );
		    $content = curl_exec( $ch );
		    $err     = curl_errno( $ch );
		    $errmsg  = curl_error( $ch );
		    $header  = curl_getinfo( $ch );
		    curl_close( $ch );
		  	return $content;
			
	}

	// public function writeHTML42(){
	// 	$this->load->helper('file');
	// 	$content = $this->curlGet('http://www.maybank-ke.co.th/dw42/priceGuideline.asp?dwSymbol=AOT42C1705A&ln=th');	
	// 	if ( ! write_file('./test.txt', $content))
	// 	{
	// 	        echo 'Unable to write the file';
	// 	}else{

	// 	}
	// 	echo $content;
	// }
	public function get42link($dw,$dwType){ 

			$content = $this->curlGet('http://www.maybank-ke.co.th/dw42/priceGuideline_holiday.asp?inHoliday='.date('Y').'&_=1480492978788');			
			$startDate = time();
			$workday_list = explode('^',$content);
			$is_holiday = 0;
			$todayTxt = date('Y-m-d',strtotime("+ ".$workday_list[4]." days", $startDate));
			$todayP1 = date('Y-m-d',strtotime("+ ".$workday_list[3]." days", $startDate));
			$todayP2 = date('Y-m-d',strtotime("+ ".$workday_list[2]." days", $startDate));
			$todayP3 =  date('Y-m-d',strtotime("+ ".$workday_list[1]." days", $startDate));
			$todayP4 = date('Y-m-d',strtotime("+ ".$workday_list[0]." days", $startDate));

			$content = $this->curlGet('http://www.maybank-ke.co.th/dw42/priceGuideline_updateMT.asp?dwName='.$dw.'&_='.time());
	
			$realPrice = 0.0;
			if($content == ""){
				$content=0.0;
			}
			else{
				$resultRow = explode("___",$content) ;
				$realPrice = $resultRow[0];
			}
				
			$diffPriceUp = 0.0;
			$diffPriceDown = 0.0;
			$outputType = "priceGuideline";
			$headTextC1 = ($dwType)=="C"? "ราคาเสนอซื้อหลักทรัพย์อ้างอิง(บาท)": "ราคาเสนอขายหลักทรัพย์อ้างอิง(บาท)";
			$content = $this->curlGet('http://www.maybank-ke.co.th/dw42/priceGuideline_calcPrice.asp?_dwName='.$dw.'&outputType=priceGuideline&_='.time());
			$res = explode("_",$content) ;
			$up_ = new SplFixedArray(11);
			$down_ = new SplFixedArray(11);
			$count =0;
			for ($i=10; $i>=0; $i--)
			{
				$down_[$count++] = $res[$i];
			}
			$count =0;
			for ($i=20; $i>=10; $i--)
			{
				$up_[$count++] = $res[$i];
			}			
			$weekday = new SplFixedArray(7);
			$weekday[0]=  "Sunday";
			$weekday[1] = "Monday";
			$weekday[2] = "Tuesday";
			$weekday[3] = "Wednesday";
			$weekday[4] = "Thursday";
			$weekday[5] = "Friday";
			$weekday[6] = "Saturday";

			$month = new SplFixedArray(12);
			$month[0] = "January";
			$month[1] = "February";
			$month[2] = "March";
			$month[3] = "April";
			$month[4] = "May";
			$month[5] = "June";
			$month[6] = "July";
			$month[7] = "August";
			$month[8] = "September";
			$month[9] = "October";
			$month[10] = "November";
			$month[11] = "December";
												
			$row = "<table class = \"tablePriceGuideline tbborder\" style=\"width: 100%;\" border=\"1px solid #ccc\" cellspacing=\"0\" cellpadding=\"0\">"
			."<thead><tr style=\"background-color:#fecc0a\">"
				."<td style=\"width:25%\" rowspan=\"2\" class=\"tdStyle\">".$headTextC1."</td>"
				."<td style=\"width:15%\" colspan=\"5\" class=\"tdStyle\">ราคาเสนอซื้อของ DW (บาท)</td>"
			."</tr>"
			."<tr style=\"background-color:#fecc0a\">"
				."<td style=\"width:15%\" class=\"tdStyle\">".date('M-d, Y D',strtotime($todayTxt))."</td>"
				."<td style=\"width:15%\" class=\"tdStyle\">".date('M-d, Y D',strtotime($todayP1))."</td>"
				."<td style=\"width:15%\" class=\"tdStyle\">".date('M-d, Y D',strtotime($todayP2))."</td>"
				."<td style=\"width:15%\" class=\"tdStyle\">".date('M-d, Y D',strtotime($todayP3))."</td>"
				."<td style=\"width:15%\" class=\"tdStyle\">".date('M-d, Y D',strtotime($todayP4))."</td>"
					."</tr></thead>";
			for($i = count($down_)-1 ; $i > 0; $i--){
				$price_ = explode(",",(string)$down_[$i]);
				$dwP = explode("^",(string)$price_[1]);
				$row = $row ."<tr>";
				$row .= "<td style=\"width:25%\" class=\"tdStyle\">".number_format($price_[0],2,'.','')."</td>";
				if( $todayTxt[0]=="Sat" || $todayTxt[0]=="Sun" || $is_holiday[0]==1){
							$row = $row ."<td style=\"width:15%\" bgcolor=\"#D8D8D8\" class=\"tdStyle\">".number_format($dwP[4],2,'.','')."</td>";
				} else {
					if ($dwP[4]!="x") {
						$row = $row ."<td style=\"width:15%\" class=\"tdStyle\">".number_format($dwP[4],2,'.',''). "</td>";
					} else {
						$row = $row ."<td style=\"width:15%\" class=\"tdStyle\">". "N/A" . "</td>";
					}
				}
							
				if( $todayP1[0]=="Sat" || $todayP1[0]=="Sun" || $is_holiday[1]==1){
					$row = $row ."<td style=\"width:15%\" bgcolor=\"#D8D8D8\" class=\"tdStyle\">".number_format($dwP[3],2,'.','')."</td>";
				} else {
					if ($dwP[3]!="x") {
						$row = $row ."<td style=\"width:15%\" class=\"tdStyle\">".number_format($dwP[3],2,'.','')."</td>";
					} else $row = $row ."<td style=\"width:15%\" class=\"tdStyle\">". "N/A" . "</td>";
				}	
					
				if( $todayP2[0]=="Sat" || $todayP2[0]=="Sun" || $is_holiday[2]==1){
					$row = $row ."<td style=\"width:15%\" bgcolor=\"#D8D8D8\" class=\"tdStyle\">".number_format($dwP[2],2,'.','')."</td>";
				} else {
					if ($dwP[2]!="x") {
						$row = $row ."<td style=\"width:15%\" class=\"tdStyle\">".number_format($dwP[2],2,'.','')."</td>";
					} else $row = $row ."<td style=\"width:15%\" class=\"tdStyle\">". "N/A" . "</td>";
				}
				
				if( $todayP3[0]=="Sat" || $todayP3[0]=="Sun" || $is_holiday[3]==1){
					$row = $row ."<td style=\"width:15%\" bgcolor=\"#D8D8D8\" class=\"tdStyle\">".number_format($dwP[1],2,'.','')."</td>";
				} else {
					if ($dwP[1]!="x") {
						$row = $row ."<td style=\"width:15%\" class=\"tdStyle\">".number_format($dwP[1],2,'.','')."</td>";
					} else $row = $row ."<td style=\"width:15%\" class=\"tdStyle\">". "N/A" . "</td>"	;							
				}
				
				if( $todayP4[0]=="Sat" || $todayP4[0]=="Sun" || $is_holiday[4]==1){
						$row = $row ."<td style=\"width:15%\" bgcolor=\"#D8D8D8\" class=\"tdStyle\">".number_format($dwP[0],2,'.','')."</td>";

				} else {
					if ($dwP[0]!="x") {
								$row = $row ."<td style=\"width:15%\" class=\"tdStyle\">".number_format($dwP[0],2,'.','')."</td>";
					} else $row = $row +"<td style=\"width:15%\" class=\"tdStyle\">". "N/A" . "</td>";
				}
				$row = $row ."</tr>";
			}

			$price_ = explode(",",(string)$res[10]);
			$dwP =explode("^",(string) $price_[1]);
			$row = $row ."<tr style=\"font-weight:bold;background-color: #F5ECCE;\" >"
			."<td style=\"width:25%\" class=\"tdStyle\" >".number_format($price_[0],2,'.','')."</td>";
			
			if ($dwP[4]!="x") {
				$row = $row."<td style=\"width:15%\" class=\"tdStyle\">".number_format($dwP[4],2,'.','')."</td>";
			} else $row = $row ."<td style=\"width:15%\" class=\"tdStyle\">". "N/A" . "</td>";
			
			if ($dwP[3]!="x") {
				$row = $row ."<td style=\"width:15%\" class=\"tdStyle\">".number_format($dwP[3],2,'.','')."</td>";
			} else $row = $row ."<td style=\"width:15%\" class=\"tdStyle\">". "N/A" . "</td>";
			
			if ($dwP[2]!="x") {
				$row = $row."<td style=\"width:15%\" class=\"tdStyle\">".number_format($dwP[2],2,'.','')."</td>";
			} else $row = $row ."<td style=\"width:15%\" class=\"tdStyle\">". "N/A" . "</td>";
			
			if ($dwP[1]!="x") {
				$row = $row."<td style=\"width:15%\" class=\"tdStyle\">".number_format($dwP[1],2,'.','')."</td>";
			} else $row = $row ."<td style=\"width:15%\" class=\"tdStyle\">". "N/A" . "</td>";
			
			if ($dwP[0]!="x") {
				$row = $row."<td style=\"width:15%\" class=\"tdStyle\">".number_format($dwP[0],2,'.','')."</td>";
			} else $row = $row ."<td style=\"width:15%\" class=\"tdStyle\">". "N/A" . "</td>";

			for($i=0 ;$i<count($up_)-1 ;$i++){
					$price_ = explode(",",(string)$up_[$i]);
					$dwP = explode("^",(string)$price_[1]);
					$row = $row ."<tr>";
					$row = $row."<td style=\"width:25%\" class=\"tdStyle\">".number_format($price_[0],2,'.','')."</td>";
				
				if( $todayTxt[0]=="Sat" || $todayTxt[0]=="Sun" || $is_holiday[0]==1){
					$row = $row."<td style=\"width:15%\" bgcolor=\"#D8D8D8\" class=\"tdStyle\">".number_format($dwP[4],2,'.','')."</td>";
				} else {
					if ($dwP[4]!="x") {
						$row = $row ."<td style=\"width:15%\" class=\"tdStyle\">".number_format($dwP[4],2,'.','')."</td>";
					} else $row = $row ."<td style=\"width:15%\" class=\"tdStyle\">". "N/A" . "</td>";
				}	
					
				if( $todayP1[0]=="Sat" || $todayP1[0]=="Sun" || $is_holiday[1]==1){
					$row = $row ."<td style=\"width:15%\" bgcolor=\"#D8D8D8\" class=\"tdStyle\">".number_format($dwP[3],2,'.','')."</td>";
				} else {
					if ($dwP[3]!="x") {
						$row = $row ."<td style=\"width:15%\" class=\"tdStyle\">".number_format($dwP[3],2,'.','')."</td>";
					} else $row = $row ."<td style=\"width:15%\" class=\"tdStyle\">". "N/A" . "</td>";
				}	
					
				if( $todayP2[0]=="Sat" || $todayP2[0]=="Sun" || $is_holiday[2]==1){
					$row = $row ."<td style=\"width:15%\" bgcolor=\"#D8D8D8\" class=\"tdStyle\">".number_format($dwP[2],2,'.','')."</td>";
				} else {
					if ($dwP[2]!="x") {
						$row = $row ."<td style=\"width:15%\" class=\"tdStyle\">".number_format($dwP[2],2,'.','')."</td>";
					} else $row = $row ."<td style=\"width:15%\" class=\"tdStyle\">". "N/A" . "</td>";
				}
				
				if( $todayP3[0]=="Sat" || $todayP3[0]=="Sun" || $is_holiday[3]==1){
					$row = $row ."<td style=\"width:15%\" bgcolor=\"#D8D8D8\" class=\"tdStyle\">".number_format($dwP[1],2,'.','')."</td>";
				} else {
					if ($dwP[1]!="x") {
						$row =$row ."<td style=\"width:15%\" class=\"tdStyle\">".number_format($dwP[1],2,'.','')."</td>";
					} else $row = $row ."<td style=\"width:15%\" class=\"tdStyle\">". "N/A" . "</td>";								
				}
				
				if( $todayP4[0]=="Sat" || $todayP4[0]=="Sun" || $is_holiday[4]==1){
					$row = $row ."<td style=\"width:15%\" bgcolor=\"#D8D8D8\" class=\"tdStyle\">".number_format($dwP[0],2,'.','')."</td>";
				} else {
					if ($dwP[0]!="x") {
						$row = $row ."<td style=\"width:15%\" class=\"tdStyle\">".number_format($dwP[0],2,'.','')."</td>";
					} else $row = $row ."<td style=\"width:15%\" class=\"tdStyle\">". "N/A" . "</td>";
				}
				$row = $row ."</tr>";

			}
			$row.="</table>";
			
			$row = $row."</tr>";
			return array('html'=>$row,'credit'=>'http://www.maybank-ke.co.th/dw42');
}
	// public function batch()
	// {
	// 	if($this->ion_auth->is_admin()){
	// 		$dw13_query = $this->db->query('select dw_Id from otherdw where DATE(last_trading_date)>=DATE(NOW())');
	// 		$array_map_html = array();
	// 		$array_spoof_web=array('www.google.com','www.youtube.com','www.facebook.com','www.baidu.com','www.yahoo.com','www.wikipedia.com');
				
	// 		foreach ($dw13_query->result_array() as $row) {

	// 			$current_web_spoof = $array_spoof_web[rand(0,4)];
	// 			$dw = $row['dw_Id'];
	// 			$curl = curl_init();

	// 			curl_setopt_array($curl, array(
	// 			  CURLOPT_URL => "http://www.thaiwarrant.com/th/kgi-dw/template.asp?dw_name=".$dw."&color=1",
	// 			  CURLOPT_RETURNTRANSFER => true,
	// 			  CURLOPT_ENCODING => "",
	// 			  CURLOPT_MAXREDIRS => 10,
	// 			 	CURLOPT_REFERER=>$current_web_spoof,
	// 			  CURLOPT_TIMEOUT => 30,
	// 			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 			  CURLOPT_CUSTOMREQUEST => "GET",
	// 			  CURLOPT_HTTPHEADER => array(
	// 			    "cache-control: no-cache",
	// 			    "postman-token:".uniqid(),
	// 			    "Host	www.thaiwarrant.com",
	// 				"Cache-Control	no-cache",
	// 				'Content-Type: text/html; charset=utf-8',
	// 				"User-Agent	Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.75 Safari/537.36",
	// 				"Postman-Token	2588ffbd-eff1-95a9-f0b5-35ea5efa75ba",
	// 				"Accept	*/*",
	// 				"Accept-Encoding	gzip, deflate, sdch",
	// 				"Accept-Language	th-TH,th;q=0.8,en;q=0.6",
	// 			    "Cookie:	ASPSESSIONIDCCBATSAA=HFHCMGBBFOCGMDDMIDAAPPKJ;strkey=565d45574701524304045c420902735437455b215b13164341215c4d4a145e5e;ip%5Fvisit=49%2E229%2E163%2E185; dwname=top1=".$dw."; dwweb=1=".$dw."; lang=T"
	// 			  ),
	// 			));

	// 			$response = curl_exec($curl);
	// 			$err = curl_error($curl);

	// 			curl_close($curl);
				
	// 			$html = str_get_html($response);
	// 			 $i= 0;
	// 			 $result = '';
	// 			foreach($html->find('div[class=tb_main_content]') as $div) 
	// 			{
	// 			       foreach($div->find('table') as $table) 
	// 			       {
	// 			       		if($i==1){
	// 			       			  foreach($table->find('div') as $indiv) 
	// 			     			  {	
	// 			     			  	foreach($indiv->find('div') as $indiv1) 
	// 			     			  		{
	// 							       			$result = $indiv1;
	// 							       		 	break 4;
	// 					       		 	}
	// 					       		}
	// 			       		 }
	// 			       		 $i++;
	// 			       }

	// 			 }
	// 			$array_map_html[$dw] = $result;
	// 		}
	// 		$this->load->model('news_model');
	// 		$result=	$this->news_model->upload_dw13($array_map_html);
	// 		echo $result;
	// 	}
	// }
	public function getlink($dw,$brokerno,$callputflag)
	{
		if($brokerno == "01"){
			$html = file_get_html('http://www.blswarrant.com/th/DW01PriceCalculator.php?secSym='.$dw);
			$ret = $html->find('table[id=tblDwPrice]');
			return array('html'=>$ret[0],'credit'=>'http://www.blswarrant.com/');
		}else if($brokerno == "13"){
			$html = file_get_html(APPPATH.'/controllers/dw13/'.$dw.'.html');
			 $i= 0;
			foreach($html->find('div[class=tb_main_content]') as $div) 
			{
			       foreach($div->find('table') as $table) 
			       {
			       		if($i==1){
			       			  foreach($table->find('div') as $indiv) 
			     			  {	
			     			  	foreach($indiv->find('div') as $indiv1) 
			     			  		{
							       			$result = $indiv1;
							       		 	break 4;
					       		 	}
					       		}
			       		 }
			       		 $i++;
			       }

			 }
			return array('html'=>$result,'credit'=>'http://www.thaiwarrant.com/','dwversion'=>'13');
			// return array('html'=>$ret[0],'credit'=>'http://www.thaiwarrant.com/');

		}else if($brokerno == "28"){
			return $this->get28link($dw,$callputflag);
		}else if($brokerno == "23"){
			$html = "<a class='btn btn-info' target='blank' href='http://cms.scbsonline.com/DW/DW_price/".$dw.".pdf' > click เพื่อดูตารางราตา </a>";

			return array('html'=>$html,'credit'=>'http://cms.scbsonline.com/DW/banner/DW_new.html');
		}else if($brokerno == "08"){
			$html = "<a class='btn btn-info'  href='https://docs.google.com/spreadsheets/d/1SRtOyLtEMpq3yMZOE8jhAZ7mqOiD1oKkj-cwsyLsRjM/export?format=xlsx&id=1SRtOyLtEMpq3yMZOE8jhAZ7mqOiD1oKkj-cwsyLsRjM' > click เพื่อ Download </a>";
			return array('html'=>$html,'credit'=>'http://inv3.asiaplus.co.th/cms/dw_index.php');
		}else if($brokerno == "08"){
			$html = "<a class='btn btn-info'  href='https://docs.google.com/spreadsheets/d/1SRtOyLtEMpq3yMZOE8jhAZ7mqOiD1oKkj-cwsyLsRjM/export?format=xlsx&id=1SRtOyLtEMpq3yMZOE8jhAZ7mqOiD1oKkj-cwsyLsRjM' > click เพื่อ Download </a>";
			return array('html'=>$html,'credit'=>'http://inv3.asiaplus.co.th/cms/dw_index.php');
		}else if($brokerno == "11"){
			$html = file_get_html('http://kswarrants.kasikornsecurities.com/www/tool/guideline');
			$ret = $html->find('a[href*='.$dw.']');
				$link = "<a class='btn btn-info' target='blank' href='http://kswarrants.kasikornsecurities.com".$ret[0]->href."' > click เพื่อ Download </a>";
			return array('html'=>$link,'credit'=>'http://kswarrants.kasikornsecurities.com/www/tool/guideline');
		}else if($brokerno == "27"){
			//$html = file_get_html('http://www.osk188.co.th/dw27/dw27playbook.html');
			// $ret = $html->find('a[href*=dw27playbook]');
			$link = "<a class='btn btn-info' target='blank' href='http://www.osk188.co.th/dw27/dw27playbook/pdf/".date('m-Y')."/dw27playbook_".date('dmY').".pdf' > click เพื่อ Download </a>";
			// echo json_encode($ret);
			//	$link = "<a class='btn btn-info' target='blank' href='http://osk188.co.th/dw27/dw27playbook".$ret[0]->href."' > click เพื่อ Download </a>";
			return array('html'=>$link,'credit'=>'http://www.osk188.co.th/dw27/dw27playbook.html');
		}else if($brokerno == "16"){
			$html = file_get_html('http://tns.tnsitrade.com/TNB_ATNSCMS/pre/th/contents/?id=86&DW16%20%E0%B9%82%E0%B8%94%E0%B8%A2%20%E0%B8%9A%E0%B8%A5.%E0%B8%98%E0%B8%99%E0%B8%8A%E0%B8%B2%E0%B8%95');
			$ret = $html->find('a[href*='.$dw.']');
			$link = "<a class='btn btn-info' target='blank' href='".$ret[0]->href."' > click เพื่อ Download </a>";
			// echo json_encode($ret);
			//	$link = "<a class='btn btn-info' target='blank' href='http://osk188.co.th/dw27/dw27playbook".$ret[0]->href."' > click เพื่อ Download </a>";
			return array('html'=>$link,'credit'=>'http://tns.tnsitrade.com/TNB_ATNSCMS/pre/th/home/');
		}else if($brokerno == "42"){
			//$this->writeHTML42();
			return $this->get42link($dw,$callputflag);
		}else {
			return array('html'=>'ไม่พบข้อมูล','credit'=>'#');
		}
	}
	public function compare()
	{
		//$draw,$start,$length,$order,$ul,$age,$type,$issuer,$issuerall;
	
		 $draw = $this->input->get('draw');
		 $start = $this->input->get('start');
		 $length = $this->input->get('length');
		 $order = $this->input->get('order');
		 $ul = $this->input->get('ul');
		 $age = $this->input->get('age');
		 $type = $this->input->get('type');
   		$issuer = $this->input->get('issuer');

	if(empty($ul) && empty($age) && empty($type) && !isset($issuer)){
			$age=2;
			$type="C"; 
			$issuer=array('24');
	}
 
	// if(req.body){
	// 	underlying = req.body.underlying;
	// 	age = req.body.age;
	// 	type = req.body.type;
	// }
	 
	$q_ul = "";
	$q_age ="";
	$q_type="";
	$q_issuer = ""; 
	if(isset($issuer)){
		$issuer = implode($issuer,',');
	}
	if(!empty($ul)){
		$q_ul = " AND oth.underlying ='".$ul."'";
	}
	if(!empty($type)){
		$q_type = " AND callputflag = '".$type."' ";
	}

	if(!empty($age)){
		$q_age =" AND DATEDIFF(last_trading_date, NOW())/30 "; 
		if($age == 1){
			$q_age=$q_age. " < 1";
		}else if( $age ==2){
			$q_age= $q_age." >= 1" ;
		}else if($age ==3){
			$q_age= $q_age.">= 3";
		}else if($age == 4){
			$q_age= $q_age."  >= 6";
		}else if($age == 5){
			$q_age= $q_age."  >= 9";
		}
	}
	if(!empty($issuer) && isset($issuer)){
		$q_issuer = "AND brokerno IN (".$issuer.")";
	}
	$arraysql = array("SELECT    *,oth.underlying as ul ",
				"FROM      dw24.otherdw oth",
			"LEFT JOIN dw24.hist_vol hvol ON oth.underlying = hvol.underlying",
		//	"JOIN      dw24.pricing_history ph ON (ph.date = pricing_last.data_date and pricing_last.stock = ph.stock)",
			"WHERE oth.dw_Id NOT LIKE 'S50%' and oth.last_trading_date >=  date(NOW())" ,
			 $q_ul,
			 $q_age,
			 $q_type,
			 $q_issuer);

		$sql = implode('  ',$arraysql);
		$sql2 = "SELECT * FROM display_date WHERE required = 'Y' ;";
		$sql3 = "SELECT * FROM timedecay_setup;";
		//echo $sql;
		$query = $this->db->query($sql);
		$query2 = $this->db->query($sql2);
		$query3 = $this->db->query($sql3);
		$requestPrice = array();
		$timedecay_setups = array();
		$holidays = array();
		$index = array();
		//var count = result[1][Object.keys(result[1])[0]][""].countrow;
		$resultObj  = array();
		$result24 = array();
		$renderObj = new stdClass();

		$maxGearing = 0;
		$maxSense = 0;
		$minTimedecay = 0;

		$stock_param = array();

		foreach($query->result_array() as $row){
		 		 $requestPrice[]= array('ul'=>$row['ul'],'dw'=>$row['dw_Id']);	

		 		 if(!in_array("'".$row['ul']."'",$stock_param)){

					 $stock_param[] ="'".$row['ul']."'";
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
		if(sizeof($stock_param) == 0)
		{
			$sqlPrice ='select * from marketdata where  create_date = (select max(create_date) from marketdata)';
			
		}
		$queryPrice = $this->db->query($sqlPrice);
	
		$resultPrice = array();
		foreach ($queryPrice->result_array() as $row) {
			$resultPrice[$row['stock']] = $row['bid'];
			if( $row['bid'] == null)
			{
				$resultPrice[$row['stock']] = $row['offer'];
			}
		}
		foreach($query2->result_array() as $row){
		  		    	 		 $holidays[] = $row['display_date'];	
				    	 		 
		}
		foreach($query3->result_array() as $row){
		 		    	 		 $timedecay_setups[]= $row['broker_id'];					    	 		 
		}
			$url = 'dwPrice3/';
			$this->load->library('utils');
		
			$renderObj = array();

			$renderObj['datas'] = $this->responseCompare($resultPrice,$query,$timedecay_setups,$holidays);
			$renderObj['ul']=$ul;
			$renderObj['issuer']=$issuer;
			if($age == 1){
				$renderObj["age1"] = true;
			}else if( $age ==2){ 
				$renderObj["age2"] = true;
			}else if($age ==3){
				$renderObj["age3"] = true; 
			}else if($age == 4){
				$renderObj["age4"] = true;
			}else if($age == 5){
				$renderObj["age5"] = true;
			}
			if($type=="P"){
				$renderObj["Put"] = true;
			}else if($type=="C"){
				$renderObj["Call"] = true;
			}

		$this->template->load('template', 'product/compare',$renderObj);

	}
	function responseCompare($markets,$query,$timedecay_setups,$holidays){
		$resultObj  = array();
		$result24 = array();
		
		$this->load->library('bs');												
		foreach($query->result_array() as $row){

			$spotUnderlying =floatval ($markets[$row['ul']]);
			$spotDw = 0.0;
			if(isset($markets[$row['dw_Id']])){

				$spotDw =floatval ($markets[$row['dw_Id']]);
			}
			
			$impliedvol = 0.0;
			$ttm = 0.0;  
			$workdayYear = 0.0;
			$now =date('Y-m-d');

			if(array_search($row['brokerno'],$timedecay_setups)){
				$workdayYear = $this->utils->getWorkingDays($row['trading_date'],$row['last_trading_date'],$holidays);
				$diff = $this->utils->getWorkingDays($now,$row['last_trading_date'],$holidays);
				$ttm = ($diff)/($workdayYear);
			}else{

				$diff = $this->utils->dateDiff($row['last_trading_date'],$now);
				$workdayYear = 365;
				$ttm = ($diff)/($workdayYear);
			}
			if($diff == 0.0){
				$ttm = 1/365;
			}
			if($row['callputflag'] == 'C'){ 
				$impliedvol = $this->bs->BSImplied_0($spotUnderlying,$row['exercise_price'],0.03,$spotDw * $row['conversion'],$ttm,false);
			}else{
				$impliedvol = $this->bs->BSImplied_0($spotUnderlying,$row['exercise_price'],0.03,$spotDw * $row['conversion'],$ttm,true);
			}	

			$delta =null;
			$theoprice=null;
			$theta = null;
			$gearing = null;
			$time = null;
			$sensitivity = null;
			if(floatval($impliedvol['value']) > 0){
				$delta =$this->utils->VanillaDelta($spotUnderlying,$row['exercise_price'],0.03,$impliedvol['value'],$ttm,strtolower($row['callputflag']));
			}
			//console.log(delta);
			if($impliedvol['value'] > 0){
				$theoprice =$this->utils->VanillaPrice($spotUnderlying,$row['exercise_price'],0.03,$impliedvol['value'],$ttm,strtolower($row['callputflag']))/$row['conversion'];
			}
			//console.log($this->utils->getSpreadPrice(theoprice));
			if($diff == 0.0){
				$ttm = 1/365;
			}
			if($impliedvol['value'] > 0){
				$theta = $this->utils->VanillaTheta($spotUnderlying,$row['exercise_price'],0.03,$impliedvol['value'],$ttm,strtolower($row['callputflag']));
			}	
			if($theoprice > 0){			 			//console.log(theta);  
				$gearing = $this->utils->gearing($delta,$spotUnderlying,$row['conversion'],$this->utils->getSharePrice($theoprice,0));
			}
			$sensitivity = $this->utils->sensitivity($delta,$this->utils->getSpreadPrice($spotUnderlying),$row['conversion'],$this->utils->getSpreadPrice($spotDw));
			
			if($theoprice > 0 && !empty($theta)){
				$time = $this->utils->timedecay($theta,$this->utils->getSharePrice($theoprice,0),$row['conversion'],$workdayYear);
			}
			$dw  =$row['dw_Id']; 
			$callputflag = $row['callputflag'];  
			$underlying = $row['underlying'];  
			$sd = $row['mm_quality'];  
			$expire_date = $row['last_trading_date']; 
			$SD = 0.0;
			$sens = 0.0;
			$SD = (1-$sd*10);
			$operatedate = $this->utils->dateDiff($row['last_trading_date'],$now);
			if($operatedate <= 5){
				$sd = "";
			}
			if(abs($sensitivity) >1){
				$sens = 1;
			}else{
				$sens = abs($sensitivity);
			} 
			$info = array();
			$info["dw"]=$dw;
			$info["underlying"]=$underlying;
			$info["spotdw"]=number_format($spotDw,2); 
			$info["type"]=($callputflag =='C')?'Call':'Put';
			$info["sd"]= (!empty($sd)&& !empty($sd))?sprintf("%.2f%%",$sd * 100):"N/A";
			$info["gearing"]=(!is_nan($gearing) && !empty($gearing))?number_format($gearing,2):"N/A";
			$info["sense"]=(!is_nan($sensitivity)&& !empty($sensitivity))?number_format($sensitivity,2):"N/A";
			$info["time"]=(!is_nan($time)&& !empty($time))?sprintf("%.2f%%",$time):"N/A";
			$info["expire_date"]=date_format(date_create($expire_date),'d-M-Y');
			$info["impliedvol"]= (!is_nan($impliedvol['value'])&& !empty($impliedvol['value']))?sprintf("%.2f%%",$impliedvol['value']*100):"N/A";
			$info["histvol"]= (!is_nan($row['hist_vol'])&& !empty($row['hist_vol']))?sprintf("%.2f%%",$row['hist_vol']*100):"N/A";

			if($row['brokerno'] == "24"){
				$result24[] = $info;
			}else{
				$resultObj[] = $info;  
			}

			
		}

			$resultObj = array_merge($result24,$resultObj); 
		return $resultObj;
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

	public function  getdate(){
		echo json_encode($this->getdatefrombase());
	}

	public function index()
	{
		$this->template->load('template', 'product/pricecal');
		//$this->load->view('welcome_message');
	}

	

}
