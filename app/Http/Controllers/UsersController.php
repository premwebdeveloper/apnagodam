<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
	// Construct function 
	public function __construct(){

		// Only authenticated and user enter here
		$this->middleware('auth');
		$this->middleware('userOnly');
	}

    // User profile view
    public function profile(){

    	echo 'profile';
    	exit;
    }
}
