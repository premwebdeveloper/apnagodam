@extends('layouts.auth_app')
@section('content')
<?php
$currentuserid = Auth::user()->id;
$role = DB::table('user_roles')->where('user_id', $currentuserid)->first();
$role_id = $role->role_id;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>Truck Book </h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Truck Book </strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
                <div class="ibox-title">
	                <h5>Truck Book List</h5>
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
                                    <th>Truck Book</th>
                                    <th>Case ID</th>
                                    <th>Customer Name</th>
                                    <th>Transporter</th>
                                    <th>Vehicle No.</th>
                                    <th>Driver Name</th>
                                    <th>Driver Phone No</th>
                                    <th>Transport Rate/KM</th>
                                    <th>Min Weight (Qtl.)</th>
                                    <th>Max Weight (Qtl.)</th>
                                    <th>Turnaround Time</th>
                                    <th>Commodity</th>
                                    <th>Total Weight(Qtl.)</th>
                                    <th>Bags</th>
                                    <!-- <th>Kanta Parchi</th> -->
                                    <th>Gate Pass</th>
                                    <th>Total Trans. Cost</th>
                                    <th>Advance Payment</th>
                                    <th>Start Date Time</th>
                                    <th>End Date Time</th>
                                    <th>Settlement Amount</th>
                                    <th>Notes</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($case_gen as $key => $truck_book)
	                                <tr class="gradeX">
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            @if($truck_book->notes)
                                                <span class="text-navy">Done</span>
                                            @else
                                                @if($truck_book->in_out == 'PASS')
                                                    @if($role_id == 1 || $role_id == 8 || $role_id == 6)
                                                        <?php
                                                        $check_status = DB::table('apna_case_pricing')->where('case_id', $truck_book->case_id)->first();
                                                        ?>
                                                        @if($check_status)
                                                            <a data-id="{!! $truck_book->case_id !!}" id='{!! $truck_book->cust_fname." ".$truck_book->cust_lname !!}' class="setPrice btn-warning btn btn-xs">Upload Details</a>
                                                        @else
                                                            <span class="text-navy">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">In Proces</span>
                                                    @endif
                                                @elseif($truck_book->in_out == 'OUT')
                                                    @if($role_id == 1 || $role_id == 8 || $role_id == 11)
                                                        <?php
                                                        $check_status = DB::table('apna_case_delivery_order')->where('case_id', $truck_book->case_id)->first();
                                                        ?>
                                                        @if($check_status)
                                                            <a data-id="{!! $truck_book->case_id !!}" id='{!! $truck_book->cust_fname." ".$truck_book->cust_lname !!}' class="setPrice btn-warning btn btn-xs">Upload Details</a>
                                                        @else
                                                            <span class="text-navy">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">In Process</span>
                                                    @endif
                                                @elseif($truck_book->in_out == 'IN')
                                                    @if($role_id == 1 || $role_id == 8 || $role_id == 11)
                                                        <?php
                                                        $check_status = DB::table('apna_case_pricing')->where('case_id', $truck_book->case_id)->first();
                                                        ?>
                                                        @if($check_status)
                                                            <a data-id="{!! $truck_book->case_id !!}" id='{!! $truck_book->cust_fname." ".$truck_book->cust_lname !!}' class="setPrice btn-warning btn btn-xs">Upload Details</a>
                                                        @else
                                                            <span class="text-navy">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">In Process</span>
                                                    @endif
                                                @else
                                                    <span class="text-navy">In Process</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>{!! $truck_book->case_id !!}</td>
                                        <td>{!! $truck_book->cust_fname." ".$truck_book->cust_lname !!}</td>
                                        <td>{!! $truck_book->transporter !!}</td>
                                        <td>{!! $truck_book->vehicle !!}</td>
                                        <td>{!! $truck_book->driver_name !!}</td>
                                        <td>{!! $truck_book->driver_phone !!}</td>
                                        <td>{!! $truck_book->rate_per_km !!}</td>
                                        <td>{!! $truck_book->min_weight !!}</td>
                                        <td>{!! $truck_book->max_weight !!}</td>
                                        <td>{!! $truck_book->turnaround_time !!}</td>
                                        <td>{!! $truck_book->commodity_id !!}</td>
                                        <td>{!! $truck_book->total_weight !!}</td>
                                        <td>{!! $truck_book->no_of_bags !!}</td>
                                        <!-- <td>{!! $truck_book->kanta_parchi_no !!}</td> -->
                                        <td>{!! $truck_book->gate_pass_no !!}</td>
                                        <td>{!! $truck_book->total_transport_cost !!}</td>
                                        <td>{!! $truck_book->advance_payment !!}</td>
                                        <td>{!! $truck_book->start_date_time !!}</td>
                                        <td>{!! $truck_book->end_date_time !!}</td>
                                        <td>{!! $truck_book->final_settlement_amount !!}</td>
                                        <td>{!! $truck_book->notes !!}</td>
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
                <h4 class="modal-title">Upload Truck Book</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-primary col-md-6 p-0">Case ID : <b style="color:green;" id="case_id_val"></b></h4>
                <h4 class="text-primary col-md-6 p-0 text-right">Customer Name : <b style="color:green;" id="cust_name"></b></h4>
                {!! Form::open(array('url' => 'addTruckBook', 'files' => true, 'class' => "contact_us_form", 'id' => 'empForm')) !!}
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
                                {!! Form::label('transporter', 'Transporter', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('transporter', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Transporter']) !!}

                                @if($errors->has('transporter'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('transporter') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('vehicle', 'Vehicle No.', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('vehicle', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Vehicle No.']) !!}

                                @if($errors->has('vehicle'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('vehicle') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('driver_name', 'Driver Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('driver_name', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Driver Name']) !!}

                                @if($errors->has('driver_name'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('driver_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('driver_phone', 'Driver Phone', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('driver_phone', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Driver Phone']) !!}

                                @if($errors->has('driver_phone'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('driver_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('rate_per_km', 'Tansport Rate/KM', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('rate_per_km', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Tansport Rate/KM']) !!}

                                @if($errors->has('rate_per_km'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('rate_per_km') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('min_weight', 'Min Weight(Qtl.)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('min_weight', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Min Weight(Qtl.)']) !!}

                                @if($errors->has('min_weight'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('min_weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('max_weight', 'Max Weight(Qtl.)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('max_weight', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Max Weight(Qtl.)']) !!}

                                @if($errors->has('max_weight'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('max_weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('turnaround_time', 'Turnaround Time (In Hours)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('turnaround_time', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Turnaround Time']) !!}

                                @if($errors->has('turnaround_time'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('turnaround_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('total_weight', 'Total Weight (Qtl.)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('total_weight', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Total Weight']) !!}

                                @if($errors->has('total_weight'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('total_weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('no_of_bags', 'No of Bags', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('no_of_bags', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter No of Bags']) !!}

                                @if($errors->has('no_of_bags'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('no_of_bags') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('advance_payment', 'Advance Payment (INR)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('advance_payment', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Advance Payment']) !!}

                                @if($errors->has('advance_payment'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('advance_payment') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- <div class="col-md-4">
                                {!! Form::label('kanta_parchi_no', 'Kanta Parchi No.', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('kanta_parchi_no', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Kanta Parchi No.']) !!}
                            
                                @if($errors->has('kanta_parchi_no'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('kanta_parchi_no') }}</strong>
                                    </span>
                                @endif
                            </div> -->
                            <div class="col-md-4">
                                {!! Form::label('total_transport_cost', 'Total Transport Cost (INR)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('total_transport_cost', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Total Transport Cost']) !!}

                                @if($errors->has('total_transport_cost'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('total_transport_cost') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="col-md-8 p-0">
                                <div class="col-md-6">
                                    {!! Form::label('start_date_time', 'Start Date Time', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::text('start_date_time', '', ['class' => 'form-control datetimepicker disable-cls', 'required' => 'required', 'placeholder' => 'Start Date Time', 'autocomplete' => 'off']) !!}

                                    @if($errors->has('start_date_time'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('start_date_time') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    {!! Form::label('end_date_time', 'End Date Time', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::text('end_date_time', '',['class' => 'form-control datetimepicker disable-cls', 'placeholder' => 'End Date Time', 'required' => 'required', 'autocomplete' => 'off']) !!}

                                    @if($errors->has('end_date_time'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('end_date_time') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                
                                <div class="col-md-6">
                                    {!! Form::label('final_settlement_amount', 'Final Settlement Amount (INR)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::text('final_settlement_amount', '', ['class' => 'disable-cls form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Final Settlement Amount']) !!}

                                    @if($errors->has('final_settlement_amount'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('final_settlement_amount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6 p-t-40 m-t-10">
                                    <input type="checkbox" name="not_required" class="" id="not_required"> Not Required
                                </div>
                            </div>
                            <div class="col-md-4">
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

@if($errors->has('transporter') || $errors->has('vehicle') || $errors->has('driver_name') || $errors->has('driver_phone') || $errors->has('rate_per_km') || $errors->has('min_weight') || $errors->has('max_weight') || $errors->has('turnaround_time') || $errors->has('total_weight') || $errors->has('no_of_bags') || $errors->has('notes') || $errors->has('total_transport_cost') || $errors->has('advance_payment') || $errors->has('start_date_time') || $errors->has('final_settlement_amount') || $errors->has('end_date_time') || $errors->has('case_id'))
    <script type="text/javascript">
        $(document).ready(function(){
            $('#setCasePrice').modal('show');
        });
    </script>
@endif

<script type="text/javascript">
    $(document).ready(function(){
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
<link rel="stylesheet" href="{{ asset('resources/assets/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" />
@endsection
