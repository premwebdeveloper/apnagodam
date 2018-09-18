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
         		       	->select('user_details.fname', 'inventories.*')
						->where('inventories.status', 1)
						->get();

    	return view('inventory.index', array('inventories' => $inventories));
	}

	// Create inventory page view
	public function create(){

		// Get all users
		$users = DB::table('user_details')->where('status', 1)->get();

		$all_users = [];
		foreach ($users as $key => $user) {			
			$all_users[$user->user_id] = $user->fname;
		}

    	return view('inventory.create', array('users' => $all_users));
	}

	// Add inventory
	public function add_inventory(Request $request){

		# Set validation for
        $this->validate($request, [
            'user' => 'required',
            'commodity' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'required | mimes:jpeg,jpg,png,gif,bmp | max:1000',
        ]);

        $user_id = $request->user;
        $commodity = $request->commodity;
        $quantity = $request->quantity;
        $price = $request->price;
        $date = date('Y-m-d H:i:s');

        # If user profile image uploaded then
        if($request->hasFile('image')) {

            $file = $request->image;

            $filename = $file->getClientOriginalName();

            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $filename = substr(md5(microtime()),rand(0,26),6);

            $filename .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'png', 'gig', 'bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('create_inventory')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 1052030){
                $status = 'File size is too large. Please upload file less than 1MB !';
                return redirect('create_inventory')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/inventory/';
            $file->move($destinationPath,$filename);
            $filepath = $destinationPath.$filename;            
        }

        // Add Inventory
        $inventory = DB::table('inventories')->insert([
            'user_id' => $user_id,
            'commodity' => $commodity,
            'type' => null,
            'quantity' => $quantity,
            'price' => $price,
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
         		       	->select('user_details.fname', 'inventories.*')
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

    	return view('inventory.edit', array('users' => $all_users, 'inventory' => $inventory));
	}

	// Edit inventory
	public function edit(Request $request){

		# Set validation for
        $this->validate($request, [
            'user' => 'required',
            'commodity' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif,bmp | max:1000',
        ]);

        $id = $request->inventory_id;
        $user_id = $request->user;
        $commodity = $request->commodity;
        $quantity = $request->quantity;
        $price = $request->price;
        $date = date('Y-m-d H:i:s');

        $inventory = DB::table('inventories')
         		       	->join('user_details', 'user_details.user_id', '=', 'inventories.user_id')
         		       	->select('user_details.fname', 'inventories.*')
						->where(['inventories.id' => $id, 'inventories.status' => 1])
						->first();

		$filename = $inventory->image;	

        # If user profile image uploaded then
        if($request->hasFile('image')) {

            $file = $request->image;

            $filename = $file->getClientOriginalName();

            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $filename = substr(md5(microtime()),rand(0,26),6);

            $filename .= '.'.$ext;

            // First check file extension if file is not image then hit error
            $extensions = ['jpg', 'jpeg', 'png', 'gig', 'bmp'];

            if(! in_array($ext, $extensions))
            {
                $status = 'File type is not allowed you have uploaded. Please upload any image !';
                return redirect('create_inventory')->with('status', $status);
            }

            $filesize = $file->getClientSize();

            // first check file size if greater than 1mb than hit error
            if($filesize > 1052030){
                $status = 'File size is too large. Please upload file less than 1MB !';
                return redirect('create_inventory')->with('status', $status);
            }

            $destinationPath = base_path() . '/resources/assets/upload/inventory/';
            $file->move($destinationPath,$filename);
            $filepath = $destinationPath.$filename;            
        }

        // Edit Inventory
        $edit = DB::table('inventories')->where('id', $id)->update([
            'user_id' => $user_id,
            'commodity' => $commodity,
            'quantity' => $quantity,
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
