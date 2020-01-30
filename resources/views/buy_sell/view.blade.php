@extends('layouts.auth_app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Our {{ $cat[0]->category }}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Our {{ $cat[0]->category }}</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Our {{ $cat[0]->category }}</h5>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="ibox">
                                <div class="ibox-content categoory-list">
                                    @foreach($categories as $key => $category)
                                        @if($category->commodity_type != 'Paid')
                                            <div class="label d-i-b">
                                                 <a href="{!! route('buy_sell_view', ['id' => strtolower($category->category)]) !!}" class="product-name">{{ $category->category }}</a>
                                            </div>
                                            <hr>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="table-responsive">
                                <table id="my_sell" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Terminal</th>
                                            <th scope="col">Commodity Type</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">Net Weight (Qtl)</th>
                                            <th scope="col">Quality Category</th>
                                            <th scope="col">Price (<i class="fa fa-inr"></i>/Qtl.)</th>
                                            <th scope="col">Lab Report</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($inventories as $key => $inventory)
                                            @if($inventory->quantity > 0)
                                                <tr>
                                                    <th scope="row">{{ $key + 1 }}</th>
                                                    <td>{{ $inventory->warehouse }}</td>
                                                    <td><span class="label label-success">{{ $inventory->commodity_type }}</span></td>
                                                    <td>{{ $inventory->warehouse_location }}</td>
                                                    <td>{{ $inventory->sell_quantity }}</td>
                                                    <td>{{ $inventory->quality_category }}</td>

                                                    <input type="hidden" value="{{ $inventory->user_id }}" id="userid_{{ $inventory->id }}" class="this_seller_id">

                                                    <td>{{ $inventory->price }}</td>

                                                    <td>
                                                        @if($inventory->image)
                                                        <a href="{{ asset('resources/assets/upload/inventory/'.$inventory->image) }}" class="btn btn-info btn-xs" target="_blank">
                                                            View Report
                                                        </a>
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('bidding', ['inventory_id' => $inventory->id])}}" class="btn btn-warning btn-xs" title="Bids">
                                                            Bids
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
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
<script type="text/javascript">
    $(document).ready(function(){
        $("#my_sell").dataTable();
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".buy_now").on('click', function(){

            var id = $(this).attr('id');
            $("#invnt_attr").val(id);
            $("#buy_now_modal").modal('show');

        });
    });
</script>

<!-- Modal -->
<div class="modal fade" id="buy_now_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('purchasing') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-body mx-3">

                    <input type="hidden" name="invnt_attr" id="invnt_attr">

                    <div class="md-form mb-5">

                        <label data-error="wrong" data-success="right">Required Quantity</label>
                        <input id="req_quantity" type="number" class="form-control" name="req_quantity" required autofocus placeholder="Quantity">
                        <br>

                        <label data-error="wrong" data-success="right">Price</label>

                        <input class="form-control" name="price" id="price" required placeholder="Price">

                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-default">Send Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style type="text/css">
    .d-i-b{display: inline-block;}
    .categoory-list .active a{
        color:#1ab394;
    }
    .label{width: 100%}
    hr{margin-top:10px;margin-bottom:10px; }
</style>
@endsection