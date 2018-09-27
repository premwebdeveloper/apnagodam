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

                <h2 class="section-heading">Inventory</h2>
                <hr>
            </div>
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Commodity</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Price</th>
                      <th scope="col">Create Date</th>
                      <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventories as $key => $inventory)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $inventory->commodity }}</td>
                        <td>{{ $inventory->quantity }}</td>
                        <td><i class="fa fa-inr"></i> {{ $inventory->price }}</td>
                        <td>{{ $inventory->created_at }}</td>
                        <td>
                            <a href="#{{ $inventory->id }}" class="btn btn-info btn-sm" data-toggle="modal" title="Edit Price">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div id="{{ $inventory->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                               </div>
                                <div class="modal-body">
                                    <form class="form-inline" action="">
                                        <div class="form-group">
                                            <label for="price">Price:</label>
                                            <input type="text" value="{{ $inventory->price }}" class="form-control" id="price">
                                        </div>
                                        <button type="submit" class="btn btn-default">Update Price</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection