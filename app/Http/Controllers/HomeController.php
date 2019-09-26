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
        $warehouse_rent_rates = DB::table('warehouse_rent_rates')->where('status', 1)->get();

        $today_price = DB::table('today_prices')
                        ->join('commodity_name', 'commodity_name.id', '=', 'today_prices.commodity_id')
                        ->join('mandi_name', 'mandi_name.id', '=', 'today_prices.mandi_id')
                        ->select('today_prices.*', 'commodity_name.commodity as commodity', 'commodity_name.image', 'mandi_name.mandi_name as mandi_name')
                        ->where('today_prices.status', 1)
                        ->get();

        return view('welcome', array('today_prices' => $today_price, 'commodities' => $commodities, 'mandies' => $mandies, 'warehouse_rent_rates' => $warehouse_rent_rates));
    }

    // Get todays price mandi wise
    public function get_todays_price(Request $request){

        $mandi = $request->mandi;

        # Get todays price according to mandi
        $today_prices = DB::table('today_prices')
                        ->join('commodity_name', 'commodity_name.id', '=', 'today_prices.commodity_id')
                        ->join('mandi_name', 'mandi_name.id', '=', 'today_prices.mandi_id')
                        ->select('today_prices.*', 'commodity_name.commodity as commodity', 'commodity_name.image', 'mandi_name.mandi_name as mandi_name')
                        ->where(['today_prices.status' => 1, 'today_prices.mandi_id' => $mandi])
                        ->get();

        $html = '';
        foreach ($today_prices as $key => $row) {
            $html .= '<div class="item"><img class="iblock bline" src="resources/assets/upload/commodity/'.$row->image.'"><br><span class="iblock bline">&nbsp; '.$row->commodity.'</span><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td width="15"><i class="fa fa-arrow-alt-circle-right"></i></td><td><span>Modal</span></td><td width="10">:</td><td>'. $row->modal .' &nbsp;₹</td></tr><tr><td width="15"><i class="fa fa-arrow-alt-circle-right"></i></td><td><span>Max</span></td><td width="10">:</td><td> '.$row->max.' &nbsp;₹ </td></tr><tr><td width="15"><i class="fa fa-arrow-alt-circle-right"></i></td><td><span>Min</span></td><td width="10">:</td><td>'. $row->min .' &nbsp;₹</td></tr><tr><td colspan="4" class="text-center" style="font-weight: bold;background-color: gray;">'. $row->mandi_name .'</td></tr></tbody></table></div>';
        }

        echo $html;
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

                    $date = date('Y-m-d H:i:s');

                    $send_otp = DB::table('users')->where('phone', $request->phone)->update(['login_otp' => $otp, 'updated_at' => $date]);

                    $sms = 'Verify your mobile to login Apnagodam with OTP - '.$otp;

                    // send otp on mobile number using Helper
                    $done = sendotp($request->phone, $sms, $otp);
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
        $aadhar_name = '';
        $cheque_name = '';

        # If user profile image uploaded then
        if($request->hasFile('aadhar_image')) {

            $file = $request->aadhar_image;

            $aadhar_name = $file->getClientOriginalName();

            $ext = pathinfo($aadhar_name, PATHINFO_EXTENSION);

            $aadhar_name = substr(md5(microtime()),rand(0,26),6);

            $aadhar_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'png', 'gig', 'bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('farmer_register')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 2052030){
                $status = 'File size is too large. Please upload file less than 2MB !';
                return redirect('farmer_register')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/frontend_assets/uploads/';
            $file->move($destinationPath,$aadhar_name);
            $filepath = $destinationPath.$aadhar_name;
        }

        # If user profile image uploaded then
        if($request->hasFile('cheque_image')) {

            $file = $request->cheque_image;

            $cheque_name = $file->getClientOriginalName();

            $ext = pathinfo($cheque_name, PATHINFO_EXTENSION);

            $cheque_name = substr(md5(microtime()),rand(0,26),6);

            $cheque_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'png', 'gig', 'bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('farmer_register')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 2052030){
                $status = 'File size is too large. Please upload file less than 2MB !';
                return redirect('farmer_register')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/frontend_assets/uploads/';
            $file->move($destinationPath,$cheque_name);
            $filepath = $destinationPath.$cheque_name;
        }

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
                'aadhar_image' => $aadhar_name,
                'cheque_image' => $cheque_name,
                'power' => 1,
                'created_at' => $date,
                'updated_at' => $date,
                'status' => 1
            )
        );

        $admin_phone = DB::table('users')->where('id', 1)->first();

        //$mobiles = implode(",", $mobilesArr);
        $sms = 'Apna Godam - Recevied New Enquiry - '.$full_name;
        $success = sendsms($admin_phone->phone, $sms);

        //$mobiles = implode(",", $mobilesArr);
        $sms = 'Apna Godam - Successfully Registered !';
        $done = sendsms($phone, $sms);

        return redirect('farmer_login')->with('status', $sms);
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
        $success = sendsms($admin_phone->phone, $sms);

        //Send to User
        $sms1 = 'Apna Godam - Successfully Registered !';
        $done = sendsms($phone, $sms1);

        return redirect('trader_login')->with('status', $sms1);
    }

}
