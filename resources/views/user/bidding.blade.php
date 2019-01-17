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
        <div class="row">

            <div class="col-lg-12">

                <h2 class="section-heading text-center">Bidding</h2>

                <hr>

                @if($inventory_info->user_id == Auth::user()->id)
                    <h4 class="section-heading text-center">
                        Someone want to buy your commodity [{{ $inventory_info->category }}] placed in [{{ $inventory_info->name }}]
                    </h4>
                    <h5 class="section-heading text-center">My selling price - {{ $inventory_info->price }} ( {{ $inventory_info->sell_quantity }} Qtl.)</h5>
                    <p class="section-heading text-right">
                        <a href="{{ route('deal_done', ['inventory_id' => $inventory_info->id]) }}" class="btn btn-info">Deal Done With Top Price</a>
                    </p>
                @else
                    <h4 class="section-heading text-center">
                        I want to buy commodity [{{ $inventory_info->category }}] placed in [{{ $inventory_info->name }}]
                    </h4>
                    <h5 class="section-heading text-center">Seller price - {{ $inventory_info->price }} ( {{ $inventory_info->sell_quantity }} Qtl.)</h5>
                    <p class="section-heading text-right">
                        <?php
                        $to_time = date("Y-m-d 17:00:00");
                        $from_time = date("Y-m-d H:i:s");
                        $diff = strtotime($to_time) - strtotime($from_time);
                        $time = floor($diff / 60);

                        echo $time ." Minutes Left";
                        ?>
                    </p>
                @endif

                @if(session('status'))
                    <div class="alert alert-warning alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('status') }}
                    </div>
                @endif

                <div class="clearfix">&nbsp;</div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Trader</th>
                            <th scope="col">Bid Price ( Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deal_info as $key => $d)
                            <tr>
                                <td>{{ $d->fname }}</td>
                                <td>{{ $d->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- if the logged in user is not seller then user can bid / show bid form to buyer only -->
                @if($inventory_info->user_id != Auth::user()->id)

                    {!! Form::open(array('url' => 'seller_bid')) !!}

                        {!! Form::hidden('inventory_id', $inventory_info->id) !!}

                        <div class="col-md-3" style="padding: 0px;">
                            <div class="form-group">
                                {!! Form::label('my_bid', 'My Bid') !!}
                                {!! Form::number('my_bid', '', ['class' => 'form-control', 'id' => 'my_bid', 'placeholder' => 'Price', 'required' => 'required']) !!}

                                @if($errors->has('my_bid'))
                                    <span class="help-block red">
                                        <strong>{{ $errors->first('my_bid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-3" style="padding-top: 10px;">
                            <div class="from-group">
                                {!! Form::label('', '') !!}
                                {!! Form::submit('Submit Bid', ['class' => 'btn btn-info btn btn-block']) !!}
                            </div>
                        </div>

                    {!! Form::close() !!}

                @endif

                <hr>
            </div>
        </div>
    </div>
</section>

@endsection