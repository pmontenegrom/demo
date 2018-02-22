@extends('layouts.front')
<?php

$conf_sitename = \App\CmsConfig::where('alias', 'site_name')->first()->value;

$metas_title = $page->title.' - '.$conf_sitename;
$metas_descr = \App\Util\XMLParser::getValue($page->metas, 'description');
$metas_keywr = \App\Util\XMLParser::getValue($page->metas, 'keywords');
$metas_robot = \App\Util\XMLParser::getValue($page->metas, 'robots');
$metas_image = \App\Util\XMLParser::getValue($page->metas, 'image');
$metas_url	 = \App\Util\SEO::url_article($page);

$schema=$page->schema;
$front_view = 'front.templates.'.$schema->front_view;

$parent_0=count($parents)>0? $parents[0]: $page;
$bloque_widget = $parent_0->child_template('bloque_widget')->first();
$css_container = in_array($schema->front_view, ['linea_producto', 'seccion_galeria'])? ' completo': NULL;
?>
@section('content')
    <section class="wrapper_principal wrapper_interna">
		@include('front.partials.banner_interna')
		<section class="white_zone">
			<div class="container">
				<section class="left_side{{ $css_container }}">
			@if(View::exists($front_view))
				@include($front_view)
			@else
				@include('front.partials.missing_template')
			@endif
				</section>
			@if(in_array($schema->front_view, ['pagina_producto', 'producto']))
				<aside>
					@include('front.partials.bloque_productos')
				</aside>
				@elseif($bloque_widget)
				<aside>
					@include('front.partials.bloque_widget')
				</aside>
			@endif
			</div>
		</section>
	</section>
@endsection

@section('meta_tag')
	<title>{{ $metas_title }}</title>
	<meta name="description" content="{{ $metas_descr }}">
	<meta name="keywords" content="{{ $metas_keywr }}">
	<meta name="robots" content="{{ $metas_robot }}" />
	<meta property="og:title" content="{{ $metas_title }}" />
	<meta property="og:type" content="article" />
	<meta property="og:image" content="{{ url('userfiles/'.$metas_image) }}" />
	<meta property="og:url" content="{{ $metas_url }}" /> 
@endsection

@section('header_js')
@endsection
