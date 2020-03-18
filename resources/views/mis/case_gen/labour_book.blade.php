@extends('layouts.auth_app')
@section('content')
<?php
$currentuserid = Auth::user()->id;
$role = DB::table('user_roles')->where('user_id', $currentuserid)->first();
$role_id = $role->role_id;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>Labour Book </h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Labour Book </strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
                <div class="ibox-title">
	                <h5>Labour Book List</h5>
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
                                    <th>Labour Book</th>
                                    <th>Case ID</th>
                                    <th>Customer Name</th>
                                    <th>UserName</th>
                                    <th>Details in Tally</th>
                                    <th>Labour Contractor</th>
                                    <th>Contractor Phone</th>
                                    <th>Labour Rate / Bag</th>
                                    <th>Total Labour</th>
                                    <th>Location</th>
                                    <th>Booking Date</th>
                                    <th>Total Bags</th>
                                    <th>Notes</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($case_gen as $key => $labour_book)
                                    <?php
                                        $check_status = DB::table('apna_truck_book')->where('case_id', $labour_book->case_id)->first();
                                    ?>
	                                <tr class="gradeX">
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            @if($labour_book->l_b_case_id)
                                                <span class="text-navy">Done</span>
                                            @else
                                                @if($labour_book->in_out == 'IN')
                                                    @if($role_id == 1 || $role_id == 8 || $role_id == 11)
                                                        @if($check_status)
                                                            <a data-id="{!! $labour_book->case_id !!}" id='{!! $labour_book->cust_fname." ".$labour_book->cust_lname !!}' class="setPrice btn-warning btn btn-xs">Upload Labour</a>
                                                        @else
                                                            <span class="text-warning">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">In Process</span>
                                                    @endif
                                                @elseif($labour_book->in_out == 'OUT')
                                                    @if($role_id == 1 || $role_id == 8 || $role_id == 11)
                                                        @if($check_status)
                                                            <a data-id="{!! $labour_book->case_id !!}" id='{!! $labour_book->cust_fname." ".$labour_book->cust_lname !!}' class="setPrice btn-warning btn btn-xs">Upload Labour</a>
                                                        @else
                                                            <span class="text-warning">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">In Process</span>
                                                    @endif
                                                @elseif($labour_book->in_out == 'PASS')
                                                    @if($role_id == 1 || $role_id == 8 || $role_id == 6)
                                                        @if($check_status)
                                                            <a data-id="{!! $labour_book->case_id !!}" id='{!! $labour_book->cust_fname." ".$labour_book->cust_lname !!}' class="setPrice btn-warning btn btn-xs">Upload Labour</a>
                                                        @else
                                                            <span class="text-warning">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">In Process</span>
                                                    @endif
                                                @else
                                                    <span class="text-navy">In Process</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>{!! $labour_book->case_id !!}</td>
                                        <td>{!! $labour_book->cust_fname." ".$labour_book->cust_lname !!}</td>
                                        <td><b>User : </b>{!! ($labour_book->fpo_user_id)?$labour_book->fpo_user_id:'N/A' !!}<br><b>Gatepass/CDF Name : </b>{!! ($labour_book->gate_pass_cdf_user_name)?$labour_book->gate_pass_cdf_user_name:'N/A' !!}<br><b>Coldwin Name : </b>{!! ($labour_book->coldwin_name)?$labour_book->coldwin_name:'N/A' !!}</td>
                                        <td><b>Purchase Details: </b>{!! ($labour_book->purchase_name)?$labour_book->purchase_name:'N/A' !!}<br><b>Loan Details : </b>{!! ($labour_book->loan_name)?$labour_book->loan_name:'N/A' !!}<br><b>Sale Details : </b>{!! ($labour_book->sale_name)?$labour_book->sale_name:'N/A' !!}</td>
                                        <td>{!! $labour_book->labour_contractor !!}</td>
                                        <td>{!! $labour_book->contractor_no !!}</td>
                                        <td>{!! $labour_book->labour_rate_per_bags !!}</td>
                                        <td>{!! $labour_book->total_labour !!}</td>
                                        <td>{!! $labour_book->location !!}</td>
                                        <td>{!! $labour_book->booking_date !!}</td>
                                        <td>{!! $labour_book->total_bags !!}</td>
                                        <td>{!! $labour_book->notes !!}</td>
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
                <h4 class="modal-title">Upload Labour</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-primary col-md-6 p-0">Case ID : <b style="color:green;" id="case_id_val"></b></h4>
                <h4 class="text-primary col-md-6 p-0 text-right">Customer Name : <b style="color:green;" id="cust_name"></b></h4>
                {!! Form::open(array('url' => 'addLabourBook', 'files' => true, 'class' => "contact_us_form", 'id' => 'empForm')) !!}
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
                                {!! Form::label('labour_contractor', 'Labour Contractor', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('labour_contractor', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Labour Contractor']) !!}

                                @if($errors->has('labour_contractor'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('labour_contractor') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('contractor_no', 'Contractor Phone', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('contractor_no', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Contractor Phone No.']) !!}

                                @if($errors->has('contractor_no'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('contractor_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('labour_rate_per_bags', 'Labour Rate Per Bags', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('labour_rate_per_bags', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Labour Rate Per Bags']) !!}

                                @if($errors->has('labour_rate_per_bags'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('labour_rate_per_bags') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('total_labour', 'Total Labour', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('total_labour', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Total No. of Labours']) !!}

                                @if($errors->has('total_labour'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('total_labour') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('location', 'Location', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('location', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Location']) !!}

                                @if($errors->has('location'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('booking_date', 'Booking Date', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('booking_date', '', ['class' => 'form-control datetimepicker disable-cls', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'DD-MM-YYYY']) !!}

                                @if($errors->has('booking_date'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('booking_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 p-0">
                                <div class="col-md-12">
                                    {!! Form::label('total_bags', 'Total Bags', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::text('total_bags', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Total No. of Bags']) !!}

                                    @if($errors->has('total_bags'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('total_bags') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-12 p-t-20">
                                    <input type="checkbox" name="not_required" class="" id="not_required"> Not Required
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
                <h4 class="modal-title">Labour Book File</h4>
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

@if($errors->has('labour_contractor') || $errors->has('contractor_no') || $errors->has('labour_rate_per_bags') || $errors->has('total_labour') || $errors->has('booking_date') || $errors->has('notes') || $errors->has('case_id'))
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
            $('#download_file').attr('href', full_url);
            $('#viewQualityReport').modal('show');
        });
        $('.datetimepicker').datetimepicker({
            minView: 2,
            autoclose: true,
            format: 'd-m-yyyy'
        });

        $('#not_required').on('click', function(){
            if($(this).is(':checked'))
            {
                $('.disable-cls').attr('readonly', 'true');
                $('.disable-cls').removeAttr("required");

            }else{
                $('.disable-cls').removeAttr("readonly");
                $('.disable-cls').attr('required', 'true');
            }
        });

    });
</script>
<link rel="stylesheet" href="{{ asset('resources/assets/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" />
@endsection
