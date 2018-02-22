<?php
use \App\Util\SEO;
use \App\Util\XMLParser;

$footer = \App\CmsArticle::whereHas('schemas', function ($query) {
    $query->where('front_view', 'seccion_footer');
})
->whereNull('parent_id')
->first();

$bloque_paginas=$footer->find_template('bloque_paginas')->first();
$bloque_redes=$footer->find_template('bloque_redes')->first();

?>
@if($bloque_paginas)
<?php
$paginas=$bloque_paginas->children;
?>
<section class="menuinferior">
	<div class="container">
		<ul class="lista_menuinferior">
		@foreach ($paginas as $item)
		<?php
			$url=SEO::url_article($item);
			$target=SEO::url_target($item);
		?>
			<li>
				<a href="{{ $url }}" target="{{ $target }}" class="full"></a>
				{{ $item->title }}
			</li>
		@endforeach
		</ul>
	</div>
</section>
@endif
@if($bloque_paginas)
<?php
$redes=$bloque_redes->children;
?>
<section class="contendor_footer_blanco">
	<div class="container">
		<div class="borde_top"></div>
		<div class="redes">
			<span>{{ $bloque_redes->title }}: </span>
		@foreach ($redes as $item)
		<?php
			$icono=XMLParser::getValue($item->media, 'icono');
			$url=SEO::url_redirect($item);
			$target=SEO::url_target($item);
		?>
			<a href="{{ $url }}" target="{{ $target }}"><img src="{{ asset('/userfiles/'.$icono) }}"></a>
		@endforeach
		</div>
		<div class="datos">
		{!! $footer->description !!}
		</div>
	</div>
</section>
@endif
