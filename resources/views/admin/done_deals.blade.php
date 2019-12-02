@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>All Done Deals</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Done Deals</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Done Deals</h5>
                    <div class="ibox-tools">
                        <span class="red">Deal Approve Time : 01:00 PM to 06:30PM</span>
                    </div>
                </div>

                <div class="ibox-content">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>Buyer Name</th>
                                    <th>Seller Name</th>
                                    <th>Gate Pass</th>
                                    <th>Payment Ref. No.</th>
                                    <th>Terminal</th>
                                    <th>Commodity</th>
                                    <th>Net Weight (Qtl.)</th>
                                    <th>Price</th>
                                    <th>Done Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($done_deals as $key => $done_deal)
                                    <tr class="gradeX">
                                        <td>{!! $done_deal->buyer_name !!}</td>
                                        <td>{!! $done_deal->seller_name !!}</td>
                                        <td>{!! $done_deal->gate_pass_wr !!}</td>
                                        <td>
                                            @if($done_deal->payment_ref_no)
                                                {!! $done_deal->payment_ref_no !!}
                                            @else
                                                <a href="javascript:;" id="{!! $done_deal->id !!}" class="btn btn-warning btn-xs add_payment_ref" data-toggle="tooltip" title="Add Payment Ref. No.">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>{!! $done_deal->warehouse !!}</td>
                                        <td>{!! $done_deal->category !!}</td>
                                        <td>{!! $done_deal->quantity !!}</td>
                                        <td>{!! $done_deal->price !!}</td>
                                        <td>{!! date('d M Y', strtotime($done_deal->updated_at)) !!}</td>
                                        <td>
                                            @if($done_deal->status == 2)
                                                <a href="javascript:;" id="{!! $done_deal->id !!}_{!! $done_deal->gate_pass_wr !!}" class="btn btn-warning btn-xs edit_gate_pass" data-toggle="tooltip" title="Deal Done">
                                                    Approve
                                                </a>
                                            @else
                                                <a href="{!! route('download_vikray_parchi', ['id' => $done_deal->id, 'email' => 0]) !!}" class="btn btn-info btn-xs" data-toggle="tooltip" title="Deal Done">
                                                    Download Vikray Parchi
                                                </a>
                                                <a href="{!! route('download_vikray_parchi', ['id' => $done_deal->id, 'email' => 1]) !!}" class="btn btn-info btn-xs" data-toggle="tooltip" title="Send Pdf">
                                                    Send Mail
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Bank Modal -->
<div id="gate_pass_edit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirm Gate Pass</h4>
      </div>
      <div class="modal-body">
        <div class="row">                        
                {!! Form::open(array('url' => 'payment_accept', 'files' => true)) !!}
                    <input type="hidden" name="id" id="payment_id">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('gate_pass', 'Gate Pass No.') !!}
                            {!! Form::text('gate_pass', '', ['class' => 'form-control', 'id' => 'payment_gate_pass', 'placeholder' => 'Gate Pass']) !!}

                            @if($errors->has('gate_pass'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('gate_pass') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::submit('Change GatePass / Approve Deal', ['class' => 'btn btn-info btn btn-block']) !!}
                        </div>
                    </div>

                {!! Form::close() !!}

            </div>   
      </div>
    </div>

  </div>
</div>

<!-- Edit add_payment_ref_modal -->
<div id="add_payment_ref_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Payment Referance Number</h4>
      </div>
      <div class="modal-body">
        <div class="row">                        
                {!! Form::open(array('url' => 'add_payment_ref', 'files' => true)) !!}
                    <input type="hidden" name="id" id="ref_payment_id">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('payment_ref_no', 'Payment Referance Number') !!}
                            {!! Form::text('payment_ref_no', '', ['class' => 'form-control', 'id' => 'payment_gate_pass', 'placeholder' => 'Payment Referance Number']) !!}

                            @if($errors->has('payment_ref_no'))
                                <span class="help-block red">
                                    <strong>{{ $errors->first('payment_ref_no') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::submit('Add Payment Ref Number', ['class' => 'btn btn-info btn btn-block']) !!}
                        </div>
                    </div>

                {!! Form::close() !!}

            </div>   
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.edit_gate_pass').on('click', function(){
            var temp = $(this).attr('id');
            var data = temp.split('_');
            $('#payment_id').val(data[0]);
            $('#payment_gate_pass').val(data[1]);
            $('#gate_pass_edit').modal('show');
        });
        $('.add_payment_ref').on('click', function(){
            var id = $(this).attr('id');
            $('#ref_payment_id').val(id);
            $('#add_payment_ref_modal').modal('show');
        });
    });
</script>


@endsection
