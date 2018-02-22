<?php

$productos = \App\CmsArticle::whereHas('schemas', function ($query) {
    $query->where('front_view', 'producto');
})
//->where('ExtractValue(param, "root/item/value[@key=\'showhome\']")', '1')
->where('active', '1')
->orderBy('title')
//->take(4)
->get();

$producto_sec = \App\CmsArticle::whereHas('schemas', function ($query) {
    $query->where('front_view', 'seccion_productos');
})
->whereNull('parent_id')
->first();

$url_productos=\App\Util\SEO::url_article($producto_sec);
$i=0;
?>
<section class="linea_productos">
	<div class="container">
		<div class="home_flecha_down">
			<img src="{{ asset('/assets/front/images/home_flecha_down.png') }}" alt="Farmacias en Peru">
		</div>
		<h3>
			{{ $bloque_productos->title }}
		</h3>
		<ul class="lista_productos">
	@foreach($productos as $item)
	<?php
		$url = \App\Util\SEO::url_article($item);
		$imagen=\App\Util\XMLParser::getValue($item->media, 'imagen');
		$showhome=\App\Util\XMLParser::getValue($item->param, 'showhome');

		if(empty($showhome)) continue;

		$i++;
		if($i>4) break;
	?>
			<li>
				<a href="{{ $url }}" class="full"></a>
				<div class="imagen">
					<img src="{{ asset('/userfiles/'.$imagen) }}">
				</div>
				<h4>
					{{ $item->title }}
				</h4>
				<div class="texto100">
					{!! $item->resumen !!} 
				</div>
			</li>
	@endforeach
		</ul>

		<div class="btn_rojo">
			<a href="{{ $url_productos }}" class="full"></a>
			Ver más productos
		</div>
	</div>
</section>