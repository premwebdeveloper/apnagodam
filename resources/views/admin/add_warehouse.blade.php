@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Warehouse</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('warehouses') }}">Warehouses</a>
            </li>
            <li class="active">
                <strong>Add Warehouse</strong>
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
                <h5>Add Warehouse</h5>
            </div>                        
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">                        
                        {!! Form::open(array('url' => 'add_warehouse', 'files' => true)) !!}
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('name', 'Name') !!}
                                    {!! Form::text('name', '', ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Warehouse Name']) !!}

                                    @if($errors->has('name'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('village', 'Village') !!}
                                    {!! Form::text('village', '', ['class' => 'form-control', 'id' => 'village', 'placeholder' => 'Village']) !!}

                                    @if($errors->has('village'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('village') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('capacity', 'Capacity') !!}
                                    {!! Form::text('capacity', '', ['class' => 'form-control', 'id' => 'capacity', 'placeholder' => 'Capacity']) !!} 

                                    @if($errors->has('capacity'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('capacity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    {!! Form::label('items', 'Items') !!}<br />
                                    @foreach ($items as $i => $item)

                                        <!-- {!! Form::checkbox('items[]', $item, '!in_array($items[$i], $items)', ['class' => 'md-check', 'id' => $item] ) !!}
                                        {!! Form::label($item,  $item) !!} -->

                                        {!! Form::checkbox('items[]', $i, '', ['class' => 'md-check items', 'id' => $item] ) !!}

                                        {!! $item !!}

                                    @endforeach

                                    @if($errors->has('items'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('items') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    {!! Form::label('facilities', 'Facilities') !!}<br />
                                    @foreach ($facilities as $f => $facility)

                                        {!! Form::checkbox('facilities[]', $f, '', ['class' => 'md-check facilities', 'id' => $facility] ) !!}

                                        {!! $facility !!}

                                    @endforeach

                                    @if($errors->has('facilities'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('facilities') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::submit('Add Warehouse', ['class' => 'btn btn-info btn btn-block']) !!}
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