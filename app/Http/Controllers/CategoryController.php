<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;

class CategoryController extends Controller
{
    // Construct function 
    public function __construct(){

        // Only authenticarte and admin user can enter here
        $this->middleware('auth');
        $this->middleware('adminOnly');
    }

    // view Category
    public function index()
    {
        $categories = DB::table('categories')->where('status', 1)->get();

        return view('category.index', array('categories' => $categories));
    }

    // create category
    public function create_category()
    {
        return view('category.create');
    }

    // add category
    public function add_category(Request $request)
    {
       
        # Set validation for
        $this->validate($request, [
            'category' => 'required',
            'gst' => 'required',
            'commossion' => 'required',
            'mandi_fees' => 'required',
            'loading' => 'required',
            'bardana' => 'required',
            'freight' => 'required',
        ]);

        $category = $request->category;
        $gst = $request->gst;
        $commossion = $request->commossion;
        $mandi_fees = $request->mandi_fees;
        $loading = $request->loading;
        $bardana = $request->bardana;
        $freight = $request->freight;

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

            $destinationPath = base_path() . '/resources/assets/upload/category/';
            $file->move($destinationPath,$filename);
            $filepath = $destinationPath.$filename;            
        }

        // Add Category
        $category = DB::table('categories')->insert([
            'category' => $category,
            'gst' => $gst,
            'commossion' => $commossion,
            'mandi_fees' => $mandi_fees,
            'loading' => $loading,
            'bardana' => $bardana,
            'freight' => $freight,
            'image' => $filename,
            'status' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($category)
        {
            $status = 'Category Added successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }

        return redirect('category')->with('status', $status);
    }

    // Category edit view
    public function view(Request $request){

        $id = $request->id;

        // Get categories details
        $categories = DB::table('categories')->where(['status' => 1, 'id' => $id])->first();

        return view('category.edit', array('category' => $categories));
    }

    // Category delete
    public function delete(Request $request){

        $id = $request->id;
        $date = date('Y-m-d H:i:s');
        
        // Get categories details
        $delete = DB::table('categories')
        ->where('id', $id)
        ->update([
            'status' => 0,
            'updated_at' => $date
        ]);

        if($delete)
        {
            $status = 'Category Deleted successfully.';
        }
        else
        {
            $status = 'Something went wrong !';
        }
        
        return redirect('category')->with('status', $status);
    }
}
