@extends('layouts.auth_app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>All Reports</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Reports</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Reports</h5>                    
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-4 m-b-20">
                            <a class="btn btn-lg w-100 btn-primary" href="{!! route('inventory_reports') !!}">Inventory Reports</a>
                        </div>
                        <div class="col-md-4 m-b-20">
                            <a class="btn btn-lg w-100 btn-primary" href="{!! route('lead_reports') !!}">Lead Reports</a>
                        </div>
                        <div class="col-md-4 m-b-20">
                            <a class="btn btn-lg w-100 btn-primary" href="{!! route('lead_reports') !!}">Cases Reports</a>
                        </div>
                        <div class="col-md-4 m-b-20">
                            <a class="btn btn-lg w-100 btn-primary" href="{!! route('lead_reports') !!}">Users Reports</a>
                        </div>
                        <div class="col-md-4 m-b-20">
                            <a class="btn btn-lg w-100 btn-primary" href="{!! route('lead_reports') !!}">Deals Reports</a>
                        </div>
                        <div class="col-md-4 m-b-20">
                            <a class="btn btn-lg w-100 btn-primary" href="{!! route('lead_reports') !!}">Finance / Loan Reports</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
