@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Mandi Name</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('items') }}">Mandi Name</a>
            </li>
            <li class="active">
                <strong>Add Mandi Name</strong>
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
                <h5>Add Mandi Name</h5>
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
                        {!! Form::open(array('url' => 'add_mandi', 'files' => true)) !!}

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('mandi', 'Mandi Name') !!}
                                    {!! Form::text('mandi', '', ['class' => 'form-control', 'id' => 'mandi', 'placeholder' => 'Mandi Name']) !!}

                                    @if($errors->has('mandi'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('mandi') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    {!! Form::submit('Add Mandi Name', ['class' => 'btn btn-info btn btn-block']) !!}
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