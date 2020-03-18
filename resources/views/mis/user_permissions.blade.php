@extends('layouts.auth_app')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>All User Permission</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>User Permission</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight" style="padding-bottom: 0px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Set User Permission</h5>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        {!! Form::open(array('url' => 'add_user_permission', 'files' => true, 'class' => "", 'id' => 'empForm')) !!}
                        @csrf
                            
                            <div class="col-md-4">
                                {!! Form::label('user_id', 'Employees', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                                {!! Form::select('user_id', $employees, '', ['class' => 'form-control', 'required' => 'required']); !!}
                                @if($errors->has('user_id'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('permissions', 'Permissions', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span><br>
                                @foreach($permissions as $key => $permission)
                                    <label >{!! Form::checkbox('permissions[]',$permission->id, false, ['class' => '']) !!}  {!! $permission->permission !!} </label> &nbsp;&nbsp;
                                @endforeach
                                @if($errors->has('permissions'))
                                    <span class="text-red" role="alert">
                                        <strong class="red">{{ $errors->first('permissions') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 m-t-25">
                                {!! Form::submit('Set Permission', ['class' => 'btn btn-info m-t-20 form-control b-info']) !!}
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
	                <h5>All User Permissions</h5>
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
                                    <th>Employees</th>
                                    <th>Permissions</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($user_permissions as $key => $lead)
                                    <?php
                                    $permission = json_decode($lead->permission_id);
                                    ?>
	                                <tr class="gradeX">
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $permission[1] }}</td>
                                        
                                        <td>{!! date('d M Y', strtotime($lead->created_at)) !!}</td>
                                        <td>
                                                <span class="text-navy">Not Editable</span>
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

@if($errors->has('edit_first_name') || $errors->has('edit_last_name') || $errors->has('edit_role_id'))
    <script type="text/javascript">
        $(document).ready(function(){
            $('#editLead').modal('show');
        });
    </script>
@endif

<!-- Edit Lead -->
<div id="editLead" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Lead</h4>
            </div>
            <div class="modal-body">                
                <div class="row">
                    {!! Form::open(array('url' => 'update_lead', 'files' => true, 'class' => "", 'id' => 'empForm')) !!}
                        @csrf
                        {{ Form::hidden('id', '', array('id' => 'lead_id')) }}
                        <div class="col-md-4">
                            {!! Form::label('edit_customer_name', 'Customer Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('edit_customer_name', '', ['class' => 'form-control','id' => 'edit_customer_name', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Customer Name']) !!}

                            @if($errors->has('edit_customer_name'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_customer_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_phone', 'Mobile No', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::number('edit_phone', '', ['class' => 'form-control', 'minlength' => 10, 'maxlength' => 10, 'required' => 'required', 'autocomplete' => 'off', 'id' => 'edit_phone', 'placeholder' => 'Mobile No']) !!}

                            @if($errors->has('edit_phone'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_phone') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_quantity', 'Estimated Qty.(Qtl)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('edit_quantity', '', ['class' => 'form-control', 'required' => 'required', 'id' => 'edit_quantity', 'autocomplete' => 'off', 'placeholder' => 'Enter Quantity in Quintal']) !!}

                            @if($errors->has('edit_quantity'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_quantity') }}</strong>
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
                            {!! Form::label('edit_purpose', 'Purpose', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::select('edit_purpose', array('For Sale' => 'For Sale', 'For Storage' => 'For Storage'), '', ['class' => 'form-control', 'id' => 'edit_purpose', 'required' => 'required']); !!}
                            @if($errors->has('edit_purpose'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_purpose') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-12 m-t-25">
                            {!! Form::submit('Update / Save', ['class' => 'btn btn-info m-t-20 form-control b-info']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#addEmp').on('click', function(){
            $('#addEmployee').modal('show');
        });

        //Edit Lead
        $('.edit_lead').on('click', function(){
            var id = $(this).attr('data-id');
            $.ajax({
                method : 'post',
                url: "{{ route('get_lead') }}",
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'id' : id},
                success:function(response)
                {
                    console.log(response);                    
                    var data = JSON.parse(response);
                    $('#edit_customer_name').val(data.customer_name);
                    $('#edit_quantity').val(data.quantity);
                    $('#edit_location').val(data.location);
                    $('#edit_phone').val(data.phone);
                    $('#edit_commodity_id').val(data.commodity_id);
                    $('#edit_terminal_id').val(data.terminal_id);
                    $('#edit_commodity_date').val(data.commodity_date);
                    $('#edit_purpose').val(data.purpose);
                    $('#lead_id').val(data.id);
                    $('#editEmployee').modal('show');
                },
                error: function(data)
                {
                    //console.log(data);
                    alert(data);
                },
            });
            $('#editLead').modal('show');
        });
    });
</script>
@endsection
