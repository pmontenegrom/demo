<?php
$items=$bloque_widget->children;
?>
<ul class="left_side">
@foreach($items as $item)
<?php
	$imagen=\App\Util\XMLParser::getValue($item->media, 'imagen');
	$icono=\App\Util\XMLParser::getValue($item->media, 'icono');
	$url = \App\Util\SEO::url_redirect($item);
?>
	<li>
	@if(!empty($icono))
		<div class="titulo">
			<div class="ico">
				<img src="{{ asset('/userfiles/'.$icono) }}" alt="{{ $item->title }}">
			</div>
			{{ $item->title }}
		</div>
		<div class="texto100">
			{!! $item->resumen !!}
		</div>
	@else
		<div class="img100">
			<img src="{{ asset('/userfiles/'.$imagen) }}" alt="{{ $item->title }}">
		</div>
		<div class="titulo">
			{{ $item->title }}
		</div>
	@endif
		<div class="btn_rojo leermas">
			<a href="{{ $url }}" class="full"></a>
			Leer más
		</div>
	</li>
@endforeach
</ul>
