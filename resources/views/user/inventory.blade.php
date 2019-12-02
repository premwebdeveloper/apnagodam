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
                      <th scope="col">Gate Pass</th>
                      <th scope="col">Truck No.</th>
                      <th scope="col">Terminal</th>
                      <th scope="col">Location</th>
                      <th scope="col">Commodity</th>
                      <th scope="col">Net Weight (Qtl.)</th>
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
                                <td>{{ $inventory->gate_pass_wr }}</td>
                                <td>{{ $inventory->truck_no }}</td>
                                <td>{{ $inventory->name }}</td>
                                <td>{{ $inventory->location }}</td>
                                <td>{{ $inventory->cat_name }}</td>
                                <td>{{ $inventory->quantity }}</td>
                                <td>
                                    {{ $inventory->quality_category }}&nbsp;&nbsp;&nbsp;
                                    @if(!empty($inventory->image))
                                    <a href="{{ asset('resources/assets/upload/inventory/'.$inventory->image.'') }}" data-toggle='tooltip' title="Download PDF" download>
                                        <i class="fa fa-download"></i>
                                    </a>
                                    @endif
                                </td>
                                <td>{{ date('d-M-Y', strtotime($inventory->created_at)) }}</td>
                                <td>
                                    <a href="javascript:;" id="{{ $inventory->id }}_{{ $inventory->quantity }}" class="btn btn-secondary form-control btn-sm want_to_sell" title="Edit Price">
                                        Want To Sell
                                    </a>

                                    @if(!empty($inventory->sell_quantity) &&  $inventory->sell_quantity != 0)
                                        <a href="{{ route('bidding', ['inventory_id' => $inventory->id]) }}" class="btn btn-info form-control btn-sm" title="Edit Price">
                                            My Bids
                                        </a>
                                    @endif
                                    @if(!in_array($inventory->id, $alll_loan))
                                        <a href="javascript:;" id="{!! $inventory->id !!}__{!! $inventory->price !!}__{!! $inventory->net_weight !!}__{!! $inventory->quantity !!}" class="apply_for_loan btn btn-success form-control btn-sm" title="Edit Price">
                                            Apply For Loan
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
            $("#sell_quantity").attr('max', temp[1]);

            $("#edit_price").modal('show');
        });

        $('.apply_for_loan').on('click', function(){
            var data = $(this).attr('id');
            var temp = data.split('__');
            var amount =  temp[1] * temp[3];
            var max_amount_val = '<?php echo $loan_max_value->loan_value ?>';
            var max_amount = (amount * max_amount_val) / 100;
            $("#loan_amount").attr('max', max_amount);
            $("#quantity").attr('max', temp[3]);
            $("#seller_inventory_id").val(temp[0]);
            $('#apply_for_loan_modal').modal('show');
        });
    });
</script>

<!-- Modal Open -->
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
                        <label data-error="wrong" data-success="right">Your Price (per Qtl.)</label>

                        <input id="update_price" type="number" class="form-control" name="price" required autofocus placeholder="Price">
                    </div>

                    <div class="md-form mb-5">
                        <label data-error="wrong" data-success="right">Net Weight (Qtl.)</label>

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
<!-- Modal Close -->

<!-- Modal -->
<div id="apply_for_loan_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="padding-left: 10px;">Apply For Loan</h4>
        <button type="button" class="close" style="padding-right: 20px;" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
            {!! Form::open(array('url' => 'loan_request', 'files' => true)) !!}
                <div class="row">
                    <input type="hidden" name="inventory_id" id="seller_inventory_id">
                    <div class="col-md-12 text-center">
                        <h4>Choose Bank</h4>
                        <table class="table responsive">
                            <tr>
                                <th>Action</th>
                                <th>Bank Name</th>
                                <th>Interest Rate</th>
                                <th>Days</th>
                            </tr>
                            @foreach($banks_master as $bank_master)
                                <tr>
                                    <th>
                                        @if($bank_master->id == 1)
                                            {!! Form::radio('apply_for_loan_bank',  $bank_master->id, ['class' => 'form-check-input', 'id' => 'apply_for_loan_bank', 'checked' => 'true', 'required' => 'required']) !!}
                                        @else
                                            {!! Form::radio('apply_for_loan_bank',  $bank_master->id, ['class' => 'form-check-input', 'id' => 'apply_for_loan_bank', 'checked' => 'false', 'required' => 'required']) !!}
                                        @endif
                                    </th>
                                    <th>{!! $bank_master->bank_name !!}</th>
                                    <th>{!! $bank_master->interest_rate !!}</th>
                                    <th>{!! $bank_master->loan_pass_days !!}</th>
                                </tr>
                            @endforeach
                        </table>
                        @if($errors->has('apply_for_loan_bank'))
                            <span class="help-block red">
                                <strong>{{ $errors->first('apply_for_loan_bank') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <span class="red">*</span><b>{!! Form::label('quantity', 'Net Weight (Qtl.)', ['class' => '']) !!}</b>
                            {!! Form::number('quantity', '', ['class' => 'form-control', 'id' => 'quantity', 'required' => 'required', 'placeholder' => 'Enter Net Weight (Qtl.)']) !!}

                            @if($errors->has('quantity'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <span class="red">*</span><b>{!! Form::label('amount', 'Loan Amount', ['class' => '']) !!}</b>
                            {!! Form::number('amount', '', ['class' => 'form-control', 'id' => 'loan_amount', 'required' => 'required', 'placeholder' => 'Enter Loan Amount']) !!}

                            @if($errors->has('amount'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h6 class="red">You can apply for loan less then {!! $loan_max_value->loan_value !!}% of Total Amount</h6>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::submit('APPLY FOR LOAN', ['class' => 'btn btn-info btn btn-block']) !!}
                        </div>
                    </div>

                </div>   
            {!! Form::close() !!}

      </div>
    </div>

  </div>
</div>

@endsection