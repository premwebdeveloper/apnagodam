@extends('layouts.auth_app')
@section('content')
<?php
$currentuserid = Auth::user()->id;
$role = DB::table('user_roles')->where('user_id', $currentuserid)->first();
$role_id = $role->role_id;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>All Leads</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Leads</strong>
            </li>
        </ol>
    </div>
</div>

@if($role_id == 1 || $role_id == 6 || $role_id == 7 || $role_id == 8)
<div class="wrapper wrapper-content animated fadeInRight" style="padding-bottom: 0px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Generate Lead</h5>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        {!! Form::open(array('url' => 'createLead', 'files' => true, 'class' => "", 'id' => 'empForm')) !!}
                        @csrf
                            
                            <div class="col-md-4">
                                {!! Form::label('customer_name', 'Customer Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('customer_name', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Customer Name']) !!}

                                @if($errors->has('customer_name'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('customer_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('phone', 'Mobile No', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::number('phone', '', ['class' => 'form-control', 'minlength' => 10, 'maxlength' => 10, 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Mobile No']) !!}

                                @if($errors->has('phone'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('quantity', 'Estimated Qty.(Qtl)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('quantity', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Quantity in Quintal']) !!}

                                @if($errors->has('quantity'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('location', 'Location', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('location', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Location']) !!}

                                @if($errors->has('location'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('commodity_id', 'Commodity', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::select('commodity_id', $commodity, '', ['class' => 'form-control', 'required' => 'required']); !!}
                                @if($errors->has('commodity_id'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('commodity_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('terminal_id', 'Nearest Terminal', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::select('terminal_id', $terminals, '', ['class' => 'form-control', 'required' => 'required']); !!}
                                @if($errors->has('terminal_id'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('terminal_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('commodity_date', 'Commitment Date', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::date('commodity_date', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Commodity Date']) !!}

                                @if($errors->has('commodity_date'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('commodity_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('user_id', 'If Generated By Other', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::select('user_id', $employees, '', ['class' => 'form-control']); !!}
                                @if($errors->has('user_id'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 m-t-25">
                                {!! Form::submit('Generate', ['class' => 'btn btn-info m-t-20 form-control b-info']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
                <div class="ibox-title">
	                <h5>Leads List</h5>
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
                                    <th>Generated By</th>
                                    <th>Customer Name</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                    <th>Commodity</th>
                                    <th>Est. Quantity(Qtl)</th>
                                    <th>Terminal</th>
                                    <th>Commitment Date</th>
                                    <th>Created On</th>
                                    @if($role_id == 1)
                                    <!-- <th>Action</th> -->
                                    @endif
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($leads as $key => $lead)
                                    @if($role_id == 1)
    	                                <tr class="gradeX">
                                            <td>{{ ++$key }}</td>
                                            <td>{!! $lead->first_name." ".$lead->last_name !!}</td>
                                            <td>{!! $lead->customer_name !!}</td>
                                            <td>{!! $lead->phone !!}</td>
                                            <td>{!! $lead->location !!}</td>
                                            <td>{!! $lead->cate_name ." (".$lead->commodity_type.")"  !!}</td>
                                            <td>{!! $lead->quantity !!}</td>
                                            <td>{!! $lead->terminal_name !!}</td>
                                            <td>{!! date('d M Y', strtotime($lead->commodity_date)) !!}</td>
                                            <td>{!! date('d M Y', strtotime($lead->created_at)) !!}</td>
                                            <!-- <td>
                                                <a href="{!! route('deleteEmployee', ['id' => $lead->id]) !!}" class="btn btn-danger btn-xs" data-toggle="confirmation" data-placement="bottom" title="Delete Lead">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td> -->
    	                                </tr>
                                    @else
                                        @if($currentuserid == $lead->user_id)
                                            <tr class="gradeX">
                                                <td>{{ ++$key }}</td>
                                                <td>{!! $lead->first_name." ".$lead->last_name !!}</td>
                                                <td>{!! $lead->customer_name !!}</td>
                                                <td>{!! $lead->phone !!}</td>
                                                <td>{!! $lead->location !!}</td>
                                                <td>{!! $lead->cate_name ." (".$lead->commodity_type.")"  !!}</td>
                                                <td>{!! $lead->quantity !!}</td>
                                                <td>{!! $lead->terminal_name !!}</td>
                                                <td>{!! date('d M Y', strtotime($lead->commodity_date)) !!}</td>
                                                <td>{!! date('d M Y', strtotime($lead->created_at)) !!}</td>
                                            </tr>
                                        @endif
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

@if($errors->has('first_name') || $errors->has('last_name') || $errors->has('role_id') || $errors->has('phone') || $errors->has('email') ||$errors->has('designation'))
    <script type="text/javascript">
        $(document).ready(function(){
            $('#addEmployee').modal('show');
        });
    </script>
@endif

<script type="text/javascript">
    $(document).ready(function(){
        $('#addEmp').on('click', function(){
            $('#addEmployee').modal('show');
        });
    });
</script>
@endsection
