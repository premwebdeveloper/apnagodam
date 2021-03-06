@extends('layouts.auth_app')
@section('content')
<?php
    $temp = ($weight*20) + ($weight*4);
?>
<input type="hidden" id="n_main_price" value="{{ $user_data->price }}">
<input type="hidden" id="total_qtl" value="{{ $weight }}">

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>Corporate Buying</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Corporate Buying</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight" style="padding-bottom: 0px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Corporate Buying</h5>
                    <div class="ibox-tools">
                        <b class="f-s-20 red">( {{ $inventory->commodity_type }} ) </b>
                        <b class="f-s-20"> Quantity : <span>{!! $weight !!}</span> Qtl.</b>
                    </div>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" id="s_lat">
                            <input type="hidden" id="s_lng">
                            <input type="hidden" id="d_lat">
                            <input type="hidden" id="d_lng">
                            <h2 class="f-s-20 p-10 btn-primary"><b>{{ $user_data->user_name }} - <span>{!! $user_data->price !!} / Qtl.</span></b></h2>                            
                            {!! Form::open(array('url' => 'corporate_deal_done', 'class' => "", 'id' => 'neemranaForm')) !!}
                                @csrf
                                {!! Form::hidden('final_bid_price', '' , array('id' => 'nr_final_bid_price')) !!}
                                {!! Form::hidden('mandi_fees', '' , array('id' => 'nr_mandi_fees')) !!}
                                {!! Form::hidden('inventory_id', $inv_id) !!}
                                {!! Form::hidden('quantity', $weight) !!}
                                {!! Form::hidden('todays_price', $user_data->price) !!}
                                {!! Form::hidden('user_id', $user_data->user_id) !!}
                                <div class="col-md-6">
                                    {!! Form::label('pick_up_location', 'Pickup Location (Pincode)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::number('pick_up_location', '', ['id' => 'nr_pick_up_location', 'class' => 'form-control', 'min' => 5, 'autocomplete' => 'off', 'placeholder' => 'Enter Location Pincode']) !!}

                                    @if($errors->has('pick_up_location'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('pick_up_location') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    {!! Form::label('drop_location', 'Drop Location', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::text('drop_location', $user_data->pincode, ['id' => 'nr_drop_location', 'class' => 'form-control', 'autocomplete' => 'off',  'readonly' => 'readonly', 'placeholder' => 'Drop Location']) !!}

                                    @if($errors->has('drop_location'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('drop_location') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    {!! Form::label('total_km', 'Total KM', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::text('total_km', '', ['id' => 'nr_total_km', 'class' => 'form-control', 'readonly' => 'readonly', 'autocomplete' => 'off', 'placeholder' => 'Total KM']) !!}

                                    @if($errors->has('total_km'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('total_km') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    {!! Form::label('transport_cost', 'Transportation Cost @ 0.40/Km/Qtl', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::text('transport_cost', '', ['id' => 'nr_transport_cost', 'class' => 'form-control', 'readonly' => 'readonly', 'autocomplete' => 'off', 'placeholder' => 'Transportation Cost']) !!}

                                    @if($errors->has('transport_cost'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('transport_cost') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    {!! Form::label('finance_cost', 'E-Mandi @ 0.75/Qtl', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::text('finance_cost', '', ['id' => 'nr_finance_cost', 'class' => 'form-control', 'readonly' => 'readonly', 'autocomplete' => 'off', 'placeholder' => 'E-Mandi Cost @ 0.75 Rs. / Qtl']) !!}

                                    @if($errors->has('finance_cost'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('finance_cost') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    {!! Form::label('miscellaneous_cost', 'Labour Rate @ 10/Qtl', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::text('miscellaneous_cost', $labour_charge, ['id' => 'nr_miscellaneous_cost', 'class' => 'form-control', 'readonly' => 'readonly', 'autocomplete' => 'off', 'placeholder' => 'Labour Rate @ 10 Rs. / Qtl']) !!}

                                    @if($errors->has('miscellaneous_cost'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('miscellaneous_cost') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    {!! Form::label('mandi_fee', 'Mandi Fee @ 1.6 %', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::text('mandi_fee', '', ['id' => 'nr_mandi_fee', 'class' => 'form-control', 'readonly' => 'readonly', 'autocomplete' => 'off', 'placeholder' => 'Mandi Fee @ 1.6 %']) !!}

                                    @if($errors->has('mandi_fee'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('mandi_fee') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    {!! Form::label('quality_variance', 'Quality Variance', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                                    {!! Form::text('quality_variance', '', ['id' => 'nr_quality_variance', 'class' => 'form-control', 'readonly' => 'readonly', 'autocomplete' => 'off', 'placeholder' => 'Quality Variance']) !!}

                                    @if($errors->has('quality_variance'))
                                        <span class="text-red" role="alert">
                                            <strong class="red">{{ $errors->first('quality_variance') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6 m-t-20">
                                    <h2 class="f-s-18"><span class="f-s-18">Final Bid Price (Rs.) - </span> <b id="n_bid_price" class="f-s-22">0.00</b></h2>
                                </div>
                                <div class="col-md-6">
                                    {!! Form::button('Sell to '.$user_data->user_name, ['class' => 'btn btn-info m-t-20 form-control b-info hide neemrana_sell', 'onClick' => 'submitNeemranaForm()']) !!}
                                </div>
                            {!! Form::close() !!}
                        </div>
                        
                        <div class="col-md-6">
                            <h2 class="f-s-20 p-10 btn-primary"><b>Quality Variance Report - {{ $user_data->user_name }}</b></h2>
                            <div class="table-responsive132">
                                <table class="table table-striped table-hover ">
                                    <thead>
                                        <tr>
                                            <th>Quality Diff.</th>
                                            <th>UB Normal</th>
                                            <th>UB Extreme</th>
                                            <th>Actual</th>
                                            <th>Price Diff. (Rs.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="gradeX">
                                            <td>Moisture</td>
                                            <td><span id="mos_normal">11</span>%</td>
                                            <td><span id="mos_extreme">13</span>%</td>
                                            <td><input type="number" id="mos_actual" style="width:80px; float:left;" class="form-control" >%</td>
                                            <td><span id="mos_price"></span></td>
                                        </tr>
                                        <tr class="gradeX">
                                            <td>Broken</td>
                                            <td><span id="bro_normal">5</span>%</td>
                                            <td><span id="bro_extreme">6</span>%</td>
                                            <td><input type="number" id="bro_actual" style="width:80px; float:left;" class="form-control" >%</td>
                                            <td><span id="bro_price"></span></td>
                                        </tr>
                                        <tr class="gradeX">
                                            <td>Thin</td>
                                            <td><span id="thin_normal">6</span>%</td>
                                            <td><span id="thin_extreme">8</span>%</td>
                                            <td><input type="number" id="thin_actual" style="width:80px; float:left;" class="form-control" >%</td>
                                            <td><span id="thin_price"></span></td>
                                        </tr>
                                        <tr class="gradeX">
                                            <td>TCW</td>
                                            <td><span id="tcw_normal">40</span></td>
                                            <td><span id="tcw_extreme">39</span></td>
                                            <td><input type="number" id="tcw_actual" style="width:80px; float:left;" class="form-control" ></td>
                                            <td><span id="tcw_price"></span></td>
                                        </tr>
                                        <tr class="gradeX">
                                            <td>FM</td>
                                            <td><span id="fm_normal">1</span>%</td>
                                            <td><span id="fm_extreme">2</span>%</td>
                                            <td><input type="number" id="fm_actual" style="width:80px; float:left;" class="form-control" >%</td>
                                            <td><span id="fm_price"></span></td>
                                        </tr>
                                        <tr class="gradeX">
                                            <td>Total Price Diff.</td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td>QV Rs .<b class="" id="total_price">0.00</b> / Qtl.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="confrmationNeemranaBid" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Are you Sure?</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Do you want to sell your commodity to {{ $user_data->user_name }} at final Bid price?</h3>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <a type="button" class="btn btn-primary submitFormNeemrana">
                    Yes
                </a>
                <button type="button" class="btn btn-danger" onclick="this.disabled = true" data-dismiss="modal" aria-label="Close">
                    No
                </button>
            </div>
        </div>
    </div>
</div>

<div id="confrmationChomuBid" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Are you Sure?</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Do you want to sell your commodity to UB Chomu at final Bid price?</h3>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <a type="button" class="btn btn-primary submitFormChomu">
                    Yes
                </a>
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                    No
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyCD12UaZxo_4B0ScJAkuwx7PgkUeV6DsFE&libraries=geometry"></script>

<script>
    function submitNeemranaForm(e){
        $('#confrmationNeemranaBid').modal('show');
    }

    function submitChomuForm(e){
        $('#confrmationChomuBid').modal('show');
    }

    function distanceTwoPoints(p3, p4){
      return (google.maps.geometry.spherical.computeDistanceBetween(p3, p4) / 1000); //dividing by 1000 to get Kilometers
    }

    //calculates distance between two points in km's
    function calcDistance(p1, p2) {
      return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2);
    }

    function getSourceCoordinates(address){
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode({ 'address': 'zipcode '+address }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                $('#s_lat').val(latitude);
                $('#s_lng').val(longitude);
            }else{
                return false;
            }
        });
    }

    function getDesCoordinates(address){
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode({ 'address': 'zipcode '+address }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                $('#d_lat').val(latitude);
                $('#d_lng').val(longitude);
            }else{
                return false;
            }
        });
    }

    $(document).ready(function(){

        //Submit Bid for Neemrana
        $('.submitFormNeemrana').on('click', function(){
            $('#neemranaForm').submit();
        });

        //Get Moisture 
        $('#mos_actual').on('input', function(){
            var mos_actual_val = parseFloat($(this).val());
            var n_main_price = $('#n_main_price').val();        
            var mos_normal = $('#mos_normal').html();
            var mos_extreme = $('#mos_extreme').html();
            var pri_diff = 0;
            if(mos_actual_val)
            {
                if(mos_actual_val > mos_normal && mos_actual_val <= mos_extreme)
                {
                    pri_diff = ((mos_actual_val - mos_normal)/ 100) * n_main_price;
                }

                if(mos_actual_val > mos_extreme)
                {
                    pri_diff =  ((mos_actual_val - mos_normal)/ 100) * n_main_price;
                    pri_diff =  parseFloat(pri_diff);
                }
                if(mos_actual_val <= mos_normal)
                {
                    pri_diff = 0;
                }

                $('#mos_price').html(pri_diff.toFixed(2));

                if($('#bro_actual').val() && $('#fm_actual').val() && $('#thin_actual').val() && $('#tcw_actual').val())
                {
                    var total = parseFloat($('#mos_price').html());
                    total = total + parseFloat($('#bro_price').html());
                    total = total + parseFloat($('#fm_price').html());
                    total = total + parseFloat($('#thin_price').html());
                    total = total + parseFloat($('#tcw_price').html());
                    $('#total_price').html(total.toFixed(2));
                    var q_v = parseInt('<?= $weight; ?>') * total;
                    $('#nr_quality_variance').val(q_v.toFixed(2));

                    var total_cost = $('#n_main_price').val() * $('#total_qtl').val();
                    
                    if($('#nr_pick_up_location').val())
                    {
                        var bid_price = total_cost - (parseInt($('#nr_transport_cost').val()) + parseInt($('#nr_miscellaneous_cost').val()) + (parseInt($('#total_price').html() * parseInt($('#total_qtl').val()))));

                        var x = (n_main_price - parseInt('<?= $labour_charge; ?>'));
                        if('<?= ($inventory->sales_status == 1) ?>'){
                            var m = (2.2960429897*x)/100;
                            var final_price = x - m;
                            final_price = parseInt(final_price);

                        }else{
                            var m = (0.75*x)/100;
                            var final_price = x - m;
                            final_price = parseInt(final_price);
                        }
                        
                        var mandi_fee = ('<?= ($inventory->sales_status == 1)?1.6:0; ?>'*final_price)/100;
                        var e_mandi = (0.75*final_price)/100;
                        
                        $('#nr_finance_cost').val(e_mandi.toFixed(2));
                        $('#nr_mandi_fee').val(mandi_fee.toFixed(2));
                        $('#nr_mandi_fees').val(mandi_fee.toFixed(2));

                        var actual_bid = bid_price/parseInt($('#total_qtl').val());
                        $('#n_bid_price').html(final_price.toFixed(2)+" / Qtl");
                        $('#nr_final_bid_price').val(final_price.toFixed(2));
                        $('.neemrana_sell').removeClass('hide');
                        $('.neemrana_sell').addClass('show');
                    }
                }
            }else{
                $('#mos_price').html('');
                $('#total_price').html('');
                $('#nr_quality_variance').val('');
                $('.neemrana_sell').addClass('hide');
                $('.neemrana_sell').removeClass('show');
                $('.neemrana_sell').removeClass('show');
                $('#n_bid_price').html("0.00");
            }
        });

        //Get Broken
        $('#bro_actual').on('input', function(){
            var bro_actual_val = parseFloat($(this).val());
            var n_main_price = $('#n_main_price').val();        
            var bro_normal = $('#bro_normal').html();
            var bro_extreme = $('#bro_extreme').html();
            var pri_diff = 0;

            if(bro_actual_val)
            {

                if(bro_actual_val > bro_normal && bro_actual_val <= bro_extreme)
                {
                    pri_diff = ((bro_actual_val - bro_normal)/ 200) * n_main_price;
                }

                if(bro_actual_val > bro_extreme)
                {
                    pri_diff =  ((bro_actual_val - bro_normal)/ 100) * n_main_price;
                }
                if(bro_actual_val <= bro_normal)
                {
                    pri_diff = 0;
                }

                $('#bro_price').html(pri_diff.toFixed(2));

                if($('#mos_actual').val() && $('#fm_actual').val() && $('#thin_actual').val() && $('#tcw_actual').val())
                {
                    var total = parseFloat($('#mos_price').html());
                    total = total + parseFloat($('#bro_price').html());
                    total = total + parseFloat($('#fm_price').html());
                    total = total + parseFloat($('#thin_price').html());
                    total = total + parseFloat($('#tcw_price').html());
                    $('#total_price').html(total.toFixed(2));
                    var q_v = parseInt('<?= $weight; ?>') * total;
                    $('#nr_quality_variance').val(q_v.toFixed(2));

                    var total_cost = $('#n_main_price').val() * $('#total_qtl').val();
                    
                    if($('#nr_pick_up_location').val())
                    {                    
                        var bid_price = total_cost - (parseInt($('#nr_transport_cost').val()) + parseInt($('#nr_miscellaneous_cost').val()) + (parseInt($('#total_price').html() * parseInt($('#total_qtl').val()))));
                        var x = (n_main_price - parseInt('<?= $labour_charge; ?>'));
                        if('<?= ($inventory->sales_status == 1) ?>'){
                            var m = (2.2960429897*x)/100;
                            var final_price = x - m;
                            final_price = parseInt(final_price);

                        }else{
                            var m = (0.75*x)/100;
                            var final_price = x - m;
                            final_price = parseInt(final_price);
                        }

                        var mandi_fee = ('<?= ($inventory->sales_status == 1)?1.6:0; ?>'*final_price)/100;
                        var e_mandi = (0.75*final_price)/100;
                        
                        $('#nr_finance_cost').val(e_mandi.toFixed(2));
                        $('#nr_mandi_fee').val(mandi_fee.toFixed(2));
                        $('#nr_mandi_fees').val(mandi_fee.toFixed(2));

                        var actual_bid = bid_price/parseInt($('#total_qtl').val());
                        $('#n_bid_price').html(final_price.toFixed(2)+" / Qtl");
                        $('#nr_final_bid_price').val(final_price.toFixed(2));
                        $('.neemrana_sell').removeClass('hide');
                        $('.neemrana_sell').addClass('show');
                    }
                }
            }else{
                $('#bro_price').html('');
                $('#total_price').html('');
                $('#nr_quality_variance').val('');
                $('.neemrana_sell').addClass('hide');
                $('.neemrana_sell').removeClass('show');
                $('.neemrana_sell').removeClass('show');
                $('#n_bid_price').html("0.00");

            }
        });

        //Get Thin
        $('#thin_actual').on('input', function(){
            var thin_actual_val = parseFloat($(this).val());
            var n_main_price = $('#n_main_price').val();        
            var thin_normal = $('#thin_normal').html();
            var thin_extreme = $('#thin_extreme').html();
            var pri_diff = 0;

            if(thin_actual_val)
            {
                if(thin_actual_val > thin_normal && thin_actual_val <= thin_extreme)
                {
                    pri_diff = ((thin_actual_val - thin_normal)/ 200) * n_main_price;
                }

                if(thin_actual_val > thin_extreme)
                {
                    pri_diff =  ((thin_actual_val - thin_normal)/ 100) * n_main_price;
                }

                if(thin_actual_val <= thin_normal)
                {
                    pri_diff = 0;
                }

                $('#thin_price').html(pri_diff.toFixed(2));

                if($('#mos_actual').val() && $('#fm_actual').val() && $('#bro_actual').val() && $('#tcw_actual').val())
                {
                    var total = parseFloat($('#mos_price').html());
                    total = total + parseFloat($('#bro_price').html());
                    total = total + parseFloat($('#fm_price').html());
                    total = total + parseFloat($('#thin_price').html());
                    total = total + parseFloat($('#tcw_price').html());
                    $('#total_price').html(total.toFixed(2));
                    var q_v = parseInt('<?= $weight; ?>') * total;
                    $('#nr_quality_variance').val(q_v.toFixed(2));

                    var total_cost = $('#n_main_price').val() * $('#total_qtl').val();
                    
                    if($('#nr_pick_up_location').val())
                    {                    
                        var bid_price = total_cost - (parseInt($('#nr_transport_cost').val()) + parseInt($('#nr_miscellaneous_cost').val()) + (parseInt($('#total_price').html() * parseInt($('#total_qtl').val()))));
                        var x = (n_main_price - parseInt('<?= $labour_charge; ?>'));
                        if('<?= ($inventory->sales_status == 1) ?>'){
                            var m = (2.2960429897*x)/100;
                            var final_price = x - m;
                            final_price = parseInt(final_price);

                        }else{
                            var m = (0.75*x)/100;
                            var final_price = x - m;
                            final_price = parseInt(final_price);
                        }

                        var mandi_fee = ('<?= ($inventory->sales_status == 1)?1.6:0; ?>'*final_price)/100;
                        var e_mandi = (0.75*final_price)/100;
                        
                        $('#nr_finance_cost').val(e_mandi.toFixed(2));
                        $('#nr_mandi_fee').val(mandi_fee.toFixed(2));
                        $('#nr_mandi_fees').val(mandi_fee.toFixed(2));

                        var actual_bid = bid_price/parseInt($('#total_qtl').val());
                        $('#n_bid_price').html(final_price.toFixed(2)+" / Qtl");
                        $('#nr_final_bid_price').val(final_price.toFixed(2));
                        $('.neemrana_sell').removeClass('hide');
                        $('.neemrana_sell').addClass('show');
                    }
                }
            }else{

                $('#thin_price').html('');
                $('#total_price').html('');
                $('#nr_quality_variance').val('');
                $('.neemrana_sell').addClass('hide');
                $('.neemrana_sell').removeClass('show');
                $('.neemrana_sell').removeClass('show');
                $('#n_bid_price').html("0.00");
            }
        });

        //Get FM
        $('#fm_actual').on('input', function(){
            var fm_actual_val = parseFloat($(this).val());
            var n_main_price = $('#n_main_price').val();        
            var fm_normal = $('#fm_normal').html();
            var fm_extreme = $('#fm_extreme').html();
            var pri_diff = 0;

            if(fm_actual_val)
            {
                if(fm_actual_val > fm_normal && fm_actual_val <= fm_extreme)
                {
                    pri_diff = ((fm_actual_val - fm_normal)/ 100) * n_main_price;
                }

                if(fm_actual_val > fm_extreme)
                {
                    pri_diff =  ((fm_actual_val - fm_normal)/ 100) * n_main_price;
                }
                if(fm_actual_val <= fm_normal)
                {
                    pri_diff = 0;
                }

                $('#fm_price').html(pri_diff.toFixed(2));

                if($('#mos_actual').val() && $('#thin_actual').val() && $('#bro_actual').val() && $('#tcw_actual').val())
                {
                    var total = parseFloat($('#mos_price').html());
                    total = total + parseFloat($('#bro_price').html());
                    total = total + parseFloat($('#fm_price').html());
                    total = total + parseFloat($('#thin_price').html());
                    total = total + parseFloat($('#tcw_price').html());
                    $('#total_price').html(total.toFixed(2));
                    var q_v = parseInt('<?= $weight; ?>') * total;
                    $('#nr_quality_variance').val(q_v.toFixed(2));

                    var total_cost = $('#n_main_price').val() * $('#total_qtl').val();
                    
                    if($('#nr_pick_up_location').val())
                    {                    
                        var bid_price = total_cost - (parseInt($('#nr_transport_cost').val()) + parseInt($('#nr_miscellaneous_cost').val()) + (parseInt($('#total_price').html() * parseInt($('#total_qtl').val()))));

                        var x = (n_main_price - parseInt('<?= $labour_charge; ?>'));
                        if('<?= ($inventory->sales_status == 1) ?>'){
                            var m = (2.2960429897*x)/100;
                            var final_price = x - m;
                            final_price = parseInt(final_price);

                        }else{
                            var m = (0.75*x)/100;
                            var final_price = x - m;
                            final_price = parseInt(final_price);
                        }

                        var mandi_fee = ('<?= ($inventory->sales_status == 1)?1.6:0; ?>'*final_price)/100;
                        var e_mandi = (0.75*final_price)/100;
                        
                        $('#nr_finance_cost').val(e_mandi.toFixed(2));
                        $('#nr_mandi_fee').val(mandi_fee.toFixed(2));
                        $('#nr_mandi_fees').val(mandi_fee.toFixed(2));

                        var actual_bid = bid_price/parseInt($('#total_qtl').val());
                        $('#n_bid_price').html(final_price.toFixed(2)+" / Qtl");
                        $('#nr_final_bid_price').val(final_price.toFixed(2));
                        $('.neemrana_sell').removeClass('hide');
                        $('.neemrana_sell').addClass('show');
                    }
                }
            }else{
                $('#fm_price').html('');
                $('#total_price').html('');
                $('#nr_quality_variance').val('');
                $('.neemrana_sell').addClass('hide');
                $('.neemrana_sell').removeClass('show');
                $('.neemrana_sell').removeClass('show');
                $('#n_bid_price').html("0.00");
            }
        });

        //Get TCW
        $('#tcw_actual').on('input', function(){
            var tcw_actual_val = parseFloat($(this).val());
            var n_main_price = $('#n_main_price').val();        
            var tcw_normal = $('#tcw_normal').html();
            var tcw_extreme = $('#tcw_extreme').html();
            var pri_diff = 0;
            if(tcw_actual_val)
            {
                if(tcw_actual_val < tcw_normal && tcw_actual_val >= tcw_extreme)
                {
                    pri_diff = ((tcw_normal - tcw_actual_val)/ 100) * n_main_price;
                }

                if(tcw_actual_val <= tcw_extreme)
                {
                    pri_diff =  ((tcw_normal - tcw_actual_val)/ 100) * n_main_price;
                    pri_diff =  2*pri_diff;
                }
                if(tcw_actual_val >= tcw_normal)
                {
                    pri_diff = 0;
                }

                if($('#mos_actual').val() && $('#thin_actual').val() && $('#bro_actual').val() && $('#fm_actual').val())
                {
                    var total = parseFloat($('#mos_price').html());
                    total = total + parseFloat($('#bro_price').html());
                    total = total + parseFloat($('#fm_price').html());
                    total = total + parseFloat($('#thin_price').html());
                    total = total + parseFloat($('#tcw_price').html());
                    $('#total_price').html(total.toFixed(2));
                    var q_v = parseInt('<?= $weight; ?>') * total;
                    $('#nr_quality_variance').val(q_v.toFixed(2));

                    var total_cost = $('#n_main_price').val() * $('#total_qtl').val();
                    
                    if($('#nr_pick_up_location').val())
                    {                    
                        var bid_price = total_cost - (parseInt($('#nr_transport_cost').val()) + parseInt($('#nr_miscellaneous_cost').val()) + (parseInt($('#total_price').html() * parseInt($('#total_qtl').val()))));
                        var x = (n_main_price - parseInt('<?= $labour_charge; ?>'));
                        if('<?= ($inventory->sales_status == 1) ?>'){
                            var m = (2.2960429897*x)/100;
                            var final_price = x - m;
                            final_price = parseInt(final_price);

                        }else{
                            var m = (0.75*x)/100;
                            var final_price = x - m;
                            final_price = parseInt(final_price);
                        }

                        var mandi_fee = ('<?= ($inventory->sales_status == 1)?1.6:0; ?>'*final_price)/100;
                        var e_mandi = (0.75*final_price)/100;
                        
                        $('#nr_finance_cost').val(e_mandi.toFixed(2));
                        $('#nr_mandi_fee').val(mandi_fee.toFixed(2));
                        $('#nr_mandi_fees').val(mandi_fee.toFixed(2));

                        var actual_bid = bid_price/parseInt($('#total_qtl').val());
                        $('#n_bid_price').html(final_price.toFixed(2)+" / Qtl");
                        $('#nr_final_bid_price').val(final_price.toFixed(2));
                        $('.neemrana_sell').removeClass('hide');
                        $('.neemrana_sell').addClass('show');
                    }
                }

                $('#tcw_price').html(pri_diff.toFixed(2));
            }else{
                $('#tcw_price').html('');            
                $('#total_price').html('');
                $('#nr_quality_variance').val('');
                $('.neemrana_sell').addClass('hide');
                $('.neemrana_sell').removeClass('show');
                $('.neemrana_sell').removeClass('show');
                $('#n_bid_price').html("0.00");
            }
        });

        $('#nr_pick_up_location').on('input', function(){
            var pincode_lngth = $(this).val().length;
            var pincode = $(this).val();
            var n_main_price = $('#n_main_price').val(); 
            var drop_pincode = $('#nr_drop_location').val();
            if(pincode_lngth > 5)
            {
                getSourceCoordinates(pincode);
                getDesCoordinates(drop_pincode);

                var s_lat = $('#s_lat').val(); 
                var s_lng = $('#s_lng').val();
                var d_lat = $('#d_lat').val(); 
                var d_lng = $('#d_lng').val();

                var p1 = new google.maps.LatLng(s_lat, s_lng);
                var p2 = new google.maps.LatLng(d_lat, d_lng);
                var kmtr = distanceTwoPoints(p1, p2);
                kmtr = kmtr.toFixed(2);
                $('#nr_total_km').val(kmtr);
                /*if(kmtr > 100)
                {*/
                    var t_cost = (0.40 * kmtr)*parseInt($('#total_qtl').val());
                    if(t_cost < 7000 && t_cost > 1){
                       t_cost = 7000; 
                    }
                /*
                }else{
                    var t_cost = 0.35 * kmtr*parseInt($('#total_qtl').val());
                }*/
                t_cost = t_cost.toFixed(2);
                var temp = '<?= $temp; ?>';
                var t_e_cost = parseInt(temp)+parseInt(t_cost);
                var total_cost = $('#n_main_price').val() * $('#total_qtl').val();
                var cost = total_cost - t_e_cost;
                $('#nr_transport_cost').val(t_cost);

                if($('#mos_actual').val() && $('#thin_actual').val() && $('#bro_actual').val() && $('#fm_actual').val())
                {
                    var bid_price = total_cost - (parseInt($('#nr_transport_cost').val()) + parseInt($('#nr_miscellaneous_cost').val()) + (parseInt($('#total_price').html() * parseInt($('#total_qtl').val()))));

                    var x = (n_main_price - parseInt('<?= $labour_charge; ?>'));
                    if('<?= ($inventory->sales_status == 1) ?>'){
                        var m = (2.2960429897*x)/100;
                        var final_price = x - m;
                        final_price = parseInt(final_price);

                    }else{
                        var m = (0.75*x)/100;
                        var final_price = x - m;
                        final_price = parseInt(final_price);
                    }

                    var mandi_fee = ('<?= ($inventory->sales_status == 1)?1.6:0; ?>'*final_price)/100;
                    var e_mandi = (0.75*final_price)/100;

                    $('#nr_mandi_fee').val(mandi_fee.toFixed(2));
                    $('#nr_mandi_fees').val(mandi_fee.toFixed(2));

                    var actual_bid = (bid_price/parseInt($('#total_qtl').val()));
                    $('#n_bid_price').html(final_price.toFixed(2)+" / Qtl");
                    $('#nr_final_bid_price').val(final_price.toFixed(2));
                    $('.neemrana_sell').removeClass('hide');
                    $('.neemrana_sell').addClass('show');
                }
            }else{
                $('#nr_total_km').val(0);
                $('#nr_transport_cost').val(0);
                $('.neemrana_sell').addClass('hide');
                $('.neemrana_sell').removeClass('show');
                $('#n_bid_price').html("0.00");
            }
        });
    });

</script>
@endsection
