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

                <h2 class="section-heading">You requested for loan against {!! $inventories->commodity !!} commodity with {!! $inventories->quantity !!} Bags.Your loan has been approved. If you want to have this then approve this.</h2>
                <br>

                <h4>Bank Name - {{ $inventories->res_bank_name }}</h4>
                <h4>Loan Amount - {{ $inventories->res_amount }} Rs.</h4>
                <h4>Interest - {{ $inventories->res_interest }} %</h4>
                    
                {!! Form::open(array('url' => 'user_agree_for_loan', 'files' => true)) !!}
                    
                    {!! Form::hidden('finance_id', $finance_id) !!}
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('agree', 'Agree') !!}
                            
                            {!! Form::select('agree', $agree, '', ['class' => 'form-control', 'id' => 'agree']) !!} 

                            @if($errors->has('agree'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('agree') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
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