@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Warehouse Details</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <a href="{{ route('warehouses') }}">Warehouses</a>
            </li>
            <li class="active">
                <strong>Warehouse Details</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">

        <div class="col-md-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Warehouse Details</h5>
                </div>

                <div class="ibox-content">
                    <div class="feed-activity-list">                        
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>Village</td>
                                    <td>Capacity</td>
                                    <td>Items</td>
                                    <td>Facilities</td>
                                </tr>
                                <tr>
                                    <td>{{ $warehouse->name }}</td>    
                                    <td>{{ $warehouse->village }}</td>
                                    <td>{{ $warehouse->capacity }}</td>
                                    <td>
                                        {{ $warehouse->items }}
                                    </td>
                                    <td>
                                        {{ $warehouse->facilities }}
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