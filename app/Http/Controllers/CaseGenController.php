<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use DataTables;
use App\Mis;
use App\CaseGen;
use App\inventory;
use App\user_roles;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;

class CaseGenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Construct function 
    public function __construct(){

        // Only authenticarte and admin user can enter here
        $this->middleware('auth');
    }

    //Get All Case
    public function index()
    {
    	//Get All Case
    	$case_gen = CaseGen::getCaseGen(1);

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
            if($emp->role_id == 6 || $emp->role_id == 7)
            {
                $employees[$emp->user_id] = $emp->first_name." ".$emp->last_name."(".$emp->emp_id.")";
            }
        }

        //Get All Customer 
        $res = DB::table('user_details')->where('status', 1)->orderBy('fname', 'ASC')->get();
        $customers = array('' => 'Select Customer / Search Phone No.');
        foreach($res as $cust)
        {
            $customers[$cust->phone] = $cust->fname." ".$cust->lname;
        }

    	return view('mis.case_gen.index', array('case_gen' => $case_gen, 'terminals' => $terminals, 'commodity' => $commodity, 'employees' => $employees, 'customers' => $customers));
    }

    //Get Completed Cases
    public function completedCases(Request $request)
    {
        return view('mis.case_gen.completed_cases');
    }

    //Get Completed Cases by Ajax
    public function getCompletedCasesByAjax(Request $request)
    {
        $case_gen = CaseGen::getCaseGen(2);
         //  Get All Page titles
        return Datatables::of($case_gen)->addColumn('caseid', function ($row) {
            $res = '<a href="'.route("viewCase", ["case_id" => $row->case_id]).'">'.$row->case_id.'</a>';
            return $res;
        })->addColumn('customer_name', function ($row) {
            return $row->cust_fname." ".$row->cust_lname;
        })->addColumn('users', function ($row) {
            $res = ($row->fpo_user_id)?$row->fpo_user_id:'N/A';
            $res .= '<br><b>Gatepass/CDF Name : </b>';
            $res .= ($row->gate_pass_cdf_user_name)?$row->gate_pass_cdf_user_name:'N/A';
            $res .= '<br><b>Coldwin Name : </b>';
            $res .= ($row->coldwin_name)?$row->coldwin_name:'N/A';
            return $res;

        })->addColumn('purchase_details', function ($row) {
            $res = ($row->purchase_name)?$row->purchase_name:'N/A';
            $res .= '<br><b>Loan Details : </b>';
            $res .= ($row->loan_name)?$row->loan_name:'N/A';
            $res .= '<br><b>Sale Details : </b>';
            $res .= ($row->sale_name)?$row->sale_name:'N/A';
            return $res;

        })->addColumn('generated_by', function ($row) {
            return $row->lead_gen_fname." ".$row->lead_gen_lname;
        })->addColumn('converted_by', function ($row) {
            return $row->lead_conv_fname." ".$row->lead_conv_lname;
        })->addColumn('commodity', function ($row) {
            return $row->cate_name ." (".$row->commodity_type.")";
        })->addColumn('terminal_name', function ($row) {
            return $row->terminal_name ." (".$row->warehouse_code.")";
        })->addColumn('created_on', function ($row) {
            return date('d M Y', strtotime($row->created_at));
        })->addColumn('closed_on', function ($row) {
            return date('d M Y', strtotime($row->updated_at));
        })->escapeColumns(null)
        ->make(true); 
    }

    //Get Completed Cases
    public function cancelledCases(Request $request)
    {
        $case_gen = CaseGen::getCaseGen(0);
        return view('mis.case_gen.cancelled_cases', array('case_gen' => $case_gen));
    }

    //Get Completed Cases
    public function approvalCasesPass()
    {
        $case_gen = CaseGen::getApprovalCasesPass();
        $data['heading'] = 'PASS';
        return view('mis.case_gen.approval_cases_pass', array('case_gen' => $case_gen, 'data' => $data));
    }

    //Get Completed Cases
    public function approvalCasesIn()
    {
        $case_gen = CaseGen::getApprovalCasesIn();
        $data['heading'] = 'IN';
        return view('mis.case_gen.approval_cases_pass', array('case_gen' => $case_gen, 'data' => $data));
    }

    //Get Completed Cases
    public function approvalCasesOut()
    {
        $case_gen = CaseGen::getApprovalCasesOut();
        $data['heading'] = 'OUT';
        return view('mis.case_gen.approval_cases_pass', array('case_gen' => $case_gen, 'data' => $data));
    }

    //Get Cases Status Pass
    public function casesStatusPass()
    {
        $case_gen = CaseGen::getCasesStatusPass();
        return view('mis.case_gen.cases_status_pass', array('case_gen' => $case_gen));
    }

    //Get Cases Status In
    public function casesStatusIn()
    {
        $case_gen = CaseGen::getCasesStatusIn();

        /*echo "<pre>";
        print_r($case_gen);
        die;*/
        return view('mis.case_gen.cases_status_in', array('case_gen' => $case_gen));
    }

    //Get Cases Status Out
    public function casesStatusOut()
    {
        $case_gen = CaseGen::getCasesStatusOut();
        return view('mis.case_gen.cases_status_out', array('case_gen' => $case_gen));
    }

    //Get Lead Generator Details by Ajax
    public function getLeadGenRec(Request $request)
    {
        $phone = $request->customer_uid;
        $uesr = DB::table('users')->where('phone', $phone)->first();
        $data = CaseGen::getleadUserData($uesr->phone);
        if($data){
            $lead_user = DB::table('apna_employees')->where('user_id', $data->user_id)->first();
            echo json_encode($lead_user);
        }else{
            echo 1;
        }
    }

    //Create Cash ID
    public function createCase(Request $request)
    {
        //Get All Post Data
        $request->validate([
            'customer_uid'   => 'required',
            'location'    => 'required',
            'gate_pass'    => 'required|unique:apna_case',
            'quantity'    => 'required|numeric',
            'commodity_id'      => 'required|numeric',
            'terminal_id'      => 'required|numeric',
            /*'vehicle_no'      => 'required',*/
            'in_out'      => 'required',
            'purpose'      => 'required',
        ]);
        $data['gate_pass'] = $gate_pass = strtoupper($request->gate_pass);

        //Check Gate Pass in Between or Not
        /*$checked = DB::table('warehouses')
                    ->where('gatepass_start', '>=', $gate_pass)
                    ->where('gatepass_end', '<=', $gate_pass)
                    ->first();
        if(!$checked)
        {
            $status = 'Gate pass number is not in series! please contact to admin.';
            return redirect()->back()->with('error', $status);
        }*/
        
        $currentuserid = Auth::user()->id;

        $data['user_id'] = $user_id = $currentuserid;
        $data['terminal_id'] = $terminal_id = $request->terminal_id;
        $data['in_out'] = $in_out = $request->in_out;
        $customer_phone = $request->customer_uid;
        $data['quantity'] = $quantity = $request->quantity;
        $data['location'] = $location = ucfirst($request->location);
        $data['commodity_id'] = $commodity_id = $request->commodity_id;
        $data['vehicle_no'] = $vehicle_no = $request->vehicle_no;
        $data['purpose'] = $purpose = $request->purpose;
        $data['fpo_users'] = $fpo_users = $request->fpo_users;
        
        //Get User Id by Number
        $customer =DB::table('users')->where('phone', $customer_phone)->first();

        $data['customer_uid'] = $customer_uid = $customer->id;

        //Get Terminal Data 
        $terminal = DB::table('warehouses')->where('id', $terminal_id)->first(); 

        //Get Commodity 
        $commodity = DB::table('categories')->where('id', $commodity_id)->first();

        //Get Last Case Record
        $last_rec = DB::table('apna_case')->orderBy('id', 'DESC')->first();
        
        if(!$last_rec){
            $last_id = 1;
        }else{
            $last_id = ++$last_rec->id;
        }  

        //Create Case ID
        $case_id = $in_out."-".$terminal->warehouse_code."-".strtoupper($commodity->category)."-".date('dmY')."-".$last_id."-".$gate_pass;

        $data['case_id'] = $case_id;
        
        $uesr = DB::table('users')->where('phone', $customer_phone)->first();
        $res = CaseGen::getleadUserData($uesr->phone);
        if($res){
            $lead_user = DB::table('apna_employees')->where('user_id', $res->user_id)->first();
            $data['lead_generator'] = $lead_generator = $lead_user->user_id;
            
        }else{
            $data['lead_generator'] = $lead_generator = $currentuserid;
        }
        
        if($request->conv_user_id){
            $data['conv_user_id'] = $conv_user_id = $request->conv_user_id;
        }else{
            $data['conv_user_id'] = $conv_user_id = $currentuserid;            
        }

        # Create Lead
        $lead = CaseGen::createCase($data);

        if($lead)
        {
            $status = 'Case ID Created Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('caseGen')->with('status', $status);
    }

    //Case Pricing
    public function pricing()
    {          
        //Get All Case
        $case_gen = CaseGen::getCasePrice();
        return view('mis.case_gen.pricing', array('case_gen' => $case_gen));
        
    }

    // Add Pricing
    public function addPrice(Request $request)
    {
        $not_required = $request->not_required;

        if(!$not_required)
        {
            //Get All Post Data
            $request->validate([
                'case_id'    => 'unique:apna_case_pricing',
                'processing_fees'    => 'required',
                'rent'      => 'required',
                'transaction_type'      => 'required',
                'labour_rate'      => 'required',
                'interest_rate'      => 'required',
            ]);
        }else{
            $request->validate([
                'case_id'    => 'unique:apna_case_pricing',
                'notes'    => 'required',                
            ]);
        }

        $currentuserid = Auth::user()->id;

        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['price'] = $price = ($request->price)?$request->price:0;
        $data['processing_fees'] = $processing_fees = $request->processing_fees;
        $data['transaction_type'] = $transaction_type = $request->transaction_type;
        $data['rent'] = $rent = $request->rent;
        $data['interest_rate'] = $interest_rate = $request->interest_rate;
        $data['labour_rate'] = $labour_rate = $request->labour_rate;
        $data['notes'] = $notes = $request->notes;

        $user_data = array();
        $user_data['fpo_user_id'] = $fpo_user_id = $request->fpo_user_id;
        $user_data['gate_pass_cdf_user_name'] = $gate_pass_cdf_user_name = $request->gate_pass_cdf_user_name;
        $user_data['coldwin_name'] = $coldwin_name = $request->coldwin_name;
        $user_data['purchase_name'] = $purchase_name = $request->purchase_name;
        $user_data['loan_name'] = $loan_name = $request->loan_name;
        $user_data['sale_name'] = $sale_name = $request->sale_name;

        //Insert Data
        $insert = CaseGen::setPrice($data);

        //Update Case Record
        $update = CaseGen::updateCaseUserDetails($user_data, $case_id);

        if($insert)
        {
            $status = 'Pricing Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
         return redirect('pricing')->with('status', $status);  
    }

    //Case Pricing
    public function quality_report()
    {
        //Get All Case
        $case_gen = CaseGen::getCaseQualityReport();
        return view('mis.case_gen.quality_report', array('case_gen' => $case_gen));
    }

    // Add Quality Report 
    public function addQualityReport(Request $request)
    {
        //Get All Post Data
        $request->validate([
            'case_id'    => 'unique:apna_case_quality_report',
            'moisture_level'    => 'required',
            'packaging_type'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['moisture_level'] = $moisture_level = $request->moisture_level;
        $data['thousand_crown_w'] = $thousand_crown_w = $request->thousand_crown_w;
        $data['broken'] = $broken = $request->broken;
        $data['foreign_matter'] = $foreign_matter = $request->foreign_matter;
        $data['thin'] = $thin = $request->thin;
        $data['damage'] = $damage = $request->damage;
        $data['black_smith'] = $black_smith = $request->black_smith;
        $data['packaging_type'] = $packaging_type = $request->packaging_type;
        $data['infested'] = $infested = $request->infested;
        $data['live_insects'] = $live_insects = $request->live_insects;
        $data['notes'] = $notes = $request->notes;

        $img_name = null;

        if($request->hasFile('report_file')) {

            $file = $request->report_file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'pdf', 'png','bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('quality_report')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('quality_report')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/quality_report/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }

        $data['imge'] = $img_name;

        //Insert Data
        $insert = CaseGen::updateQualityReport($data);

        if($insert)
        {
            $status = 'Quality Report Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
         return redirect('quality_report')->with('status', $status);  
    }

    //Gate Pass
    public function gate_pass()
    {        
        //Get All Case
        $case_gen = CaseGen::getCaseGatePass();
        return view('mis.case_gen.gate_pass', array('case_gen' => $case_gen));
    }

    // Add Gate Pass 
    public function addGatePass(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_gate_pass',
            'report_file'    => 'required',
            'weight'    => 'required',
            'no_of_bags'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['weight'] = $weight = $request->weight;
        $data['no_of_bags'] = $no_of_bags = $request->no_of_bags;
        /*$data['gate_pass_no'] = $gate_pass_no = $request->gate_pass_no;
        $data['bags'] = $bags = $request->bags;
        $data['stack_no'] = $stack_no = $request->stack_no;
        $data['lot_no'] = $lot_no = $request->lot_no;*/
        $data['notes'] = $notes = $request->notes;

        $img_name = null;

        if($request->hasFile('report_file')) {

            $file = $request->report_file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'pdf', 'png','bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('gate_pass')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('gate_pass')->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/gate_pass/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }else{

            $status = 'Please Upload file.';
            return redirect('gate_pass')->with('error', $status);  
        }

        $data['file'] = $img_name;

         //Update Actual Quantity
        $update = DB::table('apna_case')->where('case_id', $case_id)->update(['total_weight' => $weight, 'no_of_bags' => $no_of_bags]);

        $case_status = explode('-', $case_id);

        //Add Inventory if Case is IN Process
        if($case_status[0] == 'IN'){
            //Get Case
            $case_details = CaseGen::getSingleCaseById($case_id);
            $commodity_id = $case_details->commodity_id;

            //Get Commodity Details
            $commodity_details = DB::table('categories')->where('id', $commodity_id)->first();
            if($commodity_details->commodity_type == 'Secondary')
            {
                $data['sales_status']     = 2;
            }else{
                $data['sales_status']     = 1;                
            }

            $data['user_id']          = $case_details->customer_uid;
            $data['commodity']        = $case_details->commodity_id;
            
            $data['warehouse']        = $case_details->terminal_id;
            $data['weight_bridge_no'] = null;
            $data['truck_no']         = $case_details->vehicle_no;
            $data['stack_no']         = $case_details->stack_no;
            $data['lot_no']           = null;
            $data['net_weight']       = null;
            $data['quantity']         = $weight;
            $data['price']            = null;
            $data['quality_category'] = null;
            $data['gate_pass_wr']     = $case_details->gate_pass;
            //$data['file']             = null;

            //First check inventory already exist for this customer or not
            /*$check = DB::table('inventories')
                        ->where(['status' =>  1, 'warehouse_id' => $case_details->terminal_id, 'user_id' => $case_details->customer_uid, 'commodity' => $case_details->commodity_id])
                        ->first();*/
            /*if($check){

                $total_weight = $weight + $check->quantity;
                //Update In Inventory
                $inventory = inventory::updateInventoryWeight($check->id, $total_weight);

                //Insert Inventory id with Case ID
                $inset = inventory::addCaseIdInInventory($check->id, $case_id, $weight);

            }else{*/
                //Insert In Inventory
                $inventory = inventory::addInventory($data);
                
                //Insert Inventory id with Case ID
                $inset = inventory::addCaseIdInInventory($inventory, $case_id, $weight);
            /*}*/
        }

        //Add Inventory if Case is PASS Process
        if($case_status[0] == 'PASS'){
            //Get Case
            $case_details = CaseGen::getSingleCaseById($case_id);

            $data['user_id']          = $case_details->customer_uid;
            $data['commodity']        = $case_details->commodity_id;
            
            $data['warehouse']        = $case_details->terminal_id;
            $data['weight_bridge_no'] = null;
            $data['truck_no']         = $case_details->vehicle_no;
            $data['stack_no']         = $case_details->stack_no;
            $data['lot_no']           = null;
            $data['net_weight']       = null;
            $data['quantity']         = $weight;
            $data['price']            = null;
            $data['quality_category'] = null;
            $data['gate_pass_wr']     = $case_details->gate_pass;
            $data['sales_status']     = 1;
            $data['status']           = 0;

            //Insert In Inventory
            $inventory = inventory::addInventory($data);
            
            //Get User Id
            $user = DB::table('users')->where('phone', '9999999999')->first();
            
            //Insert Inventory id with Case ID
            $inset = inventory::addCaseIdInInventory($inventory, $case_id, $weight);

            $data['status']    = 1;
            $data['user_id']   = $user->id;
            
            $inventory = inventory::addInventory($data);

            //Insert Inventory id with Case ID
            $inset = inventory::addCaseIdInInventory($inventory, $case_id, $weight);
        }

        //Insert Data
        $insert = CaseGen::updateGatePass($data);

        if($insert)
        {
            $status = 'Gate Pass Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
         return redirect('gate_pass')->with('status', $status);  
    }

    // Cloase Case
    public function close_case(Request $request)
    {
        $case_id = $request->case_id;
        $notes = $request->notes;

        //Close Case ID
        $case_gen = CaseGen::closeCase($case_id, $notes);
        $status = 'Case Closed Successfully.';
        return redirect('pricing')->with('status', $status);
    }

    // Kanta Parchi
    public function kanta_parchi()
    {           
        //Get All Case
        $case_gen = CaseGen::getCaseKantaParchi();
        return view('mis.case_gen.kanta_parchi', array('case_gen' => $case_gen));
    }

    // Add Kanta Parchi 
    public function addKantaParchi(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_kanta_parchi',
            'file'    => 'required',
            'truck_file'    => 'required',
        ]);
        /*$request->validate([
            'bags'    => 'required',
            'gross_weight'    => 'required',
            'tare_weight'    => 'required',
            'net_weight'    => 'required',
            'gross_date_time'    => 'required',
            'tare_date_time'    => 'required',
            'charges'    => 'required',
            'kanta_name'    => 'required',
            'kanta_place'    => 'required',
        ]);*/

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
/*        $data['rst_no'] = $rst_no = $request->rst_no;
        $data['bags'] = $bags = $request->bags;
        $data['gross_weight'] = $gross_weight = $request->gross_weight;
        $data['tare_weight'] = $tare_weight = $request->tare_weight;
        $data['net_weight'] = $net_weight = $request->net_weight;
        $data['gross_date_time'] = $gross_date_time = $request->gross_date_time;
        $data['tare_date_time'] = $tare_date_time = $request->tare_date_time;
        $data['charges'] = $charges = $request->charges;
        $data['kanta_name'] = $kanta_name = $request->kanta_name;
        $data['kanta_place'] = $kanta_place = $request->kanta_place;*/
        $data['notes'] = $notes = $request->notes;

        $img_name = null;

        if($request->hasFile('file')) {

            $file = $request->file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'pdf', 'png','bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('kanta_parchi')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('kanta_parchi')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/kanta_parchi/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }

        $data['file'] = $img_name;

        if($request->hasFile('truck_file')) {

            $file = $request->truck_file;

            $img_name_2 = $file->getClientOriginalName();

            $ext = pathinfo($img_name_2, PATHINFO_EXTENSION);

            $img_name_2 = substr(md5(microtime()),rand(0,26),6);

            $img_name_2 .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'pdf', 'png','bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('kanta_parchi')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('kanta_parchi')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/kanta_parchi/';
            $file->move($destinationPath,$img_name_2);
            $filepath = $destinationPath.$img_name_2;
        }

        $data['file_2'] = $img_name_2;

        //Insert Data
        $insert = CaseGen::updateKantaParchi($data);

        if($insert)
        {
            $status = 'Kanta Parchi Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
        return redirect('kanta_parchi')->with('status', $status);  
    }

    //Book Truck
    public function truck_book()
    {
        //Get All Commodity 
        $res = DB::table('categories')->where('status', 1)->get();
        $commodity = array('' => 'Select Commodity');
        foreach($res as $cmdty)
        {
            $commodity[$cmdty->id] = $cmdty->category." (".$cmdty->commodity_type.")";
        }

       //Get All Case
        $case_gen = CaseGen::getCaseTruckBook();

        return view('mis.case_gen.truck_book', array('case_gen' => $case_gen, 'commodity' => $commodity)); 
    }

    // Add Truck Book
    public function addTruckBook(Request $request)
    {
        $not_required = $request->not_required;
        if(!$not_required)
        {
            $request->validate([
                'case_id'             => 'unique:apna_truck_book',
                'transporter'             => 'required',
                'vehicle'                 => 'required',
                'driver_name'             => 'required',
                'driver_phone'            => 'required',
                'rate_per_km'             => 'required',
                'min_weight'              => 'required',
                'max_weight'              => 'required',
                'turnaround_time'         => 'required',
                'total_weight'            => 'required',
                'no_of_bags'              => 'required',
                'total_transport_cost'    => 'required',
                'advance_payment'         => 'required',
                'start_date_time'         => 'required',
                'final_settlement_amount' => 'required',
                'end_date_time'           => 'required',
            ]);
        }else{
            $request->validate([
                'case_id' => 'unique:apna_truck_book',
            ]);
        }

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;

        if(!$not_required)
        {
            $data['transporter'] = $transporter = ucfirst($request->transporter);
            $data['vehicle'] = $vehicle = strtoupper($request->vehicle);
            $data['driver_name'] = $driver_name = ucfirst($request->driver_name);
            $data['driver_phone'] = $driver_phone = $request->driver_phone;       
            $data['rate_per_km'] = $rate_per_km = $request->rate_per_km;       
            $data['min_weight'] = $min_weight = $request->min_weight;       
            $data['max_weight'] = $max_weight = $request->max_weight;       
            $data['turnaround_time'] = $turnaround_time = $request->turnaround_time;     
            $data['total_weight'] = $total_weight = $request->total_weight;       
            $data['no_of_bags'] = $no_of_bags = $request->no_of_bags;       
            $data['kanta_parchi_no'] = $kanta_parchi_no = $request->kanta_parchi_no;
            $data['total_transport_cost'] = $total_transport_cost = $request->total_transport_cost;
            $data['advance_payment'] = $advance_payment = $request->advance_payment;       
            $data['start_date_time'] = $start_date_time = $request->start_date_time;       
            $data['final_settlement_amount'] = $final_settlement_amount = $request->final_settlement_amount;       
            $data['end_date_time'] = $end_date_time = $request->end_date_time;       
        }else{
            $data['transporter'] = $transporter = 'N/A';
            $data['vehicle'] = $vehicle = 'N/A';
            $data['driver_name'] = $driver_name = 'N/A';
            $data['driver_phone'] = $driver_phone = 'N/A';
            $data['rate_per_km'] = $rate_per_km = 'N/A';
            $data['min_weight'] = $min_weight = 'N/A';
            $data['max_weight'] = $max_weight = 'N/A';
            $data['turnaround_time'] = $turnaround_time = 'N/A';
            $data['total_weight'] = $total_weight = 'N/A';
            $data['no_of_bags'] = $no_of_bags = 'N/A';
            $data['kanta_parchi_no'] = $kanta_parchi_no = 'N/A';
            $data['total_transport_cost'] = $total_transport_cost = 'N/A';
            $data['advance_payment'] = $advance_payment = 'N/A';
            $data['start_date_time'] = $start_date_time = 'N/A';
            $data['final_settlement_amount'] = $final_settlement_amount = 'N/A';
            $data['end_date_time'] = $end_date_time = 'N/A';
        }

        if($request->notes)
        {
            $data['notes'] = $notes = $request->notes;
        }else{
            $data['notes'] = $notes = 'N/A';
        }
        //Insert Data
        $insert = CaseGen::updateTruckBook($data);

        if($insert)
        {
            $status = 'Truck Book Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
        return redirect('truck_book')->with('status', $status);  
    }

    //Labour Book
    public function labour_book()
    {
        //Get All Commodity 
        $res = DB::table('categories')->where('status', 1)->get();
        $commodity = array('' => 'Select Commodity');
        foreach($res as $cmdty)
        {
            $commodity[$cmdty->id] = $cmdty->category." (".$cmdty->commodity_type.")";
        }

       //Get All Case
        $case_gen = CaseGen::getCaseLabourBook();
        return view('mis.case_gen.labour_book', array('case_gen' => $case_gen, 'commodity' => $commodity)); 
    }

    // Add Labour Book
    public function addLabourBook(Request $request)
    {
        $not_required = $request->not_required;
        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        if(!$not_required)
        {
            $request->validate([
                'case_id'    => 'unique:apna_labour_book',
                'labour_contractor'    => 'required',
                'contractor_no'    => 'required',
                'labour_rate_per_bags'    => 'required',
                'total_labour'    => 'required',
                'location'    => 'required',
                'booking_date'    => 'required',
                'total_bags'    => 'required',
            ]);

            $data['labour_contractor'] = $labour_contractor = $request->labour_contractor;
            $data['contractor_no'] = $contractor_no = $request->contractor_no;
            $data['labour_rate_per_bags'] = $labour_rate_per_bags = $request->labour_rate_per_bags;
            $data['total_labour'] = $total_labour = $request->total_labour;
            $data['location'] = $location = $request->location;
            $data['booking_date'] = $booking_date = $request->booking_date;
            $data['total_bags'] = $total_bags = $request->total_bags;

        }else{
            $request->validate([
                'case_id'    => 'unique:apna_labour_book'
            ]);

            $data['labour_contractor'] = $labour_contractor = 'N/A';
            $data['contractor_no'] = $contractor_no = 'N/A';
            $data['labour_rate_per_bags'] = $labour_rate_per_bags = 'N/A';
            $data['total_labour'] = $total_labour = 'N/A';
            $data['location'] = $location = 'N/A';
            $data['booking_date'] = $booking_date = 'N/A';
            $data['total_bags'] = $total_bags = 'N/A';
        }

        $data['notes'] = $notes = $request->notes;
        //Insert Data
        $insert = CaseGen::updateLabourBook($data);

        if($insert)
        {
            $status = 'Labour Book Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
        return redirect('labour_book')->with('status', $status);  
    }

        //Case Pricing
    public function second_quality_report()
    {
        //Get All Case
        $case_gen = CaseGen::getCaseSecondQualityReport();
        return view('mis.case_gen.second_quality_report', array('case_gen' => $case_gen));
    }

    // Add Quality Report 
    public function addSecondQualityReport(Request $request)
    {
        //Get All Post Data
        $request->validate([
            'case_id'    => 'unique:apna_case_second_quality_report',
            'moisture_level'    => 'required'
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['moisture_level'] = $moisture_level = $request->moisture_level;
        $data['thousand_crown_w'] = $thousand_crown_w = $request->thousand_crown_w;
        $data['broken'] = $broken = $request->broken;
        $data['foreign_matter'] = $foreign_matter = $request->foreign_matter;
        $data['thin'] = $thin = $request->thin;
        $data['damage'] = $damage = $request->damage;
        $data['black_smith'] = $black_smith = $request->black_smith;
        $data['infested'] = $infested = $request->infested;
        $data['live_insects'] = $live_insects = $request->live_insects;
        $data['notes'] = $notes = $request->notes;

        $img_name = null;

        if($request->hasFile('report_file')) {

            $file = $request->report_file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'pdf', 'png','bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('second_quality_report')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('second_quality_report')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/second_quality_report/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }

        $data['imge'] = $img_name;

        //Insert Data
        $insert = CaseGen::updateSecondQualityReport($data);

        if($insert)
        {
            $status = 'Second Quality Report Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
         return redirect('second_quality_report')->with('status', $status);  
    }

    // Second Kanta Parchi
    public function second_kanta_parchi()
    {           
        //Get All Case
        $case_gen = CaseGen::getCaseSecondKantaParchi();
        return view('mis.case_gen.second_kanta_parchi', array('case_gen' => $case_gen));
    }

    // Add Second Kanta Parchi 
    public function addSecondKantaParchi(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_second_kanta_parchi',
            'file'    => 'required',
            'truck_image'    => 'required',
        ]);
        
        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['notes'] = $notes = $request->notes;

        $img_name = null;

        if($request->hasFile('file')) {

            $file = $request->file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'pdf', 'png','bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('second_kanta_parchi')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('second_kanta_parchi')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/second_kanta_parchi/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }

        $data['file'] = $img_name;

        if($request->hasFile('truck_image')) {

            $file = $request->truck_image;

            $img_name_2 = $file->getClientOriginalName();

            $ext = pathinfo($img_name_2, PATHINFO_EXTENSION);

            $img_name_2 = substr(md5(microtime()),rand(0,26),6);

            $img_name_2 .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'pdf', 'png','bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('second_kanta_parchi')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('second_kanta_parchi')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/second_kanta_parchi/';
            $file->move($destinationPath,$img_name_2);
            $filepath = $destinationPath.$img_name_2;
        }

        $data['file_2'] = $img_name_2;

        //Insert Data
        $insert = CaseGen::updateSecondKantaParchi($data);

        if($insert)
        {
            $status = 'Kanta Parchi Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
        return redirect('second_kanta_parchi')->with('status', $status);  
    }

    // E-Mandi
    public function e_mandi()
    {           
        //Get All Case
        $case_gen = CaseGen::getCaseEMandi();
        return view('mis.case_gen.e_mandi', array('case_gen' => $case_gen));
    }

    // Add Vikray Parchi
    public function addEmandi(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_e_mandi',
            'report_file'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['notes'] = $notes = $request->notes;

        $img_name = null;

        if($request->hasFile('report_file')) {

            $file = $request->report_file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['pdf'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('e_mandi')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('e_mandi')->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/e_mandi/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }else{

            $status = 'Please Upload file.';
            return redirect('e_mandi')->with('error', $status);  
        }

        $data['file'] = $img_name;

        //Insert Data
        $insert = CaseGen::updateEMandi($data);

        if($insert)
        {
            $status = 'Vikray Parchi Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
         return redirect('e_mandi')->with('status', $status);  
    }

    // Accounts
    public function accounts()
    {           
        //Get All Case
        $case_gen = CaseGen::getCaseAccounts();
        return view('mis.case_gen.accounts', array('case_gen' => $case_gen));
    }

    // Add Accounts
    public function addAccounts(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_accounts',
            'vikray_parchi'    => 'required',
            'inventory'    => 'required',
            'tally_updation'    => 'required',
            'cold_win_entry'    => 'required',
            /*'whs_issulation'    => 'required',*/
        ]);

        $invoice = '';

        if($request->hasFile('invoice')) {

            $file = $request->invoice;

            $invoice = $file->getClientOriginalName();

            $ext = pathinfo($invoice, PATHINFO_EXTENSION);

            $invoice = substr(md5(microtime()),rand(0,26),6);

            $invoice .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'pdf', 'png','bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('accounts')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('accounts')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/accounts/';
            $file->move($destinationPath,$invoice);
            $filepath = $destinationPath.$invoice;
        }

        $data['invoice'] = $invoice;

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['vikray_parchi'] = $vikray_parchi = $request->vikray_parchi;
        $data['inventory'] = $inventory = $request->inventory;
        $data['tally_updation'] = $tally_updation = $request->tally_updation;
        $data['cold_win_entry'] = $cold_win_entry = $request->cold_win_entry;
        /*$data['whs_issulation'] = $whs_issulation = $request->whs_issulation;*/

        $data['loan'] = $loan = $request->loan;
        $data['sale'] = $sale = $request->sale;
        $data['mandi_tax'] = $mandi_tax = $request->mandi_tax;
        $data['purchase'] = $purchase = $request->purchase;
        $data['notes'] = $notes = $request->notes;

        //Insert Data
        $insert = CaseGen::updateAccounts($data);

        if($insert)
        {
            $status = 'Accounts Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }        
        return redirect('accounts')->with('status', $status);  
    }

    // Start Shipping
    public function shipping_start()
    {           
        //Get All Case
        $case_gen = CaseGen::getCaseShippingStart();
        return view('mis.case_gen.shipping_start', array('case_gen' => $case_gen));
    }

    // Add Shipping Start
    public function addShippingStart(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_shipping_start',
            'location'    => 'required',
            'date_time'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['location'] = $location = $request->location;
        $data['date_time'] = $date_time = $request->date_time;
        $data['notes'] = $notes = $request->notes;

        //Insert Data
        $insert = CaseGen::updateShippingStart($data);

        if($insert)
        {
            $status = 'Shipping Start Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }        
        return redirect('shipping_start')->with('status', $status);  
    }

    // Shipping End
    public function shipping_end()
    {           
        //Get All Case
        $case_gen = CaseGen::getCaseShippingEnd();
        return view('mis.case_gen.shipping_end', array('case_gen' => $case_gen));
    }

    // Add Shipping End
    public function addShippingEnd(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_shipping_end',
            'location'    => 'required',
            'date_time'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['location'] = $location = $request->location;
        $data['date_time'] = $date_time = $request->date_time;
        $data['notes'] = $notes = $request->notes;

        //Insert Data
        $insert = CaseGen::updateShippingEnd($data);

        if($insert)
        {
            $status = 'Shipping End Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }        
        return redirect('shipping_end')->with('status', $status);  
    }

    //Case Pricing
    public function quality_claim()
    {
        //Get All Case
        $case_gen = CaseGen::getCaseQualityClaim();
        return view('mis.case_gen.quality_claim', array('case_gen' => $case_gen));
    }

    // Add Quality Report 
    public function addQualityClaim(Request $request)
    {
        $data['moisture_level'] = $moisture_level = $request->moisture_level;

        if($moisture_level >= 0)
        {
            //Get All Post Data
            $request->validate([
                'moisture_level'    => 'required',
            ]);
        }

        $request->validate([
            'case_id'    => 'unique:apna_case_quality_claim',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['thousand_crown_w'] = $thousand_crown_w = $request->thousand_crown_w;
        $data['broken'] = $broken = $request->broken;
        $data['foreign_matter'] = $foreign_matter = $request->foreign_matter;
        $data['thin'] = $thin = $request->thin;
        $data['damage'] = $damage = $request->damage;
        $data['black_smith'] = $black_smith = $request->black_smith;
        $data['infested'] = $infested = $request->infested;
        $data['live_insects'] = $live_insects = $request->live_insects;
        $data['quality_discount_value'] = $quality_discount_value = $request->quality_discount_value;
        $data['notes'] = $notes = $request->notes;

        $img_name = null;

        if($request->hasFile('report_file')) {

            $file = $request->report_file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'pdf', 'png','bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('quality_claim')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('quality_claim')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/quality_claim/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }

        $data['imge'] = $img_name;

        if($request->hasFile('second_report_file')) {

            $file = $request->second_report_file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'pdf', 'png','bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('quality_claim')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('quality_claim')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/quality_claim/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }
        $data['second_report'] = $img_name;

        //Insert Data
        $insert = CaseGen::updateQualityClaim($data);

        if($insert)
        {
            $status = 'Quality Claim Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
         return redirect('quality_claim')->with('status', $status);  
    }

    // Truck Payment
    public function truck_payment()
    {        
        //Get All Case
        $case_gen = CaseGen::getCaseTruckPayment();
        return view('mis.case_gen.truck_payment', array('case_gen' => $case_gen));
    }

    // Add Truck Payment 
    public function addTruckPayment(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_truck_payment',
            'notes'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['notes'] = $notes = $request->notes;

        $img_name = null;

        if($request->hasFile('report_file')) {

            $file = $request->report_file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'pdf', 'png','bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('truck_payment')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('truck_payment')->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/truck_payment/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }

        $data['file'] = $img_name;

        //Insert Data
        $insert = CaseGen::updateTruckPayment($data);

        if($insert)
        {
            $status = 'Truck Payment Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
         return redirect('truck_payment')->with('status', $status);  
    }

    // Labour Payment
    public function labour_payment()
    {        
        //Get All Case
        $case_gen = CaseGen::getCaseLabourPayment();
        return view('mis.case_gen.labour_payment', array('case_gen' => $case_gen));
    }

    // Add Labour Payment 
    public function addLabourPayment(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_labour_payment',
            'notes'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['notes'] = $notes = $request->notes;

        $img_name = null;

        if($request->hasFile('report_file')) {

            $file = $request->report_file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'pdf', 'png','bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('labour_payment')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('labour_payment')->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/labour_payment/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }

        $data['file'] = $img_name;

        //Insert Data
        $insert = CaseGen::updateLabourPayment($data);

        if($insert)
        {
            $status = 'Labour Payment Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
         return redirect('labour_payment')->with('status', $status);  
    }

    // Payment Received
    public function payment_received()
    {        
        //Get All Case
        $case_gen = CaseGen::getCasePaymentReceived();
        return view('mis.case_gen.payment_received', array('case_gen' => $case_gen));
    }

    // Add Payment Received
    public function addPaymentReceived(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_payment_received',
            'notes'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['notes'] = $notes = $request->notes;

        $img_name = null;

        if($request->hasFile('report_file')) {

            $file = $request->report_file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'pdf', 'png','bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('payment_received')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('payment_received')->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/payment_received/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }

        $data['file'] = $img_name;

        //Insert Data
        $insert = CaseGen::updatePaymentReceived($data);

        if($insert)
        {
            $status = 'Payment Received Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
         return redirect('payment_received')->with('status', $status);  
    }

    // CCTV
    public function cctv()
    {        
        //Get All Case
        $case_gen = CaseGen::getCaseCCTV();
        return view('mis.case_gen.cctv', array('case_gen' => $case_gen));
    }

    // Add CCTV
    public function addCCTV(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_cctv',
            'report_file'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['notes'] = $notes = $request->notes;

        $img_name = null;
        $img_name_2 = null;

        if($request->hasFile('report_file')) {

            $file = $request->report_file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'png','bmp','pdf'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('cctv')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('cctv')->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/cctv/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }else{

            $status = 'Please Upload file.';
            return redirect('cctv')->with('error', $status);  
        }

        if($request->hasFile('report_file_2')) {

            $file = $request->report_file_2;

            $img_name_2 = $file->getClientOriginalName();

            $ext = pathinfo($img_name_2, PATHINFO_EXTENSION);

            $img_name_2 = substr(md5(microtime()),rand(0,26),6);

            $img_name_2 .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'png','bmp','pdf'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('cctv')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('cctv')->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/cctv/';
            $file->move($destinationPath,$img_name_2);
            $filepath = $destinationPath.$img_name_2;
        }

        $data['file'] = $img_name;
        $data['file_2'] = $img_name_2;

        //Insert Data
        $insert = CaseGen::updateCCTV($data);

        if($insert)
        {
            $status = 'CCTV Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
         return redirect('cctv')->with('status', $status);  
    }

    // Commodity Deposit Form
    public function commodity_deposit()
    {        
        //Get All Case
        $case_gen = CaseGen::getCommodityDeposit();
        return view('mis.case_gen.commodity_deposit', array('case_gen' => $case_gen));
    }

    // Add Commodity Deposit Form
    public function addCommodityDeposit(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_cdf',
            'stack_no'    => 'required',
            'report_file'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['stack_no'] = $stack_no = $request->stack_no;
        $data['notes'] = $notes = $request->notes;

        $img_name = null;

        if($request->hasFile('report_file')) {

            $file = $request->report_file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'png','bmp','pdf'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('commodity_deposit')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('commodity_deposit')->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/commodity_deposit/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }else{
            $status = 'Please Upload file.';
            return redirect('commodity_deposit')->with('error', $status);  
        }

        $data['file'] = $img_name;

        //Insert Data
        $insert = CaseGen::updateCommodityDeposit($data);

        if($insert)
        {
            $status = 'Commodity Deposit Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
         return redirect('commodity_deposit')->with('status', $status);  
    }

    // Warehouse Receipt
    public function warehouse_receipt()
    {        
        //Get All Case
        $case_gen = CaseGen::getWarehouseReceipt();
        return view('mis.case_gen.warehouse_receipt', array('case_gen' => $case_gen));
    }

    // Add Warehouse Receipt
    public function addWarehouseReceipt(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_warehouse_receipt',
            'notes'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['notes'] = $notes = $request->notes;

        $img_name = null;

        if($request->hasFile('report_file')) {

            $file = $request->report_file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'pdf', 'png','bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('warehouse_receipt')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('warehouse_receipt')->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/warehouse_receipt/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }

        $data['file'] = $img_name;

        //Insert Data
        $insert = CaseGen::updateWarehouseReceipt($data);

        if($insert)
        {
            $status = 'Warehouse Receipt Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
         return redirect('warehouse_receipt')->with('status', $status);  
    }

    // Storage Receipt
    public function storage_receipt()
    {        
        //Get All Case
        $case_gen = CaseGen::getStorageReceipt();
        return view('mis.case_gen.storage_receipt', array('case_gen' => $case_gen));
    }

    // Add Storage Receipt
    public function addStorageReceipt(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_storage_receipt',
            'notes'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['notes'] = $notes = $request->notes;

        $img_name = null;

        if($request->hasFile('report_file')) {

            $file = $request->report_file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'png','bmp','pdf'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('storage_receipt')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('storage_receipt')->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/storage_receipt/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }

        $data['file'] = $img_name;

        //Insert Data
        $insert = CaseGen::updateStorageReceipt($data);

        if($insert)
        {
            $status = 'Storage Receipt Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
         return redirect('storage_receipt')->with('status', $status);  
    }

    // Delivery Order
    public function release_order()
    {        
        //Get All Case
        $case_gen = CaseGen::getReleaseOrder();
        return view('mis.case_gen.release_order', array('case_gen' => $case_gen));
    }

    // Add Delivery Order
    public function addReleaseOrder(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_release_order',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['notes'] = $notes = $request->notes;

        $img_name = null;

        if($request->hasFile('report_file')) {

            $file = $request->report_file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'pdf', 'png','bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('release_order')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('release_order')->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/release_order/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }

        $data['file'] = $img_name;

        //Insert Data
        $insert = CaseGen::updateReleaseOrder($data);

        if($insert)
        {
            $status = 'Release Order Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
        return redirect('release_order')->with('status', $status);  
    }

    // Delivery Order
    public function delivery_order()
    {        
        //Get All Case
        $case_gen = CaseGen::getDeliveryOrder();
        return view('mis.case_gen.delivery_order', array('case_gen' => $case_gen));
    }

    // Add Delivery Order
    public function addDeliveryOrder(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_delivery_order',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['notes'] = $notes = $request->notes;

        $img_name = null;

        if($request->hasFile('report_file')) {

            $file = $request->report_file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'pdf', 'png','bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('delivery_order')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('delivery_order')->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/delivery_order/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }

        $data['file'] = $img_name;

        //Insert Data
        $insert = CaseGen::updateDeliveryOrder($data);

        if($insert)
        {
            $status = 'Delivery Order Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
         return redirect('delivery_order')->with('status', $status);  
    }

    // Commodity Withdrawal Form
    public function commodity_withdrawal()
    {        
        //Get All Case
        $case_gen = CaseGen::getCommodityWithdrawal();
        return view('mis.case_gen.commodity_withdrawal', array('case_gen' => $case_gen));
    }

    // Add Commodity Withdrawal Form
    public function addCommodityWithdrawal(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_commodity_withdrawal',
            'report_file'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['notes'] = $notes = $request->notes;

        $img_name = null;

        if($request->hasFile('report_file')) {

            $file = $request->report_file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'pdf', 'png','bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('commodity_withdrawal')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 6052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('commodity_withdrawal')->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/commodity_withdrawal/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }else{

            $status = 'Please Upload file.';
            return redirect('commodity_withdrawal')->with('error', $status);  
        }

        $data['file'] = $img_name;

        //Insert Data
        $insert = CaseGen::updateCommodityWithdrawal($data);

        if($insert)
        {
            $status = 'Commodity Withdrawal Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
         return redirect('commodity_withdrawal')->with('status', $status);  
    }

    // TVR Tagging Form
    public function ivr_tagging()
    {
        //Get All Case
        $case_gen = CaseGen::getIvrTagging();
        return view('mis.case_gen.ivr_tagging', array('case_gen' => $case_gen));
    }

    // Add TVR Tagging Form
    public function addIvrTagging(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_ivr_tagging',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['notes'] = $notes = $request->notes;

        $img_name = null;

        if($request->hasFile('file')) {

            $file = $request->file;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['mp3', 'm4a', 'wma', 'mp4'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload IVR Audio File .mp3!';
                return redirect('ivr_tagging')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 8502030){
                $status = 'File size is too large. Please upload file less than 4MB !';
                return redirect('ivr_tagging')->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/ivr_tagging/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }else{

            $status = 'Please Upload file.';
            return redirect('ivr_tagging')->with('error', $status);  
        }

        $data['file'] = $img_name;

        //Insert Data
        $insert = CaseGen::updateIvrTagging($data);

        if($insert)
        {
            $status = 'IVR Tagging Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
         return redirect('ivr_tagging')->with('status', $status);  
    }

    // Add TVR Tagging Form
    public function getRelatedCasesForInventory(Request $request)
    {
        $customer_uid = $request->customer_uid;
        $commodity_id = $request->commodity_id;
        $terminal_id = $request->terminal_id;
        //Get Data
        $getData = DB::table('inventories')->where(['user_id' => $customer_uid, 'commodity' => $commodity_id, 'warehouse_id' => $terminal_id, 'status' => 1])->first();

        if($getData)
        {
            //Get Inventory Cases
            $cases = inventory::getInventoryCases($getData->id);
            $html = '<table class="table table-striped table-bordered table-hover"><tr><th>Case ID</th><th>Actual Weight (Qtl.)</th><th>Out Weight (Qtl.)</th></tr>';
            foreach ($cases as $key => $row){
                $html .= '<tr><td>'.$row->case_id.'</td><td>'.$row->weight.'<input name="actual_weight['.$row->case_id.'][]" type="hidden" value="'.$row->weight.'"></td><td><input type="number"  min="1" max="'.$row->weight.'" step="any" class="form-control" placeholder="Enter Out Quantity" name="quantity['.$row->case_id.'][]"></td></tr>';
            }
            $html .= '</table>';
            echo $html;
        }else{
            echo $html = '<span class="red">No Inventory Found! or Not Connected with any Cases!</span>';
        }
    }

    // Inventory Form
    public function case_inventory()
    {
        //Get All Case
        $case_gen = CaseGen::getCaseInventory();
        return view('mis.case_gen.inventory', array('case_gen' => $case_gen));
    }

    // Add Inventory Form
    public function addCaseInventory(Request $request)
    {
        $request->validate([
            'case_id'    => 'unique:apna_case_inventory',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $terminal_id = $request->terminal_id;
        $commodity_id = $request->commodity_id;
        $user = $request->user;
        $quantity = $request->quantity;
        $actual_weight = $request->actual_weight;
        $data['notes'] = $notes = $request->notes;
        $data['case_ids'] = json_encode($quantity);

        //Check Case Transaction Type
        $check = DB::table('apna_case_pricing')->where('case_id', $case_id)->first();

        if($check->transaction_type != 'E-Mandi')
        {
            if($quantity)
            {
                $qtl = 0;
                $case_ids[] = '';
                $i = 0;
                foreach($quantity as $caseid => $qty)
                {
                    $case_ids[$i] = $caseid;
                    $qtl = $qtl + $qty[0];
                    $i++;
                }

                //Get Inventory
                $get_inv = DB::table('inventories')->where(['warehouse_id' => $terminal_id, 'commodity' => $commodity_id, 'user_id' => $user, 'status' => 1])->first();

                if($get_inv->quantity == $qtl){
                    
                    //Update Inventroy
                    $update = DB::table('inventories')->where('id', $get_inv->id)->update(['status' => 0]);
                    //Inset Case Id in Inventory Cases
                    $insert = inventory::addCaseIdInInventory($get_inv->id, $case_id, $qtl);

                }else{
                    $new_qty = $get_inv->quantity - $qtl;

                    //Out Quantity from inventory
                    $update = DB::table('inventories')->where('id', $get_inv->id)->update(['quantity' => $qtl, 'status' => 0]);

                    //Create New inventory
                    $data['user_id']          = $get_inv->user_id;
                    $data['commodity']        = $get_inv->commodity;
                    $data['warehouse']        = $get_inv->warehouse_id;
                    $data['weight_bridge_no'] = $get_inv->weight_bridge_no;
                    $data['truck_no']         = $get_inv->truck_no;
                    $data['stack_no']         = $get_inv->stack_no;
                    $data['net_weight']       = null;
                    $data['quantity']         = round($new_qty, 2);
                    $data['price']            = $get_inv->price;
                    $data['quality_category'] = $get_inv->quality_category;
                    $data['gate_pass_wr']     = $get_inv->gate_pass_wr;
                    $data['sales_status']     = $get_inv->sales_status;
                    $data['file']             = null;

                    $inventory_id = inventory::addInventory($data);

                    //Inset Case Id in Inventory Cases
                    $insert = inventory::addCaseIdInInventory($get_inv->id, $case_id, $qtl);

                    //Change Inventory ID to chases
                    foreach($quantity as $caseid => $qty)
                    {
                        $case_inv = DB::table('inventory_cases_id')->where(['case_id' => $caseid, 'weight' => round($qty[0], 2)] )->first();

                        if(!$case_inv){
                            foreach($actual_weight as $case_key => $a_w)
                            {
                                if($case_key == $caseid){
                                    $weight = (float)$a_w[0] - (float)$qty[0];
                                    $weight = round($weight, 2);

                                    //Insert Inv Id in Cases
                                    $insert = inventory::addCaseIdInInventory($inventory_id, $caseid, $weight);

                                }
                            }

                        }else{
                            $w = round($qty[0], 2);
                            //Insert Inv Id in Cases
                            $insert = inventory::addCaseIdInInventory($inventory_id, $caseid, $qty[0]);
                        }
                    }
                }
            }
        }else{
            //Get Inventory
            $inv = DB::table('inventories')->where(['user_id'=> $user, 'warehouse_id'=> $terminal_id, 'commodity'=> $commodity_id])->first();

            if($inv)
            {
                $qtl = 0;
                foreach($quantity as $caseid => $qty)
                {
                    $qtl = $qtl + $qty[0];
                }
                //Inset Case Id in Inventory Cases
                $insert = inventory::addCaseIdInInventory($inv->id, $case_id, $qtl);
            }
        }

        //Insert Data
        $insert = CaseGen::updateCaseInventory($data);

        if($insert)
        {
            $status = 'Inventory Updated Successfully.';
        }else{
            $status = 'Something went wrong!';
        }
        
         return redirect('case_inventory')->with('status', $status);  
    }

    // Case Approve
    public function caseApprove(Request $request)
    {
        $request->validate([
            'notes'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['notes'] = $notes = $request->notes;
        xss_clean($data);
        $insert = CaseGen::completeCase($case_id, $notes);

        if($insert)
        {
            $status = 'Case Completed Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }        
        return redirect()->back()->with('status', $status);  
    }

    //View Case 
    public function viewCase(Request $request)
    {
        $case_id = $request->case_id;

        //Get Case Id Details for Pass / In / Out
        $case = CaseGen::getSingleCaseById($case_id);
        if($case->in_out == 'PASS')
        {
            $case_gen = CaseGen::getPassCaseDetails($case_id);
            /*echo "<pre>";
            print_r($case_gen);
            die;*/

            return view('mis.case_gen.view_pass_case', array('case_gen' => $case_gen, 'case_id' => $case_id));
        }
        elseif($case->in_out == 'IN')
        {
            $case_gen = CaseGen::getInCaseDetails($case_id);
            return view('mis.case_gen.view_in_case', array('case_gen' => $case_gen, 'case_id' => $case_id));
        }
        elseif($case->in_out == 'OUT')
        {
            $case_gen = CaseGen::getOutCaseDetails($case_id);
            return view('mis.case_gen.view_out_case', array('case_gen' => $case_gen, 'case_id' => $case_id));
        }

    }

    //check Vehicle No.
    public function checkVehicleNo(Request $request)
    {
        $case_id = $request->case_id;

        //Get Case Id Details for Pass / In / Out
        $case = CaseGen::getSingleCaseByIdStatus($case_id);

        //Get Date
        $datetime = $case->created_at;
        $date = date('Y-m-d',strtotime($datetime));
        $date = date('Y-m-d H:i:s',strtotime($date));

        //Get Same Vehicle No 
        $current_date = date('Y-m-d H:i:s');
        $cases = DB::table('apna_case')
                ->where(['vehicle_no' => $case->vehicle_no, 'status' => 1])
                ->where('case_id', '!=', $case_id)
                ->whereBetween('created_at', [$date, $current_date])
                ->first();

        if($cases){
            echo 1;
        }else{            
            echo 0;
        }
    }

        // Done Deals
    public function done_deals_for_user()
    {
        $user = Auth::user(); 
        $role = DB::table('user_roles')->where('user_id', $user->id)->first();
        return view('user.done_deals', array('role' => $role));
    }

    // Show all users by Ajax
    public function getAllDealsDoneForUserByAjax()
    {
        $done_deals = DB::table('buy_sells')
                        ->leftjoin('user_details','user_details.user_id', '=', 'buy_sells.buyer_id')
                        ->leftjoin('users','users.id', '=', 'buy_sells.seller_id')
                        ->leftjoin('inventories as inv', 'inv.id', '=', 'buy_sells.seller_cat_id')
                        ->leftjoin('categories', 'categories.id', '=', 'inv.commodity')
                        ->leftjoin('warehouses', 'warehouses.id', '=', 'inv.warehouse_id')
                        ->leftjoin('mandi_samitis', 'mandi_samitis.id', '=', 'warehouses.mandi_samiti_id')
                        ->where('buy_sells.status', 2)
                        ->orwhere('buy_sells.status', 3)
                        ->select('buy_sells.*', 'inv.gate_pass_wr', 'user_details.fname as buyer_name', 'users.fname as seller_name', 'categories.category', 'categories.commodity_type', 'warehouses.name as warehouse', 'mandi_samitis.name as mandi_samiti_name')
                        ->orderBy('buy_sells.updated_at', 'DESC')
                        ->groupBy('buy_sells.id')
                        ->get();

        return Datatables::of($done_deals)->addColumn('action', function ($row) {
            $user = Auth::user(); 
            $role = DB::table('user_roles')->where('user_id', $user->id)->first();
            $res = '';
            if($role->role_id == 3){
                if($row->status == 2){
                    $res = '<a href="javascript:;" class="btn btn-warning btn-xs">Not Approve</a>';
                }else{
                    $res = '<a href="'.route('download_vikray_parchi', ['id' => $row->id, 'email' => 0]).'" class="btn btn-info btn-xs" data-toggle="tooltip" title="Deal Done">Download Vikray Parchi</a><a href="'.route('download_vikray_parchi', ['id' => $row->id, 'email' => 1]).'" class="btn btn-info btn-xs" data-toggle="tooltip" title="Send Pdf">Send Mail</a>';
                }
            }
            return $res;
        })->addColumn('done_date', function ($row) {
            $res = date('d M Y', strtotime($row->updated_at));
            return $res;
        })->addColumn('payment_ref_no', function ($row) {
            $res = '';
            if($row->payment_ref_no){
                $res = $row->payment_ref_no;
            }
            else{
                $user = Auth::user(); 
                $role = DB::table('user_roles')->where('user_id', $user->id)->first();
                if($role->role_id == 1){
                    $res = '<a href="javascript:;" id="'.$row->id.'" class="btn btn-warning btn-xs add_payment_ref" data-toggle="tooltip" title="Add Payment Ref. No."><i class="fa fa-plus"></i></a>';
                }
            }
            return $res;
        })->escapeColumns(null)
        ->make(true); 
    }
}
