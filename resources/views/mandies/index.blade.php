@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Mandies</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Mandies</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2 text-right">
        <h2>
            <a href="{{ route('create_mandi') }}" class="btn btn-info">Add Mandi Details</a>
        </h2>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Mandies</h5>
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
                                    <th>Mandi Name</th>
                                    <th>Mandi Tax Fees (%)</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Bank Name</th>
                                    <th>Account Holder Name</th>
                                    <th>Account Number</th>
                                    <th>Branch Name</th>
                                    <th>Branch IFSC Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mandies as $key => $mandi)
                                    <tr class="gradeX">
                                        <td>{!! $key + 1 !!}</td>
                                        <td>{!! $mandi->mandi_name !!}</td>
                                        <td>{!! $mandi->mandi_tax_fees !!}</td>
                                        <td>{!! $mandi->email !!}</td>
                                        <td>{!! $mandi->phone !!}</td>
                                        <td>{!! $mandi->bank_name !!}</td>
                                        <td>{!! $mandi->account_holder !!}</td>
                                        <td>{!! $mandi->bank_account_no !!}</td>
                                        <td>{!! $mandi->branch_name !!}</td>
                                        <td>{!! $mandi->branch_ifsc !!}</td>
                                        <td>
                                            @if(Auth::user()->id == 1 || Auth::user()->id == 2)
                                            <a href="{!! route('mandi_edit_view', ['id' => $mandi->id]) !!}" class="btn btn-info btn-xs" title="Edit">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <a href="{!! route('mandi_delete', ['id' => $mandi->id]) !!}" class="btn btn-info btn-xs" data-toggle="confirmation" data-placement="left" title="Delete Mandi Details">
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
@endsection
