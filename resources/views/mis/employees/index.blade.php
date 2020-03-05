@extends('layouts.auth_app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>All Employees</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Employees</strong>
            </li>
        </ol>
    </div>
	<div class="col-lg-6 text-right p-t-30">
        <a href="javascript:;" class="btn btn-info" id="addEmp">Add Employees</a>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Employees</h5>
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
                                    <th>Emp ID</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Designation</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($employees as $key => $user)
	                                <tr class="gradeX">
                                        <td>{{ ++$key }}</td>
                                        <td>{!! $user->emp_id !!}</td>
                                        <td>{!! $user->first_name ." ". $user->last_name !!}</td>
                                        <td>{!! $user->role !!}</td>
                                        <td>{!! $user->designation !!}</td>
                                        <td>{!! $user->email !!}</td>
                                        <td>{!! $user->phone !!}</td>
                                        <td>
                                            <a href="javascript:;" data-id="{{ $user->user_id }}" class="btn btn-info btn-xs editEmp" title="Edit">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <a href="{!! route('deleteEmployee', ['user_id' => $user->user_id]) !!}" class="btn btn-danger btn-xs" data-toggle="confirmation" data-placement="bottom" title="Delete Employee">
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
<div id="editEmployee" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Employee</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => 'updateEmployee', 'files' => true, 'class' => "contact_us_form", 'id' => 'empForm')) !!}
                    @csrf
                    {!! Form::hidden('user_id', '', array('id' => 'edit_user_id')) !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('edit_first_name', 'First Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('edit_first_name', '', ['class' => 'form-control', 'id' => 'edit_first_name', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter First Name']) !!}

                            @if($errors->has('edit_first_name'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('edit_last_name', 'Last Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('edit_last_name', '', ['class' => 'form-control', 'id' => 'edit_last_name', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Last Name']) !!}

                            @if($errors->has('edit_last_name'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('email', 'Email', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('email', '', ['class' => 'form-control', 'id' => 'email', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Email Id']) !!}

                            @if($errors->has('email'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('phone', 'Mobile No', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::number('phone', '', ['class' => 'form-control', 'id' => 'phone', 'minlength' => 10, 'maxlength' => 10, 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Mobile No']) !!}

                            @if($errors->has('phone'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('edit_role_id', 'Role', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::select('edit_role_id', $roles, '', ['class' => 'form-control', 'required' => 'required', 'id' => 'edit_role_id']); !!}
                            @if($errors->has('edit_role_id'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_role_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('edit_designation', 'Designation', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('edit_designation', '', ['class' => 'form-control', 'id' => 'edit_designation', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Designation']) !!}

                            @if($errors->has('edit_designation'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_designation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row hide" id="terminal_edit">
                        <div class="col-md-12">
                            {!! Form::label('edit_terminal', 'Terminal', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                            {!! Form::select('edit_terminal', $terminals, '', ['class' => 'form-control', 'id' => 'edit_terminal']); !!}
                            @if($errors->has('edit_terminal'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_terminal') }}</strong>
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

<!-- Add User Employee by Admin -->
<div id="addEmployee" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Employee</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => 'addEmployee', 'files' => true, 'class' => "contact_us_form", 'id' => 'empForm')) !!}
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('first_name', 'First Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('first_name', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter First Name']) !!}

                            @if($errors->has('first_name'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('last_name', 'Last Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('last_name', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Last Name']) !!}

                            @if($errors->has('last_name'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('email', 'Email', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('email', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Email Id']) !!}

                            @if($errors->has('email'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('phone', 'Mobile No', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::number('phone', '', ['class' => 'form-control', 'minlength' => 10, 'maxlength' => 10, 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Mobile No']) !!}

                            @if($errors->has('phone'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('role_id', 'Role', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::select('role_id', $roles, '', ['class' => 'form-control', 'required' => 'required']); !!}
                            @if($errors->has('role_id'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('role_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('designation', 'Designation', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('designation', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Designation']) !!}

                            @if($errors->has('designation'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('designation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row hide" id="terminal">
                        <div class="col-md-12">
                            {!! Form::label('terminal', 'Terminal', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                            {!! Form::select('terminal', $terminals, '', ['class' => 'form-control']); !!}
                            @if($errors->has('terminal'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('terminal') }}</strong>
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

@if($errors->has('first_name') || $errors->has('last_name') || $errors->has('role_id') || $errors->has('phone') || $errors->has('email') ||$errors->has('designation'))
    <script type="text/javascript">
        $(document).ready(function(){
            $('#addEmployee').modal('show');
        });
    </script>
@endif

@if($errors->has('edit_first_name') || $errors->has('edit_last_name') || $errors->has('edit_role_id') || $errors->has('phone') || $errors->has('email') ||$errors->has('edit_designation'))
    <script type="text/javascript">
        $(document).ready(function(){
            $('#editEmployee').modal('show');
        });
    </script>
@endif
<script type="text/javascript">
    $(document).ready(function(){
        $('.editEmp').on('click', function(){
            var user_id = $(this).attr('data-id');
            $.ajax({
                method : 'post',
                url: "{{ route('getEmp') }}",
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'user_id' : user_id},
                success:function(response)
                {
                    //console.log(response);                    
                    var data = JSON.parse(response);
                    var url = '<?= route("updateEmployee"); ?>';
                    $('#edit_first_name').val(data.first_name);
                    $('#edit_last_name').val(data.last_name);
                    $('#edit_user_id').val(data.user_id);
                    $('#phone').val(data.phone);
                    $('#email').val(data.email);
                    $('#edit_designation').val(data.designation);
                    $('#edit_role_id').val(data.role_id);
                    $('#edit_terminal').val(data.terminal);

                    if(data.role_id == 7 || data.role_id == 11)
                    {
                        $('#terminal_edit').addClass('show');
                        $('#terminal_edit').removeClass('hide');
                    }else{
                        $('#terminal_edit').removeClass('show');
                        $('#terminal_edit').addClass('hide');
                    }

                    $('#editEmployee').modal('show');
                },
                error: function(data)
                {
                    //console.log(data);
                    alert(data);
                },
            });
        });

        $('#addEmp').on('click', function(){
            $('#addEmployee').modal('show');
        });

        $('#role_id').on('change', function(){
            var role = $(this).val();
            if(role == 7 || role == 11)
            {
                $('#terminal').addClass('show');
                $('#terminal').removeClass('hide');
            }else{
                $('#terminal').removeClass('show');
                $('#terminal').addClass('hide');
            }
        });

        $('#edit_role_id').on('change', function(){
            var role = $(this).val();
            if(role == 7 || role == 11)
            {
                $('#terminal_edit').addClass('show');
                $('#terminal_edit').removeClass('hide');
            }else{
                $('#terminal_edit').removeClass('show');
                $('#terminal_edit').addClass('hide');
            }
        });
    });
</script>
@endsection
