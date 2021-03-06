<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{asset('css/frontend_css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/frontend_css/font-awesome.min.css')}}">
    <link href="{{asset('css/frontend_css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend_css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend_css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend_css/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend_css/responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/frontend_css/easyzoom.css')}}" />





    <link rel="stylesheet" href="{{asset('css/frontend_css/bootstrap-responsive.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/matrix-style.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/matrix-media.css')}}" />
    {{--<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />--}}
    {{--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>--}}



    <!--[if lt IE 9]>
    <!--<script src="{{asset('js/frontend_js/html5shiv.js')}}"></script>-->
    <!--<script src="{{asset('js/frontend_js/respond.min.js')}}"></script>-->
    <![endif]-->
    <link rel="shortcut icon" href="{{asset('images/frontend_images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/frontend_images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/frontend_images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/frontend_images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('images/frontend_images/ico/apple-touch-icon-57-precomposed.png')}}">

    @yield('after-style')
</head><!--/head-->

<body>

@include('userlayout.header')

{{--@include('userlayout.slider')--}}

@yield('content')

@include('userlayout.footer')

<script src="{{asset('js/frontend_js/jquery.js')}}"></script>
<script src="{{asset('js/frontend_js/bootstrap.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script src="{{asset('js/frontend_js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('js/frontend_js/price-range.js')}}"></script>
<script src="{{asset('js/frontend_js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('js/frontend_js/main.js')}}"></script>
<script src="{{asset('js/frontend_js/easyzoom.js')}}"></script>

<script src="{{asset('js/frontend_js/jquery.ui.custom.js')}}"></script>

<script src="{{asset('js/frontend_js/maruti.js')}}"></script>
<script src="{{asset('js/frontend_js/jquery.validate.js')}}"></script>


@yield('script')
</body>
</html>