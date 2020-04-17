<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use DB;
use App\DharmKanta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;

class DharmKantaController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dharm_kanta =  DharmKanta::getDharmKanta();

        return view('dharm_kanta.index', array('dharm_kanta' => $dharm_kanta));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //Get All Post Data
        $request->validate([
            'name'   => 'required',
            'operator_name'    => 'required',
            'location'    => 'required',
            'phone'    => 'required|numeric',
            'length'      => 'required|numeric',
            'capicity'      => 'required|numeric',
        ]);

        $data['name'] = $name = $request->name;
        $data['operator_name'] = $operator_name = $request->operator_name;
        $data['phone'] = $phone = $request->phone;
        $data['length'] = $length = $request->length;
        $data['location'] = $location = ucfirst($request->location);
        $data['capicity'] = $capicity = $request->capicity;

        # Create Dharam Kanta
        $dharm_kanta = DharmKanta::createDharamKanta($data);

        if($dharm_kanta)
        {
            $status = 'Dharam Kanta Created Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        return redirect('dharam_kanta')->with('status', $status);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //Get All Post Data
        $request->validate([
            'edit_name'   => 'required',
            'edit_operator_name'    => 'required',
            'edit_location'    => 'required',
            'edit_phone'    => 'required|numeric',
            'edit_length'      => 'required|numeric',
            'edit_capicity'      => 'required|numeric',
        ]);

        $id = $request->dharam_kanta_id;
        $data['name'] = $name = $request->edit_name;
        $data['operator_name'] = $operator_name = $request->edit_operator_name;
        $data['phone'] = $phone = $request->edit_phone;
        $data['length'] = $length = $request->edit_length;
        $data['location'] = $location = ucfirst($request->edit_location);
        $data['capicity'] = $capicity = $request->edit_capicity;

        # Create Dharam Kanta
        $dharm_kanta = DharmKanta::updateDharamKanta($data, $id);

        if($dharm_kanta)
        {
            $status = 'Dharam Kanta Updated Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        return redirect('dharam_kanta')->with('status', $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        //Delete Dharam Kanta
        $delete = DharmKanta::deleteDharmKanta($id);

        if($delete)
        {
            $status = 'Dharam Kanta Deleted Successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        return redirect('dharam_kanta')->with('status', $status);
    }
}
