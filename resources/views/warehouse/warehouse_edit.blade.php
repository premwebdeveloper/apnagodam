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
  
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('mandi samiti', 'Mandi Samiti *') !!}
                                    <select name="mandi_samiti" id="mandi_samiti" class="form-control" required="required">
                                        <option value="">Select Mandi Samiti</option>

                                        @foreach($mandi_samiti as $m_key => $samiti)

                                            <option <?= ($samiti->id == $warehouse->mandi_samiti_id) ? 'selected' : ''; ?> value="{!! $samiti->id !!}">{!! $samiti->name !!}</option>
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
                                    {!! Form::label('name', 'Name') !!}
                                    {!! Form::text('name', $warehouse->name, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Terminal Name']) !!}

                                    @if($errors->has('name'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                           <div class="col-md-4">
                               <div class="form-group">
                                   {!! Form::label('address', 'Address') !!}
                                   {!! Form::text('address', $warehouse->address, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Address']) !!}
                           
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
                                   {!! Form::text('location', $warehouse->location, ['class' => 'form-control', 'id' => 'location', 'placeholder' => 'Village / Town']) !!}
                           
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
                                    {!! Form::select('state', $states, $warehouse->state, ['disabled' => 'disabled', 'class' => 'form-control', 'id' => 'state']) !!}

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
                                    {!! Form::select('district', $districts, $warehouse->district, ['disabled' => 'disabled', 'class' => 'form-control', 'id' => 'district']) !!}

                                    @if($errors->has('district'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('district') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                           <div class="col-md-4">
                               <div class="form-group">
                                   {!! Form::label('area_sqr_ft', 'Area (SQ.FT.)') !!}
                                   {!! Form::text('area_sqr_ft', $warehouse->area_sqr_ft, ['class' => 'form-control', 'id' => 'area_sqr_ft', 'placeholder' => 'Area SQ.FT.']) !!}
                           
                                   @if($errors->has('area_sqr_ft'))
                                       <span class="help-block red">
                                           <strong>{{ $errors->first('area_sqr_ft') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="col-md-4">
                               <div class="form-group">
                                   {!! Form::label('rent_per_month', 'Rent') !!}
                                   {!! Form::text('rent_per_month', $warehouse->rent_per_month, ['class' => 'form-control', 'id' => 'rent_per_month', 'placeholder' => 'Rent']) !!}
                           
                                   @if($errors->has('rent_per_month'))
                                       <span class="help-block red">
                                           <strong>{{ $errors->first('rent_per_month') }}</strong>
                                       </span>
                                   @endif
                               </div>
                           </div>

                           <div class="col-md-4">
                               <div class="form-group">
                                   {!! Form::label('capacity_in_mt', 'Capacity') !!}
                                   {!! Form::text('capacity_in_mt', $warehouse->capacity_in_mt, ['class' => 'form-control', 'id' => 'capacity_in_mt', 'placeholder' => 'Capacity']) !!}
                           
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
                                    {{ Form::file('image', ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('gatepass_start', 'Gatepass Series Start') !!}
                                    {!! Form::text('gatepass_start', $warehouse->gatepass_start, ['class' => 'form-control', 'id' => 'gatepass_start', 'placeholder' => 'Enter Gatepass Series Start Number']) !!}

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
                                    {!! Form::text('gatepass_end', $warehouse->gatepass_end, ['class' => 'form-control', 'id' => 'gatepass_end', 'placeholder' => 'Enter Gatepass Series End Number']) !!}

                                    @if($errors->has('gatepass_end'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('gatepass_end') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('no_of_stacks', 'No of Stack') !!}
                                    {!! Form::number('no_of_stacks', $warehouse->no_of_stacks, ['class' => 'form-control', 'id' => 'no_of_stacks', 'placeholder' => 'Enter No of Stack']) !!}

                                    @if($errors->has('no_of_stacks'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('no_of_stacks') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('dharam_kanta', 'Dharam Kanta') !!}
                                    {!! Form::select('dharam_kanta', $dharm_kanta, $warehouse->dharam_kanta,['class' => 'form-control', 'id' => 'dharam_kanta']) !!}

                                    @if($errors->has('dharam_kanta'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('dharam_kanta') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('labour_contractor', 'Labour Contractor') !!}
                                    {!! Form::text('labour_contractor', $warehouse->labour_contractor, ['class' => 'form-control', 'id' => 'labour_contractor', 'placeholder' => 'Enter Labour Contractor Name']) !!}

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
                                    {!! Form::text('contractor_phone', $warehouse->contractor_phone, ['class' => 'form-control', 'id' => 'contractor_phone', 'placeholder' => 'Enter Contractor Phone']) !!}

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
                                    {!! Form::number('labour_rate', $warehouse->labour_rate, ['class' => 'form-control', 'id' => 'labour_rate', 'placeholder' => 'Labour Rate']) !!}

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
                                    {!! Form::textarea('transporter_info', $warehouse->nearby_transporter_info, ['class' => 'form-control', 'id' => 'transporter_info', 'placeholder' => 'NearBy Transporter Info', 'rows' => '3', 'cols' => '40']) !!}

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
                                    {!! Form::textarea('mandi_info', $warehouse->nearby_mandi_info, ['class' => 'form-control', 'id' => 'mandi_info', 'placeholder' => 'NearBy Mandi Info', 'rows' => '3', 'cols' => '40']) !!}

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
                                    {!! Form::textarea('crop_info', $warehouse->nearby_crop_info, ['class' => 'form-control', 'id' => 'crop_info', 'placeholder' => 'NearBy Crop Info', 'rows' => '3', 'cols' => '40']) !!}

                                    @if($errors->has('crop_info'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('crop_info') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
    
                                    <?php
                                    $fclts = json_decode($warehouse->facility_ids);
                                    if($fclts == null)
                                    {
                                      $fclts = array();
                                    }
                                    ?>
                                    {!! Form::label('facilities', 'Facilities') !!}<br />
                                    @foreach ($all_facilities as $f => $facility)

                                        {!! Form::checkbox('facilities[]', $f, in_array($f, $fclts), ['class' => 'md-check facilities', 'id' => $f] ) !!}

                                        {!! $facility !!}

                                    @endforeach

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
    
                                    <?php 
                                    $bank_id = json_decode($warehouse->bank_ids);
                                    if($bank_id == null)
                                    {
                                      $bank_id = array();
                                    }
                                    ?>
                                    {!! Form::label('banks', 'Banks (For Loan)') !!}<br />
                                    @foreach ($banks as $b => $bank)

                                        {!! Form::checkbox('banks[]', $b, in_array($b, $bank_id), ['class' => 'md-check banks', 'id' => $b] ) !!}

                                        {!! $bank !!}

                                    @endforeach

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::submit('Update Terminal', ['class' => 'btn btn-info btn btn-block']) !!}
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