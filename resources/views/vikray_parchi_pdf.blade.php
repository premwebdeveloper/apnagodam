<!-- pdf.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="{{ asset('resources/frontend_assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="all" />
  </head>
  <style>
.page-break {
    page-break-after: always;
}
</style>
  <body>
        <div class="">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h6>Vikray Parchi <b>{{ $id }}</b></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Apna Godam</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <b>Buyer Name : </b><span> {{ $buyer_name }}</span>&nbsp;&nbsp;&nbsp; <b> Date : </b><span> {{ date('d-m-Y') }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <b>Seller Name : </b><span> {{ $seller_name }}</span>&nbsp;&nbsp;&nbsp; <b>Bid Date : </b><span> {{ date('d-m-Y', strtotime($updated_at)) }}</span>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <tr>
                <td>
                    <b>Net Weight : </b> {{$quantity }} Qtl.
                </td>
                <td>
                    <b>Price : </b>{{$price }} / Qtl.
                </td>
            </tr>
            <tr>
                <td>
                    <b>Commodity : </b>{{$category }}
                </td>
                <td>
                    <b>Warehouse : </b>{{$warehouse }}
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                        $total_price = $quantity * $price;
                    ?>
                    <b>Total Amount  : </b>{{$total_price }} Rs.
                </td>
                <td>
                    <?php
                        $total_price = $quantity * $price;
                    ?>
                    @if($sales_status == 1) 
                        <b>Mandi Fees ({!! $mandi_fees !!}%) : </b>
                        <?php
                        echo $mandi_fee = ($total_price * $mandi_fees) / 100;
                        ?>
                    @else
                        <b>Mandi Fees : </b>
                        N/A
                    @endif
                    Rs.
                </td>
            </tr>
        </table>
        <div class="page-break"></div>
        <div class="" style="width: 100%;padding:10px 0px;">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4><b>[FORM XXII]</b></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <P>[See Rule 56-B(16)]</P>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h5><b>Certificate of Market Fees Paid Notified Agricultural Produce</b></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h5><b>DELIVERY SLIP</b></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h5><b>(To be issued by private Sub e-market)</b></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <span><b> {{ $warehouse }} ({{ $warehouse_code }})</b> Delivery centre</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <span><b> {{ $warehouse }} ({{ $warehouse_code }})</b> Name of Private sub e-market</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <span>Serial No. <b> {{ $id }} </b></span>
                </div>
                <div class="col-md-6 text-right">
                    <span>Date : <b>{{ date('d-m-Y', strtotime($updated_at)) }}</b></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span> Name of Selling Member <b> {{ $seller_name }}</b></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span> Registration / Licence No. : <b> N/A</b></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span> Name of Buying Member <b> {{ $buyer_name }}</b></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span> Registration / Licence No. : <b> {{ $mandi_license }} </b></span>
                </div>
            </div>
            <br />
            <br />
            <div class="row">
                <div class="col-md-12">
                    <p>We hereby certify that the following deliveries have been lifted from our warehouse located at <b>{{ $location }}</b> which is in <b> N/A </b> market area, and the completed details of payment of market fees and name of original trader along with his licence number, who has delivered originally and is responsible for payment of market fees on such goods are maintained with us, which can be verified from our records. We have delivered the below mentioned Agricultural Produces to the person named below:-
                </div>
            </div>
        </div> 
        <table class="table table-bordered">
            <tr>
                <th>
                    Name of Agricultural Produce
                </th>
                <th>
                    Weight
                </th>
                <th>
                    Name of the person to whom Delivery has Been given
                </th>
                <th>
                    Remarks
                </th>
            </tr>
            <tr>
                <td>
                    <b>{{ $category }}</b>
                </td>
                <td>
                    <b>{{ $quantity }} Bags</b>
                </td>
                <td>
                    <b>{{ $buyer_name }}</b>
                </td>
                <td>
                    <b>E-Mandi</b>
                </td>
            </tr>
        </table>
        <div class="">
            <div class="row">
                <div class="col-md-12 text-right">
                    <span>For & on behalf of License</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <span>Phone No : <b>0141-2232204</b></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <span>Address : <b>9/16, Vidhyadhar Nagar, Jaipur</b></span>
                </div>
            </div>
        </div>
        <div style="clear: both;">

      </body>
    <script src="{{ asset('resources/frontend_assets/js/bootstrap.bundle.min.js') }}"> </script>
</html>