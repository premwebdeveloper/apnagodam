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

@if($role_id == 1 || $role_id == 6 || $role_id == 7 || $role_id == 8 || $role_id == 11)
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
                                {!! Form::number('quantity', '', ['class' => 'form-control', 'required' => 'required', 'step' => 'any', 'autocomplete' => 'off', 'placeholder' => 'Enter Quantity in Quintal']) !!}

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
                            <div class="col-md-4">
                                {!! Form::label('purpose', 'Purpose', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::select('purpose', array('For Sale' => 'For Sale', 'For Storage' => 'For Storage'), '', ['class' => 'form-control', 'id' => 'purpose', 'required' => 'required']); !!}
                                @if($errors->has('purpose'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('purpose') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 m-t-25">
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
	                    <a style="color:red;">
	                       You have 60 Minutes to Edit or Update Leads.
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
	                    <table class="table table-striped table-bordered table-hover leads_datatable">
	                        <thead>
	                            <tr>
                                    <th>Lead ID</th>
                                    <th>Generated By</th>
                                    <th>Customer Name</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                    <th>Commodity</th>
                                    <th>Est. Quantity(Qtl)</th>
                                    <th>Terminal</th>
                                    <th>Purpose</th>
                                    <th>Commitment Date</th>
                                    <th>Created On</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
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

@if($errors->has('edit_first_name') || $errors->has('edit_last_name') || $errors->has('edit_role_id') || $errors->has('edit_phone') || $errors->has('edit_email') || $errors->has('edit_designation') || $errors->has('edit_purpose'))
    <script type="text/javascript">
        $(document).ready(function(){
            $('#editLead').modal('show');
        });
    </script>
@endif

<!-- Edit Lead -->
<div id="editLead" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Lead</h4>
            </div>
            <div class="modal-body">                
                <div class="row">
                    {!! Form::open(array('url' => 'update_lead', 'files' => true, 'class' => "", 'id' => 'empForm')) !!}
                        @csrf
                        {{ Form::hidden('id', '', array('id' => 'lead_id')) }}
                        <div class="col-md-4">
                            {!! Form::label('edit_customer_name', 'Customer Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('edit_customer_name', '', ['class' => 'form-control','id' => 'edit_customer_name', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Customer Name']) !!}

                            @if($errors->has('edit_customer_name'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_customer_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_phone', 'Mobile No', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::number('edit_phone', '', ['class' => 'form-control', 'minlength' => 10, 'maxlength' => 10, 'required' => 'required', 'autocomplete' => 'off', 'id' => 'edit_phone', 'placeholder' => 'Mobile No']) !!}

                            @if($errors->has('edit_phone'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_phone') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_quantity', 'Estimated Qty.(Qtl)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('edit_quantity', '', ['class' => 'form-control', 'required' => 'required', 'id' => 'edit_quantity', 'autocomplete' => 'off', 'placeholder' => 'Enter Quantity in Quintal']) !!}

                            @if($errors->has('edit_quantity'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_quantity') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_location', 'Location', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('edit_location', '', ['class' => 'form-control', 'required' => 'required', 'id' => 'edit_location', 'autocomplete' => 'off', 'placeholder' => 'Enter Location']) !!}

                            @if($errors->has('edit_location'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_location') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_commodity_id', 'Commodity', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::select('edit_commodity_id', $commodity, '', ['class' => 'form-control', 'id' => 'edit_commodity_id', 'required' => 'required']); !!}
                            @if($errors->has('edit_commodity_id'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_commodity_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_terminal_id', 'Nearest Terminal', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::select('edit_terminal_id', $terminals, '', ['class' => 'form-control', 'id' => 'edit_terminal_id', 'required' => 'required']); !!}
                            @if($errors->has('edit_terminal_id'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_terminal_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_commodity_date', 'Commitment Date', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::date('edit_commodity_date', '', ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'edit_commodity_date', 'required' => 'required', 'placeholder' => 'Enter Commodity Date']) !!}

                            @if($errors->has('edit_commodity_date'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_commodity_date') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_user_id', 'If Generated By Other', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                            {!! Form::select('edit_user_id', $employees, '', ['class' => 'form-control', 'id' => 'edit_user_id']); !!}
                            @if($errors->has('edit_user_id'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_user_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_purpose', 'Purpose', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::select('edit_purpose', array('For Sale' => 'For Sale', 'For Storage' => 'For Storage'), '', ['class' => 'form-control', 'id' => 'edit_purpose', 'required' => 'required']); !!}
                            @if($errors->has('edit_purpose'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_purpose') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-12 m-t-25">
                            {!! Form::submit('Update / Save', ['class' => 'btn btn-info m-t-20 form-control b-info']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#addEmp').on('click', function(){
            $('#addEmployee').modal('show');
        });

        //Edit Lead
        $('.edit_lead').on('click', function(){
            var id = $(this).attr('data-id');
            $.ajax({
                method : 'post',
                url: "{{ route('get_lead') }}",
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'id' : id},
                success:function(response)
                {
                    console.log(response);                    
                    var data = JSON.parse(response);
                    $('#edit_customer_name').val(data.customer_name);
                    $('#edit_quantity').val(data.quantity);
                    $('#edit_location').val(data.location);
                    $('#edit_phone').val(data.phone);
                    $('#edit_commodity_id').val(data.commodity_id);
                    $('#edit_terminal_id').val(data.terminal_id);
                    $('#edit_commodity_date').val(data.commodity_date);
                    $('#edit_purpose').val(data.purpose);
                    $('#lead_id').val(data.id);
                    $('#editEmployee').modal('show');
                },
                error: function(data)
                {
                    //console.log(data);
                    alert(data);
                },
            });
            $('#editLead').modal('show');
        });
    });

    $(document).ready(function(){
        var pTable = $('.leads_datatable').dataTable({
            "bDestroy": true,
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('getAllLeads') }}",
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'generated_by', name: 'generated_by'},
                {data: 'customer_name', name: 'customer_name'},
                {data: 'phone', name: 'phone'},
                {data: 'location', name: 'location'},
                {data: 'commodity', name: 'commodity'},
                {data: 'quantity', name: 'quantity'},
                {data: 'terminal_name', name: 'terminal_name'},
                {data: 'purpose', name: 'purpose'},
                {data: 'commodity_date', name: 'commodity_date'},
                {data: 'action', name: 'action'}
            ],
        });
    });
</script>
@endsection
