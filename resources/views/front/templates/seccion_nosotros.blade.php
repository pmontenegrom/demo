<?php
use \App\Util\SEO;
use \App\Util\XMLParser;

$list = $page->children;
?>
<h1>{{ $page->title }}</h1>
<div class="box">
	<div class="texto100">
		{!! $page->description !!}
	</div>
	@foreach($list as $item)
	<?php
		$schema=$item->schema;
		if($schema->is_page || $schema->front_view=='bloque_widget') continue;
	?>
		@if($schema->front_view=='enlace')
		<?php
			$url=SEO::url_article($item);
			$target=SEO::url_target($item);
		?>
			<div class="btn_rojo center">
				<a href="{{ $url }}" target="{{ $target }}" class="full"></a>
				{{ $item->title }}
			</div>
		@else
			<h2>{{ $item->title }}</h2>
			<div class="texto100">							
				{!! $item->description !!}
			</div>
		@endif
	@endforeach
</div>
