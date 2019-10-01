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
        $warehouses = DB::table('warehouses')->where('status', 1)->get();

        return view('warehouse.index', array('warehouses' => $warehouses));
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
            'village' => 'required',
            'capacity' => 'required',
        ]);

        $name = $request->name;
        $village = $request->village;
        $capacity = $request->capacity;
        $facilities = $request->facilities;
        $date = date('Y-m-d H:i:s');

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
        }else{
                $status = 'Please upload image !';
                return redirect('add_warehouse')->with('status', $status);
        }

        // Array convert into json format
        $facilities = json_encode($facilities);

        // Create Warehouses
        $warehouse = DB::table('warehouses')->insert([
            'name' => $name,
            'village' => $village,
            'capacity' => $capacity,
            'facility_ids' => $facilities,
            'image' => $img_name,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($warehouse)
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
        $warehouse = DB::table('warehouses')->where('id', $id)->first();


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

        // All Items
        $all_items = DB::table('items')->where('status', 1)->get();
        $items = [];

        foreach ($all_items as $key => $item) {
            $items[$item->id] = $item->item;
        }

//        echo "<pre>";
        // All facilities
        $facilities = DB::table('facilitiy_master')->where('status', 1)->get();

        $all_facilities = [];
        foreach ($facilities as $row)
        {
            $all_facilities[$row->id] = $row->name;
        }
        
        $id = $request->id;

        // Get warehouse details by id
        $warehouse = DB::table('warehouses')->where('id', $id)->first();

 /*       print_r($warehouse);
        die;*/

        return view('warehouse.warehouse_edit', array('warehouse' => $warehouse, 'items' => $items, 'all_facilities' => $all_facilities));
    }

    // Edit warehouse
    public function warehouse_edit(Request $request){

        # Set validation for
        $this->validate($request, [
            'name' => 'required',
            'village' => 'required',
            'capacity' => 'required',
        ]);

        $warehouse_id = $request->warehouse_id;
        $name = $request->name;
        $village = $request->village;
        $capacity = $request->capacity;
        $facilities = $request->facilities;
        $date = date('Y-m-d H:i:s');

        // Array convert into json format
        //$items = json_encode($items);
        $facilities = json_encode($facilities);

        // Create Warehouses
        $update = DB::table('warehouses')->where('id', $warehouse_id)->update([
            'name' => $name,
            'village' => $village,
            'capacity' => $capacity,
            'facility_ids' => $facilities,
            'updated_at' => $date
        ]);

        if($update)
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
