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

class FarmerController extends Controller
{
    // Construct function 
    public function __construct(){

        // Only authenticated and user enter here
        $this->middleware('auth');
        $this->middleware('farmerOnly');
    }

    // Farmer profile view
    public function profile(){

        $currentuserid = Auth::user()->id;

        $user = DB::table('user_details')->where('user_id', $currentuserid)->first();

        return view("farmer.profile", array('user' => $user));
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

        return view("farmer.inventory", array('user' => $user, 'inventories' => $inventories));
    }
}
