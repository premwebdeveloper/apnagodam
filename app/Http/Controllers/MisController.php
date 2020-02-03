<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use App\Mis;
use App\user_roles;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;

class MisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Construct function 
    public function __construct(){

        // Only authenticarte and admin user can enter here
        $this->middleware('auth');
    }

    public function index()
    {
        $this->middleware('adminOnly');
        //Get All Employees vie Model
        $employees = Mis::getEmployess();

        //Get All User Roles
        $roles = DB::table('roles')->get();
        $role_arr = array();
        foreach($roles as $role)
        {
            if($role->id != 1 && $role->id != 2 && $role->id != 4)
            {
                $role_arr[$role->id] = $role->role;
            }
        }
        return view('mis.employees.index', array('employees' => $employees, 'roles' => $role_arr));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addEmployee(Request $request)
    {
        $this->middleware('adminOnly');
        $role = $request->role_id;

        $validate = Validator::extend('in_role', function($attribute, $role, $parameters) {
            if(!in_array($role, array(3,5,6,7,8,9,10,11,12,13,14)))
            {
                return false;
            }else{
                return true;
            }
        });

        //Get All Post Data
        $request->validate([
            'first_name'   => 'required',
            'last_name'    => 'required',
            'email'        => 'required|email|unique:users',
            'phone'        => 'required|numeric|digits:10|unique:users',
            'role_id'      => 'required|numeric',
            'designation'  => 'required',
        ]);

        $emp_id = 'AG0001';

        //Get Last Emp Id
        $emp_data = Mis::getLastEmpId();
        if($emp_data)
        {
            $emp_id = $emp_data->emp_id;
            $emp_id = ++$emp_id;
        }
        
        $data['emp_id'] = $emp_id;
        $data['first_name'] = $first_name = $request->first_name;
        $data['last_name'] = $last_name = $request->last_name;
        $data['email'] = $email = $request->email;
        $data['phone'] = $phone = $request->phone;
        $data['role_id'] = $role_id = $request->role_id;
        $data['designation'] = $designation = $request->designation;
        $data['password'] = $password = Hash::make(123456);

        # Add User in Users Table
        $user = User::addUser($data);

        $user_id = $user->id;
        $date = date('Y-m-d H:i:s');

        $data['user_id'] = $user_id;

        # Create user role in users role table
        $user_role = user_roles::addUserRole($data);

        # Create Employees Details
        $employee = Mis::addEmployee($data);

        if($employee)
        {
            $status = 'Employee Created Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('employees')->with('status', $status);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getEmp(Request $request)
    {
        $user_id = $request->user_id;

        //Get Employee Details
        $data = Mis::getEmpData($user_id);
        echo json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateEmployee(Request $request)
    {
        $this->middleware('adminOnly');

        $role = $request->role_id;
        $res = array();
        $phone = $request->edit_phone;
        $email = $request->edit_email;
        $validate = Validator::extend('in_role', function($attribute, $role, $parameters) 
        {
            if(!in_array($role, array(3,5,6,7,8,9,10,11,12,13,14)))
            {
                return false;
            }else{
                return true;
            }
        });

        //Check this phone and email is same for this employee
       
        $temp = DB::table('users')->where(['phone' => $phone, 'email' => $email])->first();
        
        
        if(!$temp)
        {
            //Check Phone Number    
            $check_phone = DB::table('users')->where(['phone' => $phone])->first();
            if($check_phone){
                return redirect('employees')->with('error', 'This phone number is already exists.');
            }

            //Check Phone Number    
            $check_email = DB::table('users')->where(['email' => $email])->first();
            if($check_email){
                return redirect('employees')->with('error', 'This email address is already exists.');
            }
        }

        //Get All Post Data
        $request->validate([
            'edit_first_name'   => 'required',
            'edit_last_name'    => 'required',
            'edit_email'         => 'required',
            'edit_phone'        => 'required|numeric|digits:10',
            'edit_role_id'      => 'required|numeric|in_role',
            'edit_designation'  => 'required',
        ]);
       

        $data = array();
        $data['user_id'] = $user_id = $request->user_id;
        $data['first_name'] = $edit_first_name = $request->edit_first_name;
        $data['last_name'] = $edit_last_name = $request->edit_last_name;
        $data['email'] = $edit_email = $request->edit_email;
        $data['phone'] = $edit_phone = $request->edit_phone;
        $data['role_id'] = $edit_role_id = $request->edit_role_id;
        $data['designation'] = $edit_designation = $request->edit_designation;
        
        # Update User in Users Table
        $user = User::where('id', $user_id)
          ->update(['fname' => $edit_first_name, 'lname' => $edit_last_name, 'email' => $edit_email, 'phone' => $edit_phone]);

        $date = date('Y-m-d H:i:s');

        # Update user role in users role table
        $user_role = user_roles::updateUserRole($data, $user_id);

        # Update Employees Details
        $employee = Mis::updateEmployee($data, $user_id);

        if($employee)
        {
            $status = 'Employee Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
        return redirect('employees')->with('status', $status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteEmployee(Request $request)
    {
        //Get User Id
        $id = $request->id;
        $date = date('Y-m-d H:i:s');

        // Disable Employee
        $delete = Mis::deleteEmployee($id);

        if($delete)
        {
            $status = 'Employee deleted successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('employees')->with('status', $status);
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
