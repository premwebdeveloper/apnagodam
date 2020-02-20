@extends('layouts.auth_app')
@section('content')
<?php
$currentuserid = Auth::user()->id;
$role = DB::table('user_roles')->where('user_id', $currentuserid)->first();
$role_id = $role->role_id;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>Accounts </h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Accounts </strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">
                <div class="ibox-title">
	                <h5>Accounts</h5>
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
                                    <th>Accounts</th>
                                    <th>Case ID</th>
                                    <th>Customer Name</th>
                                    <th>Phone</th>
                                    <th>Vikray Parchi</th>
                                    <th>Inventory</th>
                                    <th>Tally Updation</th>
                                    <th>Cold Win Entry</th>
                                    <th>WHS Issuation</th>
                                    <th>Notes</th>
                                    <th>Done By</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($case_gen as $key => $accounts)
                                    <?php
                                    //If First Quality Report Update or not
                                    $res = DB::table('apna_case_gate_pass')->where('case_id', $accounts->case_id)->first();

                                    $check_status = DB::table('apna_case_pricing')->where('case_id', $accounts->case_id)->first();

                                    $check_emandi = DB::table('apna_case_e_mandi')->where('case_id', $accounts->case_id)->first();
                                    ?>
	                                <tr class="gradeX">
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            @if($accounts->vikray_parchi)
                                                <span class="text-navy">Done</span>
                                            @else
                                                @if($role_id == 1 || $role_id == 3 || $role_id == 8)
                                                    @if($accounts->in_out == 'PASS')
                                                        @if($check_status)
                                                            @if($check_status->transaction_type == 'E-Mandi')
                                                                @if($check_emandi)
                                                                    <a data-id="{!! $accounts->case_id !!}" id='{!! $accounts->cust_fname." ".$accounts->cust_lname !!}' class="setPrice btn-primary btn btn-xs">Update Accounts</a>
                                                                @else
                                                                    <span class="text-navy">Processing...</span>
                                                                @endif
                                                            @else
                                                                <span class="text-navy">Processing...</span>
                                                            @endif
                                                        @else
                                                            <span class="text-navy">Processing...</span>
                                                        @endif
                                                    @elseif($accounts->in_out == 'IN')
                                                        <?php
                                                        $check_emandi = DB::table('apna_case_cdf')->where('case_id', $accounts->case_id)->first();
                                                        ?>
                                                        @if($check_status)
                                                            @if($check_status->transaction_type == 'E-Mandi')
                                                                @if($check_emandi)
                                                                    <a data-id="{!! $accounts->case_id !!}" id='{!! $accounts->cust_fname." ".$accounts->cust_lname !!}' class="setPrice btn-primary btn btn-xs">Update Accounts</a>
                                                                @else
                                                                    <span class="text-navy">Processing...</span>
                                                                @endif
                                                            @else
                                                                <span class="text-navy">Processing...</span>
                                                            @endif
                                                        @else
                                                            <span class="text-navy">Processing...</span>
                                                        @endif
                                                    
                                                    @elseif($accounts->in_out == 'OUT')
                                                        <?php
                                                        $check_emandi = DB::table('apna_case_commodity_withdrawal')->where('case_id', $accounts->case_id)->first();
                                                        ?>
                                                        @if($check_status)
                                                            @if($check_status->transaction_type == 'E-Mandi')
                                                                @if($check_emandi)
                                                                    <a data-id="{!! $accounts->case_id !!}" id='{!! $accounts->cust_fname." ".$accounts->cust_lname !!}' class="setPrice btn-primary btn btn-xs">Update Accounts</a>
                                                                @else
                                                                    <span class="text-navy">Processing...</span>
                                                                @endif
                                                            @else
                                                                <span class="text-navy">Processing...</span>
                                                            @endif
                                                        @else
                                                            <span class="text-navy">Processing...</span>
                                                        @endif
                                                    @endif
                                                @else
                                                    <span class="text-navy">In Process</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>{!! $accounts->case_id !!}</td>
                                        <td>{!! $accounts->cust_fname." ".$accounts->cust_lname !!}</td>
                                        <td>{!! $accounts->phone !!}</td>
                                        <td>{!! $accounts->vikray_parchi !!}</td>
                                        <td>{!! $accounts->inventory !!}</td>
                                        <td>{!! $accounts->tally_updation !!}</td>
                                        <td>{!! $accounts->cold_win_entry !!}</td>
                                        <td>{!! $accounts->whs_issulation !!}</td>
                                        <td>{!! $accounts->notes !!}</td>
                                        <td>{!! $accounts->user_fname." ".$accounts->user_lname !!}</td>
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
                <h4 class="modal-title">Set Price</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-primary col-md-6 p-0">Case ID : <b style="color:green;" id="case_id_val"></b></h4>
                <h4 class="text-primary col-md-6 p-0 text-right">Customer Name : <b style="color:green;" id="cust_name"></b></h4>
                {!! Form::open(array('url' => 'addAccounts', 'files' => true, 'class' => "contact_us_form", 'id' => 'empForm')) !!}
                {!! Form::hidden('case_id', '',array('id' => 'hidden_case_id')) !!}
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-9 p-0">
                            <div class="col-md-6">
                                {!! Form::label('vikray_parchi', 'Vikray Parchi', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::select('vikray_parchi', array('' => 'Select', 'Yes' => 'Yes', 'No' => 'No'), '', ['class' => 'form-control', 'required' => 'required', 'id' => '']); !!}

                                @if($errors->has('vikray_parchi'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('vikray_parchi') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('tally_updation', 'Tally Updation', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::select('tally_updation', array('' => 'Select', 'Yes' => 'Yes', 'No' => 'No'), '', ['class' => 'form-control', 'required' => 'required', 'id' => '']); !!}

                                @if($errors->has('tally_updation'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('tally_updation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('cold_win_entry', 'Coldwin Entry', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::select('cold_win_entry', array('' => 'Select', 'Yes' => 'Yes', 'No' => 'No'), '', ['class' => 'form-control', 'required' => 'required', 'id' => '']); !!}

                                @if($errors->has('cold_win_entry'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('cold_win_entry') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('whs_issulation', 'WHS Issuation', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::select('whs_issulation', array('' => 'Select', 'Yes' => 'Yes', 'No' => 'No'), '', ['class' => 'form-control', 'required' => 'required', 'id' => '']); !!}

                                @if($errors->has('whs_issulation'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('whs_issulation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('inventory', 'Inventory', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::select('inventory', array('' => 'Select', 'Yes' => 'Yes', 'No' => 'No'), '', ['class' => 'form-control', 'required' => 'required', 'id' => '']); !!}

                                @if($errors->has('inventory'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('inventory') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('notes', 'Notes', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                            {!! Form::textarea('notes', '', ['class' => 'form-control', 'autocomplete' => 'off', 'rows' => '5', 'placeholder' => 'Enter Notes']) !!}

                            @if($errors->has('notes'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('notes') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-info m-t-20 form-control b-info']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


@if($errors->has('vikray_parchi') || $errors->has('tally_updation') || $errors->has('cold_win_entry') || $errors->has('whs_issulation'))
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
    });
</script>
@endsection
