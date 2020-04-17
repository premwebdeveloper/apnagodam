<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;
use DataTables;
use App\CaseGen;
use App\inventory;

class InventoryController extends Controller
{
    // Construct function
	public function __construct(){

		// Only authenticarte and admin user can enter here
		$this->middleware('auth');
		//$this->middleware('adminOnly');
	}

	// Show all inventory
	public function index()
    {
		return view('inventory.index');
	}

    // Show all inventory
    public function getAllInventoresByAjax(){

        $inventories = inventory::getInventories();

        //  Get All Page titles
        return Datatables::of($inventories)->addColumn('action', function ($row) {
            $action = '<a href="'.route('inventory_view', ['user_id' => $row->user_id, 'id' => $row->id]).'" class="btn btn-info btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>';
            $action .= '&nbsp;&nbsp;<a href="'.route('inventory_delete', ['id' => $row->id]).'" onclick="return confirm(\'Are you sure ! you want to Delete this Inventory?\');" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>';
            return $action;
        })->addColumn('case_ids', function ($row) {
            $all_cases = inventory::getInventoryCases($row->id);
            $cases = '';
            foreach($all_cases as $key => $case){
                $cases .= '<a class="btn btn-xs btn-default" href="'.url('/')."/viewCase/".$case->case_id.'">'.$case->case_id."</a>";
            }
            return $cases;
        })->addColumn('user_name', function ($row) {
            return $row->fname." ".$row->lname." (".$row->phone.")";
        })->addColumn('in_out', function ($row) {
            $in_out = '';
            if($row->status == 1){
                $in_out = 'IN';
            }else{
                $in_out = 'OUT';
            }
            return $in_out;
        })->addColumn('in__out_status', function ($row) {
            $status = '';
            if($row->status == 1){
                $status = '<span class="text-info"><b>In Storage</b></span>';
            }else if($row->status == 0){
                $status = '<span class="red"><b>Out</b></span>';
            }
            return $status;
        })->addColumn('warehouse_name', function ($row) {
            return $row->warehouse." (".$row->warehouse_code.")";
        })->addColumn('date', function ($row) {
            return date('d M Y H:i:s', strtotime($row->created_at));
        })->escapeColumns(null)
        ->make(true);
    }

	// Create inventory page view
	public function create(){

		// Get all users
		$users = DB::table('user_details')
                ->join('user_roles', 'user_roles.user_id', '=', 'user_details.user_id')
                ->select('user_details.*')
                ->where(array('user_details.status' => 1, 'user_roles.role_id' => 2))->get();

        $all_users[''] = 'Select User';
        foreach ($users as $key => $user) {
            $all_users[$user->user_id] = $user->fname;
        }

        // Get all categories
        $categories = DB::table('categories')->where('status', 1)->get();
		$all_categories[''] = 'Select Commodity';
		foreach ($categories as $key => $category) {
			$all_categories[$category->id] = $category->category." (".$category->commodity_type.")";
		}

        // Get all warehouses
        $warehouses = DB::table('warehouses')->where('status', 1)->get();
        $all_warehouses[''] = 'Select Warehouse';
        foreach ($warehouses as $key => $warehouse) {
            $all_warehouses[$warehouse->id] = $warehouse->name;
        }

    	return view('inventory.create', array('users' => $all_users, 'categories' => $all_categories, 'warehouses' => $all_warehouses));
	}

    //get Cases Id For Users
    public function getCasesIdForUsers(Request $request)
    {
        $id = $request->id;
        $cases = CaseGen::getCasesByUser($id);
        $option = '';

        foreach($cases as $key => $case){
            $option .= '<option value="'.$case->case_id.'">'.$case->case_id.'</option>'; 
        }
        echo $option;
    }

	// Add inventory
	public function add_inventory(Request $request){

		# Set validation for
        $this->validate($request, [
            'user'             => 'required',
            'commodity'        => 'required',
            'gate_pass_wr'     => 'required',
            'warehouse'        => 'required',
            'case_id'          => 'required',
            'weight_bridge_no' => 'required',
            'truck_no'         => 'required',
            'stack_no'         => 'required',
            'quantity'         => 'required',
            'price'            => 'required',
            'quality_category' => 'required',
        ]);

        //Get Commodity Type
        $categories = DB::table('categories')->where(['id' => $request->commodity,'status' => 1])->first();

        if($categories->commodity_type == 'Secondary')
        {
            $sales_status = 2;
        }else{
            $sales_status = 1;
        }

        $data['user_id']          = $request->user;
        $data['commodity']        = $request->commodity;
        $data['warehouse']        = $request->warehouse;
        $data['weight_bridge_no'] = $request->weight_bridge_no;
        $data['truck_no']         = $request->truck_no;
        $data['stack_no']         = $request->stack_no;
        $data['net_weight']       = null;
        $data['quantity']         = $request->quantity;
        $data['price']            = $request->price;
        $data['quality_category'] = $request->quality_category;
        $data['gate_pass_wr']     = $request->gate_pass_wr;
        $data['sales_status']     = $request->sales_status;
        
        $case_ids     = $request->case_id;

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
        }else{
            $filename = null;
        }

        $data['file'] = $filename;

        //Check already inserted or not
        $check_data = DB::table('inventories')
                        ->where(['status' =>  1, 'warehouse_id' => $request->warehouse, 'user_id' => $request->user, 'commodity' => $request->commodity])
                        ->first();

        if($check_data){
            $total_weight = $check_data->quantity + $request->quantity;
            //Update In Inventory
            $inventory = inventory::updateInventoryWeight($check_data->id, $total_weight);

            foreach ($case_ids as $key => $case_id) {
                //Insert Inventory id with Case ID
                $inset = inventory::addCaseIdInInventory($check_data->id, $case_id, $request->quantity);
            }
        }else{
            //Insert In Inventory
            $inventory = inventory::addInventory($data);
            
            foreach ($case_ids as $key => $case_id) {
                //Insert Inventory id with Case ID
                $inset = inventory::addCaseIdInInventory($inventory, $case_id, $request->quantity);
            }
        }

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

    // Upload inventory
    public function upload_inventory(Request $request){
        if ($request->hasFile('file'))
        {
            $path = $request->file('file')->getRealPath();
            $data = \Excel::load($path)->get();
            $msg = '';

            if ($data->count())
            {
                $temp = 1;
                foreach ($data as $key => $value) {
                    if(!empty($value->seller_mobile_no) && !empty($value->gate_pass_wr_no) && !empty($value->weight_bridge_sr_no) && !empty($value->truck_no) && !empty($value->stack_no)  && !empty($value->lot_no) && !empty($value->net_weight) && !empty($value->terminal_id) && !empty($value->commodity) && !empty($value->price) && !empty($value->quality_category) && !empty($value->commodity_type))
                    {
                        //CHeck this is number is active or not
                        $check_number = DB::table('users')->where('phone', $value->seller_mobile_no)->first();
                        if(!empty($check_number))
                        {
                            //Check Gate No is already exist or not
                            $check_gate_pass = DB::table('inventories')->where('gate_pass_wr', $value->gate_pass_wr_no)->first();
                            if(empty($check_gate_pass))
                            {
                                // Check Werehouse is exist or not
                                $check_warehouse = DB::table('warehouses')->where('warehouse_code', $value->terminal_id)->first();
                                if(!empty($check_warehouse))
                                {
                                    //Check Commodity 
                                    $check_commodity = DB::table('categories')->where(['category' => $value->commodity, 'commodity_type' => $value->commodity_type])->first();

                                    if($value->commodity_type == 'Secondary')
                                    {
                                        $sales_status = 2;
                                    }else{
                                        $sales_status = 1;
                                    }

                                    if(!empty($check_commodity))
                                    {
                                        $user_id             =  $check_number->id;
                                        $gate_pass_wr        =  $value->gate_pass_wr_no;
                                        $weight_bridge_sr_no =  $value->weight_bridge_sr_no;
                                        $truck_no            =  $value->truck_no;
                                        $stack_no            =  $value->stack_no;
                                        $net_weight          =  $value->net_weight;
                                        $terminal_id         =  $value->terminal_id;
                                        $commodity           =  $value->commodity;
                                        //$quantity            =  $value->quantity_bags;
                                        $price               =  $value->price;
                                        $quality_category    =  $value->quality_category;
                                        $date             = date('Y-m-d H:i:s');

                                        //Insert In DB
                                        $inventory = DB::table('inventories')->insert([
                                            'user_id'          => $user_id,
                                            'warehouse_id'     => $check_warehouse->id,
                                            'commodity'        => $check_commodity->id,
                                            'weight_bridge_no' => $weight_bridge_sr_no,
                                            'truck_no'         => $truck_no,
                                            'stack_no'         => $stack_no,
                                            //'net_weight'       => $net_weight,
                                            'type'             => null,
                                            'quantity'         => $net_weight,
                                            'price'            => $price,
                                            'gate_pass_wr'     => $gate_pass_wr,
                                            'quality_category' => $quality_category,
                                            'sales_status'     => $sales_status,
                                            'image'            => null,
                                            'status'           => 1,
                                            'created_at'       => $date,
                                            'updated_at'       => $date
                                        ]);

                                        if($inventory)
                                        {
                                            $msg .= 'Inventory Imported successfully.'."<br />";
                                        }
                                        else
                                        {
                                            $msg .= 'Something went wrong ! <br />';
                                        }

                                    }else{
                                        $msg .= 'Commodity Name is wrong in row no. '.$temp."<br />";
                                        break;
                                    }
                                }else{
                                    $msg .= 'Terminal ID is wrong in row no. '.$temp."<br />";
                                    break;
                                }

                            }else{
                                $msg .= 'Gate Number is already exists in row no. '.$temp."<br />";
                                break;
                            }
                        }else{
                            $msg .= 'Mobile Number is wrong in row no. '.$temp."<br />";
                            break;
                        }
                    }else{
                        $msg .= 'Please fill all required fields in row no. '.$temp."<br />";
                        break;
                    }
                    $temp++;
                }
            }

            return redirect('inventory')->with('status', $msg);
        }
    }

	// Delete inventory
	public function delete(Request $request){

		$id = $request->id;
        $date = date('Y-m-d H:i:s');

        // User update in users table
        $delete = DB::table('inventories')->where('id', $id)->update([
            'status' => 2,
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
         		       	->select('user_details.fname', 'inventories.*', 'categories.category', 'warehouses.warehouse_code', 'warehouses.name as warehouse')
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
            'user'             => 'required',
            'warehouse'        => 'required',
            'commodity'        => 'required',
            'weight_bridge_no' => 'required',
            'truck_no'         => 'required',
            'stack_no'         => 'required',
            'case_id'          => 'required',
            'quantity'         => 'required',
            'price'            => 'required',
            'gate_pass_wr'     => 'required',
            'quality_category' => 'required',
            //'image' => 'mimes:pdf| max:1000',
        ]);

        $id               = $request->inventory_id;
        $user_id          = $request->user;
        $warehouse        = $request->warehouse;
        $case_id        = $request->case_id;
        $commodity        = $request->commodity;
        $weight_bridge_no = $request->weight_bridge_no;
        $truck_no         = $request->truck_no;
        $stack_no         = $request->stack_no;
        $net_weight       = null;
        $quantity         = $request->quantity;
        $price            = $request->price;
        $quality_category = $request->quality_category;
        $gate_pass_wr     = $request->gate_pass_wr;
        $date             = date('Y-m-d H:i:s');

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
            'user_id'          => $user_id,
            'warehouse_id'     => $warehouse,
            'case_id'          => $case_id,
            'commodity'        => $commodity,
            'weight_bridge_no' => $weight_bridge_no,
            'truck_no'         => $truck_no,
            'stack_no'         => $stack_no,
            'net_weight'       => $net_weight,
            'quantity'         => $quantity,
            'quality_category' => $quality_category,
            'gate_pass_wr'     => $gate_pass_wr,
            'price'            => $price,
            'image'            => $filename,
            'updated_at'       => $date
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
