<?php
$noticias = \App\CmsArticle::whereHas('schemas', function ($query) {
    $query->where('front_view', 'noticia');
})
->where('active', '1')
->orderBy('date', 'desc')
->take(2)->get();

$url_noticias=url('/'.$noticias->first()->parent->slug.'.html');
?>
	<div class="home_novedades">
		<div class="titulo">
			{{ $acceso->title }}
		</div>
		<div class="vermas_eventos">
			<a href="{{ $url_noticias }}" class="full"></a>
			Ver más eventos
		</div>
		<div class="clear"></div>

	@foreach($noticias as $item)
	<?php
	$imagen=\App\Util\XMLParser::getValue($item->media, 'imagen');
	$date =strtotime($item->date);
	$datef=date('d', $date).' de '.\App\Util\DateFormat::get_Mes(date('m', $date)).' de '.date('Y', $date);
	?>
		<div class="box_noticia">
			<div class="imagen">
				<img src="{{ asset('/userfiles/'.$imagen) }}">
			</div>
			<div class="texto100">
				<span>{{ $datef }}</span>
				{!! $item->resumen !!}
			</div>
			<div class="ico_mas">
				<a href="{{ url('/'.$item->slug.'.html') }}"><img src="{{ asset('/assets/front/images/ico_mas.png') }}"></a>
			</div>
			<div class="clear"></div>
		</div>
	@endforeach
	</div>