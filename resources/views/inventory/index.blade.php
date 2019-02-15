@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
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
	<div class="col-lg-2 text-right">
        <h2>
            <a href="{{ route('create_inventory') }}" class="btn btn-info">Add Inventory</a>
        </h2>
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
                            {{ session('status') }}
                        </div>
                    @endif

	                <div class="table-responsive">
	                    <table id="inventory_table" class="table table-striped table-bordered table-hover">
	                        <thead>
	                            <tr>
                                    <th>User</th>
                                    <th>Phone</th>
                                    <th>Commodity</th>
                                    <th>Quantity</th>
                                    <th>Gate Pass / WR No.</th>
                                    <th>Quality Category</th>
                                    <th>Price</th>
                                    <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @foreach($inventories as $key => $inventory)
	                                <tr class="gradeX">
                                        <td>{!! $inventory->fname !!}</td>
                                        <td>{!! $inventory->phone !!}</td>
                                        <td>{!! $inventory->category !!}</td>
                                        <td>{!! $inventory->quantity !!}</td>
                                        <td>{!! $inventory->gate_pass_wr !!}</td>
                                        <td>{!! $inventory->quality_category !!}</td>
                                        <td>{!! $inventory->price !!}</td>
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

<script type="text/javascript">
    $(document).ready(function(){
        $("#inventory_table").dataTable({
            "order": [[ 3, "desc" ]]
        });
    });
</script>
@endsection
