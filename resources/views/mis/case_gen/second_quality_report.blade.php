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
        <h2>Second Quality Report </h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Second Quality Report </strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
                <div class="ibox-title">
	                <h5>Second Quality Report List</h5>
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
                                    <th>Quality Report</th>
                                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Case_ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th>Customer Name</th>
                                    <th>UserName</th>
                                    <th>&nbsp;&nbsp;&nbsp;Details_in_Tally&nbsp;&nbsp;&nbsp;</th>
                                    <th>Total Weight(Qtl)</th>
                                    <th>Moisture Level(%)</th>
                                    <th>TCW</th>
                                    <th>Broken (BK)</th>
                                    <th>FM Level %</th>
                                    <th>Thin (%)</th>
                                    <th>DeHusk (%)</th>
                                    <th>Discolour (%)</th>
                                    <th>Infested (%)</th>
                                    <th>Live Insects</th>
                                    <th>Report</th>
                                    <th>Notes</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                <?php $currentuserid = Auth::user()->id; ?>
                                @foreach($case_gen as $key => $quality_report)
                                    
	                                <tr class="gradeX">
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            @if($quality_report->s_q_r_case_id)
                                            <span class="text-navy">Done</span>
                                            @else
                                                @if($quality_report->in_out == 'PASS')
                                                    @if($role_id == 1 || $currentuserid == $quality_report->lead_conv_uid || ($role_id == 7 && $emp_levels->location == $quality_report->terminal_id) || ($role_id == 7 && $emp_levels->level_id < 3))
                                                        <?php
                                                            $check_status = DB::table('apna_case_kanta_parchi')->where('case_id', $quality_report->case_id)->first();
                                                        ?>
                                                        @if($check_status)
                                                            <a data-id="{!! $quality_report->case_id !!}" id='{!! $quality_report->cust_fname." ".$quality_report->cust_lname !!}' class="setPrice btn-primary btn btn-xs">Update Quality</a>
                                                        @else
                                                            <span class="text-warning">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">In Process</span>
                                                    @endif
                                                @elseif($quality_report->in_out == 'IN')
                                                    @if($role_id == 1 || $role_id == 8 || ($role_id == 7 && $emp_levels->location == $quality_report->terminal_id) || ($role_id == 7 && $emp_levels->level_id < 3))
                                                        <?php
                                                            $check_status = DB::table('apna_case_second_kanta_parchi')->where('case_id', $quality_report->case_id)->first();
                                                        ?>
                                                        @if($check_status)
                                                            <a data-id="{!! $quality_report->case_id !!}" id='{!! $quality_report->cust_fname." ".$quality_report->cust_lname !!}' class="setPrice btn-primary btn btn-xs">Update Quality</a>
                                                        @else
                                                            <span class="text-warning">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">In Process</span>
                                                    @endif
                                                @elseif( $quality_report->in_out == 'OUT')
                                                    @if($role_id == 1 || $role_id == 8 || ($role_id == 7 && $emp_levels->location == $quality_report->terminal_id) || ($role_id == 7 && $emp_levels->level_id < 3))
                                                        <?php
                                                            $check_status = DB::table('apna_case_kanta_parchi')->where('case_id', $quality_report->case_id)->first();
                                                        ?>
                                                        @if($check_status)
                                                            <a data-id="{!! $quality_report->case_id !!}" id='{!! $quality_report->cust_fname." ".$quality_report->cust_lname !!}' class="setPrice btn-primary btn btn-xs">Update Quality</a>
                                                        @else
                                                            <span class="text-warning">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">In Process</span>
                                                    @endif
                                                @else
                                                @endif
                                            @endif
                                        </td>
                                        <td>{!! $quality_report->case_id !!}</td>
                                        <td>{!! $quality_report->cust_fname." ".$quality_report->cust_lname !!}</td>
                                        <td><b>User : </b>{!! ($quality_report->fpo_user_id)?$quality_report->fpo_user_id:'N/A' !!}<br><b>Gatepass/CDF Name : </b>{!! ($quality_report->gate_pass_cdf_user_name)?$quality_report->gate_pass_cdf_user_name:'N/A' !!}<br><b>Coldwin Name : </b>{!! ($quality_report->coldwin_name)?$quality_report->coldwin_name:'N/A' !!}</td>
                                        <td><b>Purchase Details: </b>{!! ($quality_report->purchase_name)?$quality_report->purchase_name:'N/A' !!}<br><b>Loan Details : </b>{!! ($quality_report->loan_name)?$quality_report->loan_name:'N/A' !!}<br><b>Sale Details : </b>{!! ($quality_report->sale_name)?$quality_report->sale_name:'N/A' !!}</td>
                                        <td>{!! $quality_report->total_weight !!}</td>
                                        <td>{!! $quality_report->moisture_level !!}</td>
                                        <td>{!! $quality_report->thousand_crown_w !!}</td>
                                        <td>{!! $quality_report->broken !!}</td>
                                        <td>{!! $quality_report->foreign_matter !!}</td>
                                        <td>{!! $quality_report->thin !!}</td>
                                        <td>{!! $quality_report->damage !!}</td>
                                        <td>{!! $quality_report->black_smith !!}</td>
                                        <td>{!! $quality_report->infested !!}</td>
                                        <td>{!! $quality_report->live_insects !!}</td>
                                        <td>
                                            @if($quality_report->imge)
                                            <a class="view_report" data-id="{{ $quality_report->imge }}"><i class="fa fa-eye"></i></a>
                                            @else
                                            @endif
                                        </td>
                                        <td>{!! $quality_report->notes !!}</td>
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
                <h4 class="modal-title">Update Quality Report</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-primary col-md-6 p-0">Case ID : <b style="color:green;" id="case_id_val"></b></h4>
                <h4 class="text-primary col-md-6 p-0 text-right">Customer Name : <b style="color:green;" id="cust_name"></b></h4>
                {!! Form::open(array('url' => 'addSecondQualityReport', 'files' => true, 'class' => "contact_us_form", 'id' => 'empForm')) !!}
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
                        <div class="col-md-9">
                            <div class="col-md-4">
                                {!! Form::label('moisture_level', 'Moisture Level(%)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('moisture_level', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Moisture Level(%)']) !!}

                                @if($errors->has('moisture_level'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('moisture_level') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('thousand_crown_w', 'TCW', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::text('thousand_crown_w', '', ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Enter Thousand Crown Weight']) !!}

                                @if($errors->has('thousand_crown_w'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('thousand_crown_w') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('broken', 'Broken (BK)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::text('broken', '', ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Enter Broken']) !!}

                                @if($errors->has('broken'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('broken') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('foreign_matter', 'FM Level %', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::text('foreign_matter', '', ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Foreign Matter (FM Level %)']) !!}

                                @if($errors->has('foreign_matter'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('foreign_matter') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('thin', 'Thin (%)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::text('thin', '', ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Thin (%)']) !!}

                                @if($errors->has('thin'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('thin') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('damage', 'DeHusk (%)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::text('damage', '', ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'DeHusk (%)']) !!}

                                @if($errors->has('damage'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('damage') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('black_smith', 'Discolour (%)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::text('black_smith', '', ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Discolour (%)']) !!}

                                @if($errors->has('black_smith'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('black_smith') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('infested', 'Infested (%)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::text('infested', '', ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Infested (%)']) !!}

                                @if($errors->has('infested'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('infested') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('live_insects', 'Live Insects (In Count)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::text('live_insects', '', ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Live Insects (In Count)']) !!}

                                @if($errors->has('live_insects'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('live_insects') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-12">
                                {!! Form::label('report_file', 'Report File', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::file('report_file', ['class' => 'form-control', 'onchange' => "loadFile(event)", 'autocomplete' => 'off']) !!}

                                @if($errors->has('report_file'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('report_file') }}</strong>
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
                <h4 class="modal-title">Quality Report File</h4>
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


@if($errors->has('price') || $errors->has('processing_fees') || $errors->has('rent') || $errors->has('labour_rate') || $errors->has('interest_rate') || $errors->has('case_id'))
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
            var full_url = "<?= url('/'); ?>/resources/assets/upload/quality_report/"+file
            $('#object_data').attr('data', full_url);
            $('#download_file').attr('href', full_url);
            $('#viewQualityReport').modal('show');
        });
    });
    $(document).ready( function () {
        var table = $('.dataTables-example1').DataTable( {
        pageLength : 3,
        lengthMenu: [[3, 5, 10, 20, -1], [3, 5, 10, 20, 'All']]
      });
    });
</script>
@endsection
