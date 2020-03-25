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
		//$this->middleware('adminOnly');
	}

    // Finance Department
    public function index(){

        // Get all users request for loan on their commodity
        $requests =  DB::table('finances')
                        ->join('inventories', 'inventories.id', '=', 'finances.commodity_id')
                        ->join('user_details','user_details.user_id', '=', 'finances.user_id')
                        ->join('categories', 'categories.id', '=', 'inventories.commodity')
                        ->join('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
                        ->join('bank_master', 'bank_master.id', '=', 'finances.bank_id')
                        ->select('finances.*', 'inventories.net_weight','inventories.price', 'inventories.gate_pass_wr', 'categories.category', 'user_details.fname', 'warehouses.name','bank_master.bank_name','bank_master.interest_rate','bank_master.loan_pass_days')
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
        $request_status = $request->status;

        $date = date('Y-m-d H:i:s');
        
        // Update this request status for this finance
        $respond = DB::table('finance_responses')->where('finance_id', $finance_id)->update([
            'updated_at' => $date,
            'status' => $request_status,
        ]);

        // Default approved status is 2 / approve finance request
        $approved = 2;

        // get this finance record
        $finance_info = DB::table('finances')->where('id', $finance_id)->first();

        // Get user info of this finance record
        $user_info = DB::table('user_details')->where('user_id', $finance_info->user_id)->first();

        // finance enquiry message for admin
        $admin_phone = DB::table('users')->where('id', 1)->first();

        // If request staus is 2 then unapproce finance request
        if($request_status == 0){

            // send sms on mobile number using curl
            $sms = 'Apna Godam - You have unapproved '.$user_info->fname.' loan request';
            $success = sendsms($admin_phone->phone, $sms);

            // sent email to user
            $sms = 'Apna Godam - Your loan request unapproved by Admin.';
            $success = sendsms($user_info->phone, $sms);

            $delete_finance_responses = DB::table('finance_responses')->where('finance_id', $finance_id)->delete();

            $delete_finances = DB::table('finances')->where('id', $finance_id)->delete();

        }else{

            // send sms on mobile number using curl
            $sms = 'Apna Godam - You have approved '.$user_info->fname.' loan request';
            $success = sendsms($admin_phone->phone, $sms);

            // sent email to user
            $sms = 'Apna Godam - Your loan request approved by Admin.';
            $success = sendsms($user_info->phone, $sms);

            // Update finance as approved / unapproved in finances table
            $update = DB::table('finances')->where('id', $finance_id)->update([
                'status' => $request_status,
                'updated_at' => $date,
            ]);
        }

        if($respond){

            $status = 'Responded on finance request successfully.';
        }else{

            $status = 'Something went wrong !';
        }

        return redirect('finance')->with('status', $status);

    }


        // View Facility Master
    public function bank_master(){

        $bank_masters = DB::table('bank_master')->where('status', 1)->get();
        return view('admin.bank_master', array('bank_masters' => $bank_masters));
    }

    // Add Bank
    public function add_bank_master(Request $request){

        # Set validation for
        $this->validate($request, [
            'bank_name'      => 'required',
            'interest_rate'  => 'required',
            'processing_fee'  => 'required',
            'loan_pass_days' => 'required',
            'loan_per_total_amount' => 'required'
        ]);
        
        $bank_name      = $request->bank_name;
        $interest_rate  = $request->interest_rate;
        $processing_fee = $request->processing_fee;
        $loan_pass_days = $request->loan_pass_days;
        $loan_per_total_amount = $request->loan_per_total_amount;
        $date           = date('Y-m-d H:i:s');

        // Create User Details
        $bank_master = DB::table('bank_master')->insert([
            'bank_name'      => $bank_name,
            'interest_rate'  => $interest_rate,
            'loan_pass_days' => $loan_pass_days,
            'processing_fee' => $processing_fee,
            'loan_per_total_amount' => $loan_per_total_amount,
            'created_at'     => $date,
            'updated_at'     => $date,
            'status'         => 1
        ]);

        if($bank_master)
        {
            $status = 'Bank Master Added successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('bank_master')->with('status', $status);
    }

    // Edit Bank
    public function edit_bank_master(Request $request){

        # Set validation for
        $this->validate($request, [
            'bank_name'      => 'required',
            'interest_rate'  => 'required',
            'processing_fee'  => 'required',
            'loan_pass_days' => 'required',
            'loan_per_total_amount' => 'required'
        ]);
        
        $bank_master_id = $request->bank_master_id;
        $bank_name      = $request->bank_name;
        $interest_rate  = $request->interest_rate;
        $processing_fee = $request->processing_fee;
        $loan_pass_days = $request->loan_pass_days;
        $loan_per_total_amount = $request->loan_per_total_amount;
        $date           = date('Y-m-d H:i:s');


        // Create User Details
        $bank_master = DB::table('bank_master')
            ->where('id', $bank_master_id)
            ->update([
                'bank_name'      => $bank_name,
                'interest_rate'  => $interest_rate,
                'processing_fee' => $processing_fee,
                'loan_pass_days' => $loan_pass_days,
                'loan_per_total_amount' => $loan_per_total_amount,
                'updated_at'     => $date,
            ]);

        if($bank_master)
        {
            $status = 'Bank Master Updated successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('bank_master')->with('status', $status);
    }

    // facility_master Delete
    public function edit_loan_amount(Request $request){

        $id = $request->f_id;
        $amount = $request->loan_amount;
        $date = date('Y-m-d H:i:s');

        // User update in users table
        $update = DB::table('finances')->where('id', $id)->update([
            'amount' => $amount,
            'updated_at' => $date
        ]);

        if($update)
        {
            $status = 'Loan Amount Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('finance')->with('status', $status);
    }

    // facility_master Delete
    public function bank_master_delete(Request $request){

        $id = $request->id;

        // User update in users table
        $delete = DB::table('bank_master')->where('id', $id)->delete();

        if($delete)
        {
            $status = 'Bank Master Deleted Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('bank_master')->with('status', $status);
    }

    //Update Remaining Amount using CSV
    public function updateRemainingAmount(Request $request){
        if ($request->hasFile('file'))
        {
            $path = $request->file('file')->getRealPath();
            $data = \Excel::load($path)->get();
            $msg = '';

            if ($data->count())
            {
                $temp = 1;
                foreach ($data as $key => $value) {
                    if(!empty($value->seller_mobile_no) && !empty($value->gate_pass_wr_no) && !empty($value->loan_amount) && !empty($value->remaining_amount))
                    {
                        //Check this is number is active or not
                        $check_number = DB::table('users')->where('phone', $value->seller_mobile_no)->first();
                        if(!empty($check_number))
                        {
                            //Check Gate No is already exist or not
                            $check_gate_pass = DB::table('inventories')->where('gate_pass_wr', $value->gate_pass_wr_no)->first();

                            if(!empty($check_gate_pass))
                            {
                                //Check Record is Available or Not
                                $requests =  DB::table('finances')
                                ->join('inventories', 'inventories.id', '=', 'finances.commodity_id')
                                ->where('inventories.gate_pass_wr', $value->gate_pass_wr_no)
                                ->where('finances.user_id', $check_number->id)
                                ->where('finances.amount', $value->loan_amount)
                                ->select('finances.*')
                                ->first();

                                if($requests)
                                {
                                    $loan_id          =  $requests->id;
                                    $remaining_amount =  $value->remaining_amount;
                                    $date             = date('Y-m-d H:i:s');

                                    //Insert In DB
                                    $loan = DB::table('finances')->where('id', $loan_id)->update([ 'remaining_amount' => $remaining_amount, 'updated_at' => $date ]);
                                    
                                    if($loan)
                                    {
                                        $msg .= 'Loan Amount updated successfully.'."<br />";
                                    }
                                    else
                                    {
                                        $msg .= 'Something went wrong ! <br />';
                                    }
                                }else{
                                    $msg .= 'Loan does not exist on row no. '.$temp."<br />";
                                    break;
                                }
                            }else{
                                $msg .= 'Gate Number is not exists in row no. '.$temp."<br />";
                                break;
                            }
                        }else{
                            $msg .= 'Mobile Number is wrong in row no. '.$temp."<br />";
                            break;
                        }
                    }else{
                        $msg .= 'Please fill all required fields in row no. '.$temp."<br />";
                        break;
                    }
                    $temp++;
                }
            }

            return redirect('finance')->with('status', $msg);
        }
    }

    //Update Max Loan Amount Percentage
    public function updateMaxLoanAmount(Request $request)
    {
        $value = $request->max_loan_amount;
        $update = DB::table('loan_max_value')->where('id', 1)->update(['loan_value' => $value]);
        return redirect('finance')->with('status', 'Loan Max Amount updated Successfully.');
    }
}
