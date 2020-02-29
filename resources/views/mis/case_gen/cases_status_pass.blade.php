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

<!-- Add User Employee by Admin -->
<div id="setCasePrice" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Approve Case</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-primary col-md-6 p-0">Case ID : <b style="color:green;" id="case_id_val"></b></h4>
                <h4 class="text-primary col-md-6 p-0 text-right">Customer Name : <b style="color:green;" id="cust_name"></b></h4>
                {!! Form::open(array('url' => 'caseApprove', 'files' => true, 'class' => "contact_us_form", 'id' => 'empForm')) !!}
                {!! Form::hidden('case_id', '',array('id' => 'hidden_case_id')) !!}
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('notes', 'Notes', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                            {!! Form::textarea('notes', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'rows' => '6', 'placeholder' => 'Enter Notes']) !!}

                            @if($errors->has('notes'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('notes') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::submit('Save / Final Approve', ['class' => 'btn btn-info m-t-20 form-control b-info']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.setPrice').on('click', function(){
            var case_id = $(this).attr('data-id');
            var name = $(this).attr('id');
            $('#case_id_val').html(case_id);
            $('#hidden_case_id').val(case_id);
            $('#cust_name').html(name);
            $('#setCasePrice').modal('show');
        });
    });
</script>
@endsection
