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

            <div class="col-md-12">

                <h2 class="section-heading">You requested for loan against {!! $inventories->category !!} commodity with {!! $inventories->quantity !!} Qty. Your loan has been approved. If you want to have this then approve this.</h2>
                <br>

                <div class="col-md-12 text-center">
                    <h3 style="font-size: 20px;">Bank Name - <i class="text-info">{{ $inventories->bank_name }}</i></h3>
                    <h3 style="font-size: 20px;">Loan Amount - <i class="text-info">₹ {{ $inventories->amount }}</i> </h3>
                    <h3 style="font-size: 20px;">Interest Rate - <i class="text-info">{{ $inventories->interest_rate }} </i></h3><br />
                </div>
                    
                {!! Form::open(array('url' => 'user_agree_for_loan', 'files' => true)) !!}
                    
                    {!! Form::hidden('finance_id', $finance_id) !!}
                    
                    <div class="col-md-4 offset-4 text-center">
                        <div class="form-group">
                            {!! Form::label('agree', 'Are you Agree') !!}
                            {!! Form::select('agree', $agree, '', ['class' => 'form-control', 'id' => 'agree']) !!} 

                            @if($errors->has('agree'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('agree') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4 offset-4 text-center">
                        <div class="form-group">
                            {!! Form::submit('Agree / Disagree', ['class' => 'btn btn-info btn btn-block']) !!}
                        </div>
                    </div>

                {!! Form::close() !!}


            </div>

        </div>
    </div>
</section>

@endsection