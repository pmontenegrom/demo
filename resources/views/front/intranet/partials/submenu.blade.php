<?php
use \App\Util\SEO;
use \App\Util\XMLParser;

$intranet = \App\CmsArticle::whereHas('schemas', function ($query) {
    $query->where('front_view', 'intranet');
})
->whereNull('parent_id')
->first();

$css_active=$intranet->id==$page->id? 'activo': NULL;
?>
<ul class="menu_side">
	<li class="{{ $css_active }}">
		<a href="{{ url('/intranet') }}" class="full"></a>
		Inicio
	</li>
@if($intranet)
<?php
$list=$intranet->children;
?>
	@foreach($list as $item)
	<?php 
		$url=SEO::url_article($item);
		$css_active=$item->id==$page->id? 'activo': NULL;
	?>
	<li class="{{ $css_active }}">
		<a href="{{ $url }}" class="full"></a>
		{{ $item->title }}
	</li>
	@endforeach
@endif
</ul>
