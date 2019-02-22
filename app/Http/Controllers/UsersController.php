<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
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
		//$this->middleware('userOnly');
	}

    // User user_dashboard
    public function user_dashboard(){

        $currentuserid = Auth::user()->id;

        $user = DB::table('user_details')->where('user_id', $currentuserid)->first();

        return view("user.dashboard", array('user' => $user));
    }

    // User profile view
    public function profile(){

        $currentuserid = Auth::user()->id;

        $user = DB::table('user_details')->where('user_id', $currentuserid)->first();

        return view("user.profile", array('user' => $user));
    }


    // User profile view
    public function inventories(){

        echo time();
        die;

        $currentuserid = Auth::user()->id;

        $user = DB::table('user_details')->where('user_id', $currentuserid)->first();

        $inventories = DB::table('inventories')
                        ->join('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
                        ->join('categories', 'categories.id', '=', 'inventories.commodity')
                        ->select('inventories.*', 'categories.category as cat_name', 'warehouses.name', 'warehouses.village')
                        ->where(['inventories.status' => 1, 'inventories.user_id' => $currentuserid])
                        ->get();

        return view("user.inventory", array('user' => $user, 'inventories' => $inventories));
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
        $inventories =  DB::table('inventories')
                        ->join('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
                        ->join('categories', 'categories.id', '=', 'inventories.commodity')
                        ->leftjoin('finances as fin','fin.commodity_id', '=', 'inventories.id')
                        ->where('inventories.user_id', $currentuserid)
                        ->select('fin.status as finance_status', 'fin.id as finance_id', 'inventories.*', 'categories.category', 'warehouses.name')
                        ->get();

        return view("user.finance", array('inventories' => $inventories));
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
            'account_number' => 'required',
            'bank_name' => 'required',
            'account_number' => 'required',
            'ifsc_code' => 'required',
            'branch_name' => 'required',
            'pan_card' => 'required | mimes:jpeg,jpg,png,gif,bmp | max:1000',
            'aadhar_card' => 'required | mimes:jpeg,jpg,png,gif,bmp | max:1000',
            'balance_sheet' => 'required | mimes:jpeg,jpg,png,gif,bmp | max:1000',
            'bank_statement' => 'required | mimes:jpeg,jpg,png,gif,bmp | max:1000',
        ]);

        $commodity_id = $request->commodity_id;
        $bank_name = $request->bank_name;
        $account_number = $request->account_number;
        $ifsc_code = $request->ifsc_code;
        $branch_name = $request->branch_name;
        $quantity = $request->quantity;
        $amount = $request->amount;
        $date = date('Y-m-d H:i:s');

        // First get commodity informatioon
        $commodity_info = DB::table('inventories')->where('id', $commodity_id)->first();

        if($commodity_info->quantity < $quantity):

            $status = 'You can not apply for loan on more than quantity you have !';
            return redirect('request_for_loan/'.$commodity_id)->with('status', $status);

        endif;

        # Pan Card Upload
        if($request->hasFile('pan_card')) {

            $file = $request->pan_card;

            $pan_card = $file->getClientOriginalName();

            $ext = pathinfo($pan_card, PATHINFO_EXTENSION);

            $pan_card = substr(md5(microtime()),rand(0,26),6);

            $pan_card .= '.'.$ext;

            $destinationPath = base_path() . '/resources/assets/upload/pancards/'.$currentuserid.'/';
            $file->move($destinationPath,$pan_card);
            $filepath = $destinationPath.$pan_card;
        }

        # Aadhar Card Upload
        if($request->hasFile('aadhar_card')) {

            $file = $request->aadhar_card;

            $aadhar_card = $file->getClientOriginalName();

            $ext = pathinfo($aadhar_card, PATHINFO_EXTENSION);

            $aadhar_card = substr(md5(microtime()),rand(0,26),6);

            $aadhar_card .= '.'.$ext;

            $destinationPath = base_path() . '/resources/assets/upload/aadharcards/'.$currentuserid.'/';
            $file->move($destinationPath,$aadhar_card);
            $filepath = $destinationPath.$aadhar_card;
        }

        # Balance Sheet Upload
        if($request->hasFile('balance_sheet')) {

            $file = $request->balance_sheet;

            $balance_sheet = $file->getClientOriginalName();

            $ext = pathinfo($balance_sheet, PATHINFO_EXTENSION);

            $balance_sheet = substr(md5(microtime()),rand(0,26),6);

            $balance_sheet .= '.'.$ext;

            $destinationPath = base_path() . '/resources/assets/upload/balancesheets/'.$currentuserid.'/';
            $file->move($destinationPath,$balance_sheet);
            $filepath = $destinationPath.$balance_sheet;
        }

        # Bank Statement Upload
        if($request->hasFile('bank_statement')) {

            $file = $request->bank_statement;

            $bank_statement = $file->getClientOriginalName();

            $ext = pathinfo($bank_statement, PATHINFO_EXTENSION);

            $bank_statement = substr(md5(microtime()),rand(0,26),6);

            $bank_statement .= '.'.$ext;

            $destinationPath = base_path() . '/resources/assets/upload/bankstatements/'.$currentuserid.'/';
            $file->move($destinationPath,$bank_statement);
            $filepath = $destinationPath.$bank_statement;
        }

        // Insert entry with all required fields
        $last_id = DB::table('finances')->insertGetId([
            'user_id' => $currentuserid,
            'bank_name' => $bank_name,
            'branch_name' => $branch_name,
            'acc_number' => $account_number,
            'ifsc' => $ifsc_code,
            'pan' => $pan_card,
            'aadhar' => $aadhar_card,
            'balance_sheet' => $balance_sheet,
            'bank_statement' => $bank_statement,
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
            $done = sendsms($admin_phone->phone, $sms);

            $sms = 'Apna Godam - You have requested for loan successfully.';
            // send sms to user for loan request
            $success = sendsms($user_info->phone, $sms);

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
                        ->where('finances.id', $finance_id)
                        ->select('finances.*', 'inv.commodity', 'inv.quantity', 'fin_res.bank_name as res_bank_name', 'fin_res.amount as res_amount', 'fin_res.interest as res_interest', 'categories.category')
                        ->first();

        $agree = [];
        $agree['1'] = 'yes';
        $agree['0'] = 'no';

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
    public function deals(){

        $currentuserid = Auth::user()->id;

        // Get all sell products
        $sells = DB::table('buy_sells')
                ->join('inventories', 'inventories.id', '=', 'buy_sells.seller_cat_id')
                ->join('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
                ->join('categories', 'categories.id', '=', 'inventories.commodity')
                ->join('user_details', 'user_details.user_id', '=', 'buy_sells.buyer_id')
                ->where(['buy_sells.seller_id' => $currentuserid, 'buy_sells.status' => '3'])
                ->select('buy_sells.*', 'categories.category', 'inventories.quality_category', 'warehouses.name', 'warehouses.village','user_details.fname')
                ->get();

        // Get all buy products
        $buys = DB::table('buy_sells')
                ->join('inventories', 'inventories.id', '=', 'buy_sells.seller_cat_id')
                ->join('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
                ->join('categories', 'categories.id', '=', 'inventories.commodity')
                ->where(['buy_sells.buyer_id' => $currentuserid, 'buy_sells.status' => '2'])
                ->select('buy_sells.*', 'categories.category', 'inventories.quality_category', 'warehouses.name', 'warehouses.village')
                ->get();

        return view("user.deals", array('sells' => $sells, 'buys' => $buys));
    }

    // Bidding on deal
    public function bidding(Request $request){

        $currentuserid = Auth::user()->id;

        $inventory_id = $request->inventory_id;

        $inventory_info = DB::table('inventories')
                ->join('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
                ->join('categories', 'categories.id', '=', 'inventories.commodity')
                ->where('inventories.id', $inventory_id)
                ->select('categories.category', 'warehouses.name', 'inventories.*')
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

        if(!empty($last_bid)){

            if($last_bid->price >= $my_bid){

                return redirect('bidding/'.$inventory_id)->with('status', 'You can not bid less than last bid price !');
            }

        }else{

            // If user bid amount is less than commodity price than hit error
            if($inventory_info->price >= $my_bid){

                return redirect('bidding/'.$inventory_id)->with('status', 'You can not bid less than commodity price !');
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

        // If the buyer so not have enough power then hit error
        if($buyer_info->power < $inventory_info->sell_quantity * $my_bid){

            return redirect('bidding/'.$inventory_id)->with('status', 'You do not have the power to bid this amount! Please contact to administrator.');
        }

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
        $sms = "Trader Bid ".$my_bid. " RS. on your inventory." ;
        $done = sendsms($user->phone, $sms);

        if(!empty($all_bid{0})){

            foreach ($all_bid as $key => $data) {

                //Send Message to another buyer and farmer
                $user = DB::table('users')->where('id', $data->user_id)->first();

                $sms = "Trader Bid ".$my_bid. " RS. on curernt Inventory." ;
                $success = sendsms($user->phone, $sms);
            }
        }

        /*if($bid){

            if(!empty($last_dealer_bid)){

                // if seller and buyers last bid is same then deal done
                if($last_dealer_bid->price == $my_bid){

                    // If my bid and dealer bid is same then deal done
                    $done = DB::table('buy_sells')->where('id', $deal_id)->update([

                        'price' => $my_bid,
                        'status' => 2,
                        'updated_at' => $date
                    ]);

                    // deal done after get seller and buyer id
                    $seller_buyer_id = DB::table('buy_sells')->where('seller_cat_id', $last_dealer_bid->seller_cat_id)->first();

                    // get old total and sell quantity of this inventory
                    $sell_quantity = DB::table('inventories')->where('id', $last_dealer_bid->seller_cat_id)->first();

                    // remaining total and sell quantity
                    $total_quantity = $sell_quantity->quantity - $deal_quantity;
                    $remaining_sell_quantity = $sell_quantity->sell_quantity - $deal_quantity;

                    // If deal done then update sell quantity and total quantity
                    $update_sell_quantity = DB::table('inventories')->where('id', $sell_quantity->id)->update([

                        'quantity' => $total_quantity,
                        'sell_quantity' => $remaining_sell_quantity,
                        'updated_at' => $date,
                    ]);

                    // update buyer commodity in inventories table if not exist this commodity of this buyer then insert this commodity to this buyer
                    // First check if this buyer have this commodity or not
                    $check_commodity = DB::table('inventories')->where(['user_id' => $buyer_id, 'commodity' => $last_dealer_bid->commodity, 'warehouse_id' => $last_dealer_bid->warehouse_id])->first();

                    // If the same commodity is exist in the same warehouse of this buyer then update quantity
                    if(!empty($check_commodity)){

                        // update quantity
                        $update_commodity = DB::table('inventories')->where('id', $check_commodity->id)->update([

                            'quantity' => $deal_quantity + $check_commodity->quantity,
                        ]);

                    }else{

                        // if this commodity is not exist in this warehouse then insert this commodity
                        // insert quantity
                        $insert_commodity = DB::table('inventories')->insert([

                            'user_id' => $buyer_id,
                            'warehouse_id' => $last_dealer_bid->warehouse_id,
                            'commodity' => $last_dealer_bid->commodity,
                            'quantity' => $deal_quantity,
                            'price' => 0,
                            'status' => 1,
                            'created_at' => $date,
                            'updated_at' => $date
                        ]);
                    }

                    // update power of this buyer on deal done
                    $power_update = DB::table('user_details')->where('user_id', $buyer_info->user_id)->update([

                        'power' => $buyer_info->power - $last_dealer_bid->quantity*$my_bid,
                        'updated_at' => $date
                    ]);

                    // then request price and seller price is equal send msg (buyer, seller and admin)
                    $admin = DB::table('users')->where('id', 1)->first();

                    $buyer_phone = DB::table('users')->where('id', $seller_buyer_id->buyer_id)->first();

                    $seller_phone = DB::table('users')->where('id', $seller_buyer_id->seller_id)->first();

                    // mobile no array
                    $mobilesArr = array($admin->phone,$buyer_phone->phone,$seller_phone->phone);

                    // send otp on mobile number using curl
                    $url = "http://bulksms.dexusmedia.com/sendsms.jsp";
                    //$mobiles = implode(",", $mobilesArr);
                    $sms = 'Deal Done Successfully';

                    $mobiles = implode(",", $mobilesArr);

                    $params = array(
                                "user" => "apnagodam",
                                "password" => "45cfd8bb21XX",
                                "senderid" => "apnago",
                                "mobiles" => $mobiles,
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

                    $status = 'Deal done successfully.';

                    // redirect to the deals page
                    return redirect('deals/')->with('status', $status);
                }
                else{

                    // buyer - seller phone info
                    $buyer_phone_info = DB::table('user_details')->where('user_id', $last_dealer_bid->user_id)->first();

                    // Bid sms for buyer and seller
                    $url = "http://bulksms.dexusmedia.com/sendsms.jsp";

                    $sms = 'Request - RS '.$my_bid;

                    $mobiles = $buyer_phone_info->phone;

                    $params = array(
                                "user" => "apnagodam",
                                "password" => "45cfd8bb21XX",
                                "senderid" => "apnago",
                                "mobiles" => $mobiles,
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

                    $status = 'Bid submitted successfully.';
                }
            }
            else{

                $status = 'Bid submitted successfully.';
            }

        }else{

            $status = 'Something went wrong !';
        }*/

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
                    'status' => 2,
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

        if($done){

            //Send Message to Other trader who do not take this bid
            foreach ($user_ids as $key => $value) {
                $user = DB::table('users')->where('id', $value)->first();
                //Send Message after Deal Done
                $sms = 'This deal done on '.$max_bid." RS." ;
                $done = sendsms($user->phone, $sms);
            }

            //Send messsage to trader(Buyer)
            if($buyer_id)
            {
                $user = DB::table('users')->where('id', $buyer_id)->first();

                //Send Message after Deal Done
                $sms = 'Congratulations. Your Bid accepted by farmer amount by '.$max_bid." RS.";
                $done = sendsms($user->phone, $sms);
            }

            // get old sell quantity of this inventory
            // $inventory_info = DB::table('inventories')->where('id', $inventory_id)->first();

            // $remaining_quantity = $inventory_info->quantity - $inventory_info->sell_quantity;

            // // update inventory / qauantity of farmaer
            // $update_sell_quantity = DB::table('inventories')->where('id', $inventory_info->id)->update([

            //     'quantity' => $remaining_quantity,
            //     'sell_quantity' => 0,
            //     'updated_at' => $date,
            // ]);

            // // update inventory / quantity of trader
            // $trader_inventory = DB::table('inventories')->where(['user_id' => $buyer_id, 'commodity' => $inventory_info->commodity])->first();

            // If trader have this commodity already then update quantity
            // if(!empty($trader_inventory)){

            //     $update_trader_quantity = DB::table('inventories')->where('id', $trader_inventory->id)->update([

            //         'quantity' => $trader_inventory->quantity + $inventory_info->sell_quantity,
            //         'updated_at' => $date,
            //     ]);

            // }else{

            //     // If trader do not have this commodity already then insert this commodity with this teader
            //     $insert_commodity = DB::table('inventories')->insert([

            //         'user_id' => $buyer_id,
            //         'warehouse_id' => $inventory_info->warehouse_id,
            //         'commodity' => $inventory_info->commodity,
            //         'quantity' => $inventory_info->sell_quantity,
            //         'status' => 1,
            //         'created_at' => $date,
            //         'updated_at' => $date,
            //     ]);
            // }

            // Update power in users details table
            // first get power
            //$buyer_info = DB::table('user_details')->where('user_id', $buyer_id)->first();

            // $update_buyers_power = DB::table('user_details')->where('user_id', $buyer_id)->update([

            //     'power' => $buyer_info->power - ($inventory_info->sell_quantity * $max_bid),
            //     'updated_at' => $date,
            // ]);

            $status = 'Deal Done.';
        }else{

            $status = 'Something went wrong !';
        }

        //return redirect('deals')->with('status', $status);
        return redirect('bidding/'.$inventory_id)->with('status', $status);
    }

    // show all notification to users
    public function notifications(Request $request){

        $currentuserid = Auth::user()->id;
        $date = date('Y-m-d H:i:s');

        // get all notification
        $deals = DB::table('buy_sells')
                        ->where(['buyer_id' => $currentuserid, 'status' => 1])
                        ->orWhere('seller_id', $currentuserid)
                        ->get();

        $notifications = array();

        echo '<pre>';
        print_r($deals);


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

                   //echo ($row->tosql());

            print_r($data);

            if($data->user_id != $currentuserid){

                $notifications[$key] = $data;
            }
        };
        return view("user.notifications", array('notifications' => $notifications));
    }
}
