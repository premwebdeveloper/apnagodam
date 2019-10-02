@extends('layouts.public_app')
@section('content')

<?php
$address = $terminal->address.','.$terminal->location.','.$terminal->area.','.$terminal->district;
$url = sprintf('https://maps.googleapis.com/maps/api/geocode/json?address=%s&key=%s', urlencode($address), urlencode('AIzaSyAB1vBRqGdwtdzsOOMeLf7mQLJ5PfVq-0s'));

$response = file_get_contents($url);
$output = json_decode($response, true);

if(isset($output['results'][0]))
{
    $latitude = $output['results'][0]['geometry']['location']['lat'];
    $longitude = $output['results'][0]['geometry']['location']['lng'];
}
?>

<style type="text/css">
    .apna .fa{
        font-size: 50px;
        margin-bottom: 20px;
    }
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 180px;
      }
      
    </style>

<section id="about">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <img alt="image" class="max-100" src="{{ asset('resources/assets/upload/warehouses/'.$terminal->image) }}"><br /><br />
                <h2 class="p-l-30">{!! $terminal->name !!}</h2>
                <p class="p-l-30">{!! $terminal->address !!}, {!! $terminal->location !!}, {!! $terminal->area !!}, {!! $terminal->district !!}</p>
                <div class="row p-l-30">
                    <div class="col-md-6 p-l-30">
                        <h4 class="p-t-20"><b>Facilities</b></h4>
                        <ul>
                            <?php
                            $fclty = explode(', ', rtrim($terminal->facility_available, ", "));
                            foreach ($fclty as $key => $value) {
                                ?>
                                <li>{!! $value !!}</li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="col-md-6 p-l-30">
                        <h4 class="p-t-20"><b>Distance from Current Location</b></h4>
                        <p id="km"></p>
                    </div>
                    <div class="col-md-12 p-l-30 b-t-1">
                        <h4 class="p-t-20"><b>Location</b></h4>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row b-b-1">
                    <div class="col-md-4">
                        <h4><b>Area in Sq.Ft.</b></h4>
                        <p>{!! $terminal->area_sqr_ft !!}</p>
                    </div>
                    <div class="col-md-4">
                        <h4><b>Rent Per Month</b></h4>
                        <p>{!! $terminal->rent_per_month !!}</p>
                    </div>
                    <div class="col-md-4">
                        <h4><b>Capacity In MT</b></h4>
                        <p>{!! $terminal->capacity_in_mt !!}</p>
                    </div>
                </div>
                <div class="row p-t-20 b-b-1">
                    <div class="col-md-12">
                        <h4><b>Near By Transport Info</b></h4>
                        <p><?php
                            $temp = explode('||', $terminal->nearby_transporter_info);
                            foreach ($temp as $key => $value) {
                                echo $value.' , ' ;
                            }
                        ?></p>
                    </div>
                </div>
                <div class="row p-t-20 b-b-1">
                    <div class="col-md-12">
                        <h4><b>Near By Mandi Info</b></h4>
                        <p>
                            <?php
                            $temp = explode('||', $terminal->nearby_mandi_info);
                            foreach ($temp as $key => $value) {
                                echo $value.' , ' ;
                            }
                        ?></p>
                    </div>
                </div>
                <div class="row p-t-20 p-b-30">
                    <div class="col-md-12">
                        <h4><b>Near By Crop Info</b></h4>
                        <p>{!! $terminal->nearby_crop_info !!}</p>
                    </div>
                </div>
                @if(session('status'))
                    <div class="alert alert-success alert-dismissible col-md-12">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col-md-12 p-30 p-t-30">
                    <form method="post" action="{{ route('warehouse_enquiry') }}">
                        @csrf
                        <div class="row" style="border:1px solid lightgray;border-radius: 5px;">
                            <div class="col-md-12 p-b-8 p-t-5" style="background-color: #00C0F5;">
                                <h4 class="text-center p-t-10"><b>Booking Form</b></h4>
                            </div>
                            <div class="col-md-6 p-b-20 p-t-10">
                                {!! Form::label('Commodity', 'Commodity') !!}
                                {!! Form::text('commodity', '', ['class' => 'form-control', 'id' => 'commodity', 'required' => 'required']) !!}

                                @if($errors->has('commodity'))
                                    <span class="help-block red">
                                        <strong>{{ $errors->first('commodity') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 p-b-20 p-t-10">
                                {!! Form::label('Quantity', 'Quantity') !!}
                                {!! Form::text('quantity', '', ['class' => 'form-control', 'id' => 'quantity', 'required' => 'required', 'placeholder' => 'Enter Quantity (Ton)']) !!}

                                @if($errors->has('quantity'))
                                    <span class="help-block red">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 p-b-20">
                                {!! Form::label('Mobile', 'Mobile') !!}
                                {!! Form::text('mobile', '', ['class' => 'form-control', 'id' => 'mobile', 'required' => 'required']) !!}

                                @if($errors->has('mobile'))
                                    <span class="help-block red">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                                
                            </div>
                            <div class="col-md-6 p-b-20">
                                {!! Form::label('Commitment (Time Period)', 'Commitment (Time Period)') !!}
                                {!! Form::text('commitment', '', ['class' => 'form-control', 'id' => 'commitment', 'required' => 'required']) !!}

                                @if($errors->has('commitment'))
                                    <span class="help-block red">
                                        <strong>{{ $errors->first('commitment') }}</strong>
                                    </span>
                                @endif     
                            </div>
                            <input type="hidden" value="<?php echo $terminal->id; ?>" id="warehouse_id" name="warehouse_id">
                            <div class="col-md-12 p-b-20">
                                 {!! Form::submit('Book Now', ['class' => 'btn btn-success btn btn-block']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="<?php echo $latitude; ?>" id="latitude" name="">
    <input type="hidden" value="<?php echo $longitude; ?>" id="longitude" name="">
    <input type="hidden" value="" id="current_address" name="">
</section>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCD12UaZxo_4B0ScJAkuwx7PgkUeV6DsFE&libraries=places&callback=initMap"></script>
<script>

  function initMap() {
    var latitude = jQuery('#latitude').val();
    var longitude = jQuery('#longitude').val();

    var myLatLng = {lat:parseFloat(latitude), lng:parseFloat(longitude)};

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 13,
      center: myLatLng
    });

    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      title: 'Warehouse'
    });
  }
</script>

<script type="text/javascript" charset="utf-8">

jQuery(document).ready(function() {
var currgeocoder;

//Set geo location lat and long

navigator.geolocation.getCurrentPosition(function(position, html5Error) {

geo_loc = processGeolocationResult(position);
currLatLong = geo_loc.split(",");
initializeCurrent(currLatLong[0], currLatLong[1]);

});

//Get geo location result

function processGeolocationResult(position) {
html5Lat = position.coords.latitude; //Get latitude
html5Lon = position.coords.longitude; //Get longitude
html5TimeStamp = position.timestamp; //Get timestamp
html5Accuracy = position.coords.accuracy; //Get accuracy in meters
return (html5Lat).toFixed(8) + ", " + (html5Lon).toFixed(8);
}

//Check value is present or not & call google api function

function initializeCurrent(latcurr, longcurr) {
currgeocoder = new google.maps.Geocoder();
//console.log(latcurr + "-- ######## --" + longcurr);

if (latcurr != '' && longcurr != '') {
var myLatlng = new google.maps.LatLng(latcurr, longcurr);
return getCurrentAddress(myLatlng);
}
}

 function getCurrentAddress(location) {
      currgeocoder.geocode({
          'location': location

    }, function(results, status) {
   
        var current_location = null;
        if (status == google.maps.GeocoderStatus.OK) {
            //console.log(results[0]);
            $("#address").html(results[0].formatted_address);
            current_location = results[0].formatted_address;
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }

        var address = '<?php echo $address; ?>';
        to_address = address.replace(/,/g, '-');
        current_location = current_location.replace(/,/g, '-');

        // Get Distance From Current location to Werehouse
        $.ajax({
            method : 'post',
            url: "{{ route('getWarehouseDistance') }}",
            async : true,
            data : {"_token": "{{ csrf_token() }}", 'current_location' : current_location, 'to_address' : to_address},
            success:function(response){
                console.log(response);
                $('#km').html(response);
            },
            error: function(data){
                //console.log(data);
            },
        });
    });
 }

});

</script>

@endsection
