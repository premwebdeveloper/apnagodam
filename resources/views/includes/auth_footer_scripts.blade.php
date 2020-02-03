<!-- Mainly scripts -->

    <script src="{{ asset('resources/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.js') }}"></script>

    <!-- <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script> -->
    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/flot/jquery.flot.pie.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/demo/peity-demo.js') }}"></script>

    <script src="{{ asset('resources/assets/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/inspinia.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/pace/pace.min.js') }}"></script>

   <script src="{{ asset('resources/assets/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/gritter/jquery.gritter.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/demo/sparkline-demo.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/chartJs/Chart.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/plugins/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/bootstrap-confirmation.js') }}"></script>
  
    @include('includes.auth_scripts')
    <script>
        $(document).ready(function(){

            $('.summernote').summernote({
                minHeight: 200
            });
        });
    </script>
    <script>
        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            container: 'body'
        });

        $('[data-toggle=custom-confirmation-events]')
        .confirmation({
            rootSelector: '[data-toggle=custom-confirmation-events]',
            container: 'body'
        })
        .on('mouseenter', function() {
            $(this).confirmation('show');
        })
        .on('myevent', function() {
            alert('"myevent" triggered');
        });

        var path = window.location.href; 
        $('a').each(function() {
            if (this.href === path) {
                $(this).parent().addClass('active');
            }
        });
    </script>

    @if($role->role_id != 2  && $role->role_id != 1 && $role->role_id != 4)
        <script type="text/javascript">
            $('body').addClass('skin-1');
        </script>
    @endif

    @if($role->role_id == 2)
        <script type="text/javascript">
            $('body').addClass('md-skin pace-done');
        </script>
        <style type="text/css">
            body {
                font-size: 14px;
            }
            .nav .label, .ibox .label {
                font-size: 14px;
            }
            .btn-group-xs>.btn, .btn-xs {
                font-size: 14px;
            }
        </style>
    @endif
</body>

</html>