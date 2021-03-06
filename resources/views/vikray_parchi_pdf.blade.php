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
        $commission = ($total_price * 0.75) / 100;
        $mandi_fee = '';
        $hammali = '';
        $c_date = $created_at;
        $tax_1_start_date = date('Y-m-d H:i:s', strtotime('2020-05-10 00:00:01'));
        $tax_1_end_date = date('Y-m-d H:i:s', strtotime('2020-05-30 00:00:01'));
        $tax_2_start_date = date('Y-m-d H:i:s', strtotime('2020-05-30 00:00:01'));
        $tax_2_end_date = date('Y-m-d H:i:s', strtotime('2020-06-05 00:00:01'));
        if($bid_type == 1)
        {
            if($sales_status == 1)
            {
                if($c_date < $tax_1_start_date){
                    $mandi_fee = (($total_price * 1.6) / 100);
                }elseif($c_date > $tax_1_start_date && $c_date < $tax_1_end_date){
                    $mandi_fee = (($total_price * 3.6) / 100);
                }else if($c_date > $tax_2_start_date && $c_date < $tax_2_end_date){
                    $mandi_fee = (($total_price * 2.6) / 100);
                }else{
                    $mandi_fee = 0;
                }
            }else{
                $mandi_fee = "N/A";
            }
        }else{
            $mandi_fee = $mandi_fees;
        }

        $res = 'Vikray Parchi = '.$id.', ApnaGodam.com, CIN = U63030RJ2016PTC055509, Buyer Name = '.$buyer_name.', Seller Name = '.$seller_name.', Date = '.date('d-m-Y').', Bid Date = '.date('d-m-Y', strtotime($updated_at)).', Commodity = '.$category.', Terminal = '.$warehouse.', Net Weight = '.$quantity.', Price = '.$price.', Quality = '.$quality_category.', E-mandi Commission = '.round($commission, 2).', Bags = '.$quantity.', Hammali = '.$hammali.', Mandi Fees = '.$mandi_fee.", Total = ".$total_price;
        ?>
        <div class="">
            <div class="row">
                <div class="col-md-3 text-left">
                   <img style="position:relative;height: 110px;" src="{{ asset('resources/frontend_assets/img/apna-godam-logo-1.png') }}">
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
                            <h2>apnagodam.com</h2>
                            <h6>Private Sub e-Market Notified By Govt. of Rajasthan</h6>
                            <p><b>Private Sub e-Market License No.:</b> 009</p>
                            <p><b>CIN:</b> U63030RJ2016PTC055509</p><br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4>Vikray Parchi No. - {{ $id }}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Mandi Samiti - <b>{{ $mandi_samiti_name }}</b></p>
                        </div>
                        <div class="col-md-6 text-right">
                            <p><b><?= ($sales_status == 1)?"Primary Sale":'Secondary Sale'; ?> </b></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><b>Buyer Name : </b> {{ ucfirst($buyer_name) }} ({{ $buyer_phone }}), {{ ucfirst($buyer_address) }}</p> 
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
                                        <b>Labour Cost : </b>{{ ($labour_rate > 0)?$labour_rate:"N/A" }} / Qtl.
                                    </td>
                                    <td>
                                        <b>Quality Grade: </b> {{ ($quality_category)?$quality_category:'Average' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>E-mandi Commission (0.75%): </b> {{ round($commission, 2) }} <span class='f-w-600 f-s-12'>(INR)</span>
                                    </td>
                                    <td>
                                        @if($bid_type == 1) 
                                            @if($sales_status == 1) 
                                                <b>Mandi Fees (1.6%) : </b>
                                                {{ $mandi_fee }} <span class='f-w-600 f-s-12'>(INR)</span>
                                            @else
                                                <b>Mandi Fees : </b>
                                                N/A
                                            @endif
                                        @else
                                            <?php
                                            if($c_date < $tax_1_start_date){
                                                ?>
                                                <b>Mandi Fees (1.6%) : </b> {{ $mandi_fee }} <span class='f-w-600 f-s-12'>(INR)</span>
                                                <?php
                                            }elseif($c_date > $tax_1_start_date && $c_date < $tax_1_end_date){
                                                ?>
                                                <b>Mandi Fees and Kisan Kalyan Cess (1.6% + 2%) : </b> {{ $mandi_fee }} <span class='f-w-600 f-s-12'>(INR)</span>
                                                <?php
                                            }else if($c_date > $tax_2_start_date && $c_date < $tax_2_end_date){
                                                ?>
                                                <b>Mandi Fees and Kisan Kalyan Cess (1.6% + 1%) : </b> {{ $mandi_fee }} <span class='f-w-600 f-s-12'>(INR)</span>
                                                <?php
                                            }else{
                                                ?>
                                                <b>Mandi Fees : </b> N/A
                                                <?php
                                            }
                                            ?>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Selling Price : </b>{{$price }} / Qtl.
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td>
                                        <b>Case Id :</b> {{ $case_id }}
                                    </td>
                                </tr> -->
                            </table>
                            <b>Total Amount  : </b>{{ number_format((float)$total_price, 2, '.', '') }} <span class='f-w-600 f-s-12'>(INR)</span> ({{convertCurrencyToWords($total_price) }})
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
                            <p style="font-size: 12px;padding:0px;margin:0px;">This is a system generated Vikray Parchi hence  need not be signed. Please call on IVR no. 7733901154 to check its authenticity.</p>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
        <div class="" style="width: 100%;padding:10px 0px;">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4><strong>[FORM XXII]</strong></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <P>[See Rule 56-B(16)]</P>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h6><strong>Certificate of Market Fees Paid Notified Agricultural Produce</strong></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h6><strong>DELIVERY SLIP</strong></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h6><strong>(To be issued by private Sub e-market)</strong></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <span><strong> {{ $warehouse }} ({{ $warehouse_code }})</strong> Delivery centre</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <span><strong> {{ $warehouse }} ({{ $warehouse_code }})</strong> Name of Private sub e-market</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <span>Serial No. <strong> {{ $id }} </strong></span>
                </div>
                <div class="col-md-6 text-right">
                    <span>Date : <strong>{{ date('d-m-Y', strtotime($updated_at)) }}</strong></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span> Name of Selling Member <strong> {{ $seller_name }}</strong></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span> Registration / Licence No. : <strong> N/A</strong></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span> Name of Buying Member <strong> {{ $buyer_name }}</strong></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span> Registration / Licence No. : <strong> {{ $mandi_license }} </strong></span>
                </div>
            </div>
            <br />
            <br />
            <div class="row">
                <div class="col-md-12">
                    <p>We hereby certify that the following deliveries have been lifted from our warehouse located at <strong> {{ $location }}</strong> which is in <strong> {{ $mandi_samiti_name }} </strong> market area and the complete payment details of the market fees and name of the trader along with his licence number, who has delivered originally and is responsible for payment of market fees on such goods are maintained with us, which can be verified from our records. We have delivered the below mentioned Agricultural Produces to the person named below:-
                </div>
            </div>
        </div> 
        <table class="table table-bordered">
            <tr>
                <th>
                    <p>Name of Agricultural Produce</p>
                </th>
                <th>
                    <p>Weight</p>
                </th>
                <th>
                    <p>Name of the person to whom delivery has been given</p>
                </th>
                <th>
                    <p>Remarks</p>
                </th>
                <th>
                    <p>Vehicle No.</p>
                </th>
                <th>
                    <p>Time of Generation</p>
                </th>
            </tr>
            <tr>
                <td>
                    <strong>{{ $category }}</strong>
                </td>
                <td>
                    <strong>{{ $quantity }} Qtl.</strong>
                </td>
                <td>
                    <strong>{{ $buyer_name }}</strong>
                </td>
                <td>
                    <strong>E-Mandi</strong>
                </td>
                <td>
                    <strong>{{ strtoupper($truck_no) }}</strong>
                </td>
                <td>
                    <strong>{{ date('d-m-Y H:i:s', strtotime($created_at)) }}</strong>
                </td>
            </tr>
        </table>
        <div class="">
            <div class="row">
                <div class="col-md-12 text-right">
                    <span>For & on behalf of license</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <span>Apnagodam.com</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <span>Phone No : <strong>0141-2232204</strong></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <span>Address : <strong>9/16, Vidhyadhar Nagar, Jaipur</strong></span>
                </div>
            </div>
        </div>
        <div style="clear: both;"></div>
      
    <script src="{{ asset('resources/frontend_assets/js/bootstrap.bundle.min.js') }}"> </script>