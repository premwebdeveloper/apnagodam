@extends('layouts.auth_app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>On Spot Commodity</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>On Spot Commodity</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>On Spot Commodity</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {!! session('status') !!}
                        </div>
                    @endif
                </div>

                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="my_commodity" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Terminal</th>
                                    <th>Commodity</th>
                                    <th>Net Weight (Qtl.)</th>
                                    <th>Quality Grade</th>
                                    <th>Create Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inventories as $key => $inventory)
                                    @if($inventory->quantity > 0)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $inventory->name }}</td>
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
                                                
                                                @if(!empty($inventory->sell_quantity) &&  $inventory->sell_quantity != 0)
                                                    <a href="javascript:;" data-id="{{ $inventory->id }}_{{ $inventory->quantity }}_{{ $inventory->cat_name }}" class="e_mandi btn btn-primary btn-xs" title="Update Price">
                                                        Update Price
                                                    </a>
                                                    <a href="{{ route('bidding', ['inventory_id' => $inventory->id]) }}" class="btn btn-warning btn-xs" title="Edit Price">
                                                        My Bids
                                                    </a>
                                                @else
                                                    <a href="javascript:;" id="{{ $inventory->id }}_{{ $inventory->quantity }}_{{ $inventory->cat_name }}" class="btn btn-primary btn-xs want_to_sell" title="Edit Price">
                                                        Want To Sell
                                                    </a>
                                                @endif
                                                @if(!in_array($inventory->id, $alll_loan))
                                                    <a href="javascript:;" id="{!! $inventory->id !!}__{!! $inventory->price !!}__{!! $inventory->net_weight !!}__{!! $inventory->quantity !!}" class="apply_for_loan btn btn-success btn-xs" title="Edit Price">
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
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#my_commodity").dataTable( {
        dom: 'Bfrtip',
        buttons: ['csv', 'excel', 'pdf', 'print'],
        exportOptions:{
           columns: ':not(:last-child)'
        }
    } );
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".e_mandi").on('click', function(){
            $('#update_price').val('');
            var data = $(this).attr('data-id');
            var temp = data.split('_');
            $("#invetory_id").val(temp[0]);
            $("#sell_quantity").val(temp[1]);
            $("#sell_quantity").attr('max', temp[1]);
            $("#sell_for_change").modal('hide');
            $("#edit_price").modal('show');
        });

        $(".want_to_sell").on('click', function(){

            $('#update_price').val('');

            var data = $(this).attr('id');
            var temp = data.split('_');

            $.ajax({
                method : 'post',
                url: "{{ route('get_todays_price_by_inventory') }}",
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'inventory_id' : temp[0]},
                success:function(response){

                    $("#invetory_id").val(temp[0]);
                    $("#sell_quantity").val(temp[1]);
                    $("#sell_quantity").attr('max', temp[1]);
                    
                    if(response == 0){

                        alert('Ask Administrator to update today`s price for the commodity, You want to sell.');
                    }else{

                        $('#update_price').val(response)                              
                    }

                    if(temp[2] == 'BARLEY' || temp[2] == 'Barley')
                    {
                        var res = temp[0]+"_"+temp[1];
                        $('#e_mandi').attr('data-id', res);
                        $('#corporate_buying').attr('data-id', temp[0]);
                        $("#sell_for_change").modal('show');
                    }else{
                        $("#edit_price").modal('show');
                    }
                },
                error: function(data){
                    console.log(data);
                },
            });

        });

        $("#corporate_buying").on('click', function(){
            var inv_id = $(this).attr('data-id');

            $.ajax({
                method : 'post',
                url: "{{ route('get_corporate_users_ajax') }}",
                async : true,
                data : {"_token": "{{ csrf_token() }}"},
                success:function(response){
                    $("#corporate_users").html(response);
                    $("#inv_id").val(inv_id);
                    $('#sell_for_change').modal('hide');
                    $('#corporate_users_modal').modal('show');
                },
                error: function(data){
                    console.log(data);
                },
            });
        });

        // apply for loan class open modal
        $('.apply_for_loan').on('click', function(){

            $('.warning').html('');
            $('#loan_amount').val('');
            $('.apply_for_loan_bank[value="1"]').prop('checked', true);

            var data = $(this).attr('id');
            var temp = data.split('__');
            console.log(temp);

            var quantity = temp[3];
                        
            // fill quantity of this commodity
            $("#quantity").val(quantity);
            $("#seller_inventory_id").val(temp[0]);
            $('#apply_for_loan_modal').modal('show');
        });

        // apply for loan id click button check all is well or not
        $(document).on('click', '#apply_for_loan', function(){

            var seller_inventory_id = $('#seller_inventory_id').val();
            var quantity = $('#quantity').val();
            var loan_amount = $('#loan_amount').val();
            var apply_for_loan_bank = $('.apply_for_loan_bank:checked').val();
            var loan_per_total_amount = $('.apply_for_loan_bank:checked').attr('data-id');

            //alert(seller_inventory_id+'||'+quantity+'||'+loan_amount+'||'+apply_for_loan_bank+'||'+loan_per_total_amount);

            $('.warning').html('');

            // if seller InventoryID OR Quantity OR LoanPerTotalAmount is blank then reload page
            if(seller_inventory_id == '' || quantity == '' || loan_per_total_amount == ''){

                location.reload(true);
            }

            // if loan amount is not empty then proccedd apply for loan
            if(loan_amount != ''){

                // Get today's price of this commodit onwhich you are applying to loan
                $.ajax({
                    method : 'post',
                    url: "{{ route('get_total_loan_amount') }}",
                    async : true,
                    data : {"_token": "{{ csrf_token() }}", 'inventory_id' : seller_inventory_id, 'quantity' : quantity, 'loan_amount' : loan_amount, 'loan_per_total_amount' : loan_per_total_amount},
                    success:function(response){

                        if(response == 0){

                            $('.warning').html('Ask Administrator to update today`s price for the commodity, You are appling to loan for.');
                        }else if(response == 2){

                            $('.warning').html('you can apply for loan less than '+loan_per_total_amount+'% of total amount!');
                        }else{

                            $('#apply_for_loan_form').submit()                              
                        }
                    },
                    error: function(data){
                        console.log(data);
                    },
                });

            }else{

                $('.warning').html('Please fill loan amount!');
                $('#loan_amount').focus();
            }
        });
    });
</script>

<div class="modal fade" id="corporate_users_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 class="modal-title" style="padding-left: 10px;">Corporate Buyer</h2>
            </div>
            {!! Form::open(array('url' => 'corporate_buying', 'class' => "", 'id' => 'empForm')) !!}
                @csrf
                {{ Form::hidden('inv_id', '', array('id' => 'inv_id')) }}
                <div class="modal-body mx-3">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('user_id', 'Buyer', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            <select name="corporate_user" required="required" class="form-control" id="corporate_users">
                            </select>
                        </div>
                        <div class="col-md-12">
                            {!! Form::label('user_id', 'Sell Quantity (Qtl.)', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            <input type="number" step="any" placeholder="Enter Sell Quantity" class="form-control" name="weight" required="required">
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    {!! Form::submit('Submit', ['class' => 'btn btn-info b-info']) !!}
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        Close
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal fade" id="sell_for_change" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 class="modal-title" style="padding-left: 10px;">Want to Sell on</h2>
            </div>
            <div class="modal-body mx-3">
                <div class="row">
                    <div class="col-md-12 m-b-10">
                        <a style="width: 100%;" class="btn btn-sm btn-info e_mandi" id="e_mandi" title="">E-Mandi</a>
                    </div>
                    <div class="col-md-12">
                        <a href="javascript:;" style="width: 100%;" class="btn btn-sm btn-info" id="corporate_buying" title="">Corporate Buying</a>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_price" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2 class="modal-title" style="padding-left: 10px;">Want to Sell on E-Mandi</h2>
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

                        <input id="sell_quantity" type="text" class="form-control" name="sell_quantity" required autofocus placeholder="quantity">
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-info">Update Price</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="apply_for_loan_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" style="padding-left: 10px;">Apply For Loan</h2>
      </div>
      <div class="modal-body">
            {!! Form::open(array('url' => 'loan_request', 'files' => true, 'id' => 'apply_for_loan_form')) !!}
                <div class="row">
                    <input type="hidden" name="inventory_id" id="seller_inventory_id">
                    <div class="col-md-12 text-center">
                        <h4>Choose Bank</h4>
                        <table class="table responsive">
                            <tr>
                                <th>Action</th>
                                <th>Bank Name</th>
                                <th>Processing Fees (%)</th>
                                <th>Interest Rate (%)</th>
                                <th>Loan per total amont (%)</th>
                                <th>Days</th>
                            </tr>
                            @foreach($banks_master as $bank_master)
                                <tr>
                                    <th>
                                        <input type="radio" name="apply_for_loan_bank" value="<?= $bank_master->id; ?>" class="form-check-input apply_for_loan_bank" data-id="<?= $bank_master->loan_per_total_amount; ?>" required='required' <?= ($bank_master->id == 1) ? 'checked' : '' ?>>
                                    </th>
                                    <th>{!! $bank_master->bank_name !!}</th>
                                    <th>{!! $bank_master->processing_fee !!}</th>
                                    <th>{!! $bank_master->interest_rate !!}</th>
                                    <th>{!! $bank_master->loan_per_total_amount !!}</th>
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
                            {!! Form::hidden('quantity', '', ['class' => 'form-control', 'id' => 'quantity', 'placeholder' => 'Enter Net Weight (Qtl.)']) !!}

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
                        <h5 class="red warning"></h5>
                    </div>
                    <div class="col-md-12 text-right">
                        <div class="form-group">
                            {!! Form::button('APPLY FOR LOAN', ['class' => 'btn btn-info btn', 'id' => 'apply_for_loan']) !!}
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                                Close
                            </button>
                        </div>
                    </div>

                </div>   
            {!! Form::close() !!}

      </div>
    </div>

  </div>
</div>

@endsection