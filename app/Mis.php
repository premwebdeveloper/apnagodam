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
                	->select('apna_employees.*', 'roles.role')
        			->where('status', 1)
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
            'terminal' => $data['terminal'],
            'designation' => $data['designation'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $employee;
    }

    # Update Employee
    public function scopeupdateEmployee($query, $data)
    {
    	$date = date('Y-m-d H:i:s');

        $employee = DB::table('apna_employees')
        			->where('user_id', $data['user_id'])
        			->update([
			            'role_id' => $data['role_id'],
			            'first_name' => $data['first_name'],
			            'last_name' => $data['last_name'],
			            'email' => $data['email'],
			            'phone' => $data['phone'],
                        'terminal' => $data['terminal'],
			            'designation' => $data['designation'],
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
        $emp = DB::table('apna_employees')->where('user_id', $user_id)->first();
        return $emp;
    }
}
