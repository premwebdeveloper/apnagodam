
</div>
<script src="{{ asset('resources/frontend_assets/theme/vendors/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('resources/frontend_assets/theme/vendors/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('resources/frontend_assets/theme/vendors/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('resources/frontend_assets/theme/vendors/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
<script src="{{ asset('resources/frontend_assets/theme/vendors/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('resources/frontend_assets/theme/vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('resources/frontend_assets/theme/vendors/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('resources/frontend_assets/theme/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('resources/frontend_assets/theme/vendors/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('resources/frontend_assets/theme/vendors/jvectormap/jvectormap.min.js') }}"></script>
<script src="{{ asset('resources/frontend_assets/theme/vendors/jvectormap/jvectormap-worldmill.js') }}"></script>
<script src="{{ asset('resources/frontend_assets/theme/js/locations.js') }}"></script>
<script src="{{ asset('resources/frontend_assets/theme/js/script.js') }}"></script>

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
</body>
</html>