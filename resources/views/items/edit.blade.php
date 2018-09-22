@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Item</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('items') }}">Item</a>
            </li>
            <li class="active">
                <strong>Edit Item</strong>
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
                <h5>Edit Item</h5>
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
                        {!! Form::open(array('url' => 'item_edit', 'files' => true)) !!}
                            
                            {{ Form::hidden('id', $item->id) }}

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('item', 'Item Name') !!}
                                    {!! Form::text('item', $item->item, ['class' => 'form-control', 'id' => 'item', 'placeholder' => 'Item Name']) !!}

                                    @if($errors->has('item'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('item') }}</strong>
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