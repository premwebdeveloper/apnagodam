<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;

class FacilitiesController extends Controller
{
    // Construct function 
    public function __construct(){

        // Only authenticarte and admin user can enter here
        $this->middleware('auth');
        $this->middleware('adminOnly');
    }

    // view facility
    public function index()
    {
        $facility = DB::table('facilities')->where('status', 1)->get();

        return view('facilities.index', array('facilities' => $facility));
    }

    // create facility
    public function create_facility()
    {
        return view('facilities.create');
    }

    // add_item
    public function add_facility(Request $request)
    {

        # Set validation for
        $this->validate($request, [
            'facility' => 'required',
        ]);

        $facility = $request->facility;

        $date = date('Y-m-d H:i:s');

        // Add Item
        $facility = DB::table('facilities')->insert([
            'facility' => $facility,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($facility)
        {
            $status = 'Facility Added successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('facility')->with('status', $status);
    }

    // view facility
    public function view(Request $request)
    {

        $id = $request->id;

        $facility = DB::table('facilities')->where(['id' => $id, 'status' => 1])->first();

        return view('facilities.edit', array('facility' => $facility));
    }

    // edit_item
    public function edit(Request $request)
    {

        # Set validation for
        $this->validate($request, [
            'facility' => 'required',
        ]);

        $id = $request->id;
        $facility = $request->facility;

        $date = date('Y-m-d H:i:s');

        // Add Item
        $facility = DB::table('facilities')->where('id', $id)->update([
            'facility' => $facility,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($facility)
        {
            $status = 'Facility Update successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('facility')->with('status', $status);
    }

    //delete item
    public function delete(Request $request)
    {
        $id = $request->id;
        $date = date('Y-m-d H:i:s');

        // User update in users table
        $delete = DB::table('facilities')->where('id', $id)->update([
            'status' => 0,
            'updated_at' => $date
        ]);

        if($delete)
        {
            $status = 'Facility Deleted successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('facility')->with('status', $status);
    } 
}
