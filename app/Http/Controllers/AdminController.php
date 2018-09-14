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

    // Show all users
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

        # Set validation for
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'phone' => 'required|numeric|digits:10',
        ]);

        $fname = $request->fname;
        $lname = $request->lname;
        $email = $request->email;
        $password = Hash::make($request->password);
        $phone = $request->phone;
        $father_name = $request->father_name;
        $khasra = $request->khasra;
        $village = $request->village;
        $tehsil = $request->tehsil;
        $district = $request->district;
        $commodity = $request->commodity;
        $date = date('Y-m-d H:i:s');

        // Create user in users table
        $user = User::create([
            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'status' => 1
        ]);

        $user_id = $user->id;

        // Create user role in users role table
        $user_details = DB::table('user_roles')->insert([            
            'user_id' => $user_id,
            'role_id' => 2,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        // Create User Details
        $user_details = DB::table('user_details')->insert([
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
        ]);

        if($user_details)
        {
            $status = 'User Added successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('users')->with('status', $status);
    }

    // User view
    public function user_view(Request $request){

        $user_id = $request->user_id;

        // Get user details by user id
        $user = DB::table('user_details')->where('user_id', $user_id)->first();

        return view('admin.user_view', array('user' => $user));
    }

    // User Edit view
    public function user_edit_view(Request $request){

        $user_id = $request->user_id;

        // Get user details by user id
        $user = DB::table('user_details')->where('user_id', $user_id)->first();

        return view('admin.user_edit', array('user' => $user));
    }

    // User edit
    public function user_edit(Request $request){

        # Set validation for
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            //'email' => 'required|email|unique:users',
            //'password' => 'required|min:6|confirmed',
            //'password_confirmation' => 'required|min:6',
            'phone' => 'required|numeric|digits:10',
        ]);

        $user_id = $request->user_id;
        $fname = $request->fname;
        $lname = $request->lname;
        //$email = $request->email;
        //$password = Hash::make($request->password);
        $phone = $request->phone;
        $father_name = $request->father_name;
        $khasra = $request->khasra;
        $village = $request->village;
        $tehsil = $request->tehsil;
        $district = $request->district;
        $commodity = $request->commodity;
        $date = date('Y-m-d H:i:s');

        // User update in users table
        $user_edit = DB::table('users')->where('id', $user_id)->update([

            'fname' => $fname,
            'lname' => $lname,
            'phone' => $phone,
            'updated_at' => $date

        ]);

        // User details update in user details table
        $edit = DB::table('user_details')->where('user_id', $user_id)->update([

            'fname' => $fname,
            'lname' => $lname,
            'phone' => $phone,
            'father_name' => $father_name,
            'khasra_no' => $khasra,
            'village' => $village,
            'tehsil' => $tehsil,
            'district' => $district,
            'commodity' => $commodity,
            'updated_at' => $date
        ]);

        if($edit)
        {
            $status = 'User Updated successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('users')->with('status', $status);
    }

    // User Delete
    public function user_delete(Request $request){

        $user_id = $request->user_id;
        $date = date('Y-m-d H:i:s');

        // User update in users table
        $user_delete = DB::table('users')->where('id', $user_id)->update([

            'status' => 2,
            'updated_at' => $date
        ]);

        // User details update in user details table
        $delete = DB::table('user_details')->where('user_id', $user_id)->update([

            'status' => 2,
            'updated_at' => $date
        ]);

        if($delete)
        {
            $status = 'User Deleted successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('users')->with('status', $status);
    }

    // Get all enquiries / Unapproved user / with status 0
    public function enquiries(){

        // Get users with status 0
        $enquiries = DB::table('user_details')->where('status', 0)->get();

        return view('admin.enquiries', array('enquiries' => $enquiries));
    }

    // Approve enquiry
    public function approve(Request $request){

        $user_id = $request->user_id;

        $date = date('Y-m-d H:i:s');

        // User update in users table
        $user_approve = DB::table('users')->where('id', $user_id)->update([

            'status' => 1,
            'updated_at' => $date
        ]);

        // User details update in user details table
        $approve = DB::table('user_details')->where('user_id', $user_id)->update([

            'status' => 1,
            'updated_at' => $date
        ]);

        if($approve)
        {
            $status = 'Enquiry approved successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('enquiries')->with('status', $status);
    }

    // Unapprove enquiry
    public function unapprove(Request $request){

        $user_id = $request->user_id;

        // User delete in users table
        $user_unapprove = DB::table('users')->where('id', $user_id)->delete();

        // User delete in user roles table 
        $userrole_unapprove = DB::table('user_roles')->where('user_id', $user_id)->delete();

        // User details update in user details table
        $unapprove = DB::table('user_details')->where('user_id', $user_id)->delete();

        if($unapprove)
        {
            $status = 'Enquiry unapproved successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('enquiries')->with('status', $status);
    }

    // Show all warehouses
    public function warehouses(){

        // Get all warehouses
        $warehouses = DB::table('warehouses')->where('status', 1)->get();

        return view('admin.warehouses', array('warehouses' => $warehouses));
    }

    // Add warehouse page view
    public function add_warehouse_view(){

        // All Items
        $items = [];
        $items['1'] = 'item A';
        $items['2'] = 'item B';
        $items['3'] = 'item C';

        // All facilities
        $facilities = [];
        $facilities['1'] = 'Finance';
        $facilities['2'] = 'Dharmkanta';
        $facilities['3'] = 'CCTV';
        $facilities['4'] = 'procurement';

        return view('admin.add_warehouse', ['items' => $items, 'facilities' => $facilities]);
    }

    // Add Warehouse
    public function add_warehouse(Request $request){

        # Set validation for
        $this->validate($request, [
            'name' => 'required',
            'village' => 'required',
            'capacity' => 'required',
        ]);

        $name = $request->name;
        $village = $request->village;
        $capacity = $request->capacity;
        $items = $request->items;
        $facilities = $request->facilities;
        $date = date('Y-m-d H:i:s');

        // Array convert into json format
        $items = json_encode($items);
        $facilities = json_encode($facilities);

        // Create Warehouses
        $warehouse = DB::table('warehouses')->insert([
            'name' => $name,
            'village' => $village,
            'capacity' => $capacity,
            'items' => $items,
            'facilities' => $facilities,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($warehouse)
        {
            $status = 'Warehouse Added successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('warehouses')->with('status', $status);
    }

    // Delete warehouse
    public function warehouse_delete(Request $request){

        $id = $request->id;
        $date = date('Y-m-d H:i:s');

        // Delete warehouse in warehouses table
        $delete = DB::table('warehouses')->where('id', $id)->update([
            'status' => 2,
            'updated_at' => $date
        ]);

        if($delete)
        {
            $status = 'Warehouse deleted successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('warehouses')->with('status', $status);

    }

    // warehouse view
    public function warehouse_view(Request $request){

        $id = $request->id;

        // Get warehouse details by id
        $warehouse = DB::table('warehouses')->where('id', $id)->first();

        return view('admin.warehouse_view', array('warehouse' => $warehouse));
    }

    // Warehouse Edit view
    public function warehouse_edit_view(Request $request){

        // All Items
        $items = [];
        $items['1'] = 'item A';
        $items['2'] = 'item B';
        $items['3'] = 'item C';

        // All facilities
        $facilities = [];
        $facilities['1'] = 'Finance';
        $facilities['2'] = 'Dharmkanta';
        $facilities['3'] = 'CCTV';
        $facilities['4'] = 'procurement';

        $id = $request->id;

        // Get warehouse details by id
        $warehouse = DB::table('warehouses')->where('id', $id)->first();

        return view('admin.warehouse_edit', array('warehouse' => $warehouse, 'items' => $items, 'facilities' => $facilities));
    }

    // Edit warehouse
    public function warehouse_edit(Request $request){

        # Set validation for
        $this->validate($request, [
            'name' => 'required',
            'village' => 'required',
            'capacity' => 'required',
        ]);

        $warehouse_id = $request->warehouse_id;
        $name = $request->name;
        $village = $request->village;
        $capacity = $request->capacity;
        $items = $request->items;
        $facilities = $request->facilities;
        $date = date('Y-m-d H:i:s');

        // Array convert into json format
        $items = json_encode($items);
        $facilities = json_encode($facilities);

        // Create Warehouses
        $update = DB::table('warehouses')->where('id', $warehouse_id)->update([
            'name' => $name,
            'village' => $village,
            'capacity' => $capacity,
            'items' => $items,
            'facilities' => $facilities,
            'updated_at' => $date
        ]);

        if($update)
        {
            $status = 'Warehouse updated successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('warehouses')->with('status', $status);
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
}
