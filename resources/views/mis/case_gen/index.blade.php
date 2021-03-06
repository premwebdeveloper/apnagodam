@extends('layouts.auth_app')
@section('content')
<?php
$currentuserid = Auth::user()->id;
$role = DB::table('user_roles')->where('user_id', $currentuserid)->first();
$role_id = $role->role_id;
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>All Case </h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Case </strong>
            </li>
        </ol>
    </div>
</div>

@if($role_id == 1 || $role_id == 6 || $role_id == 7 || $role_id == 8|| $role_id == 11)
    <div class="wrapper wrapper-content animated fadeInRight" style="padding-bottom: 0px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Create Case ID</h5>
                    </div>
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

                    <div class="ibox-content">
                        <div class="row">
                            {!! Form::open(array('url' => 'createCase', 'files' => true, 'class' => "", 'id' => 'empForm')) !!}
                            @csrf
                                
                                <div class="col-md-3">
                                    {!! Form::label('customer_uid', 'Customer', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::select('customer_uid', $customers, '', ['class' => 'form-control', 'id' => 'customer', 'required' => 'required']); !!}
                                    @if($errors->has('customer_uid'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('customer_uid') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    {!! Form::label('in_out', 'In / Out / Pass', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::select('in_out', array('IN' => 'IN', 'OUT' => 'OUT', 'PASS' => 'PASS'), '', ['class' => 'form-control', 'id' => 'in_out', 'required' => 'required']); !!}
                                    @if($errors->has('in_out'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('in_out') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    {!! Form::label('purpose', 'Purpose', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::select('purpose', array('For Sale' => 'For Sale', 'For Storage' => 'For Storage'), '', ['class' => 'form-control', 'id' => 'purpose', 'required' => 'required']); !!}
                                    @if($errors->has('purpose'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('purpose') }}</strong>
                                        </span>
                                    @endif
                                </div>                                
                                <div class="col-md-3">
                                    {!! Form::label('location', 'Location', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::text('location', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Location']) !!}

                                    @if($errors->has('location'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('location') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    {!! Form::label('quantity', 'Approx Qty.(Qtl)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::text('quantity', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Quantity in Quintal']) !!}

                                    @if($errors->has('quantity'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('quantity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    {!! Form::label('commodity_id', 'Commodity', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::select('commodity_id', $commodity, '', ['class' => 'form-control', 'required' => 'required']); !!}
                                    @if($errors->has('commodity_id'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('commodity_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-3">
                                    {!! Form::label('terminal_id', 'Nearest Terminal', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::select('terminal_id', $terminals, '', ['class' => 'form-control', 'required' => 'required']); !!}
                                    @if($errors->has('terminal_id'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('terminal_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-3">
                                    {!! Form::label('gate_pass', 'Gate Pass', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::text('gate_pass', '', ['class' => 'form-control', 'required' => 'required', 'disabled' => 'disabled', 'autocomplete' => 'off', 'placeholder' => 'Enter Gate Pass No.']) !!}

                                    @if($errors->has('gate_pass'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('gate_pass') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    {!! Form::label('vehicle_no', 'Vehicle No.', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                    {!! Form::text('vehicle_no', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'style' => 'text-transform: uppercase;','placeholder' => 'Enter Vehicle / Truck No.']) !!}

                                    @if($errors->has('vehicle_no'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('vehicle_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    {!! Form::label('lead_generator', 'Lead Generator', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::select('lead_generator', array(), '', ['class' => 'form-control', 'id' => 'lead_gen', 'readonly' => 'readonly']); !!}

                                    @if($errors->has('lead_generator'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('lead_generator') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    {!! Form::label('conv_user_id', 'If Lead Converted By Other', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                    {!! Form::select('conv_user_id', $employees, '', ['class' => 'form-control']); !!}
                                    @if($errors->has('conv_user_id'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('conv_user_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    {!! Form::label('fpo_users', 'FPO Sub Users', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                    {!! Form::text('fpo_users', '', ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Enter FPO Sub Users Name']) !!}

                                    @if($errors->has('fpo_users'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('fpo_users') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="col-md-12 m-t-25">
                                    {!! Form::submit('Create Case', ['class' => 'btn btn-info form-control b-info', 'onclick' => 'submitForm(this);']) !!}
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
	                <h5>Case IDs List</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>
	                </div>
	            </div>

	            <div class="ibox-content">
                    <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover dataTables-example1">
	                        <thead>
	                            <tr>
                                    <th>#</th>
                                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Case_ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th>Customer Name</th>
                                    <th>Sub Users</th>
                                    <th>Generated By</th>
                                    <th>Converted By</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                    <th>Commodity</th>
                                    <th>Vehicle No</th>
                                    <th>Approx Quantity(Qtl)</th>
                                    <th>Terminal</th>
                                    <th>In / Out</th>
                                    <th>Purpose</th>
                                    <th>Created On</th>
                                    <th>Status</th>
                                    @if($role_id == 1)
                                    <!-- <th>Action</th> -->
                                    @endif
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($case_gen as $key => $lead)
	                                <tr class="gradeX">
                                        <td>{{ ++$key }}</td>
                                        <td>{!! $lead->case_id !!}</td>
                                        <td>{!! $lead->cust_fname." ".$lead->cust_lname !!}</td>
                                        <td>{!! ($lead->fpo_users)?$lead->fpo_users:"N/A" !!}</td>
                                        <td>{!! $lead->lead_gen_fname." ".$lead->lead_gen_lname !!}</td>
                                        <td>{!! $lead->lead_conv_fname ." ".$lead->lead_conv_lname !!}</td>
                                        <td>{!! $lead->phone !!}</td>
                                        <td>{!! $lead->location !!}</td>
                                        <td>{!! $lead->cate_name ." (".$lead->commodity_type.")"  !!}</td>
                                        <td>{!! $lead->vehicle_no !!}</td>
                                        <td>{!! $lead->total_weight !!}</td>
                                        <td>{!! $lead->terminal_name." (".$lead->warehouse_code.")" !!}</td>
                                        <td>{!! $lead->in_out !!}</td>
                                        <td>{!! $lead->purpose !!}</td>
                                        <td>{!! date('d M Y', strtotime($lead->created_at)) !!}</td>
                                        <td>
                                            @if($lead->status == 1)
                                                <b class="text-navy">In Process</b>
                                            @else
                                                <b class="red">Closed</b>
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

@if($errors->has('first_name') || $errors->has('last_name') || $errors->has('role_id') || $errors->has('phone') || $errors->has('email') ||$errors->has('designation'))
    <script type="text/javascript">
        $(document).ready(function(){
            $('#addEmployee').modal('show');
        });
    </script>
@endif

<script type="text/javascript">
    $(document).ready(function(){

        // Initialize select2
        $("#customer").select2({
            matcher: function(params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') { return data; }

                // Do not display the item if there is no 'text' property
                if (typeof data.text === 'undefined') { return null; }

                var q = params.term.toLowerCase();
                if (data.text.toLowerCase().indexOf(q) > -1 || data.id.toLowerCase().indexOf(q) > -1) {
                    return $.extend({}, data, true);
                }

                // Return `null` if the term should not be displayed
                return null;
            }
        });

        // Read selected option
        $('#but_read').click(function(){
            var username = $('#customer option:selected').text();
            var userid = $('#customer').val();
        });


        $('#addEmp').on('click', function(){
            $('#addEmployee').modal('show');
        });

        //Get Lead Generator and Mobile Number of Customer
        $('#customer').on('change', function(){
            var id = $(this).val();
            $.ajax({
                method : 'post',
                url: "{{ route('getLeadGenRec') }}",
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'customer_uid' : id},
                success:function(response)
                {
                    if(response == 1)
                    {
                        $('#lead_gen').html('<option value="1">Admin</option>');
                    }else{
                        var data = JSON.parse(response);
                        $('#lead_gen').html('<option value="'+data.user_id+'">'+data.emp_id+'</option>');
                    }
                },
                error: function(data)
                {
                    //console.log(data);
                    alert(data);
                },
            });
            //Get mobile number and 
        });

        //Get Lead Generator and Mobile Number of Customer
        $('#terminal_id').on('change', function(){
            var id = $(this).val();
            if(id)
            {
                $.ajax({
                    method : 'post',
                    url: "{{ route('getLastGatePass') }}",
                    async : true,
                    data : {"_token": "{{ csrf_token() }}", 'terminal_id' : id},
                    success:function(response)
                    {
                        $('#gate_pass').removeAttr('disabled');
                        $('#gate_pass').val(response);
                    },
                    error: function(data)
                    {
                        //console.log(data);
                        alert(data);
                    },
                });
            }else{
                $('#gate_pass').val('');
                $('#gate_pass').attr('disabled', 'disabled');
            }
        });

        //Change In / Out
        $('#in_out').on('change', function(){
            var option = '';
            if($(this).val() == 'PASS'){
                option = '<option value="For Sale">For Sale</option>';
                $('#purpose').html(option);
            }
            else if($(this).val() == 'OUT')
            {
                option = '<option value="For Sale">For Sale</option><option value="Self Withdrawal">Self Withdrawal</option>';
                $('#purpose').html(option);
            }else{
                option = '<option value="For Sale">For Sale</option><option value="For Storage">For Storage</option>';
                $('#purpose').html(option);
            }
        });
    });
    $(document).ready( function () {
        var table = $('.dataTables-example1').DataTable( {
        pageLength : 3,
        lengthMenu: [[3, 5, 10, 20, -1], [3, 5, 10, 20, 'All']]
      });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endsection