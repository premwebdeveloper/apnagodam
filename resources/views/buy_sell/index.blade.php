@extends('layouts.auth_app')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Today's Market</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Today's Market</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Today's Market</h5>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        @foreach($categories as $key => $category)
                            @if($category->commodity_type != 'Paid')
                            <div class="col-md-3">
                                <div class="ibox">
                                    <div class="ibox-content product-box">

                                        <div class="product-imitation p-0">
                                             <img src="{{ asset('resources/assets/upload/category/'.$category->image) }}" class="img-responsive" style="width: 100%;height: 200px;">
                                        </div>
                                        <div class="product-desc">
                                            <span class="product-price">
                                                Primary / Secondary
                                            </span>
                                            <!-- <small class="text-muted">Category</small> -->
                                            <a href="{!! route('buy_sell_view', ['id' => strtolower($category->category)]) !!}" class="product-name"> {{ $category->category }}</a>
                                            <div class="m-t text-righ">
                                                <a href="{!! route('buy_sell_view', ['id' => strtolower($category->category)]) !!}" class="btn btn-xs btn-outline btn-primary">View  <i class="fa fa-long-arrow-right"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
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