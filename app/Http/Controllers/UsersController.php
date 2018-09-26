<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Storage;
use Session;

class UsersController extends Controller
{
	// Construct function 
	public function __construct(){

		// Only authenticated and user enter here
		$this->middleware('auth');
		$this->middleware('userOnly');
	}
    
    // User user_dashboard
    public function user_dashboard(){

        $currentuserid = Auth::user()->id;

        $user = DB::table('user_details')->where('user_id', $currentuserid)->first();

        return view("user.dashboard", array('user' => $user));
    }

    // User profile view
    public function profile(){

        $currentuserid = Auth::user()->id;

        $user = DB::table('user_details')->where('user_id', $currentuserid)->first();

        return view("user.profile", array('user' => $user));
    }


    // User profile view
    public function inventories(){

        $currentuserid = Auth::user()->id;

        $user = DB::table('user_details')->where('user_id', $currentuserid)->first();

        return view("user.inventory", array('user' => $user));
    }

    // User profile view
    public function change_password(){

        $currentuserid = Auth::user()->id;

        $user = DB::table('user_details')->where('user_id', $currentuserid)->first();

    	return view("user.change_password", array('user' => $user));
    }

    // Finance page view
    public function user_finance_view(){

        $currentuserid = Auth::user()->id;

        // Get user inventory
        $inventories =  DB::table('inventories')
                        ->leftjoin('finances as fin','fin.commodity_id', '=', 'inventories.id')
                        ->where('inventories.user_id', $currentuserid)
                        ->select('fin.status as finance_status', 'fin.id as finance_id', 'inventories.*')
                        ->get();

        return view("user.finance", array('inventories' => $inventories));
    }

    // Request for loan
    public function request_for_loan(Request $request){

        $id = $request->id;
        $currentuserid = Auth::user()->id;

        // Get inventory details
        $inventory= DB::table('inventories')
                    ->where('id', $id)
                    ->first();

        return view("user.request_for_loan", array('commodity_id' => $id, 'inventory' => $inventory));
    }

    // Requested for loan
    public function requested_for_loan(Request $request){

        $finance_id = $request->finance_id;
        $commodity_id = $request->id;
        $currentuserid = Auth::user()->id;

        // Get Requested for loan details
        $finance =  DB::table('finances')
                        ->join('inventories as inv','inv.id', '=', 'finances.commodity_id')
                        ->where(['finances.id' => $finance_id])
                        ->select('finances.*', 'inv.commodity', 'inv.quantity')
                        ->first();

        return view("user.requested_for_loan", array('finance' => $finance));
    }

    // Request for loan submit
    public function loan_request(Request $request){

        $currentuserid = Auth::user()->id;

        # Set validation for
        $this->validate($request, [
            'account_number' => 'required',
            'bank_name' => 'required',
            'account_number' => 'required',
            'ifsc_code' => 'required',
            'branch_name' => 'required',
            'pan_card' => 'required | mimes:jpeg,jpg,png,gif,bmp | max:1000',
            'aadhar_card' => 'required | mimes:jpeg,jpg,png,gif,bmp | max:1000',
            'balance_sheet' => 'required | mimes:jpeg,jpg,png,gif,bmp | max:1000',
            'bank_statement' => 'required | mimes:jpeg,jpg,png,gif,bmp | max:1000',            
        ]);

        $commodity_id = $request->commodity_id;
        $bank_name = $request->bank_name;
        $account_number = $request->account_number;
        $ifsc_code = $request->ifsc_code;
        $branch_name = $request->branch_name;
        $date = date('Y-m-d H:i:s');

        # Pan Card Upload
        if($request->hasFile('pan_card')) {

            $file = $request->pan_card;

            $pan_card = $file->getClientOriginalName();

            $ext = pathinfo($pan_card, PATHINFO_EXTENSION);

            $pan_card = substr(md5(microtime()),rand(0,26),6);

            $pan_card .= '.'.$ext;

            $destinationPath = base_path() . '/resources/assets/upload/pancards/'.$currentuserid.'/';
            $file->move($destinationPath,$pan_card);
            $filepath = $destinationPath.$pan_card;            
        }

        # Aadhar Card Upload
        if($request->hasFile('aadhar_card')) {

            $file = $request->aadhar_card;

            $aadhar_card = $file->getClientOriginalName();

            $ext = pathinfo($aadhar_card, PATHINFO_EXTENSION);

            $aadhar_card = substr(md5(microtime()),rand(0,26),6);

            $aadhar_card .= '.'.$ext;

            $destinationPath = base_path() . '/resources/assets/upload/aadharcards/'.$currentuserid.'/';
            $file->move($destinationPath,$aadhar_card);
            $filepath = $destinationPath.$aadhar_card;            
        }

        # Balance Sheet Upload
        if($request->hasFile('balance_sheet')) {

            $file = $request->balance_sheet;

            $balance_sheet = $file->getClientOriginalName();

            $ext = pathinfo($balance_sheet, PATHINFO_EXTENSION);

            $balance_sheet = substr(md5(microtime()),rand(0,26),6);

            $balance_sheet .= '.'.$ext;

            $destinationPath = base_path() . '/resources/assets/upload/balancesheets/'.$currentuserid.'/';
            $file->move($destinationPath,$balance_sheet);
            $filepath = $destinationPath.$balance_sheet;            
        }

        # Bank Statement Upload
        if($request->hasFile('bank_statement')) {

            $file = $request->bank_statement;

            $bank_statement = $file->getClientOriginalName();

            $ext = pathinfo($bank_statement, PATHINFO_EXTENSION);

            $bank_statement = substr(md5(microtime()),rand(0,26),6);

            $bank_statement .= '.'.$ext;

            $destinationPath = base_path() . '/resources/assets/upload/bankstatements/'.$currentuserid.'/';
            $file->move($destinationPath,$bank_statement);
            $filepath = $destinationPath.$bank_statement;            
        }

        // Insert entry with all required fields
        $last_id = DB::table('finances')->insertGetId([
            'user_id' => $currentuserid,
            'bank_name' => $bank_name,
            'branch_name' => $branch_name,
            'acc_number' => $account_number,
            'ifsc' => $ifsc_code,
            'pan' => $pan_card,
            'aadhar' => $aadhar_card,
            'balance_sheet' => $balance_sheet,
            'bank_statement' => $bank_statement,
            'commodity_id' => $commodity_id,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date,
        ]);


        // insert entry in finance_response table
        $insert = DB::table('finance_responses')->Insert([
            'finance_id' => $last_id,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        if($insert){

            $status = 'Request submitted successfully.';
        }else{
            
            $status = 'Something went wrong !';
        }

        return redirect('user_finance_view')->with('status', $status);
    }

    public function loan_approved(Request $request){

        $finance_id = $request->id;

        $currentuserid = Auth::user()->id;

        // Get user inventory
        $inventories =  DB::table('finances')
                        ->join('inventories as inv','inv.id', '=', 'finances.commodity_id')
                        ->join('finance_responses as fin_res','fin_res.finance_id', '=', 'finances.id')
                        ->where('finances.id', $finance_id)
                        ->select('finances.*', 'inv.commodity', 'inv.quantity', 'fin_res.bank_name as res_bank_name', 'fin_res.amount as res_amount', 'fin_res.interest as res_interest')
                        ->first();

        $agree = [];
        $agree['1'] = 'yes';
        $agree['0'] = 'no';

        return view("user.requested_loan", array('finance_id' => $finance_id, 'inventories' => $inventories, 'agree' => $agree));
    }

    // user agree / disagree for loan final approcal
    public function user_agree_for_loan(Request $request){

        $finance_id = $request->finance_id;
        $agree = $request->agree;
        $date = date('Y-m-d H:i:s');

        // if user disagree for loan then delete all enteries
        if($agree == 0){

            $finance_del = DB::table('finances')->where('id', $finance_id)->delete();
            $finance_res_del = DB::table('finance_responses')->where('finance_id', $finance_id)->delete();

            if($finance_res_done){

                $status = 'You refused the request for loan. You can request again.';
            }else{

                $status = 'Something went wrong !';
            }

            return redirect('user_finance_view')->with('status', $status);  

        }else{

            // update finances table
            $finance_done = DB::table('finances')->where('id', $finance_id)->update([

                'status' => 3,
                'updated_at' => $date,
            ]);

            // update finances_response table
            $finance_res_done = DB::table('finance_responses')->where('finance_id', $finance_id)->update([

                'status' => 2,
                'updated_at' => $date,
            ]);

            if($finance_res_done){

                $status = 'Your loan amount will be credited in your account.';
            }else{

                $status = 'Something went wrong !';
            }

            return redirect('user_finance_view')->with('status', $status);
        }
    }
}
