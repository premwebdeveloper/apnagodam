@extends('layouts.public_app')

@section('content')
<style type="text/css">
    .apna .fa{
        font-size: 50px;
        margin-bottom: 20px;
    }
</style>
<section id="about">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img alt="image" class="max-100" src="{{ asset('resources/assets/upload/warehouses/'.$terminal->image) }}">
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
</section>
@endsection
