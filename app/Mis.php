<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Mis extends Model
{
    # Get all Employees
    public function scopegetEmployess()
    {
        $employees = DB::table('apna_employees')
        			->join('roles', 'roles.id', '=', 'apna_employees.role_id')
                    ->leftjoin('emp_levels', 'emp_levels.user_id', '=', 'apna_employees.user_id')
                    ->leftjoin('levels', 'levels.id', '=', 'emp_levels.level_id')
                    ->leftjoin('states', 'states.code', '=', 'emp_levels.state_id')
                    ->leftjoin('districts', 'districts.id', '=', 'emp_levels.district_id')
                    ->leftjoin('warehouse_rent_rates', 'warehouse_rent_rates.warehouse_id', '=', 'emp_levels.location')
                	->select('apna_employees.*', 'roles.role', 'levels.name as level', 'states.name as state_name', 'districts.name as district_name', 'warehouse_rent_rates.address as location_address', 'warehouse_rent_rates.location as location_area', 'roles.role')
        			->where('apna_employees.status', 1)
                    ->orderBy('apna_employees.emp_id', 'ASC')
        			->get();
        return $employees;
    }

    # Get all Employee Details
    public function scopegetEmployee($query, $id)
    {
        $employees = DB::table('apna_employees')
                    ->join('roles', 'roles.id', '=', 'apna_employees.role_id')
                    ->select('apna_employees.*', 'roles.role')
                    ->where(['status' => 1, 'user_id' => $id])
                    ->first();
        return $employees;
    }

    # Last Emp ID
    public function scopegetLastEmpId()
    {
        $emp_id = DB::table('apna_employees')->where('status', 1)->orderBy('created_at', 'DESC')->first();
        if($emp_id)
        {
        	return $emp_id;
        }else{
        	return 0;
        }
    }

    # Add Employee
    public function scopeaddEmployee($query, $data)
    {
    	$date = date('Y-m-d H:i:s');

        $employee = DB::table('apna_employees')->insert([
            'user_id' => $data['user_id'],
            'emp_id' => $data['emp_id'],
            'role_id' => $data['role_id'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'personal_phone' => $data['personal_phone'],
            'address' => $data['address'],
            'terminal' => $data['terminal'],
            'designation' => $data['designation'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $employee;
    }

    # Add Employee Level
    public function scopeaddEmpLevel($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        $emp_levels = DB::table('emp_levels')->insert([
            'user_id' => $data['user_id'],
            'level_id' => $data['level_id'],
            'country_id' => $data['country_id'],
            'state_id' => $data['state_id'],
            'district_id' => $data['district_id'],
            'location' => $data['location'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $emp_levels;
    }

    # Update Employee
    public function scopeupdateEmployee($query, $data)
    {
    	$date = date('Y-m-d H:i:s');

        $employee = DB::table('apna_employees')
        			->where('user_id', $data['user_id'])
        			->update([
			            'first_name' => $data['first_name'],
			            'last_name' => $data['last_name'],
			            'email' => $data['email'],
			            'phone' => $data['phone'],
                        'terminal' => $data['terminal'],
			            'designation' => $data['designation'],
                        'personal_phone' => $data['personal_phone'],
                        'address' => $data['address'],
			            'updated_at' => $date]);

        return $employee;
    }

    # Disable Employee
    public function scopedeleteEmployee($query, $id)
    {
    	$date = date('Y-m-d H:i:s');

        $employee = DB::table('apna_employees')
        			->where('user_id', $id)
        			->update([
				        'status' => 2,
	        		    'updated_at' => $date
	        		]);
	    $user_delete = DB::table('users')->where('id', $id)->update([
            'status' => 2,
            'updated_at' => $date
        ]);

        return $user_delete;
    }

    # Get Single Emp Details
    public function scopegetEmpData($query, $user_id)
    {
        $emp = DB::table('apna_employees')
                ->leftjoin('emp_levels', 'emp_levels.user_id', '=', 'apna_employees.user_id')
                ->select('apna_employees.*', 'emp_levels.level_id', 'emp_levels.state_id', 'emp_levels.district_id', 'emp_levels.location')
                ->where('apna_employees.user_id', $user_id)->first();
        return $emp;
    }

    # Get Single Emp Level Data
    public function scopegetUserLevelEntry($query, $user_id)
    {
        $emp = DB::table('emp_levels')->where('user_id', $user_id)->first();
        if($emp)
        {
            return $emp;
        }else{
            return false;
        }
    }

    # Update Employee
    public function scopeupdateUserLevel($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        $employee = DB::table('emp_levels')
                    ->where('user_id', $data['user_id'])
                    ->update([
                        'level_id' => $data['level_id'],
                        'country_id' => $data['country_id'],
                        'state_id' => $data['state_id'],
                        'district_id' => $data['district_id'],
                        'location' => $data['location'],
                        'updated_at' => $date]
                    );

        return $employee;
    }

    # Get All Permissions
    public function scopegetPermissions()
    {
        $emp = DB::table('permissions')->get();
        return $emp;
    }

    # Get All User Permissions
    public function scopegetUserPermissions()
    {
        $user_permissions = DB::table('user_permissions')
            ->join('users', 'users.id', '=', 'user_permissions.user_id')
            ->select('user_permissions.*', 'users.fname')
            ->get();
        return $user_permissions;
    }
    # Add UserPermission
    public function scopeaddUserPermission($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        $user_permissions = DB::table('user_permissions')->insert([
            'user_id' => $data['user_id'],
            'permission_id' => $data['permission_id'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $user_permissions;
    }
}
