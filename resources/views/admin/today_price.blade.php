@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Today's Price</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Today's Price</strong>
            </li>
        </ol>
    </div>
    <!-- <div class="col-lg-2 text-right">
        <h2>
            <a href="{{ route('create_facility') }}" class="btn btn-info">Add Facility</a>
        </h2>
    </div> -->
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Today's Price</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="ibox-content">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Commodity Name</th>
                                    <th>Commodity Price(per qtl)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($today_prices as $key => $today_price)
                                    <tr class="gradeX">
                                        <td>{!! $key + 1 !!}</td>
                                        <td>{!! $today_price->name !!}</td>
                                        <td>{!! $today_price->price !!}</td>
                                        <td>
                                            <a href="{!! route('today_price_edit_view', ['id' => $today_price->id]) !!}" class="btn btn-info btn-sm" title="Edit">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <!-- <a href="{!! route('facility_delete', ['id' => $today_price->id]) !!}" class="btn btn-info btn-sm" data-toggle="confirmation" data-placement="bottom" title="Delete Facility">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a> -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
