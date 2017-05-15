<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Utils {
	function dateDiff ($d1, $d2) {
	// Return the number of days between the two dates:

	  return round((strtotime($d1)-strtotime($d2))/86400);

	}  // end function dateDiff
//The function returns the no. of business days between two dates and it skips the holidays
	function getWorkingDays($startDate,$endDate,$holidays){
	    // do strtotime calculations just once
	    $endDate = strtotime($endDate);
	    $startDate = strtotime($startDate);


	    //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
	    //We add one to inlude both dates in the interval.
	    $days = ($endDate - $startDate) / 86400 + 1;

	    $no_full_weeks = floor($days / 7);
	    $no_remaining_days = fmod($days, 7);

	    //It will return 1 if it's Monday,.. ,7 for Sunday
	    $the_first_day_of_week = date("N", $startDate);
	    $the_last_day_of_week = date("N", $endDate);

	    //---->The two can be equal in leap years when february has 29 days, the equal sign is added here
	    //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
	    if ($the_first_day_of_week <= $the_last_day_of_week) {
	        if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
	        if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
	    }
	    else {
	        // (edit by Tokes to fix an edge case where the start day was a Sunday
	        // and the end day was NOT a Saturday)

	        // the day of the week for start is later than the day of the week for end
	        if ($the_first_day_of_week == 7) {
	            // if the start date is a Sunday, then we definitely subtract 1 day
	            $no_remaining_days--;

	            if ($the_last_day_of_week == 6) {
	                // if the end date is a Saturday, then we subtract another day
	                $no_remaining_days--;
	            }
	        }
	        else {
	            // the start date was a Saturday (or earlier), and the end date was (Mon..Fri)
	            // so we skip an entire weekend and subtract 2 days
	            $no_remaining_days -= 2;
	        }
	    }

	    //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
	//---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it
	   $workingDays = $no_full_weeks * 5;
	    if ($no_remaining_days > 0 )
	    {
	      $workingDays += $no_remaining_days;
	    }

	    //We subtract the holidays
	    foreach($holidays as $holiday){
	        $time_stamp=strtotime($holiday);
	        //If the holiday doesn't fall in weekend
	        if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N",$time_stamp) != 6 && date("N",$time_stamp) != 7)
	            $workingDays--;
	    }

	    return $workingDays;
	}

	function postGetPrice($url, $data){
		$ch = curl_init();	
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_HTTPHEADER,array("Content-type: application/json"));
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		return $server_output;
	}
	function simpleNormalDistribution ($x){

	        $l = 0.0;
	        $k = 0.0;
	        $a1 = 0.31938153;
	        $a2 = -0.356563782;
	        $a3 = 1.781477937;
	        $a4 =  -1.821255978;
	        $a5 =  1.330274429;
	
	        $result = 0.0;
	
	        $l = abs($x);
	        $factor = 0.2316419;
	        $k = 1/(1+$factor*$l);
	        $formula1 = (1/sqrt(2*pi ()));
	        $formula2 = exp(-1* pow($l,2)/2);
	        $formula3 = $a1 * $k + $a2*pow($k,2)+$a3*pow($k,3)+$a4*pow($k,4)+$a5*pow($k,5);
	
	        $result =  1-$formula1 * $formula2 * $formula3;
	
	        if($x < 0){
	            $result= 1 - $result;
	        }
	        return $result;
	}
	function SNPDF ($X){ 
			$Pie = 3.14159265358979;
            return 1 / sqrt(2 * $Pie) * exp(-($X*$X)/ 2);
	}
	function VanillaPrice ( $S,  $X,  $r,  $sigma,  $T, $callOrPutFlag) {
 			$result;
 			if($T > 0){
		        $d1 = (log($S/$X) + ($r + $sigma * $sigma/2) * $T) / ($sigma * sqrt($T));
		        $d2 = $d1 - $sigma * sqrt($T);
		        $result = 0.0;
		        if('c' == $callOrPutFlag ){
		            $result = $S * $this->simpleNormalDistribution($d1)
		                    - $X * exp(-$r * $T) * $this->simpleNormalDistribution($d2);
		        }else if('p' == $callOrPutFlag){
		            $result = $X * exp(-$r * $T) * $this->simpleNormalDistribution(-1 * $d2)
		                    - $S * $this->simpleNormalDistribution(-1 * $d1);

		        }
		        return $result;
		    }else{
		    	$intrinsic = $S - $X;
		    	if($intrinsic <= 0){
		    		return 0;
		    	}else{
		    		return $S-$X;
		    	}
		    }
	}
	function VanillaDelta( $S,  $X,  $r,  $sigma,  $T, $callOrPutFlag) {
		     if($T > 0){
			    	$d1 = (log($S/$X) + ($r + $sigma * $sigma/2) * $T) / ($sigma * sqrt($T));
			    	if('c' == $callOrPutFlag ){
			            return  $this->simpleNormalDistribution($d1);
			        }else if('p' == $callOrPutFlag){
			            return  $this->simpleNormalDistribution($d1)-1;
			        }else{
			            return 0.0;
			        }
			}else{
			     	if($S-$X < 0 ){
			     		return 0;
			     	}else if($S-$X ==0){
			     		return 0.5;
			     	}else{
			     		return 1;
			     	}
			}
	}
	    //non-test method
	function VanillaTheta ( $S,  $X,  $r,  $sigma,  $T, $callOrPutFlag) {
	        $d1 = (log($S/$X) + ($r + $sigma * $sigma/2) * $T) / ($sigma * sqrt($T));
	        $d2 = $d1 - $sigma * sqrt($T);
	        if('c' == $callOrPutFlag ){
	            return  -$S * $this->SNPDF($d1) * $sigma/(2 * sqrt($T)) - $r * $X * exp(-$r*$T) * $this->simpleNormalDistribution($d2);
	            //Vanilla_Theta = -Spot * SNPDF(d1) * Vol / (2 * Sqr(TTM)) - RiskFree * Strike * Exp(-RiskFree * TTM) * SNCDF(d2)
	        }else if('p' == $callOrPutFlag){
	            return  -$S * $this->SNPDF($d1) * $sigma/(2 * sqrt($T)) + $r * $X * exp(-$r*$T) * $this->simpleNormalDistribution(-$d2);
	            //Vanilla_Theta = -Spot * SNPDF(d1) * Vol / (2 * Sqr(TTM)) + RiskFree * Strike * Exp(-RiskFree * TTM) * SNCDF(-d2)
	        }else{
	            return 0.0;
	        }
	}
	function VanillaGamma ( $S,  $X,  $r,  $sigma,  $T, $callOrPutFlag) {
	        $d1 = (log($S/$X) + ($r + $sigma * $sigma/2) * $T) / ($sigma * sqrt($T));
	        return  $this->simpleNormalDistribution($d1)/ ($S * $sigma *  sqrt($T));
	            //  Vanilla_Gamma = SNPDF(d1) / (Spot * Vol * Sqr(TTM))
	}
	function getSpreadPrice ($tmpPrice){
	    		$spread;
	    		 if($tmpPrice >=0 && $tmpPrice <=1.99){
				            $spread = 0.01;
		    	}else if($tmpPrice >=2 && $tmpPrice <=4.98){
		            $spread = 0.02;
			    }else if($tmpPrice >=4.99 && $tmpPrice <=10){
		            $spread = 0.05;
		    	}else if($tmpPrice >=10.01 && $tmpPrice <=24.9){
		            $spread = 0.1;
		        }else if($tmpPrice >=24.91 && $tmpPrice <=99.75){
		            $spread = 0.25;
		        }else if($tmpPrice >=99.76 && $tmpPrice <=199.5){
		       	 	$spread = 0.5;
			    }else if($tmpPrice >=199.51 && $tmpPrice <=399){
			    	$spread = 1;
			    }else if($tmpPrice >399){
			       $spread = 2;
			    }
			    return $spread;
	}
	function  getSharePrice ($price , $stepSize=0 ){

				$tmpPrice = 0.00;
				$spread;
				$multiple = 0.00;
				$tmpPrice = $price;
				if($stepSize >= 0){

				    if($tmpPrice >=0 && $tmpPrice < 2){
				       $multiple = 0.01;
				    }else if($tmpPrice >=2 && $tmpPrice <4.99){
				       $multiple = 0.02;
				    }else if($tmpPrice >=4.99 && $tmpPrice <10){
				       $multiple = 0.05;
				    }else if($tmpPrice  >=10 && $tmpPrice <25){
				       $multiple = 0.1;
				    }else if($tmpPrice >=25 && $tmpPrice <100){
				       $multiple = 0.25;
				    }else if($tmpPrice >=100 && $tmpPrice <200){
				       $multiple = 0.5;
				    }else if($tmpPrice >=200 && $tmpPrice <400){
				       $multiple = 1;
				    }else if($tmpPrice >=400){
				       $multiple = 2;
				    }
				         
				    $tmpPrice = round(round($tmpPrice / $multiple) * $multiple *100)/100;
				    for($i = 1 ; $i<= $stepSize; $i++){
				    
				         
				    	 if($tmpPrice >=0 && $tmpPrice <=1.99){
				            $spread = 0.01;
				    	}else if($tmpPrice >=2 && $tmpPrice <4.99){
				            $spread = 0.02;
					    }else if($tmpPrice >=4.99 && $tmpPrice <10){
				            $spread = 0.05;
				    	}else if($tmpPrice  >=10 && $tmpPrice <25){
				            $spread = 0.1;
				        }else if($tmpPrice >=25 && $tmpPrice <100){
				            $spread = 0.25;
				        }else if($tmpPrice >=100 && $tmpPrice <200){
					       $spread = 0.5;
					    }else if($tmpPrice >=200 && $tmpPrice <400){
					       $spread = 1;
					    }else if($tmpPrice >=400){
					       $spread = 2;
					    }
				         $tmpPrice = $tmpPrice + $spread;
				         
				    }
				}else{
				    
				    if($tmpPrice >=0 && $tmpPrice <=2){
				       $multiple = 0.01;
				    }else if($tmpPrice >=2.01 && $tmpPrice <5.01){
				       $multiple = 0.02;
				    }else if($tmpPrice >=5.01 && $tmpPrice <=10.01){
				       $multiple = 0.05;
				    }else if($tmpPrice >=10.02 && $tmpPrice <=25){
				       $multiple = 0.1;
				    }else if($tmpPrice >=25.01 && $tmpPrice <=100){
				       $multiple = 0.25;
				    }else if($tmpPrice >=100.01 && $tmpPrice <=200){
				       $multiple = 0.5;
				    }else if($tmpPrice >=200.01 && $tmpPrice <=400){
				       $multiple = 1;
				    }else if($tmpPrice >400){
				       $multiple = 2;
				    }
				    
				   $tmpPrice = round(round($tmpPrice / $multiple) * $multiple *100)/100;
				     for($i = 1 ; $i<= abs($stepSize); $i++){
				    
				    	if($tmpPrice >=0 && $tmpPrice <=2){
				            $spread = 0.01;
				    	}else if($tmpPrice >=2.01&& $tmpPrice <5.01){
				            $spread = 0.02;
					    }else if($tmpPrice >=5.01  && $tmpPrice <=10.01){
				            $spread = 0.05;
				    	}else if($tmpPrice  >=10.02 && $tmpPrice <=25){
				            $spread = 0.1;
				        }else if($tmpPrice >=25.25 && $tmpPrice <=100){
				            $spread = 0.25; 
				        }else if($tmpPrice >=100.5 && $tmpPrice <=200){
				       	 	$spread = 0.5;
					    }else if($tmpPrice >=201 && $tmpPrice <=400.01){
					    	$spread = 1;
					    }else if($tmpPrice >400){
					       $spread = 2;
					    }
				         $tmpPrice = $tmpPrice - $spread;
				         
				    }
				    
				}

				return $tmpPrice;

		}
		function gearing ($delta,$spotBid,$conversion,$theoprice){
			return  round(((($delta * $spotBid)/$conversion)/$theoprice),2);
		}
		function sensitivity ($delta,$spreadbid,$conversion,$spreaddw){
			return  round(($delta * $spreadbid/($conversion * $spreaddw)),2);
		}
		function timedecay ($theta,$theoprice,$conversion,$workdayYear){
			return  round($theta * 100/($conversion * $theoprice * $workdayYear),2);
		}
		function timevalue($theta,$conversion,$workdayYear){
			return  $theta /($conversion  * $workdayYear);
		}
}