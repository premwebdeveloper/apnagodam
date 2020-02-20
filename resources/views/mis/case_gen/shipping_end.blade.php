@extends('layouts.auth_app')
@section('content')
<?php
$currentuserid = Auth::user()->id;
$role = DB::table('user_roles')->where('user_id', $currentuserid)->first();
$role_id = $role->role_id;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>Shipping End</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Shipping End</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
                <div class="ibox-title">
	                <h5>Shipping End</h5>
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
	                    <table class="table table-striped table-bordered table-hover dataTables-example">
	                        <thead>
	                            <tr>
                                    <th>#</th>
                                    <th>Shipping</th>
                                    <th>Case ID</th>
                                    <th>Customer Name</th>
                                    <th>Location</th>
                                    <th>Date Time</th>
                                    <th>Notes</th>
                                    <th>Done By</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                <?php $currentuserid = Auth::user()->id; ?>
                                @foreach($case_gen as $key => $shipping_start)
                                    @if($shipping_start->in_out == 'PASS' || $shipping_start->in_out == 'OUT')
                                        <?php
                                            $check_status = DB::table('apna_case_shipping_start')->where('case_id', $shipping_start->case_id)->first();
                                        ?>
    	                                <tr class="gradeX">
                                            <td>{{ ++$key }}</td>
                                            <td>
                                                @if($shipping_start->location)
                                                    <span class="text-navy">Done</span>
                                                @else
                                                    @if($role_id == 1 || $role_id == 6 || $role_id == 7 || $role_id == 8)
                                                        @if(($check_status) && ($currentuserid == $shipping_start->lead_conv_uid || $role_id == 1 || $role_id == 8))
                                                            <a data-id="{!! $shipping_start->case_id !!}" id='{!! $shipping_start->cust_fname." ".$shipping_start->cust_lname !!}' class="setPrice btn-warning btn btn-xs">Shipping End</a>
                                                        @else
                                                            <span class="text-navy">Processing...</span>
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
                <h4 class="modal-title">Shipping End</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-primary col-md-6 p-0">Case ID : <b style="color:green;" id="case_id_val"></b></h4>
                <h4 class="text-primary col-md-6 p-0 text-right">Customer Name : <b style="color:green;" id="cust_name"></b></h4>
                {!! Form::open(array('url' => 'addShippingEnd', 'files' => true, 'class' => "contact_us_form", 'id' => 'empForm')) !!}
                    {!! Form::hidden('case_id', '',array('id' => 'hidden_case_id')) !!}
                    @csrf
                    
                    <div class="row">
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


@if($errors->has('location') || $errors->has('date_time'))
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
        $('.datetimepicker').datetimepicker();
    });
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha256-yMjaV542P+q1RnH6XByCPDfUFhmOafWbeLPmqKh11zo=" crossorigin="anonymous" />
@endsection
