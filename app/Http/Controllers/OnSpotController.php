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

        return view("on_spot.inventory", array('user' => $user, 'banks_master' => $banks_master, 'inventories' => $inventories, 'alll_loan' => $ids));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
