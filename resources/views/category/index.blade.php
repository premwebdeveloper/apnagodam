@extends('layouts.auth_app')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Category</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Category</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2 text-right">
        <h2>
            <a href="{{ route('create_category') }}" class="btn btn-info">Add Category</a>
        </h2>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Category</h5>
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
                                    <th>Category Name</th>
                                    <th>GST</th>
                                    <th>Commossion</th>
                                    <th>Mandi Fees</th>
                                    <th>Loading</th>
                                    <th>Bardana</th>
                                    <th>Freight</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $key => $category)
                                    <tr class="gradeX">
                                        <td>{!! $key + 1 !!}</td>
                                        <td>{!! $category->category !!}</td>
                                        <td>{!! $category->gst !!}</td>
                                        <td>{!! $category->commossion !!}</td>
                                        <td>{!! $category->mandi_fees !!}</td>
                                        <td>{!! $category->loading !!}</td>
                                        <td>{!! $category->bardana !!}</td>
                                        <td>{!! $category->freight !!}</td>
                                        <td><img src="{{ asset('resources/assets/upload/category/'.$category->image) }}" class="img-responsive" width="100" height="100"></td>
                                        <td>
                                            <a href="{!! route('category_edit_view', ['id' => $category->id]) !!}" class="btn btn-info btn-sm" title="Edit">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <a href="{!! route('category_delete', ['id' => $category->id]) !!}" class="btn btn-info btn-sm" data-toggle="confirmation" data-placement="bottom" title="Delete Category">
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
@endsection
