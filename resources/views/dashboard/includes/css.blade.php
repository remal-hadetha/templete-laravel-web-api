<meta name="description" content="E-commerce Dashboard Version One">
<meta name="author" content="Ali Labib">
<meta name="robots" content="noindex, nofollow">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Open Graph Meta -->
<meta property="og:title" content="E-commerce Dashboard Version One">
<meta property="og:site_name" content="E-commerce">
<meta property="og:description" content="E-commerce Dashboard Version One">
<meta property="og:type" content="website">
<meta property="og:url" content="">
<meta property="og:image" content="">

<!-- Icons -->
<!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
<link rel="shortcut icon" href="{{asset('/')}}media/favicons/favicon.png">
<link rel="icon" type="image/png" sizes="192x192" href="{{asset('/')}}media/favicons/favicon-192x192.png">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('/')}}media/favicons/apple-touch-icon-180x180.png">
<!-- END Icons -->

<!-- Stylesheets -->
<!-- Fonts and OneUI framework -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
<link rel="stylesheet" id="css-main" href="{{asset('/')}}css/oneui.min.css">
@yield('css')
