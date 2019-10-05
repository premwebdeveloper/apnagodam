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
                                    {!! Form::label('user', 'Seller') !!}
                                    {!! Form::select('user', $users, $inventory->user_id, ['class' => 'form-control', 'id' => 'user', 'placeholder' => 'Seller']) !!}

                                    @if($errors->has('user'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('user') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('gate_pass_wr', 'Gate Pass / WR No.') !!}
                                    {!! Form::text('gate_pass_wr', $inventory->gate_pass_wr, ['class' => 'form-control', 'id' => 'gate_pass_wr', 'placeholder' => 'Gate Pass / WR No.']) !!}

                                    @if($errors->has('gate_pass_wr'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('gate_pass_wr') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('weight_bridge_no', 'Weight Bridge Sr. No.') !!}
                                    {!! Form::text('weight_bridge_no', $inventory->weight_bridge_no, ['class' => 'form-control', 'id' => 'weight_bridge_no', 'placeholder' => 'Weight Bridge Sr. No.']) !!}

                                    @if($errors->has('weight_bridge_no'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('weight_bridge_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('truck_no', 'Truck No.') !!}
                                    {!! Form::text('truck_no', $inventory->truck_no, ['class' => 'form-control', 'id' => 'truck_no', 'placeholder' => 'Truck No.']) !!}

                                    @if($errors->has('truck_no'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('truck_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('stack_no', 'Stack No.') !!}
                                    {!! Form::text('stack_no', $inventory->stack_no, ['class' => 'form-control', 'id' => 'stack_no', 'placeholder' => 'Stack No.']) !!}

                                    @if($errors->has('stack_no'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('stack_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('lot_no', 'Lot No.') !!}
                                    {!! Form::text('lot_no', $inventory->lot_no, ['class' => 'form-control', 'id' => 'lot_no', 'placeholder' => 'Lot No.']) !!}

                                    @if($errors->has('lot_no'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('lot_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('net_weight', 'Net Weight') !!}
                                    {!! Form::text('net_weight', $inventory->net_weight, ['class' => 'form-control', 'id' => 'net_weight', 'placeholder' => 'Net Weight']) !!}

                                    @if($errors->has('net_weight'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('net_weight') }}</strong>
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
                                    @php
                                        $quality = array(
                                            'A' => 'A',
                                            'B' => 'B',
                                            'C' => 'C',
                                        );
                                    @endphp
                                    {!! Form::label('quality_category', 'Quality Category') !!}
                                    {!! Form::select('quality_category', $quality, $inventory->quality_category, ['class' => 'form-control', 'id' => 'quality_category']) !!}

                                    @if($errors->has('quality_category'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('quality_category') }}</strong>
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
                                    {!! Form::label('file', 'PDF') !!}
                                    {!! Form::file('file', ['class' => 'form-control', 'id' => 'file']) !!}

                                    @if($errors->has('file'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('file') }}</strong>
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