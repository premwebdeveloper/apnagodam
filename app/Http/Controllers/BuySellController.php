<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;

class BuySellController extends Controller
{
    // Construct function 
    public function __construct(){

        // Only authenticated and user enter here
        $this->middleware('auth');
        $this->middleware('userOnly');
    }

    public function index()
    {
        $categories = DB::table('categories')->where('status', 1)->get();
        
        return view('buy_sell.index', array('categories' => $categories));
    }

    public function view(Request $request)
    {
        $current_user_id = Auth::user()->id;

        $cat_id = $request->id;

        $categories = DB::table('categories')->where('status', 1)->get();

        $cat = DB::table('categories')->where(['status' => 1, 'id' => $cat_id])->first();

        $inventories = DB::table('inventories')
                        ->leftjoin('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
                        ->select('warehouses.name as warehouse', 'inventories.*')
                        ->where('inventories.user_id', '!=', $current_user_id)
                        ->where('inventories.status', '=', 1)
                        ->where('inventories.commodity', '=', $cat_id)
                        ->where('inventories.sell_quantity', '>', 0)
                        ->where('inventories.sell_quantity', '!=', null)
                        ->get();

        return view('buy_sell.view', array('categories' => $categories, 'inventories' => $inventories, 'cat' => $cat));
    }

    public function purchasing(Request $request)
    {
        $current_user_id = Auth::user()->id;
        $invnt_attr = $request->invnt_attr;
        $req_quantity = $request->req_quantity;
        $price = $request->price;
        $date = date('Y-m-d H:i:s');

        $invnt_attr = explode('_', $invnt_attr);
        $inventory_id = $invnt_attr[0];
        $seller_id = $invnt_attr[1];

        // first check buyer power / buyer can puchase or not
        $buyer_info = DB::table('user_details')->where('user_id', $current_user_id)->first();

        // Get buyer power
        $buyer_power = $buyer_info->power;


        // If buyer have not the power to purchase this amount of commodity then through back with error
        if($buyer_power < $req_quantity*$price){

            return Redirect::back()->withErrors(['You do not have the power to puchase this commodity. Please contact to Administrator.']);
        }

        // First check required quantity is more than exist quantity or not
        $inventory = DB::table('inventories')
                        ->where('inventories.id', '=', $inventory_id)
                        ->first();
                        
        // Get Commodity Name for SMS
        $commodity_name = DB::table('categories')
                        ->where('id', '=', $inventory->commodity)
                        ->first();
        
        // Requested quantity should be less than or equal to available quantity
        if($req_quantity > $inventory->sell_quantity){

            return Redirect::back()->withErrors(['There is not sufficient bags exist.']);
        }

        // Requested price should be less than or equal to sell price
        if($price > $inventory->price){

            return Redirect::back()->withErrors(['This price is not valid!']);
        }

        // Check if the sell price and bid price is same then deal done at same timw
        if($price == $inventory->price){
            $buy_sell_status = 2;
            $deal_price = $price;

            // then request price and seller price is equal send msg (buyer, seller and admin)
            $admin = DB::table('users')->where('id', 1)->first();
            
            $buyer_phone = DB::table('users')->where('id', $current_user_id)->first();

            $seller_phone = DB::table('users')->where('id', $seller_id)->first();

            // mobile number in array
            $mobilesArr = array($admin->phone,$buyer_phone->phone,$seller_phone->phone);

/*            //admin sms
            $admin_sms = 'Deal Done Successfully! Buyer - '.$buyer_phone->fname.' and Seller - '.$seller_phone->fname;

            //buyer sms 
            $buyer_sms = 'Deal Done Successfully! RS - '.$deal_price;

            //seller sms
            $seller_sms = 'Deal Done Successfully! RS - '.$deal_price;

            // sms in array
            $smsArr = array($admin_sms,$buyer_sms,$seller_sms);*/

            // send otp on mobile number using curl
            $url = "http://bulksms.dexusmedia.com/sendsms.jsp";                    
            
            //$mobiles = implode(",", $mobilesArr);
            $mobiles = implode(",", $mobilesArr); 

            //$sms = implode(",", $smsArr);
            //$sms = implode(",", $smsArr);
            $sms = "Deal Done Successfully!";
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

        }else{
            $buy_sell_status = 1;
            $deal_price = null;
        }

        // indrty the deal in buy sell table
        $last_id = DB::table('buy_sells')->insertGetId([
            'buyer_id' => $current_user_id,
            'seller_id' => $seller_id,
            'seller_cat_id' => $inventory_id,
            'quantity' => $req_quantity,
            'price' => $deal_price,
            'status' => $buy_sell_status,
            'created_at' => $date,
            'updated_at' => $date
        ]); 

        // insert Conversation detail
        $insert = DB::table('buy_sell_conversations')->insert([
            'buy_sell_id' => $last_id,
            'user_id' => $current_user_id,
            'price' => $price,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($insert){

            // update the sell price in case deal is done / request and sell price is same then update
            if($price == $inventory->price){
                
                // update sellers commodity in inventories table
                $update_sell_price = DB::table('inventories')->where('id', $inventory->id)->update([

                    'quantity' => $inventory->quantity - $req_quantity,
                    'sell_quantity' => $inventory->sell_quantity - $req_quantity,
                    'updated_at' => $date,
                ]);

                // update buyer commodity  in inventories table if not exist this commodity of this buyer then inseert this commodity to this buyer
                // First check if this buyer have this commodity or not
                $check_commodity = DB::table('inventories')->where(['user_id' => $current_user_id, 'commodity' => $inventory->commodity, 'warehouse_id' => $inventory->warehouse_id])->first();

                if(!empty($check_commodity)){

                    // update quantity
                    $update_commodity = DB::table('inventories')->where('id', $check_commodity->id)->update([

                        'quantity' => $req_quantity + $check_commodity->quantity,
                    ]);

                }else{

                    // insert quantity
                    $insert_commodity = DB::table('inventories')->insert([

                        'user_id' => $current_user_id,
                        'warehouse_id' => $inventory->warehouse_id,
                        'commodity' => $inventory->commodity,
                        'quantity' => $req_quantity,
                        'price' => 0,
                        'status' => 1,
                        'created_at' => $date,
                        'updated_at' => $date
                    ]);
                }


                // update buyer power on deal done
                $power_update = DB::table('user_details')->where('user_id', $current_user_id)->update([

                    'power' => $buyer_power - $req_quantity*$price,
                    'updated_at' => $date
                ]);
                
                $status = 'Deal done successfully.';
            }else{
                
                // the request price for seller
                $seller_phone = DB::table('users')->where('id', $seller_id)->first();

                // send otp on mobile number using curl
                $url = "http://bulksms.dexusmedia.com/sendsms.jsp";                    
                
                $sms = 'Request - RS '.$price.' for - '.$commodity_name->category.' Commodity';
                
                $mobiles = $seller_phone->phone;

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

                $status = 'Request submitted successfully.';
            }   

            
        }else{
            
            $status = 'Something went wrong !';
        }
        
        return Redirect::back()->withErrors([$status]);
    }
}
