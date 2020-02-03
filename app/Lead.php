<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Lead extends Model
{
    # Get all Leads
    public function scopegetLeads()
    {
        $leads = DB::table('apna_leads')
        		->join('apna_employees', 'apna_employees.user_id', '=', 'apna_leads.user_id')
        		->join('categories', 'categories.id', '=', 'apna_leads.commodity_id')
        		->join('warehouses', 'warehouses.id', '=', 'apna_leads.terminal_id')
        		->select('apna_leads.*','categories.category as cate_name','categories.commodity_type','warehouses.name as terminal_name','apna_employees.first_name','apna_employees.last_name')
        		->where('apna_leads.status', 1)
        		->orderBy('apna_leads.created_at', 'DESC')
        		->get();        
        return $leads;
    }

    # Get all Leads
    public function scopecreateLead($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        $lead = DB::table('apna_leads')->insert([
            'user_id' => $data['user_id'],
            'customer_name' => $data['customer_name'],
            'quantity' => $data['quantity'],
            'location' => $data['location'],
            'phone' => $data['phone'],
            'commodity_id' => $data['commodity_id'],
            'terminal_id' => $data['terminal_id'],
            'commodity_date' => $data['commodity_date'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $lead;
    }
}
