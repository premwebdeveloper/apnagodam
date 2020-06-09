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
        <h2>GRN </h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>GRN </strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
                <div class="ibox-title">
	                <h5>GRN List</h5>
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
	                    <table class="table table-striped table-bordered table-hover dataTables-example1">
	                        <thead>
	                            <tr>
                                    <th>#</th>
                                    <th>GRN</th>
                                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Case_ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th>Customer Name</th>
                                    <th>UserName</th>
                                    <th>&nbsp;&nbsp;&nbsp;Details_in_Tally&nbsp;&nbsp;&nbsp;</th>
                                    <th>No. of Bags</th>
                                    <th>Total. Weight (Qtl)</th>
                                    <th>IN Case Id</th>
                                    <th>Other</th>
                                    <th>GRN File</th>
                                    <th>Notes</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                <?php $currentuserid = Auth::user()->id; ?>
                                @foreach($case_gen as $key => $pricing)
                                    @if($pricing->in_out == 'PASS')
    	                                <tr class="gradeX">
                                            <td>{{ ++$key }}</td>
                                            <td>
                                                @if($pricing->g_p_case_id)
                                                    <span class="text-navy">Done</span>
                                                @else
                                                    <?php
                                                    $check_status = DB::table('apna_case_shipping_end')->where('case_id', $pricing->case_id)->first();
                                                    ?>

                                                    @if($role_id == 1 || $role_id == 8 || ($role_id == 6 && $currentuserid == $pricing->lead_conv_uid))

                                                        @if($check_status)
                                                            <a data-id="{!! $pricing->case_id !!}----{!! $pricing->customer_uid !!}" id='{!! $pricing->cust_fname." ".$pricing->cust_lname !!}' class="setPrice btn-warning btn btn-xs">Update GRN</a>
                                                        @else
                                                            <span class="text-warning">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">In Process</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{!! $pricing->case_id !!}</td>
                                            <td>{!! $pricing->cust_fname." ".$pricing->cust_lname !!}</td>
                                            <td><b>User : </b>{!! ($pricing->fpo_user_id)?$pricing->fpo_user_id:'N/A' !!}<br><b>Gatepass/CDF Name : </b>{!! ($pricing->gate_pass_cdf_user_name)?$pricing->gate_pass_cdf_user_name:'N/A' !!}<br><b>Coldwin Name : </b>{!! ($pricing->coldwin_name)?$pricing->coldwin_name:'N/A' !!}</td>
                                            <td><b>Purchase Details: </b>{!! ($pricing->purchase_name)?$pricing->purchase_name:'N/A' !!}<br><b>Loan Details : </b>{!! ($pricing->loan_name)?$pricing->loan_name:'N/A' !!}<br><b>Sale Details : </b>{!! ($pricing->sale_name)?$pricing->sale_name:'N/A' !!}</td>
                                           <td>{!! $pricing->no_of_bags !!}</td>
                                           <td>{!! $pricing->grn_weight !!}</td>
                                           <td>{!! $pricing->in_case_id !!}</td>
                                           <td>{!! $pricing->other !!}</td>
                                           
                                            <td>
                                                @if($pricing->file)
                                                    <a class="view_report" data-id="{{ $pricing->file }}"><i class="fa fa-eye"></i></a>
                                                @else
                                                @endif
                                            </td>
                                            <td>{!! $pricing->notes !!}</td>
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
                <h4 class="modal-title">Upload GRN</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-primary col-md-6 p-0">Case ID : <b style="color:green;" id="case_id_val"></b></h4>
                <h4 class="text-primary col-md-6 p-0 text-right">Customer Name : <b style="color:green;" id="cust_name"></b></h4>
                {!! Form::open(array('url' => 'addGrn', 'files' => true, 'class' => "contact_us_form", 'id' => 'empForm')) !!}
                    @csrf
                    {!! Form::hidden('customer_user_id', '', array('id' => 'customer_user_id')) !!}
                    {!! Form::hidden('inv_id', '', array('id' => 'inv_id')) !!}
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
                                {!! Form::label('report_file', 'GRN File', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::file('report_file', ['class' => 'form-control', 'onchange' => "loadFile(event)", 'capture' => 'capture', 'autocomplete' => 'off']) !!}

                                @if($errors->has('report_file'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('report_file') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('no_of_bags', 'Number of Bags', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('no_of_bags', '', ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Enter Number of Bags', 'required' => 'required']) !!}

                                @if($errors->has('no_of_bags'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('no_of_bags') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('weight', 'Actual Weight(Qtl.)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('weight', '', ['class' => 'form-control actual_weight', 'autocomplete' => 'off', 'placeholder' => 'Enter Actual Weight', 'required' => 'required']) !!}

                                @if($errors->has('weight'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 grn_weight hide">
                                {!! Form::label('in_case_id', 'IN Case Id', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('in_case_id', '', ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Enter IN Case Id', 'required' => 'required']) !!}

                                @if($errors->has('in_case_id'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('in_case_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-8 grn_weight hide">
                                {!! Form::label('other_remark', 'Other (Remark)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('other_remark', '', ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Remark', 'required' => 'required']) !!}

                                @if($errors->has('other_remark'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('other_remark') }}</strong>
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
                            {!! Form::submit('Save', ['class' => 'btn btn-info m-t-20 form-control b-info']) !!}
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
                <h4 class="modal-title">GRN File</h4>
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


@if($errors->has('weight') || $errors->has('notes') || $errors->has('report_file') || $errors->has('case_id'))
    <script type="text/javascript">
        $(document).ready(function(){
            $('#setCasePrice').modal('show');
        });
    </script>
@endif

<script type="text/javascript">
    $(document).ready(function(){
        $('.actual_weight').on('input', function(){
            var weight = $(this).val();
            var case_id = $('#hidden_case_id').val();
            var user_id = $('#customer_user_id').val();

            //Check Weight from Main Weight
            $.ajax({
                method : 'post',
                url: "{{ route('check_grn_weight') }}",
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'case_id' : case_id, 'weight' : weight, 'user_id' : user_id},
                success:function(response)
                {
                    console.log(response);
                    var res = JSON.parse(response);
                    if(res.status == 1){
                        $('.grn_weight').removeClass('hide');    
                        $('.grn_weight').show();
                    }else{
                        $('.grn_weight').hide();
                    }
                    $('#inv_id').val(res.inventory_id);
                }
            });

        });
        $('.setPrice').on('click', function(){
            var data_id = $(this).attr('data-id');
            var name = $(this).attr('id');
            var temp = data_id.split('----');
            var case_id = temp[0];
            var user_id = temp[1];

            $('#case_id_val').html(case_id);
            $('#hidden_case_id').val(case_id);
            $('#customer_user_id').val(user_id);
            $('#cust_name').html(name);
            $('#setCasePrice').modal('show');
        });

        $('.view_report').on('click', function(){
            var file = $(this).attr('data-id');
            var full_url = "<?= url('/'); ?>/resources/assets/upload/grn/"+file
            $('#object_data').attr('data', full_url);
            $('#download_file').attr('href', full_url);
            $('#viewQualityReport').modal('show');
        });

        var table = $('.dataTables-example1').DataTable( {
            pageLength : 3,
            lengthMenu: [[3, 5, 10, 20, -1], [3, 5, 10, 20, 'All']]
        });
    });
</script>
@endsection
