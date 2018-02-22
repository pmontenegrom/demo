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
							Login Usuario
						</h1>
						<div class="box">
							<div class="box_left">
								<div class="texto100">
									Si no tienes Usuario para ingresar a esta seccion porfavor contactate con notroso <a href="contactenos.html">aquí</a>
								</div>	
							</div>
							<div class="box_right">
								<div class="texto100">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.</div>

								<div class="formulario_box">
							    {!! Form::open(['url' => 'intranet/login', 'method'=>'POST']) !!}
									<input type="text" name="email" placeholder="Correo personal *">
									<input type="password" name="password" placeholder="Contraseña *">
									<div class="clear"></div>
									<button type="submit" class="btn_login" style="border: 0px; padding-top: 0; font-size: 12px;">
										<div class="icono">
											<img src="{{ asset('/assets/front/images/ico_login_usuario.png') }}">
										</div>
										Login de Usuario
									</button>
									<a href="cambio-contrasena.html">¿Olvidaste tu contraseña?</a>
							    {!! Form::close() !!}
								</div>
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
