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
                
                $status = 'Request submitted successfully.';
            }   

            
        }else{
            
            $status = 'Something went wrong !';
        }
        
        return Redirect::back()->withErrors([$status]);
    }
}
