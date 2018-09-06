<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('resources/frontend_assets/css/homepage.bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="all" />

    <!-- font-awesome-icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom fonts for this template -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css?family=Heebo:100,300,400,500,700,800,900" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('resources/frontend_assets/css/main.min.css') }}" rel="stylesheet" type="text/css" media="all" />

    <link href="{{ asset('resources/frontend_assets/css/carousel.min.css') }}" rel="stylesheet" type="text/css" media="all" />

    <meta name="keywords" content="warehouse, warehousing, logistics, storage, network, gst, distribution, delivery, pan-india, best-in class logistics, best-in class warehousing, kitting, packing, inward, outward, wms, warehouse management system">
    <meta name="description" content="ApnaGodam has a Pan-India network of Warehouses providing Best-in Class Warehousing and Logistics Solution. With industry Best Technology and Process, we make sure our Client's Operations are handled Effeicienty and Cost Effectively. ">
    <style>
        .service-box>img{
            height: 265px;
        }
        .service-box{
            background: #00baf2;
            padding-top: 30px;
        }        
        .service-box a, h4{
            color: #000;
        }                 
        .service-box .fa, .fab{
            font-size: 40px;
            margin-bottom: 20px;
            color: #000;
        }
        .modal-header{
            padding: 0rem!important;
            padding-right: 10px!important;
            border-bottom: none!important;
        }
        .modal-content{
            background: #00c0f5!important;
        }
    </style>
</head>
<body>
    <div id="app">