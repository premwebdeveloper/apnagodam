@extends('layouts.auth_app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Bidding</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Bidding</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content ">
                    <div class="row">
                        <div class="col-lg-6">

                            <h2>
                                {{ $inventory_info->category }}
                            </h2>
                            <h3>Location : {{ $inventory_info->name }}, {{ $inventory_info->area }}</h3>

                        </div>
                        <div class="col-lg-6 text-right">
                            @if($inventory_info->user_id == Auth::user()->id)
                                <h3>
                                    Someone wants to buy your commodity.
                                </h3>
                                <h2 class="f-s-20">Price - <b>{{ $inventory_info->price }} Rs. per Qtl. ( {{ $inventory_info->sell_quantity }} Qtl.)</b></h2>
                                @php
                                    $begin = date('H:i:s', strtotime('00:00'));
                                    $end = date('H:i:s', strtotime('23:59'));
                                    $now = date('H:i:s');
                                @endphp
                                @if($now < $begin)
                                    <p class="section-heading text-right">
                                        Bid Accepet Time: 12:30 PM - 13:00 PM
                                    </p>
                                @elseif($now >= $begin && $now <= $end)
                                    @if(count($deal_info) >= 1)
                                        <p class="section-heading text-right">
                                            <a href="{{ route('deal_done', ['inventory_id' => $inventory_info->id]) }}" class="btn btn-primary btn-xs f-s-18">Accept With High Price</a>
                                        </p>
                                        <b class="red f-s-18">Remaining Time : </b><b class="red f-s-18" id="bid_time_out"> </b>
                                        <script>
                                            // Set the date we're counting down to
                                            var countDownDate = new Date("<?= date('M d, Y 20:00:00'); ?>").getTime();

                                            // Update the count down every 1 second
                                            var x = setInterval(function() {

                                              // Get today's date and time
                                              var now = new Date().getTime();
                                                
                                              // Find the distance between now and the count down date
                                              var distance = countDownDate - now;
                                                
                                              // Time calculations for days, hours, minutes and seconds
                                              var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                              var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                              var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                
                                              // Output the result in an element with id="demo"
                                              document.getElementById("bid_time_out").innerHTML = hours + " H "
                                              + minutes + "m " + seconds + "s ";
                                                
                                              // If the count down is over, write some text 
                                              if (distance < 0) {
                                                clearInterval(x);
                                                document.getElementById("bid_time_out").innerHTML = "EXPIRED";
                                              }
                                            }, 1000);
                                            </script>
                                    @endif
                                @else
                                    <p class=" red">Your Time Out. You can't accept this Bid now. Bid Again Tomorrow.</p>
                                @endif
                            @else
                                @php
                                    $begin = date('H:i:s', strtotime('      00:00'));
                                    $end = date('H:i:s', strtotime('23:59'));
                                    $now = date('H:i:s');
                                    $bid_open = 0;
                                @endphp
                                <h2 class="f-s-20">Seller Price - <b>{{ $inventory_info->price }} ( {{ $inventory_info->sell_quantity }} Qtl.)</b></h2>
                                @if($now < $begin)
                                    <p class="section-heading text-right">
                                        Bid Time: 08:00 AM - 12:30 PM
                                    </p>
                                @elseif($now >= $begin && $now <= $end)
                                    @php
                                    $bid_open = 1;
                                    echo '<p class="f-s-16" style="color: green;"><b>You can bid now. Bid is Open</b></p>';
                                    @endphp
                                    <b class="red f-s-18">Remaining Time : </b><b class="red f-s-18" id="bid_time_out"> </b>
                                    <script>
                                        // Set the date we're counting down to
                                        var countDownDate = new Date("<?= date('M d, Y 20:30:00'); ?>").getTime();

                                        // Update the count down every 1 second
                                        var x = setInterval(function() {

                                          // Get today's date and time
                                          var now = new Date().getTime();
                                            
                                          // Find the distance between now and the count down date
                                          var distance = countDownDate - now;
                                            
                                          // Time calculations for days, hours, minutes and seconds
                                          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                            
                                          // Output the result in an element with id="demo"
                                          document.getElementById("bid_time_out").innerHTML = hours + " H "
                                          + minutes + "m " + seconds + "s ";
                                            
                                          // If the count down is over, write some text 
                                          if (distance < 0) {
                                            clearInterval(x);
                                            document.getElementById("bid_time_out").innerHTML = "EXPIRED";
                                          }
                                        }, 1000);
                                        </script>
                                @else
                                    <p class=" red">You can not bid now. Bid Time Out.Better luck Tomorrow</p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @if($inventory_info->user_id != Auth::user()->id)
            @if($bid_open == 1)
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="row">
                                {!! Form::open(array('url' => 'seller_bid')) !!}
                                    {!! Form::hidden('inventory_id', $inventory_info->id) !!}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('my_bid', 'My Bid') !!}
                                            {!! Form::number('my_bid', '', ['class' => 'form-control', 'id' => 'my_bid', 'step' => 'any', 'placeholder' => 'Price', 'required' => 'required']) !!}

                                            @if($errors->has('my_bid'))
                                                <span class="help-block red">
                                                    <strong>{{ $errors->first('my_bid') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="from-group">
                                            {!! Form::label('', '') !!}
                                            {!! Form::submit('Submit Bid', ['class' => 'btn btn-info btn btn-block']) !!}
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        <div class="col-lg-9">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-12">
                            @if(session('status'))
                                <div class="alert alert-info alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table id="my_sell" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Trader</th>
                                            <th scope="col">Bid Price ( Rs.)</th>
                                            <th scope="col">Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        ?>
                                        @foreach($deal_info as $key => $d)
                                            <tr>
                                                <!-- <td>{{ $d->fname }}</td> -->
                                                <td>{{ $i }}</td>
                                                <td>{{ $d->price }}</td>
                                                <td>{{ date('H:i', strtotime($d->updated_at)) }}</td>
                                            </tr>
                                            <?php
                                            $i++;
                                            ?>
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

@endsection