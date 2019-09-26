@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>All Done Deals</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Done Deals</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Done Deals</h5>
                    <div class="ibox-tools">
                        <span class="red">Deal Approve Time : 01:00 PM to 06:30PM</span>
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
                                    <th>Buyer Name</th>
                                    <th>Seller Name</th>
                                    <th>Terminal</th>
                                    <th>Commodity</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Done Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($done_deals as $key => $done_deal)
                                    <tr class="gradeX">
                                        <td>{!! $done_deal->buyer_name !!}</td>
                                        <td>{!! $done_deal->seller_name !!}</td>
                                        <td>{!! $done_deal->warehouse !!}</td>
                                        <td>{!! $done_deal->category !!}</td>
                                        <td>{!! $done_deal->quantity !!}</td>
                                        <td>{!! $done_deal->price !!}</td>
                                        <td>{!! $done_deal->created_at !!}</td>
                                        <td>
                                            @if($done_deal->status == 2)
                                                <a href="{!! route('payment_accept', ['id' => $done_deal->id]) !!}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Deal Done">
                                                    Approve
                                                </a>
                                            @else
                                                <a href="{!! route('download_vikray_parchi', ['id' => $done_deal->id, 'email' => 0]) !!}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Deal Done">
                                                    Download PDF
                                                </a>
                                                <a href="{!! route('download_vikray_parchi', ['id' => $done_deal->id, 'email' => 1]) !!}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Send Pdf">
                                                    Send Mail
                                                </a>
                                            @endif
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
