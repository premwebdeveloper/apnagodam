<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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

        $commodities = DB::table('commodity_name')->where('status', 1)->get();

        $mandies = DB::table('mandi_name')->where('status', 1)->get();

        $today_price = DB::table('today_prices')
                        ->join('commodity_name', 'commodity_name.id', '=', 'today_prices.commodity_id')
                        ->join('mandi_name', 'mandi_name.id', '=', 'today_prices.mandi_id')
                        ->select('today_prices.*', 'commodity_name.commodity as commodity', 'commodity_name.image', 'mandi_name.mandi_name as mandi_name')
                        ->where('today_prices.status', 1)
                        ->get();

        return view('welcome', array('today_prices' => $today_price, 'commodities' => $commodities, 'mandies' => $mandies));
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

    // Farmer Login
    public function farmer_login()
    {
        return view('auth.farmer_login');
    }

    // Farmer Register
    public function farmer_register()
    {
        return view('auth.farmer_register');
    }

    // Farmer Registration
    public function farmer_registration(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            //'email' => 'nullable|unique:users',
            'phone' => 'required|numeric|digits:10|unique:users',
        ]);

        $date = date('Y-m-d H:i:s');
        $full_name = $request->fname;
        $phone = $request->phone;
        $role_id = $request->role_id;
        $father_name = $request->father_name;
        $aadhar = $request->aadhar;
        $village = $request->village;
        $district = $request->district;
        $bank_name = $request->bank_name;
        $bank_branch = $request->bank_branch;
        $bank_acc_no = $request->bank_acc_no;
        $bank_ifsc_code = $request->bank_ifsc_code;
        
        $user = User::create([
            'fname' => $full_name,
            //'email' => $data['email'],
            'phone' => $phone,
            'password' => Hash::make(123456),
            'status' => 1
        ]);

        $user_id = $user->id;

        // Create User role
        $user_role = DB::table('user_roles')->insert(
            array(
                'role_id' => $role_id,
                'user_id' => $user_id,
                'created_at' => $date,
                'updated_at' => $date
            )
        );

        // Create User Details
        $user_details = DB::table('user_details')->insert(
            array(
                'user_id' => $user_id,
                'fname' => $full_name,
                'phone' => $phone,
                'father_name' => $father_name,
                'aadhar_no' => $aadhar,
                'village' => $village,
                'district' => $district,
                'bank_name' => $bank_name,
                'bank_branch' => $bank_branch,
                'bank_acc_no' => $bank_acc_no,
                'bank_ifsc_code' => $bank_ifsc_code,
                'image' => "user.png",
                'power' => 1,
                'created_at' => $date,
                'updated_at' => $date,
                'status' => 1
            )
        );

        $admin_phone = DB::table('users')->where('id', 1)->first();

        // send otp on mobile number using curl
        $url = "http://bulksms.dexusmedia.com/sendsms.jsp";                    
        //$mobiles = implode(",", $mobilesArr);
        $sms = 'Apna Godam - Recevied New Enquiry - '.$full_name;

        $params1 = array(
                    "user" => "apnagodam",
                    "password" => "45cfd8bb21XX",
                    "senderid" => "apnago",
                    "mobiles" => $admin_phone->phone,
                    "sms" => $sms
                    );   

        $params1 = http_build_query($params1);            

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);

        //$mobiles = implode(",", $mobilesArr);
        $sms1 = 'Apna Godam - Successfully Registered !';

        $params = array(
                    "user" => "apnagodam",
                    "password" => "45cfd8bb21XX",
                    "senderid" => "apnago",
                    "mobiles" => $phone,
                    "sms" => $sms1
                    );

        $params = http_build_query($params);            

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);

        return redirect('farmer_login')->with('status', $sms1);
    }

    // Trader Register
    public function trader_register()
    {
        return view('auth.trader_register');
    }

    // Trader Login
    public function trader_login()
    {
        return view('auth.trader_login');
    }

    // Trader Registration
    public function trader_registration(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            //'email' => 'nullable|unique:users',
            'phone' => 'required|numeric|digits:10|unique:users',
        ]);

        $date = date('Y-m-d H:i:s');
        $full_name = $request->fname;
        $phone = $request->phone;
        $role_id = $request->role_id;
        $firm_name = $request->firm_name;
        $address = $request->address;
        $mandi_license = $request->license;
        $gst = $request->gst;
        
        $user = User::create([
            'fname' => $full_name,
            //'email' => $data['email'],
            'phone' => $phone,
            'password' => Hash::make(123456),
            'status' => 1
        ]);

        $user_id = $user->id;

        // Create User role
        $user_role = DB::table('user_roles')->insert(
            array(
                'role_id' => $role_id,
                'user_id' => $user_id,
                'created_at' => $date,
                'updated_at' => $date
            )
        );

        // Create User Details
        $user_details = DB::table('user_details')->insert(
            array(
                'user_id' => $user_id,
                'fname' => $full_name,
                'phone' => $phone,
                'firm_name' => $firm_name,
                'address' => $address,
                'mandi_license' => $mandi_license,
                'gst_number' => $gst,
                'image' => "user.png",
                'power' => 1,
                'created_at' => $date,
                'updated_at' => $date,
                'status' => 1
            )
        );

        $admin_phone = DB::table('users')->where('id', 1)->first();

        // send otp on mobile number using curl
        $url = "http://bulksms.dexusmedia.com/sendsms.jsp";                    
        //$mobiles = implode(",", $mobilesArr);
        $sms = 'Apna Godam - Recevied New Enquiry - '.$full_name;

        $params1 = array(
                    "user" => "apnagodam",
                    "password" => "45cfd8bb21XX",
                    "senderid" => "apnago",
                    "mobiles" => $admin_phone->phone,
                    "sms" => $sms
                    );   

        $params1 = http_build_query($params1);            

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);

        //$mobiles = implode(",", $mobilesArr);
        $sms1 = 'Apna Godam - Successfully Registered !';

        $params = array(
                    "user" => "apnagodam",
                    "password" => "45cfd8bb21XX",
                    "senderid" => "apnago",
                    "mobiles" => $phone,
                    "sms" => $sms1
                    );

        $params = http_build_query($params);            

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);

        return redirect('trader_login')->with('status', $sms1);
    }

}
