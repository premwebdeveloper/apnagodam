<?php

namespace App\Http\Controllers\Auth;

use App\User;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|string|max:255',
            'email' => 'nullable|unique:users',
            'phone' => 'required|numeric|digits:10|unique:users',
            /*'password' => 'required|string|min:6|confirmed',*/
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $date = date('Y-m-d H:i:s');

        $user = User::create([
            'fname' => $data['fname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make(123456),
            'status' => 0
        ]);

        $user_id = $user->id;

        // Create User role
        $user_role = DB::table('user_roles')->insert(
            array(
                'role_id' => 2,
                'user_id' => $user_id,
                'created_at' => $date,
                'updated_at' => $date
            )
        );

        // Create User Details
        $user_details = DB::table('user_details')->insert(
            array(
                'user_id' => $user_id,
                'fname' => $data['fname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'father_name' => $data['father_name'],
                'category' => $data['category'],
                'gst_number' => $data['gst'],
                'khasra_no' => $data['khasra'],
                'village' => $data['village'],
                'tehsil' => $data['tehsil'],
                'district' => $data['district'],
                'image' => "user.png",
                'power' => 1,
                'created_at' => $date,
                'updated_at' => $date,
                'status' => 0
            )
        );

        return $user;
        exit;
    }
}
