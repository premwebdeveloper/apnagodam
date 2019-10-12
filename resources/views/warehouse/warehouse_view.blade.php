@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Terminal Details</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <a href="{{ route('warehouses') }}">Terminals</a>
            </li>
            <li class="active">
                <strong>Terminal Details</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">

        <div class="col-md-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Terminal Details</h5>
                </div>

                <div class="ibox-content">
                    <div class="feed-activity-list">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><b>Name</b></td><td>{{ $warehouse->name }}</td>
                                </tr>
                                <tr>
                                    <td><b>Address</b></td><td>{{ $warehouse->address }}</td>
                                </tr>
                                <tr>
                                    <td><b>Location</b></td><td>{{ $warehouse->location }}</td>
                                </tr>
                                <tr>
                                    <td><b>Area</b></td><td>{{ $warehouse->area }}</td>
                                </tr>
                                <tr>
                                    <td><b>District</b></td><td>{{ $warehouse->district }}</td>
                                </tr>
                                <tr>
                                    <td><b>Area (SQ. FT.)</b></td><td>{{ $warehouse->area_sqr_ft }}</td>
                                </tr>
                                <tr>
                                    <td><b>Rent</b></td><td>{{ $warehouse->rent_per_month }}</td>
                                </tr>
                                <tr>
                                    <td><b>Capacity (MT )</b></td><td>{{ $warehouse->capacity_in_mt }}</td>
                                </tr>
                                <tr>
                                    <td><b>NearBy Transporter Info </b></td>
                                    <td>
                                        {{ $warehouse->nearby_transporter_info }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>NearBy Mandi Info </b></td><td>{{ $warehouse->nearby_mandi_info }}</td>
                                </tr>
                                <tr>
                                    <td><b>NearBy Crop Info </b></td><td>{{ $warehouse->nearby_crop_info }}</td>
                                </tr>
                                <tr>
                                    <td><b>Facilities</b></td>
                                    <td>
                                        {{ rtrim($warehouse->facility_available, ', ') }}
                                    </td>                                    
                                </tr>
                                <tr>
                                    <td><b>Banks</b></td>
                                    <td>
                                        {{ rtrim($warehouse->bank_provide_loan, ', ') }}
                                    </td>                                    
                                </tr>
                                <tr>
                                    <td><b>Image</b></td>
                                    <td>
                                        <img alt="image" class="img-responsive" src="{{ asset('resources/assets/upload/warehouses/'.$warehouse->image) }}" style="height:50px;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
