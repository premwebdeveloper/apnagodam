<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use App\Mis;
use App\CaseGen;
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
    	$case_gen = CaseGen::getCaseGen();

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

        //Get All Employees 
        $res = Mis::getEmployess();
        $employees = array('' => 'Select Employee');
        foreach($res as $emp)
        {
            if($emp->role_id == 6 || $emp->role_id == 8 || $emp->role_id == 9)
            {
                $employees[$emp->user_id] = $emp->emp_id;
            }
        }

        //Get All Customer 
        $res = DB::table('user_details')->where('status', 1)->orderBy('fname', 'ASC')->get();
        $customers = array('' => 'Select Customer');
        foreach($res as $cust)
        {
            $customers[$cust->user_id] = $cust->fname." ".$cust->lname. " (********".substr( $cust->phone, -2 ).")";
        }

    	return view('mis.case_gen.index', array('case_gen' => $case_gen, 'terminals' => $terminals, 'commodity' => $commodity, 'employees' => $employees, 'customers' => $customers));
    }

    //Get Lead Generator Details by Ajax
    public function getLeadGenRec(Request $request)
    {
        $id = $request->customer_uid;
        $uesr = DB::table('users')->where('id', $id)->first();        
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
            'gate_pass'    => 'required',
            'quantity'    => 'required|numeric',
            'commodity_id'      => 'required|numeric',
            'terminal_id'      => 'required|numeric',
            'vehicle_no'      => 'required',
            'lead_generator'      => 'required',
            'in_out'      => 'required',
            'purpose'      => 'required',
        ]);

        $currentuserid = Auth::user()->id;

        $data['user_id'] = $user_id = $request->customer_uid;
        $data['terminal_id'] = $terminal_id = $request->terminal_id;
        $data['in_out'] = $in_out = $request->in_out;
        $data['gate_pass'] = $gate_pass = $request->gate_pass;
        $data['customer_uid'] = $customer_uid = $request->customer_uid;
        $data['quantity'] = $quantity = $request->quantity;
        $data['location'] = $location = $request->location;
        $data['commodity_id'] = $commodity_id = $request->commodity_id;
        $data['vehicle_no'] = $vehicle_no = $request->vehicle_no;
        $data['purpose'] = $purpose = $request->purpose;
        
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
        
        if($request->lead_generator)
        {
            $data['lead_generator'] = $lead_generator = $request->lead_generator;
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
        //Get All Post Data
        $request->validate([
            'price'    => 'required',
            'processing_fees'    => 'required',
            'rent'      => 'required',
            'transaction_type'      => 'required',
            'labour_rate'      => 'required',
            'interest_rate'      => 'required',
        ]);

        $currentuserid = Auth::user()->id;

        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['price'] = $price = $request->price;
        $data['processing_fees'] = $processing_fees = $request->processing_fees;
        $data['transaction_type'] = $transaction_type = $request->transaction_type;
        $data['rent'] = $rent = $request->rent;
        $data['interest_rate'] = $interest_rate = $request->interest_rate;
        $data['labour_rate'] = $labour_rate = $request->labour_rate;
        $data['notes'] = $notes = $request->notes;

        //Insert Data
        $insert = CaseGen::setPrice($data);

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
                return redirect('quality_report')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 3052030){
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
            'report_file'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
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
            if($filesize > 3052030){
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

    // Kanta Parchi
    public function close_case(Request $request)
    {
        $case_id = $request->id;

        //Close Case ID
        $case_gen = CaseGen::closeCase($case_id);
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
            'report_file'    => 'required',
        ]);
        /*$request->validate([
            'rst_no'    => 'required',
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
                return redirect('kanta_parchi')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 3052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('kanta_parchi')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/kanta_parchi/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }

        $data['file'] = $img_name;

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
        $request->validate([
            'transporter'    => 'required',
            'vehicle'    => 'required',
            'driver_name'    => 'required',
            'driver_phone'    => 'required',
            'rate_per_km'    => 'required',
            'min_weight'    => 'required',
            'max_weight'    => 'required',
            'turnaround_time'    => 'required',
            'total_weight'    => 'required',
            'no_of_bags'    => 'required',
            'kanta_parchi_no'    => 'required',
            'total_transport_cost'    => 'required',
            'advance_payment'    => 'required',
            'start_date_time'    => 'required',
            'final_settlement_amount'    => 'required',
            'end_date_time'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
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
        $data['notes'] = $notes = $request->notes;

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
        $request->validate([
            'labour_contractor'    => 'required',
            'contractor_no'    => 'required',
            'labour_rate_per_bags'    => 'required',
            'total_labour'    => 'required',
            'location'    => 'required',
            'booking_date'    => 'required',
            'total_bags'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['labour_contractor'] = $labour_contractor = ucfirst($request->labour_contractor);
        $data['contractor_no'] = $contractor_no = $request->contractor_no;
        $data['labour_rate_per_bags'] = $labour_rate_per_bags = $request->labour_rate_per_bags;
        $data['total_labour'] = $total_labour = $request->total_labour;
        $data['location'] = $location = $request->location;
        $data['booking_date'] = $booking_date = $request->booking_date;
        $data['total_bags'] = $total_bags = $request->total_bags;
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
            if($filesize > 3052030){
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
                return redirect('second_kanta_parchi')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 3052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('second_kanta_parchi')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/second_kanta_parchi/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }

        $data['file'] = $img_name;

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
            if($filesize > 3052030){
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
            'vikray_parchi'    => 'required',
            'tally_updation'    => 'required',
            'cold_win_entry'    => 'required',
            'whs_issulation'    => 'required',
        ]);

        $currentuserid = Auth::user()->id;
        $data['user_id'] = $user_id = $currentuserid;
        $data['case_id'] = $case_id = $request->case_id;
        $data['vikray_parchi'] = $vikray_parchi = $request->vikray_parchi;
        $data['tally_updation'] = $tally_updation = $request->tally_updation;
        $data['cold_win_entry'] = $cold_win_entry = $request->cold_win_entry;
        $data['whs_issulation'] = $whs_issulation = $request->whs_issulation;
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
        //Get All Post Data
        $request->validate([
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
                return redirect('quality_claim')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 3052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('quality_claim')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/quality_claim/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }

        $data['imge'] = $img_name;

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
                return redirect('truck_payment')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 3052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('truck_payment')->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/truck_payment/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }else{

            $status = 'Please Upload file.';
            return redirect('truck_payment')->with('error', $status);  
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
                return redirect('labour_payment')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 3052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('labour_payment')->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/labour_payment/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }else{

            $status = 'Please Upload file.';
            return redirect('labour_payment')->with('error', $status);  
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
                return redirect('payment_received')->with('error', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 3052030){
                $status = 'File size is too large. Please upload file less than 3MB !';
                return redirect('payment_received')->with('error', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/payment_received/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }else{

            $status = 'Please Upload file.';
            return redirect('payment_received')->with('error', $status);  
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

}
