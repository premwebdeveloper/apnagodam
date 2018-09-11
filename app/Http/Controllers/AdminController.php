<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class AdminController extends Controller
{
    // Construct function 
	public function __construct(){

		// Only authenticarte and admin user can enter here
		$this->middleware('auth');
		$this->middleware('adminOnly');
	}

	// Finance Department
	public function finance(){

		return view('admin.finance');
	}

	// Create finance view page
	public function create_finance_view(){

		return view('admin.create_finance');
	}

	// Create finance
	public function create_finance(Request $request){

		
	}

    // Admin dashboard view
    public function users(){

    	return view('admin.index');
    }

    // Add user page view
    public function add_user_view(){

    	return view('admin.add_user');
    }

    // Add User
    public function add_user(Request $request){


    		# Set validation for
	        $this->validate($request, [
	            'fname' => 'required',
	            'lname' => 'required',
	            'email' => 'required|email|unique:users',
	            'password' => 'required|min:6|confirmed',
	            'password_confirmation' => 'required|min:6',
	            'phone' => 'required|max:10|min:10',
	        ]);


			

    		echo $fname = $request->fname;
    		
    		exit;
    }
}
