<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" href="{{ asset('resources/frontend_assets/img/logo-img.png') }}" type="image/x-icon" />
<meta name="keywords" content="Terminal, warehousing, logistics, storage, network, gst, distribution, delivery, pan-india, best-in class logistics, best-in class warehousing, kitting, packing, inward, outward, wms, Terminal management system">
<meta name="description" content="ApnaGodam has a Pan-India network of Warehouses providing Best-in Class Warehousing and Logistics Solution. With industry Best Technology and Process, we make sure our Client's Operations are handled Effeicienty and Cost Effectively. ">

<title>ApnaGodam - Agriculture Warehousing | Commodity Finance | E-mandi</title>
<link href="{{ asset('resources/frontend_assets/theme/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('resources/frontend_assets/theme/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('resources/frontend_assets/theme/vendors/revolution/css/settings.css') }}" rel="stylesheet">
<link href="{{ asset('resources/frontend_assets/theme/vendors/revolution/css/layers.css') }}" rel="stylesheet">
<link href="{{ asset('resources/frontend_assets/theme/vendors/revolution/css/navigation.css') }}" rel="stylesheet">
<link href="{{ asset('resources/frontend_assets/theme/vendors/animate-css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('resources/frontend_assets/theme/vendors/owl-carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('resources/frontend_assets/theme/vendors/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
<link href="{{ asset('resources/frontend_assets/theme/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('resources/frontend_assets/theme/css/custom.css') }}" rel="stylesheet">
<script src="{{ asset('resources/frontend_assets/theme/js/jquery-2.2.4.js') }}"></script>
<script src="{{ asset('resources/frontend_assets/theme/js/bootstrap.min.js') }}"></script>
</head>
<body>
    <div id="app">
        <?php date_default_timezone_set('Asia/Kolkata'); ?>