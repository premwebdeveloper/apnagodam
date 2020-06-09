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
p{font-size: 13px;padding:0px;margin:0px;}
b{font-size: 13px;}
.f-w-600{font-weight: 600;}
.f-s-12{font-size:12px;}
</style>
  <body>
        <?php
        $total_price = (float)$quantity * (float)$price;
        
        $res = 'Contact Note = '.$id.', ApnaGodam.com, CIN = U63030RJ2016PTC055509, Buyer Name = '.$buyer_name.', Seller Name = '.$seller_name.', Date = '.date('d-m-Y').', Bid Date = '.date('d-m-Y', strtotime($updated_at)).', Commodity = '.$category.', Terminal = '.$warehouse.', Net Weight = '.$quantity.', Price = '.$price.', Quality = '.$quality_category.', Bags = '.$quantity.', Total = '.$total_price;
        ?>
        <div>
            <div class="row">
                <div class="col-md-3 text-left">
                   <img style="position:relative;height: 160px;" src="{{ asset('resources/frontend_assets/img/apna-godam-logo-1.png') }}">
                </div>
                <div class="col-md-3 text-right">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(150)->generate($res))!!} ">
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1 style="font-size: 56px;">apnagodam.com</h1>
                            <h6><b>(Operational Under Ordinance - The Farmer's Produce Trade and Commerce <br/> (Promotion and Facilitation) ordinance, 2020)</b></h6>
                            <p><b>CIN:</b> U63030RJ2016PTC055509</p><br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4>Contract Note No. - <?= $id-149; ?></h4><br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            &nbsp;
                        </div>
                        <div class="col-md-6 text-right">
                            <p><b><?= ($sales_status == 1)?"Primary Sale":'Secondary Sale'; ?> </b></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><b>Buyer Name : </b> {{ ucfirst($buyer_name) }} ({{ $buyer_phone }}), {{ ucfirst($buyer_address) }} &nbsp;<br/><b> PAN No.- </b>{{ ($pancard_no)?$pancard_no:"N/A" }}</p> 
                        </div>
                        <div class="col-md-6 text-right">
                            <p><b>Print Date : </b> {{ date('d-m-Y') }}</p> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><b>Seller Name : </b> {{ ucfirst($seller_name) }} ({{ $seller_phone }}), {{ ucfirst($seller_address) }}</p>
                        </div>
                        <div class="col-md-6 text-right">
                            <p><b>Bid Date : </b> {{ date('d-m-Y', strtotime($updated_at)) }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><b style="text-decoration: underline;">Shipment Details :</b></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <b>Commodity : </b>{{$category }} ({{ $commodity_type }})
                                    </td>
                                    <td>
                                        <b>Terminal : </b>{{$warehouse }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Net Weight : </b> {{$quantity }} Qtl.
                                    </td>
                                    <td>
                                        <b>Bags : </b> {{ $no_of_bags }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Quality Grade: </b> {{ ($quality_category)?$quality_category:'Average' }}
                                    </td>
                                    <td>
                                        <b>Selling Price : </b>{{ $price }} / Qtl.
                                    </td>
                                </tr>
                            </table>
                            <b>Total Amount  : </b>{{ number_format((float)$total_price, 2, '.', '') }} <span class='f-w-600 f-s-12'>(INR)</span> ({{convertCurrencyToWords($total_price) }})
                            <br/>
                            <br/>
                            <p><b>Note: </b> Brokerage, Labour, Assaying Charge will be applied as per Agreement.</p>
                        </div>
                    </div>
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                            <p style="font-size: 12px;padding:0px;margin:0px;">Regd. Office: ApnaGodam.com (A Unit of Singodwala Warehousing & Logistics Pvt. Ltd.) Sector-9, Plot No. 16, Vidhyadhar Nagar, Jaipur, Rajasthan 302032</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p style="font-size: 12px;padding:0px;margin:0px;">Email : sanjayagarwal@apnagodam.com</p>
                        </div>
                        <div class="col-md-6 text-right">
                            <p style="font-size: 12px;padding:0px;margin:0px;">Landline No. : 0141-2232204</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <p style="font-size: 12px;padding:0px;margin:0px;">This is a system generated Contract Note hence  need not be signed. Please call on IVR no. 7733901154 to check its authenticity.</p>
                        </div>
                    </div>
                </div>                
            </div>
        </div>      
        <script src="{{ asset('resources/frontend_assets/js/bootstrap.bundle.min.js') }}"> </script>
    </body>
</html>