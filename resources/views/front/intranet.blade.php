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
$front_view = 'front.intranet.'.($schema->front_view=='intranet'? 'home': 'templates.'.$schema->front_view);

$parent_0=count($parents)>0? $parents[0]: $page;
$bloque_widget = $parent_0->child_template('bloque_widget')->first();
?>
@section('content')
    <section class="wrapper_principal wrapper_interna">
		@include('front.partials.banner_interna')
		<section class="white_zone">
			<div class="container">
				<section class="left_side completo">
						<h1>
							Sección Privada
						</h1>
						<div class="box">
							<div class="box_left_usuario">
								@include('front.intranet.partials.submenu')
							</div>
							<div class="box_right_usuario">
								@if(View::exists($front_view))
									@include($front_view)
								@else
									@include('front.partials.missing_template')
								@endif
							</div>
							<div class="clear"></div>
						</div>
				</section>
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
