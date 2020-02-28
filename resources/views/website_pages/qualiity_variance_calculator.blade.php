@extends('layouts.public_app')
@section('content')
<section class="banner_area m-t-158">
    <div class="container">
        <div class="pull-left">
            <h3>{{ __('Quality Variance Calculator') }}</h3>
        </div>
        <div class="pull-right">
            <a href="/">Home</a>
            <a href="/">Quality Variance Calculator</a>
        </div>
    </div>
</section>
<section class="price_faq_area p-t-40">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="main_title">
                    <h5>QVC</h5>
                    <h2 class="m-t-20 m-b-20">Quality Variance Calculator - Barley</h2>
                    <h4>Quality Variance Calculator helps Sellers to evaluate their crop  profitability by calculating quality variance, <br / >transportation costs, breakeven selling prices, gross margins, and returns to equity. </h4>
                </div>
                <div class="row p-10 theme-secondary">
                    <div class="col-md-6 m-t-8">
                        <h2 class="f-s-20 text-white"><b>Quality Variance Report</b></h2>
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-4">
                        <input type="number" placeholder="Enter Market Price" name="price" id="n_main_price" class="form-control p-5 h-35">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <th>Quality Parameter</th>
                                        <th>Normal</th>
                                        <th>Extreme</th>
                                        <th>Actual</th>
                                        <th>Price Diff. (Rs.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="gradeX">
                                        <td class="f-w-800 f-s-18">Moisture</td>
                                        <td><span class="f-w-800 f-s-18" id="mos_normal">11</span>%</td>
                                        <td><span class="f-w-800 f-s-18" id="mos_extreme">13</span>%</td>
                                        <td><input type="number" id="mos_actual" style="width:60px; float:left;" class="form-control" >%</td>
                                        <td><span class="f-w-800 f-s-18" id="mos_price"></span></td>
                                    </tr>
                                    <tr class="gradeX">
                                        <td class="f-w-800 f-s-18">Broken</td>
                                        <td><span class="f-w-800 f-s-18" id="bro_normal">4</span>%</td>
                                        <td><span class="f-w-800 f-s-18" id="bro_extreme">6</span>%</td>
                                        <td><input type="number" id="bro_actual" style="width:60px; float:left;" class="form-control" >%</td>
                                        <td><span class="f-w-800 f-s-18" id="bro_price"></span></td>
                                    </tr>
                                    <tr class="gradeX">
                                        <td class="f-w-800 f-s-18">Thin</td>
                                        <td><span class="f-w-800 f-s-18" id="thin_normal">6</span>%</td>
                                        <td><span class="f-w-800 f-s-18" id="thin_extreme">8</span>%</td>
                                        <td><input type="number" id="thin_actual" style="width:60px; float:left;" class="form-control" >%</td>
                                        <td><span class="f-w-800 f-s-18" id="thin_price"></span></td>
                                    </tr>
                                    <tr class="gradeX">
                                        <td class="f-w-800 f-s-18"> TCW</td>
                                        <td><span class="f-w-800 f-s-18" id="tcw_normal">40</span></td>
                                        <td><span class="f-w-800 f-s-18" id="tcw_extreme">39</span></td>
                                        <td><input type="number" id="tcw_actual" style="width:60px; float:left;" class="form-control" ></td>
                                        <td><span class="f-w-800 f-s-18" id="tcw_price"></span></td>
                                    </tr>
                                    <tr class="gradeX">
                                        <td class="f-w-800 f-s-18">FM </td>
                                        <td><span class="f-w-800 f-s-18" id="fm_normal">1</span>%</td>
                                        <td><span class="f-w-800 f-s-18" id="fm_extreme">2</span>%</td>
                                        <td><input type="number" id="fm_actual" style="width:60px; float:left;" class="form-control" >%</td>
                                        <td><span class="f-w-800 f-s-18" id="fm_price"></span></td>
                                    </tr>
                                    <tr class="gradeX">
                                        <td class="f-w-800 f-s-18">Total Price Diff.</td>
                                        <td ></td>
                                        <td ></td>
                                        <td ></td>
                                        <td class="f-s-20">QV Rs .<b class="" id="total_price"></b> / Qtl.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-4 m-t-40 text-center p-t-40 col-xs-12">
                <div class="our_about_left_content">
                    <h3 class="single_title p-t-40 m-b-40 p-b-10">About Quality Variance Calculator</h3>
                    “ApnaGodam reinvents Indian Agri Commodity Trading by introducing Quality Variance Calculator. <br>
                    Using this QV Calculator Farmers & Agri Sellers can discover the prices of their commodity based on their commodity quality parameters and the transport distance between the Seller and the Buyer.<br>
                    This calculator helps Sellers to evaluate their crop  profitability by calculating transportation costs, breakeven selling prices, gross margins, and returns to equity.”
                </div>
            </div> -->
        </div>
    </div>
</section>
<script>
        $(document).ready(function(){

        //Submit Bid for Neemrana
        $('.submitFormNeemrana').on('click', function(){
            $('#neemranaForm').submit();
        });

        //Submit Bid for Chomu
        $('.submitFormChomu').on('click', function(){
            $('#chomuForm').submit();
        });

        //Get Moisture 
        $('#mos_actual').on('input', function(){
            var mos_actual_val = parseFloat($(this).val());
            var n_main_price = $('#n_main_price').val();        
            var mos_normal = $('#mos_normal').html();
            var mos_extreme = $('#mos_extreme').html();
            var pri_diff = 0;
            if(mos_actual_val)
            {
                if(mos_actual_val > mos_normal && mos_actual_val <= mos_extreme)
                {
                    pri_diff = ((mos_actual_val - mos_normal)/ 100) * n_main_price;
                }

                if(mos_actual_val > mos_extreme)
                {
                    pri_diff =  ((mos_actual_val - mos_normal)/ 100) * n_main_price;
                    pri_diff =  2 * parseFloat(pri_diff);
                }
                if(mos_actual_val <= mos_normal)
                {
                    pri_diff = 0;
                }

                $('#mos_price').html(pri_diff.toFixed(2));

                if($('#bro_actual').val() && $('#fm_actual').val() && $('#thin_actual').val() && $('#tcw_actual').val())
                {
                    var total = parseFloat($('#mos_price').html());
                    total = total + parseFloat($('#bro_price').html());
                    total = total + parseFloat($('#fm_price').html());
                    total = total + parseFloat($('#thin_price').html());
                    total = total + parseFloat($('#tcw_price').html());
                    $('#total_price').html(total.toFixed(2));
                }
            }else{
                $('#mos_price').html('');
                $('#total_price').html('');
                $('#nr_quality_variance').val('');
                $('.neemrana_sell').addClass('hide');
                $('#n_bid_price').html("");
            }
        });

        //Get Broken
        $('#bro_actual').on('input', function(){
            var bro_actual_val = parseFloat($(this).val());
            var n_main_price = $('#n_main_price').val();        
            var bro_normal = $('#bro_normal').html();
            var bro_extreme = $('#bro_extreme').html();
            var pri_diff = 0;

            if(bro_actual_val)
            {

                if(bro_actual_val > bro_normal && bro_actual_val <= bro_extreme)
                {
                    pri_diff = ((bro_actual_val - bro_normal)/ 200) * n_main_price;
                }

                if(bro_actual_val > bro_extreme)
                {
                    pri_diff =  ((bro_actual_val - bro_normal)/ 100) * n_main_price;
                }
                if(bro_actual_val <= bro_normal)
                {
                    pri_diff = 0;
                }

                $('#bro_price').html(pri_diff.toFixed(2));

                if($('#mos_actual').val() && $('#fm_actual').val() && $('#thin_actual').val() && $('#tcw_actual').val())
                {
                    var total = parseFloat($('#mos_price').html());
                    total = total + parseFloat($('#bro_price').html());
                    total = total + parseFloat($('#fm_price').html());
                    total = total + parseFloat($('#thin_price').html());
                    total = total + parseFloat($('#tcw_price').html());
                    $('#total_price').html(total.toFixed(2));                    
                }
            }else{
                $('#bro_price').html('');
                $('#total_price').html('');
                $('#nr_quality_variance').val('');
                $('.neemrana_sell').addClass('hide');
                $('#n_bid_price').html("");

            }
        });

        //Get Thin
        $('#thin_actual').on('input', function(){
            var thin_actual_val = parseFloat($(this).val());
            var n_main_price = $('#n_main_price').val();        
            var thin_normal = $('#thin_normal').html();
            var thin_extreme = $('#thin_extreme').html();
            var pri_diff = 0;

            if(thin_actual_val)
            {
                if(thin_actual_val > thin_normal && thin_actual_val <= thin_extreme)
                {
                    pri_diff = ((thin_actual_val - thin_normal)/ 200) * n_main_price;
                }

                if(thin_actual_val > thin_extreme)
                {
                    pri_diff =  ((thin_actual_val - thin_normal)/ 100) * n_main_price;
                }

                if(thin_actual_val <= thin_normal)
                {
                    pri_diff = 0;
                }

                $('#thin_price').html(pri_diff.toFixed(2));

                if($('#mos_actual').val() && $('#fm_actual').val() && $('#bro_actual').val() && $('#tcw_actual').val())
                {
                    var total = parseFloat($('#mos_price').html());
                    total = total + parseFloat($('#bro_price').html());
                    total = total + parseFloat($('#fm_price').html());
                    total = total + parseFloat($('#thin_price').html());
                    total = total + parseFloat($('#tcw_price').html());
                    $('#total_price').html(total.toFixed(2));
                }
            }else{

                $('#thin_price').html('');
                $('#total_price').html('');
                $('#nr_quality_variance').val('');
                $('.neemrana_sell').addClass('hide');
                $('#n_bid_price').html("");
            }
        });

        //Get FM
        $('#fm_actual').on('input', function(){
            var fm_actual_val = parseFloat($(this).val());
            var n_main_price = $('#n_main_price').val();        
            var fm_normal = $('#fm_normal').html();
            var fm_extreme = $('#fm_extreme').html();
            var pri_diff = 0;

            if(fm_actual_val)
            {
                if(fm_actual_val > fm_normal && fm_actual_val <= fm_extreme)
                {
                    pri_diff = ((fm_actual_val - fm_normal)/ 100) * n_main_price;
                }

                if(fm_actual_val > fm_extreme)
                {
                    pri_diff =  ((fm_actual_val - fm_normal)/ 100) * n_main_price;
                }
                if(fm_actual_val <= fm_normal)
                {
                    pri_diff = 0;
                }

                $('#fm_price').html(pri_diff.toFixed(2));

                if($('#mos_actual').val() && $('#thin_actual').val() && $('#bro_actual').val() && $('#tcw_actual').val())
                {
                    var total = parseFloat($('#mos_price').html());
                    total = total + parseFloat($('#bro_price').html());
                    total = total + parseFloat($('#fm_price').html());
                    total = total + parseFloat($('#thin_price').html());
                    total = total + parseFloat($('#tcw_price').html());
                    $('#total_price').html(total.toFixed(2));
                }
            }else{
                $('#fm_price').html('');
                $('#total_price').html('');
                $('#nr_quality_variance').val('');
                $('.neemrana_sell').addClass('hide');
                $('#n_bid_price').html("");
            }
        });

        //Get TCW
        $('#tcw_actual').on('input', function(){
            var tcw_actual_val = parseFloat($(this).val());
            var n_main_price = $('#n_main_price').val();        
            var tcw_normal = $('#tcw_normal').html();
            var tcw_extreme = $('#tcw_extreme').html();
            var pri_diff = 0;
            if(tcw_actual_val)
            {
                if(tcw_actual_val < tcw_normal && tcw_actual_val >= tcw_extreme)
                {
                    pri_diff = ((tcw_normal - tcw_actual_val)/ 100) * n_main_price;
                }

                if(tcw_actual_val <= tcw_extreme)
                {
                    pri_diff =  ((tcw_normal - tcw_actual_val)/ 100) * n_main_price;
                    pri_diff =  2*pri_diff;
                }
                if(tcw_actual_val >= tcw_normal)
                {
                    pri_diff = 0;
                }

                if($('#mos_actual').val() && $('#thin_actual').val() && $('#bro_actual').val() && $('#fm_actual').val())
                {
                    var total = parseFloat($('#mos_price').html());
                    total = total + parseFloat($('#bro_price').html());
                    total = total + parseFloat($('#fm_price').html());
                    total = total + parseFloat($('#thin_price').html());
                    total = total + parseFloat($('#tcw_price').html());
                    $('#total_price').html(total.toFixed(2));
                }

                $('#tcw_price').html(pri_diff.toFixed(2));
            }else{
                $('#tcw_price').html('');            
                $('#total_price').html('');
                $('#nr_quality_variance').val('');
                $('.neemrana_sell').addClass('hide');
                $('#n_bid_price').html("");
            }
        });

        $('#n_main_price').on('input', function(){
            var price = $(this).val().length;
            if(price >= 3)
            {
                var n_main_price = parseFloat($(this).val());        
                var tcw_actual_val = parseFloat($('#tcw_actual').val());
                var tcw_normal = parseFloat($('#tcw_normal').html());
                var tcw_extreme = parseFloat($('#tcw_extreme').html());
                var pri_diff = 0;


                var mos_actual_val = parseFloat($('#mos_actual').val());
                var n_main_price = $('#n_main_price').val();        
                var mos_normal = $('#mos_normal').html();
                var mos_extreme = $('#mos_extreme').html();
                if(mos_actual_val)
                {
                    if(mos_actual_val > mos_normal && mos_actual_val <= mos_extreme)
                    {
                        pri_diff = ((mos_actual_val - mos_normal)/ 100) * n_main_price;
                    }

                    if(mos_actual_val > mos_extreme)
                    {
                        pri_diff =  ((mos_actual_val - mos_normal)/ 100) * n_main_price;
                        pri_diff =  2 * parseFloat(pri_diff);
                    }
                    if(mos_actual_val <= mos_normal)
                    {
                        pri_diff = 0;
                    }

                    $('#mos_price').html(pri_diff.toFixed(2));

                    if($('#bro_actual').val() && $('#fm_actual').val() && $('#thin_actual').val() && $('#tcw_actual').val())
                    {
                        var total = parseFloat($('#mos_price').html());
                        total = total + parseFloat($('#bro_price').html());
                        total = total + parseFloat($('#fm_price').html());
                        total = total + parseFloat($('#thin_price').html());
                        total = total + parseFloat($('#tcw_price').html());
                        $('#total_price').html(total.toFixed(2));
                    }
                }

                var bro_actual_val = parseFloat($('#bro_actual').val());
                var n_main_price = $('#n_main_price').val();        
                var bro_normal = $('#bro_normal').html();
                var bro_extreme = $('#bro_extreme').html();

                if(bro_actual_val)
                {
                    if(bro_actual_val > bro_normal && bro_actual_val <= bro_extreme)
                    {
                        pri_diff = ((bro_actual_val - bro_normal)/ 200) * n_main_price;
                    }

                    if(bro_actual_val > bro_extreme)
                    {
                        pri_diff =  ((bro_actual_val - bro_normal)/ 100) * n_main_price;
                    }
                    if(bro_actual_val <= bro_normal)
                    {
                        pri_diff = 0;
                    }

                    $('#bro_price').html(pri_diff.toFixed(2));

                    if($('#mos_actual').val() && $('#fm_actual').val() && $('#thin_actual').val() && $('#tcw_actual').val())
                    {
                        var total = parseFloat($('#mos_price').html());
                        total = total + parseFloat($('#bro_price').html());
                        total = total + parseFloat($('#fm_price').html());
                        total = total + parseFloat($('#thin_price').html());
                        total = total + parseFloat($('#tcw_price').html());
                        $('#total_price').html(total.toFixed(2));                    
                    }
                }

                var thin_actual_val = parseFloat($('#thin_actual').val());
                var n_main_price = $('#n_main_price').val();        
                var thin_normal = $('#thin_normal').html();
                var thin_extreme = $('#thin_extreme').html();

                if(thin_actual_val)
                {
                    if(thin_actual_val > thin_normal && thin_actual_val <= thin_extreme)
                    {
                        pri_diff = ((thin_actual_val - thin_normal)/ 200) * n_main_price;
                    }

                    if(thin_actual_val > thin_extreme)
                    {
                        pri_diff =  ((thin_actual_val - thin_normal)/ 100) * n_main_price;
                    }

                    if(thin_actual_val <= thin_normal)
                    {
                        pri_diff = 0;
                    }

                    $('#thin_price').html(pri_diff.toFixed(2));

                    if($('#mos_actual').val() && $('#fm_actual').val() && $('#bro_actual').val() && $('#tcw_actual').val())
                    {
                        var total = parseFloat($('#mos_price').html());
                        total = total + parseFloat($('#bro_price').html());
                        total = total + parseFloat($('#fm_price').html());
                        total = total + parseFloat($('#thin_price').html());
                        total = total + parseFloat($('#tcw_price').html());
                        $('#total_price').html(total.toFixed(2));
                    }
                }

                var fm_actual_val = parseFloat($('#fm_actual').val());
                var n_main_price = $('#n_main_price').val();        
                var fm_normal = $('#fm_normal').html();
                var fm_extreme = $('#fm_extreme').html();

                if(fm_actual_val)
                {
                    if(fm_actual_val > fm_normal && fm_actual_val <= fm_extreme)
                    {
                        pri_diff = ((fm_actual_val - fm_normal)/ 100) * n_main_price;
                    }

                    if(fm_actual_val > fm_extreme)
                    {
                        pri_diff =  ((fm_actual_val - fm_normal)/ 100) * n_main_price;
                    }
                    if(fm_actual_val <= fm_normal)
                    {
                        pri_diff = 0;
                    }

                    $('#fm_price').html(pri_diff.toFixed(2));

                    if($('#mos_actual').val() && $('#thin_actual').val() && $('#bro_actual').val() && $('#tcw_actual').val())
                    {
                        var total = parseFloat($('#mos_price').html());
                        total = total + parseFloat($('#bro_price').html());
                        total = total + parseFloat($('#fm_price').html());
                        total = total + parseFloat($('#thin_price').html());
                        total = total + parseFloat($('#tcw_price').html());
                        $('#total_price').html(total.toFixed(2));
                    }
                }

                var tcw_actual_val = parseFloat($('#tcw_actual').val());
                var n_main_price = $('#n_main_price').val();
                var tcw_normal = $('#tcw_normal').html();
                var tcw_extreme = $('#tcw_extreme').html();
                var pri_diff = 0;
                if(tcw_actual_val)
                {
                    if(tcw_actual_val < tcw_normal && tcw_actual_val >= tcw_extreme)
                    {
                        pri_diff = ((tcw_normal - tcw_actual_val)/ 100) * n_main_price;
                    }

                    if(tcw_actual_val <= tcw_extreme)
                    {
                        pri_diff =  ((tcw_normal - tcw_actual_val)/ 100) * n_main_price;
                        pri_diff =  2*pri_diff;
                    }
                    if(tcw_actual_val >= tcw_normal)
                    {
                        pri_diff = 0;
                    }

                    if($('#mos_actual').val() && $('#thin_actual').val() && $('#bro_actual').val() && $('#fm_actual').val())
                    {
                        var total = parseFloat($('#mos_price').html());
                        total = total + parseFloat($('#bro_price').html());
                        total = total + parseFloat($('#fm_price').html());
                        total = total + parseFloat($('#thin_price').html());
                        total = total + parseFloat($('#tcw_price').html());
                        $('#total_price').html(total.toFixed(2));
                    }

                    $('#tcw_price').html(pri_diff.toFixed(2));
                }

                if(n_main_price)
                {
                    if(tcw_actual_val < tcw_normal && tcw_actual_val >= tcw_extreme)
                    {
                        pri_diff = ((tcw_normal - tcw_actual_val)/ 100) * n_main_price;
                    }

                    if(tcw_actual_val <= tcw_extreme)
                    {
                        pri_diff =  ((tcw_normal - tcw_actual_val)/ 100) * n_main_price;
                        pri_diff =  2*pri_diff;
                    }
                    if(tcw_actual_val >= tcw_normal)
                    {
                        pri_diff = 0;
                    }

                    if($('#mos_actual').val() && $('#thin_actual').val() && $('#bro_actual').val() && $('#fm_actual').val())
                    {
                        var total = parseFloat($('#mos_price').html());
                        total = total + parseFloat($('#bro_price').html());
                        total = total + parseFloat($('#fm_price').html());
                        total = total + parseFloat($('#thin_price').html());
                        total = total + parseFloat($('#tcw_price').html());
                        $('#total_price').html(total.toFixed(2));
                    }
                }else{
                    $('#mos_price').html('0');
                    $('#bro_price').html('0');
                    $('#tcw_price').html('0');
                    $('#fm_price').html('0');
                    $('#thin_price').html('0');
                    $('#total_price').html('');
                    $('#nr_quality_variance').val('');
                }
            }else{
                $('#mos_price').html('0');
                $('#bro_price').html('0');
                $('#tcw_price').html('0');
                $('#fm_price').html('0');
                $('#thin_price').html('0');
                $('#total_price').html('');
                $('#nr_quality_variance').val('');
            }
        });
    });

</script>
@endsection
