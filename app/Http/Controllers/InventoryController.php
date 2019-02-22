<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;

class InventoryController extends Controller
{
    // Construct function
	public function __construct(){

		// Only authenticarte and admin user can enter here
		$this->middleware('auth');
		$this->middleware('adminOnly');
	}

	// Show all inventory
	public function index(){

		$inventories = 	DB::table('inventories')
                        ->join('user_details', 'user_details.user_id', '=', 'inventories.user_id')
                        ->join('categories', 'categories.id', '=', 'inventories.commodity')
         		       	->join('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
         		       	->select('user_details.fname', 'user_details.phone', 'inventories.*', 'categories.category', 'warehouses.name as warehouse')
						->where('inventories.status', 1)
						->get();

    	return view('inventory.index', array('inventories' => $inventories));
	}

	// Create inventory page view
	public function create(){

		// Get all users
		$users = DB::table('user_details')->where('status', 1)->get();

        $all_users[''] = 'Select User';
        foreach ($users as $key => $user) {
            $all_users[$user->user_id] = $user->fname;
        }

        // Get all categories
        $categories = DB::table('categories')->where('status', 1)->get();
		$all_categories[''] = 'Select Commodity';
		foreach ($categories as $key => $category) {
			$all_categories[$category->id] = $category->category;
		}

        // Get all warehouses
        $warehouses = DB::table('warehouses')->where('status', 1)->get();
        $all_warehouses[''] = 'Select Warehouse';
        foreach ($warehouses as $key => $warehouse) {
            $all_warehouses[$warehouse->id] = $warehouse->name;
        }

    	return view('inventory.create', array('users' => $all_users, 'categories' => $all_categories, 'warehouses' => $all_warehouses));
	}

	// Add inventory
	public function add_inventory(Request $request){

		# Set validation for
        $this->validate($request, [
            'user' => 'required',
            'commodity' => 'required',
            'warehouse' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'gate_pass_wr' => 'required',
            'quality_category' => 'required',
            'file' => 'required | mimes:pdf| max:2000',
        ]);

        $user_id = $request->user;
        $commodity = $request->commodity;
        $warehouse = $request->warehouse;
        $quantity = $request->quantity;
        $price = $request->price;
        $quality_category = $request->quality_category;
        $gate_pass_wr = $request->gate_pass_wr;
        $date = date('Y-m-d H:i:s');

        # If user profile image uploaded then
        if($request->hasFile('file')) {

            $file = $request->file;

            $filename = $file->getClientOriginalName();

            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $filename = substr(md5(microtime()),rand(0,26),6);

            $filename .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['pdf'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any PDF !';
                return redirect('create_inventory')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 1052030){
                $status = 'File size is too large. Please upload file less than 2MB !';
                return redirect('create_inventory')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/inventory/';
            $file->move($destinationPath,$filename);
            $filepath = $destinationPath.$filename;
        }

        // Add Inventory
        $inventory = DB::table('inventories')->insert([
            'user_id' => $user_id,
            'warehouse_id' => $warehouse,
            'commodity' => $commodity,
            'type' => null,
            'quantity' => $quantity,
            'price' => $price,
            'gate_pass_wr' => $gate_pass_wr,
            'quality_category' => $quality_category,
            'image' => $filename,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($inventory)
        {
            $status = 'Inventory Added successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('inventory')->with('status', $status);
	}

	// Delete inventory
	public function delete(Request $request){

		$id = $request->id;
        $date = date('Y-m-d H:i:s');

        // User update in users table
        $delete = DB::table('inventories')->where('id', $id)->update([
            'status' => 0,
            'updated_at' => $date
        ]);

        if($delete)
        {
            $status = 'Commodity Deleted successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('inventory')->with('status', $status);
	}

	// Inventory view
	public function view(Request $request){

		$user_id = $request->user_id;
		$id = $request->id;

        // Get inventory details
        $inventory = DB::table('inventories')
         		       	->join('user_details', 'user_details.user_id', '=', 'inventories.user_id')
                        ->join('categories', 'categories.id', '=', 'inventories.commodity')
                        ->join('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
         		       	->select('user_details.fname', 'inventories.*', 'categories.category', 'warehouses.name as warehouse')
						->where(['inventories.id' => $id, 'inventories.status' => 1])
						->first();

        return view('inventory.view', array('inventory' => $inventory));
	}

	// Inventory edit view
	public function inventory_edit_view(Request $request){

		$user_id = $request->user_id;
		$id = $request->id;

		// Get inventory details
        $inventory = DB::table('inventories')
         		       	->join('user_details', 'user_details.user_id', '=', 'inventories.user_id')
         		       	->select('user_details.fname', 'inventories.*')
						->where(['inventories.id' => $id, 'inventories.status' => 1])
						->first();

		// Get all users
		$users = DB::table('user_details')->where('status', 1)->get();

		$all_users = [];
		foreach ($users as $key => $user) {
			$all_users[$user->user_id] = $user->fname;
		}

        // Get all categories
        $categories = DB::table('categories')->where('status', 1)->get();

        $all_categories[''] = 'Select Commodity';
        foreach ($categories as $key => $category) {
            $all_categories[$category->id] = $category->category;
        }

        // Get all warehouses
        $warehouses = DB::table('warehouses')->where('status', 1)->get();

        $all_warehouses[''] = 'Select Warehouse';
        foreach ($warehouses as $key => $warehouse) {
            $all_warehouses[$warehouse->id] = $warehouse->name;
        }

    	return view('inventory.edit', array('users' => $all_users, 'inventory' => $inventory, 'categories' => $all_categories, 'warehouses' => $all_warehouses));
	}

	// Edit inventory
	public function edit(Request $request){

		# Set validation for
        $this->validate($request, [
            'user' => 'required',
            'warehouse' => 'required',
            'commodity' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'gate_pass_wr' => 'required',
            'quality_category' => 'required',
            //'image' => 'mimes:pdf| max:1000',
        ]);

        $id = $request->inventory_id;
        $user_id = $request->user;
        $warehouse = $request->warehouse;
        $commodity = $request->commodity;
        $quantity = $request->quantity;
        $price = $request->price;
        $quality_category = $request->quality_category;
        $gate_pass_wr = $request->gate_pass_wr;
        $date = date('Y-m-d H:i:s');

        $inventory = DB::table('inventories')
         		       	->join('user_details', 'user_details.user_id', '=', 'inventories.user_id')
         		       	->select('user_details.fname', 'inventories.*')
						->where(['inventories.id' => $id, 'inventories.status' => 1])
						->first();

		$filename = $inventory->image;

        # If user profile image uploaded then
        if($request->hasFile('file')) {

            $file = $request->file;

            $filename = $file->getClientOriginalName();

            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $filename = substr(md5(microtime()),rand(0,26),6);

            $filename .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['pdf'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any PDF !';
                return redirect('create_inventory')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 1052030){
                $status = 'File size is too large. Please upload file less than 2MB !';
                return redirect('create_inventory')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/inventory/';
            $file->move($destinationPath,$filename);
            $filepath = $destinationPath.$filename;
        }

        // Edit Inventory
        $edit = DB::table('inventories')->where('id', $id)->update([
            'user_id' => $user_id,
            'warehouse_id' => $warehouse,
            'commodity' => $commodity,
            'quantity' => $quantity,
            'quality_category' => $quality_category,
            'gate_pass_wr' => $gate_pass_wr,
            'price' => $price,
            'image' => $filename,
            'updated_at' => $date
        ]);

        if($edit)
        {
            $status = 'Inventory Updated successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('inventory')->with('status', $status);
	}

}
