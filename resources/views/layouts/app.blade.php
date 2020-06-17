<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	 <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

     <!-- Fonts -->
     <link rel="dns-prefetch" href="//fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="{{asset('css/slick.css')}}" />
	<link type="text/css" rel="stylesheet" href="{{asset('css/slick-theme.css')}}" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="{{asset('css/nouislider.min.css')}}" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('css/main.css')}}" />
	<link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}" />
	<link type="text/css" rel="stylesheet" href="{{asset('css/search.css')}}" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body style="height:100%">
	<!-- HEADER -->
	 @include('inc.header')
	<!-- /HEADER -->

	<!-- NAVIGATION -->
	@include('inc.nav')
	<!-- /NAVIGATION -->

    <!-- OTHERPAGES-->
    <div style="min-height:100%">
     @yield('content')
    </div>
    <!-- /OTHERPAGES-->

	<!-- FOOTER -->
	@include('inc.footer')
	<!-- /FOOTER -->

    <!-- jQuery Plugins -->


	<script src="{{asset('js/jquery.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/slick.min.js')}}"></script>
	<script src="{{asset('js/nouislider.min.js')}}"></script>
    <script src="{{asset('js/jquery.zoom.min.js')}}"></script>
    <script src="{{ asset('js/wow.js') }}" defer></script>

    <script src="{{asset('js/main1.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{ asset('js/viewer.js') }}" defer></script>

   <!-- font awesome -->
   <script src="https://kit.fontawesome.com/2e5f65967e.js" crossorigin="anonymous"></script>

</body>

</html>
