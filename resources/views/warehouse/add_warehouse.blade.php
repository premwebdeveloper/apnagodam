@extends('layouts.auth_app')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Terminal</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('warehouses') }}">Terminals</a>
            </li>
            <li class="active">
                <strong>Add Terminal</strong>
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
                <h5>Add Terminal</h5>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        {!! Form::open(array('url' => 'add_warehouse', 'files' => true)) !!}

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('name', 'Name *') !!}
                                    {!! Form::text('name', '', ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Terminal Name']) !!}

                                    @if($errors->has('name'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('address', 'Address *') !!}
                                    {!! Form::text('address', '', ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Address']) !!}

                                    @if($errors->has('address'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('location', 'Location') !!}
                                    {!! Form::text('location', '', ['class' => 'form-control', 'id' => 'location', 'placeholder' => 'Location']) !!}

                                    @if($errors->has('location'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('area', 'Area *') !!}
                                    {!! Form::text('area', '', ['class' => 'form-control', 'id' => 'area', 'placeholder' => 'Area']) !!}

                                    @if($errors->has('area'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('area') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('district', 'District *') !!}
                                    {!! Form::text('district', '', ['class' => 'form-control', 'id' => 'district', 'placeholder' => 'District']) !!}

                                    @if($errors->has('district'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('district') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('area_sqr_ft', 'Area in Sqr. Ft. *') !!}
                                    {!! Form::text('area_sqr_ft', '', ['class' => 'form-control', 'id' => 'area_sqr_ft', 'placeholder' => 'Area in Sqr. Ft.']) !!}

                                    @if($errors->has('area_sqr_ft'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('area_sqr_ft') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('rent_per_month', 'Rent Per Month Per MT *') !!}
                                    {!! Form::text('rent_per_month', '', ['class' => 'form-control', 'id' => 'rent_per_month', 'placeholder' => 'Rent Per Month Per MT']) !!}

                                    @if($errors->has('rent_per_month'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('rent_per_month') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('capacity_in_mt', 'Capacity in MT') !!}
                                    {!! Form::text('capacity_in_mt', '', ['class' => 'form-control', 'id' => 'capacity_in_mt', 'placeholder' => 'Capacity in MT']) !!}

                                    @if($errors->has('capacity_in_mt'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('capacity_in_mt') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">

                                    {!! Form::label('image', 'Image') !!}<br />
                                    {{ Form::file('image', ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('transporter_info', 'NearBy Transporter Info ( Separate By || )') !!}
                                    {!! Form::textarea('transporter_info', '', ['class' => 'form-control', 'id' => 'transporter_info', 'placeholder' => 'NearBy Transporter Info', 'rows' => '3', 'cols' => '40']) !!}

                                    @if($errors->has('transporter_info'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('transporter_info') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('mandi_info', 'NearBy Mandi Info ( Separate By || )') !!}
                                    {!! Form::textarea('mandi_info', '', ['class' => 'form-control', 'id' => 'mandi_info', 'placeholder' => 'NearBy Mandi Info', 'rows' => '3', 'cols' => '40']) !!}

                                    @if($errors->has('mandi_info'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('mandi_info') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('crop_info', 'NearBy Crop Info ( Separate By || )') !!}
                                    {!! Form::textarea('crop_info', '', ['class' => 'form-control', 'id' => 'crop_info', 'placeholder' => 'NearBy Crop Info', 'rows' => '3', 'cols' => '40']) !!}

                                    @if($errors->has('crop_info'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('crop_info') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    {!! Form::label('facilities', 'Facilities') !!}<br />
                                    @foreach ($all_facilities as $f => $facility)
                                        {!! Form::checkbox('facilities[]', $f,'', ['class' => 'md-check facilities', 'id' => $f] ) !!}

                                        {!! $facility !!}

                                    @endforeach

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    {!! Form::label('banks', 'Banks (For Loan)') !!}<br />
                                    @foreach ($banks as $b => $bank)
                                        {!! Form::checkbox('banks[]', $b,'', ['class' => 'md-check banks', 'id' => $b] ) !!}

                                        {!! $bank !!}

                                    @endforeach

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::submit('Add Terminal', ['class' => 'btn btn-info btn btn-block']) !!}
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