@extends('layouts.auth_app')
@section('content')
<?php
$currentuserid = Auth::user()->id;
$role = DB::table('user_roles')->where('user_id', $currentuserid)->first();
$role_id = $role->role_id;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>Quality Claim </h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Quality Claim </strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
                <div class="ibox-title">
	                <h5>Quality Claim List</h5>
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
                                    <th>Quality Claim</th>
                                    <th>Case ID</th>
                                    <th>Customer Name</th>
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
                                    <th>Quality Discount</th>
                                    <th>Report</th>
                                    <th>Second Report</th>
                                    <th>Notes</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                <?php $currentuserid = Auth::user()->id; ?>
                                @foreach($case_gen as $key => $quality_claim)
	                                <tr class="gradeX">
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            @if($quality_claim->q_c_case_id)
                                                <span class="text-navy">Done</span>
                                            @else
                                                @if($quality_claim->in_out == 'PASS')
                                                    @if($role_id == 1 || $role_id == 8 || $role_id == 9)
                                                        <?php
                                                            $check_status = DB::table('apna_case_shipping_end')->where('case_id', $quality_claim->case_id)->first();
                                                        ?>
                                                        @if($check_status)
                                                            <a data-id="{!! $quality_claim->case_id !!}" id='{!! $quality_claim->cust_fname." ".$quality_claim->cust_lname !!}' class="setPrice btn-primary btn btn-xs">Update Quality</a>
                                                        @else
                                                            <span class="text-warning">Processing...</span>
                                                        @endif
                                                    @else
                                                        <span class="text-navy">In Process</span>
                                                    @endif
                                                @elseif($quality_claim->in_out == 'IN')
                                                    <?php
                                                        $check_status = DB::table('apna_case_e_mandi')->where('case_id', $quality_claim->case_id)->first();
                                                        $check_pricing = DB::table('apna_case_pricing')->where('case_id', $quality_claim->case_id)->first();
                                                    ?>
                                                    @if($check_pricing)
                                                        @if($role_id == 1 || $role_id == 8 || $role_id == 9)
                                                            @if($check_pricing->transaction_type == 'E-Mandi')
                                                                @if($check_status)
                                                                    <a data-id="{!! $quality_claim->case_id !!}" id='{!! $quality_claim->cust_fname." ".$quality_claim->cust_lname !!}' class="setPrice btn-primary btn btn-xs">Update Quality</a>
                                                                @else
                                                                    <span class="text-warning">Processing...</span>
                                                                @endif
                                                            @else
                                                                <?php
                                                                $check_gatepass = DB::table('apna_case_gate_pass')->where('case_id', $quality_claim->case_id)->first();
                                                                ?>
                                                                @if($check_gatepass)
                                                                    <a data-id="{!! $quality_claim->case_id !!}" id='{!! $quality_claim->cust_fname." ".$quality_claim->cust_lname !!}' class="setPrice btn-primary btn btn-xs">Update Quality</a>
                                                                @else
                                                                    <span class="text-warning">Processing...</span>
                                                                @endif
                                                            @endif
                                                        @else
                                                            <span class="text-navy">In Process</span>
                                                        @endif
                                                    @else
                                                        @if($role_id == 1 || $role_id == 8 || $role_id == 7))
                                                            <span class="text-warning">Processing...</span>
                                                        @else
                                                            <span class="text-navy">In Process</span>
                                                        @endif
                                                    @endif
                                                @elseif($quality_claim->in_out == 'OUT')
                                                    @if($role_id == 1 || $role_id == 9)
                                                        <?php
                                                            $check_status = DB::table('apna_case_shipping_end')->where('case_id', $quality_claim->case_id)->first();
                                                        ?>
                                                        @if($check_status)
                                                            <a data-id="{!! $quality_claim->case_id !!}" id='{!! $quality_claim->cust_fname." ".$quality_claim->cust_lname !!}' class="setPrice btn-primary btn btn-xs">Update Quality</a>
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
                                        <td>{!! $quality_claim->case_id !!}</td>
                                        <td>{!! $quality_claim->cust_fname." ".$quality_claim->cust_lname !!}</td>
                                        <td>{!! $quality_claim->total_weight !!}</td>
                                        <td>{!! $quality_claim->moisture_level !!}</td>
                                        <td>{!! $quality_claim->thousand_crown_w !!}</td>
                                        <td>{!! $quality_claim->broken !!}</td>
                                        <td>{!! $quality_claim->foreign_matter !!}</td>
                                        <td>{!! $quality_claim->thin !!}</td>
                                        <td>{!! $quality_claim->damage !!}</td>
                                        <td>{!! $quality_claim->black_smith !!}</td>
                                        <td>{!! $quality_claim->infested !!}</td>
                                        <td>{!! $quality_claim->live_insects !!}</td>
                                        <td>{!! $quality_claim->quality_discount_value !!}</td>
                                        <td>
                                            @if($quality_claim->imge)
                                            <a class="view_report" data-id="{{ $quality_claim->imge }}"><i class="fa fa-eye"></i></a>
                                            @else
                                            @endif
                                        </td>
                                        <td>
                                            @if($quality_claim->imge)
                                            <a class="view_report" data-id="{{ $quality_claim->second_report }}"><i class="fa fa-eye"></i></a>
                                            @else
                                            @endif
                                        </td>
                                        <td>{!! $quality_claim->notes !!}</td>
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
                <h4 class="modal-title">Update Quality Claim</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-primary col-md-6 p-0">Case ID : <b style="color:green;" id="case_id_val"></b></h4>
                <h4 class="text-primary col-md-6 p-0 text-right">Customer Name : <b style="color:green;" id="cust_name"></b></h4>
                {!! Form::open(array('url' => 'addQualityClaim', 'files' => true, 'class' => "contact_us_form", 'id' => 'empForm')) !!}
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
                                {!! Form::number('moisture_level', '', ['class' => 'form-control', 'step' => 'any', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Moisture Level(%)']) !!}

                                @if($errors->has('moisture_level'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('moisture_level') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('thousand_crown_w', 'TCW', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::number('thousand_crown_w', '', ['class' => 'form-control', 'step' => 'any', 'autocomplete' => 'off', 'placeholder' => 'Enter Thousand Crown Weight']) !!}

                                @if($errors->has('thousand_crown_w'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('thousand_crown_w') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('broken', 'Broken (BK)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::number('broken', '', ['class' => 'form-control', 'autocomplete' => 'off', 'step' => 'any', 'placeholder' => 'Enter Broken']) !!}

                                @if($errors->has('broken'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('broken') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('foreign_matter', 'FM Level %', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::number('foreign_matter', '', ['class' => 'form-control', 'step' => 'any', 'autocomplete' => 'off', 'placeholder' => 'Foreign Matter (FM Level %)']) !!}

                                @if($errors->has('foreign_matter'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('foreign_matter') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('thin', 'Thin (%)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::number('thin', '', ['class' => 'form-control', 'autocomplete' => 'off', 'step' => 'any', 'placeholder' => 'Thin (%)']) !!}

                                @if($errors->has('thin'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('thin') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('damage', 'DeHusk (%)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::number('damage', '', ['class' => 'form-control', 'autocomplete' => 'off', 'step' => 'any', 'placeholder' => 'DeHusk (%)']) !!}

                                @if($errors->has('damage'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('damage') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('black_smith', 'Discolour (%)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::number('black_smith', '', ['class' => 'form-control', 'autocomplete' => 'off', 'step' => 'any', 'placeholder' => 'Discolour (%)']) !!}

                                @if($errors->has('black_smith'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('black_smith') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('infested', 'Infested (%)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::number('infested', '', ['class' => 'form-control', 'autocomplete' => 'off', 'step' => 'any', 'placeholder' => 'Infested (%)']) !!}

                                @if($errors->has('infested'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('infested') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('live_insects', 'Live Insects (In Count)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::number('live_insects', '', ['class' => 'form-control', 'step' => 'any', 'autocomplete' => 'off', 'placeholder' => 'Live Insects (In Count)']) !!}

                                @if($errors->has('live_insects'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('live_insects') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('quality_discount_value', 'Quality Discount Value', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::number('quality_discount_value', '', ['class' => 'form-control', 'step'=>'any', 'autocomplete' => 'off', 'placeholder' => 'Quality Discount Value']) !!}

                                @if($errors->has('quality_discount_value'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('quality_discount_value') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('second_report_file', 'Second Report File', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::file('second_report_file', ['class' => 'form-control', 'onchange' => "loadFile(event)", 'autocomplete' => 'off']) !!}

                                @if($errors->has('second_report_file'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('second_report_file') }}</strong>
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

<!-- View Claim File -->
<div id="viewQualityReport" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Quality Claim File</h4>
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


@if($errors->has('second_report_file') || $errors->has('moisture_level') || $errors->has('thousand_crown_w') || $errors->has('broken') || $errors->has('foreign_matter') || $errors->has('thin') || $errors->has('damage') || $errors->has('black_smith') || $errors->has('infested') || $errors->has('live_insects') || $errors->has('quality_discount_value') || $errors->has('report_file') || $errors->has('notes') || $errors->has('case_id'))
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
            var full_url = "<?= url('/'); ?>/resources/assets/upload/quality_claim/"+file
            $('#object_data').attr('data', full_url);
            $('#viewQualityReport').modal('show');
        });
    });
</script>
@endsection
