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
                                    {!! Form::label('mandi samiti', 'Mandi Samiti') !!}<span class="red">*</span>
                                    <select name="mandi_samiti" id="mandi_samiti" class="form-control" required="required">
                                        <option value="">Select Mandi Samiti</option>

                                        @foreach($mandi_samiti as $m_key => $samiti)

                                            <option value="{!! $samiti->id !!}">{!! $samiti->name !!}</option>
                                        @endforeach
                                    </select>

                                    @if($errors->has('mandi_samiti'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('mandi_samiti') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('name', 'Name') !!}<span class="red">*</span>
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
                                    {!! Form::label('address', 'Address') !!}<span class="red">*</span>
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
                                    {!! Form::label('location', 'Village / Town') !!}
                                    {!! Form::text('location', '', ['class' => 'form-control', 'id' => 'location', 'placeholder' => 'Village / Town']) !!}

                                    @if($errors->has('location'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('state', 'State') !!}<span class="red">*</span>
                                    {!! Form::select('state', $states, '',['class' => 'form-control', 'id' => 'state']) !!}

                                    @if($errors->has('state'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('district', 'District') !!}<span class="red">*</span>
                                    {!! Form::select('district', array('' => 'Select District'), '', ['class' => 'form-control', 'id' => 'district']) !!}

                                    @if($errors->has('district'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('district') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('area_sqr_ft', 'Area in Sqr. Ft.') !!}<span class="red">*</span>
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
                                    {!! Form::label('rent_per_month', 'Rent Per Month / MT')!!} <span class="red">*</span>
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
                                    {!! Form::label('gatepass_start', 'Gatepass Series Start') !!}
                                    {!! Form::text('gatepass_start', '', ['class' => 'form-control', 'id' => 'gatepass_start', 'placeholder' => 'Enter Gatepass Series Start Number']) !!}

                                    @if($errors->has('gatepass_start'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('gatepass_start') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('gatepass_end', 'Gatepass Series End') !!}
                                    {!! Form::text('gatepass_end', '', ['class' => 'form-control', 'id' => 'gatepass_end', 'placeholder' => 'Enter Gatepass Series End Number']) !!}

                                    @if($errors->has('gatepass_end'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('gatepass_end') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('no_of_stacks', 'No. of Stack') !!}
                                    {!! Form::number('no_of_stacks', '', ['class' => 'form-control', 'id' => 'no_of_stacks', 'placeholder' => 'No. of Stack']) !!}

                                    @if($errors->has('no_of_stacks'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('no_of_stacks') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('labour_contractor', 'Labour Contractor') !!}
                                    {!! Form::text('labour_contractor', '', ['class' => 'form-control', 'id' => 'labour_contractor', 'placeholder' => 'Enter Labour Contractor Name']) !!}

                                    @if($errors->has('labour_contractor'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('labour_contractor') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('contractor_phone', 'Contractor Phone') !!}
                                    {!! Form::text('contractor_phone', '', ['class' => 'form-control', 'id' => 'contractor_phone', 'placeholder' => 'Enter Contractor Phone']) !!}

                                    @if($errors->has('contractor_phone'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('contractor_phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('labour_rate', 'Labour Rate') !!}
                                    {!! Form::number('labour_rate', '', ['class' => 'form-control', 'id' => 'labour_rate', 'placeholder' => 'Labour Rate']) !!}

                                    @if($errors->has('labour_rate'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('labour_rate') }}</strong>
                                        </span>
                                    @endif
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
                            <div class="col-md-4">
                                <div class="form-group">

                                    {!! Form::label('image', 'Image') !!}<br />
                                    {{ Form::file('image', ['class' => 'form-control', 'required' => 'required']) }}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('dharam_kanta', 'Dharam Kanta') !!}
                                    {!! Form::select('dharam_kanta', $dharm_kanta, '',['class' => 'form-control', 'id' => 'dharam_kanta']) !!}

                                    @if($errors->has('dharam_kanta'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('dharam_kanta') }}</strong>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#state').on('change', function(){
            var id = $(this).val();
            $.ajax({
                method : 'post',
                url: "{{ route('getDistrict') }}",
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'code' : id},
                success:function(response)
                {
                    $('#district').html(response);
                },
                error: function(data)
                {
                    console.log(data);
                    alert(data);
                },
            });
        });
    });
</script>
@endsection