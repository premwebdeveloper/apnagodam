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

        return view('finance.index');
    }

    // Create finance view page
    public function create_finance_view(){

        return view('finance.create_finance');
    }

    // Create finance
    public function create_finance(Request $request){

        
    }

}
