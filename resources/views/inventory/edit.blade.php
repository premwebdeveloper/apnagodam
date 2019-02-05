@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Inventory</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('inventory') }}">Inventory</a>
            </li>
            <li class="active">
                <strong>Edit Inventory</strong>
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
                <h5>Edit Inventory</h5>
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
                        {!! Form::open(array('url' => 'inventory_edit', 'files' => true)) !!}

                            {{ Form::hidden('inventory_id', $inventory->id) }}

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('user', 'User') !!}
                                    {!! Form::select('user', $users, $inventory->user_id, ['class' => 'form-control', 'id' => 'user', 'placeholder' => 'User']) !!}

                                    @if($errors->has('user'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('user') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('warehouse', 'Terminal') !!}
                                    {!! Form::select('warehouse', $warehouses, $inventory->warehouse_id, ['class' => 'form-control', 'id' => 'warehouse']) !!}

                                    @if($errors->has('warehouse'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('warehouse') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('commodity', 'Commodity') !!}
                                    {!! Form::select('commodity', $categories, $inventory->commodity, ['class' => 'form-control', 'id' => 'commodity']) !!}

                                    @if($errors->has('commodity'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('commodity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('quantity', 'Quantity') !!}
                                    {!! Form::number('quantity', $inventory->quantity, ['class' => 'form-control', 'id' => 'quantity', 'placeholder' => 'Quantity']) !!}

                                    @if($errors->has('quantity'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('quantity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('price', 'Price') !!}
                                    {!! Form::text('price', $inventory->price, ['class' => 'form-control', 'id' => 'price', 'placeholder' => 'Price', 'readonly' => 'readonly']) !!}

                                    @if($errors->has('price'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('image', 'Image') !!}
                                    {!! Form::file('image', ['class' => 'form-control', 'id' => 'image']) !!}

                                    @if($errors->has('image'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::submit('Edit Inventory', ['class' => 'btn btn-info btn btn-block']) !!}
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