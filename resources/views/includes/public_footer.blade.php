<footer> <!-- footer starts here -->
    <section id="footer">
        <div class="container">
            <div class="row">
                
                <div class="col-sm-3 px-4 mb-4">
                   <p><img class="max-100" src="img/paytm-logo.png"></p>
                </div>
                <div class="col-sm-3 px-4 mb-4">
                <p> 2018 Copyright. All rights reserved<br/>
                   Privacy Policy | Terms of Service</p>
                </div>
                <div class="col-sm-3 px-4 mb-4">
                   <p>Warehouse in Andheri, Warehouse in Bhiwandi, Warehouse in Lower Parel, Warehouse in Chembur</p>
                </div>
                <div class="col-sm-3 px-4 mb-4">
                   <p><a href="javascript:;">ABOUT US</a>&nbsp; |&nbsp; <a href="javascript:;">FAQs</a> &nbsp;|&nbsp; <a href="javascript:;">BLOG</a>
                   <br>
                   <a href="javascript:;">CAREERS</a> &nbsp;|&nbsp; <a href="javascript:;">CONTACT US</a></p>
                </div>

            </div>
        </div>
    </section>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('resources/frontend_assets/js/jquery.min.js') }}"> </script>
<script src="{{ asset('resources/frontend_assets/js/bootstrap.bundle.min.js') }}"> </script>
<script src="{{ asset('resources/frontend_assets/js/jquery.easing.min.js') }}"> </script>
<script src="{{ asset('resources/frontend_assets/js/scrollreveal.min.js') }}"> </script>
<script src="{{ asset('resources/frontend_assets/js/carousel.min.js') }}"> </script>
<script src="{{ asset('resources/frontend_assets/js/jquery-waypoints.js') }}"> </script>
<script src="{{ asset('resources/frontend_assets/js/main.min.js') }}"> </script>
<script>
    $(document).ready(function(){
        $(document).on('change', '#category', function(){
            var category = $('#category').val();

            if(category==1){
                $("#khasra_show").show();
                $("#khasra").addAttr('required', "required");
                $("#gst").removeAttr('required', "required");
                $("#gst_show").hide();
            }
            else if(category==2 || category==3){
                $("#khasra_show").hide();
                $("#gst_show").show();
                $("#gst").addAttr('required', "required");
                $("#khasra").removeAttr('required', "required");
            }
            else{
                $("#khasra_show").hide();
                $("#gst_show").hide();
                $("#khasra").removeAttr('required', "required");
                $("#gst").removeAttr('required', "required");
            }
        });  
        $("#khasra_show").hide();
        $("#gst_show").hide();
     });
</script>