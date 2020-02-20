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
                                            @if($labour_book->labour_contractor)
                                                <span class="text-navy">Done</span>
                                            @else
                                                @if($role_id == 1 || $role_id == 8 || $role_id == 11)
                                                    @if($check_status)
                                                        <a data-id="{!! $labour_book->case_id !!}" id='{!! $labour_book->cust_fname." ".$labour_book->cust_lname !!}' class="setPrice btn-warning btn btn-xs">Upload Labour</a>
                                                    @else
                                                        <span class="text-navy">Processing...</span>
                                                    @endif
                                                @else
                                                    <span class="text-navy">In Process</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>{!! $labour_book->case_id !!}</td>
                                        <td>{!! $labour_book->cust_fname." ".$labour_book->cust_lname !!}</td>
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
                    {!! Form::hidden('case_id', '',array('id' => 'hidden_case_id')) !!}
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                {!! Form::label('labour_contractor', 'Labour Contractor', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('labour_contractor', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Labour Contractor']) !!}

                                @if($errors->has('labour_contractor'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('labour_contractor') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('contractor_no', 'Contractor Phone', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('contractor_no', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Contractor Phone No.']) !!}

                                @if($errors->has('contractor_no'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('contractor_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('labour_rate_per_bags', 'Labour Rate Per Bags', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('labour_rate_per_bags', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Labour Rate Per Bags']) !!}

                                @if($errors->has('labour_rate_per_bags'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('labour_rate_per_bags') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('total_labour', 'Total Labour', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('total_labour', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Total No. of Labours']) !!}

                                @if($errors->has('total_labour'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('total_labour') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('location', 'Location', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('location', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Location']) !!}

                                @if($errors->has('location'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('booking_date', 'Booking Date', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::date('booking_date', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Booking Date']) !!}

                                @if($errors->has('booking_date'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('booking_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('total_bags', 'Total Bags', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('total_bags', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Total No. of Bags']) !!}

                                @if($errors->has('total_bags'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('total_bags') }}</strong>
                                    </span>
                                @endif
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
                <h4 class="modal-title">Quality Report File</h4>
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

@if($errors->has('rst_no') || $errors->has('bags') || $errors->has('gross_weight') || $errors->has('tare_weight') || $errors->has('net_weight') || $errors->has('gross_date_time') || $errors->has('tare_date_time') || $errors->has('charges') || $errors->has('kanta_name') || $errors->has('kanta_place') || $errors->has('notes') || $errors->has('file'))
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
