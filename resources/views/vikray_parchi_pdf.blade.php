<!-- pdf.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="{{ asset('resources/frontend_assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="all" />
  </head>
  <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h6>Vikray Parchi</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Apna Godam</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <b>Buyer Name : </b><span> {{$buyer_name }}</span>&nbsp;&nbsp;&nbsp; <b> Date : </b><span> {{ date('d-m-Y') }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <b>Seller Name : </b><span> {{$seller_name }}</span>&nbsp;&nbsp;&nbsp; <b>Bid Date : </b><span> {{ date('d-m-Y', strtotime($updated_at)) }}</span>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <tr>
                <td>
                    <b>Quantity : </b> {{$quantity }}
                </td>
                <td>
                    <b>Price : </b>{{$price }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Category : </b>{{$category }}
                </td>
                <td>
                    <b>Warehouse : </b>{{$warehouse }}
                </td>
            </tr>
        </table>
      </body>
    <script src="{{ asset('resources/frontend_assets/js/bootstrap.bundle.min.js') }}"> </script>
</html>