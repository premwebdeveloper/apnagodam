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
	                    <table class="table table-striped table-bordered table-hover" id="emp_datatable">
	                        <thead>
	                            <tr>
                                    <th>#</th>
                                    <th>Emp ID</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Designation</th>
                                    <th>Email</th>
                                    <th>Corporate Phone</th>
                                    <th>Personal Phone</th>
                                    <th>Address</th>
                                    <th>Level</th>
                                    <th>State</th>
                                    <th>District</th>
                                    <th>Location</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                <?php
                                $i = 1;
                                ?>
                                @foreach($employees as $key => $user)
	                                <tr class="gradeX">
                                        <td>{{ $i }}</td>
                                        <td>{!! $user->emp_id !!}</td>
                                        <td>{!! $user->first_name ." ". $user->last_name !!}</td>
                                        <td>{!! $user->role !!}</td>
                                        <td>{!! $user->designation !!}</td>
                                        <td>{!! $user->email !!}</td>
                                        <td>{!! $user->phone !!}</td>
                                        <td>{!! $user->personal_phone !!}</td>
                                        <td>{!! $user->address !!}</td>
                                        <td>{!! $user->level !!}</td>
                                        <td>{!! ($user->state_name)?$user->state_name:'N/A' !!}</td>
                                        <td>{!! ($user->district_name)?$user->district_name:'N/A' !!}</td>
                                        <td>{!! ($user->location_address)?$user->location_address." ".$user->location_area:'N/A' !!}</td>
                                        <td>
                                            <a href="javascript:;" data-id="{{ $user->user_id }}" class="btn btn-info btn-xs editEmp" title="Edit">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <a href="{!! route('deleteEmployee', ['user_id' => $user->user_id]) !!}" class="btn btn-danger btn-xs" data-toggle="confirmation" data-placement="bottom" title="Delete Employee">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </td>
	                                </tr>
                                    <?php
                                    $i++;
                                    ?>
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
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Employee</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => 'updateEmployee', 'files' => true, 'class' => "contact_us_form")) !!}
                    @csrf
                    {!! Form::hidden('user_id', '', array('id' => 'edit_user_id')) !!}
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('edit_first_name', 'First Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('edit_first_name', '', ['class' => 'form-control', 'id' => 'edit_first_name', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter First Name']) !!}

                            @if($errors->has('edit_first_name'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_last_name', 'Last Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('edit_last_name', '', ['class' => 'form-control', 'id' => 'edit_last_name', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Last Name']) !!}

                            @if($errors->has('edit_last_name'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_personal_phone', 'Personal Mobile No', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::number('edit_personal_phone', '', ['class' => 'form-control', 'minlength' => 10, 'maxlength' => 10, 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Personal Mobile No']) !!}

                            @if($errors->has('edit_personal_phone'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_personal_phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('email', 'Email', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('email', '', ['class' => 'form-control', 'id' => 'edit_email', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Email Id']) !!}

                            @if($errors->has('email'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('phone', 'Corporate Mobile No', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::number('phone', '', ['class' => 'form-control', 'id' => 'edit_phone', 'minlength' => 10, 'maxlength' => 10, 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Corporate Mobile No']) !!}

                            @if($errors->has('phone'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_address', 'Address', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('edit_address', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Address']) !!}

                            @if($errors->has('edit_address'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('edit_designation', 'Designation', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('edit_designation', '', ['class' => 'form-control', 'id' => 'edit_designation', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Designation']) !!}

                            @if($errors->has('edit_designation'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_designation') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_role_id', 'Role', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::select('edit_role_id', $roles, '', ['class' => 'form-control', 'disabled' => 'disabled', 'id' => 'edit_role_id']); !!}
                            @if($errors->has('edit_role_id'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_role_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('edit_level_id', 'Level', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::select('edit_level_id', $levels, '', ['class' => 'form-control', 'required' => 'required']); !!}
                            @if($errors->has('edit_level_id'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_level_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 hide" id="edit_state_level">
                            {!! Form::label('edit_states', 'States', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::select('edit_states', $states, '', ['class' => 'form-control']); !!}
                            @if($errors->has('edit_states'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_states') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4 hide" id="edit_distict_level">
                            {!! Form::label('edit_district', 'Districts', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::select('edit_district', array('' => 'Select District'), '', ['class' => 'form-control']); !!}
                            @if($errors->has('edit_district'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('edit_district') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row hide" id="edit_terminal">
                        <div class="col-md-4">
                            {!! Form::label('edit_terminal', 'Terminal', ['class' => 'm-t-20  col-form-label text-md-right']) !!}
                            {!! Form::select('edit_terminal', $terminals, '', ['class' => 'form-control', 'id' => 'edit_location']); !!}
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
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Employee</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => 'addEmployee', 'files' => true, 'class' => "contact_us_form")) !!}
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('first_name', 'First Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('first_name', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter First Name']) !!}

                            @if($errors->has('first_name'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('last_name', 'Last Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('last_name', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Last Name']) !!}

                            @if($errors->has('last_name'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('personal_phone', 'Personal Mobile No', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::number('personal_phone', '', ['class' => 'form-control', 'minlength' => 10, 'maxlength' => 10, 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Personal Mobile No']) !!}

                            @if($errors->has('personal_phone'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('personal_phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('email', 'Email', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('email', '', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Email Id']) !!}

                            @if($errors->has('email'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('phone', 'Corporate Mobile No', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::number('phone', '', ['class' => 'form-control', 'minlength' => 10, 'maxlength' => 10, 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Corporate Mobile No']) !!}

                            @if($errors->has('phone'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('address', 'Address', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('address', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Address']) !!}

                            @if($errors->has('address'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('designation', 'Designation', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('designation', '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required', 'placeholder' => 'Enter Designation']) !!}

                            @if($errors->has('designation'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('designation') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('role_id', 'Role', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::select('role_id', $roles, '', ['class' => 'form-control', 'required' => 'required']); !!}
                            @if($errors->has('role_id'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('role_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('level_id', 'Level', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::select('level_id', $levels, '', ['class' => 'form-control', 'required' => 'required']); !!}
                            @if($errors->has('level_id'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('level_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 hide" id="state_level">
                            {!! Form::label('states', 'States', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::select('states', $states, '', ['class' => 'form-control']); !!}
                            @if($errors->has('states'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('states') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4 hide" id="distict_level">
                            {!! Form::label('district', 'Districts', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::select('district', array('' => 'Select District'), '', ['class' => 'form-control']); !!}
                            @if($errors->has('district'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('district') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row hide" id="terminal">
                        <div class="col-md-4">
                            {!! Form::label('terminal', 'Location', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
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
                            {!! Form::submit('Add / Save', ['class' => 'btn btn-info m-t-20 form-control b-info']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@if($errors->has('first_name') || $errors->has('last_name') || $errors->has('role_id') || $errors->has('phone') || $errors->has('email') || $errors->has('designation') || $errors->has('level_id') || $errors->has('states') || $errors->has('district') || $errors->has('terminal'))
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
                    $('#edit_phone').val(data.phone);
                    $('#edit_email').val(data.email);
                    $('#edit_designation').val(data.designation);
                    $('#edit_role_id').val(data.role_id);
                    $('#edit_terminal').val(data.terminal);
                    $('#edit_personal_phone').val(data.personal_phone);
                    $('#edit_address').val(data.address);
                    $('#edit_level_id').val(data.level_id);

                    if(data.level_id == 4)
                    {
                        $('#edit_terminal').addClass('show');
                        $('#edit_terminal').removeClass('hide');
                        $('#edit_state_level').removeClass('show');
                        $('#edit_state_level').addClass('hide');
                        $('#edit_distict_level').removeClass('show');
                        $('#edit_distict_level').addClass('hide');
                        $('#edit_location').val(data.location);
                    }
                    else if(data.level_id == 2)
                    {
                        $('#edit_states').val(data.state_id);
                        $('#edit_state_level').removeClass('hide');
                        $('#edit_state_level').addClass('show');
                        $('#edit_terminal').removeClass('show');
                        $('#edit_terminal').addClass('hide');
                        $('#edit_distict_level').removeClass('show');
                        $('#edit_distict_level').addClass('hide');
                    }
                    else if(data.level_id == 3)
                    {
                        // get districts
                        $.ajax({
                            method : 'post',
                            url: "{{ route('getDistrict') }}",
                            async : true,
                            data : {"_token": "{{ csrf_token() }}", 'code' : data.state_id},
                            success:function(response)
                            {
                                $('#edit_district').html(response);
                            }
                        });
                        
                        $('#edit_states').val(data.state_id);
                        $('#edit_state_level').removeClass('hide');
                        $('#edit_state_level').addClass('show');
                        $('#edit_distict_level').removeClass('hide');
                        $('#edit_distict_level').addClass('show');
                        $('#edit_terminal').removeClass('show');
                        $('#edit_terminal').addClass('hide');
                        $('#edit_district').val(data.district_id);
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

        $('#level_id').on('change', function(){
            var role = $(this).val();
            if(role == 4)
            {
                $('#terminal').addClass('show');
                $('#terminal').removeClass('hide');
                $('#state_level').removeClass('show');
                $('#state_level').addClass('hide');
                $('#distict_level').removeClass('show');
                $('#distict_level').addClass('hide');
            }
            else if(role == 2)
            {
                $('#state_level').removeClass('hide');
                $('#state_level').addClass('show');
                $('#terminal').removeClass('show');
                $('#terminal').addClass('hide');
                $('#distict_level').removeClass('show');
                $('#distict_level').addClass('hide');
            }
            else if(role == 3)
            {
                $('#state_level').removeClass('hide');
                $('#state_level').addClass('show');
                $('#distict_level').removeClass('hide');
                $('#distict_level').addClass('show');
                $('#terminal').removeClass('show');
                $('#terminal').addClass('hide');
            }
            else
            {
                $('#terminal').removeClass('show');
                $('#terminal').addClass('hide');
                $('#distict_level').removeClass('show');
                $('#distict_level').addClass('hide');
                $('#state_level').removeClass('show');
                $('#state_level').addClass('hide');
            }
        });

        $('#edit_level_id').on('change', function(){
            var role = $(this).val();
            if(role == 4)
            {
                $('#edit_terminal').addClass('show');
                $('#edit_terminal').removeClass('hide');
                $('#edit_state_level').removeClass('show');
                $('#edit_state_level').addClass('hide');
                $('#edit_distict_level').removeClass('show');
                $('#edit_distict_level').addClass('hide');
            }
            else if(role == 2)
            {
                $('#edit_state_level').removeClass('hide');
                $('#edit_state_level').addClass('show');
                $('#edit_terminal').removeClass('show');
                $('#edit_terminal').addClass('hide');
                $('#edit_distict_level').removeClass('show');
                $('#edit_distict_level').addClass('hide');
            }
            else if(role == 3)
            {
                $('#edit_state_level').removeClass('hide');
                $('#edit_state_level').addClass('show');
                $('#edit_distict_level').removeClass('hide');
                $('#edit_distict_level').addClass('show');
                $('#edit_terminal').removeClass('show');
                $('#edit_terminal').addClass('hide');
            }
            else
            {
                $('#edit_terminal').removeClass('show');
                $('#edit_terminal').addClass('hide');
                $('#edit_distict_level').removeClass('show');
                $('#edit_distict_level').addClass('hide');
                $('#edit_state_level').removeClass('show');
                $('#edit_state_level').addClass('hide');
            }
        });

        /*$('#edit_role_id').on('change', function(){
            var role = $(this).val();
            if(role == 7 || role == 11)
            {
                $('#terminal_edit').addClass('show');
                $('#terminal_edit').removeClass('hide');
            }else{
                $('#terminal_edit').removeClass('show');
                $('#terminal_edit').addClass('hide');
            }
        });*/

        $('#states').on('change', function(){
            var id = $(this).val();
            $.ajax({
                method : 'post',
                url: "{{ route('getDistrict') }}",
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'code' : id},
                success:function(response)
                {
                    $('#district').html(response);
                },
                error: function(data)
                {
                    console.log(data);
                    alert(data);
                },
            });
        });

        $('#edit_states').on('change', function(){
            var id = $(this).val();
            $.ajax({
                method : 'post',
                url: "{{ route('getDistrict') }}",
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'code' : id},
                success:function(response)
                {
                    $('#edit_district').html(response);
                },
                error: function(data)
                {
                    console.log(data);
                    alert(data);
                },
            });
        });

        $('#emp_datatable').DataTable({
            "ordering": false
        });
    });
</script>
@endsection
