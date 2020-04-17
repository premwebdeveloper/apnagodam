<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use DataTables;
use App\Mis;
use App\User;
use App\Lead;
use App\user_roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;

class LeadController extends Controller
{
    // Construct function 
    public function __construct(){

        // Only authenticarte and admin user can enter here
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

            // Show all users
    public function all_users()
    {
        $users = DB::table('user_details')
                ->join('user_roles', 'user_roles.user_id', '=', 'user_details.user_id')
                ->select('user_details.*', 'user_roles.role_id')
                ->where('status', 1)
                ->where('user_details.user_id', '!=', 1)
                ->get();
        return view('mis.users', array('users' => $users));
    }

    // User view
    public function user_view_by_account(Request $request){

        $user_id = $request->user_id;

        // Get user details by user id
        $user = DB::table('user_details')->where('user_id', $user_id)->first();

        $role = DB::table('user_roles')->where('user_id', $user_id)->first();

        //Get State
        $state = DB::table('states')->get();
        $states = array();
        foreach($state as $key => $value)
        {
            $states[$value->name] = $value->name;
        }

        return view('mis.user_view', array('user' => $user, 'role' => $role, 'states' => $states));
    }

    public function index()
    {
        //Get All Terminals 
        $res = DB::table('warehouses')->where('status', 1)->get();
        $terminals = array('' => 'Select Terminal');
        foreach($res as $terminal)
        {
            $terminals[$terminal->id] = $terminal->name. " (".$terminal->warehouse_code.")";
        }
        
        //Get All Commodity 
        $res = DB::table('categories')->where('status', 1)->get();
        $commodity = array('' => 'Select Commodity');
        foreach($res as $cmdty)
        {
            $commodity[$cmdty->id] = $cmdty->category." (".$cmdty->commodity_type.")";
        }
        
        //Get All Employees 
        $res = Mis::getEmployess();
        $employees = array('' => 'Select Employee');
        foreach($res as $emp)
        {
            if($emp->role_id == 6 || $emp->role_id == 7 || $emp->role_id == 8 || $emp->role_id == 9)
            {
                $employees[$emp->user_id] = $emp->first_name." ".$emp->last_name."(".$emp->emp_id.")";
            }
        }

        //Get All Employees vie Model
        $leads = Lead::getLeads();
        return view('mis.leads.index', array('leads' => $leads, 'terminals' => $terminals, 'commodity' => $commodity, 'employees' => $employees));
    }

    //Get All Leads by Ajax
    public function getAllLeads()
    {
        $currentuserid = Auth::user()->id;

        //Get User Roles
        $role = DB::table('user_roles')->where('user_id', $currentuserid)->first();

        if($role->role_id == 1 || $role->role_id == 8)
        {
            //Get All Employees vie Model
            $leads = Lead::getLeads();            
        }else{
            //Get All Employees vie Model
            $leads = Lead::getLeads($currentuserid);            
        }

        //  Get All Page titles
        return Datatables::of($leads)->addColumn('action', function ($row) {
            $end_date = date('Y-m-d H:i:s', strtotime($row->created_at .'+60 minutes'));
            $current_time = date('Y-m-d H:i:s');
            if($end_date >= $current_time){
                $action = '<a class="edit_lead" data-id="'.$row->id.'"><i class="fa fa-pencil"></i></a>';
            }
            else{
                $action = '<span class="btn-gray">Not Editable</span>';
            }
            
            return $action;
        })->addColumn('commodity_date', function ($row) {
            return date('d M Y', strtotime($row->commodity_date));
        })->addColumn('commodity', function ($row) {
            return $row->cate_name ." (".$row->commodity_type.")";
        })->addColumn('generated_by', function ($row) {
            return $row->first_name." ".$row->last_name;
        })->escapeColumns(null)
        ->make(true); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //Get All Post Data
        $request->validate([
            'customer_name'   => 'required',
            'quantity'    => 'required|numeric',
            'location'    => 'required',
            'phone'        => 'required|numeric|digits:10|unique:apna_leads',
            'commodity_id'      => 'required|numeric',
            'terminal_id'      => 'required|numeric',
            'commodity_date'      => 'required|date',
            'purpose'      => 'required',
        ]);

        $currentuserid = Auth::user()->id;

        if($request->user_id)
        {
            $data['user_id'] = $user_id = $request->user_id;
        }else{
            $data['user_id'] = $user_id = $currentuserid;
        }

        $data['customer_name'] = $customer_name = $request->customer_name;
        $data['quantity'] = $quantity = $request->quantity;
        $data['location'] = $location = $request->location;
        $data['phone'] = $phone = $request->phone;
        $data['commodity_id'] = $commodity_id = $request->commodity_id;
        $data['terminal_id'] = $terminal_id = $request->terminal_id;
        $data['commodity_date'] = $commodity_date = $request->commodity_date;        
        $data['purpose'] = $purpose = $request->purpose;        

        # Create Lead
        $lead = Lead::createLead($data);

        if($lead)
        {
            $status = 'Lead Generated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('leads')->with('status', $status);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_lead(Request $request)
    {
        $id = $request->id;

        //Get Lead Details
        $lead = Lead::getLead($id);
        echo json_encode($lead);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_lead(Request $request)
    {
        //Get All Post Data
        $request->validate([
            'edit_customer_name'   => 'required',
            'edit_quantity'    => 'required|numeric',
            'edit_location'    => 'required',
            'edit_phone'        => 'required|numeric|digits:10',
            'edit_commodity_id'      => 'required|numeric',
            'edit_terminal_id'      => 'required|numeric',
            'edit_commodity_date'      => 'required|date',
            'edit_purpose'      => 'required',
        ]);

        $currentuserid = Auth::user()->id;

        if($request->user_id)
        {
            $data['user_id'] = $user_id = $request->user_id;
        }else{
            $data['user_id'] = $user_id = $currentuserid;
        }

        $data['id'] = $id = $request->id;
        $data['customer_name'] = $customer_name = $request->edit_customer_name;
        $data['quantity'] = $quantity = $request->edit_quantity;
        $data['location'] = $location = $request->edit_location;
        $data['phone'] = $phone = $request->edit_phone;
        $data['commodity_id'] = $commodity_id = $request->edit_commodity_id;
        $data['terminal_id'] = $terminal_id = $request->edit_terminal_id;
        $data['purpose'] = $purpose = $request->edit_purpose;        
        $data['commodity_date'] = $commodity_date = $request->edit_commodity_date;        

        # Create Lead
        $lead = Lead::updateLead($data);

        if($lead)
        {
            $status = 'Lead Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('leads')->with('status', $status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getLastGatePass(Request $request)
    {
        $terminal_id = $request->terminal_id;

        //Get Last Gatepass Number
        $termianl_gate_pass = DB::table('apna_case')
                            ->where('terminal_id', $terminal_id)
                            ->orderBy('gate_pass', 'DESC')
                            ->first();
        if($termianl_gate_pass){
            echo $gate_pass = ++$termianl_gate_pass->gate_pass;
        }else{
            $terminal = DB::table('warehouses')->where('id', $terminal_id)->first();
            if($terminal){
                echo $terminal->gatepass_start;
            }else{
                echo 0;
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
