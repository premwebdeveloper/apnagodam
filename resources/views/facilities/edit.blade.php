@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Facility</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('facility') }}">Facility</a>
            </li>
            <li class="active">
                <strong>Edit Facility</strong>
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
                <h5>Edit Facility</h5>
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
                        {!! Form::open(array('url' => 'facility_edit', 'files' => true)) !!}
                            
                            {{ Form::hidden('id', $facility->id) }}

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('facility', 'Facility Name') !!}
                                    {!! Form::text('facility', $facility->facility, ['class' => 'form-control', 'id' => 'facility', 'placeholder' => 'Facility Name']) !!}

                                    @if($errors->has('facility'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('facility') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>  

                            <div class="col-md-6">
                                <label>&nbsp;</label>
                                <div class="form-group">
                                    {!! Form::submit('Edit Item', ['class' => 'btn btn-info btn btn-block']) !!}
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