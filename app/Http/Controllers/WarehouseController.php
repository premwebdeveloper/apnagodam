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

        // All Items
        $items = [];
        $items['1'] = 'item A';
        $items['2'] = 'item B';
        $items['3'] = 'item C';

        // All facilities
        $facilities = [];
        $facilities['1'] = 'Finance';
        $facilities['2'] = 'Dharmkanta';
        $facilities['3'] = 'CCTV';
        $facilities['4'] = 'procurement';

        return view('warehouse.add_warehouse', ['items' => $items, 'facilities' => $facilities]);
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
        $items = $request->items;
        $facilities = $request->facilities;
        $date = date('Y-m-d H:i:s');

        // Array convert into json format
        $items = json_encode($items);
        $facilities = json_encode($facilities);

        // Create Warehouses
        $warehouse = DB::table('warehouses')->insert([
            'name' => $name,
            'village' => $village,
            'capacity' => $capacity,
            'items' => $items,
            'facilities' => $facilities,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($warehouse)
        {
            $status = 'Warehouse Added successfully.';
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
            $status = 'Warehouse deleted successfully.';
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

        return view('warehouse.warehouse_view', array('warehouse' => $warehouse));
    }

    // Warehouse Edit view
    public function warehouse_edit_view(Request $request){

        // All Items
        $items = [];
        $items['1'] = 'item A';
        $items['2'] = 'item B';
        $items['3'] = 'item C';

        // All facilities
        $facilities = [];
        $facilities['1'] = 'Finance';
        $facilities['2'] = 'Dharmkanta';
        $facilities['3'] = 'CCTV';
        $facilities['4'] = 'procurement';

        $id = $request->id;

        // Get warehouse details by id
        $warehouse = DB::table('warehouses')->where('id', $id)->first();

        return view('warehouse.warehouse_edit', array('warehouse' => $warehouse, 'items' => $items, 'facilities' => $facilities));
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
        $items = $request->items;
        $facilities = $request->facilities;
        $date = date('Y-m-d H:i:s');

        // Array convert into json format
        $items = json_encode($items);
        $facilities = json_encode($facilities);

        // Create Warehouses
        $update = DB::table('warehouses')->where('id', $warehouse_id)->update([
            'name' => $name,
            'village' => $village,
            'capacity' => $capacity,
            'items' => $items,
            'facilities' => $facilities,
            'updated_at' => $date
        ]);

        if($update)
        {
            $status = 'Warehouse updated successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('warehouses')->with('status', $status);
    }
}
