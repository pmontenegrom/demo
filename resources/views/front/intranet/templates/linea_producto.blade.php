<?php
use \App\Util\XMLParser;
use \App\Util\SEO;

$list = $page->children;
?>
<h2>{{ $page->title }}</h2>
<div class="texto100">
	{!! $page->description !!}
</div>
<div class="btn_regresar">
	<a href="{{ SEO::url_article($page->parent) }}" class="full"></a>
	<div class="ico">
		<img src="{{ asset('/assets/front/images/flecha_left.png') }}">
	</div>
	Regresar
</div>
<ul class="lista_productos">
	@foreach($list as $item)
	<?php
		$imagen=XMLParser::getValue($item->media, 'imagen');
		$url=SEO::url_article($item);
	?>
	<li>
		<a href="{{ $url }}" class="full"></a>
		<div class="imagen">
			<img src="{{ asset('/userfiles/'.$imagen) }}">
		</div>
		<div class="slice">
			<span>								
				<h4>
					{{ $item->title }}
				</h4>
				<div class="texto100">
					{!! $item->resumen !!}
				</div>										
			</span>

			<div class="masinfo">
				mas información
				<div class="ico">
					<img src="{{ asset('/assets/front/images/ultra_menu_flecha_gris.png') }}" class="flecha_gris" alt="Farmacias Peru">
					<img src="{{ asset('/assets/front/images/ultra_menu_flecha.png') }}" class="flecha_blanca" alt="Farmacias Peru">
				</div>
			</div>
		</div>
	</li>
	@endforeach
</ul>
