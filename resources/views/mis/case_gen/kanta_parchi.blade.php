@extends('layouts.auth_app')
@section('content')
<?php
$currentuserid = Auth::user()->id;
$role = DB::table('user_roles')->where('user_id', $currentuserid)->first();
$role_id = $role->role_id;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>Kanta Parchi </h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Kanta Parchi </strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
                <div class="ibox-title">
	                <h5>Kanta Parchi List</h5>
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
                                    <!-- <th>RST. No.</th>
                                    <th>Bags</th>
                                    <th>Gross Weight</th>
                                    <th>Tare Weight</th>
                                    <th>Net Weight</th>
                                    <th>Gross Date Time</th>
                                    <th>Tare Date Time</th>
                                    <th>Charges</th>
                                    <th>Vehicle No.</th>
                                    <th>Kanta Name</th>
                                    <th>Kanta Location</th> -->
                                    <th>Kanta Parchi File</th>
                                    <th>Notes</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                <?php $currentuserid = Auth::user()->id; ?>
                                @foreach($case_gen as $key => $kanta_parchi)
                                    <?php
                                        $check_status = DB::table('apna_labour_book')->where('case_id', $kanta_parchi->case_id)->first();
                                    ?>
	                                <tr class="gradeX">
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            @if($kanta_parchi->k_p_case_id)
                                                <span class="text-navy">Done</span>
                                            @else
                                                @if($kanta_parchi->in_out == 'PASS')
                                                    @if($role_id == 1 || $role_id == 6 || $role_id == 8)
                                                        @if(($check_status) && ($role_id == 1 || $role_id == 8 || $role_id == 6))
                                                            <a data-id="{!! $kanta_parchi->case_id !!}" id='{!! $kanta_parchi->cust_fname." ".$kanta_parchi->cust_lname !!}' class="setPrice btn-warning btn btn-xs">Upload Kanta Parchi</a>
                                                        @else
                                                            <span class="text-warning">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">In Process</span>
                                                    @endif
                                                @elseif($kanta_parchi->in_out == 'OUT')
                                                     @if($role_id == 1 || $role_id == 7 || $role_id == 8)
                                                        @if($check_status)
                                                            <a data-id="{!! $kanta_parchi->case_id !!}" id='{!! $kanta_parchi->cust_fname." ".$kanta_parchi->cust_lname !!}' class="setPrice btn-warning btn btn-xs">Upload Kanta Parchi</a>
                                                        @else
                                                            <span class="text-warning">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">In Process</span>
                                                    @endif
                                                @elseif($kanta_parchi->in_out == 'IN')
                                                     @if($role_id == 1 || $role_id == 7 || $role_id == 8)
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
                <h4 class="modal-title">Upload Kanta Parchi</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-primary col-md-6 p-0">Case ID : <b style="color:green;" id="case_id_val"></b></h4>
                <h4 class="text-primary col-md-6 p-0 text-right">Customer Name : <b style="color:green;" id="cust_name"></b></h4>
                {!! Form::open(array('url' => 'addKantaParchi', 'files' => true, 'class' => "contact_us_form", 'id' => 'empForm')) !!}
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
                            <!-- <div class="col-md-4">
                                {!! Form::label('rst_no', 'RST No.', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('rst_no', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter RST No.']) !!}
                            
                                @if($errors->has('rst_no'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('rst_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('bags', 'Bags', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('bags', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Number of Bags']) !!}
                            
                                @if($errors->has('bags'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('bags') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('kanta_name', 'Kanta Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('kanta_name', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Kanta Name']) !!}
                            
                                @if($errors->has('kanta_name'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('kanta_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('kanta_place', 'Kanta Location', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('kanta_place', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Kanta Location (City Name)']) !!}
                            
                                @if($errors->has('kanta_place'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('kanta_place') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('gross_weight', 'Gross Weight', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('gross_weight', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Gross Weight']) !!}
                            
                                @if($errors->has('gross_weight'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('gross_weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('tare_weight', 'Tare Weight', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('tare_weight', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Tare Weight']) !!}
                            
                                @if($errors->has('tare_weight'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('tare_weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('net_weight', 'Net Weight', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('net_weight', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Net Weight']) !!}
                            
                                @if($errors->has('net_weight'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('net_weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('gross_date_time', 'Gross Date Time', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('gross_date_time', '', ['class' => 'form-control datetimepicker', 'required' => 'required', 'autocomplete' => 'off']) !!}
                            
                                @if($errors->has('gross_date_time'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('gross_date_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('tare_date_time', 'Tare Date Time', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('tare_date_time', '',['class' => 'form-control datetimepicker', 'required' => 'required', 'autocomplete' => 'off']) !!}
                            
                                @if($errors->has('tare_date_time'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('tare_date_time') }}</strong>
                                    </span>
                                @endif
                            </div> -->
                            
                            <div class="col-md-4">
                                <!-- <div class="col-md-12 p-0">
                                    {!! Form::label('charges', 'Charges', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::text('charges', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Charges in Rs.']) !!}
                                
                                    @if($errors->has('charges'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('charges') }}</strong>
                                        </span>
                                    @endif
                                </div> -->
                                <div class="col-md-12 p-0">
                                    {!! Form::label('report_file', 'Kanta Parchi File', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::file('report_file', ['class' => 'form-control', 'autocomplete' => 'off', 'onchange' => "loadFile(event)", 'required' => 'required']) !!}

                                    @if($errors->has('report_file'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('report_file') }}</strong>
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
                    <div class="col-md-12">
                        <object type=""  style="width:100%;min-height:450px;" data="" id="object_data">
                        </object>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($errors->has('rst_no') || $errors->has('bags') || $errors->has('gross_weight') || $errors->has('tare_weight') || $errors->has('net_weight') || $errors->has('gross_date_time') || $errors->has('tare_date_time') || $errors->has('charges') || $errors->has('kanta_name') || $errors->has('kanta_place') || $errors->has('notes') || $errors->has('file') || $errors->has('case_id'))
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
            var full_url = "<?= url('/'); ?>/resources/assets/upload/kanta_parchi/"+file
            $('#object_data').attr('data', full_url);
            $('#viewQualityReport').modal('show');
        });
        $('.datetimepicker').datetimepicker();
    });
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha256-yMjaV542P+q1RnH6XByCPDfUFhmOafWbeLPmqKh11zo=" crossorigin="anonymous" />
@endsection
