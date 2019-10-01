@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Terminal</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('warehouses') }}">Terminals</a>
            </li>
            <li class="active">
                <strong>Edit Terminal</strong>
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
                <h5>Edit Terminal</h5>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        {!! Form::open(array('url' => 'warehouse_edit', 'files' => true)) !!}

                            {{ Form::hidden('warehouse_id', $warehouse->id) }}

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('name', 'Name') !!}
                                    {!! Form::text('name', $warehouse->name, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Terminal Name']) !!}

                                    @if($errors->has('name'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('village', 'Village') !!}
                                    {!! Form::text('village', $warehouse->village, ['class' => 'form-control', 'id' => 'village', 'placeholder' => 'Village']) !!}

                                    @if($errors->has('village'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('village') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('capacity', 'Capacity') !!}
                                    {!! Form::text('capacity', $warehouse->capacity, ['class' => 'form-control', 'id' => 'capacity', 'placeholder' => 'Capacity']) !!}

                                    @if($errors->has('capacity'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('capacity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    {!! Form::label('facilities', 'Facilities') !!}<br />
                                    @foreach ($all_facilities as $f => $facility)
                                        {!! Form::checkbox('facilities[]', $f, json_decode($warehouse->facility_ids), ['class' => 'md-check facilities', 'id' => $f] ) !!}

                                        {!! $facility !!}

                                    @endforeach

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::submit('Edit Terminal', ['class' => 'btn btn-info btn btn-block']) !!}
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