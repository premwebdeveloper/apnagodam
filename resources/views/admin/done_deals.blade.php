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
                                    <th>Buyer Name</th>
                                    <th>Seller Name</th>
                                    <th>Warehouse</th>
                                    <th>Commodity</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Done Date</th>
                                    <!-- <th>Action</th> -->
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
                                        <!-- <td>
                                            <a href="{!! route('user_view', ['id' => $done_deal->id]) !!}" class="btn btn-info btn-sm" title="View">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td> -->
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