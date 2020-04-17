@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Dharam Kanta</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Dharam Kanta</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight" style="padding-bottom: 0px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Dharam Kanta</h5>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        {!! Form::open(array('url' => 'createDharamKanta', 'files' => true, 'class' => "", 'id' => 'empForm')) !!}
                        @csrf
                            
                            <div class="col-md-4">
                                {!! Form::label('name', 'Kanta Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('name', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Kanta Name']) !!}

                                @if($errors->has('name'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="col-md-4">
                                {!! Form::label('operator_name', 'Operator Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('operator_name', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Operator Name']) !!}

                                @if($errors->has('operator_name'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('operator_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('phone', 'Mobile No', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::number('phone', '', ['class' => 'form-control', 'minlength' => 10, 'maxlength' => 10, 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Mobile No']) !!}

                                @if($errors->has('phone'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('location', 'Location', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('location', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Location']) !!}

                                @if($errors->has('location'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('length', 'Length (Meter)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::text('length', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Length']) !!}

                                @if($errors->has('length'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('length') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('capicity', 'Capacity (Ton)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                {!! Form::number('capicity', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Capacity']) !!}

                                @if($errors->has('capicity'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('capicity') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 m-t-25">
                                {!! Form::submit('Add Dharam Kanta', ['class' => 'btn btn-info m-t-20 form-control b-info']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Dharam Kanta</h5>	                
	            </div>

	            <div class="ibox-content">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {!! session('status') !!}
                        </div>
                    @endif

	                <div class="table-responsive">
	                    <table id="inventory_table" class="table table-striped table-bordered table-hover dataTables-example">
	                        <thead>
	                            <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Operator Name</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                    <th>Length (Meter)</th>
                                    <th>Capacity (Ton)</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($dharm_kanta as $key => $kanta)
	                                <tr class="gradeX">
                                        <td>{!! ++$key !!}</td>
                                        <td>{!! $kanta->name !!}</td>
                                        <td>{!! $kanta->operator_name !!}</td>
                                        <td>{!! $kanta->phone !!}</td>
                                        <td>{!! $kanta->location !!}</td>
                                        <td>{!! $kanta->length !!}</td>
                                        <td>{!! $kanta->capicity !!}</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-info btn-xs editDharamKanta" data-id="{!! $kanta->name !!}||{!! $kanta->operator_name !!}||{!! $kanta->phone !!}||{!! $kanta->location !!}||{!! $kanta->length !!}||{!! $kanta->capicity !!}" id="{!! $kanta->id !!}" title="Edit">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <a href="{!! route('deleteDharamKanta', ['id' => $kanta->id]) !!}" onclick="return confirm('Are you sure ? you want to delete this Dharam Kanta?');" class="btn btn-danger btn-xs" title="Delete">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
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

<!-- Add User Employee by Admin -->
<div id="edit_dharam_kanta" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Dharam Kanta</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    {!! Form::open(array('url' => 'editDharamKanta', 'files' => true, 'class' => "")) !!}
                        @csrf
                        {!! Form::hidden('dharam_kanta_id', '', array('id' => 'kanta_id')) !!}
                        <div class="col-md-4">
                            {!! Form::label('edit_name', 'Kanta Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('edit_name', '', ['class' => 'form-control', 'required' => 'required', 'id' => 'edit_name', 'autocomplete' => 'off', 'placeholder' => 'Enter Kanta Name']) !!}

                            @if($errors->has('edit_name'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-4">
                            {!! Form::label('edit_operator_name', 'Operator Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('edit_operator_name', '', ['class' => 'form-control', 'required' => 'required', 'id' => 'edit_operator_name', 'autocomplete' => 'off', 'placeholder' => 'Enter Operator Name']) !!}

                            @if($errors->has('edit_operator_name'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_operator_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_phone', 'Mobile No', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::number('edit_phone', '', ['class' => 'form-control', 'minlength' => 10, 'maxlength' => 10, 'required' => 'required', 'id' => 'edit_phone', 'autocomplete' => 'off', 'placeholder' => 'Mobile No']) !!}

                            @if($errors->has('edit_phone'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_phone') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_location', 'Location', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('edit_location', '', ['class' => 'form-control', 'required' => 'required', 'id' => 'edit_location', 'autocomplete' => 'off', 'placeholder' => 'Enter Location']) !!}

                            @if($errors->has('edit_location'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_location') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_length', 'Length (Meter)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('edit_length', '', ['class' => 'form-control', 'required' => 'required', 'id' => 'edit_length', 'autocomplete' => 'off', 'placeholder' => 'Enter Length']) !!}

                            @if($errors->has('edit_length'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_length') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_capicity', 'Capacity (Ton)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::number('edit_capicity', '', ['class' => 'form-control', 'required' => 'required', 'id' => 'edit_capicity', 'autocomplete' => 'off', 'placeholder' => 'Enter Capacity']) !!}

                            @if($errors->has('edit_capicity'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_capicity') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-12 m-t-25">
                            {!! Form::submit('Update Dharam Kanta', ['class' => 'btn btn-info m-t-20 form-control b-info']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.editDharamKanta').on('click', function(){
            var id = $(this).attr('id');
            var data = $(this).attr('data-id');
            var res = data.split('||');
            $('#kanta_id').val(id);
            $('#edit_name').val(res[0]);
            $('#edit_operator_name').val(res[1]);
            $('#edit_phone').val(res[2]);
            $('#edit_location').val(res[3]);
            $('#edit_length').val(res[4]);
            $('#edit_capicity').val(res[5]);
            $('#edit_dharam_kanta').modal('show');
        });
    });
</script>
@if($errors->has('notes') || $errors->has('report_file') || $errors->has('report_file_2') || $errors->has('case_id'))
    <script type="text/javascript">
        $(document).ready(function(){
            $('#edit_dharam_kanta').modal('show');
        });
    </script>
@endif
@endsection
