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
                                    <td><b>Name</b></td>
                                    <td><b>Village</b></td>
                                    <td><b>Capacity</b></td>
                                    <td><b>Facilities</b></td>
                                    <td><b>Image</b></td>
                                </tr>
                                <tr>
                                    <td>{{ $warehouse->name }}</td>
                                    <td>{{ $warehouse->village }}</td>
                                    <td>{{ $warehouse->capacity }}</td>
                                    <td>
                                        {{ rtrim($warehouse->facility_available, ', ') }}
                                    </td>
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
