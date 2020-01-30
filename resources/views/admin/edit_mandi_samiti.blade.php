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
                                    {!! Form::label('name', 'Name') !!}
                                    {!! Form::text('name', $mandi_samiti->name, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name', 'required' => 'required']) !!}

                                    @if($errors->has('name'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('address', 'Address') !!}
                                    {!! Form::text('address', $mandi_samiti->address, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Address']) !!}

                                    @if($errors->has('address'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('district', 'District') !!}
                                    {!! Form::text('district', $mandi_samiti->district, ['class' => 'form-control', 'id' => 'district', 'placeholder' => 'District']) !!}

                                    @if($errors->has('district'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('district') }}</strong>
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