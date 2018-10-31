@extends('layouts.public_app')

@section('content')

<script type="text/javascript">
    $(document).ready(function(){
        //var cat_id = '<?= $cat->id; ?>';
        $("#<?= $cat->id; ?>").addClass('liactive');
    });
</script>
<style>
    .py-4{
        padding-top: 0rem!important;
    }
    .masthead{
        height: 20vh!important;
        min-height: 140px!important;
    }
    .card-product .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 220px;
    text-align: center;
    }
    .card-product .img-wrap img {
        max-height: 100%;
        max-width: 100%;
        object-fit: cover;
    }
    .card-product .info-wrap {
        overflow: hidden;
        padding: 15px;
        border-top: 1px solid #eee;
    }
    .card-product .bottom-wrap {
        padding: 15px;
        border-top: 1px solid #eee;
    }

    .label-rating { margin-right:10px;
        color: #333;
        display: inline-block;
        vertical-align: middle;
    }

    .card-product .price-old {
        color: #999;
    }

</style>
<header class="masthead text-white d-flex masthalf"></header>
<section id="about">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <p style="float: right;font-weight: bold;">
                    <strong>Click 
                    <a href="https://www.ncdex.com/MarketData/LiveFuturesQuotes.aspx" target="_blank">
                        Here
                    </a>
                    for Current Updates</strong>
                </p>
            </div>
            <div class="col-md-12">
                <h1 class="text-center">Our {{ $cat->category }}</h1>
                <hr>
                @if($errors->any())
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{$errors->first()}}
                    </div>
                @endif
                <div class="col-md-3">
                    <ul class="apna_godam">
                        @foreach($categories as $key => $category)

                            <li id="{{ $category->id }}">
                                <a href="{!! route('buy_sell_view', ['id' => $category->id]) !!}">{{ $category->category }}</a>
                            </li>

                        @endforeach
                    </ul>
                </div>
                <div class="col-md-9">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Warehouse</th>
                                <th scope="col">Quantity (Bags)</th>
                                <th scope="col">Price (<i class="fa fa-inr"></i>/Bag)</th>
                                <th scope="col">Product Report</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventories as $key => $inventory)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $inventory->warehouse }}</td>
                                    <td>{{ $inventory->sell_quantity }}</td>

                                    <input type="hidden" value="{{ $inventory->user_id }}" id="userid_{{ $inventory->id }}" class="this_seller_id">

                                    <td>{{ $inventory->price }}</td>

                                    <td>
                                        <a href="{{ asset('resources/assets/upload/inventory/'.$inventory->image) }}" class="btn btn-info btn-sm" target="_blank">
                                            View Report
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:;" 
                                        id="{{ $inventory->id.'_'.$inventory->user_id }}" 
                                        class="btn btn-primary btn-sm buy_now" 
                                        title="Buy Now">
                                            Buy Now
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- col // -->
            </div>
        </div> <!-- row.// -->
    </div>
</section>

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
@endsection