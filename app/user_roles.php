<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class user_roles extends Model
{
	# Add User Role
    public function scopeaddUserRole($query, $data)
    {
    	$date = date('Y-m-d H:i:s');

        $user_role = DB::table('user_roles')->insert([
            'user_id' => $data['user_id'],
            'role_id' => $data['role_id'],
            'created_at' => $date,
            'updated_at' => $date,
        ]);
        return $user_role;
    }
    # Update User Role
    public function scopeupdateUserRole($query, $data, $user_id)
    {
        $date = date('Y-m-d H:i:s');

        $user_role = DB::table('user_roles')
            ->where('user_id', $user_id)
            ->update([
                'role_id' => $data['role_id'],
                'created_at' => $date,
                'updated_at' => $date,
            ]);

        return $user_role;
    }
}
