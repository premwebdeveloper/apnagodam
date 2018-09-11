@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add User</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('users') }}">Users</a>
            </li>
            <li class="active">
                <strong>Add User</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2 text-right">
        &nbsp;
    </div>
</div>

<br />

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add User</h5>
            </div>
                        
            <div class="ibox float-e-margins">
                <div class="ibox-content">

                {!! Form::open(array('url' => 'add_user', 'files' => true)) !!}
                    
                    <div class="form-group">
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="col-md-3">
                            {!! Form::label('fname', 'First Name') !!}
                            {!! Form::text('fname', '', ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'First Name']) !!}

                            @if($errors->has('fname'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('fname') }}</strong>
                                </span>
                            @endif
                        </div>


                    </div>
                {!! Form::close() !!}
                
                    <!-- Add user form -->
                    <form method="post" class="form-horizontal" action="{{ route('add_user') }}">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-3">
                                <label class="control-label">First Name</label>
                                <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name">
                                @if($errors->has('fname'))
                                    <span class="help-block red">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                @endif
                            </div>                      
                            <div class="col-md-3">
                                <label class="control-label">Last Name</label>
                                <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name">
                                @if($errors->has('lname'))
                                    <span class="help-block red">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                @if($errors->has('email'))
                                    <span class="help-block red">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="******">
                                @if($errors->has('password'))
                                    <span class="help-block red">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="clearfix"> &nbsp; </div>
                            <div class="col-md-3">
                                <label class="control-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="******">
                                @if($errors->has('password_confirmation'))
                                    <span class="help-block red">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                            <div class="col-md-3">
                                <label class="control-label">Phone</label>
                                <input type="tel" name="phone" id="phone" class="form-control" placeholder="9876543210">
                                @if($errors->has('phone'))
                                    <span class="help-block red">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>                                
                            <div class="col-md-3">
                                <label class="control-label">Father Name</label>
                                <input type="text" name="father_name" id="father_name" class="form-control" placeholder="Father Name">
                            </div>                                
                            <div class="col-md-3">
                                <label class="control-label">Khasra Number</label>
                                <input type="text" name="khasra" id="khasra" class="form-control" placeholder="Khasra Number">
                            </div>
                            <div class="clearfix"> &nbsp; </div>                     
                            <div class="col-md-3">
                                <label class="control-label">Village</label>
                                <input type="text" name="village" id="village" class="form-control" placeholder="Village">
                            </div>                                
                            <div class="col-md-3">
                                <label class="control-label">Tehsil</label>
                                <input type="text" name="tehsil" id="tehsil" class="form-control" placeholder="Tehsil">
                            </div>                            
                            <div class="col-md-3">
                                <label class="control-label">District</label>
                                <input type="text" name="district" id="district" class="form-control" placeholder="District">
                            </div>                            
                            <div class="col-md-3">
                                <label class="control-label">Commodity</label>
                                <input type="text" name="commodity" id="commodity" class="form-control" placeholder="Commodity">
                            </div>
                        </div>
                        <div class="clearfix"> &nbsp; </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <input class="btn btn-primary btn-block" name="add_user" id="add_user" type="submit" value="Add User">
                            </div>
                        </div>

                    </form>
                    
                </div>
            </div>


        </div>
    </div>
</div>

@endsection