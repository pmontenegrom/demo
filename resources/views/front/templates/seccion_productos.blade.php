<?php
use \App\Util\XMLParser;
use \App\Util\SEO;

$list = $page->submenu;
?>
<h1>{{ $page->title }}</h1>
<div class="box">
	<div class="texto100">
		{{ $page->description }}
	</div>
	<ul class="lista_productos_principal">

		@foreach($list as $item)
		<?php
			$imagen=XMLParser::getValue($item->media, 'imagen');
			$url=SEO::url_article($item);
		?>
		<li>
			<a href="{{ $url }}" class="full"></a>
			<img src="{{ asset('/userfiles/'.$imagen) }}">
			{{ $item->title }}
		</li>
		@endforeach

	</ul>
</div>
