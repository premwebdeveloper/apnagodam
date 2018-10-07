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
		$this->middleware('userOnly');
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

        $currentuserid = Auth::user()->id;

        $user = DB::table('user_details')->where('user_id', $currentuserid)->first();

        $inventories = DB::table('inventories')
                        ->join('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
                        ->join('categories', 'categories.id', '=', 'inventories.commodity')
                        ->select('inventories.*', 'categories.category as cat_name', 'warehouses.name')
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

        // if user disagree for loan then delete all enteries
        if($agree == 0){

            $finance_del = DB::table('finances')->where('id', $finance_id)->delete();
            $finance_res_del = DB::table('finance_responses')->where('finance_id', $finance_id)->delete();

            if($finance_res_done){

                $status = 'You refused the request for loan. You can request again.';
            }else{

                $status = 'Something went wrong !';
            }

            return redirect('user_finance_view')->with('status', $status);  

        }else{

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

        $inventories = DB::table('inventories')->where('id', $invetory_id)->update([

                'sell_quantity' => $sell_quantity,
                'price' => $price,
                'updated_at' => $date
            ]);

        if($inventories){

            $status = 'Price and quantity updated successfully.';
        }else{

            $status = 'Something went wrong !';
        }

        return redirect('inventories')->with('status', $status);
    } 

    // User notification
    public function deals(){

        $currentuserid = Auth::user()->id;

        // Get all sell products
        $sells = DB::table('buy_sells')
                ->join('inventories', 'inventories.id', '=', 'buy_sells.seller_cat_id')
                ->join('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
                ->join('categories', 'categories.id', '=', 'inventories.commodity')
                ->where('buy_sells.seller_id', $currentuserid)
                ->select('buy_sells.*', 'categories.category', 'warehouses.name')
                ->get();

        // Get all buy products
        $buys = DB::table('buy_sells')
                ->join('inventories', 'inventories.id', '=', 'buy_sells.seller_cat_id')
                ->join('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
                ->join('categories', 'categories.id', '=', 'inventories.commodity')
                ->where('buy_sells.buyer_id', $currentuserid)
                ->select('buy_sells.*', 'categories.category', 'warehouses.name')
                ->get();

        return view("user.deals", array('sells' => $sells, 'buys' => $buys));
    }

    // Bidding on deal
    public function bidding(Request $request){

        $currentuserid = Auth::user()->id;

        $deal_id = $request->deal_id;

        $deal_info = DB::table('buy_sells')
                ->join('inventories', 'inventories.id', '=', 'buy_sells.seller_cat_id')
                ->join('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
                ->join('categories', 'categories.id', '=', 'inventories.commodity')
                ->where('buy_sells.id', $deal_id)
                ->select('buy_sells.*', 'categories.category', 'warehouses.name', 'inventories.user_id as seller_id')
                ->first();

        $deal = DB::table('buy_sell_conversations')
                ->join('buy_sells', 'buy_sells.id', '=', 'buy_sell_conversations.buy_sell_id')
                ->select('buy_sells.*', 'buy_sell_conversations.user_id', 'buy_sell_conversations.price')
                ->where('buy_sell_conversations.buy_sell_id', $deal_id)
                ->get();

        return view("user.bidding", array('deal' => $deal, 'deal_info' => $deal_info));
    }

    // Seller self bid
    public function seller_bid(Request $request){

        $currentuserid = Auth::user()->id;

        $deal_id = $request->deal_id;
        $my_bid = $request->my_bid;
        $date = date('Y-m-d H:i:s');

        // insert bid price for this deal
        $bid = DB::table('buy_sell_conversations')->insert([

            'buy_sell_id' => $deal_id,
            'user_id' => $currentuserid,
            'price' => $my_bid,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($bid){

            // Get old bids
            $last_dealer_bid = DB::table('buy_sell_conversations')
                            ->join('buy_sells', 'buy_sells.id', '=', 'buy_sell_conversations.buy_sell_id')
                            ->where(['buy_sell_id' => $deal_id, 'user_id', '!=', $currentuserid])
                            ->orderBy('id', 'desc')
                            ->limit(1)
                            ->select('buy_sells.seller_cat_id', 'buy_sells.quantity', 'buy_sell_conversations.*')
                            ->first();

            // if seller and buyers last bid is same then deal done
            if($last_dealer_bid->price == $my_bid){

                $done = DB::table('buy_sells')->where('id', $deal_id)->update([

                    'price' => $my_bid,
                    'status' => 2,
                    'updated_at' => $date
                ]);

                // get old sell quantity of this inventory
                $sell_quantity = DB::table('inventories')->where('id', $last_dealer_bid->seller_cat_id)->first();

                $remaining_sell_quantity = $sell_quantity->sell_quantity - $last_dealer_bid->quantity;

                // If deal done then update sell quantity
                $update_sell_quantity = DB::table('inventories')->where('id', $sell_quantity->id)->update([

                    'sell_quantity' => $remaining_sell_quantity,
                    'updated_at' => $date,
                ]);
            }

            $status = 'Bid submitted successfully.';
        }else{

            $status = 'Something went wrong !';
        }

        return redirect('bidding/'.$deal_id)->with('status', $status);
    }

    // deal done by seller
    public function deal_done(Request $request){

        $deal_id = $request->deal_id;
        $date = date('Y-m-d H:i:s');

        // get last bid price of this deal
        $last_price = DB::table('buy_sell_conversations')->where('buy_sell_id', $deal_id)
                        ->join('buy_sells', 'buy_sells.id', '=', 'buy_sell_conversations.buy_sell_id')
                        ->orderBy('id', 'desc')
                        ->limit(1)
                        ->select('buy_sells.seller_cat_id', 'buy_sells.quantity', 'buy_sell_conversations.*')
                        ->first();

        // Get inventory quantity n all to update quantity after deal done
        $done = DB::table('buy_sells')->where('id', $deal_id)->update([

            'price' => $last_price->price,
            'status' => 2,
            'updated_at' => $date
        ]);

        if($done){

            // get old sell quantity of this inventory
            $sell_quantity = DB::table('inventories')->where('id', $last_price->seller_cat_id)->first();

            $remaining_sell_quantity = $sell_quantity->sell_quantity - $last_price->quantity;

            // If deal done then update sell quantity
            $update_sell_quantity = DB::table('inventories')->where('id', $sell_quantity->id)->update([

                'sell_quantity' => $remaining_sell_quantity,
                'updated_at' => $date,
            ]);

            $status = 'Deal Done.';
        }else{

            $status = 'Something went wrong !';
        }

        return redirect('deals')->with('status', $status);

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


            
            print_r($notifications);
            exit;


        return view("user.notifications", array('notifications' => $notifications));
    }
}
