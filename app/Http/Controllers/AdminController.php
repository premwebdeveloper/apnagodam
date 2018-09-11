<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\user_details;
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

        $users = DB::table('user_details')->where('status', 1)->get();

    	return view('admin.index', array('users' => $users));
    }

    // Add user page view
    public function add_user_view(){

    	return view('admin.add_user');
    }

    // Add User
    public function add_user(Request $request){

        $date = date('Y-m-d H:i:s');
    		# Set validation for
	        $this->validate($request, [
	            'fname' => 'required',
	            'lname' => 'required',
	            'email' => 'required|email|unique:users',
	            'password' => 'required|min:6|confirmed',
	            'password_confirmation' => 'required|min:6',
	            'phone' => 'required|max:10|min:10',
	        ]);


            $user_details = array();

            $user_details['fname'] = $fname = $request->fname;
            $user_details['lname'] = $lname = $request->lname;
            $user_details['email'] = $email = $request->email;
            $user_details['password'] = $password = Hash::make($request->password);
            $user_details['phone'] = $phone = $request->phone;
            $user_details['father_name'] = $father_name = $request->father_name;
            $user_details['khasra'] = $khasra = $request->khasra;
            $user_details['village'] = $village = $request->village;
            $user_details['tehsil'] = $tehsil = $request->tehsil;
            $user_details['district'] = $district = $request->district;
			$user_details['commodity'] = $commodity = $request->commodity;

            $user = User::create([
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email,
                'password' => $password,
                'phone' => $phone,
                'status' => 1
            ]);

            $user_id = $user->id;

            // Create User Details
            $user_details = DB::table('user_details')->insert(
                array(
                    'user_id' => $user_id,
                    'fname' => $fname,
                    'lname' => $lname,
                    'email' => $email,
                    'phone' => $phone,
                    'father_name' => $father_name,
                    'khasra_no' => $khasra,
                    'village' => $village,
                    'tehsil' => $tehsil,
                    'district' => $district,
                    'commodity' => $commodity,
                    'created_at' => $date,
                    'updated_at' => $date,
                    'status' => 1
                )
            );


            if($user_details)
            {
                $status = 'User Added successfully.';
            }
            else
            {
                $status = 'Something went wrong !';
            }

            return redirect('add_area')->with('status', $status);
    }
}
