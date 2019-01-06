<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // construct function
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today_price =   DB::table('today_prices')
                        ->where('status', 1)
                        ->get();
        return view('welcome', array('today_prices' => $today_price));
    }

    // send otp and verify otp function 
    public function verifyOtp(Request $request){

        //dd($request);

        if(!empty($request->phone)){

            # Set validation for
            $this->validate($request, [
                'phone' => 'required|numeric|digits:10',
            ]);

            $exist = DB::table('users')->where(['phone' => $request->phone, 'status' => 1])->first();

            if(!empty($exist)){

                $otp = rand(100000, 999999);

                if(is_null($exist->login_otp)){

                    $send_otp = DB::table('users')->where('phone', $request->phone)->update(['login_otp' => $otp]);

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
                }

                return view('auth.login', array('otp' => $otp, 'exist_phone' => $request->phone ));

            }else{

                return Redirect::back()->withErrors(['This phone number is not exist in our record ! Please try with another phone number.']);
            }
        }else{
            return redirect('/login');
        }
    }

    // privacy policy
    public function privacy_policy()
    {
        return view('website_pages.privacy_policy');
    }

    // Terms & Conditions
    public function terms_conditions()
    {
        return view('website_pages.terms-conditions');
    }

    // About Us
    public function about_us()
    {
        return view('website_pages.aboutus');
    }

    // Our Team
    public function our_team()
    {
        return view('website_pages.ourteam');
    }

    // Our Team
    public function contact_us()
    {
        return view('website_pages.contact-us');
    }

}
