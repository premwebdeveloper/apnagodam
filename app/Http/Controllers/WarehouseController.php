<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\User;
use DB;

class WarehouseController extends Controller
{
	// Construct function
	public function __construct(){

		// Only authenticarte and admin user can enter here
		$this->middleware('auth');
		$this->middleware('adminOnly');
	}

    // Show all warehouses
    public function index(){

        // Get all warehouses
        $warehouses = DB::table('warehouses')
            ->join('warehouse_rent_rates','warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
            ->join('states','states.code', '=', 'warehouse_rent_rates.state')
            ->join('districts','districts.id', '=', 'warehouse_rent_rates.district')
            ->join('mandi_samitis','mandi_samitis.id', '=', 'warehouses.mandi_samiti_id')
            ->leftjoin('dharam_kanta','dharam_kanta.id', '=', 'warehouses.dharam_kanta')
            ->where('warehouses.status', 1)
            ->select('warehouses.*', 'warehouse_rent_rates.address', 'warehouse_rent_rates.location', 'warehouse_rent_rates.area', 'districts.name as district', 'states.name as state', 'warehouse_rent_rates.area_sqr_ft', 'warehouse_rent_rates.rent_per_month', 'warehouse_rent_rates.capacity_in_mt', 'mandi_samitis.name as mandi_samiti_name', 'dharam_kanta.name as dharam_kanta_name')
            ->groupBy('warehouses.id')
            ->get();

        return view('warehouse.index', array('warehouses' => $warehouses));
    }

    // Show all warehouses
    public function terminal_enquires(){

        // Get all terminal_enquires
        $warehouses = DB::table('warehouse_enquirers')
                        ->join('warehouses','warehouses.id', '=', 'warehouse_enquirers.warehouse_id')
                        ->join('categories','categories.id', '=', 'warehouse_enquirers.commodity')
                        ->where('warehouse_enquirers.status', 1)
                        ->select('warehouse_enquirers.*', 'warehouses.name', 'categories.category as commodity_name')
                        ->get();

        return view('warehouse.warehouse_enquiry', array('warehouses' => $warehouses));
    }

    // delete terminal enquiry
    public function delete_terminal_enquiry(Request $request){

        $enquiry_id = $request->enquiry_id;

        $delete = DB::table('warehouse_enquirers')->where('id', $enquiry_id)->delete();

        if($delete)
        {
            $status = 'Terminal Enquiry Deleted successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('terminal_enquires')->with('status', $status);
    }

    // Add warehouse page view
    public function add_warehouse_view(){

        // All facilities
        $facilities = DB::table('facilitiy_master')->where('status', 1)->get();

        //Get States
        $states_data = DB::table('states')->get();
        $states = array('' => 'Select State');
        foreach ($states_data as $key => $value) {
            $states[$value->code] = $value->name;
        }

        // Get all madi samities
        $mandi_samiti = DB::table('mandi_samitis')->where('status', 1)->get();

        $all_facilities = [];
        foreach ($facilities as $row)
        {
            $all_facilities[$row->id] = $row->name;
        }

        // Get all Dharam Kanta
        $kanta = DB::table('dharam_kanta')->where('status', 1)->get();

        $dharm_kanta = ['' => 'Select Dharam Kanta'];
        foreach ($kanta as $row)
        {
            $dharm_kanta[$row->id] = $row->name;
        }

        // All Banks
        $bank_master = DB::table('bank_master')->where('status', 1)->get();

        $banks = [];
        foreach ($bank_master as $row)
        {
            $banks[$row->id] = $row->bank_name;
        }

        return view('warehouse.add_warehouse', ['all_facilities' => $all_facilities, 'banks' => $banks, 'mandi_samiti' => $mandi_samiti, 'states' => $states, 'dharm_kanta' => $dharm_kanta]);
    }

    // Add Warehouse
    public function add_warehouse(Request $request){

        # Set validation for
        $this->validate($request, [
            'mandi_samiti' => 'required',
            'name' => 'required',
            'address' => 'required',
            'state' => 'required',
            'district' => 'required',
            'area_sqr_ft' => 'required',
            'rent_per_month' => 'required',
            'capacity_in_mt' => 'required',
        ]);

        $mandi_samiti = $request->mandi_samiti;
        $name = $request->name;
        $address = $request->address;
        $location = $request->location;
        $state = $request->state;
        $district = $request->district;
        $area_sqr_ft = $request->area_sqr_ft;
        $rent_per_month = $request->rent_per_month;
        $capacity_in_mt = $request->capacity_in_mt;
        $facilities = $request->facilities;
        $gatepass_start = $request->gatepass_start;
        $gatepass_end = $request->gatepass_end;
        $no_of_stacks = $request->no_of_stacks;
        $dharam_kanta = $request->dharam_kanta;
        $labour_contractor = $request->labour_contractor;
        $contractor_phone = $request->contractor_phone;
        $labour_rate = $request->labour_rate;
        $banks = $request->banks;
        $date = date('Y-m-d H:i:s');

        $transporter_info = $request->transporter_info;
        $mandi_info = $request->mandi_info;
        $crop_info = $request->crop_info;

        if($request->hasFile('image')) {

            $file = $request->image;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'png', 'gig', 'bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('add_warehouse')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 2052030){
                $status = 'File size is too large. Please upload file less than 2MB !';
                return redirect('add_warehouse')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/warehouses/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }
        else{
            $status = 'Please upload image !';
            return redirect('add_warehouse')->with('status', $status);
        }

        // Array convert into json format
        $facilities = json_encode($facilities);
        $banks = json_encode($banks);

        //Get District Code
        $dis = DB::table('districts')->where('id', $district)->first();

        //Get Last Record
        $last_record = DB::table('warehouses')->orderBy('id', 'desc')->first();
        $t_id = sprintf("%02d", $state).sprintf("%02d", $dis->district_code);

        //Get last Record
        $data = DB::table('warehouses')->where('warehouse_code', "like", "%" . $t_id."%")->orderBy('id', 'DESC')->first();
        if($data)
        {
            $t_id = str_pad(intval($data->warehouse_code) + 1, strlen($data->warehouse_code), '0', STR_PAD_LEFT);
            
        }else{
            $t_id = $t_id."01";
        }        

        // Create Warehouses
        $warehouse_id = DB::table('warehouses')->insertGetId([
            'mandi_samiti_id' => $mandi_samiti,
            'warehouse_code' => $t_id,
            'name' => $name,
            'facility_ids' => $facilities,
            'bank_ids' => $banks,
            'image' => $img_name,
            'gatepass_start' => $gatepass_start,
            'gatepass_end' => $gatepass_end,
            'no_of_stacks' => $no_of_stacks,
            'dharam_kanta' => $dharam_kanta,
            'labour_contractor' => $labour_contractor,
            'contractor_phone' => $contractor_phone,
            'labour_rate' => $labour_rate,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        // create warehouse features
        $warehouse_features = DB::table('warehouse_rent_rates')->insert([
            'warehouse_id' => $warehouse_id,
            'address' => $address,
            'location' => $location,
            'district' => $district,
            'state' => $state,
            'area_sqr_ft' => $area_sqr_ft,
            'rent_per_month' => $rent_per_month,
            'capacity_in_mt' => $capacity_in_mt,
            'nearby_transporter_info' => $transporter_info,
            'nearby_mandi_info' => $mandi_info,
            'nearby_crop_info' => $crop_info,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($warehouse_features)
        {
            $status = 'Terminal Added successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('warehouses')->with('status', $status);
    }

    // Delete warehouse
    public function warehouse_delete(Request $request){

        $id = $request->id;
        $date = date('Y-m-d H:i:s');

        // Delete warehouse in warehouses table
        $delete = DB::table('warehouses')->where('id', $id)->update([
            'status' => 2,
            'updated_at' => $date
        ]);

        if($delete)
        {
            $status = 'Terminal deleted successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('warehouses')->with('status', $status);

    }

    // warehouse view
    public function warehouse_view(Request $request){

        $id = $request->id;

        // Get warehouse details by id
        $warehouse = DB::table('warehouses')
                        ->join('warehouse_rent_rates','warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
                        ->leftjoin('mandi_samitis','mandi_samitis.id', '=', 'warehouses.mandi_samiti_id')
                        ->where('warehouses.status', 1)
                        ->where('warehouses.id', $id)
                        ->select('warehouses.*', 'warehouse_rent_rates.address', 'warehouse_rent_rates.location', 'warehouse_rent_rates.area', 'warehouse_rent_rates.district', 'warehouse_rent_rates.area_sqr_ft', 'warehouse_rent_rates.rent_per_month', 'warehouse_rent_rates.capacity_in_mt', 'warehouse_rent_rates.nearby_transporter_info', 'warehouse_rent_rates.nearby_mandi_info', 'warehouse_rent_rates.nearby_crop_info', 'mandi_samitis.name as mandi_samiti_name')
                        ->first();

        $facility_available = '';

        $facilities = json_decode($warehouse->facility_ids);
        if($facilities)
        {
            foreach ($facilities as $key => $facility) {

                $facility_name = DB::table('facilitiy_master')->where('id', $facility)->first();
                $facility_available .= $facility_name->name.', ';
            }
        }
        $warehouse->{'facility_available'} = $facility_available;

         $bank_provide_loan = '';

        $banks = json_decode($warehouse->bank_ids);
        if($banks)
        {
            foreach ($banks as $key => $bank) {

                $bank_name = DB::table('bank_master')->where('id', $bank)->first();
                $bank_provide_loan .= $bank_name->bank_name.', ';
            }
        }
        $warehouse->{'bank_provide_loan'} = $bank_provide_loan;

        return view('warehouse.warehouse_view', array('warehouse' => $warehouse));
    }

    // Warehouse Edit view
    public function warehouse_edit_view(Request $request){

        $id = $request->id;
        // All facilities
        $facilities = DB::table('facilitiy_master')->where('status', 1)->get();

        // Get all madi samities
        $mandi_samiti = DB::table('mandi_samitis')->where('status', 1)->get();

        $all_facilities = [];
        foreach ($facilities as $row)
        {
            $all_facilities[$row->id] = $row->name;
        }

        // All Banks
        $bank_master = DB::table('bank_master')->where('status', 1)->get();

        $banks = [];
        foreach ($bank_master as $row)
        {
            $banks[$row->id] = $row->bank_name;
        }

        //Get States
        $states_data = DB::table('states')->get();
        $states = array('' => 'Select State');
        foreach ($states_data as $key => $value) {
            $states[$value->code] = $value->name;
        }

        // Get all Dharam Kanta
        $kanta = DB::table('dharam_kanta')->where('status', 1)->get();

        $dharm_kanta = ['' => 'Select Dharam Kanta'];
        foreach ($kanta as $row)
        {
            $dharm_kanta[$row->id] = $row->name;
        }

        
        // Get warehouse details by id
        $warehouse = DB::table('warehouses')
                        ->join('warehouse_rent_rates','warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
                        ->where('warehouses.status', 1)
                        ->where('warehouses.id', $id)
                        ->select('warehouses.*', 'warehouse_rent_rates.address', 'warehouse_rent_rates.location', 'warehouse_rent_rates.state', 'warehouse_rent_rates.district', 'warehouse_rent_rates.area_sqr_ft', 'warehouse_rent_rates.rent_per_month', 'warehouse_rent_rates.capacity_in_mt', 'warehouse_rent_rates.nearby_transporter_info', 'warehouse_rent_rates.nearby_mandi_info', 'warehouse_rent_rates.nearby_crop_info')
                        ->first();

        //Get States
        $district_data = DB::table('districts')->where('state_code', $warehouse->state)->get();
        $districts = array('' => 'Select State');
        foreach ($district_data as $key => $value) {
            $districts[$value->district_code] = $value->name;
        }

        return view('warehouse.warehouse_edit', array('warehouse' => $warehouse, 'all_facilities' => $all_facilities, 'banks' => $banks, 'mandi_samiti' => $mandi_samiti, 'districts' => $districts, 'states' => $states, 'dharm_kanta' => $dharm_kanta));
    }

    // Edit warehouse
    public function warehouse_edit(Request $request){

        # Set validation for
        $this->validate($request, [
            'mandi_samiti' => 'required',
            'name' => 'required',
            'address' => 'required',
            'area_sqr_ft' => 'required',
            'rent_per_month' => 'required',
            'capacity_in_mt' => 'required',
        ]);

        $warehouse_id = $request->warehouse_id;
        $mandi_samiti = $request->mandi_samiti;
        $name = $request->name;
        $address = $request->address;
        $location = $request->location;
        $area_sqr_ft = $request->area_sqr_ft;
        $rent_per_month = $request->rent_per_month;
        $capacity_in_mt = $request->capacity_in_mt;
        $facilities = $request->facilities;
        $gatepass_start = $request->gatepass_start;
        $no_of_stacks = $request->no_of_stacks;
        $dharam_kanta = $request->dharam_kanta;
        $gatepass_end = $request->gatepass_end;
        $labour_contractor = $request->labour_contractor;
        $contractor_phone = $request->contractor_phone;
        $labour_rate = $request->labour_rate;
        $banks = $request->banks;
        $date = date('Y-m-d H:i:s');

        $transporter_info = $request->transporter_info;
        $mandi_info = $request->mandi_info;
        $crop_info = $request->crop_info;

        $warehouse = DB::table('warehouses')
                        ->join('warehouse_rent_rates','warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
                        ->where('warehouses.status', 1)
                        ->where('warehouses.id', $warehouse_id)
                        ->select('warehouses.*', 'warehouse_rent_rates.address', 'warehouse_rent_rates.location', 'warehouse_rent_rates.area', 'warehouse_rent_rates.district', 'warehouse_rent_rates.area_sqr_ft', 'warehouse_rent_rates.rent_per_month', 'warehouse_rent_rates.capacity_in_mt')
                        ->first();

        if($request->hasFile('image')) {

            $file = $request->image;

            $img_name = $file->getClientOriginalName();

            $ext = pathinfo($img_name, PATHINFO_EXTENSION);

            $img_name = substr(md5(microtime()),rand(0,26),6);

            $img_name .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'png', 'gig', 'bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('add_warehouse')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 2052030){
                $status = 'File size is too large. Please upload file less than 2MB !';
                return redirect('add_warehouse')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/warehouses/';
            $file->move($destinationPath,$img_name);
            $filepath = $destinationPath.$img_name;
        }
        else{
            $img_name = $warehouse->image;
        }

        // Array convert into json format
        $facilities = json_encode($facilities);
        $banks = json_encode($banks);

        // Create Warehouses
        $update = DB::table('warehouses')->where('id', $warehouse_id)->update([
            'mandi_samiti_id' => $mandi_samiti,
            'name' => $name,
            'facility_ids' => $facilities,
            'bank_ids' => $banks,
            'image' => $img_name,
            'gatepass_start' => $gatepass_start,
            'gatepass_end' => $gatepass_end,
            'no_of_stacks' => $no_of_stacks,
            'dharam_kanta' => $dharam_kanta,
            'labour_contractor' => $labour_contractor,
            'contractor_phone' => $contractor_phone,
            'labour_rate' => $labour_rate,
            'updated_at' => $date
        ]);

        // update warehouse features
        $update_features = DB::table('warehouse_rent_rates')->where('warehouse_id', $warehouse_id)->update([
            'address' => $address,
            'location' => $location,            
            'area_sqr_ft' => $area_sqr_ft,
            'rent_per_month' => $rent_per_month,
            'capacity_in_mt' => $capacity_in_mt,
            'nearby_transporter_info' => $transporter_info,
            'nearby_mandi_info' => $mandi_info,
            'nearby_crop_info' => $crop_info,
            'updated_at' => $date
        ]);

        if($update_features)
        {
            $status = 'Terminal updated successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('warehouses')->with('status', $status);
    }
}
