<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use App\Lead;
use App\Mis;
use App\user_roles;
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
    public function index()
    {
        //Get All Terminals 
        $res = DB::table('warehouses')->where('status', 1)->get();
        $terminals = array('' => 'Select Terminal');
        foreach($res as $terminal)
        {
            $terminals[$terminal->id] = $terminal->name;
        }
        
        //Get All Commodity 
        $res = DB::table('categories')->where('status', 1)->get();
        $commodity = array('' => 'Select Commodity');
        foreach($res as $cmdty)
        {
            $commodity[$cmdty->id] = $cmdty->category." (".$cmdty->commodity_type.")";
        }
        
        //Get All Commodity 
        $res = Mis::getEmployess();
        $employees = array('' => 'Select Employee');
        foreach($res as $emp)
        {
            if($emp->role_id == 3 || $emp->role_id == 6 || $emp->role_id == 8 || $emp->role_id == 9)
            {
                $employees[$emp->user_id] = $emp->emp_id;
            }
        }

        //Get All Employees vie Model
        $leads = Lead::getLeads();
        return view('mis.leads.index', array('leads' => $leads, 'terminals' => $terminals, 'commodity' => $commodity, 'employees' => $employees));
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
            'phone'        => 'required|numeric|digits:10',
            'commodity_id'      => 'required|numeric',
            'terminal_id'      => 'required|numeric',
            'commodity_date'      => 'required|date',
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
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
