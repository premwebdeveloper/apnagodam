@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Commodity</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('category') }}">Commodity</a>
            </li>
            <li class="active">
                <strong>Edit Commodity</strong>
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
                <h5>Edit Commodity</h5>
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
                        {!! Form::open(array('url' => 'commodity_edit', 'files' => true)) !!}
                            
                            {{ Form::hidden('id', $commodity->id) }}
 
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('commodity', 'Commodity Name') !!}
                                    {!! Form::text('commodity', $commodity->commodity, ['class' => 'form-control', 'id' => 'commodity', 'placeholder' => 'Commodity Name']) !!}

                                    @if($errors->has('commodity'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('commodity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                              
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('image', 'Upload Image') !!}
                                    {!! Form::file('image') !!}

                                    @if($errors->has('image'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <label>&nbsp;</label>
                                <div class="form-group">
                                    {!! Form::submit('Edit Commodity', ['class' => 'btn btn-info btn btn-block']) !!}
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