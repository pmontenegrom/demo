<?php
use \App\Util\XMLParser;
use \App\Util\SEO;

$relates=explode(',', \App\Util\XMLParser::getValue($page->param, 'relates'));
$items=\App\CmsArticle::wherein('id', $relates)->get();
?>
<ul class="lista_lateral_productos">
	@foreach($items as $item)
	<?php
	$icono=XMLParser::getValue($item->media, 'icono');
	$url = SEO::url_article($item);
	?>
		<li>
			<a href="{{ $url }}" class="full"></a>
			<div class="imagen"><img src="{{ asset('/userfiles/'.$icono) }}" alt="{{ $item->title }}"></div>
			<div class="caja">
				<div class="titulo">
					{{ $item->title }}
				</div>
				<div class="texto100">
					{!! $item->resumen !!}
				</div>
				<div class="masinfo">
					mas información
					<div class="ico">
						<img src="{{ asset('/assets/front/images/ultra_menu_flecha.png') }}" alt="Farmacias Peru">
					</div>
				</div>
			</div>
		</li>
	@endforeach
</ul>
