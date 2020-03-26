@extends('layouts.auth_app')
@section('content')
<?php
$currentuserid = Auth::user()->id;
$role = DB::table('user_roles')->where('user_id', $currentuserid)->first();
$emp_levels = DB::table('emp_levels')->where('user_id', $currentuserid)->first();
$role_id = $role->role_id;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>Second Kanta Parchi </h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Second Kanta Parchi </strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
                <div class="ibox-title">
	                <h5>Second Kanta Parchi List</h5>
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
                                    <th>Kanta Parchi</th>
                                    <th>Case ID</th>
                                    <th>Customer Name</th>
                                    <th>UserName</th>
                                    <th>Details in Tally</th>
                                    <th>Kanta Parchi File</th>
                                    <th>Truck Image</th>
                                    <th>Notes</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                <?php $currentuserid = Auth::user()->id; ?>
                                @foreach($case_gen as $key => $kanta_parchi)
	                                <tr class="gradeX">
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            @if($kanta_parchi->s_k_p_case_id)
                                                <span class="text-navy">Done</span>
                                            @else
                                                @if($kanta_parchi->in_out == 'PASS')
                                                    @if($role_id == 1 || $currentuserid == $kanta_parchi->lead_conv_uid || $role_id == 8)
                                                        <?php
                                                        $check_status = DB::table('apna_case_second_quality_report')->where('case_id', $kanta_parchi->case_id)->first();?>
                                                        @if($check_status)
                                                            <a data-id="{!! $kanta_parchi->case_id !!}" id='{!! $kanta_parchi->cust_fname." ".$kanta_parchi->cust_lname !!}' class="setPrice btn-warning btn btn-xs">Upload Kanta Parchi</a>
                                                        @else
                                                            <span class="text-warning">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">In Process</span>
                                                    @endif
                                                @elseif($kanta_parchi->in_out == 'IN' || $kanta_parchi->in_out == 'OUT')
                                                    @if($role_id == 1 || $role_id == 8 || ($role_id == 7 && $emp_levels->location == $kanta_parchi->terminal_id) || ($role_id == 7 && $emp_levels->level_id < 3))
                                                        <?php
                                                        $check_status = DB::table('apna_case_quality_report')->where('case_id', $kanta_parchi->case_id)->first();
                                                        ?>
                                                        @if($check_status)
                                                            <a data-id="{!! $kanta_parchi->case_id !!}" id='{!! $kanta_parchi->cust_fname." ".$kanta_parchi->cust_lname !!}' class="setPrice btn-warning btn btn-xs">Upload Kanta Parchi</a>
                                                        @else
                                                            <span class="text-warning">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">In Process</span>
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                        <td>{!! $kanta_parchi->case_id !!}</td>
                                        <td>{!! $kanta_parchi->cust_fname." ".$kanta_parchi->cust_lname !!}</td>
                                        <td><b>User : </b>{!! ($kanta_parchi->fpo_user_id)?$kanta_parchi->fpo_user_id:'N/A' !!}<br><b>Gatepass/CDF Name : </b>{!! ($kanta_parchi->gate_pass_cdf_user_name)?$kanta_parchi->gate_pass_cdf_user_name:'N/A' !!}<br><b>Coldwin Name : </b>{!! ($kanta_parchi->coldwin_name)?$kanta_parchi->coldwin_name:'N/A' !!}</td>
                                        <td><b>Purchase Details: </b>{!! ($kanta_parchi->purchase_name)?$kanta_parchi->purchase_name:'N/A' !!}<br><b>Loan Details : </b>{!! ($kanta_parchi->loan_name)?$kanta_parchi->loan_name:'N/A' !!}<br><b>Sale Details : </b>{!! ($kanta_parchi->sale_name)?$kanta_parchi->sale_name:'N/A' !!}</td>
                                        <!-- <td>{!! $kanta_parchi->rst_no !!}</td>
                                        <td>{!! $kanta_parchi->bags !!}</td>
                                        <td>{!! $kanta_parchi->gross_weight !!}</td>
                                        <td>{!! $kanta_parchi->tare_weight !!}</td>
                                        <td>{!! $kanta_parchi->net_weight !!}</td>
                                        <td>{!! $kanta_parchi->gross_date_time !!}</td>
                                        <td>{!! $kanta_parchi->tare_date_time !!}</td>
                                        <td>{!! $kanta_parchi->charges !!}</td>
                                        <td>{!! $kanta_parchi->vehicle_no !!}</td>
                                        <td>{!! $kanta_parchi->kanta_name !!}</td>
                                        <td>{!! $kanta_parchi->kanta_place !!}</td> -->
                                        <td>
                                            @if($kanta_parchi->file)
                                                <a class="view_report" data-id="{{ $kanta_parchi->file }}"><i class="fa fa-eye"></i></a>
                                            @else
                                            @endif
                                        </td>
                                        <td>
                                            @if($kanta_parchi->file_2)
                                                <a class="view_report" data-id="{{ $kanta_parchi->file_2 }}"><i class="fa fa-eye"></i></a>
                                            @else
                                            @endif
                                        </td>
                                        <td>{!! $kanta_parchi->notes !!}</td>
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
                <h4 class="modal-title">Upload Second Kanta Parchi</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-primary col-md-6 p-0">Case ID : <b style="color:green;" id="case_id_val"></b></h4>
                <h4 class="text-primary col-md-6 p-0 text-right">Customer Name : <b style="color:green;" id="cust_name"></b></h4>
                {!! Form::open(array('url' => 'addSecondKantaParchi', 'files' => true, 'class' => "contact_us_form", 'id' => 'empForm')) !!}
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
                           
                            <div class="col-md-4">
                                <div class="col-md-12 p-0">
                                    {!! Form::label('file', 'Kanta Parchi File', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                    {!! Form::file('file', ['class' => 'form-control', 'autocomplete' => 'off', 'accept' => 'image/*', 'capture' => 'capture', 'onchange' => "loadFile(event)", 'required' => 'required']) !!}

                                    @if($errors->has('file'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-12 p-0">
                                    {!! Form::label('truck_image', 'Truck Image File', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                    {!! Form::file('truck_image', ['class' => 'form-control', 'autocomplete' => 'off', 'accept' => 'image/*', 'capture' => 'capture', 'onchange' => "loadFile(event)", 'required' => 'required']) !!}

                                    @if($errors->has('truck_image'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('truck_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
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
                        <div class="col-md-12 m-t-20">
                            <h3 id="file_preview_title" class="hide">File Preview</h3>
                            <object type="" class="hide"  style="width:100%;min-height:450px;" data="" id="file_preview"></object>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- View Report File -->
<div id="viewQualityReport" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Kanta Parchi File</h4>
            </div>
            <div class="modal-body">                
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a class="btn btn-info btn-xd" download id="download_file">Download</a>
                    </div>
                    <div class="col-md-12">
                        <object type=""  style="width:100%;min-height:450px;" data="" id="object_data">
                        </object>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($errors->has('truck_image') || $errors->has('notes') || $errors->has('file') || $errors->has('case_id'))
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
        $('.view_report').on('click', function(){
            var file = $(this).attr('data-id');
            var full_url = "<?= url('/'); ?>/resources/assets/upload/second_kanta_parchi/"+file
            $('#object_data').attr('data', full_url);
            $('#download_file').attr('href', full_url);
            $('#viewQualityReport').modal('show');
        });
        $('.datetimepicker').datetimepicker({
            format: "dd MM yyyy - HH:ii P",
            showMeridian: true,
            autoclose: true,
        });
    });
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha256-yMjaV542P+q1RnH6XByCPDfUFhmOafWbeLPmqKh11zo=" crossorigin="anonymous" />
@endsection
