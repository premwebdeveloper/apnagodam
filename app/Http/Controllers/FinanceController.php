<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;

class FinanceController extends Controller
{
    // Construct function 
	public function __construct(){

		// Only authenticarte and admin user can enter here
		$this->middleware('auth');
		$this->middleware('adminOnly');
	}

    // Finance Department
    public function index(){

        // Get all users request for loan on their commodity
        $requests =  DB::table('finances')
                        ->join('inventories as inv','inv.id', '=', 'finances.commodity_id')
                        ->join('user_details as user','user.user_id', '=', 'finances.user_id')
                        ->join('categories', 'categories.id', '=', 'inv.commodity')
                        ->select('finances.*', 'inv.commodity', 'inv.quantity', 'user.fname', 'categories.category')
                        ->get();


        return view('finance.index', array('requests' => $requests));
    }

    // View page for this finance request
    public function request_view(Request $request){

        $finance_id = $request->id;

        // Get finance request details for this request id
        $request =  DB::table('finances')
                    ->join('inventories as inv','inv.id', '=', 'finances.commodity_id')
                    ->join('categories', 'categories.id', '=', 'inv.commodity')
                    ->join('user_details as user','user.user_id', '=', 'finances.user_id')
                    ->where(['finances.id' => $finance_id])
                    ->select('finances.*', 'inv.commodity', 'inv.quantity', 'user.fname', 'categories.category')
                    ->first();

        return view('finance.view', array('request' => $request));
    }

    // Response for this finance request
    public function request_response(Request $request){

        $finance_id = $request->id;

        // Get finance request details for this request id
        $request =  DB::table('finances')
                    ->join('inventories as inv','inv.id', '=', 'finances.commodity_id')
                    ->join('categories', 'categories.id', '=', 'inv.commodity')
                    ->join('user_details as user','user.user_id', '=', 'finances.user_id')
                    ->leftjoin('finance_responses as fin_res','fin_res.finance_id', '=', 'finances.id')
                    ->where(['finances.id' => $finance_id])
                    ->select('finances.*', 'inv.commodity', 'inv.quantity', 'user.fname', 'categories.category', 'fin_res.status as finance_status', 'fin_res.bank_name as res_bank_name', 'fin_res.amount as res_amount', 'fin_res.interest as res_interest')
                    ->first();

        $response_status = [];
        $response_status[''] = 'Select Status';
        $response_status['1'] = 'Approve';
        $response_status['0'] = 'UnApprove';

        return view('finance.response', array('finance_id' => $finance_id, 'request' => $request, 'response_status' => $response_status));
    }

    // Respond on this finance request by admin
    public function request_responded(Request $request){

        $finance_id = $request->finance_id;
        $request_status = $request->request_status;

        // If request status is approved then mendatory all other fields
        if($request_status == 1){

            # Set validation for
            $this->validate($request, [
                'request_status' => 'required',
                'bank_name' => 'required',
                'amount' => 'required',
                'interest' => 'required',
            ]);

            $bank_name = $request->bank_name;
            $amount = $request->amount;
            $interest = $request->interest;

        }else{

            // If request status is unapproved
            # Set validation for
            $this->validate($request, [
                'request_status' => 'required',
            ]);

            $bank_name = null;
            $amount = null;
            $interest = null; 
        }        

        $date = date('Y-m-d H:i:s');

        // Update this request status for this finance
        $respond = DB::table('finance_responses')->where('finance_id', $finance_id)->update([

            'bank_name' => $bank_name,
            'amount' => $amount,
            'interest' => $interest,
            'updated_at' => $date,
            'status' => $request_status,
        ]); 

        // Default approved status is 2 / approve finance request
        $approved = 2;

        // If request staus is 2 then unapproce finance request
        if($request_status == 0){

            $approved = '-1';
        }

        // Update finance as approved / unapproved in finances table
        $update = DB::table('finances')->where('id', $finance_id)->update([

            'status' => $approved,
            'updated_at' => $date,
        ]);


        if($respond){

            $status = 'Responded on finance request successfully.';
        }else{

            $status = 'Something went wrong !';
        }

        return redirect('finance')->with('status', $status);

    }

}
