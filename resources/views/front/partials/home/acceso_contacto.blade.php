<?php
$url = \App\Util\SEO::url_redirect($acceso_contacto);
?>
<section class="barra_contacto">
	<div class="texto100">
		{!! $acceso_contacto->resumen !!}
	</div>
	<div class="btn_rojo">
		<a href="{{ $url }}" class="full"></a>
		{{ $acceso_contacto->title }}
	</div>
	<div class="clear"></div>
</section>
