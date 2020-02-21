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
        $commodities = DB::table('categories')->where('status', 1)->get();

        $terminals = DB::table('warehouses')->where('status', 1)->get();
        $warehouse_rent_rates = DB::table('warehouse_rent_rates')->where('status', 1)->get();

        $today_price = DB::table('today_prices')
                        ->join('warehouses', 'warehouses.id', '=', 'today_prices.terminal_id')
                        ->leftjoin('categories', 'categories.id', '=', 'today_prices.commodity_id')
                        ->select('today_prices.*', 'categories.category as commodity', 'categories.image', 'warehouses.name as terminal_name')
                        ->where('today_prices.status', 1)
                        ->get();
       
        return view('welcome', array('today_prices' => $today_price, 'commodities' => $commodities, 'terminals' => $terminals, 'warehouse_rent_rates' => $warehouse_rent_rates));
    }

    // Get todays price mandi wise
    public function get_todays_price(Request $request){

        $mandi = $request->mandi;

        # Get todays price according to mandi
        $today_prices = DB::table('today_prices')
                        ->join('categories', 'categories.id', '=', 'today_prices.commodity_id')
                        ->join('warehouses', 'warehouses.id', '=', 'today_prices.terminal_id')
                        ->select('today_prices.*', 'categories.category as commodity', 'categories.image', 'warehouses.name as warehouse_name')
                        ->where(['today_prices.status' => 1, 'today_prices.mandi_id' => $mandi])
                        ->get();

        $html = '';
        foreach ($today_prices as $key => $row) {
            $html .= '<div class="item"><img class="iblock bline" src="resources/assets/upload/commodity/'.$row->image.'"><br><span class="iblock bline">&nbsp; '.$row->commodity.'</span><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td width="15"><i class="fa fa-arrow-alt-circle-right"></i></td><td><span>Modal</span></td><td width="10">:</td><td>'. $row->modal .' &nbsp;₹</td></tr><tr><td width="15"><i class="fa fa-arrow-alt-circle-right"></i></td><td><span>Max</span></td><td width="10">:</td><td> '.$row->max.' &nbsp;₹ </td></tr><tr><td width="15"><i class="fa fa-arrow-alt-circle-right"></i></td><td><span>Min</span></td><td width="10">:</td><td>'. $row->min .' &nbsp;₹</td></tr><tr><td colspan="4" class="text-center" style="font-weight: bold;background-color: gray;">'. $row->warehouse_name .'</td></tr></tbody></table></div>';
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

                if(is_null($exist->login_otp) || empty($exist->login_otp)){
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

    //Update OTP after Register
    public function registerLogin(Request $request)
    {
        if(Auth::user()){
            redirect('/');
        }

        $date = date('Y-m-d H:i:s');
        $phone = $request->phone;

        //Generate Referral Code
        $referral_code = 'R'.strtoupper(substr(md5(time()), 0, 5));

        $update = DB::table('users')->where('phone', $phone)->update(['register_otp' => null, 'status' => 1, 'updated_at' => $date]);

        $updates = DB::table('user_details')->where('phone', $phone)->update(['status' => 1, 'referral_code' => $referral_code, 'updated_at' => $date]);

        $status = 'Registration Successful. You can login now.';

        $admin_phone = DB::table('users')->where('id', 1)->first();

        //$mobiles = implode(",", $mobilesArr);
        $sms = 'Apna Godam - Recevied New Enquiry';
        $success = sendsms($admin_phone->phone, $sms);

        //$mobiles = implode(",", $mobilesArr);
        $sms = 'Apna Godam - Successfully Registered !';
        $done = sendsms($phone, $sms);

        $info_msg = 'Congratulations!';
        return redirect('/login')->with('info_msg', $info_msg);
        
    }

    //Warehouse Enquiry
    public function warehouse_enquiry(Request $request)
    {
        $request->validate([
            'commodity' => 'required',
            'quantity' => 'required',
            'mobile' => 'required',
            'commitment' => 'required',
        ]);

        $date         = date('Y-m-d H:i:s');
        $commodity    = $request->commodity;
        $quantity     = $request->quantity;
        $mobile       = $request->mobile;
        $commitment   = $request->commitment;
        $warehouse_id = $request->warehouse_id;

        // Create Warehouse Enquiry
        $insert_enquiry = DB::table('warehouse_enquirers')->insert(
            array(
                'warehouse_id' => $warehouse_id,
                'commodity'    => $commodity,
                'quantity'     => $quantity,
                'mobile'       => $mobile,
                'commitment'   => $commitment,
                'status'       => 1,
                'created_at'   => $date,
                'updated_at'   => $date
            )
        );

        $status = 'Enquiry submmitted Successfully';
        return redirect('terminal_view/'.$warehouse_id)->with('status', $status);
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

    // Qualiity Variance Calculator
    public function qualiity_variance_calculator()
    {
        return view('website_pages.qualiity_variance_calculator');
    }


    // Our Team
    public function our_team()
    {
        return view('website_pages.ourteam');
    }

    // Our Team
    public function our_warehoue()
    {

        $warehouses = DB::table('warehouses')
                        ->join('warehouse_rent_rates','warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
                        ->where('warehouses.status', 1)
                        ->select('warehouses.*', 'warehouse_rent_rates.address', 'warehouse_rent_rates.location', 'warehouse_rent_rates.area', 'warehouse_rent_rates.district', 'warehouse_rent_rates.area_sqr_ft', 'warehouse_rent_rates.rent_per_month', 'warehouse_rent_rates.capacity_in_mt', 'warehouse_rent_rates.nearby_transporter_info', 'warehouse_rent_rates.nearby_mandi_info', 'warehouse_rent_rates.nearby_crop_info')
                        ->get();

        return view('website_pages.ourwharehouse', array('warehouses' => $warehouses));
    }

    // Our Team
    public function contact_us()
    {
        return view('website_pages.contact-us');
    }

    // Our Team
    public function faq()
    {
        return view('website_pages.faq');
    }

    // Farmer Login
    public function farmer_login()
    {
        if(Auth::user()){
            redirect('/');
        }
        return view('auth.farmer_login');
    }

    // Farmer Register
    public function farmer_register()
    {
        if(Auth::user()){
            redirect('/');
        }
        //Get State
        $state = DB::table('states')->get();
        $states = array();
        foreach($state as $key => $value)
        {
            $states[$value->name] = $value->name;
        }

        return view('auth.farmer_register', array('states' => $states));
    }

    // Farmer Registration
    public function farmer_registration(Request $request)
    {
        if(Auth::user()){
            redirect('/');
        }
        $request->validate([
            'phone' => 'required|numeric|digits:10',
            'email' => 'email',
            'fname' => 'required|string|max:255',
            'aadhar' => 'required|numeric|digits:12',
            'father_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'bank_branch' => 'required|string|max:255',
            'bank_acc_no' => 'required|max:18',
            'bank_ifsc_code' => 'required|string|max:255',
            'aadhar_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'cheque_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        //Check Phone Number is already exist
        $phone = $request->phone;
        $check_phone = DB::table('users')->where('phone', $phone)->first();

        $data = array();
        $data['email'] = $email = $request->email;
        $data['full_name'] = $full_name = $request->fname;
        $data['father_name'] = $father_name = $request->father_name;
        $data['aadhar'] = $aadhar = $request->aadhar;
        $data['address'] = $address = $request->address;
        $data['area_vilage'] = $area_vilage = $request->area_vilage;
        $data['district'] = $district = $request->district;
        $data['state'] = $state = $request->state;
        $data['pincode'] = $pincode = $request->pincode;
        $data['user_type'] = $user_type = $request->user_type;
        $data['bank_name'] = $bank_name = $request->bank_name;
        $data['bank_branch'] = $bank_branch = $request->bank_branch;
        $data['bank_acc_no'] = $bank_acc_no = $request->bank_acc_no;
        $data['bank_ifsc_code'] = $bank_ifsc_code = $request->bank_ifsc_code;
        $data['ref_referral_code'] = $ref_referral_code = $request->ref_referral_code;

        $otp = null;

        if(!empty($check_phone->register_otp) && $check_phone->status == 0)
        {
            $otp = $check_phone->register_otp;

        }else{
            $request->validate([
                'phone' => 'unique:users',
            ]);

            $role_id = $request->role_id;
            $otp = rand(100000, 999999);
            $date = date('Y-m-d H:i:s');

            $aadhar_name = '';
            $cheque_name = '';

            //Check Data Security
            $checked = xss_clean($data);

            if(!empty($ref_referral_code))
            {
                //Check Referral Code Is Exist or not
                $check_referral_code = DB::table('user_details')->where('referral_code', $ref_referral_code)->first();

                if(!$check_referral_code)
                {
                    $error = 'Referral Code is wrong! enter valid Referral Code';
                    return redirect('farmer_register')->with('error', $error);
                }
            }

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
                'email' => $email,
                'phone' => $phone,
                'register_otp' => $otp,
                'password' => Hash::make(123456),
                'status' => 0
            ]);

            $user_id = $user->id;

            // Create User role
            $user_role = DB::table('user_roles')->insert(
                array(
                    'role_id' => 2,
                    'user_id' => $user_id,
                    'created_at' => $date,
                    'updated_at' => $date
                )
            );

            // Create User Details
            $user_details = DB::table('user_details')->insert(
                array(
                    'user_id' => $user_id,
                    'user_type' => $user_type,
                    'email' => $email,
                    'fname' => $full_name,
                    'phone' => $phone,
                    'father_name' => $father_name,
                    'aadhar_no' => $aadhar,
                    'address' => $address,
                    'area_vilage' => $area_vilage,
                    'city' => $district,
                    'state' => $state,
                    'pincode' => $pincode,
                    'bank_branch' => $bank_branch,
                    'bank_acc_no' => $bank_acc_no,
                    'bank_ifsc_code' => $bank_ifsc_code,
                    'image' => "user.png",
                    'aadhar_image' => $aadhar_name,
                    'cheque_image' => $cheque_name,
                    'referral_by' => $ref_referral_code,
                    'power' => 1,
                    'created_at' => $date,
                    'updated_at' => $date,
                    'status' => 0
                )
            );
            $admin_phone = DB::table('users')->where('id', 1)->first();
        }

        $sms = 'Verify your mobile to register on ApnaGodam with OTP - '.$otp;
        // send otp on mobile number using Helper
        $done = sendotp($phone, $sms, $otp);

        return view('auth.farmer_register_otp', array('otp' => $otp, 'exist_phone' => $phone ));

        //return redirect('farmer_login')->with('status', $sms);
    }

    // Trader Register
    public function trader_register()
    {
        if(Auth::user()){
            redirect('/');
        }
        //Get State
        $state = DB::table('states')->get();
        $states = array();
        foreach($state as $key => $value)
        {
            $states[$value->name] = $value->name;
        }
        return view('auth.trader_register', array('states' => $states));
    }

    // Trader Login
    public function trader_login()
    {
        if(Auth::user()){
            redirect('/');
        }
        return view('auth.trader_login');
    }

    // Trader Login
    public function terminal_view(Request $request)
    {
        $id = $request->id;

        // Get warehouse details by id
        // Get warehouse details by id
        $warehouse = DB::table('warehouses')
                        ->join('warehouse_rent_rates','warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
                        ->join('districts','districts.id', '=', 'warehouse_rent_rates.district')
                        ->join('states','states.code', '=', 'warehouse_rent_rates.state')
                        ->where('warehouses.status', 1)
                        ->where('warehouses.id', $id)
                        ->select('warehouses.*', 'warehouse_rent_rates.address', 'warehouse_rent_rates.location', 'warehouse_rent_rates.area', 'districts.name as district',  'states.name as state', 'warehouse_rent_rates.area_sqr_ft', 'warehouse_rent_rates.rent_per_month', 'warehouse_rent_rates.capacity_in_mt', 'warehouse_rent_rates.nearby_transporter_info', 'warehouse_rent_rates.nearby_mandi_info', 'warehouse_rent_rates.nearby_crop_info')
                        ->first();

        $facility_available = '';
        if(!empty($warehouse->facility_ids))
        {
            $facilities = json_decode($warehouse->facility_ids);
            if($facilities)
            {
                foreach ($facilities as $key => $facility) {

                    $facility_name = DB::table('facilitiy_master')->where('id', $facility)->first();
                    $facility_available .= $facility_name->name.', ';
                }
            }
        }
        $warehouse->{'facility_available'} = $facility_available;

        $bank_provide_loan = '';
        if(!empty($warehouse->bank_ids))
        {
            $banks = json_decode($warehouse->bank_ids);
            if($banks)
            {
                foreach ($banks as $key => $bank) {

                    $bank_name = DB::table('bank_master')->where('id', $bank)->first();
                    $bank_provide_loan .= $bank_name->bank_name.', ';
                }
            }
        }
        $warehouse->{'bank_provide_loan'} = $bank_provide_loan;

        //Get All Commodity
        $commodities = DB::table('categories')->where('status', 1)->get();

        return view('website_pages.warehouse_view', array('terminal' => $warehouse, 'commodities' => $commodities));
    }

    // Trader Registration
    public function trader_registration(Request $request)
    {
        if(Auth::user()){
            redirect('/');
        }
        //Check Phone Number is already exist
        $phone = $request->phone;
        $check_phone = DB::table('users')->where('phone', $phone)->first();

        $request->validate([
            'email' => 'email',
            'fname' => 'required|string|max:255',
        ]);

        $otp = null;

        if(!empty($check_phone->register_otp) && $check_phone->status == 0)
        {
            $otp = $check_phone->register_otp;

        }else{
            $request->validate([
                'phone' => 'unique:users',
            ]);

            $data = array();
            $otp = rand(100000, 999999);
            $date = date('Y-m-d H:i:s');
            $data['full_name'] = $full_name = $request->fname;
            $data['email'] = $email = $request->email;
            $data['phone'] = $phone = $request->phone;
            $data['user_type'] = $user_type = $request->user_type;
            $data['firm_name'] = $firm_name = $request->firm_name;
            $data['address'] = $address = $request->address;
            $data['area_vilage'] = $area_vilage = $request->area_vilage;
            $data['district'] = $district = $request->district;
            $data['state'] = $state = $request->state;
            $data['pincode'] = $pincode = $request->pincode;
            $data['mandi_license'] = $mandi_license = $request->license;
            $data['gst'] = $gst = $request->gst;
            $data['ref_referral_code'] = $ref_referral_code = $request->ref_referral_code;

            //Check Data Security
            $checked = xss_clean($data);

            if(!empty($ref_referral_code))
            {
                //Check Referral Code Is Exist or not
                $check_referral_code = DB::table('user_details')->where('referral_code', $ref_referral_code)->first();

                if(!$check_referral_code)
                {
                    $error = 'Referral Code is wrong! enter valid Referral Code';
                    return redirect('farmer_register')->with('error', $error);
                }
            }


            $user = User::create([
                'fname' => $full_name,
                'email' => $data['email'],
                'phone' => $phone,
                'register_otp' => $otp,
                'password' => Hash::make(123456),
                'status' => 0
            ]);

            $user_id = $user->id;

            // Create User role
            $user_role = DB::table('user_roles')->insert(
                array(
                    'role_id' => 2,
                    'user_id' => $user_id,
                    'created_at' => $date,
                    'updated_at' => $date
                )
            );

            // Create User Details
            $user_details = DB::table('user_details')->insert(
                array(
                    'user_id' => $user_id,
                    'user_type' => $user_type,
                    'email' => $data['email'],
                    'fname' => $full_name,
                    'phone' => $phone,
                    'firm_name' => $firm_name,
                    'address' => $address,
                    'area_vilage' => $area_vilage,
                    'city' => $district,
                    'state' => $state,
                    'pincode' => $pincode,
                    'mandi_license' => $mandi_license,
                    'gst_number' => $gst,
                    'image' => "user.png",
                    'referral_by' => $ref_referral_code,
                    'power' => 1,
                    'created_at' => $date,
                    'updated_at' => $date,
                    'status' => 0
                )
            );
         }

        $sms = 'Verify your mobile to register on ApnaGodam with OTP - '.$otp;
        // send otp on mobile number using Helper
        $done = sendotp($phone, $sms, $otp);

        return view('auth.trader_register_otp', array('otp' => $otp, 'exist_phone' => $phone ));
    }

    //Get District Accourding yo state code
    public function getDistrict(Request $request)
    {
        $code = $request->code;
        $district = DB::table('districts')->where('state_code', $code)->get();
        $res = '<option value="">Select District</option>';
        foreach ($district as $key => $value) {
            $res .= '<option value="'.$value->id.'">'.$value->name.'</option>';
        }

        echo $res;
    }
}
