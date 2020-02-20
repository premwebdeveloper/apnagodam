@extends('layouts.auth_app')
@section('content')
<?php
$currentuserid = Auth::user()->id;
$role = DB::table('user_roles')->where('user_id', $currentuserid)->first();
$role_id = $role->role_id;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>Case : {{ $case_id }}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="active">
                <strong>Case Details</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Case Details</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-3">

                            <div class="ibox">
                                <div class="ibox-content">
                                    <h3>About Alex Smith</h3>
                                </div>
                            </div>

                            <div class="ibox">
                                <div class="ibox-content">
                                    <h3>Personal friends</h3>
                                    <ul class="list-unstyled file-list">
                                        <li><a href=""><i class="fa fa-file"></i> Project_document.docx</a></li>
                                        <li><a href=""><i class="fa fa-file-picture-o"></i> Logo_zender_company.jpg</a></li>
                                        <li><a href=""><i class="fa fa-stack-exchange"></i> Email_from_Alex.mln</a></li>
                                        <li><a href=""><i class="fa fa-file"></i> Contract_20_11_2014.docx</a></li>
                                        <li><a href=""><i class="fa fa-file-powerpoint-o"></i> Presentation.pptx</a></li>
                                        <li><a href=""><i class="fa fa-file"></i> 10_08_2015.docx</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3">

                            <div class="ibox">
                                <div class="ibox-content">
                                    <h3>About Alex Smith</h3>
                                </div>
                            </div>

                            <div class="ibox">
                                <div class="ibox-content">
                                    <h3>Personal friends</h3>
                                    <ul class="list-unstyled file-list">
                                        <li><a href=""><i class="fa fa-file"></i> Project_document.docx</a></li>
                                        <li><a href=""><i class="fa fa-file-picture-o"></i> Logo_zender_company.jpg</a></li>
                                        <li><a href=""><i class="fa fa-stack-exchange"></i> Email_from_Alex.mln</a></li>
                                        <li><a href=""><i class="fa fa-file"></i> Contract_20_11_2014.docx</a></li>
                                        <li><a href=""><i class="fa fa-file-powerpoint-o"></i> Presentation.pptx</a></li>
                                        <li><a href=""><i class="fa fa-file"></i> 10_08_2015.docx</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3">

                            <div class="ibox">
                                <div class="ibox-content">
                                    <h3>About Alex Smith</h3>
                                </div>
                            </div>

                            <div class="ibox">
                                <div class="ibox-content">
                                    <h3>Personal friends</h3>
                                    <ul class="list-unstyled file-list">
                                        <li><a href=""><i class="fa fa-file"></i> Project_document.docx</a></li>
                                        <li><a href=""><i class="fa fa-file-picture-o"></i> Logo_zender_company.jpg</a></li>
                                        <li><a href=""><i class="fa fa-stack-exchange"></i> Email_from_Alex.mln</a></li>
                                        <li><a href=""><i class="fa fa-file"></i> Contract_20_11_2014.docx</a></li>
                                        <li><a href=""><i class="fa fa-file-powerpoint-o"></i> Presentation.pptx</a></li>
                                        <li><a href=""><i class="fa fa-file"></i> 10_08_2015.docx</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Report File -->
<div id="view_doc" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">CCTV File</h4>
            </div>
            <div class="modal-body">                
                <div class="row">
                    <div class="col-md-12">
                        <object type=""  style="width:100%;min-height:450px;" data="" id="object_data">
                        </object>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){    
        $('.view_report').on('click', function(){
            var file = $(this).attr('data-id');
            var full_url = "<?= url('/'); ?>/resources/assets/upload/cctv/"+file
            $('#object_data').attr('data', full_url);
            $('#view_doc').modal('show');
        });
    });
</script>
@endsection
