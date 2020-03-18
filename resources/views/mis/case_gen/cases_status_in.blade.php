@extends('layouts.auth_app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>In Cases Status </h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>In Cases Status</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
                <div class="ibox-title">
	                <h5>In Cases Status List</h5>
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
                                    <th>Pricing</th>
                                    <th>Truck Book</th>
                                    <th>Labour Book</th>
                                    <th>First Kanta Parchi</th>
                                    <th>First Quality Report</th>
                                    <th>Second Kanta Parchi</th>
                                    <th>Second Quality Report</th>
                                    <th>Gate Pass</th>
                                    <th>E-Mandi</th>
                                    <th>Quality Claim</th>
                                    <th>CCTV</th>
                                    <th>Commodity Deposite</th>
                                    <th>Accounts</th>
                                    <th>Truck Payment</th>
                                    <th>Labour Payment</th>
                                    <th>Warehouse Receipt</th>
                                    <th>Storage Receipt</th>
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
                                        <td>{!! ($lead->pricing_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->pricing_update_time)?date('g:i A', strtotime($lead->pricing_update_time)):'' }}</td>
                                        <td>{!! ($lead->truck_book_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->truck_book_update_time)?date('g:i A', strtotime($lead->truck_book_update_time)):'' }}</td>
                                        <td>{!! ($lead->labour_book_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->labour_book_update_time)?date('g:i A', strtotime($lead->labour_book_update_time)):'' }}</td>
                                        <td>{!! ($lead->kanta_parchi_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->kanta_parchi_update_time)?date('g:i A', strtotime($lead->kanta_parchi_update_time)):'' }}</td>
                                        <td>{!! ($lead->quality_report_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->quality_report_update_time)?date('g:i A', strtotime($lead->quality_report_update_time)):'' }}</td>
                                        <td>{!! ($lead->second_kanta_parchi_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->second_kanta_parchi_update_time)?date('g:i A', strtotime($lead->second_kanta_parchi_update_time)):'' }}</td>
                                        <td>{!! ($lead->second_quality_report_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->second_quality_report_update_time)?date('g:i A', strtotime($lead->second_quality_report_update_time)):'' }}</td>
                                        <td>{!! ($lead->gate_pass_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->gate_pass_update_time)?date('g:i A', strtotime($lead->gate_pass_update_time)):'' }}</td>

                                        <td>{!! ($lead->transaction_type == 'E-Mandi')?(($lead->e_mandi_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>'):'<span class="text-info">Not for E-Mandi</span>' !!}<br>

                                            {{ ($lead->transaction_type == 'E-Mandi')?(($lead->e_mandi_update_time)?date('g:i A', strtotime($lead->e_mandi_update_time)):''):'' }}
                                        </td>


                                        <td>{!! ($lead->quality_claim_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->quality_claim_update_time)?date('g:i A', strtotime($lead->quality_claim_update_time)):'' }}</td>
                                        <td>{!! ($lead->cctv_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->cctv_update_time)?date('g:i A', strtotime($lead->cctv_update_time)):'' }}</td>
                                        <td>{!! ($lead->cdf_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->cdf_update_time)?date('g:i A', strtotime($lead->cdf_update_time)):'' }}</td>
                                        <td>{!! ($lead->accounts_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->accounts_update_time)?date('g:i A', strtotime($lead->accounts_update_time)):'' }}</td>
                                        <td>{!! ($lead->truck_payment_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->truck_payment_update_time)?date('g:i A', strtotime($lead->truck_payment_update_time)):'' }}</td>
                                        <td>{!! ($lead->labour_payment_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->labour_payment_update_time)?date('g:i A', strtotime($lead->labour_payment_update_time)):'' }}</td>
                                        <td>{!! ($lead->warehouse_receipt_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->warehouse_receipt_update_time)?date('g:i A', strtotime($lead->warehouse_receipt_update_time)):'' }}</td>
                                        <td>{!! ($lead->storage_receipt_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->storage_receipt_update_time)?date('g:i A', strtotime($lead->storage_receipt_update_time)):'' }}</td>
                                        <td>{!! ($lead->payment_received_case_id)?'<span class="text-info">Completed</span>':'<span class="text-danger">Processing...</span>' !!}<br>{{ ($lead->payment_received_update_time)?date('g:i A', strtotime($lead->payment_received_update_time)):'' }}</td>

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
