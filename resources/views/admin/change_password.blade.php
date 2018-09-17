@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Change Password</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Change Password</strong>
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
                <h5>Change Password</h5>
            </div>                        
            <div class="ibox float-e-margins">
                <div class="ibox-content">

                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{$errors->first()}}
                        </div>
                    @endif


                    <div class="row">                        
                        {!! Form::open(array('url' => 'change_password')) !!}
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('current-password', 'Current Password') !!}
                                    {!! Form::password('current-password', ['class' => 'form-control', 'id' => 'current-password', 'placeholder' => '******']) !!}

                                    @if($errors->has('current-password'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('current-password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('new-password', 'New Password') !!}
                                    {!! Form::password('new-password', ['class' => 'form-control', 'id' => 'new-password', 'placeholder' => '******']) !!}

                                    @if($errors->has('new-password'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('new-password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('new-password_confirmation', 'Confirm Password') !!}
                                    {!! Form::password('new-password_confirmation', ['class' => 'form-control', 'id' => 'new-password_confirmation', 'placeholder' => '******']) !!} 

                                    @if($errors->has('new-password_confirmation'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('new-password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::submit('Change Password', ['class' => 'btn btn-info btn btn-block']) !!}
                                </div>
                            </div>

                        {!! Form::close() !!}

                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection