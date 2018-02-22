<?php
use \App\Util\SEO;
use \App\Util\XMLParser;
?>
<div class="barra_ubicacion">
	<div class="container">
	<a href="index.html">Home</a>
	@foreach($parents as $parent)
	<?php
		if(!$parent->schema->is_page) continue;

		//validate if section has view
		if($parent->schema->admin_view=='seccion' && !XMLParser::getValue($parent->param, 'show_page'))
			$url=SEO::url_article($parent->children->first());
		else
			$url=SEO::url_article($parent);
	?>
		> <a href="{{ $url }}">{{ $parent->title }}</a>
	@endforeach
		> <a href="#" class="activo">{{ $page->title }}</a>
	</div>
</div>
