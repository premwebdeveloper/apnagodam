<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class DharmKanta extends Model
{
    # Get Dharam Kanta
    public function scopegetDharmKanta()
    {
    	$dharm_kanta = DB::table('dharam_kanta')->where('status', 1)->get();
        return $dharm_kanta;
    }

    # Create Dharam Kanta
    public function scopecreateDharamKanta($query, $data){
    	$date = date('Y-m-d H:i:s');
    	$create = DB::table('dharam_kanta')->insert([
    		'name' => $data['name'],
    		'operator_name' => $data['operator_name'],
    		'phone' => $data['phone'],
    		'length' => $data['length'],
    		'location' => $data['location'],
    		'capicity' => $data['capicity'],
    		'created_at' => $date,
    		'updated_at' => $date,
    		'status' => 1,
    	]);

    	return $create;
    }

    # Update Dharam Kanta
    public function scopeupdateDharamKanta($query, $data, $id){
    	$date = date('Y-m-d H:i:s');
    	$update = DB::table('dharam_kanta')
    		->where('id', $id)
    		->update([
	    		'name' => $data['name'],
	    		'operator_name' => $data['operator_name'],
	    		'phone' => $data['phone'],
	    		'length' => $data['length'],
	    		'location' => $data['location'],
	    		'capicity' => $data['capicity'],
	    		'updated_at' => $date,
	    	]);

    	return $update;
    }

    # Delete Dharam Kanta
    public function scopedeleteDharmKanta($query, $id){
    	$date = date('Y-m-d H:i:s');
    	$update = DB::table('dharam_kanta')
    		->where('id', $id)
    		->update([
	    		'status' => 0,
	    		'updated_at' => $date,
	    	]);

    	return $update;
    }
}
