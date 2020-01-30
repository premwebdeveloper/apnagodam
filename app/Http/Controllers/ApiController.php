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

    // send otp api
    public function apna_send_otp(Request $request){

        $phone = $request->number;

        // If phone number is valid or not
        if(! preg_match("/^\d+\.?\d*$/",$phone) || strlen($phone)!=10){

            $response = ['error' => "1", 'message' => 'Please fill valid mobile number !'];
            echo json_encode($response);
            exit;
        }

        // get secret key
        $sms_key = DB::table('sms_hash_key')->where('id', 1)->first();

        // Check if phone number is already exist or not
        $exist = DB::table('users')->where('phone', $phone)->first();
        if(!empty($exist)){

            // If otp already exist then send again
            if(!empty($exist->register_otp)){

                // Send otp
                $otp = $exist->register_otp;        
                $sms = "<#> Apnagodam : Your OTP is ".$otp;
                $sms .= ". XxPnhAUM7Co"; // dev key
				//$sms .= '. '.$sms_key->hash; // prod key
				
                $data = sendotp($phone, $sms, $otp);
                $result = json_decode($data);

                if ($result->type != 'success'){

                    $response = ['error' => "1", 'message' => 'Something went wrong! Please try again.'];
                    echo json_encode($response);
                }else{

                    $response = ['error' => '0'];
                    echo json_encode($response);
                }
                exit;
            }

            $response = ['error' => "1", 'message' => 'This mobile number is already registered with Apnagodam ! Please try again with another.'];
            echo json_encode($response);
            exit;
        }

        // Send otp
        $otp = rand(100000, 999999);        
        $sms = "<#> Apnagodam : Your OTP is ".$otp;
        $sms .= ". XxPnhAUM7Co"; // dev key
		//$sms .= '. '.$sms_key->hash; // prod key

        $data = sendotp($phone, $sms, $otp);
        $result = json_decode($data);

        if ($result->type != 'success'){

            $response = ['error' => "1", 'message' => 'Something went wrong! Please try again.'];
            echo json_encode($response);
        }else{

            $user = User::create([
                'phone' => $phone,
                'password' => Hash::make(123456),
                'register_otp' => $otp,
                'status' => 0
            ]);

            $response = ['error' => '0'];
            echo json_encode($response);
        }
        exit;
    }

    // Resend otp api
    public function apna_resend_otp(Request $request){

        $phone = $request->number;

        // If phone number is valid or not
        if(! preg_match("/^\d+\.?\d*$/",$phone) || strlen($phone)!=10){

            $response = ['error' => "1", 'message' => 'Please fill valid mobile number !'];
            echo json_encode($response);
            exit;
        }

        // Check if phone number is already exist or not
        $exist = DB::table('users')->where('phone', $phone)->first();

        // get secret key
        $sms_key = DB::table('sms_hash_key')->where('id', 1)->first();

        if(!empty($exist)){

            // Send otp
            $otp = $exist->register_otp;
            $sms = "<#> Apnagodam : Your OTP is ".$otp;
            $sms .= ". XxPnhAUM7Co"; // dev key
			//$sms .= '. '.$sms_key->hash; // prod key 

            $data = sendotp($phone, $sms, $otp);
            $result = json_decode($data);

            if ($result->type != 'success'){

                $response = ['error' => "1", 'message' => 'Something went wrong! Please try again.'];
                echo json_encode($response);
            }else{

                $response = ['error' => '0'];
                echo json_encode($response);
            }
            exit;

        }else{

            $response = ['error' => "1", 'message' => 'Something went wrong ! Please try again to register.'];
            echo json_encode($response);
            exit;
        }
    }

    // verify otp api
    public function apna_verify_otp(Request $request){

        $phone = $request->number;
        $otp = $request->otp;

        // If phone number is valid or not
        if(! preg_match("/^\d+\.?\d*$/",$phone) || strlen($phone)!=10){

            $response = ['error' => "1", 'message' => 'Please fill valid mobile number !'];
            echo json_encode($response);
            exit;
        }

        // If phone number is valid or not
        if(strlen($otp) != 6){

            $response = ['error' => "1", 'message' => 'Please fill 6 digit valid otp !'];
            echo json_encode($response);
            exit;
        }

        // Check if phone number is already exist with this otp or not
        $exist = DB::table('users')->where(['phone' => $phone, 'register_otp' => $otp])->first();

        if(!empty($exist)){

            // make the register otp as blank
            $otp_blank = DB::table('users')->where('phone', $phone)->update([
                'register_otp' => null,
                'status' => 1,
            ]);

            $role_id = 2;
            $user_id = $exist->id;
            $date = date('Y-m-d H:i:s');

            // Create User role
            $user_role = DB::table('user_roles')->insert(
                array(
                    'role_id' => $role_id,
                    'user_id' => $user_id,
                    'created_at' => $date,
                    'updated_at' => $date
                )
            );

            $response = ['error' => "0"];
            echo json_encode($response);
            exit;

        }else{

            $response = ['error' => "1", 'message' => 'Something went wrong !'];
            echo json_encode($response);
            exit;
        }
    }

    // delete my number api
    public function apna_delete_my_number(Request $request) {

        $phone = $request->phone; 
        $delete = DB::table('users')->where('phone', $phone)->delete();
        $response = ['error' => "0"];
        echo json_encode($response);
    }

    // Registration api
    public function apna_registeration(Request $request) {
       
        $date = date('Y-m-d');
        $fname = $request->name;
        $phone = $request->mobileNO;
        $father_name = $request->fatherName;
        $aadhar = $request->adharNo;
        $village = $request->village;
        $district = $request->district;
        $bank_name = $request->BankName;
        $bank_acc_no = $request->banckAccNo;
        $bank_branch = $request->bankBranch;
        $bank_ifsc_code = $request->bankIfscCode;
        $latitude = $request->lat;
        $longitude = $request->long;
        $address = $request->address;

        // check all mendatory fields
        if(empty($fname) || empty($phone) || empty($aadhar)){
            
            $response = ['error' => "1", 'message' => 'Please fill all mendatory fields !'];
            echo json_encode($response);
            exit;
        }

        // check the mobile number is valid or not
        if(! preg_match("/^\d+\.?\d*$/",$phone) || strlen($phone)!=10){

            $response = ['error' => "1", 'message' => 'Please fill valid mobile number !'];
            echo json_encode($response);
            exit;
        }

        // Get the deails with this mobile number
        $exist = DB::table('users')->where('phone', $phone)->first();

        if(!empty($exist)){

            // Profile image
        	if($request->hasFile('TestImage01')) {

	            $file = $request->file('TestImage01');

	            //Display File Name
	            $profile_image = $file->getClientOriginalName();

	            //Display File Extension
	            $extension = $file->getClientOriginalExtension();

                $extensions = ['gif', 'png', 'jpg', 'jpeg'];

	            //Check Image format is valid or not
	            if(!in_array($extension, $extensions))
	            {
	                $response = ['error' => "1", 'message' => 'Image type is not allowed !'];
	                echo json_encode($response);
                    exit;
	            }

	            $profile_image = substr(md5(microtime()),rand(0,26),8);

	            $profile_image .= '.'.$extension;

	            //Display File Real Path
	            $file_real_path = $file->getRealPath();

	            //Display File Size
	            $file_size = $file->getSize();

	            $destinationPath = base_path() . '/resources/assets/documents/profile_images/';

	            //Move Uploaded File
	            $file->move($destinationPath,$profile_image);

	            $filepath = $destinationPath.$profile_image;
	        }

            // Aadhar image
            if($request->hasFile('TestImage02')) {

                $file = $request->file('TestImage02');

                //Display File Name
                $aadhar_image = $file->getClientOriginalName();

                //Display File Extension
                $extension = $file->getClientOriginalExtension();

                $extensions = ['gif', 'png', 'jpg', 'jpeg'];

                //Check Image format is valid or not
                if(!in_array($extension, $extensions))
                {
                    $response = ['error' => "1", 'message' => 'Image type is not allowed !'];
                    echo json_encode($response);
                    exit;
                }

                $aadhar_image = substr(md5(microtime()),rand(0,26),8);

                $aadhar_image .= '.'.$extension;

                //Display File Real Path
                $file_real_path = $file->getRealPath();

                //Display File Size
                $file_size = $file->getSize();

                $destinationPath = base_path() . '/resources/assets/documents/aadhar_images/';

                //Move Uploaded File
                $file->move($destinationPath,$aadhar_image);

                $filepath = $destinationPath.$aadhar_image;
            }

            // cheque image
            if($request->hasFile('TestImage03')) {

                $file = $request->file('TestImage03');

                //Display File Name
                $cheque_image = $file->getClientOriginalName();

                //Display File Extension
                $extension = $file->getClientOriginalExtension();

                $extensions = ['gif', 'png', 'jpg', 'jpeg'];

                //Check Image format is valid or not
                if(!in_array($extension, $extensions))
                {
                    $response = ['error' => "1", 'message' => 'Image type is not allowed !'];
                    echo json_encode($response);
                    exit;
                }

                $cheque_image = substr(md5(microtime()),rand(0,26),8);

                $cheque_image .= '.'.$extension;

                //Display File Real Path
                $file_real_path = $file->getRealPath();

                //Display File Size
                $file_size = $file->getSize();

                $destinationPath = base_path() . '/resources/assets/documents/cheque_images/';

                //Move Uploaded File
                $file->move($destinationPath,$cheque_image);

                $filepath = $destinationPath.$cheque_image;
            }

            $user_id = $exist->id;

            // update user information in users table
            $user_update = DB::table('users')->where('phone', $phone)->update([
                'fname' => $fname,
            ]);

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
                    'image' => $profile_image,
                    'bank_name' => $bank_name,
                    'bank_branch' => $bank_branch,
                    'bank_acc_no' => $bank_acc_no,
                    'bank_ifsc_code' => $bank_ifsc_code,
                    'profile_image' => $profile_image,
                    'aadhar_image' => $aadhar_image,
                    'cheque_image' => $cheque_image,
                    'firm_name' => null,
                    'address' => $address,
                    'mandi_license' => null,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'transfer_amount' => 50,
                    'image' => null,
                    'power' => 1,
                    'created_at' => $date,
                    'updated_at' => $date,
                    'status' => 1
                )
            );

            $sms = "Send app link and  invite your friends and get a reward of Rs 25 per referral.";
            $done = sendsms($phone, $sms);

            $response = ['error' => "0", 'message' => 'बधाई हो !! आपका 10 लाख का कमोडिटी लोन स्वीकृत हो गया है ,अपने नजदीकी गोदाम में माल भेज कर लोन राशि खाते में प्राप्त करे !'];
            echo json_encode($response);
            exit;

        }else{

            $response = ['error' => "1", 'message' => 'Something went wrong! Please try again.'];
            echo json_encode($response);
            exit;
        }
    }

    // update sms hash key
    public function apna_sms_hash_key(Request $request){

    	$hash = $request->hash;

    	$sms_key = DB::table('sms_hash_key')->where('id', 1)->first();

    	// update sms hash key
    	$update = DB::table('sms_hash_key')->where('id', 1)->update([
            'hash' => $hash
        ]);

    	if($update){

	        $response = ['error' => "0"];
	        echo json_encode($response);
	        exit;
    	}else{

    		$response = ['error' => "1", 'message' => 'Something went wrong! Please try again.'];
            echo json_encode($response);
            exit;
    	}
    }

}
