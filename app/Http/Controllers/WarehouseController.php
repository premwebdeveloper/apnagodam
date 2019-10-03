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
                        ->where('warehouses.status', 1)
                        ->select('warehouses.*', 'warehouse_rent_rates.address', 'warehouse_rent_rates.location', 'warehouse_rent_rates.area', 'warehouse_rent_rates.district', 'warehouse_rent_rates.area_sqr_ft', 'warehouse_rent_rates.rent_per_month', 'warehouse_rent_rates.capacity_in_mt')
                        ->get();

        return view('warehouse.index', array('warehouses' => $warehouses));
    }

    // Show all warehouses
    public function terminal_enquires(){

        // Get all terminal_enquires
        $warehouses = DB::table('warehouse_enquirers')
                        ->join('warehouses','warehouses.id', '=', 'warehouse_enquirers.warehouse_id')
                        ->where('warehouse_enquirers.status', 1)
                        ->select('warehouse_enquirers.*', 'warehouses.name')
                        ->get();

        return view('warehouse.warehouse_enquiry', array('warehouses' => $warehouses));
    }

    // Add warehouse page view
    public function add_warehouse_view(){

        // All facilities
        $facilities = DB::table('facilitiy_master')->where('status', 1)->get();

        $all_facilities = [];
        foreach ($facilities as $row)
        {
            $all_facilities[$row->id] = $row->name;
        }

        return view('warehouse.add_warehouse', ['all_facilities' => $all_facilities]);
    }

    // Add Warehouse
    public function add_warehouse(Request $request){

        # Set validation for
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'area' => 'required',
            'district' => 'required',
            'area_sqr_ft' => 'required',
            'rent_per_month' => 'required',
            'capacity_in_mt' => 'required',
        ]);

        $name = $request->name;
        $address = $request->address;
        $location = $request->location;
        $area = $request->area;
        $district = $request->district;
        $area_sqr_ft = $request->area_sqr_ft;
        $rent_per_month = $request->rent_per_month;
        $capacity_in_mt = $request->capacity_in_mt;
        $facilities = $request->facilities;
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

        //Get Last Record
        $last_record = DB::table('warehouses')->orderBy('id', 'desc')->first();
        $temp = 'TL001';
        if($last_record)
        {
            $temp = ++$last_record->warehouse_code;
        }
        // Create Warehouses
        $warehouse_id = DB::table('warehouses')->insertGetId([
            'warehouse_code' => $temp,
            'name' => $name,
            'facility_ids' => $facilities,
            'image' => $img_name,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        // create warehouse features
        $warehouse_features = DB::table('warehouse_rent_rates')->insert([
            'warehouse_id' => $warehouse_id,
            'address' => $address,
            'location' => $location,
            'area' => $area,
            'district' => $district,
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
                        ->where('warehouses.status', 1)
                        ->where('warehouses.id', $id)
                        ->select('warehouses.*', 'warehouse_rent_rates.address', 'warehouse_rent_rates.location', 'warehouse_rent_rates.area', 'warehouse_rent_rates.district', 'warehouse_rent_rates.area_sqr_ft', 'warehouse_rent_rates.rent_per_month', 'warehouse_rent_rates.capacity_in_mt', 'warehouse_rent_rates.nearby_transporter_info', 'warehouse_rent_rates.nearby_mandi_info', 'warehouse_rent_rates.nearby_crop_info')
                        ->first();

        $facility_available = '';
        $facilities = json_decode($warehouse->facility_ids);
        foreach ($facilities as $key => $facility) {

            $facility_name = DB::table('facilitiy_master')->where('id', $facility)->first();
            $facility_available .= $facility_name->name.', ';
        }
        $warehouse->{'facility_available'} = $facility_available;

        return view('warehouse.warehouse_view', array('warehouse' => $warehouse));
    }

    // Warehouse Edit view
    public function warehouse_edit_view(Request $request){

        $id = $request->id;
        // All facilities
        $facilities = DB::table('facilitiy_master')->where('status', 1)->get();

        $all_facilities = [];
        foreach ($facilities as $row)
        {
            $all_facilities[$row->id] = $row->name;
        }
        
        // Get warehouse details by id
        $warehouse = DB::table('warehouses')
                        ->join('warehouse_rent_rates','warehouse_rent_rates.warehouse_id', '=', 'warehouses.id')
                        ->where('warehouses.status', 1)
                        ->where('warehouses.id', $id)
                        ->select('warehouses.*', 'warehouse_rent_rates.address', 'warehouse_rent_rates.location', 'warehouse_rent_rates.area', 'warehouse_rent_rates.district', 'warehouse_rent_rates.area_sqr_ft', 'warehouse_rent_rates.rent_per_month', 'warehouse_rent_rates.capacity_in_mt', 'warehouse_rent_rates.nearby_transporter_info', 'warehouse_rent_rates.nearby_mandi_info', 'warehouse_rent_rates.nearby_crop_info')
                        ->first();

        return view('warehouse.warehouse_edit', array('warehouse' => $warehouse, 'all_facilities' => $all_facilities));
    }

    // Edit warehouse
    public function warehouse_edit(Request $request){

        # Set validation for
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'area' => 'required',
            'district' => 'required',
            'area_sqr_ft' => 'required',
            'rent_per_month' => 'required',
            'capacity_in_mt' => 'required',
        ]);

        $warehouse_id = $request->warehouse_id;
        $name = $request->name;
        $address = $request->address;
        $location = $request->location;
        $area = $request->area;
        $district = $request->district;
        $area_sqr_ft = $request->area_sqr_ft;
        $rent_per_month = $request->rent_per_month;
        $capacity_in_mt = $request->capacity_in_mt;
        $facilities = $request->facilities;
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

        // Create Warehouses
        $update = DB::table('warehouses')->where('id', $warehouse_id)->update([
            'name' => $name,
            'facility_ids' => $facilities,
            'image' => $img_name,
            'updated_at' => $date
        ]);

        // update warehouse features
        $update_features = DB::table('warehouse_rent_rates')->where('warehouse_id', $warehouse_id)->update([
            'address' => $address,
            'location' => $location,
            'area' => $area,
            'district' => $district,
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
