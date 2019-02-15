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
	// OTP Resend
	public function otpResend(Request $request){

        $date = date('Y-m-d H:i:s');

        $otp = rand(100000, 999999);

        $date = date('Y-m-d H:i:s');

        $send_otp = DB::table('users')->where('phone', $request->exist_phone)->update(['login_otp' => $otp, 'updated_at' => $date]);

        // send otp on mobile number using curl
        $url = "http://bulksms.dexusmedia.com/sendsms.jsp";

        //$mobiles = implode(",", $mobilesArr);
        $sms = 'Verify your mobile to login Apnagodam with OTP - '.$otp;

        $params = array(
                    "user" => "apnagodam",
                    "password" => "45cfd8bb21XX",
                    "senderid" => "apnago",
                    "mobiles" => $request->phone,
                    "sms" => $sms
                    );

        $params = http_build_query($params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);

        return response()->json($result);

        exit;
    }

}
