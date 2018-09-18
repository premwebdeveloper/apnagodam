@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>User Details</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <a href="{{ route('users') }}">Users</a>
            </li>
            <li class="active">
                <strong>User Details</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">

        <div class="col-md-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>User Detail</h5>
                </div>

                <div>
                    <div class="ibox-content no-padding border-left-right" style="border: 1px solid #e7eaec;">
                        <img alt="image" class="img-responsive" src="{{ asset('resources/assets/upload/profile_image/'.$user->image) }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>User Informations</h5>
                </div>

                <div class="ibox-content">
                    <div class="feed-activity-list">                        
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><b>First Name</b></td>
                                    <td>{{ $user->fname }}</td>
                                    <td><b>Email</b></td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td><b>Phone</b></td>
                                    <td>{{ $user->phone }}</td>                            
                                    <td><b>Father Name</b></td>
                                    <td>{{ $user->father_name }}</td>
                                </tr>
                                <tr>
                                    <td><b>Category</b></td>
                                    @if($user->category==1)
                                    <td>Farmer</td>
                                    @elseif($user->category==2)
                                    <td>Trader</td>
                                    @elseif($user->category==3)
                                    <td>Miller</td>
                                    @endif   
                                    @if(!empty($user->khasra_no))                                
                                    <td><b>Khasra Number</b></td>
                                    <td>{{ $user->khasra_no }}</td>
                                    @else
                                    <td><b>GST Number</b></td>
                                    <td>{{ $user->gst_number }}</td>
                                    @endif
                                </tr>
                                <tr> 
                                    <td><b>Village</b></td>
                                    <td>{{ $user->village }}</td>                                   
                                    <td><b>Tehsil</b></td>
                                    <td>{{ $user->tehsil }}</td>
                                </tr>
                                <tr>
                                    <td><b>District</b></td>
                                    <td>{{ $user->district }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
