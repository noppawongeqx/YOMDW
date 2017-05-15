<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bs{
        function Sgn ($x){
            if($x > 0) return 1;
            else if($x < 0) return -1;
            else return 0;
        }
        function NormOrdinate ($z){
            //'The normal ordinate (probability density function)
            //'For the normal integral (cumulative distribution function)
            //'we use Application.NormSDist
            //'For standalone visual basic applications the function NormalCDF
            //'from the module CumNormal can be used
         return exp(-0.5 * $z * $z) / sqrt(2 * 3.141592653589793);
        }
        function SafeD1 ($s , $x , $r, $Sigma , $t ){
            //'This computes the BlackScholes quantity d1 safely i.e.
            //'no division by zero and no log of zero
           $vHigh = 100.00;
            if($Sigma == 0 || $t == 0) {
                $s0 = $s * exp(($r + ($Sigma* $Sigma) / 2) * $t);
                if ($s0 > $x) { return $vHigh ;}
                if ($s0 < $x) { return -$vHigh ;}
                if ($s0 = $x) { return 0.0 ; }
            }else{
                if($x == 0){
                    return $vHigh;
                }else{
                    //'Below is the BlackScholes formula for d1
                    return (log($s / $x) + ($r + ($Sigma* $Sigma) / 2) * $t) / ($Sigma * sqrt($t));
                }
            }
        }
        function sndf ($x){

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
                    $formula1 = (1/sqrt(2*pi()));
                    $formula2 = exp(-1* pow($l,2)/2);
                    $formula3 = $a1 * $k + $a2*pow($k,2)+$a3*pow($k,3)+$a4*pow($k,4)+$a5*pow($k,5);
            
                    $result =  1-$formula1 * $formula2 * $formula3;
            
                    if($x < 0){
                        $result= 1 - $result;
                    }
                    return $result;
        }
        function BSCallVega ($s , $x , $r , $Sigma , $t ) {
        //'Black Scholes call vega
            $d1 = $this->SafeD1($s, $x, $r, $Sigma, $t);
            return $s * sqrt($t) * $this->NormOrdinate($d1);
        }
        function BSCall ($s , $x , $r , $Sigma , $t ) {
        //'Black Scholes call price 
            $d1 = $this->SafeD1($s, $x, $r, $Sigma, $t);
            $d2 = $d1 - $Sigma * sqrt($t);
        //'For standalone visual basic applications, replace Application.NormSDist by
        //'the function NormalCDF from the module CumNormal
         return $s * $this->sndf($d1) - $x * exp(-$r * $t) * $this->sndf($d2);
        }
        function BSImpliedApprox ($s , $x0 , $r , $price0 , $t, $PutOpt){
            // 'Compute an approximate implied volatility
            // 'This approximation can be useful in its own right for
            // 'at or near money options
            // 'In this module, it is used as the starting point for
            // 'Newton Raphson iterations in function BSImplied_0
           // $Pi , Root2Pi , SplusX , SminusX , Radical , SigmaRootT , price , x , H , Temp;
            // 'discount the exercise price to eliminate r
            $x = $x0 * exp(-$r * $t);
            //'use put call parity to convert put option into call option
            if($PutOpt){
                $price = $price0 + $s - $x;
            }else{
                $price = $price0;
            }
            $SminusX = $s - $x;
            $SplusX = $s + $x;
            //'We use a Taylor series approximation similar to
            //'Brenner, H. and Subrahmanyam, M. G. (1994), "A simple approximation to option valuation
            //'and hedging in the Black Scholes model", Financial Analysts Journal, Mar-Apr 1994, 25-28
            //'Basically we eliminate r by discounting the exercise price as above and then
            //'approximate log(s/x) as 2(s-x)/(s+x) = SminusX(s-x)/H
            //'where SminusX = s-x and H=(s+x)/2.
            //'We then approximate the normal integral by a Taylor series
            //'If price is the call price, this gives the approximation
            //'price/H = SigmaRootT(1/Root2Pi +SminusX/(2*H*SigmaRootT)
            //'                           +SminusX^2/(2*H^2*SigmaRootT^2*Root2Pi)
            //'Letting z=SigmaRootT*H/Root2Pi, this yields a quadratic equation for z:
            //'z^2 - (price-SminusX/2)*z +SminusX^2/(4*Pi) = 0
            //'The solution is
            //'z = (price - SminusX/2)/2 + Radical
            //'where Radical is the square root of (price-SminusX/2)^2 - SminusX^2/Pi
            //'The linear approximation is obtained by dropping the constant to give the linear equation:
            //'z = (price-SminusX/2)
            //'
            $Pi = 3.141592653589793;
            //'pi = 3.141592653589793
            $Root2Pi = sqrt(2 * $Pi);
            $H = 0.5 * $SplusX;
            $Temp = ($price - 0.5 * $SminusX);
            $Radical = ($Temp * $Temp)- ($SminusX * $SminusX) / $Pi;
            if($Radical < 0){
                //'Try Linear Approximation
                $SigmaRootT = ($Root2Pi / $H) * $Temp;
            }else{
                //'Try Quadratic Approximation
                $Radical = sqrt($Radical);
                $SigmaRootT = ($Root2Pi / $H) * ($Temp / 2 + $Radical);
            }
          return $SigmaRootT / sqrt($t);
        }
        function BSImplied_0 ($s , $x0 , $r , $price0, $t, $PutOpt){
            //'Computes implied volatility from call price (if PutOpt is false)
            //'or from put price (if PutOpt is true)
            //'
            //'This function returns a DoubleWithStatusString in which
            //'Value contains the estimated implied volatility
            //'Status contains the status of the estimate:
            //'"undefined" if the implied is undefined
            //'"success" if the iterations converges
            //'"error" if iterations do not converge
            //'If Status is not "success",  then caller must
            //'use a function like BSCallImpliedError to report a
            //'more meaningful error status
            //$Pi , Root2Pi , SplusX , SminusX , Radical , SigmaRootT , AbsErr , RelErr , Iter , Vega , Step,
           // Sigma, OldErr, Factor, TrySigma , price , LineCount , x , PredImpr  , H , Temp 
            $Eps = 0.000001;
            $Eta = 0.000001;
            $MaxIter = 20;
            $Zero = 0.0;
            $MaxSigma = 100.0;
           try{
                //On Error GoTo ErrHndlr
                //'discount the exercise price to eliminate r
                $x = $x0 * exp(-$r * $t);
                if($PutOpt){
                    $price = $price0 + $s - $x;
                }else{
                    $price = $price0;
                }
                $SminusX = $s - $x;
                $SplusX = $s + $x;
                //'price must be at least intrinsic value (Max(SminusX,0)) and cannot exceed s
                if($price < $SminusX || $price < 0 || $price > $s ){
                    // BSImplied_0.Value = 0
                    // BSImplied_0.Status = "undefined"
                    // Exit function
             
                    return array("value"=>0.0, "status"=>"undefined");
                }
                if($price == $SminusX || $price == 0){
                //'if price equals intrinsic value, volatility is zero
                    // BSImplied_0.Value = 0.0
                    // BSImplied_0.Status = "success"

                    return  array("value"=>0.0, "status"=>"success");
                }
                if( $x == 0 ) {
                //and price <> s is implicit here 
                //'if x is 0, option is same as stock
                   // BSImplied_0.Value = 0
                   // BSImplied_0.Status = "undefined"
                    echo "case2";

                   return array("value"=>0.0, "status"=>"undefined");
                }
                //'We use an approximate value of sigma to start the
                //'Newton-Raphson iterations
                $Sigma = $this->BSImpliedApprox($s, $x0, $r, $price0, $t, $PutOpt);
                if($this->BSCallVega($s, $x, 0, $Sigma, $t) == 0.0){
   
                echo $t;
                //'Newton-Raphson iterations cannot proceed if vega is zero
                //'So we choose a starting point where vega is likely to be high
                    $Sigma = sqrt(2 * abs(log($s * exp($r * $t) / $x))) / sqrt($t);
                    //' the point of maximum vega is where d1 is close to 0
                    //' d1 = a/s + s/2 where a = ln(s*exp(rt)/x)
                    //' if a < 0 then the above value of s sets d1 to 0
                    //' else it sets it to its min value of root a/2
                }
                if($this->BSCallVega($s, $x, 0, $Sigma, $t) == 0 && $s > $x && $price > $SminusX){
                    // BSImplied_0.Value = Sigma
                    // BSImplied_0.Status = "error"
                    return array("value"=>$Sigma,"status"=>"error");
                }
                //'Start Newton-Raphson Iterations
                $Iter = 0;
                $LineCount = 0;
                $OldErr = $price - $this->BSCall($s, $x, 0, $Sigma, $t);
                //'The first "step" is a zero step
                $Step = 0.0;
                $Factor = 0.0;
                $PredImpr = 0.0;
                //console.log('OldErr'+OldErr);
                do {
                    do {
                       // 'In this loop we reduce the step size if necessary to ensure
                       // 'that the actual change in the price is not too different from
                       // 'what is predicted by the vega
                       $LineCount = $LineCount + 1;
                       $TrySigma = $Sigma + $Step * $Factor;
                       $AbsErr = $price - $this->BSCall($s, $x, 0, $TrySigma, $t);
                       $Vega = $this->BSCallVega($s, $x, 0, $TrySigma, $t);
                       $Factor = $Factor / 2;
                       if($LineCount > 10){
                            //BSImplied_0.Value = Sigma
                            //BSImplied_0.Status = "error"
                            //Exit Function
                            return array("value"=>$Sigma,"status"=>"error");
                        }
                     }while ($Vega == 0.0 || abs($AbsErr) - abs($OldErr) > 0.5 * $PredImpr * $Factor);
                        $Sigma = $TrySigma;
                        $RelErr = $AbsErr / $price0;
                        $Iter = $Iter + 1;
                    //' do not permit a step exceeding MaxSigma
                    if(abs($AbsErr) > $MaxSigma * abs($Vega)){
                        $Step = $this->Sgn($AbsErr) * $MaxSigma / $this->Sgn($Vega);
                    }else{
                        //'This is the Newton step
                        $Step = $AbsErr / $Vega;
                    }
                    //'do not permit sigma to go negative
                    $Step =max($Step, -0.99 * $Sigma);
                    $OldErr = $AbsErr;
                    $PredImpr = abs($Step * $Vega);
                    $Factor = 1.0;
                    //'the termination condition is
                    //'a low absolute error
                    //'or a low relative error
                    //'or non convergence within MaxIter iterations
                }while (abs($AbsErr) > $Eps && abs($RelErr) > $Eta && $Iter < $MaxIter);
                   $result = array("value"=>$Sigma);
                    if(abs($AbsErr) > $Eps && abs($RelErr) > $Eta){
                        $result["status"] = "error";
                    }else{
                        $result["status"] = "success";
                    }
                    return $result;
            }catch( Exception $e ) {
                //echo json_encode()
               return array("value"=>$Sigma,"status"=>"error");
            }
        }
}