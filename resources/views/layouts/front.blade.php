<?php
$conf_analytics = \App\CmsConfig::where('alias', 'analytics')->first()->value;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
@yield('meta_tag')
	<link rel="shortcut icon" href="{{ asset('/assets/favicon.ico') }}" type="image/x-icon" />
	<link rel="icon" href="{{ asset('/assets/favicon.ico') }}" type="image/ico" />
	<link rel="stylesheet" href="{{ asset('/assets/front/css/main.css') }}" media="screen">
	<script src="{{ asset('/assets/front/js/jquery-1.11.3.min.js') }}"></script>
	<script src="{{ asset('/assets/front/js/funciones.js') }}"></script>
	<script src="{{ asset('/assets/front/js/jquery.jqtransform.js') }}"></script>
	<script src="{{ asset('/assets/front/js/libs/loader/Pxloader.js') }}"></script>
	<script src="{{ asset('/assets/front/js/libs/loader/PxloaderImage.js') }}"></script>
	<script src="{{ asset('/assets/front/js/jquery.bxslider.min.js') }}"></script>
	<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet" type="text/css">
@yield('header_js')
</head>
<body>
	@yield('loader')
  	<div class="wrapper">
	    <header>
			@include('front.partials.header')
	    </header>   
	    <div class="menu_mobile">
			@include('front.partials.menu_mobile')
	    </div>
	    <div class="sombra"></div>
			@include('front.partials.error_handler')
			@yield('content')
	    <footer>
			@include('front.partials.footer')
	    </footer>
	</div>
{!! $conf_analytics !!}
</body>
</html>

