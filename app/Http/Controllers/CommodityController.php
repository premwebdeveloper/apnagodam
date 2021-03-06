<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;


class CommodityController extends Controller
{
    // Construct function 
    public function __construct(){

        // Only authenticarte and admin user can enter here
        $this->middleware('auth');
        $this->middleware('adminOnly');
    }
    // view mandi_place_name
    public function index()
    {
        $mandies = DB::table('mandi_name')->where('status', 1)->get();

        return view('mandies.index', array('mandies' => $mandies));
    } 

    // view mandi_place_name
    public function create_mandi()
    {
         return view('mandies.create');
    }

    // mandi_place_name
    public function add_mandi(Request $request)
    {
        # Set validation for
        $this->validate($request, [
            'mandi' => 'required',
            'mandi_tax_fees' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'bank_name' => 'required',
            'bank_account_no' => 'required',
            'branch_name' => 'required',
            'branch_ifsc' => 'required',
            'account_holder' => 'required',
        ]);

        $data = array();
        $data ['mandi'] = $mandi = $request->mandi;
        $data ['mandi_tax_fees'] = $mandi_tax_fees = $request->mandi_tax_fees;
        $data ['email'] = $email = $request->email;
        $data ['phone'] = $phone = $request->phone;
        $data ['bank_account_no'] = $bank_account_no = $request->bank_account_no;
        $data ['bank_name'] = $bank_name = $request->bank_name;
        $data ['branch_name'] = $branch_name = $request->branch_name;
        $data ['branch_ifsc'] = $branch_ifsc = strtoupper($request->branch_ifsc);
        $data ['account_holder'] = $account_holder = $request->account_holder;

        //check Security
        $checked = xss_clean($data);
        $date = date('Y-m-d H:i:s');

        // Add Item
        $mandi = DB::table('mandi_name')->insert([
            'mandi_name' => $mandi,
            'mandi_tax_fees' => $mandi_tax_fees,
            'email' => $email,
            'phone' => $phone,
            'bank_account_no' => $bank_account_no,
            'bank_name' => $bank_name,
            'branch_name' => $branch_name,
            'branch_ifsc' => $branch_ifsc,
            'account_holder' => $account_holder,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($mandi)
        {
            $status = 'Mandi Details Added Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('mandi_place_name')->with('status', $status);
    }

    // view mandies nane
    public function view(Request $request)
    {

        $id = $request->id;

        $mandi = DB::table('mandi_name')->where(['id' => $id, 'status' => 1])->first();

        return view('mandies.edit', array('mandi' => $mandi));
    }

    // edit_mandi_name
    public function edit(Request $request)
    {
        # Set validation for
        $this->validate($request, [
            'mandi' => 'required',
            'mandi_tax_fees' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'bank_name' => 'required',
            'bank_account_no' => 'required',
            'branch_name' => 'required',
            'branch_ifsc' => 'required',
            'account_holder' => 'required',
        ]);

        $id = $request->id;
        $mandi = $request->mandi;
        $mandi_tax_fees = $request->mandi_tax_fees;
        $email = $request->email;
        $phone = $request->phone;
        $bank_name = $request->bank_name;
        $bank_account_no = $request->bank_account_no;
        $branch_name = $request->branch_name;
        $branch_ifsc = strtoupper($request->branch_ifsc);
        $account_holder = $request->account_holder;

        $date = date('Y-m-d H:i:s');

        // Add Item
        $mandi = DB::table('mandi_name')->where('id', $id)->update([
            'mandi_name' => $mandi,
            'mandi_tax_fees' => $mandi_tax_fees,
            'email' => $email,
            'phone' => $phone,
            'bank_name' => $bank_name,
            'bank_account_no' => $bank_account_no,
            'branch_name' => $branch_name,
            'branch_ifsc' => $branch_ifsc,
            'account_holder' => $account_holder,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($mandi)
        {
            $status = 'Mandi Details Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('mandi_place_name')->with('status', $status);
    }

    //delete mandi name
    public function delete(Request $request)
    {
        $id = $request->id;

        $date = date('Y-m-d H:i:s');

        // User update in users table
        $delete = DB::table('mandi_name')->where('id', $id)->update([
            'status' => 0,
            'updated_at' => $date
        ]);

        if($delete)
        {
            $status = 'Mandi Details Deleted Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('mandi_place_name')->with('status', $status);
    } 

    // view Commodity
    public function commodity_index()
    {
        $commodities = DB::table('commodity_name')->where('status', 1)->get();

        return view('commodities.index', array('commodities' => $commodities));
    } 

    // view Commodity
    public function create_commodity()
    {
        return view('commodities.create');
    } 
    // view Commodity
    public function add_commodity(Request $request)
    {
        # Set validation for
        $this->validate($request, [
            'commodity' => 'required',
        ]);

        $commodity = $request->commodity;

        $date = date('Y-m-d H:i:s');

        # If user category image uploaded then
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

            $destinationPath = base_path() . '/resources/assets/upload/commodity/';
            $file->move($destinationPath,$filename);
            $filepath = $destinationPath.$filename;            
        }

        // Add Commodity
        $commodity = DB::table('commodity_name')->insert([
            'commodity' => $commodity,
            'image' => $filename,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($commodity)
        {
            $status = 'Commodity Added successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('commodity_name')->with('status', $status);
    } 

    //delete commodity name
    public function commodity_delete(Request $request)
    {
        $id = $request->id;

        $date = date('Y-m-d H:i:s');

        // User update in users table
        $delete = DB::table('commodity_name')->where('id', $id)->update([
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

        return redirect('commodity_name')->with('status', $status);
    } 

    // view mandies nane
    public function commodity_view(Request $request)
    {

        $id = $request->id;

        $commodity = DB::table('commodity_name')->where(['id' => $id, 'status' => 1])->first();

        return view('commodities.edit', array('commodity' => $commodity));
    } 

    // view mandies nane
    public function commodity_edit(Request $request)
    {

        $id = $request->id;

       # Set validation for
        $this->validate($request, [
            'commodity' => 'required',
        ]);

        $commodity = $request->commodity;

        $date = date('Y-m-d H:i:s');

        $filename = '';
        # If user category image uploaded then
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

            $destinationPath = base_path() . '/resources/assets/upload/commodity/';
            $file->move($destinationPath,$filename);
            $filepath = $destinationPath.$filename;            
        }

        // Add Commodity
        $commodity = DB::table('commodity_name')->where('id', $id)->update([
            'commodity' => $commodity,
            'image' => $filename,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($commodity)
        {
            $status = 'Commodity Updated successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('commodity_name')->with('status', $status);
    }

    // Today's Price
    public function today_price(){
        $today_price = DB::table('today_prices')
                        ->join('categories', 'categories.id', '=', 'today_prices.commodity_id')
                        ->join('warehouses', 'warehouses.id', '=', 'today_prices.terminal_id')
                        ->select('today_prices.*', 'categories.category as commodity', 'warehouses.name as terminal_name')
                        ->where('today_prices.status', 1)
                        ->get();
        $corporate_price = DB::table('corporate_price')
                        ->where('status', 1)
                        ->get();
        return view('today.index', array('today_prices' => $today_price, 'corporate_price' => $corporate_price));
    }

    // Today's Price Edit View
    public function today_view(Request $request){

        $id = $request->id;
        
        $commodities = DB::table('categories')->where('status', 1)->get();

        $mandies = DB::table('mandi_name')->where('status', 1)->get();

        // Get all warehouses
        $warehouses = DB::table('warehouses')->where('status', 1)->get();

        $today_price = DB::table('today_prices')->where('id', $id)->first();

        return view('today.edit', array('today_price' => $today_price, 'warehouses' => $warehouses, 'commodities' => $commodities, 'mandies' => $mandies));
    }

    // Today's Price Edit View
    public function create_today(){

        $commodities = DB::table('categories')->where('status', 1)->get();

        $mandies = DB::table('mandi_name')->where('status', 1)->get();

        // Get all warehouses
        $warehouses = DB::table('warehouses')->where('status', 1)->get();

        return view('today.create', array('commodities' => $commodities, 'warehouses' => $warehouses, 'mandies' => $mandies));
    }

    public function add_today(Request $request){

        # Set validation for
        $this->validate($request, [
            'warehouse' => 'required',
            'commodity' => 'required',
        ]);

        $warehouse = $request->warehouse;
        $commodity = $request->commodity;
        $modal = $request->modal;
        $max = $request->max;
        $min = $request->min;

        $date = date('Y-m-d H:i:s');

        // Add Price
        $create = DB::table('today_prices')->insert([
            'terminal_id' => $warehouse,
            'commodity_id' => $commodity,
            'modal' => $modal,
            'max' => $max,
            'min' => $min,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($create)
        {
            $status = 'Add Today Price successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('today_price')->with('status', $status);       
    }

    // Today's Price Update
    public function today_edit(Request $request){
        $date = date('Y-m-d H:i:s');

        # Set validation for
        $this->validate($request, [
            'warehouse' => 'required',
            'commodity' => 'required',
            'max' => 'required',
            'modal' => 'required',
            'min' => 'required',
        ]);

        $id = $request->id;
        $warehouse = $request->warehouse;
        $commodity = $request->commodity;
        $modal = $request->modal;
        $max = $request->max;
        $min = $request->min;
        
        // Add Price
        $edit = DB::table('today_prices')->where('id', $id)->update([
            'terminal_id' => $warehouse,
            'commodity_id' => $commodity,
            'modal' => $modal,
            'max' => $max,
            'min' => $min,
            'status' => 1,
            'updated_at' => $date
        ]);

        if($edit)
        {
            $status = 'Price Updated successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('today_price')->with('status', $status);
    }

    // Today's Price Update
    public function updateCorporatePrice(Request $request){
        $date = date('Y-m-d H:i:s');

        # Set validation for
        $this->validate($request, [
            'corporate_name' => 'required',
            'ub_price' => 'required',
        ]);

        $id = $request->corporate_id;
        $corporate_name = $request->corporate_name;
        $ub_price = $request->ub_price;

        // Add Price
        $edit = DB::table('corporate_price')->where('id', $id)->update([
            'ub_name' => $corporate_name,
            'todays_price' => $ub_price,
            'updated_at' => $date
        ]);

        if($edit)
        {
            $status = 'Price Updated successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('today_price')->with('status', $status);
    }

    //delete today price name
    public function today_delete(Request $request)
    {
        $id = $request->id;
       
        $date = date('Y-m-d H:i:s');

        // User update in users table
        $delete = DB::table('today_prices')->where('id', $id)->update([
            'status' => 0,
            'updated_at' => $date
        ]);

        if($delete)
        {
            $status = 'Today Price Deleted successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('today_price')->with('status', $status);
    }

    //Get Corporate Single Details
    public function getCorporateDetails(Request $request)
    {
        $id = $request->id;
        $data = DB::table('corporate_price')->where('id', $id)->first();
        echo json_encode($data);
    }
}
