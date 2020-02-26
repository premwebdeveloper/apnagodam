@extends('layouts.auth_app')
@section('content')
<?php
$currentuserid = Auth::user()->id;
$role = DB::table('user_roles')->where('user_id', $currentuserid)->first();
$role_id = $role->role_id;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>Pricing </h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Pricing </strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
                <div class="ibox-title">
	                <h5>Pricing List</h5>
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
                                    <th>Set Price</th>
                                    <th>Case ID</th>
                                    <th>Customer Name</th>
                                    <th>Phone</th>
                                    <th>Transaction Type</th>
                                    <th>Approx Qty.(Qtl.)</th>
                                    <th>Processing Fees(%)</th>
                                    <th>Interest Rate(%)</th>
                                    <th>Price</th>
                                    <th>Rent</th>
                                    <th>Labour Rate</th>
                                    <th>Notes</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($case_gen as $key => $pricing)
                                    <?php
                                    //If First Quality Report Update or not
                                    $res = DB::table('apna_case_quality_report')->where('case_id', $pricing->case_id)->first();
                                    $check_status = DB::table('apna_case_pricing')->where('case_id', $pricing->case_id)->first();
                                    ?>
	                                <tr class="gradeX">
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            @if($pricing->processing_fees)
                                                <span class="text-navy">Done</span>
                                            @else
                                                @if($pricing->in_out == 'PASS')
                                                    @if($role_id == 1 || $role_id == 8 || $role_id == 9)
                                                        @if($res)
                                                            <a data-id="{!! $pricing->case_id !!}" id='{!! $pricing->cust_fname." ".$pricing->cust_lname !!}' class="setPrice btn-primary btn btn-xs">Set Price</a>
                                                        @else
                                                            <span class="text-navy">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">Processing...</span>
                                                    @endif
                                                @elseif($pricing->in_out == 'IN')
                                                    @if($role_id == 1 || $role_id == 8 || $role_id == 9)
                                                        <a data-id="{!! $pricing->case_id !!}" id='{!! $pricing->cust_fname." ".$pricing->cust_lname !!}' class="setPrice btn-primary btn btn-xs">Set Price</a>
                                                    @endif
                                                @elseif($pricing->in_out == 'OUT')
                                                    @if($role_id == 1 || $role_id == 9)
                                                        <a data-id="{!! $pricing->case_id !!}" id='{!! $pricing->cust_fname." ".$pricing->cust_lname !!}' class="setPrice btn-primary btn btn-xs">Set Price</a>
                                                    @else
                                                        <span class="text-navy">In Process</span>
                                                    @endif
                                                @else
                                                    <span class="text-navy">In Process</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>{!! $pricing->case_id !!}</td>
                                        <td>{!! $pricing->cust_fname." ".$pricing->cust_lname !!}</td>
                                        <td>{!! $pricing->phone !!}</td>
                                        <td>{!! $pricing->transaction_type !!}</td>
                                        <td>{!! $pricing->total_weight !!}</td>
                                        <td>{!! $pricing->processing_fees !!}</td>
                                        <td>{!! $pricing->interest_rate !!}</td>
                                        <td>{!! $pricing->price !!}</td>
                                        <td>{!! $pricing->rent !!}</td>
                                        <td>{!! $pricing->labour_rate !!}</td>
                                        <td>{!! $pricing->notes !!}</td>
                                        <td>
                                            @if($pricing->in_out == 'PASS')
                                                @if(!$check_status && $res)
                                                    <a href="{!! route('close_case', ['user_id' => $pricing->case_id]) !!}" class="btn btn-danger btn-xs" data-toggle="confirmation" data-placement="bottom" title="Close Case ID">
                                                        Close
                                                    </a>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            @elseif($pricing->in_out == 'IN')
                                                @if(!$check_status)
                                                    <a href="{!! route('close_case', ['user_id' => $pricing->case_id]) !!}" class="btn btn-danger btn-xs" data-toggle="confirmation" data-placement="bottom" title="Close Case ID">
                                                        Close
                                                    </a>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            @endif
                                        </td>
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
                <h4 class="modal-title">Set Price</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-primary col-md-6 p-0">Case ID : <b style="color:green;" id="case_id_val"></b></h4>
                <h4 class="text-primary col-md-6 p-0 text-right">Customer Name : <b style="color:green;" id="cust_name"></b></h4>
                {!! Form::open(array('url' => 'addPrice', 'files' => true, 'class' => "contact_us_form", 'id' => 'empForm')) !!}
                {!! Form::hidden('case_id', '',array('id' => 'hidden_case_id')) !!}
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-9 p-0">
                            <div class="col-md-6">
                                {!! Form::label('price', 'Price', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::number('price', '', ['class' => 'form-control', 'step'=>'any', 'autocomplete' => 'off', 'placeholder' => 'Enter Price']) !!}
                            
                                @if($errors->has('price'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('processing_fees', 'Processing Fees(%)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::number('processing_fees', '', ['class' => 'form-control', 'required' => 'required', 'step'=>'any', 'autocomplete' => 'off', 'placeholder' => 'Enter Processing Fees']) !!}

                                @if($errors->has('processing_fees'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('processing_fees') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('rent', 'Rent (MT/Month)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::number('rent', '', ['class' => 'form-control', 'required' => 'required', 'step'=>'any', 'autocomplete' => 'off', 'placeholder' => 'Enter Rent Id']) !!}

                                @if($errors->has('rent'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('rent') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('interest_rate', 'Interest Rate(%)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::number('interest_rate', '', ['class' => 'form-control', 'minlength' => 10, 'step'=>'any', 'maxlength' => 10, 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Interest Rate']) !!}

                                @if($errors->has('interest_rate'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('interest_rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('transaction_type', 'Transaction Type', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::select('transaction_type', array('Cash (14-2)' => 'Cash (14-2)', 'E-Mandi' => 'E-Mandi', 'FPO' => 'FPO'), '', ['class' => 'form-control', 'required' => 'required', 'id' => '']); !!}

                                @if($errors->has('transaction_type'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('transaction_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('labour_rate', 'Labour Rate (50KG / Bag)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::number('labour_rate', '', ['class' => 'form-control', 'minlength' => 10, 'maxlength' => 10, 'required' => 'required', 'autocomplete' => 'off', 'step'=>'any', 'placeholder' => 'Labour Rate']) !!}

                                @if($errors->has('labour_rate'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('labour_rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('notes', 'Notes', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::textarea('notes', '', ['class' => 'form-control', 'autocomplete' => 'off', 'rows' => '9', 'placeholder' => 'Enter Notes']) !!}

                            @if($errors->has('notes'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('notes') }}</strong>
                                </span>
                            @endif
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


@if($errors->has('price') || $errors->has('processing_fees') || $errors->has('rent') || $errors->has('labour_rate') || $errors->has('interest_rate'))
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
    });
</script>
@endsection
