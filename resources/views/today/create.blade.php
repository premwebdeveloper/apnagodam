@extends('layouts.auth_app')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Today Price</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('items') }}">Today Price</a>
            </li>
            <li class="active">
                <strong>Add Today Price</strong>
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
                <h5>Add Today Price</h5>
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
                        {!! Form::open(array('url' => 'add_today', 'files' => true)) !!}

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('mandi', 'Mandi Name') !!}
                                    <select name="mandi" class="form-control" required="">
                                        <option value="">Select Mandi Name</option>
                                        @foreach($mandies as $key => $mandi)
                                            <option value="{!! $mandi->id !!}">{!! $mandi->mandi_name !!}</option>
                                        @endforeach
                                    </select>

                                    @if($errors->has('mandi'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('mandi') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('commodity', 'Commodity Name') !!}
                                    <select name="commodity" class="form-control" required="">
                                        <option value="">Select Commodity</option>
                                        @foreach($commodities as $key => $commodity)
                                            <option value="{!! $commodity->id !!}">{!! $commodity->category !!}</option>
                                        @endforeach
                                    </select>

                                    @if($errors->has('commodity'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('commodity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('modal', 'Modal') !!}
                                    {!! Form::text('modal', '', ['class' => 'form-control', 'id' => 'modal', 'placeholder' => 'Modal']) !!}

                                    @if($errors->has('modal'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('modal') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('max', 'Max') !!}
                                    {!! Form::text('max', '', ['class' => 'form-control', 'id' => 'max', 'placeholder' => 'Max']) !!}

                                    @if($errors->has('max'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('max') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('min', 'Min') !!}
                                    {!! Form::text('min', '', ['class' => 'form-control', 'id' => 'min', 'placeholder' => 'Min']) !!}

                                    @if($errors->has('min'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('min') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> 

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    {!! Form::submit('Add Today Price', ['class' => 'btn btn-info btn btn-block']) !!}
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