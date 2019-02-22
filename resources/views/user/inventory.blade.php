@extends('layouts.public_app')

@section('content')
<style>
    .py-4{
        padding-top: 0rem!important;
    }
    .masthead{
        height: 20vh!important;
        min-height: 140px!important;
    }
</style>
<header class="masthead text-white d-flex masthalf"></header>
<section id="about">
    <div class="container">
            @if(session('status'))
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                </div>
            @endif
        <div class="row">

            <div class="col-lg-12 text-center">

                <h2 class="section-heading">My Commodity</h2>
                <hr>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Terminal</th>
                      <th scope="col">Location</th>
                      <th scope="col">Commodity</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Quality Category</th>
                      <th scope="col">Create Date</th>
                      <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $key => $inventory)

                        @if($inventory->quantity > 0)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $inventory->name }}</td>
                                <td>{{ $inventory->village }}</td>
                                <td>{{ $inventory->cat_name }}</td>
                                <td>{{ $inventory->quantity }}</td>
                                <td>
                                    {{ $inventory->quality_category }}&nbsp;&nbsp;&nbsp;
                                    <a href="{{ asset('resources/assets/upload/inventory/'.$inventory->image.'') }}" data-toggle='tooltip' title="Download PDF" download>
                                        <i class="fa fa-download"></i>
                                    </a>
                                </td>
                                <td>{{ date('d-M-Y', strtotime($inventory->created_at)) }}</td>
                                <td>
                                    @php
                                        $user = DB::table('user_roles')->where('user_id', Auth::user()->id)->first();
                                        $role_id = $user->role_id;
                                    @endphp
                                    @if($role_id == 5)
                                        <a href="javascript:;" id="{{ $inventory->id }}_{{ $inventory->quantity }}" class="btn btn-info btn-sm want_to_sell" title="Edit Price">
                                            Want To Sell
                                        </a>
                                    @endif

                                    @if(!empty($inventory->sell_quantity) &&  $inventory->sell_quantity != 0)
                                        <a href="{{ route('bidding', ['inventory_id' => $inventory->id]) }}" class="btn btn-warning btn-sm" title="Edit Price">
                                            My Bids
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endif

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function(){
        $(".want_to_sell").on('click', function(){
            var data = $(this).attr('id');
            var temp = data.split('_');

            $("#invetory_id").val(temp[0]);
            $("#sell_quantity").val(temp[1]);
            $("#edit_price").modal('show');
        });
    });
</script>

<!-- Modal -->
<div class="modal fade" id="edit_price" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

                    <input type="hidden" name="invetory_id" id="invetory_id">

                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right">Your Price</label>

                        <input id="update_price" type="number" class="form-control" name="price" required autofocus placeholder="Price">
                    </div>

                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right">Quantity</label>

                        <input id="sell_quantity" type="number" class="form-control" name="sell_quantity" required autofocus placeholder="quantity">
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-default">Update Price</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->

@endsection