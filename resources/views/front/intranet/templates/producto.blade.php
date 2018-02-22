<?php
use \App\Util\XMLParser;
use \App\Util\SEO;

$imagen		=XMLParser::getValue($page->media, 'imagen');
$sinonimos	=XMLParser::getValue($page->param, 'sinonimos');
$accion_ter	=XMLParser::getValue($page->param, 'accion_ter');
$contactenos=\App\CmsArticle::whereHas('schemas', function ($query) {
    $query->where('front_view', 'seccion_contactenos');
})
->whereNull('parent_id')
->first();

$list=$page->children;
?>
<h2>{{ $page->title }}</h2>
<div class="btn_regresar">
	<a href="{{ SEO::url_article($page->parent) }}" class="full"></a>
	<div class="ico">
		<img src="{{ asset('/assets/front/images/flecha_left.png') }}">
	</div>
	Regresar
</div>
<div class="producto_detalle">
	<div class="imagen">
		<img src="{{ asset('/userfiles/'.$imagen) }}">
	</div>
	<div class="detalle">
		<div class="texto100">
			<h2>{{ $page->subtitle }}</h2>

		@if(!empty($sinonimos))
			<h4>Sinónimos.</h4>
			<p>{{ $sinonimos }}</p>
		@endif
		@if(!empty($accion_ter))
			<h4>Acción terapéutica.</h4>
			<p>{{ $accion_ter }}</p>
		@endif
		@if(!empty($page->description))
			<h4>Propiedades.</h4>
			{!! $page->description !!}
		@endif

		@foreach($list as $item)
			<h4>{{ $item->title }}.</h4>
			<p>{!! $item->description !!}</p>
		@endforeach

		</div>
	</div>
</div>
@if($contactenos)
	<div class="btn_rojo center">
		<a href="{{ SEO::url_article($contactenos) }}" class="full"></a>
		Contactate con nosotros
	</div>
@endif
