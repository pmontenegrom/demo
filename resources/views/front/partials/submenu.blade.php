<?php
use \App\Util\SEO;
use \App\Util\XMLParser;

$show_menu=XMLParser::getValue($parent_0->param, 'show_menu')=='1';
$smenus=$show_menu? $parent_0->submenu: array();
?>
	@foreach ($smenus as $smenu)
	<?php
		$items=$smenu->submenu;

		$has_items=count($items)>0 && !in_array($smenu->schema->front_view, ['pagina_noticias', 'pagina_proyecto']);
		$active=($smenu->id==$page->id || $smenu->id==$page->parent_id);
		$url=SEO::url_article($smenu);
	?>
		<li class="{{ $has_items? 'consubs': 'sin-flecha' }} {{ $active? 'activo': '' }}">
		@if($has_items)
			<div class="word {{ $active? 'abierto': '' }}">{{ $smenu->title }}</div>

			<ul class="lista_submenu {{ $active? 'submenu_abierto': '' }}">
			@foreach ($items as $item)
			<?php
				$active=$item->id==$page->id;
				$url=SEO::url_article($item);
			?>
				<li class="{{ $active? 'activado': '' }}">
					<a href="{{ $url }}" class="full"></a>
					{{ $item->title }}
				</li>
			@endforeach
			</ul>
		@else
			<a href="{{ $url }}" class="full"></a>
			{{ $smenu->title }}
		@endif
		</li>
	@endforeach
@if(!$show_menu)
<style type="text/css">
	section.wrapper_principal.wrapper_interna .container ul.sidebar{
		display: none;
	}
	section.wrapper_principal.wrapper_interna .container .contenedor_right{
		float: left;
	}
</style>
@endif