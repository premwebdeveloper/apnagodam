@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Inventory Details</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <a href="{{ route('inventory') }}">Inventories</a>
            </li>
            <li class="active">
                <strong>Inventory Details</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">

        <div class="col-md-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Inventory Detail</h5>
                </div>

                <div>
                    <div class="ibox-content no-padding border-left-right" style="border: 1px solid #e7eaec;">
                        <a href="{{ asset('resources/assets/upload/inventory/'.$inventory->image) }}">
                            <embed src="{{ asset('resources/assets/upload/inventory/'.$inventory->image) }}" width="100%" height="200px" />
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Inventory Informations</h5>
                </div>

                <div class="ibox-content">
                    <div class="feed-activity-list">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><b>Commodity</b></td>
                                    <td>{{ $inventory->category }}</td>
                                    <td><b>Quantity</b></td>
                                    <td>{{ $inventory->quantity }}</td>

                                </tr>
                                <tr>
                                    <td><b>Price</b></td>
                                    <td>{{ $inventory->price }}</td>
                                    <td><b>Date Of Deposit</b></td>
                                    <td>{{ $inventory->created_at }}</td>
                                </tr>
                                <tr>
                                    <td><b>Terminal</b></td>
                                    <td>{{ $inventory->warehouse }}</td>
                                    <td><b>Quality Category</b></td>
                                    <td>{{ $inventory->quality_category }}</td>
                                </tr>
                                <tr>
                                    <td><b>Gate Pass / WR No.</b></td>
                                    <td>{{ $inventory->gate_pass_wr }}</td>
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
