<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use App\Mis;
use Auth;
use Illuminate\Support\Facades\Redirect;

class ReportsController extends Controller
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
        return view('reports.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lead_reports()
    {
        //Get All Terminals 
        $res = DB::table('warehouses')->where('status', 1)->get();
        $terminals = array('' => 'Select Terminal');
        foreach($res as $terminal)
        {
            $terminals[$terminal->id] = $terminal->name. "(".$terminal->warehouse_code.")";
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

        //Lead Reports
        return view('reports.lead_reports', array('terminals' => $terminals, 'commodity' => $commodity, 'employees' => $employees));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_lead_reports(Request $request)
    {
        $commodity_id = $request->commodity_id;
        $terminal_id = $request->terminal_id;
        $employee = $request->employee;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $leads = DB::table('apna_leads')
                ->join('apna_employees', 'apna_employees.user_id', '=', 'apna_leads.user_id')
                ->join('categories', 'categories.id', '=', 'apna_leads.commodity_id')
                ->join('warehouses', 'warehouses.id', '=', 'apna_leads.terminal_id')
                ->select('apna_leads.*','categories.category as cate_name','categories.commodity_type','warehouses.name as terminal_name','warehouses.warehouse_code','apna_employees.first_name','apna_employees.last_name');
        if($employee != null){
            $leads = $leads->where('apna_leads.user_id', $employee);
        }
        if($commodity_id != null){
            $leads = $leads->where('apna_leads.commodity_id', $commodity_id);
        }
        if($terminal_id != null){
            $leads = $leads->where('apna_leads.terminal_id', $terminal_id);
        }
        if($from_date != null){
            $leads = $leads->where('apna_leads.created_at', '>=', $from_date);
        }
        if($to_date != null){
            $leads = $leads->where('apna_leads.created_at', '<=', $to_date);
        }
        $leads = $leads->where('apna_leads.status', 1)
                ->orderBy('apna_leads.created_at', 'DESC')
                ->get();

        $html = '<div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="emp_datatable">
                        <thead>
                            <tr>
                                <th>Lead ID</th>
                                <th>Generated By</th>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Location</th>
                                <th>Commodity</th>
                                <th>Est. Quantity(Qtl)</th>
                                <th>Terminal</th>
                                <th>Purpose</th>
                                <th>Commitment Date</th>
                            </tr>
                        </thead>
                        <tbody>';

        foreach($leads as $key => $user){
            $html .= '<tr class="gradeX">
                <td>'.$user->id.'</td>
                <td>'.$user->first_name." ".$user->last_name.'</td>
                <td>'.$user->customer_name.'</td>
                <td>'.$user->phone.'</td>
                <td>'.$user->location.'</td>
                <td>'.$user->cate_name." (".$user->commodity_type.")".'</td>
                <td>'.$user->quantity.'</td>
                <td>'.$user->terminal_name.'</td>
                <td>'.$user->purpose.'</td>
                <td>'.$user->created_at.'</td>
            </tr>';
        }
            
        $html .= '</tbody></table></div><script>$(document).ready(function(){ $("#emp_datatable").DataTable({ "ordering": false,dom: "Bfrtip",
        buttons: ["copy", "csv", "excel", "pdf", "print"] }); });</script>';
        echo $html;
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