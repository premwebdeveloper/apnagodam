<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\user_details;
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
    public function users(){

        $users = DB::table('user_details')
                ->join('user_roles', 'user_roles.user_id', '=', 'user_details.user_id')
                ->select('user_details.*', 'user_roles.role_id')
                ->where('status', 1)
                ->where('user_details.user_id', '!=', 1)
                ->get();

    	return view('admin.index', array('users' => $users));
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

        return view('admin.user_view', array('user' => $user));
    }

    // User Edit view
    public function user_edit_view(Request $request){

        $user_id = $request->user_id;

        // Get user details by user id
        $user = DB::table('user_details')->where('user_id', $user_id)->first();

        return view('admin.user_edit', array('user' => $user));
    }

    // User edit
    public function user_edit(Request $request){

        # Set validation for
        $this->validate($request, [
            'fname' => 'required',
            'phone' => 'required|numeric|digits:10',
            'power' => 'required|numeric',
        ]);

        $user_id = $request->user_id;
        $fname = $request->fname;
        //$lname = $request->lname;
        $email = $request->email;
        //$password = Hash::make($request->password);
        $phone = $request->phone;
        $father_name = $request->father_name;
        $khasra = $request->khasra;
        $village = $request->village;
        $tehsil = $request->tehsil;
        $district = $request->district;
        $category = $request->category;
        $khasra_no = $request->khasra;
        $gst_number = $request->gst;
        $power = $request->power;
        $transfer_amount = $request->transfer_amount;
        $date = date('Y-m-d H:i:s');

        // First get users data from user details table
        $user = DB::table('user_details')->where('user_id', $user_id)->first();
        $filename = $user->image;

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
                return redirect('user_edit_view/'.$user_id)->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 1052030){
                $status = 'File size is too large. Please upload file less than 1MB !';
                return redirect('user_edit_view/'.$user_id)->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/profile_image/';
            $file->move($destinationPath,$filename);
            $filepath = $destinationPath.$filename;
        }

        // User update in users table
        $user_edit = DB::table('users')->where('id', $user_id)->update([

            'fname' => $fname,
            'email' => $email,
            'phone' => $phone,
            'updated_at' => $date
        ]);

        // User details update in user details table
        $edit = DB::table('user_details')->where('user_id', $user_id)->update([

            'fname' => $fname,
            'email' => $email,
            'phone' => $phone,
            'father_name' => $father_name,
            'khasra_no' => $khasra,
            'village' => $village,
            'tehsil' => $tehsil,
            'district' => $district,
            'category' => $category,
            'khasra_no' => $khasra_no,
            'gst_number' => $gst_number,
            'image' => $filename,
            'power' => $power,
            'transfer_amount' => $transfer_amount,
            'updated_at' => $date
        ]);

        if($edit)
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
        $done_deals = DB::table('buy_sells')
                        ->join('user_details','user_details.user_id', '=', 'buy_sells.buyer_id')
                        ->join('users','users.id', '=', 'buy_sells.seller_id')
                        ->join('inventories as inv', 'inv.id', '=', 'buy_sells.seller_cat_id')
                        ->join('categories', 'categories.id', '=', 'inv.commodity')
                        ->join('warehouses', 'warehouses.id', '=', 'inv.warehouse_id')
                        ->select('buy_sells.*', 'inv.gate_pass_wr','user_details.fname as buyer_name', 'users.fname as seller_name', 'categories.category', 'warehouses.name as warehouse')
                        ->get();

        return view('admin.done_deals', array('done_deals' => $done_deals));
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
                ->join('warehouses', 'warehouses.id', '=', 'inv.warehouse_id')
                ->join('warehouse_rent_rates', 'warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
                ->where('buy_sells.id', $deal_id)
                ->select('buy_sells.*', 'user_details.fname as buyer_name', 'user_details.mandi_license', 'users.fname as seller_name', 'categories.category', 'categories.mandi_fees', 'warehouses.name as warehouse',  'warehouses.id as warehouse_id', 'warehouses.warehouse_code', 'warehouse_rent_rates.location', 'inv.quality_category', 'inv.sales_status', 'inv.gate_pass_wr', 'inv.image')
                ->first();
            
        $inventory_id = $done_deals->seller_cat_id;
        $quantity = $done_deals->quantity;
        $buyer_id = $done_deals->buyer_id;
        $seller_id = $done_deals->seller_id;
        $warehouse_id = $done_deals->warehouse_id;
        $price = $done_deals->price;
        $quality_category = $done_deals->quality_category;

        // get old sell quantity of this inventory
        $inventory_info = DB::table('inventories')->where('id', $inventory_id)->first();

        $remaining_quantity = $inventory_info->quantity - $quantity;
        $date = date('Y-m-d H:i:s');

        $trader_inventory = DB::table('inventories')->where(['user_id' => $buyer_id, 'commodity' => $inventory_info->commodity])->first();

        // If trader have this commodity already then update quantity
        if(!empty($trader_inventory)){

            $update_trader_quantity = DB::table('inventories')->where('id', $trader_inventory->id)->update([

                'quantity' => $trader_inventory->quantity + $quantity,
                'updated_at' => $date,
            ]);

        }else{

            // If trader do not have this commodity already then insert this commodity with this teader
            $insert_id = DB::table('inventories')->insertGetId([

                'user_id'          => $buyer_id,
                'warehouse_id'     => $inventory_info->warehouse_id,
                'commodity'        => $inventory_info->commodity,
                'quantity'         => $quantity,
                'gate_pass_wr'     => $gate_pass,
                'price'            => $price,
                'quality_category' => $quality_category,
                'sales_status'     => 2,
                'image'            => $done_deals->image,
                'status'           => 1,
                'created_at'       => $date,
                'updated_at'       => $date,
            ]);
        }

        //Get Remainning Inverntry From Farmer
        $inventory_info_seller = DB::table('inventories')->where(['user_id' => $seller_id, 'warehouse_id' => $warehouse_id, 'commodity' => $inventory_info->commodity])->first();

        if($inventory_info_seller->quantity == 0)
        {
            $data = array(
                'quantity' => $remaining_quantity,
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

        //If Send pdf to email
        $data = json_decode(json_encode($done_deals),true);

        $pdf = PDF::loadView('vikray_parchi_pdf', $data);

        $pdf->download('vikray_parchi.pdf');

        //Get User Old Power
        $user = DB::table('user_details')->where('user_id', $buyer_id)->first();

        $new_power = $user->power - ($quantity * $price);
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
            ->join('categories', 'categories.id', '=', 'inv.commodity')
            ->join('warehouses', 'warehouses.id', '=', 'inv.warehouse_id')
            ->join('warehouse_rent_rates', 'warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
            ->where('buy_sells.id', $deal_id)
            ->select('buy_sells.*', 'user_details.fname as buyer_name', 'user_details.mandi_license', 'users.fname as seller_name', 'categories.category', 'categories.mandi_fees', 'warehouses.name as warehouse',  'warehouses.id as warehouse_id', 'warehouses.warehouse_code', 'warehouse_rent_rates.location', 'inv.quality_category', 'inv.sales_status')
            ->first();

        $data = json_decode(json_encode($done_deals),true);

        $pdf = PDF::loadView('vikray_parchi_pdf', $data);

        if($email_status == 1)
        {
            $buyer_id = $done_deals->buyer_id;
            $seller_id = $done_deals->seller_id;

            //Get User Details 
            $buyer_info = DB::table('user_details')->where('user_id', $buyer_id)->first();

            $seller_info = DB::table('user_details')->where('user_id', $seller_id)->first();

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
}