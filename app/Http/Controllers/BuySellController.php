<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

}
