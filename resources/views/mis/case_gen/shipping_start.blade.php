@extends('layouts.auth_app')
@section('content')
<?php
$currentuserid = Auth::user()->id;
$role = DB::table('user_roles')->where('user_id', $currentuserid)->first();
$role_id = $role->role_id;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>Shipping Start</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Shipping Start</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
                <div class="ibox-title">
	                <h5>Shipping Start</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>
	                </div>
	            </div>

	            <div class="ibox-content">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover dataTables-example1">
	                        <thead>
	                            <tr>
                                    <th>#</th>
                                    <th>Shipping</th>
                                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Case_ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th>Customer Name</th>
                                    <th>UserName</th>
                                    <th>&nbsp;&nbsp;&nbsp;Details_in_Tally&nbsp;&nbsp;&nbsp;</th>
                                    <th>Location</th>
                                    <th>Date Time</th>
                                    <th>Notes</th>
                                    <th>Done By</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                <?php $currentuserid = Auth::user()->id; ?>
                                @foreach($case_gen as $key => $shipping_start)
                                    @if($shipping_start->in_out == 'PASS')
                                        <?php
                                            $check_status = DB::table('apna_case_accounts')->where('case_id', $shipping_start->case_id)->first();
                                        ?>
    	                                <tr class="gradeX">
                                            <td>{{ ++$key }}</td>
                                            <td>
                                                @if($shipping_start->s_s_case_id)
                                                    <span class="text-navy">Done</span>
                                                @else
                                                    @if($role_id == 1 || $currentuserid == $shipping_start->lead_conv_uid || $role_id == 8)
                                                        @if($check_status)
                                                            <a data-id="{!! $shipping_start->case_id !!}" id='{!! $shipping_start->cust_fname." ".$shipping_start->cust_lname !!}' class="setPrice btn-warning btn btn-xs">Shipping Start</a>
                                                        @else
                                                            <span class="text-warning">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">In Process</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{!! $shipping_start->case_id !!}</td>
                                            <td>{!! $shipping_start->cust_fname." ".$shipping_start->cust_lname !!}</td>
                                            <td><b>User : </b>{!! ($shipping_start->fpo_user_id)?$shipping_start->fpo_user_id:'N/A' !!}<br><b>Gatepass/CDF Name : </b>{!! ($shipping_start->gate_pass_cdf_user_name)?$shipping_start->gate_pass_cdf_user_name:'N/A' !!}<br><b>Coldwin Name : </b>{!! ($shipping_start->coldwin_name)?$shipping_start->coldwin_name:'N/A' !!}</td>
                                            <td><b>Purchase Details: </b>{!! ($shipping_start->purchase_name)?$shipping_start->purchase_name:'N/A' !!}<br><b>Loan Details : </b>{!! ($shipping_start->loan_name)?$shipping_start->loan_name:'N/A' !!}<br><b>Sale Details : </b>{!! ($shipping_start->sale_name)?$shipping_start->sale_name:'N/A' !!}</td>
                                            <td>{!! $shipping_start->date_time !!}</td>
                                            <td>{!! $shipping_start->location !!}</td> 
                                            <td>{!! $shipping_start->notes !!}</td>
                                            <td>{!! $shipping_start->user_fname." ".$shipping_start->user_lname !!}</td>
    	                                </tr>
                                    @elseif($shipping_start->in_out == 'OUT')
                                        <?php
                                            $check_status = DB::table('apna_case_accounts')->where('case_id', $shipping_start->case_id)->first();
                                        ?>
                                        <tr class="gradeX">
                                            <td>{{ ++$key }}</td>
                                            <td>
                                                @if($shipping_start->s_s_case_id)
                                                    <span class="text-navy">Done</span>
                                                @else
                                                    @if($role_id == 1 || $role_id == 11
                                                    )
                                                        @if($check_status)
                                                            <a data-id="{!! $shipping_start->case_id !!}" id='{!! $shipping_start->cust_fname." ".$shipping_start->cust_lname !!}' class="setPrice btn-warning btn btn-xs">Shipping Start</a>
                                                        @else
                                                            <span class="text-warning">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">In Process</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{!! $shipping_start->case_id !!}</td>
                                            <td>{!! $shipping_start->cust_fname." ".$shipping_start->cust_lname !!}</td>
                                            <td>{!! $shipping_start->date_time !!}</td>
                                            <td>{!! $shipping_start->location !!}</td> 
                                            <td>{!! $shipping_start->notes !!}</td>
                                            <td>{!! $shipping_start->user_fname." ".$shipping_start->user_lname !!}</td>
                                        </tr>
                                    @endif
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
                <h4 class="modal-title">Shipping Start</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-primary col-md-6 p-0">Case ID : <b style="color:green;" id="case_id_val"></b></h4>
                <h4 class="text-primary col-md-6 p-0 text-right">Customer Name : <b style="color:green;" id="cust_name"></b></h4>
                {!! Form::open(array('url' => 'addShippingStart', 'files' => true, 'class' => "contact_us_form", 'id' => 'empForm')) !!}
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::text('case_id', '', ['class' => 'form-control', 'id'=>'hidden_case_id', 'readonly' => 'readonly', 'placeholder' => 'Case ID']) !!}
                            @if($errors->has('case_id'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('case_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                {!! Form::label('location', 'Location', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('location', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Location (City Name)']) !!}
                            
                                @if($errors->has('location'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="col-md-6">
                                {!! Form::label('date_time', 'Date Time', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('date_time', '', ['class' => 'form-control datetimepicker', 'required' => 'required', 'autocomplete' => 'off']) !!}
                            
                                @if($errors->has('date_time'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('date_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="col-md-12">
                                {!! Form::label('notes', 'Notes', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::textarea('notes', '', ['class' => 'form-control', 'autocomplete' => 'off', 'rows' => '5', 'placeholder' => 'Enter Notes']) !!}

                                @if($errors->has('notes'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('notes') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-info m-t-20 form-control b-info', 'onclick' => 'submitForm(this);']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


@if($errors->has('location') || $errors->has('date_time') || $errors->has('case_id'))
    <script type="text/javascript">
        $(document).ready(function(){
            $('#setCasePrice').modal('show');
        });
    </script>
@endif
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
        $('.datetimepicker').datetimepicker({
            format: "dd MM yyyy - HH:ii P",
            showMeridian: true,
            autoclose: true,
        });
    });
    $(document).ready( function () {
        var table = $('.dataTables-example1').DataTable( {
        pageLength : 3,
        lengthMenu: [[3, 5, 10, 20, -1], [3, 5, 10, 20, 'All']]
      });
    });
</script>
<link rel="stylesheet" href="{{ asset('resources/assets/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" />
@endsection
