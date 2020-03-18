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

        //Get All Levels
        $levels = DB::table('levels')->get();

        $levels_arr = array();
        foreach($levels as $level)
        {
            $levels_arr[$level->id] = $level->name;
        }

        //Get States
        $states = DB::table('states')->get();

        $states_arr = array('' => 'Select State');
        foreach($states as $state)
        {
            $states_arr[$state->code] = $state->name;
        }

        //Get All Terminals 
        $res = DB::table('warehouses')
            ->join('warehouse_rent_rates','warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
            ->where('warehouses.status', 1)
            ->select('warehouses.*', 'warehouse_rent_rates.address', 'warehouse_rent_rates.location')
            ->groupBy('warehouses.id')
            ->get();

        $terminals = array('' => 'Select Location');
        foreach($res as $terminal)
        {
            $terminals[$terminal->id] = $terminal->address.", ".$terminal->location;
        }

        return view('mis.employees.index', array('employees' => $employees, 'terminals' => $terminals, 'roles' => $role_arr, 'levels' => $levels_arr, 'states' => $states_arr));
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
            'first_name'     => 'required',
            'last_name'      => 'required',
            'email'          => 'required|email|unique:users',
            'phone'          => 'required|numeric|digits:10|unique:users',
            'role_id'        => 'required|numeric',
            'designation'    => 'required',
            'level_id'       => 'required',
            'address'        => 'required',
            'personal_phone' => 'required',
        ]);

        $level_id = $request->level_id;
        $terminal = $request->terminal;
        $states = $request->states;
        $district = $request->district;

        if($level_id == 2){
           $request->validate([
                'states'     => 'required',
            ]);
        }else if($level_id == 3){
           $request->validate([
                'district'     => 'required',
            ]);
        }else if($level_id == 4){
           $request->validate([
                'terminal'     => 'required',
            ]);

           //Get Terminal Address
           $terminal_data = DB::table('warehouse_rent_rates')->where('warehouse_id', $terminal)->first();

           $states = $terminal_data->state;
           $district = $terminal_data->district;

        }

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
        $data['fname'] = $last_name = $request->last_name;
        $data['lname'] = $last_name = $request->last_name;
        $data['email'] = $email = $request->email;
        $data['phone'] = $phone = $request->phone;
        $data['personal_phone'] = $personal_phone = $request->personal_phone;
        $data['address'] = $address = $request->address;
        $data['terminal'] = $terminal;
        $data['role_id'] = $role_id = $request->role_id;
        $data['designation'] = $designation = $request->designation;
        $data['password'] = $password = Hash::make(123456);
        $data['state_id'] = $states;
        $data['district_id'] = $district;
        $data['level_id'] = $level_id;
        $data['country_id'] = 1;
        $data['location'] = $terminal;

        # Add User in Users Table
        $user = User::addUser($data);

        $user_id = $user->id;
        $date = date('Y-m-d H:i:s');

        $data['user_id'] = $user_id;

        # Create user role in users role table
        $user_role = user_roles::addUserRole($data);

        # Create Employees Details
        $employee = Mis::addEmployee($data);

        # Create Level For Employee
        $employee = Mis::addEmpLevel($data);

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
        $phone = $request->phone;
        $email = $request->email;
        $validate = Validator::extend('in_role', function($attribute, $role, $parameters) 
        {
            if(!in_array($role, array(3,5,6,7,8,9,10,11,12,13,14)))
            {
                return false;
            }else{
                return true;
            }
        });

        $level_id = $request->edit_level_id;
        $terminal = $request->edit_terminal;
        $states = $request->edit_states;
        $district = $request->edit_district;

        if($level_id == 2){
           $request->validate([
                'edit_states'     => 'required',
            ]);
        }else if($level_id == 3){
           $request->validate([
                'edit_district'     => 'required',
            ]);
        }else if($level_id == 4){
           $request->validate([
                'edit_terminal'     => 'required',
            ]);

           //Get Terminal Address
           $terminal_data = DB::table('warehouse_rent_rates')->where('warehouse_id', $terminal)->first();

           $states = $terminal_data->state;
           $district = $terminal_data->district;

        }

        $data = array();
        $data['user_id'] = $user_id = $request->user_id;

        //Check this phone and email is same for this employee       
        $temp = DB::table('users')->where(['id' => $user_id])->first();

        if($temp->email == $email && $temp->phone != $phone)
        {
            $request->validate([
                'phone' => 'required|numeric|digits:10|unique:users',
            ]);
        }

        if($temp->email != $email && $temp->phone == $phone)
        {
            $request->validate([
                'email' => 'required|email|unique:users',
            ]);
        }
        
        //Get All Post Data
        $request->validate([
            'edit_first_name'   => 'required',
            'edit_last_name'    => 'required',
            'edit_designation'  => 'required',
            'edit_level_id'       => 'required',
            'edit_address'        => 'required',
            'edit_personal_phone' => 'required',
        ]);
       

        $data['first_name'] = $edit_first_name = $request->edit_first_name;
        $data['last_name'] = $edit_last_name = $request->edit_last_name;
        $data['email'] = $email;
        $data['phone'] = $phone;
        $data['terminal'] = $edit_terminal = $request->edit_terminal;
        $data['personal_phone'] = $edit_personal_phone = $request->edit_personal_phone;
        $data['address'] = $edit_address = $request->edit_address;
        $data['designation'] = $edit_designation = $request->edit_designation;
        $data['state_id'] = $states;
        $data['district_id'] = $district;
        $data['level_id'] = $level_id;
        $data['country_id'] = 1;
        $data['location'] = $terminal;
        
        # Update User in Users Table
        $user = User::where('id', $user_id)
          ->update(['fname' => $edit_first_name, 'lname' => $edit_last_name, 'email' => $email, 'phone' => $phone]);

        $date = date('Y-m-d H:i:s');

        # Update user role in users role Table
        /*$user_role = user_roles::updateUserRole($data, $user_id);*/

        # Update Employees Details
        $employee = Mis::updateEmployee($data, $user_id);

        //Check and Upload
        $userLevelEntry = Mis::getUserLevelEntry($user_id);

        if($userLevelEntry){

            //Update Level
            $updateUserLevel = Mis::updateUserLevel($data, $user_id);

        }else{

            //Add Level
            $employee = Mis::addEmpLevel($data);
        }

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
    public function emp_profile(Request $request)
    {
        //Employee Profile
        $emp = Mis::getEmployee($request->id);
        return view('mis.employees.profile', array('employee' => $emp));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_permissions()
    {
        //Permissions
        $permissions = Mis::getPermissions();

        //Get User Permissions
        $user_permissions = Mis::getUserPermissions();

        //Get All Employees 
        $res = Mis::getEmployess();
        $employees = array('' => 'Select Employee');

        foreach($res as $emp)
        {
            if($emp->role_id != 2 || $emp->role_id != 4)
            {
                $employees[$emp->user_id] = $emp->first_name." ".$emp->last_name."(".$emp->emp_id.")";
            }
        }

        return view('mis.user_permissions', array('permissions' => $permissions, 'user_permissions' => $user_permissions, 'employees' => $employees));
    }

    public function add_user_permission(Request $request)
    {
        //Get All Post Data
        $request->validate([
            'user_id'   => 'required',
            'permissions'    => 'required',
        ]);
       
        $data['user_id'] = $user_id = $request->user_id;
        $permissions = $request->permissions;
        $data['permission_id'] = $done = json_encode($permissions);

        $user_permissions = Mis::addUserPermission($data);

        if($user_permissions)
        {
            $status = 'User permissions set successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('user_permissions')->with('status', $status);
    }
}
