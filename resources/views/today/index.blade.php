@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Today's Price</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Today's Price</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2 text-right">
        <h2>
            <a href="{{ route('create_today') }}" class="btn btn-info">Add Today's Price</a>
        </h2>
    </div> 
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Today's Price</h5>
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
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Terminal</th>
                                    <th>Commodity Name</th>
                                    <th>Max (Superior) (Per Qtl.)</th>
                                    <th>Modal (Average) (Per Qtl.)</th>
                                    <th>Min (Low) (Per Qtl.)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($today_prices as $key => $today_price)
                                    <tr class="gradeX">
                                        <td>{!! $key + 1 !!}</td>
                                        <td>{!! $today_price->terminal_name !!}</td>
                                        <td>{!! $today_price->commodity !!}</td>
                                        <td>{!! $today_price->max !!}</td>
                                        <td>{!! $today_price->modal !!}</td>
                                        <td>{!! $today_price->min !!}</td>
                                        <td>
                                            <a href="{!! route('today_price_edit_view', ['id' => $today_price->id]) !!}" class="btn btn-info btn-xs" title="Edit">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <a href="{!! route('today_price_delete', ['id' => $today_price->id]) !!}" class="btn btn-info btn-xs" data-toggle="confirmation" data-placement="bottom" title="Delete Today Price">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Corporate Today's Price</h5>
                    <div class="ibox-tools">
                        
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
                                    <th>S.No.</th>
                                    <th>Corporate Name</th>
                                    <th>Price</th>
                                    <th>Last Update Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($corporate_price as $key => $price)
                                    <tr class="gradeX">
                                        <td>{!! $key + 1 !!}</td>
                                        <td>{!! $price->ub_name !!}</td>
                                        <td>{!! $price->todays_price !!}</td>
                                        <td>{!! date('d M Y H:I:s', strtotime($price->updated_at)) !!}</td>
                                        <td>
                                            <a data-id="{!! $price->id !!}" class="btn btn-info btn-xs" title="Edit" id="edit_corporate_price">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <a href="{!! route('today_price_delete', ['id' => $price->id]) !!}" class="btn btn-info btn-xs" data-toggle="confirmation" data-placement="bottom" title="Delete Today Price">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
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

<!-- Add User Employee by Admin -->
<!-- <div id="editCorporate" class="modal fade" role="dialog">
    <div class="modal-dialog">
        Modal content
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Corporate Price</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => 'updateCorporatePrice', 'files' => true, 'class' => "contact_us_form", 'id' => 'empForm')) !!}
                    @csrf
                    {!! Form::hidden('corporate_id', '', array('id' => 'corporate_id')) !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('corporate_name', 'Corporate Name', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('corporate_name', '', ['class' => 'form-control', 'id' => 'corporate_name', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Corporate Name']) !!}

                            @if($errors->has('corporate_name'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('corporate_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('ub_price', 'Today\'s Price', ['class' => 'm-t-20  col-form-label text-md-right']) !!}<span class="red">*</span>
                            {!! Form::text('ub_price', '', ['class' => 'form-control', 'id' => 'ub_price', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Today\'s Price']) !!}

                            @if($errors->has('ub_price'))
                                <span class="text-red" role="alert">
                                    <strong class="red">{{ $errors->first('ub_price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-info m-t-20 form-control b-info']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div> -->

<script type="text/javascript">
    $(document).ready(function(){
        $('#edit_corporate_price').on('click', function(){
            var id = $(this).attr('data-id');
            $.ajax({
                method : 'post',
                url: "{{ route('getCorporateDetails') }}",
                async : true,
                data : {"_token": "{{ csrf_token() }}", 'id' : id},
                success:function(response)
                {
                    var response = JSON.parse(response);
                    $('#corporate_name').val(response.ub_name);
                    $('#ub_price').val(response.todays_price);
                    $('#corporate_id').val(response.id);
                    $('#editCorporate').modal('show');
                },
                error: function(data)
                {
                    alert(data);
                },
            });
        });
    });
</script>
@endsection
