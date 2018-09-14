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
                                    <td>First Name</td>
                                    <td>{{ $user->fname }}</td>
                                    <td>Last Name</td>
                                    <td>{{ $user->lname }}</td>
                                    
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $user->email }}</td>
                                    <td>Phone</td>
                                    <td>{{ $user->phone }}</td>                            
                                </tr>
                                <tr>
                                    <td>Father NAme</td>
                                    <td>{{ $user->father_name }}</td>
                                    <td>Khasra Number</td>
                                    <td>{{ $user->khasra_no }}</td>
                                </tr>
                                <tr>                                    
                                    <td>Village</td>
                                    <td>{{ $user->village }}</td>
                                    <td>Tehsil</td>
                                    <td>{{ $user->tehsil }}</td>
                                </tr>
                                <tr>
                                    <td>District</td>
                                    <td>{{ $user->district }}</td>
                                    <td>Commodity</td>
                                    <td>{{ $user->commodity }}</td>   
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
