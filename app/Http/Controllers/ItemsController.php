<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;

class ItemsController extends Controller
{
    // Construct function 
    public function __construct(){

        // Only authenticarte and admin user can enter here
        $this->middleware('auth');
        $this->middleware('adminOnly');
    }

    // view items
    public function index()
    {
        $items = DB::table('items')->where('status', 1)->get();

        return view('items.index', array('items' => $items));
    }

    // create items
    public function create_item()
    {
        return view('items.create');
    }

    // add_item
    public function add_item(Request $request)
    {

        # Set validation for
        $this->validate($request, [
            'item' => 'required',
        ]);

        $item = $request->item;

        $date = date('Y-m-d H:i:s');

        // Add Item
        $item = DB::table('items')->insert([
            'item' => $item,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($item)
        {
            $status = 'Item Added successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('items')->with('status', $status);
    }

    // view items
    public function view(Request $request)
    {

        $id = $request->id;

        $item = DB::table('items')->where(['id' => $id, 'status' => 1])->first();

        return view('items.edit', array('item' => $item));
    }

    // edit_item
    public function edit(Request $request)
    {

        # Set validation for
        $this->validate($request, [
            'item' => 'required',
        ]);

        $id = $request->id;
        $item = $request->item;

        $date = date('Y-m-d H:i:s');

        // Add Item
        $item = DB::table('items')->where('id', $id)->update([
            'item' => $item,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($item)
        {
            $status = 'Item Update successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('items')->with('status', $status);
    }

    //delete item
    public function delete(Request $request)
    {
        $id = $request->id;
        $date = date('Y-m-d H:i:s');

        // User update in users table
        $delete = DB::table('items')->where('id', $id)->update([
            'status' => 0,
            'updated_at' => $date
        ]);

        if($delete)
        {
            $status = 'Item Deleted successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('items')->with('status', $status);
    } 
}
