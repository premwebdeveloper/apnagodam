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

        $id = $request->id;

        $categories = DB::table('categories')->where('status', 1)->get();

        $cat = DB::table('categories')->where(['status' => 1, 'id' => $id])->first();

        $inventories = DB::table('inventories')
                        ->leftjoin('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
                        ->select('warehouses.name as warehouse', 'inventories.*')
                        ->where('inventories.user_id', '!=', $current_user_id)
                        ->where('inventories.status', '=', 1)
                        ->where('inventories.commodity', '=', $id)->get();
        return view('buy_sell.view', array('categories' => $categories, 'inventories' => $inventories, 'cat' => $cat));
    }

    public function conversation(Request $request)
    {
        $date = date('Y-m-d H:i:s');

        $invnt_id = $request->invnt_id;
        $seller_id = $request->seller_id;
        $buyer_id = $request->buyer_id;
        $req_quantity = $request->req_quantity;
        $conversation = $request->conversation;
        
        // Add Conversation
        $last_id = DB::table('buy_sells')->insertGetId([
            'buyer_id' => $buyer_id,
            'seller_id' => $seller_id,
            'seller_cat_id' => $invnt_id,
            'quantity' => $req_quantity,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]); 

        // insert Conversation detail
        $insert = DB::table('buy_sell_conversations')->insert([
            'buy_sell_id' => $invnt_id,
            'user_id' => $buyer_id,
            'conversation' => $conversation,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($insert){

            $status = 'Request submitted successfully.';
        }else{
            
            $status = 'Something went wrong !';
        }
        
        return Redirect::back()->withErrors([$status]);
    }
}
