@extends('layouts.auth_app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>Pass Cases Status </h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Pass Cases Status</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
                <div class="ibox-title">
	                <h5>Pass Cases Status List</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>
	                </div>
	            </div>

	            <div class="ibox-content">

                    <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover dataTables-example">
	                        <thead>
	                            <tr>
                                    <th>#</th>
                                    <th>Case ID</th>
                                    <th>Customer Name</th>
                                    <th>Commodity</th>
                                    <th>Terminal</th>
                                    <th>Quality Report</th>
                                    <th>Pricing</th>
                                    <th>Truck Book</th>
                                    <th>Labour Book</th>
                                    <th>First Kanta Parchi</th>
                                    <th>Second Quality Report</th>
                                    <th>Second Kanta Parchi</th>
                                    <th>Gate Pass</th>
                                    <th>E-Mandi</th>
                                    <th>Accounts</th>
                                    <th>Shipment Start</th>
                                    <th>Shipment End</th>
                                    <th>Quality Claim</th>
                                    <th>Truck Payment</th>
                                    <th>Labour Payment</th>
                                    <th>Payment Received</th>
                                    <th>Created On</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($case_gen as $key => $lead)
	                                <tr class="gradeX">
                                        <td>{{ ++$key }}</td>
                                        <td>{!! $lead->case_id !!}</td>
                                        <td>{!! $lead->cust_fname." ".$lead->cust_lname !!}</td>
                                        <td>{!! $lead->cate_name ." (".$lead->commodity_type.")"  !!}</td>
                                        <td>{!! $lead->terminal_name !!}</td>


                                        <td>{!! ($lead->quality_report_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}</td>
                                        <td>{!! ($lead->pricing_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}</td>
                                        <td>{!! ($lead->truck_book_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}</td>
                                        <td>{!! ($lead->labour_book_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}</td>
                                        <td>{!! ($lead->kanta_parchi_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}</td>
                                        <td>{!! ($lead->second_quality_report_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}</td>
                                        <td>{!! ($lead->second_kanta_parchi_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}</td>
                                        <td>{!! ($lead->gate_pass_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}</td>
                                        <td>{!! ($lead->e_mandi_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}</td>
                                        <td>{!! ($lead->accounts_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}</td>
                                        <td>{!! ($lead->shipping_start_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}</td>
                                        <td>{!! ($lead->shipping_end_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}</td>
                                        <td>{!! ($lead->quality_claim_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}</td>
                                        <td>{!! ($lead->truck_payment_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}</td>
                                        <td>{!! ($lead->labour_payment_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}</td>
                                        <td>{!! ($lead->payment_received_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}</td>


                                        <td>{!! date('d M Y', strtotime($lead->created_at)) !!}</td>
	                                </tr>
                                @endforeach
	                        </tbody>
	                    </table>
	                </div>

	            </div>
	        </div>
    	</div>
    </div>
</div>

@endsection
