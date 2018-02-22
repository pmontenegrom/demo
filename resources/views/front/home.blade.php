@extends('layouts.front')
<?php

$conf_sitename = \App\CmsConfig::where('alias', 'site_name')->first()->value;

$metas_title = $conf_sitename;
$metas_descr = \App\Util\XMLParser::getValue($page->metas, 'description');
$metas_keywr = \App\Util\XMLParser::getValue($page->metas, 'keywords');
$metas_robot = \App\Util\XMLParser::getValue($page->metas, 'robots');
$metas_image = \App\Util\XMLParser::getValue($page->metas, 'image');
$metas_url	 = url('/');

$parent_0=$page;

$bloque_animacion=$parent_0->child_template('bloque_animacion')->first();
$bloque_widget=$parent_0->child_template('bloque_widget')->first();
$form_escribenos=$parent_0->child_template('form_escribenos')->first();
$acceso_contacto=$parent_0->child_template('acceso_contacto')->first();

$bloque_productos=$parent_0->child_template('bloque_productos')->first();
?>
@section('content')
	<section class="wrapper_principal wrapper_home">

	@if($bloque_animacion)
		@include('front.partials.home.bloque_animacion')
	@endif
	<section class="white_zone">
	  <div class="container">
		@if($bloque_widget)
			@include('front.partials.home.bloque_widget')
		@endif
		@if($form_escribenos)
			@include('front.partials.home.form_escribenos')
		@endif
		<div class="clear"></div>
		@if($acceso_contacto)
			@include('front.partials.home.acceso_contacto')
		@endif
	  </div>
	</section>

	@if($bloque_productos)
		@include('front.partials.home.bloque_productos')
	@endif

	</section>
@endsection

@section('meta_tag')
	<title>{{ $metas_title }}</title>
	<meta name="description" content="{{ $metas_descr }}" />
	<meta name="keywords" content="{{ $metas_keywr }}" />
	<meta name="robots" content="{{ $metas_robot }}" />
	<meta property="og:title" content="{{ $metas_title }}" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="{{ url('userfiles/'.$metas_image) }}" />
	<meta property="og:url" content="{{ $metas_url }}" /> 
@endsection

@section('header_js')
@endsection
