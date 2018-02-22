<?php
use \App\Util\SEO;
use \App\Util\XMLParser;

$list = $page->children;
$enlace = null;
?>
<h1>{{ $page->title }}</h1>
<div class="box">
	<div class="texto100">
		{!! $page->description !!}
	</div>
	<ul class="lista_premios">
	@foreach($list as $item)
	<?php
		$schema=$item->schema;
		if($schema->is_page || $schema->front_view=='bloque_widget') continue;
		if($schema->front_view=='enlace'){
			$enlace=$item; continue;
		}

		$imagen=XMLParser::getValue($item->media, 'imagen');
	?>
		<li>
			<div class="imagen">
				<img src="{{ asset('/userfiles/'.$imagen) }}" />
			</div>
			<div class="detalle">
				<div class="titulo">{{ $item->title }}</div>
				<div class="texto100">
					{!! $item->description !!}
				</div>
			</div>
		</li>
	@endforeach
	</ul>
	@if($enlace)
	<?php
		$url=SEO::url_article($enlace);
		$target=SEO::url_target($enlace);
	?>
		<div class="btn_rojo center">
			<a href="{{ $url }}" target="{{ $target }}" class="full"></a>
			{{ $enlace->title }}
		</div>
	@endif

</div>
