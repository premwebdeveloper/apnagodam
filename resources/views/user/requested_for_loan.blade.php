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
        <div class="row">

            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Requested For Loan against {!! $finance->category !!} commodity with {!! $finance->quantity !!} Bags.</h2>
                <hr>

                @if(session('status'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('status') }}
                    </div>
                @endif
            </div>

            <table class="table table-bordered">
                <tbody>
                        <tr>
                            <th scope="row">Bank Name</th>
                            <td>{!! $finance->bank_name !!}</td>
                            <th scope="row">Branch Name</th>
                            <td>{!! $finance->branch_name !!}</td>
                        </tr>
                        <tr>
                            <th scope="row">Account Number</th>
                            <td>{!! $finance->acc_number !!}</td>
                            <th scope="row">IFSC Code</th>
                            <td>{!! $finance->ifsc !!}</td>
                        </tr>
                        <tr>
                            <th scope="row">Request Date</th>
                            <td>{!! $finance->created_at !!}</td>
                            <th scope="row">Status</th>
                            <td>
                                @if($finance->status == 1)
                                    Wait for approval
                                @elseif($finance->status == 2)
                                    Loan Approved
                                @elseif($finance->status == 0)
                                    Loan Rejected
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Pan card</th>
                            <td>
                                <a href="{!! asset('resources/assets/upload/pancards/'.$finance->user_id.'/'.$finance->pan) !!}" alt="{!! $finance->pan !!}" target="_blank" download> 
                                    <img src="{!! asset('resources/assets/upload/pancards/'.$finance->user_id.'/'.$finance->pan) !!}" alt="{!! $finance->pan !!}" style="width:100px;">
                                </a>
                            </td>
                            <th scope="row">Aadhar Card</th>
                            <td>
                                <a href="{!! asset('resources/assets/upload/aadharcards/'.$finance->user_id.'/'.$finance->aadhar) !!}" alt="{!! $finance->aadhar !!}" target="_blank" download>
                                    <img src="{!! asset('resources/assets/upload/aadharcards/'.$finance->user_id.'/'.$finance->aadhar) !!}" alt="{!! $finance->aadhar !!}" style="width:100px;">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Balance Sheet</th>
                            <td>
                                <a href="{!! asset('resources/assets/upload/balancesheets/'.$finance->user_id.'/'.$finance->balance_sheet) !!}" alt="{!! $finance->balance_sheet !!}" target="_blank" download>
                                    <img src="{!! asset('resources/assets/upload/balancesheets/'.$finance->user_id.'/'.$finance->balance_sheet) !!}" alt="{!! $finance->balance_sheet !!}" style="width:100px;">
                                </a>
                            </td>
                            <th scope="row">Bank Statement</th>
                            <td>
                                <a href="{!! asset('resources/assets/upload/bankstatements/'.$finance->user_id.'/'.$finance->bank_statement) !!}" alt="{!! $finance->bank_statement !!}" alt="{!! $finance->balance_sheet !!}" target="_blank" download>
                                    <img src="{!! asset('resources/assets/upload/bankstatements/'.$finance->user_id.'/'.$finance->bank_statement) !!}" alt="{!! $finance->bank_statement !!}" style="width:100px;">
                                </a>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection