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

}
