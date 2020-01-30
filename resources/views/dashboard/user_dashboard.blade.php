@extends('layouts.auth_app')

@section('content')
	<div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">All</span>
                        <h5>My Commodity</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $inventories }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">All</span>
                        <h5>My Purchases</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $buys }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">All</span>
                        <h5>My Sells</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $sells }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-right">All</span>
                        <h5>My Loan/Finance</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $finances }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <img alt="image" src="resources/assets/images/step.jpg" style="width: 100%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Today's Price (Per Qtl.)</h2>
                            </div>
                            <div class="col-md-6 text-right">
                                <h3>Last Update Date : <?= date('d-m-Y'); ?></h3>
                            </div>
                        </div>
                        <hr class="m-t-5">
                        <div class="table-responsive">
                            <table id="my_commodity" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Commodity</th>
                                        <th>Terminal</th>
                                        <th>Max (Superior)</th>
                                        <th>Modal (Average)</th>
                                        <th>Min (Low)</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($today_prices as $key => $today_price)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{!! $today_price->commodity !!}</td>
                                            <td>{!! $today_price->terminal_name !!}&nbsp;₹</td>
                                            <td>{!! $today_price->max !!}&nbsp;₹</td>
                                            <td>{!! $today_price->modal !!}&nbsp;₹</td>
                                            <td>{!! $today_price->min !!}&nbsp;₹</td>
                                            <td><img class="iblock bline" style="height: 60px;" src="{{ asset('resources/assets/upload/category/'.$today_price->image) }}"></td>
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

	<div class="row">
	<div class="col-lg-12">
@endsection