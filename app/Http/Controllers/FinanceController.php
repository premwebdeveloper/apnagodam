<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;

class FinanceController extends Controller
{
    // Construct function 
	public function __construct(){

		// Only authenticarte and admin user can enter here
		$this->middleware('auth');
		$this->middleware('adminOnly');
	}

    // Finance Department
    public function index(){

        // Get all users request for loan on their commodity
        $requests =  DB::table('finances')
                        ->join('inventories as inv','inv.id', '=', 'finances.commodity_id')
                        ->join('user_details as user','user.user_id', '=', 'finances.user_id')
                        //->where(['finances.status' => $finance_id])
                        ->select('finances.*', 'inv.commodity', 'inv.quantity', 'user.fname')
                        ->get();


        return view('finance.index', array('requests' => $requests));
    }

    // View page for this finance request
    public function request_view(){

        return view('finance.view');
    }

    // Response for this finance request
    public function request_response(){

        return view('finance.response');
    }

}
