@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Update Mandi Samiti</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('mandi_samiti') }}">Mandi Samiti</a>
            </li>
            <li class="active">
                <strong>Update Mandi Samiti</strong>
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
                <h5>Update Mandi Samiti</h5>
            </div>                        
            <div class="ibox float-e-margins">
                <div class="ibox-content">

                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="row">                        
                        {!! Form::open(array('url' => 'update_mandi_samiti', 'files' => true)) !!}
                            @csrf
                            {{ Form::hidden('id', $mandi_samiti->id) }}
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('name', 'KUMS Name') !!}
                                    {!! Form::text('name', $mandi_samiti->name, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'KUMS Name', 'required' => 'required']) !!}

                                    @if($errors->has('name'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('class', 'Class') !!}
                                    {!! Form::text('class', $mandi_samiti->class, ['class' => 'form-control', 'id' => 'class', 'placeholder' => 'Enter Class (A/B/C/D/SA)']) !!}

                                    @if($errors->has('class'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('class') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('secretary_name', 'Secretary Name') !!}
                                    {!! Form::text('secretary_name', $mandi_samiti->secretary_name, ['class' => 'form-control', 'id' => 'secretary_name', 'placeholder' => 'Secretary Name']) !!}

                                    @if($errors->has('secretary_name'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('secretary_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('phone', 'Mobile No.') !!}<span class="red">*</span>
                                    {!! Form::text('phone', $mandi_samiti->phone, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Enter 10 Digit Mobile No.', 'required' => 'required']) !!}

                                    @if($errors->has('phone'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('std_code', 'Std Code') !!}
                                    {!! Form::text('std_code', $mandi_samiti->std_code, ['class' => 'form-control', 'id' => 'std_code', 'placeholder' => 'Std Code']) !!}

                                    @if($errors->has('std_code'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('std_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('tel_no', 'Tel. No.') !!}
                                    {!! Form::text('tel_no', $mandi_samiti->tel_no, ['class' => 'form-control', 'id' => 'tel_no', 'placeholder' => 'Enter Tel. No']) !!}

                                    @if($errors->has('tel_no'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('tel_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('fax', 'Fax') !!}
                                    {!! Form::text('fax', $mandi_samiti->fax, ['class' => 'form-control', 'id' => 'fax', 'placeholder' => 'Fax']) !!}

                                    @if($errors->has('fax'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('fax') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('email', 'Email') !!}<span class="red">*</span>
                                    {!! Form::text('email', $mandi_samiti->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email', 'required' => 'required']) !!}

                                    @if($errors->has('email'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                           
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::submit('Update & Save  Mandi Samiti', ['class' => 'btn btn-info btn btn-block']) !!}
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