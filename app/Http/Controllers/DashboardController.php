<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\user_details;
use DB;
use Auth;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
	// Construct function 
	public function __construct(){

		// Only authenticarte and admin user can enter here
		$this->middleware('auth');
		$this->middleware('adminOnly');
	}

    // Admin dashboard view
    public function dashboard(){

    	return view('dashboard.admin_dashboard');
    }

    public function getSalesCSV(Request $request)
    {
		$status    = (int)$request->status;

		//Get Data
		$query = DB::table('buy_sells')
                        ->join('user_details','user_details.user_id', '=', 'buy_sells.buyer_id')
                        ->join('users','users.id', '=', 'buy_sells.seller_id')
                        ->join('inventories as inv', 'inv.id', '=', 'buy_sells.seller_cat_id')
                        ->join('categories', 'categories.id', '=', 'inv.commodity')
                        ->join('warehouses', 'warehouses.id', '=', 'inv.warehouse_id')
                        ->join('mandi_samitis', 'mandi_samitis.id', '=', 'warehouses.mandi_samiti_id')
  					    ->select('buy_sells.*', 'inv.gate_pass_wr','user_details.fname as buyer_name', 'users.fname as seller_name', 'categories.category', 'warehouses.name as warehouse', 'mandi_samitis.name as mandi_samiti_name')
                        ->where('inv.sales_status', $status)
                        ->where('buy_sells.status', 3);
        if(!empty($request->from_date))
        {
			$from_date = date('Y-m-d',strtotime($request->from_date));
        	$query->where(DB::raw('DATE(buy_sells.created_at)'), '>', $from_date);
        }

        if(!empty($request->to_date))
        {
			$to_date = date('Y-m-d',strtotime($request->to_date));
			$query->where(DB::raw('DATE(buy_sells.created_at)'), '<', $to_date);
        }

        $result = $query->get();		
		$html = '<script type="text/javascript">$(document).ready(function(){ $("#datatable").DataTable({ pageLength: 25,
            lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]],
            responsive: true, dom: \'<"html5buttons"B>lTfgitp\',
            buttons: [ {extend: "csv"}, {extend: "excel", title: "Sales Report"},{extend: "pdf", title: "Sales Report"},  {extend: "print",
                 customize: function (win){  $(win.document.body).addClass("white-bg"); $(win.document.body).css("font-size", "10px"); $(win.document.body).find("table") .addClass("compact") .css("font-size", "inherit"); } } ] }); });</script><table class="table table-striped table-bordered table-hover" id="datatable"><thead><tr>  <th>Buyer Name</th> <th>Seller Name</th>  <th>Gate Pass</th>  <th>Payment Ref. No.</th> <th>Mandi Samiti Name</th><th>Terminal</th> <th>Commodity</th><th>Quantity</th> <th>Price</th><th>Done Date</th></tr></thead><tbody>';

        foreach($result as $key => $done_deal)
        {
            $html .= '<tr class="gradeX">
                <td>'.$done_deal->buyer_name.'</td>
                <td>'.$done_deal->seller_name.'</td>
                <td>'.$done_deal->gate_pass_wr.'</td>
                <td>'.$done_deal->payment_ref_no.'</td>
                <td>'.$done_deal->mandi_samiti_name.'</td>
                <td>'.$done_deal->warehouse.'</td>
                <td>'.$done_deal->category.'</td>
                <td>'.$done_deal->quantity.'</td>
                <td>'.$done_deal->price.'</td>
                <td>'.date('d M Y', strtotime($done_deal->updated_at)).'</td> 
            </tr>';
        }

        echo $html .= '</tbody></table>';        
        die;
    }
}
