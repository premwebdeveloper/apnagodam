<footer> <!-- footer starts here -->
    <section id="footer">
        <div class="container">
            <div class="row">

                <div class="col-sm-3 px-4 mb-4">
                   <iframe width="100%" height="200" src="https://www.youtube.com/embed/hzZdgPYVIhM" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
                <div class="col-sm-3 px-4 mb-4">
                    <iframe width="100%" height="200" src="https://www.youtube.com/embed/dswDEBdAtZ8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
                <div class="col-sm-3 px-4 mb-4">
                   <p>Terminal in Jaipur, Terminal in Sikar, Terminal in Jhunjhunu, Terminal in Bikaner</p>
                </div>
                <div class="col-sm-3 px-4 mb-4">
                   <p><a href="{{ route('about-us') }}">About Us</a>&nbsp; |&nbsp; <a href="{{ route('our-team') }}">Our Team</a> <br><a href="{{ route('terms-conditions') }}">Terms & Conditions</a>
                </div>

            </div>
            <hr>
            <div class="row">

                <div class="col-sm-6 px-4 mb-4">
                   <p>&copy; 2018 Apna Godam All Rights Reserved</p>
                </div>
                <div class="col-sm-6 px-4 mb-4 text-right">
                    <p>Designed by <a href="https://www.hastagsoft.com/" target="_blank" style="color:#00c0f5!important;"><b>Hastag Soft</b></p>
                </div>

            </div>
        </div>
    </section>
</footer>

<!-- Bootstrap core JavaScript -->

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