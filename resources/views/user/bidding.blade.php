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
                <h4 class="section-heading text-center">
                    Someone want to buy your commodity [{{ $deal_info->category }}] placed in [{{ $deal_info->name }}]
                </h4>
    
                @if($deal_info->seller_id == Auth::user()->id)
                    <div class="col-md-12 text-right" style="padding: 0px;">
                        <a href="{{ route('deal_done', ['deal_id' => $deal_info->id]) }}" class="btn btn-success">Deal Done</a>
                    </div>
                @endif

                <div class="clearfix">&nbsp;</div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">User</th>
                            <th scope="col">Bid Price ( Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deal as $key => $d)
                            <tr>
                                @if($d->user_id == Auth::user()->id)
                                    
                                    <td>Me</td>
                                    <td>{{ $d->price }}</td>

                                @else
                                    
                                    <td>Dealer</td>
                                    <td>{{ $d->price }}</td>

                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {!! Form::open(array('url' => 'seller_bid')) !!}
                    
                    {!! Form::hidden('deal_id', $deal_info->id) !!}
                    
                    <div class="col-md-3" style="padding: 0px;">
                        <div class="form-group">
                            {!! Form::label('my_bid', 'My Bid') !!}
                            {!! Form::number('my_bid', '', ['class' => 'form-control', 'id' => 'my_bid', 'placeholder' => 'Price']) !!}

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
            
                <hr>
            </div>

        </div>
    </div>
</section>

@endsection