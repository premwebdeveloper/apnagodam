<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Mail;
use PDF;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Storage;
use Session;

class UsersController extends Controller
{
	// Construct function
	public function __construct(){

		// Only authenticated and user enter here
		$this->middleware('auth');
		$this->middleware('userOnly');
	}

    // User profile view
    public function profile(){

        $currentuserid = Auth::user()->id;

        $user = DB::table('user_details')->where('user_id', $currentuserid)->first();
        $role = DB::table('user_roles')->where('user_id', $currentuserid)->first();

        //Get State
        $state = DB::table('states')->get();
        $states = array('' => 'Select State');
        foreach($state as $key => $value)
        {
            $states[$value->name] = $value->name;
        }

        return view("user.profile", array('user' => $user, 'role' => $role, 'states' => $states));
    }

    // User profile view
    public function updateProfileImage(Request $request)
    {
        $date = date('Y-m-d H:i:s');
        $user_id = Auth::user()->id;

        # If user profile image uploaded then
        if($request->hasFile('profile_image')) {

            $file = $request->profile_image;

            $profile_image = $file->getClientOriginalName();

            $ext = pathinfo($profile_image, PATHINFO_EXTENSION);

            $profile_image = substr(md5(microtime()),rand(0,26),6);

            $profile_image .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'png', 'gig', 'bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('profile')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 2052030){
                $status = 'File size is too large. Please upload file less than 2MB !';
                return redirect('profile')->with('error', $status);
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
                                'image' => $profile_image,
                                'aadhar_image' => $aadhar_name,
                                'cheque_image' => $cheque_name,
                                'updated_at' => $date,
                        ]);
        }


        return redirect('profile')->with('success', 'Profile updated successfully.');
    }

    // get_total_loan_amount
    public function get_total_loan_amount(Request $request){

        $inventory_id = $request->inventory_id;
        $quantity = $request->quantity;
        $loan_amount = $request->loan_amount;
        $loan_per_total_amount = $request->loan_per_total_amount;

        // Get inventory info by ID
        $inventory_info = DB::table('inventories')->where('id', $inventory_id)->first();

        // Get todays prict of this commodity in their ware house
        $today_price = DB::table('today_prices')->where('commodity_id', $inventory_info->commodity)->where('terminal_id', $inventory_info->warehouse_id)->where('created_at', date('Y-m-d'))->first();

        if(!empty($today_price)){
            
            $allowed_loan_amount = $quantity * $today_price->modal * $loan_per_total_amount / 100;

            if($allowed_loan_amount < $loan_amount){
                echo 2;
            }else{
                echo 1;
            }

        }else{
            echo 0;
        }

        exit;
    }

    // get_total_loan_amount
    public function get_todays_price_by_inventory(Request $request){

        $inventory_id = $request->inventory_id;

        // Get inventory info by ID
        $inventory_info = DB::table('inventories')->where('id', $inventory_id)->first();

        // Get todays prict of this commodity in their ware house
        $today_price = DB::table('today_prices')->where('commodity_id', $inventory_info->commodity)->where('terminal_id', $inventory_info->warehouse_id)->where('created_at', date('Y-m-d'))->first();

        if(!empty($today_price)){
            
            echo $today_price->modal;
        }else{
            echo 0;
        }

        exit;
    }

    // User inventory view
    public function inventories(){

        $currentuserid = Auth::user()->id;

        $user = DB::table('user_details')->where('user_id', $currentuserid)->first();

        // Get today's commodity price
        $today_prices = DB::table('today_prices')->where('status', 1)->where('created_at', '=', date('Y-m-d'))->get();

        //Get All Bank Master
        $banks_master = DB::table('bank_master')->where('status', 1)->get();

        $inventories = DB::table('inventories')
                        ->leftJoin('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
                        ->leftJoin('warehouse_rent_rates', 'warehouses.id', '=', 'warehouse_rent_rates.warehouse_id')
                        ->leftJoin('categories', 'categories.id', '=', 'inventories.commodity')
                        ->select('inventories.*', 'categories.category as cat_name', 'warehouses.name', 'warehouses.warehouse_code', 'warehouse_rent_rates.location')
                        ->where(['inventories.status' => 1, 'inventories.user_id' => $currentuserid])
                        ->get();
        foreach ($inventories as $key => $value) {
            $value->case_id = DB::table('inventory_cases_id')->where('inventory_id', $value->id)->get();
        }

        //Get All Loan for Single User
        $alll_loan =  DB::table('finances')
                        ->where('user_id', $currentuserid)
                        ->select('commodity_id')
                        ->get();
        $ids = array();
        foreach ($alll_loan as $key => $loan) {
            $ids[$key] = $loan->commodity_id;
        }

        return view("user.inventory", array('user' => $user, 'banks_master' => $banks_master, 'inventories' => $inventories, 'alll_loan' => $ids));
    }

    // User profile view
    public function change_password(){

        $currentuserid = Auth::user()->id;

        $user = DB::table('user_details')->where('user_id', $currentuserid)->first();

    	return view("user.change_password", array('user' => $user));
    }

    // Finance page view
    public function user_finance_view(){

        $currentuserid = Auth::user()->id;

        // Get user inventory
        $finances =  DB::table('finances')
            ->join('inventories', 'inventories.id', '=', 'finances.commodity_id')
            ->join('categories', 'categories.id', '=', 'inventories.commodity')
            ->join('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
            ->join('bank_master', 'bank_master.id', '=', 'finances.bank_id')
            ->where('finances.user_id', $currentuserid)
            ->select('finances.*', 'inventories.net_weight','inventories.price', 'categories.category', 'warehouses.name','bank_master.bank_name','bank_master.interest_rate','bank_master.loan_pass_days')
            ->get();

        return view("user.finance", array('finances' => $finances));
    }

    // Request for loan
    public function request_for_loan(Request $request){

        $id = $request->id;
        $currentuserid = Auth::user()->id;
        $user = DB::table('users')->where('id', $currentuserid)->first();
        // Get inventory details
        $inventory= DB::table('inventories')
            ->join('categories', 'categories.id', '=', 'inventories.commodity')
            ->where('inventories.id', $id)
            ->select('inventories.*', 'categories.category')

            ->first();

        return view("user.request_for_loan", array('commodity_id' => $id, 'inventory' => $inventory));
    }

    // Requested for loan
    public function requested_for_loan(Request $request){

        $finance_id = $request->finance_id;
        $commodity_id = $request->id;
        $currentuserid = Auth::user()->id;

        // Get Requested for loan details
        $finance =  DB::table('finances')
            ->join('inventories as inv','inv.id', '=', 'finances.commodity_id')
            ->join('categories', 'categories.id', '=', 'inv.commodity')
            ->where(['finances.id' => $finance_id])
            ->select('finances.*', 'inv.commodity', 'inv.quantity', 'categories.category')
            ->first();

        return view("user.requested_for_loan", array('finance' => $finance));
    }

    // Request for loan submit
    public function loan_request(Request $request){

        $currentuserid = Auth::user()->id;

        // Get user info
        $user_info = DB::table('user_details')->where('user_id', $currentuserid)->first();

        # Set validation for
        $this->validate($request, [
            'amount'              => 'required',
            'apply_for_loan_bank' => 'required',
            'inventory_id'        => 'required',
            'quantity'            => 'required',
        ]);

        $commodity_id = $request->inventory_id;
        $bank_id = $request->apply_for_loan_bank;
        $quantity = $request->quantity;
        $amount = $request->amount;
        $date = date('Y-m-d H:i:s');

        // First get commodity informatioon
        $commodity_info = DB::table('inventories')->where('id', $commodity_id)->first();

        if($commodity_info->quantity < $quantity):

            $status = 'You can not apply for loan on more than quantity you have !';
            return redirect('inventories/'.$commodity_id)->with('status', $status);

        endif;

        // Insert entry with all required fields
        $last_id = DB::table('finances')->insertGetId([
            'user_id' => $currentuserid,
            'bank_id' => $bank_id,
            'pan' => null,
            'balance_sheet' => null,
            'bank_statement' => null,
            'commodity_id' => $commodity_id,
            'quantity' => $quantity,
            'amount' => $amount,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        // insert entry in finance_response table
        $insert = DB::table('finance_responses')->Insert([
            'finance_id' => $last_id,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        if($insert){

            // finance enquiry message for admin
            $admin_phone = DB::table('users')->where('id', 1)->first();

            $sms = 'Apna Godam - '.$user_info->fname.' requested for loan.';
            // send sms on mobile number using curl
            //$done = sendsms($admin_phone->phone, $sms);

            $sms = 'Apna Godam - You have requested for loan successfully.';
            // send sms to user for loan request
            //$success = sendsms($user_info->phone, $sms);

            $status = 'Request submitted successfully.';
        }else{

            $status = 'Something went wrong !';
        }

        return redirect('user_finance_view')->with('status', $status);
    }

    public function loan_approved(Request $request){

        $finance_id = $request->id;

        $currentuserid = Auth::user()->id;

        // Get user inventory
        $inventories =  DB::table('finances')
                        ->join('inventories as inv','inv.id', '=', 'finances.commodity_id')
                        ->join('categories', 'categories.id', '=', 'inv.commodity')
                        ->join('finance_responses as fin_res','fin_res.finance_id', '=', 'finances.id')
                        ->join('bank_master', 'bank_master.id', '=', 'finances.bank_id')
                        ->where('finances.id', $finance_id)
                        ->select('finances.*', 'inv.commodity', 'inv.quantity', 'categories.category', 'bank_master.bank_name','bank_master.interest_rate','bank_master.loan_pass_days')
                        ->first();

        $agree = [];
        $agree['1'] = 'Yes';
        $agree['0'] = 'No';

        return view("user.requested_loan", array('finance_id' => $finance_id, 'inventories' => $inventories, 'agree' => $agree));
    }

    // user agree / disagree for loan final approcal
    public function user_agree_for_loan(Request $request){

        $finance_id = $request->finance_id;
        $agree = $request->agree;
        $date = date('Y-m-d H:i:s');

        // get this finance record
        $finance_info = DB::table('finances')->where('id', $finance_id)->first();

        // Get user info of this finance record
        $user_info = DB::table('user_details')->where('user_id', $finance_info->user_id)->first();

        // finance enquiry message for admin
        $admin_phone = DB::table('users')->where('id', 1)->first();

        // if user disagree for loan then delete all enteries
        if($agree == 0){

            $sms = 'Apna Godam - You have dis-agreed to have approved loan amount.';
            // send sms on mobile number using curl
            $success = sendsms($user_info->phone, $sms);

            // send sms to admin
            $sms = 'Apna Godam - '.$user_info->fname.' dis-agreed to have approved loan amount.';
            // send sms on mobile number using curl
            $done = sendsms($admin_phone->phone, $sms);

            $finance_del = DB::table('finances')->where('id', $finance_id)->delete();
            $finance_res_del = DB::table('finance_responses')->where('finance_id', $finance_id)->delete();

            if($finance_res_del){

                $status = 'You refused the request for loan. You can request again.';
            }else{

                $status = 'Something went wrong !';
            }

            return redirect('user_finance_view')->with('status', $status);

        }else{

            $sms = 'Apna Godam - You have agreed to have approved loan amount.';
            // send sms on mobile number using curl
            $success = sendsms($user_info->phone, $sms);

            // send sms to admin
            $sms = 'Apna Godam - '.$user_info->fname.' agreed to have approved loan amount.';
            $success = sendsms($admin_phone->phone, $sms);

            // update finances table
            $finance_done = DB::table('finances')->where('id', $finance_id)->update([

                'status' => 3,
                'updated_at' => $date,
            ]);

            // update finances_response table
            $finance_res_done = DB::table('finance_responses')->where('finance_id', $finance_id)->update([

                'status' => 2,
                'updated_at' => $date,
            ]);

            if($finance_res_done){

                $status = 'Your loan amount will be credited in your account.';
            }else{

                $status = 'Something went wrong !';
            }

            return redirect('user_finance_view')->with('status', $status);
        }
    }

    // user update price
    public function update_price(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $currentuserid = Auth::user()->id;

        $invetory_id = $request->invetory_id;
        $price = $request->price;
        $sell_quantity = $request->sell_quantity;

        // First get this inventory information
        $inventory_info = DB::table('inventories')->where('id', $invetory_id)->first();

        if($inventory_info->quantity < $sell_quantity):

            $status = 'You can not update sell quantity more than you have !';
            return redirect('farmer_inventory')->with('status', $status);

        endif;

        // Update inventory quantity
        $inventories = DB::table('inventories')->where('id', $invetory_id)->update([

            'sell_quantity' => $sell_quantity,
            'price' => $price,
            'updated_at' => $date
        ]);

        // Update sell quantity in buy_sell table if there is any bid exist by trader
        $bid_info = DB::table('buy_sells')->where(['seller_cat_id' => $invetory_id, 'status' => 1])->first();

        // IF there is any bid exist then update quantity
        if(!empty($bid_info)){

            $bid_update = DB::table('buy_sells')->where('id', $bid_info->id)->update([

                'quantity' => $sell_quantity,
                'updated_at' => $date,
            ]);
        }

        if($inventories){

            $status = 'Price and quantity updated successfully.';
        }else{

            $status = 'Something went wrong !';
        }

        return redirect('farmer_inventory')->with('status', $status);
    }

    // User notification
    public function deals(Request $request){

        $currentuserid = Auth::user()->id;

        $status = $request->status;

        // Get all sell products
        $sells = DB::table('buy_sells')
            ->join('inventories', 'inventories.id', '=', 'buy_sells.seller_cat_id')
            ->leftjoin('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
            ->leftjoin('warehouse_rent_rates', 'warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
            ->leftjoin('categories', 'categories.id', '=', 'inventories.commodity')
            ->leftjoin('user_details', 'user_details.user_id', '=', 'buy_sells.buyer_id')
            ->where(['buy_sells.seller_id' => $currentuserid, 'buy_sells.status' => '3'])
            ->select('buy_sells.*', 'categories.category', 'inventories.quality_category', 'warehouses.name', 'warehouse_rent_rates.location','user_details.fname', 'inventories.sales_status')
            ->get();

        // Get all buy products
        $buys = DB::table('buy_sells')
                ->join('inventories', 'inventories.id', '=', 'buy_sells.seller_cat_id')
                ->leftjoin('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
                ->leftjoin('warehouse_rent_rates', 'warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
                ->leftjoin('user_details', 'user_details.user_id', '=', 'buy_sells.seller_id')
                ->leftjoin('categories', 'categories.id', '=', 'inventories.commodity')
                ->where(['buy_sells.buyer_id' => $currentuserid, 'buy_sells.status' => '3'])
                ->select('buy_sells.*', 'categories.category', 'inventories.quality_category', 'warehouses.name', 'warehouse_rent_rates.location', 'user_details.fname', 'inventories.sales_status')
                ->get();

        return view("user.deals", array('status' => $status, 'sells' => $sells, 'buys' => $buys));
    }

    // Bidding on deal
    public function bidding(Request $request){

        $currentuserid = Auth::user()->id;

        $inventory_id = $request->inventory_id;

        $inventory_info = DB::table('inventories')
                ->join('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
                ->join('categories', 'categories.id', '=', 'inventories.commodity')
                ->join('warehouse_rent_rates', 'warehouse_rent_rates.warehouse_id', '=', 'inventories.warehouse_id')
                ->where('inventories.id', $inventory_id)
                ->select('categories.category', 'warehouses.name', 'warehouse_rent_rates.area', 'inventories.*')
                ->first();

        $deal_info = DB::table('buy_sells')
                ->join('buy_sell_conversations', 'buy_sell_conversations.buy_sell_id', '=', 'buy_sells.id')
                ->join('user_details', 'user_details.user_id', '=', 'buy_sell_conversations.user_id')
                ->where(['buy_sells.seller_cat_id' => $inventory_id, 'buy_sells.status' => '1'])
                ->orderBy('buy_sell_conversations.price', 'desc')
                ->select('buy_sell_conversations.*', 'user_details.fname')
                ->get();

        return view("user.bidding", array('deal_info' => $deal_info, 'inventory_info' => $inventory_info));
    }

    // Seller self bid
    public function seller_bid(Request $request){

        $currentuserid = Auth::user()->id;

        $inventory_id = $request->inventory_id;
        $my_bid = $request->my_bid;

        $date = date('Y-m-d H:i:s');

        // Get inventory details
        $inventory_info = DB::table('inventories')
                ->join('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
                ->join('categories', 'categories.id', '=', 'inventories.commodity')
                ->where('inventories.id', $inventory_id)
                ->select('categories.category', 'warehouses.name', 'inventories.*')
                ->first();

        // Get last bid on this commodity
        $last_bid = DB::table('buy_sells')
                ->join('buy_sell_conversations', 'buy_sell_conversations.buy_sell_id', '=', 'buy_sells.id')
                ->where('buy_sells.seller_cat_id', $inventory_id)
                ->orderBy('buy_sell_conversations.updated_at', 'desc')
                ->select('buy_sells.*', 'buy_sell_conversations.price')
                ->first();
        if(!empty($last_bid))
        {
            if($last_bid->status == 2)
            {
                $status = 'Bid closed by Seller.';
                return redirect('buy_sell')->with('status', $status);
            }
        }

        $all_bid_users = DB::table('buy_sells')
                ->join('buy_sell_conversations', 'buy_sell_conversations.buy_sell_id', '=', 'buy_sells.id')
                ->where('buy_sells.seller_cat_id', $inventory_id)
                ->orderBy('buy_sell_conversations.updated_at', 'desc')
                ->select('buy_sell_conversations.user_id')
                ->get();

        // first check buyer power / buyer can puchase or not
        $buyer_info = DB::table('user_details')->where('user_id', $currentuserid)->first();


        //Get Already Bid on other Inventory or Same Inventory
        $buysell = DB::table('buy_sell_conversations')
                    ->join('buy_sells', 'buy_sell_conversations.buy_sell_id', '=', 'buy_sells.id')
                    ->where('buy_sell_conversations.user_id', $currentuserid)
                    ->select('buy_sell_conversations.*', 'buy_sells.quantity')
                    ->get();

        //Check Bid Power
        if($buysell)
        {
            $total_amount = 0;
            foreach($buysell as $key => $bid){
                $total_amount = $total_amount + ($bid->quantity * $bid->price);
            }

            // If the buyer so not have enough power then hit error
            if($buyer_info->power < $total_amount){
                return redirect('bidding/'.$inventory_id)->with('status', 'You do not have the power to bid this amount! Please contact to Administrator.');
            }else{
                $total_amount = $total_amount + ($inventory_info->sell_quantity * $my_bid);

                if($buyer_info->power < $total_amount){
                    return redirect('bidding/'.$inventory_id)->with('status', 'You do not have the power to bid this amount! Please contact to Administrator.');
                }
            }
        }else{
            // If the buyer so not have enough power then hit error
            if($buyer_info->power < $inventory_info->sell_quantity * $my_bid){
                return redirect('bidding/'.$inventory_id)->with('status', 'You do not have the power to bid this amount! Please contact to Administrator.');
            }
        }

        //die;

        // First check if this commodity already exist in buy_sell table with active bid or not
        $exist_active_bid = DB::table('buy_sells')
                ->where(['seller_cat_id' => $inventory_id, 'status' => '1'])
                ->first();

        // If entry not exist in buy_sell table with this commoditty and status 1
        if(!empty($exist_active_bid))
        {
            $buy_sell_id = $exist_active_bid->id;
        }else{

            $buy_sell_id = DB::table('buy_sells')->insertGetId([
                'buyer_id' => null,
                'seller_id' => $inventory_info->user_id,
                'seller_cat_id' => $inventory_info->id,
                'quantity' => $inventory_info->sell_quantity,
                'price' => null,
                'status' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ]);
        }

        // first check if this user have any bid with this commodity
        $exist_bid = DB::table('buy_sell_conversations')
                ->where(['buy_sell_id' => $buy_sell_id, 'user_id' => $currentuserid, 'status' => '1'])
                ->first();

        // If there is no bid with this commodity then
        if(!empty($exist_bid)){

            $bid = DB::table('buy_sell_conversations')->where('id', $exist_bid->id)->update([
                'price' => $my_bid,
                'updated_at' => $date
            ]);

        }else{

            // insert bid price for this deal
            $bid = DB::table('buy_sell_conversations')->insert([

                'buy_sell_id' => $buy_sell_id,
                'user_id' => $currentuserid,
                'price' => $my_bid,
                'status' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ]);

        }

        //Get All Bid User for Send message without current user
        $all_bid = DB::table('buy_sell_conversations')
                ->where(['buy_sell_id' => $buy_sell_id, 'status' => '1'])
                ->where('user_id', "!=", $currentuserid)
                ->get();

        //Send Message to another buyer and farmer
        $user = DB::table('users')->where('id', $inventory_info->user_id)->first();

        $sms = "Buyer Bid ".$my_bid. " RS. on your inventory." ;
        $done = sendsms($user->phone, $sms);

        if(!empty($all_bid{0})){

            foreach ($all_bid as $key => $data) {

                //Send Message to another buyer and farmer
                $user = DB::table('users')->where('id', $data->user_id)->first();

                $sms = "Buyer Bid ".$my_bid. " RS. on curernt Inventory." ;
                $success = sendsms($user->phone, $sms);
            }
        }

        $new_power = $buyer_info->power - ($inventory_info->quantity * $my_bid);

        //Update Power of Trader
        $user_power_update = DB::table('user_details')->where('user_id', $currentuserid)->update([
            'power' => $new_power,
            'updated_at' => $date,
        ]);

        $status = 'Bid submitted successfully.';

        return redirect('bidding/'.$inventory_id)->with('status', $status);
    }

    // deal done by seller
    public function deal_done(Request $request){

        $inventory_id = $request->inventory_id;
        $date = date('Y-m-d H:i:s');

        $deal_info = DB::table('buy_sells')
                ->join('buy_sell_conversations', 'buy_sell_conversations.buy_sell_id', '=', 'buy_sells.id')
                ->where(['buy_sells.seller_cat_id' => $inventory_id, 'buy_sells.status' => '1'])
                ->select('buy_sell_conversations.*', 'buy_sells.id as deal_id')
                ->get();

        $deal_info_array = json_decode(json_encode($deal_info));
        $bid_prices = array_column($deal_info_array, 'price');
        $max_bid = max($bid_prices);
        $user_ids = array();
        $i = 0;
        $buyer_id = null;
        $seller_id = null;

        foreach ($deal_info as $key => $deal) {

            if($deal->price == $max_bid){

                $buyer_id = $deal->user_id;

                $done = DB::table('buy_sells')->where('id', $deal->deal_id)->update([
                    'buyer_id' => $deal->user_id,
                    'price' => $max_bid,
                    'status' => 3,
                    'updated_at' => $date
                ]);

                //Get Farmer User_id for send message
                $seller = DB::table('buy_sells')->select('seller_id')->where('id', $deal->buy_sell_id)->first();
                $user_ids[$i] = $seller->seller_id;
                $i++;
            }
            else
            {
                $user_ids[$i] = $deal->user_id;
                $i++;
            }
        }

        if($done)
        {
            /*$done_deals = DB::table('buy_sells')
                ->join('user_details','user_details.user_id', '=', 'buy_sells.buyer_id')
                ->join('users','users.id', '=', 'buy_sells.seller_id')
                ->join('inventories as inv', 'inv.id', '=', 'buy_sells.seller_cat_id')
                ->join('categories', 'categories.id', '=', 'inv.commodity')
                ->join('warehouses', 'warehouses.id', '=', 'inv.warehouse_id')
                ->join('mandi_samitis', 'mandi_samitis.id', '=', 'warehouses.mandi_samiti_id')
                ->join('warehouse_rent_rates', 'warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
                ->where('buy_sells.id', $deal_info->id)
                ->select('buy_sells.*', 'user_details.fname as buyer_name', 'user_details.mandi_license', 'users.fname as seller_name', 'categories.category', 'warehouses.name as warehouse',  'warehouses.id as warehouse_id', 'warehouses.warehouse_code', 'warehouse_rent_rates.location', 'inv.quality_category', 'inv.sales_status', 'inv.truck_no', 'mandi_samitis.name as mandi_samiti_name')
                ->first();

            $buyer_info = DB::table('user_details')->where('user_id', $deal->user_id)->first();
            $seller_info = DB::table('user_details')->where('user_id', $deal->buy_sell_id)->first();*/

            //Send Message to Other trader who do not take this bid
            foreach ($user_ids as $key => $value) {
                $user = DB::table('users')->where('id', $value)->first();
                //Send Message after Deal Done
                $sms = 'This deal done by other buyer Rs.  '.$max_bid;
                $done = sendsms($user->phone, $sms);
            }

            //Send messsage to trader(Buyer)
            if($buyer_id)
            {
                $user = DB::table('users')->where('id', $buyer_id)->first();

                //Send Message after Deal Done
                $sms = 'Congratulations. Your Bid accepted by seller amount by '.$max_bid." RS.";
                $done = sendsms($user->phone, $sms);
            }

            /*$done_deals->seller_address = $seller_info->area_vilage;
            $done_deals->buyer_address = $buyer_info->area_vilage;

            $data = json_decode(json_encode($done_deals),true);

            $pdf = PDF::loadView('vikray_parchi_pdf', $data);

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
                    $message->subject('Vikray Parchi for by Apna Godam');

                    //Attach PDF doc
                    $message->attachData($pdf->output(),'vikray_parchi.pdf');
                });
            }*/

            $status = 'Deal Done.';
        }else{

            $status = 'Something went wrong !';
        }

        //return redirect('deals')->with('status', $status);
        return redirect('bidding/'.$inventory_id)->with('status', $status);
    }

    // show all notification to users
    public function notifications(Request $request)
    {
        $currentuserid = Auth::user()->id;
        $date = date('Y-m-d H:i:s');

        // get all notification
        $deals = DB::table('buy_sells')
                        ->where(['buyer_id' => $currentuserid, 'status' => 1])
                        ->orWhere('seller_id', $currentuserid)
                        ->get();

        $notifications = array();

        foreach ($deals as $key => $deal) {

            $row = DB::table('buy_sell_conversations')
                    ->join('buy_sells', 'buy_sells.id', '=', 'buy_sell_conversations.buy_sell_id')
                    ->join('inventories', 'inventories.id', '=', 'buy_sells.seller_cat_id')
                    ->join('categories', 'categories.id', '=', 'inventories.commodity')
                    ->where('buy_sell_conversations.buy_sell_id', $deal->id)
                    ->orderBy('buy_sell_conversations.id', 'desc')
                    ->limit(1)
                    ->select('categories.category', 'buy_sells.*', 'buy_sell_conversations.user_id');

            $data = $row->first();

            if($data->user_id != $currentuserid){

                $notifications[$key] = $data;
            }
        };
        return view("user.notifications", array('notifications' => $notifications));
    }

    //Corporate Buying
    public function corporate_buying(Request $request)
    {
        $inv_id = $request->inv_id;
        $corporate_user = $request->corporate_user;
        $weight = $request->weight;

        if(is_numeric($inv_id) && $inv_id)
        {
            //Get Inventory
            $inventory = DB::table('inventories')
                ->join('user_details', 'user_details.user_id', '=', 'inventories.user_id')
                ->join('categories', 'categories.id', '=', 'inventories.commodity')
                ->join('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
                ->select('user_details.fname', 'inventories.*', 'categories.category', 'warehouses.warehouse_code', 'warehouses.name as warehouse')
                ->where(['inventories.id' => $inv_id, 'inventories.status' => 1])
                ->first();
            
            $corporate_price = DB::table('corporate_price')
                        ->where('status', 1)
                        ->get();
            if($inventory){
                //Get Corporate User
                $user_data = DB::table('apna_corporate_users')
                    ->join('users', 'users.id', '=', 'apna_corporate_users.user_id')
                    ->join('warehouses', 'warehouses.id', '=', 'apna_corporate_users.terminal_id')
                    ->where('apna_corporate_users.id', $request->corporate_user)
                    ->select('apna_corporate_users.*', 'users.fname as user_name', 'users.phone', 'warehouses.name as terminal_name', 'warehouses.warehouse_code')
                    ->first();

                return view("corporate_buying.index", array('inventory' => $inventory, 'user_data' => $user_data, 'weight' => $weight, 'inv_id' => $inv_id));
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }

    //Corporate Bid Deal Done
    public function corporate_deal_done(Request $request)
    {
        $invetory_id = $request->inventory_id;
        $price = $request->final_bid_price;
        $bid_for = $request->bid_for;
        $todays_price = $request->todays_price;
        $quantity = $request->quantity;
        $mandi_fees = $request->mandi_fees;
        $user_id = $request->user_id;
        $date = date('Y-m-d H:i:s');

        // Update inventory quantity
        $inventories = DB::table('inventories')->where('id', $invetory_id)->update([
            'sales_status' => 2,
            'sell_quantity' => $quantity,
            'updated_at' => $date
        ]);

        $currentuserid = Auth::user()->id;

        $buy_sell_id = DB::table('buy_sells')->insertGetId([
            'buyer_id' => $user_id,
            'seller_id' => $currentuserid,
            'seller_cat_id' => $invetory_id,
            'quantity' => $quantity,
            'price' => $price,
            'todays_price' => $todays_price,
            'mandi_fees' => $mandi_fees,
            'bid_type' => 2,
            'status' => 2,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        $admin_sms = 'Apna Godam - New Corporate bid for Approval. ';

        // send sms on mobile number using curl
        //$success = sendsms(9314142089, $admin_sms);

        $sms = 'Apna Godam - Your deal has been successfully done.';

        // send sms on mobile number using curl
        $success = sendsms(Auth::user()->phone, $sms);

        return redirect('inventories')->with('status', 'Your deal has been done. Please wait for admin approval');
    }

    // Re Download  vikray parchi
    public function download_user_vikray_parchi(Request $request){

        $deal_id = $request->id;

        $done_deals = DB::table('buy_sells')
            ->join('user_details','user_details.user_id', '=', 'buy_sells.buyer_id')
            ->join('users','users.id', '=', 'buy_sells.seller_id')
            ->join('inventories as inv', 'inv.id', '=', 'buy_sells.seller_cat_id')
            ->join('categories', 'categories.id', '=', 'inv.commodity')
            ->join('warehouses', 'warehouses.id', '=', 'inv.warehouse_id')
            ->join('mandi_samitis', 'mandi_samitis.id', '=', 'warehouses.mandi_samiti_id')
            ->join('warehouse_rent_rates', 'warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
            ->where('buy_sells.id', $deal_id)
            ->select('buy_sells.*', 'user_details.fname as buyer_name', 'user_details.mandi_license', 'users.fname as seller_name', 'categories.category', 'warehouses.name as warehouse',  'warehouses.id as warehouse_id', 'warehouses.warehouse_code', 'warehouse_rent_rates.location', 'inv.quality_category', 'inv.sales_status', 'inv.truck_no', 'mandi_samitis.name as mandi_samiti_name')
            ->first();

        $buyer_id = $done_deals->buyer_id;
        $seller_id = $done_deals->seller_id;

        $buyer_info = DB::table('user_details')->where('user_id', $buyer_id)->first();

        $seller_info = DB::table('user_details')->where('user_id', $seller_id)->first();
        $done_deals->seller_address = $seller_info->area_vilage;
        $done_deals->buyer_address = $buyer_info->area_vilage;

        $data = json_decode(json_encode($done_deals),true);

        $pdf = PDF::loadView('vikray_parchi_pdf', $data);
        return $pdf->download('vikray_parchi.pdf');
    }

    //get_corporate_users_ajax
    public function get_corporate_users_ajax(Request $request)
    {
        $data = DB::table('apna_corporate_users')
                ->join('users', 'users.id', '=', 'apna_corporate_users.user_id')
                ->join('warehouses', 'warehouses.id', '=', 'apna_corporate_users.terminal_id')
                ->where('apna_corporate_users.status', 1)
                ->select('apna_corporate_users.*', 'users.fname as user_name', 'warehouses.name as terminal_name', 'warehouses.warehouse_code')
                ->get();

        $res = '<option value="">Select Buyer</option>';
        foreach($data as $user)
        {
            $res .= '<option value="'.$user->id.'">'.$user->user_name.' ('.$user->terminal_name.')  ('.$user->location.') ('.$user->warehouse_code.')</option>';
        }

        echo $res;
        die;
    }
}
