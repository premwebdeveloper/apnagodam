@extends('layouts.public_app')

@section('content')
<?php
    date_default_timezone_set('Asia/Kolkata');
    $timestamp = date("H:i:s A");
?>
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
        <h1 class="text-center">Our {{ $cat->category }}</h1>
        <hr>
        <div class="row">
            <div class="col-md-12">
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
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Product Report</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventories as $key => $inventory)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $inventory->warehouse }}</td>
                                <td>{{ $inventory->quantity }}</td>
                                <input type="hidden" value="{{ $inventory->user_id }}" id="userid_{{ $inventory->id }}">
                                <input type="hidden" value="{{ Auth::user()->id }}" id="authuserid_{{ $inventory->id }}">
                                <td id="buyprice_{{ $inventory->id }}" val="{{ $inventory->price }}"><i class="fa fa-inr"></i> {{ $inventory->price }}</td>
                                <td>
                                    <a href="{{ asset('resources/assets/upload/inventory/'.$inventory->image) }}" class="btn btn-info btn-sm" target="_blank">
                                        View Report
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:;" id="{{ $inventory->id }}" class="btn btn-primary btn-sm buy_now" title="Buy Now">
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
            var buy_price = $("#buyprice_"+id).attr('val');
            var user_id = $("#userid_"+id).val();
            var auth_user_id = $("#authuserid_"+id).val();

            //alert(id +'_'+ buy_price +'_'+ user_id +'_'+ auth_user_id);

            $("#invnt_id").val(id);
            $("#seller_id").val(user_id);
            $("#buyer_id").val(auth_user_id);
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
            <form action="{{ route('buy_sell_price_update') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-body mx-3">
                    
                    <input type="hidden" name="invnt_id" id="invnt_id">
                    <input type="hidden" name="seller_id" id="seller_id">
                    <input type="hidden" name="buyer_id" id="buyer_id">

                    <div class="md-form mb-5">

                    <label data-error="wrong" data-success="right">Required Quantity</label>
                    <input id="update_price" type="text" class="form-control" name="price" required autofocus>
                    <br>
                    <label data-error="wrong" data-success="right">Conversation</label>
                    <textarea class="form-control" rows="5" cols="10" name="conversation" required></textarea>

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