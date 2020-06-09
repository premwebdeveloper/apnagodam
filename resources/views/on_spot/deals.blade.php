@extends('layouts.auth_app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
            <h2>My Deals</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                    <strong>My Deals</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                        <h5>My Deals</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="my_sell" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Terminal</th>
                                    <th>Location</th>
                                    <th>Buyer</th>
                                    <th>Mandi Fee</th>
                                    <th>Commodity</th>
                                    <th>Net Weight (Qtl.)</th>
                                    <th>Quality Grade</th>
                                    <th>Price (Rs/Qtl.)</th>
                                    <th>Date</th>
                                    <th>Sell Type</th>
                                    <th>Status</th>
                                    <th>Vikray Parchi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deals as $key => $buy)
                                    <tr class="gradeX">
                                        <td>{{ $buy->name }}</td>
                                        <td>{{ $buy->location }}</td>
                                        <td>{{ $buy->fname }}</td>
                                        <td>{{ ($buy->mandi_fees)?$buy->mandi_fees:'N/A' }}</td>
                                        <td>{{ $buy->category }}</td>
                                        <td>{{ $buy->quantity }}</td>
                                        <td>{{ $buy->quality_category }}</td>
                                        <td>{{ $buy->price }}</td>
                                        <td>{{ $buy->created_at }}</td>
                                        <td>{!! ($buy->sales_status == 1)?'<span class="label label-primary">Primary</span>': '<span class="label label-danger">Secondary</span>' !!}</td>
                                        <td><span class="label label-primary">Success</span></td>
                                        <td><a href="{{ route('download_user_vikray_parchi', ['id' => $buy->id, 'email' => 0]) }}" class="btn btn-info btn-xs" data-toggle="tooltip" title="Deal Done">Download</a></td>
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
        $("#my_sell").dataTable();
    });
</script>
@endsection