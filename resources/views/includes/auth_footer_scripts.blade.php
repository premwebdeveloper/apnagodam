<!-- Mainly scripts -->

    <script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.pie.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/demo/peity-demo.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/dataTables/datatables.min.js') }}"></script>
 <!--    <script src="{{ asset('resources/assets/js/inspinia.js') }}"></script> -->
    <script src="{{ asset('resources/assets/js/plugins/pace/pace.min.js') }}"></script>

    <!-- <script src="{{ asset('resources/assets/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script> -->
    <script src="{{ asset('resources/assets/js/plugins/gritter/jquery.gritter.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/demo/sparkline-demo.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/chartJs/Chart.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/summernote/summernote.min.js') }}"></script>
  
    @include('includes.auth_scripts')
    <script>
        $(document).ready(function(){

            $('.summernote').summernote({
                minHeight: 200
            });
        });
    </script>
</body>

</html>