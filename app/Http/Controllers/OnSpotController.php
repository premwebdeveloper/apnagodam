<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;

class OnSpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function on_spot_inventories()
    {
        $currentuserid = Auth::user()->id;

        $user = DB::table('user_details')->where('user_id', $currentuserid)->first();

        // Get today's commodity price
        $today_prices = DB::table('today_prices')->where('status', 1)->where('created_at', '=', date('Y-m-d'))->get();

        //Get All Bank Master
        $banks_master = DB::table('bank_master')->where('status', 1)->get();

        $inventories = DB::table('on_spot_inventories')
                        ->leftJoin('warehouses', 'warehouses.id', '=', 'on_spot_inventories.warehouse_id')
                        ->leftJoin('warehouse_rent_rates', 'warehouses.id', '=', 'warehouse_rent_rates.warehouse_id')
                        ->leftJoin('categories', 'categories.id', '=', 'on_spot_inventories.commodity')
                        ->select('on_spot_inventories.*', 'categories.category as cat_name', 'warehouses.name', 'warehouses.warehouse_code', 'warehouse_rent_rates.location')
                        ->where(['on_spot_inventories.status' => 1, 'on_spot_inventories.user_id' => $currentuserid])
                        ->get();
        foreach ($inventories as $key => $value) {
            $value->case_id = DB::table('inventory_cases_id')->where('inventory_id', $value->id)->get();
        }

        return view("on_spot.inventory", array('user' => $user, 'inventories' => $inventories));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function on_spot_deals()
    {
        $currentuserid = Auth::user()->id;

        // Get all sell products
        $deals = DB::table('on_spot_buy_sells')
            ->join('inventories', 'inventories.id', '=', 'on_spot_buy_sells.seller_cat_id')
            ->leftjoin('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
            ->leftjoin('warehouse_rent_rates', 'warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
            ->leftjoin('categories', 'categories.id', '=', 'inventories.commodity')
            ->leftjoin('user_details', 'user_details.user_id', '=', 'on_spot_buy_sells.buyer_id')
            ->where(['on_spot_buy_sells.seller_id' => $currentuserid, 'on_spot_buy_sells.status' => '3'])
            ->orwhere(['on_spot_buy_sells.buyer_id' => $currentuserid, 'on_spot_buy_sells.status' => '3'])
            ->select('on_spot_buy_sells.*', 'categories.category', 'inventories.quality_category', 'warehouses.name', 'warehouse_rent_rates.location','user_details.fname', 'inventories.sales_status')
            ->get();

        return view("on_spot.deals", array('deals' => $deals));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
