<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use DB;
use Session;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
   # Construt function
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    public function apna_registeration(Request $request) {
       
        $date = date('Y-m-d');
        $phone = $request->mobileNO;
        $fname = $request->name;
        $father_name = $request->fatherName;
        $aadhar = $request->adharNo;
        $village = $request->village;
        $district = $request->district;
        $bank_name = $request->BankName;
        $bank_branch = $request->bankBranch;
        $bank_acc_no = $request->banckAccNo;
        $bank_ifsc_code = $request->bankIfscCode;

        if(! preg_match("/^\d+\.?\d*$/",$phone) || strlen($phone)!=10){

            $error = ['message' => "Please fill valid mobile number !", 'error' => 1, 'status' => 0];
            echo json_encode($error);
            exit;
        }

        $role_id = 5;

        $user = User::create([
            'fname' => $fname,
            'phone' => $phone,
            'password' => Hash::make(123456),
            'status' => 1
        ]);

        $user_id = $user->id;

        if(! $user_id){

            $error = ['message' => "something went wrong please try again !", 'error' => 1, 'status' => 0];
            echo json_encode($error);
            exit;
        }

        // Create User role
        $user_role = DB::table('user_roles')->insert(
            array(
                'role_id' => $role_id,
                'user_id' => $user_id,
                'created_at' => $date,
                'updated_at' => $date
            )
        );

        // Create User Details
        $user_details = DB::table('user_details')->insert(
            array(
                'user_id' => $user_id,
                'fname' => $fname,
                'phone' => $phone,
                'father_name' => $father_name,
                'aadhar_no' => $aadhar,
                'gst_number' => null,
                'village' => $village,
                'district' => $district,
                'bank_name' => $bank_name,
                'bank_branch' => $bank_branch,
                'bank_acc_no' => $bank_acc_no,
                'bank_ifsc_code' => $bank_ifsc_code,
                'firm_name' => null,
                'address' => null,
                'mandi_license' => null,
                'image' => null,
                'power' => 1,
                'created_at' => $date,
                'updated_at' => $date,
                'status' => 1
            )
        );

        $response = ['message' => "successfully registered", 'error' => 0, 'status' => 1];
        echo json_encode($response);
        exit;
    }

}
