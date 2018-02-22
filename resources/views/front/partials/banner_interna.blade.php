<?php
$banner=$parent_0;
$imagen=\App\Util\XMLParser::getValue($banner->media, 'imagen');
?>
<section class="banner_interna" style="background: url('{{ asset('/userfiles/'.$imagen) }}') center">
	<div class="container">
	</div>
</section>
