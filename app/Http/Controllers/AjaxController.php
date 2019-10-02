<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class AjaxController extends Controller
{
    // OTP verification
    public function otpVerification(Request $request){

        $date = date('Y-m-d H:i:s');
        $otp = $request->otp;
        $exist_phone = $request->exist_phone;

        $check = DB::table('users')->where('phone', $exist_phone)->first();

        if(!empty($check)){

            if($check->login_otp == $otp){

                $response = 1;
            }else{

                $response = 2;
            }

        }else{

            $response = 0;
        }

        return response()->json($response);

        exit;
    }
    // OTP verification
    public function otpRegisterVerification(Request $request){

        $date = date('Y-m-d H:i:s');
        $otp = $request->otp;
        $exist_phone = $request->exist_phone;

        $check = DB::table('users')->where('phone', $exist_phone)->first();

        if(!empty($check)){

            if($check->register_otp == $otp){

                $response = 1;
            }else{

                $response = 2;
            }

        }else{

            $response = 0;
        }

        return response()->json($response);

        exit;
    }
	// OTP Resend
	public function otpResend(Request $request){

        $date = date('Y-m-d H:i:s');

        $otp = rand(100000, 999999);

        $send_otp = DB::table('users')->where('phone', $request->exist_phone)->update(['login_otp' => $otp, 'updated_at' => $date]);

         $sms = 'Verify your mobile to login Apnagodam with OTP - '.$otp;

        // send otp on mobile number using Helper
        $done = sendotp($request->exist_phone, $sms, $otp);

        return $done;

        exit;
    }

    // OTP Resend
    public function registerOTPResend(Request $request){

        $date = date('Y-m-d H:i:s');

        $otp = rand(100000, 999999);

        $send_otp = DB::table('users')->where('phone', $request->exist_phone)->update(['register_otp' => $otp, 'updated_at' => $date]);

         $sms = 'Verify your mobile to register Apnagodam with OTP - '.$otp;

        // send otp on mobile number using Helper
        $done = sendotp($request->exist_phone, $sms, $otp);

        return $done;

        exit;
    }

    // get Warehouse Distance from Current Locaion
    public function getWarehouseDistance(Request $request){
        $from_location = str_replace(" ,","-",$request->current_location);
        $to_address = str_replace(" ,","-",$request->to_address);
        
        $url = sprintf('https://maps.googleapis.com/maps/api/geocode/json?address=%s&key=%s', urlencode($to_address), urlencode('AIzaSyAB1vBRqGdwtdzsOOMeLf7mQLJ5PfVq-0s'));

        $response = file_get_contents($url);
        $output = json_decode($response, true);

        if(isset($output['results'][0]))
        {
            $latitude = $output['results'][0]['geometry']['location']['lat'];
            $longitude = $output['results'][0]['geometry']['location']['lng'];
        }

        $from = $from_location;
        $to = $to_address;
        $from = urlencode($from);
        $to = urlencode($to);
        $apiKey= "AIzaSyAB1vBRqGdwtdzsOOMeLf7mQLJ5PfVq-0s"; 
        $data = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&key=$apiKey&language=en-EN&sensor=false");
        $data = json_decode($data);
        echo $data->rows[0]->elements[0]->distance->text;
        exit;
    }

}
