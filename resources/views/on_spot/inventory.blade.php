@extends('layouts.auth_app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
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
    <div class="col-lg-6 text-right p-t-30">
        <a class="btn btn-info btn-md" href="">Add Commodity</a>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>On Spot Commodity</h5>
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
                                                <a href="javascript:;" id="{{ $inventory->id }}_{{ $inventory->quantity }}_{{ $inventory->cat_name }}" class="btn btn-primary btn-xs want_to_sell" title="Edit Price">
                                                    Want To Sell
                                                </a>
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

    });
</script>


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

@endsection