<?php
use \App\Util\XMLParser;
use \App\Util\SEO;

$list = $page->children;
$lparent = $page->parent->submenu;
?>
<h1>{{ $page->title }}</h1>
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
<div class="box">
	<ul class="lista_productos">
		@foreach($list as $item)
		<?php
			$icono=XMLParser::getValue($item->media, 'icono');
			$url=SEO::url_article($item);
		?>
		<li>
			<a href="{{ $url }}" class="full"></a>
			<div class="imagen">
				<img src="{{ asset('/userfiles/'.$icono) }}">
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

@foreach($lparent as $linea)
<?php
if($linea->id==$page->id) continue;
$url=SEO::url_article($linea);
?>
	<div class="btn_rojo center">
		<a href="{{ $url }}" class="full"></a> {{ $linea->title }}
	</div>
@endforeach

</div>
