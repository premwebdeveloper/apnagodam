<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CaseGen extends Model
{
    # Get Case
    public function scopegetCaseGen($query, $status)
    {
    	$case = DB::table('apna_case')
			->join('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
			->join('users as lead_generator', 'lead_generator.id', '=', 'apna_case.lead_gen_uid')
			->join('users as lead_conv', 'lead_conv.id', '=', 'apna_case.lead_conv_uid')
			->join('warehouses', 'warehouses.id', '=', 'apna_case.terminal_id')
			->join('categories', 'categories.id', '=', 'apna_case.commodity_id')
            ->where('apna_case.status', $status)
        	->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'lead_generator.fname as lead_gen_fname', 'lead_generator.lname as lead_gen_lname', 'lead_conv.fname as lead_conv_fname', 'lead_conv.lname as lead_conv_lname', 'categories.category as cate_name', 'categories.commodity_type', 'warehouses.name as terminal_name')
            ->orderBy('apna_case.created_at', 'DESC')
			->get();
        return $case;
    }

    //Get Case By Id
    public function scopegetSingleCaseById($query, $id)
    {
        $data = DB::table('apna_case')->where('case_id', $id)->first();
        return $data;
    }


    // Get lead User Data
    public function scopegetleadUserData($query, $phone)
    {
    	$data = DB::table('apna_leads')
    			->where('phone', $phone)
    			->first();
    	if($data)
    	{
    		return $data;
    	}else{
    		return 0;
    	}
    }

    // Create Case ID
    public function scopecreateCase($query, $data)
    {
    	$date = date('Y-m-d H:i:s');

    	//Generate Case ID

        $lead = DB::table('apna_case')->insert([
            'case_id' => $data['case_id'],
            'customer_uid' => $data['customer_uid'],
            'gate_pass' => $data['gate_pass'],
            'in_out' => $data['in_out'],
            'purpose' => $data['purpose'],
            'total_weight' => $data['quantity'],
            'location' => ucfirst($data['location']),
            'vehicle_no' => strtoupper($data['vehicle_no']),
            'commodity_id' => $data['commodity_id'],
            'terminal_id' => $data['terminal_id'],
            'lead_gen_uid' => $data['lead_generator'],
            'lead_conv_uid' => $data['conv_user_id'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $lead;
    }

    // Get Pass Cases Status
    public function scopegetCasesStatusPass()
    {
        $case = DB::table('apna_case')
            ->leftjoin('user_details as customer', 'customer.user_id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_quality_report', 'apna_case_quality_report.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_pricing', 'apna_case_pricing.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_truck_book', 'apna_truck_book.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_labour_book', 'apna_labour_book.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_kanta_parchi', 'apna_case_kanta_parchi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_second_quality_report', 'apna_case_second_quality_report.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_second_kanta_parchi', 'apna_case_second_kanta_parchi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_gate_pass', 'apna_case_gate_pass.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_e_mandi', 'apna_case_e_mandi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_accounts', 'apna_case_accounts.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_shipping_start', 'apna_case_shipping_start.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_shipping_end', 'apna_case_shipping_end.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_quality_claim', 'apna_case_quality_claim.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_truck_payment', 'apna_case_truck_payment.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_labour_payment', 'apna_case_labour_payment.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_payment_received', 'apna_case_payment_received.case_id', '=', 'apna_case.case_id')
            ->join('users as lead_generator', 'lead_generator.id', '=', 'apna_case.lead_gen_uid')
            ->join('users as lead_conv', 'lead_conv.id', '=', 'apna_case.lead_conv_uid')
            ->join('warehouses', 'warehouses.id', '=', 'apna_case.terminal_id')
            ->join('categories', 'categories.id', '=', 'apna_case.commodity_id')
            ->select('apna_case.*', 'customer.phone',
                'customer.fname as cust_fname',
                'customer.lname as cust_lname',
                'apna_case_quality_report.case_id as quality_report_case_id',
                'apna_case_pricing.case_id as pricing_case_id',
                'apna_truck_book.case_id as truck_book_case_id',
                'apna_labour_book.case_id as labour_book_case_id',
                'apna_case_kanta_parchi.case_id as kanta_parchi_case_id',
                'apna_case_second_quality_report.case_id as second_quality_report_case_id',
                'apna_case_second_kanta_parchi.case_id as second_kanta_parchi_case_id',
                'apna_case_gate_pass.case_id as gate_pass_case_id',
                'apna_case_e_mandi.case_id as e_mandi_case_id',
                'apna_case_accounts.case_id as accounts_case_id',
                'apna_case_shipping_start.case_id as shipping_start_case_id',
                'apna_case_shipping_end.case_id as shipping_end_case_id',
                'apna_case_quality_claim.case_id as quality_claim_case_id',
                'apna_case_truck_payment.case_id as truck_payment_case_id',
                'apna_case_labour_payment.case_id as labour_payment_case_id',
                'apna_case_payment_received.case_id as payment_received_case_id',
                'lead_generator.fname as lead_gen_fname',
                'lead_generator.lname as lead_gen_lname',
                'lead_conv.fname as lead_conv_fname',
                'lead_conv.lname as lead_conv_lname',
                'categories.category as cate_name',
                'categories.commodity_type',
                'warehouses.name as terminal_name')
            ->where('apna_case.in_out', 'PASS')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Get Pass Cases Status
    public function scopegetCasesStatusOut()
    {
        $case = DB::table('apna_case')
            ->leftjoin('user_details as customer', 'customer.user_id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_pricing', 'apna_case_pricing.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_release_order', 'apna_case_release_order.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_delivery_order', 'apna_case_delivery_order.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_truck_book', 'apna_truck_book.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_labour_book', 'apna_labour_book.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_quality_report', 'apna_case_quality_report.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_kanta_parchi', 'apna_case_kanta_parchi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_second_quality_report', 'apna_case_second_quality_report.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_second_kanta_parchi', 'apna_case_second_kanta_parchi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_gate_pass', 'apna_case_gate_pass.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_e_mandi', 'apna_case_e_mandi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_cctv', 'apna_case_cctv.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_commodity_withdrawal', 'apna_case_commodity_withdrawal.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_accounts', 'apna_case_accounts.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_shipping_start', 'apna_case_shipping_start.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_shipping_end', 'apna_case_shipping_end.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_quality_claim', 'apna_case_quality_claim.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_truck_payment', 'apna_case_truck_payment.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_labour_payment', 'apna_case_labour_payment.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_payment_received', 'apna_case_payment_received.case_id', '=', 'apna_case.case_id')
            ->join('users as lead_generator', 'lead_generator.id', '=', 'apna_case.lead_gen_uid')
            ->join('users as lead_conv', 'lead_conv.id', '=', 'apna_case.lead_conv_uid')
            ->join('warehouses', 'warehouses.id', '=', 'apna_case.terminal_id')
            ->join('categories', 'categories.id', '=', 'apna_case.commodity_id')
            ->select('apna_case.*', 'customer.phone',
                'customer.fname as cust_fname',
                'customer.lname as cust_lname',
                'apna_case_quality_report.case_id as quality_report_case_id',
                'apna_case_pricing.case_id as pricing_case_id',
                'apna_case_release_order.case_id as release_order_case_id',
                'apna_case_delivery_order.case_id as delivery_order_case_id',
                'apna_truck_book.case_id as truck_book_case_id',
                'apna_labour_book.case_id as labour_book_case_id',
                'apna_case_kanta_parchi.case_id as kanta_parchi_case_id',
                'apna_case_second_quality_report.case_id as second_quality_report_case_id',
                'apna_case_second_kanta_parchi.case_id as second_kanta_parchi_case_id',
                'apna_case_gate_pass.case_id as gate_pass_case_id',
                'apna_case_e_mandi.case_id as e_mandi_case_id',
                'apna_case_cctv.case_id as cctv_case_id',
                'apna_case_commodity_withdrawal.case_id as commodity_withdrawal_case_id',
                'apna_case_accounts.case_id as accounts_case_id',
                'apna_case_shipping_start.case_id as shipping_start_case_id',
                'apna_case_shipping_end.case_id as shipping_end_case_id',
                'apna_case_quality_claim.case_id as quality_claim_case_id',
                'apna_case_truck_payment.case_id as truck_payment_case_id',
                'apna_case_labour_payment.case_id as labour_payment_case_id',
                'apna_case_payment_received.case_id as payment_received_case_id',
                'lead_generator.fname as lead_gen_fname',
                'lead_generator.lname as lead_gen_lname',
                'lead_conv.fname as lead_conv_fname',
                'lead_conv.lname as lead_conv_lname',
                'categories.category as cate_name',
                'categories.commodity_type',
                'warehouses.name as terminal_name')
            ->where('apna_case.in_out', 'OUT')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Get In Cases Status
    public function scopegetCasesStatusIn()
    {
        $case = DB::table('apna_case')
            ->leftjoin('user_details as customer', 'customer.user_id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_pricing', 'apna_case_pricing.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_truck_book', 'apna_truck_book.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_labour_book', 'apna_labour_book.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_kanta_parchi', 'apna_case_kanta_parchi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_quality_report', 'apna_case_quality_report.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_second_kanta_parchi', 'apna_case_second_kanta_parchi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_second_quality_report', 'apna_case_second_quality_report.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_gate_pass', 'apna_case_gate_pass.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_e_mandi', 'apna_case_e_mandi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_quality_claim', 'apna_case_quality_claim.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_cctv', 'apna_case_cctv.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_cdf', 'apna_case_cdf.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_accounts', 'apna_case_accounts.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_truck_payment', 'apna_case_truck_payment.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_labour_payment', 'apna_case_labour_payment.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_payment_received', 'apna_case_payment_received.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_warehouse_receipt', 'apna_case_warehouse_receipt.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_storage_receipt', 'apna_case_storage_receipt.case_id', '=', 'apna_case.case_id')
            ->join('users as lead_generator', 'lead_generator.id', '=', 'apna_case.lead_gen_uid')
            ->join('users as lead_conv', 'lead_conv.id', '=', 'apna_case.lead_conv_uid')
            ->join('warehouses', 'warehouses.id', '=', 'apna_case.terminal_id')
            ->join('categories', 'categories.id', '=', 'apna_case.commodity_id')
            ->select('apna_case.*', 'customer.phone',
                'customer.fname as cust_fname',
                'customer.lname as cust_lname',
                'apna_case_pricing.case_id as pricing_case_id',
                'apna_truck_book.case_id as truck_book_case_id',
                'apna_labour_book.case_id as labour_book_case_id',
                'apna_case_kanta_parchi.case_id as kanta_parchi_case_id',
                'apna_case_quality_report.case_id as quality_report_case_id',
                'apna_case_second_kanta_parchi.case_id as second_kanta_parchi_case_id',
                'apna_case_second_quality_report.case_id as second_quality_report_case_id',
                'apna_case_gate_pass.case_id as gate_pass_case_id',
                'apna_case_e_mandi.case_id as e_mandi_case_id',
                'apna_case_quality_claim.case_id as quality_claim_case_id',
                'apna_case_cctv.case_id as cctv_case_id',
                'apna_case_cdf.case_id as cdf_case_id',
                'apna_case_accounts.case_id as accounts_case_id',
                'apna_case_truck_payment.case_id as truck_payment_case_id',
                'apna_case_labour_payment.case_id as labour_payment_case_id',
                'apna_case_payment_received.case_id as payment_received_case_id',
                'apna_case_warehouse_receipt.case_id as warehouse_receipt_case_id',
                'apna_case_storage_receipt.case_id as storage_receipt_case_id',
                'lead_generator.fname as lead_gen_fname',
                'lead_generator.lname as lead_gen_lname',
                'lead_conv.fname as lead_conv_fname',
                'lead_conv.lname as lead_conv_lname',
                'categories.category as cate_name',
                'categories.commodity_type',
                'warehouses.name as terminal_name')
            ->where('apna_case.in_out', 'IN')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Get Approval Cases for Pass Cases
    public function scopegetApprovalCasesPass()
    {
        $case = DB::table('apna_case')
            ->leftjoin('user_details as customer', 'customer.user_id', '=', 'apna_case.customer_uid')
            ->join('apna_case_payment_received', 'apna_case_payment_received.case_id', '=', 'apna_case.case_id')
            ->join('users as lead_generator', 'lead_generator.id', '=', 'apna_case.lead_gen_uid')
            ->join('users as lead_conv', 'lead_conv.id', '=', 'apna_case.lead_conv_uid')
            ->join('warehouses', 'warehouses.id', '=', 'apna_case.terminal_id')
            ->join('categories', 'categories.id', '=', 'apna_case.commodity_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_payment_received.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_payment_received.file', 'apna_case_payment_received.notes', 'apna_case_payment_received.payment_done', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname', 'lead_generator.fname as lead_gen_fname', 'lead_generator.lname as lead_gen_lname', 'lead_conv.fname as lead_conv_fname', 'lead_conv.lname as lead_conv_lname', 'categories.category as cate_name', 'categories.commodity_type', 'warehouses.name as terminal_name')
            ->where('apna_case.in_out', 'PASS')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case_payment_received.case_id')
            ->get();
        return $case;
    }

    // Get Approval Cases for In Cases
    public function scopegetApprovalCasesIn()
    {
        $case = DB::table('apna_case')
            ->leftjoin('user_details as customer', 'customer.user_id', '=', 'apna_case.customer_uid')
            ->join('apna_case_warehouse_receipt', 'apna_case_warehouse_receipt.case_id', '=', 'apna_case.case_id')
            ->join('users as lead_generator', 'lead_generator.id', '=', 'apna_case.lead_gen_uid')
            ->join('users as lead_conv', 'lead_conv.id', '=', 'apna_case.lead_conv_uid')
            ->join('warehouses', 'warehouses.id', '=', 'apna_case.terminal_id')
            ->join('categories', 'categories.id', '=', 'apna_case.commodity_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_warehouse_receipt.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_warehouse_receipt.file', 'apna_case_warehouse_receipt.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname', 'lead_generator.fname as lead_gen_fname', 'lead_generator.lname as lead_gen_lname', 'lead_conv.fname as lead_conv_fname', 'lead_conv.lname as lead_conv_lname', 'categories.category as cate_name', 'categories.commodity_type', 'warehouses.name as terminal_name')
            ->where('apna_case.in_out', 'IN')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case_warehouse_receipt.case_id')
            ->get();
        return $case;
    }

    // Get Approval Cases for Out Cases
    public function scopegetApprovalCasesOut()
    {
        $case = DB::table('apna_case')
            ->leftjoin('user_details as customer', 'customer.user_id', '=', 'apna_case.customer_uid')
            ->join('apna_case_payment_received', 'apna_case_payment_received.case_id', '=', 'apna_case.case_id')
            ->join('users as lead_generator', 'lead_generator.id', '=', 'apna_case.lead_gen_uid')
            ->join('users as lead_conv', 'lead_conv.id', '=', 'apna_case.lead_conv_uid')
            ->join('warehouses', 'warehouses.id', '=', 'apna_case.terminal_id')
            ->join('categories', 'categories.id', '=', 'apna_case.commodity_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_payment_received.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_payment_received.file', 'apna_case_payment_received.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname', 'lead_generator.fname as lead_gen_fname', 'lead_generator.lname as lead_gen_lname', 'lead_conv.fname as lead_conv_fname', 'lead_conv.lname as lead_conv_lname', 'categories.category as cate_name', 'categories.commodity_type', 'warehouses.name as terminal_name')
            ->where('apna_case.in_out', 'OUT')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case_payment_received.case_id')
            ->get();
        return $case;
    }

    public function scopegetCasePrice()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_pricing', 'apna_case_pricing.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_pricing.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_pricing.processing_fees', 'apna_case_pricing.interest_rate', 'apna_case_pricing.price', 'apna_case_pricing.rent', 'apna_case_pricing.labour_rate', 'apna_case_pricing.notes', 'apna_case_pricing.transaction_type', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    public function scopecloseCase($query, $case_id)
    {
        $update = DB::table('apna_case')->where('case_id', $case_id)->update(['status' => 0]);
        return true;
    }

    // Set Case Price
    public function scopesetPrice($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Generate Case ID

        $price = DB::table('apna_case_pricing')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'price' => $data['price'],
            'processing_fees' => $data['processing_fees'],
            'rent' => $data['rent'],
            'transaction_type' => $data['transaction_type'],
            'interest_rate' => $data['interest_rate'],
            'labour_rate' => $data['labour_rate'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    // Set First Quality Report
    public function scopeupdateQualityReport($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_case_quality_report')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'moisture_level' => $data['moisture_level'],
            'thousand_crown_w' => $data['thousand_crown_w'],
            'broken' => $data['broken'],
            'foreign_matter' => $data['foreign_matter'],
            'thin' => $data['thin'],
            'damage' => $data['damage'],
            'black_smith' => $data['black_smith'],
            'infested' => $data['infested'],
            'live_insects' => $data['live_insects'],
            'imge' => $data['imge'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    public function scopegetCaseQualityReport()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_quality_report', 'apna_case_quality_report.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_quality_report.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_quality_report.moisture_level', 'apna_case_quality_report.thousand_crown_w', 'apna_case_quality_report.broken', 'apna_case_quality_report.foreign_matter', 'apna_case_quality_report.thin', 'apna_case_quality_report.damage', 'apna_case_quality_report.black_smith', 'apna_case_quality_report.infested',  'apna_case_quality_report.live_insects', 'apna_case_quality_report.imge',  'apna_case_quality_report.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    public function scopegetCaseGatePass()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_gate_pass', 'apna_case_gate_pass.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_gate_pass.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_gate_pass.gate_pass_no', 'apna_case_gate_pass.bags', 'apna_case_gate_pass.stack_no', 'apna_case_gate_pass.lot_no', 'apna_case_gate_pass.file', 'apna_case_gate_pass.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update Gate Pass
    public function scopeupdateGatePass($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_case_gate_pass')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            /*'gate_pass_no' => $data['gate_pass_no'],
            'bags' => $data['bags'],
            'stack_no' => $data['stack_no'],
            'lot_no' => $data['lot_no'],  */          
            'file' => $data['file'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    public function scopegetCaseTruckBook()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_truck_book', 'apna_truck_book.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_truck_book.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_truck_book.transporter', 'apna_truck_book.vehicle', 'apna_truck_book.driver_name', 'apna_truck_book.driver_phone', 'apna_truck_book.rate_per_km', 'apna_truck_book.min_weight', 'apna_truck_book.max_weight', 'apna_truck_book.turnaround_time', 'apna_truck_book.commodity_id', 'apna_truck_book.total_weight', 'apna_truck_book.no_of_bags', 'apna_truck_book.kanta_parchi_no', 'apna_truck_book.gate_pass_no', 'apna_truck_book.total_transport_cost', 'apna_truck_book.advance_payment', 'apna_truck_book.start_date_time', 'apna_truck_book.final_settlement_amount', 'apna_truck_book.end_date_time', 'apna_truck_book.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update Truck Book
    public function scopeupdateTruckBook($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $truck_book = DB::table('apna_truck_book')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'transporter' => $data['transporter'],
            'vehicle' => $data['vehicle'],
            'driver_name' => $data['driver_name'],
            'driver_phone' => $data['driver_phone'],            
            'rate_per_km' => $data['rate_per_km'],            
            'min_weight' => $data['min_weight'],            
            'max_weight' => $data['max_weight'],            
            'turnaround_time' => $data['turnaround_time'],            
            'total_weight' => $data['total_weight'],            
            'no_of_bags' => $data['no_of_bags'],            
            'kanta_parchi_no' => $data['kanta_parchi_no'],            
            'total_transport_cost' => $data['total_transport_cost'],            
            'advance_payment' => $data['advance_payment'],            
            'start_date_time' => $data['start_date_time'],            
            'final_settlement_amount' => $data['final_settlement_amount'],            
            'end_date_time' => $data['end_date_time'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $truck_book;
    }

    // First Kanta Parchi
    public function scopegetCaseKantaParchi()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_kanta_parchi', 'apna_case_kanta_parchi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_kanta_parchi.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_kanta_parchi.rst_no', 'apna_case_kanta_parchi.bags', 'apna_case_kanta_parchi.gross_weight', 'apna_case_kanta_parchi.tare_weight', 'apna_case_kanta_parchi.net_weight', 'apna_case_kanta_parchi.gross_date_time', 'apna_case_kanta_parchi.tare_date_time', 'apna_case_kanta_parchi.charges', 'apna_case_kanta_parchi.vehicle_no', 'apna_case_kanta_parchi.kanta_name', 'apna_case_kanta_parchi.kanta_place', 'apna_case_kanta_parchi.file', 'apna_case_kanta_parchi.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update Second Kanta Parchi
    public function scopeupdateKantaParchi($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_case_kanta_parchi')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
/*            'rst_no' => $data['rst_no'],
            'bags' => $data['bags'],
            'gross_weight' => $data['gross_weight'],
            'tare_weight' => $data['tare_weight'],
            'net_weight' => $data['net_weight'],
            'gross_date_time' => $data['gross_date_time'],
            'tare_date_time' => $data['tare_date_time'],
            'charges' => $data['charges'],
            'kanta_name' => $data['kanta_name'],
            'kanta_place' => $data['kanta_place'],*/
            'file' => $data['file'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    //Get Labour Book
    public function scopegetCaseLabourBook()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_labour_book', 'apna_labour_book.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_labour_book.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_labour_book.labour_contractor', 'apna_labour_book.contractor_no', 'apna_labour_book.labour_rate_per_bags', 'apna_labour_book.total_labour', 'apna_labour_book.location', 'apna_labour_book.booking_date', 'apna_labour_book.total_bags', 'apna_labour_book.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

        // Update Labour Book
    public function scopeupdateLabourBook($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_labour_book')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'labour_contractor' => $data['labour_contractor'],
            'contractor_no' => $data['contractor_no'],
            'labour_rate_per_bags' => $data['labour_rate_per_bags'],
            'total_labour' => $data['total_labour'],
            'location' => $data['location'],
            'booking_date' => $data['booking_date'],
            'total_bags' => $data['total_bags'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    //Get Second Quality Report
    public function scopegetCaseSecondQualityReport()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_second_quality_report', 'apna_case_second_quality_report.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_second_quality_report.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_second_quality_report.moisture_level', 'apna_case_second_quality_report.thousand_crown_w', 'apna_case_second_quality_report.broken', 'apna_case_second_quality_report.foreign_matter', 'apna_case_second_quality_report.thin', 'apna_case_second_quality_report.damage', 'apna_case_second_quality_report.black_smith', 'apna_case_second_quality_report.infested',  'apna_case_second_quality_report.live_insects', 'apna_case_second_quality_report.imge',  'apna_case_second_quality_report.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Get Second Quality Report
    public function scopeupdateSecondQualityReport($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_case_second_quality_report')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'moisture_level' => $data['moisture_level'],
            'thousand_crown_w' => $data['thousand_crown_w'],
            'broken' => $data['broken'],
            'foreign_matter' => $data['foreign_matter'],
            'thin' => $data['thin'],
            'damage' => $data['damage'],
            'black_smith' => $data['black_smith'],
            'infested' => $data['infested'],
            'live_insects' => $data['live_insects'],
            'imge' => $data['imge'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    // First Kanta Parchi
    public function scopegetCaseSecondKantaParchi()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_second_kanta_parchi', 'apna_case_second_kanta_parchi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_second_kanta_parchi.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_second_kanta_parchi.rst_no', 'apna_case_second_kanta_parchi.bags', 'apna_case_second_kanta_parchi.gross_weight', 'apna_case_second_kanta_parchi.tare_weight', 'apna_case_second_kanta_parchi.net_weight', 'apna_case_second_kanta_parchi.gross_date_time', 'apna_case_second_kanta_parchi.tare_date_time', 'apna_case_second_kanta_parchi.charges', 'apna_case_second_kanta_parchi.vehicle_no', 'apna_case_second_kanta_parchi.kanta_name', 'apna_case_second_kanta_parchi.kanta_place', 'apna_case_second_kanta_parchi.file', 'apna_case_second_kanta_parchi.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update Second Kanta Parchi
    public function scopeupdateSecondKantaParchi($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_case_second_kanta_parchi')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
/*            'rst_no' => $data['rst_no'],
            'bags' => $data['bags'],
            'gross_weight' => $data['gross_weight'],
            'tare_weight' => $data['tare_weight'],
            'net_weight' => $data['net_weight'],
            'gross_date_time' => $data['gross_date_time'],
            'tare_date_time' => $data['tare_date_time'],
            'charges' => $data['charges'],
            'kanta_name' => $data['kanta_name'],
            'kanta_place' => $data['kanta_place'],*/
            'file' => $data['file'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    // E Mandi
    public function scopegetCaseEMandi()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_e_mandi', 'apna_case_e_mandi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_e_mandi.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_e_mandi.file', 'apna_case_e_mandi.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update E-Mandi Data
    public function scopeupdateEMandi($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $res = DB::table('apna_case_e_mandi')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'file' => $data['file'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $res;
    }

    // Accounts
    public function scopegetCaseAccounts()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_accounts', 'apna_case_accounts.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_accounts.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_accounts.vikray_parchi', 'apna_case_accounts.inventory','apna_case_accounts.tally_updation', 'apna_case_accounts.cold_win_entry', 'apna_case_accounts.whs_issulation', 'apna_case_accounts.loan', 'apna_case_accounts.sale', 'apna_case_accounts.purchase', 'apna_case_accounts.mandi_tax', 'apna_case_accounts.invoice', 'apna_case_accounts.notes', 'user_price.fname as user_fname', 'user_price.lname as user_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update Accounts Data
    public function scopeupdateAccounts($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $res = DB::table('apna_case_accounts')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'vikray_parchi' => $data['vikray_parchi'],
            'inventory' => $data['inventory'],
            'tally_updation' => $data['tally_updation'],
            'cold_win_entry' => $data['cold_win_entry'],
            /*'whs_issulation' => $data['whs_issulation'],*/
            'loan' => $data['loan'],
            'sale' => $data['sale'],
            'mandi_tax' => $data['mandi_tax'],
            'purchase' => $data['purchase'],
            'invoice' => $data['invoice'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $res;
    }

    // Shipping Start
    public function scopegetCaseShippingStart()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_shipping_start', 'apna_case_shipping_start.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_shipping_start.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_shipping_start.location', 'apna_case_shipping_start.date_time', 'apna_case_shipping_start.notes', 'user_price.fname as user_fname', 'user_price.lname as user_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update Shipping Start Data
    public function scopeupdateShippingStart($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $res = DB::table('apna_case_shipping_start')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'location' => $data['location'],
            'date_time' => $data['date_time'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $res;
    }

    // Shipping End
    public function scopegetCaseShippingEnd()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_shipping_end', 'apna_case_shipping_end.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_shipping_end.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_shipping_end.location', 'apna_case_shipping_end.date_time', 'apna_case_shipping_end.notes', 'user_price.fname as user_fname', 'user_price.lname as user_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update Shipping End Data
    public function scopeupdateShippingEnd($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $res = DB::table('apna_case_shipping_end')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'location' => $data['location'],
            'date_time' => $data['date_time'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $res;
    }

    // Set Quality Claim
    public function scopeupdateQualityClaim($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_case_quality_claim')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'moisture_level' => $data['moisture_level'],
            'thousand_crown_w' => $data['thousand_crown_w'],
            'broken' => $data['broken'],
            'foreign_matter' => $data['foreign_matter'],
            'thin' => $data['thin'],
            'damage' => $data['damage'],
            'black_smith' => $data['black_smith'],
            'infested' => $data['infested'],
            'live_insects' => $data['live_insects'],
            'quality_discount_value' => $data['quality_discount_value'],
            'imge' => $data['imge'],
            'second_report' => $data['second_report'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    // Get Quality Claim
    public function scopegetCaseQualityClaim()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_quality_claim', 'apna_case_quality_claim.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_quality_claim.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_quality_claim.moisture_level', 'apna_case_quality_claim.thousand_crown_w', 'apna_case_quality_claim.broken', 'apna_case_quality_claim.foreign_matter', 'apna_case_quality_claim.thin', 'apna_case_quality_claim.damage', 'apna_case_quality_claim.black_smith', 'apna_case_quality_claim.infested', 'apna_case_quality_claim.live_insects', 'apna_case_quality_claim.quality_discount_value', 'apna_case_quality_claim.imge', 'apna_case_quality_claim.second_report',  'apna_case_quality_claim.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Truck Payment
    public function scopegetCaseTruckPayment()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_truck_payment', 'apna_case_truck_payment.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_truck_payment.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_truck_payment.file', 'apna_case_truck_payment.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update Truck Payment
    public function scopeupdateTruckPayment($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_case_truck_payment')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'file' => $data['file'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    // Labour Payment
    public function scopegetCaseLabourPayment()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_labour_payment', 'apna_case_labour_payment.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_labour_payment.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_labour_payment.file', 'apna_case_labour_payment.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update Labour Payment
    public function scopeupdateLabourPayment($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_case_labour_payment')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'file' => $data['file'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    // Payment Received
    public function scopegetCasePaymentReceived()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_payment_received', 'apna_case_payment_received.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_payment_received.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_payment_received.file', 'apna_case_payment_received.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update Payment Received
    public function scopeupdatePaymentReceived($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_case_payment_received')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'file' => $data['file'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    // CCTV
    public function scopegetCaseCCTV()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_cctv', 'apna_case_cctv.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_pricing', 'apna_case_pricing.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_cctv.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_cctv.file', 'apna_case_pricing.transaction_type', 'apna_case_cctv.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update CCTV
    public function scopeupdateCCTV($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_case_cctv')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'file' => $data['file'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    // Commodity Deposit
    public function scopegetCommodityDeposit()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_cdf', 'apna_case_cdf.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_cdf.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_cdf.file', 'apna_case_cdf.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update Commodity Deposit
    public function scopeupdateCommodityDeposit($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_case_cdf')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'file' => $data['file'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    // Warehouse Receipt
    public function scopegetWarehouseReceipt()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_warehouse_receipt', 'apna_case_warehouse_receipt.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_warehouse_receipt.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_warehouse_receipt.file', 'apna_case_warehouse_receipt.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update Warehouse Receipt
    public function scopeupdateWarehouseReceipt($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_case_warehouse_receipt')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'file' => $data['file'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    // Warehouse Receipt
    public function scopegetStorageReceipt()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_storage_receipt', 'apna_case_storage_receipt.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_storage_receipt.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_storage_receipt.file', 'apna_case_storage_receipt.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update Warehouse Receipt
    public function scopeupdateStorageReceipt($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_case_storage_receipt')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'file' => $data['file'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    // Release Order
    public function scopegetReleaseOrder()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_release_order', 'apna_case_release_order.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_release_order.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_release_order.file', 'apna_case_release_order.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update Release Order
    public function scopeupdateReleaseOrder($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_case_release_order')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'file' => $data['file'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    // Delivery Order
    public function scopegetDeliveryOrder()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_delivery_order', 'apna_case_delivery_order.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_delivery_order.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_delivery_order.file', 'apna_case_delivery_order.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update Delivery Order
    public function scopeupdateDeliveryOrder($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_case_delivery_order')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'file' => $data['file'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    // Commodity Withdrawal
    public function scopegetCommodityWithdrawal()
    {
        $case = DB::table('apna_case')
            ->leftjoin('users as customer', 'customer.id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_commodity_withdrawal', 'apna_case_commodity_withdrawal.case_id', '=', 'apna_case.case_id')
            ->leftjoin('users as user_price', 'user_price.id', '=', 'apna_case_commodity_withdrawal.user_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_commodity_withdrawal.file', 'apna_case_commodity_withdrawal.notes', 'user_price.fname as user_price_fname', 'user_price.lname as user_price_lname')
            ->where('apna_case.status', 1)
            ->orderBy('apna_case.updated_at', 'DESC')
            ->groupBy('apna_case.case_id')
            ->get();
        return $case;
    }

    // Update Commodity Withdrawal
    public function scopeupdateCommodityWithdrawal($query, $data)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_case_commodity_withdrawal')->insert([
            'user_id' => $data['user_id'],
            'case_id' => $data['case_id'],
            'file' => $data['file'],
            'notes' => $data['notes'],
            'created_at' => $date,
            'updated_at' => $date,
            'status' => 1
        ]);
        return $price;
    }

    // Update Labour Payment
    public function scopecompleteCase($query, $case_id, $notes)
    {
        $date = date('Y-m-d H:i:s');

        //Inset Data
        $price = DB::table('apna_case')->where('case_id', $case_id)->update([
            'approved_remark' => $notes,
            'updated_at' => $date,
            'status' => 2
        ]);
        return $price;
    }

    // Get Approval Cases for Pass Cases
    public function scopegetPassCaseDetails($query, $case_id)
    {
        $case = DB::table('apna_case')
            ->leftjoin('user_details as customer', 'customer.user_id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_quality_report', 'apna_case_quality_report.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_pricing', 'apna_case_pricing.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_truck_book', 'apna_truck_book.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_labour_book', 'apna_labour_book.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_kanta_parchi', 'apna_case_kanta_parchi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_second_quality_report', 'apna_case_second_quality_report.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_second_kanta_parchi', 'apna_case_second_kanta_parchi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_gate_pass', 'apna_case_gate_pass.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_e_mandi', 'apna_case_e_mandi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_accounts', 'apna_case_accounts.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_shipping_start', 'apna_case_shipping_start.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_shipping_end', 'apna_case_shipping_end.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_quality_claim', 'apna_case_quality_claim.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_truck_payment', 'apna_case_truck_payment.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_labour_payment', 'apna_case_labour_payment.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_payment_received', 'apna_case_payment_received.case_id', '=', 'apna_case.case_id')
            ->join('users as lead_generator', 'lead_generator.id', '=', 'apna_case.lead_gen_uid')
            ->join('users as lead_conv', 'lead_conv.id', '=', 'apna_case.lead_conv_uid')
            ->join('warehouses', 'warehouses.id', '=', 'apna_case.terminal_id')
            ->join('categories', 'categories.id', '=', 'apna_case.commodity_id')
            ->select('apna_case.*', 'customer.phone', 'customer.fname as cust_fname', 'customer.lname as cust_lname', 'apna_case_quality_report.moisture_level as q_r_moisture_level', 'apna_case_quality_report.thousand_crown_w as q_r_thousand_crown_w', 'apna_case_quality_report.broken as q_r_broken', 'apna_case_quality_report.foreign_matter as q_r_foreign_matter', 'apna_case_quality_report.thin as q_r_thin', 'apna_case_quality_report.damage as q_r_damage', 'apna_case_quality_report.black_smith as q_r_black_smith', 'apna_case_quality_report.infested as q_r_infested', 'apna_case_quality_report.live_insects as q_r_live_insects', 'apna_case_quality_report.imge as q_r_imge', 'apna_case_quality_report.notes as q_r_notes','apna_case_pricing.processing_fees as p_processing_fees', 'apna_case_pricing.interest_rate as p_interest_rate', 'apna_case_pricing.price as p_price', 'apna_case_pricing.rent as p_rent', 'apna_case_pricing.labour_rate as p_labour_rate', 'apna_case_pricing.transaction_type as p_transaction_type', 'apna_case_pricing.notes as p_notes', 'apna_truck_book.transporter as t_b_transporter', 'apna_truck_book.vehicle as t_b_vehicle', 'apna_truck_book.driver_name as t_b_driver_name', 'apna_truck_book.driver_phone as t_b_driver_phone', 'apna_truck_book.rate_per_km as t_b_rate_per_km', 'apna_truck_book.min_weight as t_b_min_weight', 'apna_truck_book.max_weight as t_b_max_weight', 'apna_truck_book.turnaround_time as t_b_turnaround_time', 'apna_truck_book.total_weight as t_b_total_weight', 'apna_truck_book.no_of_bags as t_b_no_of_bags', 'apna_truck_book.kanta_parchi_no as t_b_kanta_parchi_no', 'apna_truck_book.gate_pass_no as t_b_gate_pass_no', 'apna_truck_book.total_transport_cost as t_b_total_transport_cost', 'apna_truck_book.advance_payment as t_b_advance_payment', 'apna_truck_book.start_date_time as t_b_start_date_time', 'apna_truck_book.final_settlement_amount as t_b_final_settlement_amount', 'apna_truck_book.notes as t_b_notes', 'apna_truck_book.end_date_time as t_b_end_date_time', 'apna_truck_book.file as t_b_file','apna_labour_book.labour_contractor as l_b_labour_contractor', 'apna_labour_book.contractor_no as l_b_contractor_no', 'apna_labour_book.labour_rate_per_bags as l_b_labour_rate_per_bags', 'apna_labour_book.total_labour as l_b_total_labour', 'apna_labour_book.location as l_b_location', 'apna_labour_book.booking_date as l_b_booking_date', 'apna_labour_book.total_bags as l_b_total_bags', 'apna_labour_book.notes as l_b_notes', 'apna_case_kanta_parchi.notes as k_p_notes', 'apna_case_kanta_parchi.file as k_p_file', 'apna_case_second_quality_report.moisture_level as s_q_r_moisture_level', 'apna_case_second_quality_report.thousand_crown_w as s_q_r_thousand_crown_w', 'apna_case_second_quality_report.broken as s_q_r_broken', 'apna_case_second_quality_report.foreign_matter as s_q_r_foreign_matter', 'apna_case_second_quality_report.thin as s_q_r_thin', 'apna_case_second_quality_report.damage as s_q_r_damage', 'apna_case_second_quality_report.black_smith as s_q_r_black_smith', 'apna_case_second_quality_report.infested as s_q_r_infested', 'apna_case_second_quality_report.live_insects as s_q_r_live_insects', 'apna_case_second_quality_report.imge as s_q_r_imge', 'apna_case_second_quality_report.notes as s_q_r_notes', 'apna_case_second_kanta_parchi.notes as s_k_p_notes', 'apna_case_second_kanta_parchi.file as s_k_p_file', 'apna_case_gate_pass.notes as g_p_notes', 'apna_case_gate_pass.file as g_p_file', 'apna_case_e_mandi.notes as e_m_notes', 'apna_case_e_mandi.file as e_m_file', 'apna_case_accounts.vikray_parchi as a_vikray_parchi', 'apna_case_accounts.tally_updation as a_tally_updation', 'apna_case_accounts.cold_win_entry as a_cold_win_entry', 'apna_case_accounts.inventory as a_inventory', 'apna_case_accounts.loan as a_loan', 'apna_case_accounts.sale as a_sale', 'apna_case_accounts.mandi_tax as a_mandi_tax', 'apna_case_accounts.purchase as a_purchase', 'apna_case_accounts.invoice as a_invoice', 'apna_case_accounts.notes as a_notes', 'apna_case_shipping_start.location as s_s_location', 'apna_case_shipping_start.date_time as s_s_date_time', 'apna_case_shipping_start.notes as s_s_notes', 'apna_case_shipping_end.location as s_e_location', 'apna_case_shipping_end.date_time as s_e_date_time', 'apna_case_shipping_end.notes as s_e_notes', 'apna_case_quality_claim.moisture_level as q_c_moisture_level', 'apna_case_quality_claim.thousand_crown_w as q_c_thousand_crown_w', 'apna_case_quality_claim.broken as q_c_broken', 'apna_case_quality_claim.foreign_matter as q_c_foreign_matter', 'apna_case_quality_claim.thin as q_c_thin', 'apna_case_quality_claim.damage as q_c_damage', 'apna_case_quality_claim.black_smith as q_c_black_smith', 'apna_case_quality_claim.infested as q_c_infested', 'apna_case_quality_claim.live_insects as q_c_live_insects', 'apna_case_quality_claim.imge as q_c_imge', 'apna_case_quality_claim.notes as q_c_notes', 'apna_case_quality_claim.quality_discount_value as q_c_quality_discount_value', 'apna_case_quality_claim.second_report as q_c_second_report', 'apna_case_truck_payment.notes as t_p_notes', 'apna_case_truck_payment.file as t_p_file', 'apna_case_labour_payment.notes as l_p_notes', 'apna_case_labour_payment.file as l_p_file', 'apna_case_payment_received.notes as p_r_notes', 'apna_case_payment_received.file as p_r_file', 'lead_generator.fname as lead_gen_fname', 'lead_generator.lname as lead_gen_lname', 'lead_conv.fname as lead_conv_fname', 'lead_conv.lname as lead_conv_lname', 'categories.category as cate_name', 'categories.commodity_type', 'warehouses.name as terminal_name')
            ->where('apna_case.case_id', $case_id)
            ->groupBy('apna_case.case_id')
            ->first();
        return $case;
    }

    // Get Approval Cases for In Cases
    public function scopegetInCaseDetails($query, $case_id)
    {
        $case = DB::table('apna_case')
            ->leftjoin('user_details as customer', 'customer.user_id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_quality_report', 'apna_case_quality_report.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_pricing', 'apna_case_pricing.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_truck_book', 'apna_truck_book.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_labour_book', 'apna_labour_book.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_kanta_parchi', 'apna_case_kanta_parchi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_second_quality_report', 'apna_case_second_quality_report.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_second_kanta_parchi', 'apna_case_second_kanta_parchi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_gate_pass', 'apna_case_gate_pass.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_e_mandi', 'apna_case_e_mandi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_accounts', 'apna_case_accounts.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_cctv', 'apna_case_cctv.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_cdf', 'apna_case_cdf.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_quality_claim', 'apna_case_quality_claim.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_warehouse_receipt', 'apna_case_warehouse_receipt.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_truck_payment', 'apna_case_truck_payment.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_labour_payment', 'apna_case_labour_payment.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_storage_receipt', 'apna_case_storage_receipt.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_payment_received', 'apna_case_payment_received.case_id', '=', 'apna_case.case_id')
            ->join('users as lead_generator', 'lead_generator.id', '=', 'apna_case.lead_gen_uid')
            ->join('users as lead_conv', 'lead_conv.id', '=', 'apna_case.lead_conv_uid')
            ->join('warehouses', 'warehouses.id', '=', 'apna_case.terminal_id')
            ->join('categories', 'categories.id', '=', 'apna_case.commodity_id')
            ->select('apna_case.*', 'customer.phone',
                'customer.fname as cust_fname',
                'customer.lname as cust_lname',
                'apna_case_quality_report.moisture_level as q_r_moisture_level', 'apna_case_quality_report.thousand_crown_w as q_r_thousand_crown_w', 'apna_case_quality_report.broken as q_r_broken', 'apna_case_quality_report.foreign_matter as q_r_foreign_matter', 'apna_case_quality_report.thin as q_r_thin', 'apna_case_quality_report.damage as q_r_damage', 'apna_case_quality_report.black_smith as q_r_black_smith', 'apna_case_quality_report.infested as q_r_infested', 'apna_case_quality_report.live_insects as q_r_live_insects', 'apna_case_quality_report.imge as q_r_imge', 'apna_case_quality_report.notes as q_r_notes',

                'apna_case_pricing.processing_fees as p_processing_fees', 'apna_case_pricing.interest_rate as p_interest_rate', 'apna_case_pricing.price as p_price', 'apna_case_pricing.rent as p_rent', 'apna_case_pricing.labour_rate as p_labour_rate', 'apna_case_pricing.transaction_type as p_transaction_type', 'apna_case_pricing.notes as p_notes',

                'apna_truck_book.transporter as t_b_transporter', 'apna_truck_book.vehicle as t_b_vehicle', 'apna_truck_book.driver_name as t_b_driver_name', 'apna_truck_book.driver_phone as t_b_driver_phone', 'apna_truck_book.rate_per_km as t_b_rate_per_km', 'apna_truck_book.min_weight as t_b_min_weight', 'apna_truck_book.max_weight as t_b_max_weight', 'apna_truck_book.turnaround_time as t_b_turnaround_time', 'apna_truck_book.total_weight as t_b_total_weight', 'apna_truck_book.no_of_bags as t_b_no_of_bags', 'apna_truck_book.kanta_parchi_no as t_b_kanta_parchi_no', 'apna_truck_book.gate_pass_no as t_b_gate_pass_no', 'apna_truck_book.total_transport_cost as t_b_total_transport_cost', 'apna_truck_book.advance_payment as t_b_advance_payment', 'apna_truck_book.start_date_time as t_b_start_date_time', 'apna_truck_book.final_settlement_amount as t_b_final_settlement_amount', 'apna_truck_book.notes as t_b_notes', 'apna_truck_book.end_date_time as t_b_end_date_time', 'apna_truck_book.file as t_b_file',

                'apna_labour_book.labour_contractor as l_b_labour_contractor', 'apna_labour_book.contractor_no as l_b_contractor_no', 'apna_labour_book.labour_rate_per_bags as l_b_labour_rate_per_bags', 'apna_labour_book.total_labour as l_b_total_labour', 'apna_labour_book.location as l_b_location', 'apna_labour_book.booking_date as l_b_booking_date', 'apna_labour_book.total_bags as l_b_total_bags', 'apna_labour_book.notes as l_b_notes',

                'apna_case_kanta_parchi.notes as k_p_notes', 'apna_case_kanta_parchi.file as k_p_file',

                'apna_case_second_quality_report.moisture_level as s_q_r_moisture_level', 'apna_case_second_quality_report.thousand_crown_w as s_q_r_thousand_crown_w', 'apna_case_second_quality_report.broken as s_q_r_broken', 'apna_case_second_quality_report.foreign_matter as s_q_r_foreign_matter', 'apna_case_second_quality_report.thin as s_q_r_thin', 'apna_case_second_quality_report.damage as s_q_r_damage', 'apna_case_second_quality_report.black_smith as s_q_r_black_smith', 'apna_case_second_quality_report.infested as s_q_r_infested', 'apna_case_second_quality_report.live_insects as s_q_r_live_insects', 'apna_case_second_quality_report.imge as s_q_r_imge', 'apna_case_second_quality_report.notes as s_q_r_notes',

                'apna_case_second_kanta_parchi.notes as s_k_p_notes', 'apna_case_second_kanta_parchi.file as s_k_p_file',

                'apna_case_gate_pass.notes as g_p_notes', 'apna_case_gate_pass.file as g_p_file',

                'apna_case_e_mandi.notes as e_m_notes', 'apna_case_e_mandi.file as e_m_file',

                'apna_case_accounts.vikray_parchi as a_vikray_parchi', 'apna_case_accounts.tally_updation as a_tally_updation', 'apna_case_accounts.cold_win_entry as a_cold_win_entry', 'apna_case_accounts.inventory as a_inventory', 'apna_case_accounts.loan as a_loan', 'apna_case_accounts.sale as a_sale', 'apna_case_accounts.mandi_tax as a_mandi_tax', 'apna_case_accounts.purchase as a_purchase', 'apna_case_accounts.invoice as a_invoice', 'apna_case_accounts.notes as a_notes',

                'apna_case_cctv.notes as cctv_notes', 'apna_case_cctv.file as cctv_file',
                'apna_case_cdf.notes as cdf_notes', 'apna_case_cdf.file as cdf_file',

                'apna_case_quality_claim.moisture_level as q_c_moisture_level', 'apna_case_quality_claim.thousand_crown_w as q_c_thousand_crown_w', 'apna_case_quality_claim.broken as q_c_broken', 'apna_case_quality_claim.foreign_matter as q_c_foreign_matter', 'apna_case_quality_claim.thin as q_c_thin', 'apna_case_quality_claim.damage as q_c_damage', 'apna_case_quality_claim.black_smith as q_c_black_smith', 'apna_case_quality_claim.infested as q_c_infested', 'apna_case_quality_claim.live_insects as q_c_live_insects', 'apna_case_quality_claim.imge as q_c_imge', 'apna_case_quality_claim.notes as q_c_notes', 'apna_case_quality_claim.quality_discount_value as q_c_quality_discount_value', 'apna_case_quality_claim.second_report as q_c_second_report',

                'apna_case_truck_payment.notes as t_p_notes', 'apna_case_truck_payment.file as t_p_file',

                'apna_case_labour_payment.notes as l_p_notes', 'apna_case_labour_payment.file as l_p_file',

                'apna_case_warehouse_receipt.notes as w_r_notes', 'apna_case_warehouse_receipt.file as w_r_file',

                'apna_case_storage_receipt.notes as s_r_notes', 'apna_case_storage_receipt.file as s_r_file',

                'apna_case_payment_received.notes as p_r_notes', 'apna_case_payment_received.file as p_r_file',


                'lead_generator.fname as lead_gen_fname',
                'lead_generator.lname as lead_gen_lname',
                'lead_conv.fname as lead_conv_fname',
                'lead_conv.lname as lead_conv_lname',
                'categories.category as cate_name',
                'categories.commodity_type',
                'warehouses.name as terminal_name')
            ->where('apna_case.case_id', $case_id)
            ->groupBy('apna_case.case_id')
            ->first();
        return $case;
    }

    // Get Approval Cases for Out Cases
    public function scopegetOutCaseDetails($query, $case_id)
    {
        $case = DB::table('apna_case')
            ->leftjoin('user_details as customer', 'customer.user_id', '=', 'apna_case.customer_uid')
            ->leftjoin('apna_case_quality_report', 'apna_case_quality_report.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_pricing', 'apna_case_pricing.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_release_order', 'apna_case_release_order.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_delivery_order', 'apna_case_delivery_order.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_commodity_withdrawal', 'apna_case_commodity_withdrawal.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_cctv', 'apna_case_cctv.case_id', '=', 'apna_case.case_id')

            ->leftjoin('apna_truck_book', 'apna_truck_book.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_labour_book', 'apna_labour_book.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_kanta_parchi', 'apna_case_kanta_parchi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_second_quality_report', 'apna_case_second_quality_report.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_second_kanta_parchi', 'apna_case_second_kanta_parchi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_gate_pass', 'apna_case_gate_pass.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_e_mandi', 'apna_case_e_mandi.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_accounts', 'apna_case_accounts.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_shipping_start', 'apna_case_shipping_start.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_shipping_end', 'apna_case_shipping_end.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_quality_claim', 'apna_case_quality_claim.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_truck_payment', 'apna_case_truck_payment.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_labour_payment', 'apna_case_labour_payment.case_id', '=', 'apna_case.case_id')
            ->leftjoin('apna_case_payment_received', 'apna_case_payment_received.case_id', '=', 'apna_case.case_id')
            ->join('users as lead_generator', 'lead_generator.id', '=', 'apna_case.lead_gen_uid')
            ->join('users as lead_conv', 'lead_conv.id', '=', 'apna_case.lead_conv_uid')
            ->join('warehouses', 'warehouses.id', '=', 'apna_case.terminal_id')
            ->join('categories', 'categories.id', '=', 'apna_case.commodity_id')
            ->select('apna_case.*', 'customer.phone',
                'customer.fname as cust_fname',
                'customer.lname as cust_lname',
                'apna_case_quality_report.moisture_level as q_r_moisture_level', 'apna_case_quality_report.thousand_crown_w as q_r_thousand_crown_w', 'apna_case_quality_report.broken as q_r_broken', 'apna_case_quality_report.foreign_matter as q_r_foreign_matter', 'apna_case_quality_report.thin as q_r_thin', 'apna_case_quality_report.damage as q_r_damage', 'apna_case_quality_report.black_smith as q_r_black_smith', 'apna_case_quality_report.infested as q_r_infested', 'apna_case_quality_report.live_insects as q_r_live_insects', 'apna_case_quality_report.imge as q_r_imge', 'apna_case_quality_report.notes as q_r_notes',

                'apna_case_release_order.notes as r_o_notes', 'apna_case_release_order.file as r_o_file',

                'apna_case_delivery_order.notes as d_o_notes', 'apna_case_delivery_order.file as d_o_file',
                'apna_case_cctv.notes as cctv_notes', 'apna_case_cctv.file as cctv_file',

                'apna_case_commodity_withdrawal.notes as c_w_notes', 'apna_case_commodity_withdrawal.file as c_w_file',

                'apna_case_pricing.processing_fees as p_processing_fees', 'apna_case_pricing.interest_rate as p_interest_rate', 'apna_case_pricing.price as p_price', 'apna_case_pricing.rent as p_rent', 'apna_case_pricing.labour_rate as p_labour_rate', 'apna_case_pricing.transaction_type as p_transaction_type', 'apna_case_pricing.notes as p_notes',

                'apna_truck_book.transporter as t_b_transporter', 'apna_truck_book.vehicle as t_b_vehicle', 'apna_truck_book.driver_name as t_b_driver_name', 'apna_truck_book.driver_phone as t_b_driver_phone', 'apna_truck_book.rate_per_km as t_b_rate_per_km', 'apna_truck_book.min_weight as t_b_min_weight', 'apna_truck_book.max_weight as t_b_max_weight', 'apna_truck_book.turnaround_time as t_b_turnaround_time', 'apna_truck_book.total_weight as t_b_total_weight', 'apna_truck_book.no_of_bags as t_b_no_of_bags', 'apna_truck_book.kanta_parchi_no as t_b_kanta_parchi_no', 'apna_truck_book.gate_pass_no as t_b_gate_pass_no', 'apna_truck_book.total_transport_cost as t_b_total_transport_cost', 'apna_truck_book.advance_payment as t_b_advance_payment', 'apna_truck_book.start_date_time as t_b_start_date_time', 'apna_truck_book.final_settlement_amount as t_b_final_settlement_amount', 'apna_truck_book.notes as t_b_notes', 'apna_truck_book.end_date_time as t_b_end_date_time', 'apna_truck_book.file as t_b_file',

                'apna_labour_book.labour_contractor as l_b_labour_contractor', 'apna_labour_book.contractor_no as l_b_contractor_no', 'apna_labour_book.labour_rate_per_bags as l_b_labour_rate_per_bags', 'apna_labour_book.total_labour as l_b_total_labour', 'apna_labour_book.location as l_b_location', 'apna_labour_book.booking_date as l_b_booking_date', 'apna_labour_book.total_bags as l_b_total_bags', 'apna_labour_book.notes as l_b_notes',

                'apna_case_kanta_parchi.notes as k_p_notes', 'apna_case_kanta_parchi.file as k_p_file',

                'apna_case_second_quality_report.moisture_level as s_q_r_moisture_level', 'apna_case_second_quality_report.thousand_crown_w as s_q_r_thousand_crown_w', 'apna_case_second_quality_report.broken as s_q_r_broken', 'apna_case_second_quality_report.foreign_matter as s_q_r_foreign_matter', 'apna_case_second_quality_report.thin as s_q_r_thin', 'apna_case_second_quality_report.damage as s_q_r_damage', 'apna_case_second_quality_report.black_smith as s_q_r_black_smith', 'apna_case_second_quality_report.infested as s_q_r_infested', 'apna_case_second_quality_report.live_insects as s_q_r_live_insects', 'apna_case_second_quality_report.imge as s_q_r_imge', 'apna_case_second_quality_report.notes as s_q_r_notes',

                'apna_case_second_kanta_parchi.notes as s_k_p_notes', 'apna_case_second_kanta_parchi.file as s_k_p_file',

                'apna_case_gate_pass.notes as g_p_notes', 'apna_case_gate_pass.file as g_p_file',

                'apna_case_e_mandi.notes as e_m_notes', 'apna_case_e_mandi.file as e_m_file',

                'apna_case_accounts.vikray_parchi as a_vikray_parchi', 'apna_case_accounts.tally_updation as a_tally_updation', 'apna_case_accounts.cold_win_entry as a_cold_win_entry', 'apna_case_accounts.inventory as a_inventory', 'apna_case_accounts.loan as a_loan', 'apna_case_accounts.sale as a_sale', 'apna_case_accounts.mandi_tax as a_mandi_tax', 'apna_case_accounts.purchase as a_purchase', 'apna_case_accounts.invoice as a_invoice', 'apna_case_accounts.notes as a_notes',

                'apna_case_shipping_start.location as s_s_location', 'apna_case_shipping_start.date_time as s_s_date_time', 'apna_case_shipping_start.notes as s_s_notes',

                'apna_case_shipping_end.location as s_e_location', 'apna_case_shipping_end.date_time as s_e_date_time', 'apna_case_shipping_end.notes as s_e_notes',

                'apna_case_quality_claim.moisture_level as q_c_moisture_level', 'apna_case_quality_claim.thousand_crown_w as q_c_thousand_crown_w', 'apna_case_quality_claim.broken as q_c_broken', 'apna_case_quality_claim.foreign_matter as q_c_foreign_matter', 'apna_case_quality_claim.thin as q_c_thin', 'apna_case_quality_claim.damage as q_c_damage', 'apna_case_quality_claim.black_smith as q_c_black_smith', 'apna_case_quality_claim.infested as q_c_infested', 'apna_case_quality_claim.live_insects as q_c_live_insects', 'apna_case_quality_claim.imge as q_c_imge', 'apna_case_quality_claim.notes as q_c_notes', 'apna_case_quality_claim.quality_discount_value as q_c_quality_discount_value', 'apna_case_quality_claim.second_report as q_c_second_report',

                'apna_case_truck_payment.notes as t_p_notes', 'apna_case_truck_payment.file as t_p_file',

                'apna_case_labour_payment.notes as l_p_notes', 'apna_case_labour_payment.file as l_p_file',

                'apna_case_payment_received.notes as p_r_notes', 'apna_case_payment_received.file as p_r_file',


                'lead_generator.fname as lead_gen_fname',
                'lead_generator.lname as lead_gen_lname',
                'lead_conv.fname as lead_conv_fname',
                'lead_conv.lname as lead_conv_lname',
                'categories.category as cate_name',
                'categories.commodity_type',
                'warehouses.name as terminal_name')
            ->where('apna_case.case_id', $case_id)
            ->groupBy('apna_case.case_id')
            ->first();
        return $case;
    }
}
