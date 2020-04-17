<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class inventory extends Model
{
	# Get all Inventories
    public function scopegetInventories()
    {
        $inventories = 	DB::table('inventories')
                        ->join('user_details', 'user_details.user_id', '=', 'inventories.user_id')
                        ->join('categories', 'categories.id', '=', 'inventories.commodity')
         		       	->join('warehouses', 'warehouses.id', '=', 'inventories.warehouse_id')
         		       	->select('user_details.fname', 'user_details.lname', 'user_details.phone', 'inventories.*', 'categories.category', 'warehouses.warehouse_code', 'warehouses.name as warehouse')
						->where('inventories.status', 1)
                        ->orwhere('inventories.status', 0)
                        ->orderBy('inventories.updated_at', 'DESC')
						->get();
        return $inventories;
    }

    # Get all Inventories
    public function scopecheckInventoryExist($query, $customer_uid, $commodity_id, $terminal_id)
    {
        $inventories =  DB::table('inventories')
                        ->where(['status' =>  1, 'warehouse_id' => $terminal_id, 'user_id' => $customer_uid, 'commodity' => $commodity_id])
                        ->first();
        return $inventories;
    }
    
    # Get all Inventory Casaes
    public function scopegetInventoryCases($query, $id)
    {
        $inventories =  DB::table('inventory_cases_id')
                        ->where(['inventory_id' => $id])
                        ->get();
        return $inventories;
    }

    # Add Inventory
    public function scopeaddInventory($query, $data)
    {
        $date = date('Y-m-d H:i:s');
        if(isset($data['status'])){
            $status = $data['status'];
        }else{
            $status = 1;
        }

        // Add Inventory
        $inventory = DB::table('inventories')->insertGetId([
            'user_id'          => $data['user_id'],
            'warehouse_id'     => $data['warehouse'],
            'commodity'        => $data['commodity'],
            'weight_bridge_no' => $data['weight_bridge_no'],
            'truck_no'         => $data['truck_no'],
            'stack_no'         => $data['stack_no'],
            'net_weight'       => $data['net_weight'],
            'type'             => null,
            'quantity'         => $data['quantity'],
            'price'            => $data['price'],
            'gate_pass_wr'     => $data['gate_pass_wr'],
            'quality_category' => $data['quality_category'],
            'sales_status'     => $data['sales_status'],
            'image'            => $data['file'],
            'status'           => $status,
            'created_at'       => $date,
            'updated_at'       => $date
        ]); 
        return $inventory;
    }

    # Add Inventory
    public function scopeaddCaseIdInInventory($query, $id, $case_id, $weight)
    {
        $date = date('Y-m-d H:i:s');

        // Add Inventory
        $inventory = DB::table('inventory_cases_id')->insert([
            'inventory_id'     => $id,
            'case_id'          => $case_id,
            'weight'          => $weight,
            'status'           => 1,
            'created_at'       => $date,
            'updated_at'       => $date
        ]); 
        return $inventory;
    }

    # Update Inventory Weight
    public function scopeupdateInventoryWeight($query,$id, $weight)
    {
        $date = date('Y-m-d H:i:s');

        // Add Inventory
        $inventory = DB::table('inventories')
            ->where('id' , $id)
            ->update([
                'quantity'         => $weight,
                'updated_at'       => $date
            ]);
        return $inventory;
    }
}
