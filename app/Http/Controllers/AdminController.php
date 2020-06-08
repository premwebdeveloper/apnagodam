<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\inventory;
use App\Mis;
use App\user_details;
use DataTables;
use DB;
use PDF;
use Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    // Construct function
	public function __construct(){

		// Only authenticarte and admin user can enter here
		$this->middleware('auth');
		$this->middleware('adminOnly');
	}

    // Admin Change password view
    public function change_password_view(){

        return view('admin.change_password');
    }

    // Change password
    public function change_password(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches

            return Redirect::back()->withErrors(['Your current password does not matches with the password you provided. Please try again !']);
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same

            return Redirect::back()->withErrors(['New Password can not be same as your current password. Please choose a different password !']);
        }

        $this->validate($request, [
            'current-password' => 'required',
            'new-password' => 'required|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return Redirect::back()->withErrors(['Password changed successfully.']);
    }

    // Show all users
    public function users()
    {
    	return view('admin.index');
    }

    // Show all users by Ajax
    public function usersByAjax()
    {
        $users = DB::table('user_details')
                ->join('user_roles', 'user_roles.user_id', '=', 'user_details.user_id')
                ->select('user_details.*', 'user_roles.role_id')
                ->where('status', 1)
                ->where('user_details.user_id', '!=', 1)
                ->get();

        return Datatables::of($users)->addColumn('action', function ($row) {
            $res = '<a href="'.route('user_view', ['user_id' => $row->user_id]).'" class="btn btn-info btn-xs" title="View">Update/View</a>';
            return $res;
        })->addColumn('sr_no', function ($row) {
            $res = '<input type="checkbox" class="" id="user_group" value="'.$row->user_id.'" name="user_ids[]">';
            return $res;
        })->addColumn('name', function ($row) {
            return $row->fname." ".$row->lname;
        })->addColumn('referral_by', function ($row) {
            return '<a class="referred_by" href="javascript:;" id="'.$row->referral_code.'">'.$row->referral_code.'</a>';
        })->escapeColumns(null)
        ->make(true); 
    }

    // Show all corporate users
    public function corporate_users()
    {
        //Get All Users
        $users = DB::table('apna_corporate_users')
                ->join('users', 'users.id', '=', 'apna_corporate_users.user_id')
                ->join('warehouses', 'warehouses.id', '=', 'apna_corporate_users.terminal_id')
                ->where('apna_corporate_users.status', 1)
                ->select('apna_corporate_users.*', 'users.fname as user_name', 'warehouses.name as terminal_name', 'warehouses.warehouse_code')
                ->get();

        //Get All Terminals 
        $res = DB::table('warehouses')->where('status', 1)->get();
        $terminals = array('' => 'Select Terminal');
        foreach($res as $terminal)
        {
            $terminals[$terminal->id] = $terminal->name. " (".$terminal->warehouse_code.")";
        }

        $res = DB::table('user_details')->where('status', 1)->orderBy('fname', 'ASC')->get();
        $customers = array('' => 'Select Customer / Search Phone No.');
        foreach($res as $cust)
        {
            $customers[$cust->phone] = $cust->fname." ".$cust->lname;
        }

        return view('admin.corporate_users', array('case_gen' => $users, 'terminals' => $terminals, 'customers' => $customers));
    }

    // Edit Corporate Users
    public function edit_corporate_user(Request $request)
    {
        //Get All Users
        $user_data = DB::table('apna_corporate_users')
                ->join('users', 'users.id', '=', 'apna_corporate_users.user_id')
                ->join('warehouses', 'warehouses.id', '=', 'apna_corporate_users.terminal_id')
                ->where('apna_corporate_users.id', $request->id)
                ->select('apna_corporate_users.*', 'users.fname as user_name', 'users.phone', 'warehouses.name as terminal_name', 'warehouses.warehouse_code')
                ->first();

        //Get All Terminals 
        $res = DB::table('warehouses')->where('status', 1)->get();
        $terminals = array('' => 'Select Terminal');
        foreach($res as $terminal)
        {
            $terminals[$terminal->id] = $terminal->name. " (".$terminal->warehouse_code.")";
        }

        $res = DB::table('user_details')->where('status', 1)->orderBy('fname', 'ASC')->get();
        $customers = array('' => 'Select Customer / Search Phone No.');
        foreach($res as $cust)
        {
            $customers[$cust->phone] = $cust->fname." ".$cust->lname;
        }

        return view('admin.update_corporate_users', array('user_data' => $user_data, 'terminals' => $terminals, 'customers' => $customers));
    }

    //Add Corporate User
    public function addCorporateUser(Request $request)
    {
        # Set validation for
        $this->validate($request, [
            'user_id'        => 'required',
            'location' => 'required',
            'pincode' => 'required',
            'price' => 'required',
            'terminal_id' => 'required',
        ]);
        $customer_phone        = $request->user_id;

        //Get User Id by Number
        $customer =DB::table('users')->where('phone', $customer_phone)->first();

        $user_id = $customer->id;
                
        $location = $request->location;
        $pincode = $request->pincode;
        $price = $request->price;
        $terminal_id = $request->terminal_id;
        $date        = date('Y-m-d H:i:s');

        // Create User Details
        $inserted = DB::table('apna_corporate_users')->insert([
            'user_id'        => $user_id,
            'location' => $location,
            'pincode' => $pincode,
            'price' => $price,
            'terminal_id' => $terminal_id,
            'created_at'  => $date,
            'updated_at'  => $date,
            'status'      => 1
        ]);

        if($inserted)
        {
            $status = 'Corporate Buyer Added successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('corporate_users')->with('status', $status);
    }

    // Update Corporate User
    public function updateCorporateUser(Request $request){
        # Set validation for
        $this->validate($request, [
            'user_id'        => 'required',
            'location' => 'required',
            'pincode' => 'required',
            'price' => 'required',
            'terminal_id' => 'required',
        ]);
        $customer_phone        = $request->user_id;

        //Get User Id by Number
        $customer =DB::table('users')->where('phone', $customer_phone)->first();

        $user_id = $customer->id;
                
        $id = $request->id;
        $location = $request->location;
        $pincode = $request->pincode;
        $price = $request->price;
        $terminal_id = $request->terminal_id;
        $date        = date('Y-m-d H:i:s');

        // Create User Details
        $inserted = DB::table('apna_corporate_users')
                    ->where('id', $id)
                    ->update([
                        'user_id'        => $user_id,
                        'location' => $location,
                        'pincode' => $pincode,
                        'price' => $price,
                        'terminal_id' => $terminal_id,
                        'updated_at'  => $date,
                    ]);

        if($inserted)
        {
            $status = 'Corporate Buyer Updated successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('corporate_users')->with('status', $status);
    }

    // View Facility Master
    public function facilitiy_master(){

        $facilitiy_masters = DB::table('facilitiy_master')->where('status', 1)->get();
        return view('admin.facilitiy_master', array('facilitiy_masters' => $facilitiy_masters));
    }

    // Add Warehouse rent
    public function add_facility_master(Request $request){

        # Set validation for
        $this->validate($request, [
            'name'        => 'required',
            'description' => 'required'
        ]);
        
        $name        = $request->name;
        $description = $request->description;
        $date        = date('Y-m-d H:i:s');

        if($request->hasFile('image')) {

            $file = $request->image;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'png', 'gig', 'bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('facilitiy_master')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 2052030){
                $status = 'File size is too large. Please upload file less than 2MB !';
                return redirect('facilitiy_master')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/facilitiy_master/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }else{
                $status = 'Please upload image !';
                return redirect('facilitiy_master')->with('status', $status);
        }

        // Create User Details
        $facilitiy_master = DB::table('facilitiy_master')->insert([
            'name'        => $name,
            'description' => $description,
            'image'       => $img_name,
            'created_at'  => $date,
            'updated_at'  => $date,
            'status'      => 1
        ]);

        if($facilitiy_master)
        {
            $status = 'Facilitiy Master Added successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('facilitiy_master')->with('status', $status);
    }

    // facility_master Delete
    public function facility_master_delete(Request $request){

        $id = $request->id;

        // User update in users table
        $delete = DB::table('facilitiy_master')->where('id', $id)->delete();

        if($delete)
        {
            $status = 'Facilitiy Master Deleted successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('facilitiy_master')->with('status', $status);
    }

    // Add user page view
    public function add_user_view(){

        return view('admin.add_user');
    }


    // Add User
    public function add_user(Request $request){

        # Set validation for
        $this->validate($request, [
            'fname' => 'required',
            'category' => 'required',
            'email' => 'nullable|unique:users',
            'phone' => 'required|numeric|digits:10',
        ]);

        $fname = $request->fname;
        $email = $request->email;
        $password = Hash::make('123456');
        $phone = $request->phone;
        $father_name = $request->father_name;
        $khasra = $request->khasra;
        $village = $request->village;
        $tehsil = $request->tehsil;
        $district = $request->district;
        $category = $request->category;
        $khasra_no = $request->khasra;
        $gst_number = $request->gst;
        $date = date('Y-m-d H:i:s');

        $filename = 'user.png';

        # If user profile image uploaded then
        if($request->hasFile('image')) {

            $file = $request->image;

            $filename = $file->getClientOriginalName();

            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $filename = substr(md5(microtime()),rand(0,26),6);

            $filename .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'png', 'gig', 'bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('add_user_view')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 1052030){
                $status = 'File size is too large. Please upload file less than 1MB !';
                return redirect('add_user_view')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/profile_image/';
            $file->move($destinationPath,$filename);
            $filepath = $destinationPath.$filename;
        }

        // Create user in users table
        $user = User::create([
            'fname' => $fname,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'status' => 1
        ]);

        $user_id = $user->id;

        // Create user role in users role table
        $user_role = DB::table('user_roles')->insert([
            'user_id' => $user_id,
            'role_id' => 2,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        // Create User Details
        $user_details = DB::table('user_details')->insert([
            'user_id' => $user_id,
            'fname' => $fname,
            'email' => $email,
            'phone' => $phone,
            'father_name' => $father_name,
            'category' => $category,
            'khasra_no' => $khasra_no,
            'gst_number' => $gst_number,
            'village' => $village,
            'tehsil' => $tehsil,
            'district' => $district,
            'image' => $filename,
            'power' => 1,
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);

        if($user_details)
        {
            $status = 'User Added successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('users')->with('status', $status);
    }

    // User view
    public function user_view(Request $request){

        $user_id = $request->user_id;

        // Get user details by user id
        $user = DB::table('user_details')->where('user_id', $user_id)->first();

        $role = DB::table('user_roles')->where('user_id', $user_id)->first();

        //Get State
        $state = DB::table('states')->get();
        $states = array('' => 'Select State');
        foreach($state as $key => $value)
        {
            $states[$value->name] = $value->name;
        }

        return view('admin.user_view', array('user' => $user, 'role' => $role, 'states' => $states));
    }

    // User Edit view
    public function user_edit_view(Request $request){

        $user_id = $request->user_id;

        // Get user details by user id
        $user = DB::table('user_details')->where('user_id', $user_id)->first();

        return view('admin.user_edit', array('user' => $user));
    }

    // User edit
    public function updateUserProfile(Request $request){

        $date = date('Y-m-d H:i:s');
        $user_id = $request->user_id;

        # If user profile image uploaded then
        if($request->hasFile('profile_image')) {

            $file = $request->profile_image;

            $profile_image = $file->getClientOriginalName();

            $ext = pathinfo($profile_image, PATHINFO_EXTENSION);

            $profile_image = substr(md5(microtime()),rand(0,26),6);

            $profile_image .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['JPG', 'jpg', 'JPEG', 'jpeg', 'PNG', 'png', 'gig', 'bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect()->back()->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 2052030){
                $status = 'File size is too large. Please upload file less than 2MB !';
                return redirect()->back()->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/profile_image/';
            $file->move($destinationPath,$profile_image);
            $filepath = $destinationPath.$profile_image;
        }else{
            $profile_image = $request->profile_img;
        }

        $user_type = $request->user_type;
        if($user_type == 1)
        {
            $data['father_name'] = $father_name = $request->father_name;
        }
        if($user_type == 2)
        {
            $data['mandi_license'] = $mandi_license = $request->license;
            $data['gst_number'] = $gst_number = $request->gst;
        }

        $data['aadhar_no'] = $aadhar_no = $request->aadhar_no;
        $data['pancard_no'] = $pancard_no = $request->pancard_no;
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
        $data['power'] = $power = $request->power;

        # If user profile image uploaded then
        if($request->hasFile('aadhar_image')) {

            $file = $request->aadhar_image;

            $aadhar_name = $file->getClientOriginalName();

            $ext = pathinfo($aadhar_name, PATHINFO_EXTENSION);

            $aadhar_name = substr(md5(microtime()),rand(0,26),6);

            $aadhar_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['JPG', 'jpg', 'JPEG', 'jpeg', 'PNG', 'png', 'gig', 'bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect()->back()->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 2052030){
                $status = 'File size is too large. Please upload file less than 2MB !';
                return redirect()->back()->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/frontend_assets/uploads/';
            $file->move($destinationPath,$aadhar_name);
            $filepath = $destinationPath.$aadhar_name;
        }else{
            $aadhar_name = $request->aadhar_img;
        }

        # If user profile image uploaded then
        if($request->hasFile('cheque_image')) {

            $file = $request->cheque_image;

            $cheque_name = $file->getClientOriginalName();

            $ext = pathinfo($cheque_name, PATHINFO_EXTENSION);

            $cheque_name = substr(md5(microtime()),rand(0,26),6);

            $cheque_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['JPG', 'jpg', 'JPEG', 'jpeg', 'PNG', 'png', 'gig', 'bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect()->back()->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 2052030){
                $status = 'File size is too large. Please upload file less than 2MB !';
                return redirect()->back()->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/frontend_assets/uploads/';
            $file->move($destinationPath,$cheque_name);
            $filepath = $destinationPath.$cheque_name;
        }else{
            $cheque_name = $request->cheque_img;
        }

        if($user_type == 1)
        {
            $update = DB::table('user_details')
                        ->where('user_id', $user_id)
                        ->update([
                                'father_name' => $father_name,
                                'aadhar_no' => $aadhar_no,
                                'pancard_no' => $pancard_no,
                                'address' => $address,
                                'area_vilage' => $area_vilage,
                                'city' => $district,
                                'state' => $state,
                                'pincode' => $pincode,
                                'bank_name' => $bank_name,
                                'bank_branch' => $bank_branch,
                                'bank_acc_no' => $bank_acc_no,
                                'bank_ifsc_code' => $bank_ifsc_code,
                                'power' => $power,
                                'image' => $profile_image,
                                'aadhar_image' => $aadhar_name,
                                'cheque_image' => $cheque_name,
                                'updated_at' => $date,
                        ]);
        }

        if($user_type == 2)
        {
            $update = DB::table('user_details')
                        ->where('user_id', $user_id)
                        ->update([
                                'mandi_license' => $mandi_license,
                                'gst_number' => $gst_number,
                                'aadhar_no' => $aadhar_no,
                                'pancard_no' => $pancard_no,
                                'address' => $address,
                                'area_vilage' => $area_vilage,
                                'city' => $district,
                                'state' => $state,
                                'pincode' => $pincode,
                                'bank_name' => $bank_name,
                                'bank_branch' => $bank_branch,
                                'bank_acc_no' => $bank_acc_no,
                                'bank_ifsc_code' => $bank_ifsc_code,
                                'power' => $power,
                                'image' => $profile_image,
                                'aadhar_image' => $aadhar_name,
                                'cheque_image' => $cheque_name,
                                'updated_at' => $date,
                        ]);
        }

        if($update)
        {
            $status = 'User Updated successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('users')->with('status', $status);
    }

    // User Delete
    public function user_delete(Request $request){

        $user_id = $request->user_id;
        $date = date('Y-m-d H:i:s');

        // User update in users table
        $user_delete = DB::table('users')->where('id', $user_id)->update([

            'status' => 2,
            'updated_at' => $date
        ]);

        // User details update in user details table
        $delete = DB::table('user_details')->where('user_id', $user_id)->update([

            'status' => 2,
            'updated_at' => $date
        ]);

        if($delete)
        {
            $status = 'User Deleted successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('users')->with('status', $status);
    }

    // Get all enquiries / Unapproved user / with status 0
    public function enquiries(){

        // Get users with status 0
        $enquiries = DB::table('warehouse_enquirers')
        ->join('warehouses', 'warehouses.id', '=', 'warehouse_enquirers.warehouse_id')
        ->join('categories', 'categories.id', '=', 'warehouse_enquirers.commodity')
        ->where('warehouse_enquirers.status', 1)
        ->select('warehouse_enquirers.*', 'warehouses.name', 'categories.category as category_name')
        ->get();

        return view('admin.enquiries', array('enquiries' => $enquiries));
    }

    // Approve enquiry
    public function approve(Request $request){

        $user_id = $request->user_id;

        // approve by admin
        $user = DB::table('users')->where('id', $user_id)->first();

        $date = date('Y-m-d H:i:s');

        // User update in users table
        $user_approve = DB::table('users')->where('id', $user_id)->update([

            'status' => 1,
            'updated_at' => $date
        ]);

        // User details update in user details table
        $approve = DB::table('user_details')->where('user_id', $user_id)->update([

            'status' => 1,
            'updated_at' => $date
        ]);

        if($approve)
        {
            $status = 'Enquiry approved successfully.';

            $sms = 'Apna Godam - Enquiry approved by Admin.';

        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('enquiries')->with('status', $status);
    }

    // Unapprove enquiry
    public function unapprove(Request $request){

        $id = $request->user_id;

        // User details update in user details table
        $unapprove = DB::table('warehouse_enquirers')->where('id', $id)->delete();

        if($unapprove)
        {
            $status = 'Enquiry deleted Successfully.';

            $sms = 'Apna Godam - Enquiry unapproved successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('enquiries')->with('status', $status);
    }

    // Done Deals
    public function done_deals()
    {
        $user = Auth::user(); 
        $role = DB::table('user_roles')->where('user_id', $user->id)->first();
        return view('admin.done_deals', array('role' => $role));
    }

    // Show all users by Ajax
    public function getAllDealsDoneByAjax()
    {
        $done_deals = DB::table('buy_sells')
                        ->leftjoin('user_details','user_details.user_id', '=', 'buy_sells.buyer_id')
                        ->leftjoin('users','users.id', '=', 'buy_sells.seller_id')
                        ->leftjoin('inventories as inv', 'inv.id', '=', 'buy_sells.seller_cat_id')
                        ->leftjoin('categories', 'categories.id', '=', 'inv.commodity')
                        ->leftjoin('warehouses', 'warehouses.id', '=', 'inv.warehouse_id')
                        ->leftjoin('mandi_samitis', 'mandi_samitis.id', '=', 'warehouses.mandi_samiti_id')
                        ->where('buy_sells.status', 2)
                        ->orwhere('buy_sells.status', 3)
                        ->select('buy_sells.*', 'inv.gate_pass_wr', 'user_details.fname as buyer_name', 'users.fname as seller_name', 'categories.category', 'categories.commodity_type', 'warehouses.name as warehouse', 'mandi_samitis.name as mandi_samiti_name')
                        ->orderBy('buy_sells.updated_at', 'DESC')
                        ->groupBy('buy_sells.id')
                        ->get();

        return Datatables::of($done_deals)->addColumn('action', function ($row) {
            $user = Auth::user(); 
            $role = DB::table('user_roles')->where('user_id', $user->id)->first();
            $res = '';
            if($role->role_id == 1){
                if($row->status == 2){
                    $res = '<a href="javascript:;" id="'.$row->id.'_'.$row->gate_pass_wr.'" class="btn btn-warning btn-xs edit_gate_pass" data-toggle="tooltip" title="Deal Done">Approve</a>&nbsp;<a href="'.route('download_vikray_parchi', ['id' => $row->id, 'email' => 0]).'" class="btn btn-info btn-xs" data-toggle="tooltip" title="Deal Done">View Vikray Parchi</a>';
                }else{
                    $res = '<a href="'.route('download_vikray_parchi', ['id' => $row->id, 'email' => 0]).'" class="btn btn-info btn-xs" data-toggle="tooltip" title="Deal Done">Download Vikray Parchi</a><a href="'.route('download_vikray_parchi', ['id' => $row->id, 'email' => 1]).'" class="btn btn-info btn-xs" data-toggle="tooltip" title="Send Pdf">Send Mail</a>';
                }
            }
            return $res;
        })->addColumn('done_date', function ($row) {
            $res = date('d M Y', strtotime($row->updated_at));
            return $res;
        })->addColumn('payment_ref_no', function ($row) {
            $res = '';
            if($row->payment_ref_no){
                $res = $row->payment_ref_no;
            }
            else{
                $user = Auth::user(); 
                $role = DB::table('user_roles')->where('user_id', $user->id)->first();
                if($role->role_id == 1){
                    $res = '<a href="javascript:;" id="'.$row->id.'" class="btn btn-warning btn-xs add_payment_ref" data-toggle="tooltip" title="Add Payment Ref. No."><i class="fa fa-plus"></i></a>';
                }
            }
            return $res;
        })->escapeColumns(null)
        ->make(true); 
    }

    // Payment Accept By Admin
    public function payment_accept(Request $request){
        $deal_id = $request->id;
        $gate_pass = $request->gate_pass;

        $done_deals = DB::table('buy_sells')
            ->join('user_details','user_details.user_id', '=', 'buy_sells.buyer_id')
            ->join('users','users.id', '=', 'buy_sells.seller_id')
            ->join('inventories as inv', 'inv.id', '=', 'buy_sells.seller_cat_id')
            ->join('categories', 'categories.id', '=', 'inv.commodity')
            ->join('inventory_cases_id as cases', 'cases.inventory_id', '=', 'inv.id')
            ->join('warehouses', 'warehouses.id', '=', 'inv.warehouse_id')
            ->join('mandi_samitis', 'mandi_samitis.id', '=', 'warehouses.mandi_samiti_id')
            ->join('warehouse_rent_rates', 'warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
            ->where('buy_sells.id', $deal_id)
            ->select('buy_sells.*', 'user_details.fname as buyer_name', 'user_details.phone as buyer_phone', 'user_details.mandi_license', 'users.fname as seller_name', 'users.phone as seller_phone', 'categories.category', 'categories.commodity_type', 'warehouses.name as warehouse',  'warehouses.id as warehouse_id', 'cases.case_id', 'warehouses.warehouse_code', 'warehouse_rent_rates.location', 'inv.quality_category', 'inv.sales_status', 'inv.truck_no', 'mandi_samitis.name as mandi_samiti_name')
            ->first();
            
        $inventory_id = $done_deals->seller_cat_id;
        $quantity = $done_deals->quantity;
        $buyer_id = $done_deals->buyer_id;
        $seller_id = $done_deals->seller_id;
        $warehouse_id = $done_deals->warehouse_id;
        $price = $done_deals->price;
        $quality_category = $done_deals->quality_category;

        $buyer_info = DB::table('user_details')->where('user_id', $buyer_id)->first();

        $seller_info = DB::table('user_details')->where('user_id', $seller_id)->first();
        $done_deals->seller_address = $seller_info->area_vilage;
        $done_deals->buyer_address = $buyer_info->area_vilage;

        // get old sell quantity of this inventory
        $inventory_info = DB::table('inventories')->where('id', $inventory_id)->first();

        $remaining_quantity = $inventory_info->quantity - $quantity;
        $date = date('Y-m-d H:i:s');

        $cate = DB::table('categories')->where('id', $inventory_info->commodity)->first();
        $new_cate = DB::table('categories')->where(['category' => $cate->category, 'commodity_type' => 'Secondary'])->first();

        //Get Case for this inventory 
        $case_id = DB::table('inventory_cases_id')->where('inventory_id', $inventory_id)->first();

        //Get Inventory
        $get_inv = DB::table('inventories')->where(['warehouse_id' => $inventory_info->warehouse_id, 'commodity' => $new_cate->id, 'user_id' => $buyer_id, 'status' => 1])->first();

        /*if($get_inv){
            $new_qty = $get_inv->quantity + $quantity;
            $new_qty = round($new_qty, 2);

            //Update Inventroy
            $update = DB::table('inventories')->where('id', $get_inv->id)->update(['quantity' => $new_qty]);

            //Inset Case Id in Inventory Cases
            $insert = inventory::addCaseIdInInventory($get_inv->id, $case_id->case_id, $quantity);
        }else{*/
            // If trader do not have this commodity already then insert this commodity with this teader
            $insert_id = DB::table('inventories')->insertGetId([
                'user_id'          => $buyer_id,
                'warehouse_id'     => $inventory_info->warehouse_id,
                'commodity'        => $new_cate->id,
                'quantity'         => $quantity,
                'gate_pass_wr'     => $gate_pass,
                'price'            => $price,
                'quality_category' => $quality_category,
                'sales_status'     => 2,
                'status'           => 1,
                'created_at'       => $date,
                'updated_at'       => $date,
            ]);

            //Inset Case Id in Inventory Cases
            $insert = inventory::addCaseIdInInventory($insert_id, $case_id->case_id, $quantity);
        /*}*/

        //Get Remainning Inverntry From Farmer
        $inventory_info_seller = DB::table('inventories')->where('id', $inventory_id)->first();

        if($inventory_info_seller->quantity == $quantity)
        {
            $data = array(
                'sell_quantity' => null,
                'updated_at'    => $date,
                'status'        => 0,
            );
        }else{
            $data = array(                
                'quantity'      => $remaining_quantity,
                'sell_quantity' => null,
                'updated_at'    => $date,
            );
        }

        // update inventory / qauantity of farmaer
        $update_sell_quantity = DB::table('inventories')->where('id', $inventory_info_seller->id)->update($data);

                //Get Last Case IDs for No. Of Bags
        $cases = DB::table('inventory_cases_id')
                ->where('inventory_id', $inventory_id)
                ->Where(function ($query) {
                    $query->orwhere('case_id', 'like', '%IN-%')
                        ->orwhere('case_id', 'like', '%PASS-%');
                })->orderBy('created_at', 'DESC')->first();
        $no_of_bags = 0;

        if($cases)
        {
            $case = DB::table('apna_case')->where('case_id', $cases->case_id)->first();
            $no_of_bags = $case->no_of_bags;
        }

        $done_deals->no_of_bags = $no_of_bags;

        //If Send pdf to email
        $data = json_decode(json_encode($done_deals),true);

        $pdf = PDF::loadView('vikray_parchi_pdf', $data);

        $pdf->download('vikray_parchi.pdf');

        //Get User Old Power
        $user = DB::table('user_details')->where('user_id', $buyer_id)->first();

        $new_power = (float)$user->power - ((float)$quantity * (float)$price);
        $date = date('Y-m-d H:i:s');

        //Update sell status
        $update_buy_sells = DB::table('buy_sells')->where('id', $deal_id)->update([
            'status' => 3,
            'updated_at' => $date,
        ]);

        //Update Power of Trader
        $user_power_update = DB::table('user_details')->where('user_id', $buyer_id)->update([
            'power' => $new_power,
            'updated_at' => $date,
        ]);

        //Send SMS to Seller
        $user = DB::table('users')->where('id', $seller_id)->first();

        //Send Message after Deal Done
        $sms = 'Congratulations. Your Payment done by Admin';
        $done = sendsms($user->phone, $sms);

        $message = 'Payment Accepted Successfully.';
        return redirect('done_deals')->with('status', $message);
    }

    // Re Download  vikray parchi
    public function download_vikray_parchi(Request $request){

        $deal_id = $request->id;
        $email_status = $request->email;

        $done_deals = DB::table('buy_sells')
            ->join('user_details','user_details.user_id', '=', 'buy_sells.buyer_id')
            ->join('users','users.id', '=', 'buy_sells.seller_id')
            ->join('inventories as inv', 'inv.id', '=', 'buy_sells.seller_cat_id')
            ->join('inventory_cases_id as cases', 'cases.inventory_id', '=', 'inv.id')
            ->join('categories', 'categories.id', '=', 'inv.commodity')
            ->join('warehouses', 'warehouses.id', '=', 'inv.warehouse_id')
            ->join('mandi_samitis', 'mandi_samitis.id', '=', 'warehouses.mandi_samiti_id')
            ->join('warehouse_rent_rates', 'warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
            ->where('buy_sells.id', $deal_id)
            ->select('buy_sells.*', 'user_details.fname as buyer_name', 'user_details.phone as buyer_phone', 'user_details.mandi_license', 'users.fname as seller_name', 'users.phone as seller_phone', 'categories.category', 'categories.commodity_type', 'warehouses.name as warehouse',  'warehouses.id as warehouse_id', 'warehouses.warehouse_code', 'warehouse_rent_rates.location', 'inv.quality_category', 'inv.sales_status', 'inv.truck_no', 'cases.case_id', 'mandi_samitis.name as mandi_samiti_name')
            ->first();

        $buyer_id = $done_deals->buyer_id;
        $seller_id = $done_deals->seller_id;

        $buyer_info = DB::table('user_details')->where('user_id', $buyer_id)->first();

        $seller_info = DB::table('user_details')->where('user_id', $seller_id)->first();
        $done_deals->seller_address = $seller_info->area_vilage;
        $done_deals->buyer_address = $buyer_info->area_vilage;

        $inventory_id = $done_deals->seller_cat_id;

        //Get Last Case IDs for No. Of Bags
        $cases = DB::table('inventory_cases_id')
                ->where('inventory_id', $inventory_id)
                ->Where(function ($query) {
                    $query->orwhere('case_id', 'like', '%IN-%')
                        ->orwhere('case_id', 'like', '%PASS-%');
                })->orderBy('created_at', 'DESC')->first();
        $no_of_bags = 0;
        if($cases)
        {
            $case = DB::table('apna_case')->where('case_id', $cases->case_id)->first();
            $no_of_bags = $case->no_of_bags;
        }

        $done_deals->no_of_bags = $no_of_bags;
        
        $data = json_decode(json_encode($done_deals),true);

        $pdf = PDF::loadView('vikray_parchi_pdf', $data);

        if($email_status == 1)
        {

            //Get User Details 
            $data = [];

            if($buyer_info->email)
            {
                $data['to_name'] = $buyer_info->fname;
                $data['email'] = $buyer_info->email;

                //Send Vikray Parchi To Trader or Farmer
                $send = Mail::send('email.send_vikray_parchi', $data, function($message) use ($data,$pdf){
                    $message->from('info@apnagodam.com');
                    $message->to($data['email']);
                    $message->subject('Vikray Parchi by Apna Godam');
                    //Attach PDF doc
                    $message->attachData($pdf->output(),'vikray_parchi.pdf');
                });
            }

            if($seller_info->email)
            {
                $data['to_name'] = $seller_info->fname;            
                $data['email'] = $seller_info->email; 

                //Send Vikray Parchi To Trader or Farmer
                $send = Mail::send('email.send_vikray_parchi', $data, function($message) use ($data,$pdf){
                    $message->from('info@apnagodam.com');
                    $message->to($data['email']);
                    $message->subject('Vikray Parchi by Apna Godam');
                    //Attach PDF doc
                    $message->attachData($pdf->output(),'vikray_parchi.pdf');
                });
            }

            $message = 'Mail Sent Successfully.';
            return redirect('done_deals')->with('status', $message);

        }
        else
        {
            return $pdf->download('vikray_parchi.pdf');
        }

    }

    //Add Payment Ref
    public function add_payment_ref(Request $request)
    {
        $id = $request->id;
        $payment_ref_no = $request->payment_ref_no;
        $date = date('Y-m-d H:i:s');

        $update_buy_sells = DB::table('buy_sells')->where('id', $id)->update([
            'payment_ref_no' => $payment_ref_no,
            'updated_at' => $date,
        ]);

        $message = 'Payment Referance Number Added Successfully.';
        return redirect('done_deals')->with('status', $message);
    }

    //Add Payment Ref
    public function create_user_group(Request $request)
    {
        $this->validate($request, [
            'user_ids' => 'required'
        ]);

        $user_ids = $request->user_ids;
        //Check User is already Added or not         
        foreach($user_ids as $id)
        {
            $users_group = DB::table('user_groups')->where('user_ids', 'like', '%"'.$id.'"%')->get();
            if(!$users_group->isEmpty())
            {
                $user = DB::table('user_details')->where('user_id', $id)->first();
                $message = $user->fname.' user aready Exist.';
                return redirect('users')->with('error', $message); 
            }
        }

        $date = date('Y-m-d H:i:s');

        $group_id = 'AG'.mt_rand(1000, 9999).$user_ids[0];

        $insert_id = DB::table('user_groups')->insert([
            'group_id'   => $group_id,
            'user_ids'   => json_encode($user_ids),
            'status'     => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        $message = 'Group Created Successfully.';
        return redirect('users')->with('status', $message);
    }

    //Get All Users 
    public function user_groups()
    {
        $users = DB::table('user_groups')->where('status', 1)->get();

        return view('admin.user_groups', array('users' => $users));
    }

    //Get Referaal By User 
    public function getReferredByUser(Request $request)
    {
        $referaal_no = $request->referral_id;
        $user_code = DB::table('user_details')->where('referral_by', $referaal_no)->get();
        $codes = '<tr><th>Users</th></tr>';
        if(!empty($user_code))
        {
            foreach($user_code as $code){
                $codes .= "<tr><td><b>".$code->phone."</b></td></tr>";
            }
        }else{
            $codes .= "<tr><td>No Contacts</td></tr>";
        }
        echo $codes;
        die;
    }

    // Show all users OTP in admin panel
    public function users_otp(){

        $users_otp = DB::table('users')
                ->select('phone', 'login_otp')
                ->where('login_otp', '!=', '')
                ->where('id', '>', 2)
                ->get();

        return view('admin.users_otp', array('users_otp' => $users_otp));
    }

    // Show all users OTP in admin panel
    public function mandi_samiti(){

        $mandi_samiti = DB::table('mandi_samitis')
                ->where('status', 1)
                ->get();

        return view('admin.mandi_samiti', array('mandi_samiti' => $mandi_samiti));
    }

    // Single Mandi Samiti Edit Page
    public function edit_mandi_samiti(Request $request){

        $id = $request->id;
        $mandi_samiti = DB::table('mandi_samitis')
                ->where('id', $id)
                ->first();

        return view('admin.edit_mandi_samiti', array('mandi_samiti' => $mandi_samiti));
    }

    // Update Mandi Samiti
    public function update_mandi_samiti(Request $request){

        # Set validation for
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        $id = $request->id;
        $name = $request->name;
        $class = $request->class;
        $secretary_name = $request->secretary_name;
        $phone = $request->phone;
        $std_code = $request->std_code;
        $tel_no = $request->tel_no;
        $fax = $request->fax;
        $email = $request->email;

        $date = date('Y-m-d H:i:s');

        // Add Item
        $mandi = DB::table('mandi_samitis')->where('id', $id)->update([
            'name'       => $name,
            'class'       => $class,
            'secretary_name'       => $secretary_name,
            'phone'       => $phone,
            'std_code'       => $std_code,
            'tel_no'       => $tel_no,
            'fax'       => $fax,
            'email'       => $email,
            'updated_at' => $date,
        ]);

        if($mandi)
        {
            $status = 'Mandi Samiti Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        return redirect('mandi_samiti')->with('status', $status);
    }

    // Add new mandi samiti page
    public function add_mandi_samiti(){

        return view('admin.add_mandi_samiti');
    }

    // Add new mandi samiti page
    public function create_mandi_samiti(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
        ]);

        $name = $request->name;
        $class = $request->class;
        $secretary_name = $request->secretary_name;
        $phone = $request->phone;
        $std_code = $request->std_code;
        $tel_no = $request->tel_no;
        $fax = $request->fax;
        $email = $request->email;
        /*$address = $request->address;
        $district = $request->district;*/
        $date = date('Y-m-d');

        $insert = DB::table('mandi_samitis')->insert([
            'name'       => $name,
            'class'       => $class,
            'secretary_name'       => $secretary_name,
            'phone'       => $phone,
            'std_code'       => $std_code,
            'tel_no'       => $tel_no,
            'fax'       => $fax,
            'email'       => $email,
            /*'address'    => $address,
            'district'   => $district,*/
            'created_at' => $date,
            'updated_at' => $date,
            'status'     => 1
        ]);

        if($insert)
        {
            $status = 'Mandi Samiti Added successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('mandi_samiti')->with('status', $status);
    }

    // delete mandi samiti
    public function delete_mandi_samiti(Request $request){

        $id = $request->id;

        // User update in users table
        $delete = DB::table('mandi_samitis')->where('id', $id)->delete();

        if($delete)
        {
            $status = 'Mandi Samiti Deleted successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('mandi_samiti')->with('status', $status);
    }
}