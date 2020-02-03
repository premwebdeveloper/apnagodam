<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'password', 'phone', 'status', 'login_otp', 'register_otp',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    # Add User
    public function scopeaddUser($query, $data)
    {
        $user = User::create([
            'fname' => $data['first_name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone' => $data['phone'],
            'status' => 1
        ]);
        return $user;
    }

    # Add User
    public function updateUser($query, $data, $user_id)
    {
        $user = User::update([
            'fname' => $data['first_name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone' => $data['phone']
        ])->where('id', $user_id);
        return $user;
    }
}
