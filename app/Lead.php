<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Lead extends Model
{
    # Get all Leads
    public function scopegetLeads($query, $user_id = null)
    {
        $leads = DB::table('apna_leads')
        		->join('apna_employees', 'apna_employees.user_id', '=', 'apna_leads.user_id')
        		->join('categories', 'categories.id', '=', 'apna_leads.commodity_id')
        		->join('warehouses', 'warehouses.id', '=', 'apna_leads.terminal_id')
        		->select('apna_leads.*','categories.category as cate_name','categories.commodity_type','warehouses.name as terminal_name','warehouses.warehouse_code','apna_employees.first_name','apna_employees.last_name');
        if($user_id != null){
            $leads .= $leads->where('apna_leads.lead_gen_uid', $user_id);
        }
        $leads = $leads->where('apna_leads.status', 1)
        		->orderBy('apna_leads.created_at', 'DESC')
        		->get();        
        return $leads;
    }

    # Get single Leads
    public function scopegetLead($query, $id)
    {
        $leads = DB::table('apna_leads')
                ->where('id', $id)
                ->first();
        return $leads;
    }

    # Get all Leads
    public function scopecreateLead($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        $lead = DB::table('apna_leads')->insert([
            'user_id' => $data['user_id'],
            'customer_name' => ucfirst($data['customer_name']),
            'quantity' => $data['quantity'],
            'location' => ucfirst($data['location']),
            'phone' => $data['phone'],
            'commodity_id' => $data['commodity_id'],
            'terminal_id' => $data['terminal_id'],
            'purpose' => $data['purpose'],
            'commodity_date' => $data['commodity_date'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $lead;
    }

    # Get all Leads
    public function scopeupdateLead($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        $lead = DB::table('apna_leads')
        ->where('id', $data['id'])
        ->update([
            'user_id' => $data['user_id'],
            'customer_name' => ucfirst($data['customer_name']),
            'quantity' => $data['quantity'],
            'location' => ucfirst($data['location']),
            'phone' => $data['phone'],
            'commodity_id' => $data['commodity_id'],
            'terminal_id' => $data['terminal_id'],
            'purpose' => $data['purpose'],
            'commodity_date' => $data['commodity_date'],
            'updated_at' => $date,
        ]);
        return $lead;
    }
}
