<?php
use \App\Util\XMLParser;

$url = \App\Util\SEO::url_redirect($bloque_animacion);
$video	=\App\Util\XMLParser::getValue($bloque_animacion->param, 'url_video');
$imagen		=\App\Util\XMLParser::getValue($bloque_animacion->media, 'imagen');
?>
	<section class="banner">
		<div class="container">
			<div class="home_video">
			@if(empty($url_video))
			  <img src="{{ asset('/userfiles/'.$imagen) }}">
			@else
			<?php 
				$search = '/youtube\.com\/watch\?v=([a-zA-Z0-9]+)/smi';
				$replace= "youtube.com/embed/$1";    
				$url_video = preg_replace($search, $replace, $video);
			?>
			  <div class="contendor_video">
				<iframe width="560" height="315" src="{{ $url_video }}" frameborder="0" allowfullscreen></iframe>
			  </div>
			@endif
			</div>
			<div class="caja">
				<h2>
					{{ $bloque_animacion->title }}
				</h2>
				<div class="texto">
					{!! $bloque_animacion->resumen !!}
				</div>

				<div class="btn_rojo">
					<a href="{{ $url }}" class="full"></a>
					<div class="ico_descarga">
						<img src="{{ asset('/assets/front/images/ico_descarga.png') }}" alt="Farmacias en Peru">
					</div>
					Descargar Programa
				</div>
			</div>
			<div class="logo_bpa">
				<img src="{{ asset('/assets/front/images/logo-bpa.png') }}">
			</div>
		</div>
	</section>
