@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Inventory</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Inventory</strong>
            </li>
        </ol>
    </div>
	<div class="col-lg-4 text-right" style="padding-top: 30px;">
        <a href="javascript:;" class="btn btn-info btn-sm import_csv">Import Inventories</a>
        <a href="{{ route('create_inventory') }}" class="btn btn-info btn-sm">Add Inventory</a>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
	        <div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Inventory</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>
	                </div>
	            </div>

	            <div class="ibox-content">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {!! session('status') !!}
                        </div>
                    @endif

	                <div class="table-responsive">
	                    <table id="inventory_table" class="table table-striped table-bordered table-hover">
	                        <thead>
	                            <tr>
                                    <th>Seller</th>
                                    <th>Terminal</th>
                                    <th>Gate Pass / WR No.</th>
                                    <th>Commodity</th>
                                    <th>Net Weight (Qty.)</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($inventories as $key => $inventory)
	                                <tr class="gradeX">
                                        <td>{!! $inventory->fname !!} {!! $inventory->lname !!} ({!! $inventory->phone !!})</td>
                                        <td>{!! $inventory->warehouse !!} ({!! $inventory->warehouse_code !!})</td>
                                        <td>{!! $inventory->gate_pass_wr !!}</td>
                                        <td>{!! $inventory->category !!}</td>
                                        <td>{!! $inventory->net_weight !!}</td>
                                        <td>
                                            <a href="{!! route('inventory_view', ['user_id' => $inventory->user_id, 'id' => $inventory->id]) !!}" class="btn btn-info btn-sm" title="View">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            @if(Auth::user()->id == 1)
                                            <a href="{!! route('inventory_edit_view', ['user_id' => $inventory->user_id, 'id' => $inventory->id]) !!}" class="btn btn-info btn-sm" title="Edit">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <a href="{!! route('inventory_delete', ['id' => $inventory->id]) !!}" class="btn btn-info btn-sm" title="Delete">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
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


<!-- Import Contact Modal -->
<div class="modal fade bs-example-modal-center" id="import_contact" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title mt-0">Import Inventory</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-4 col-sm-6"> 
                        {!! Form::open(array('url' => 'upload_inventory', 'files' => true)) !!}                   
                            <div class="form-group">
                                {!! Form::file('file', ['class' => 'form-control', 'id' => 'file', 'requried' => 'requried']) !!}
                            </div>
                            {!! Form::submit('Import CSV', ['class' => 'btn btn-primary btn-block waves-effect waves-light']) !!}
                        {!! Form::close() !!}
                        <div class="download-sample text-center">
                            <a download class="btn btn-link" href="uploads/sample/sampleinventries.csv">Download Sample CSV</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
    $(document).ready(function(){
        $("#inventory_table").dataTable({
            "order": [[ 3, "desc" ]]
        });


        //Inventory Import Modal
        $('.import_csv').on('click', function(){
            $('#import_contact').modal('show');
        });
    });
</script>
@endsection
