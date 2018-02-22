<?php
use \App\Util\SEO;
use \App\Util\XMLParser;

$list = $page->children;
$enlace = null;
?>
<h2>{{ $page->title }}</h2>

	<div class="galeria_box">

	@foreach($list as $item)
	<?php
		$schema=$item->schema;
		$galeria=$item->children;
		if(count($galeria)==0) continue;
	?>
		<div class="evento">
			<h3>{{ $item->title }}</h3>
			<div class="texto100">{!! $item->description !!}</div>
			@if($schema->front_view=='galeria_fotos')
			<ul class="galeria_imagenes">
				@foreach($galeria as $item)
				<?php
					$imagen=XMLParser::getValue($item->media, 'imagen');
				?>
				<li>											
					<img src="{{ asset('/userfiles/'.$imagen) }}" />
				</li>
				@endforeach
			</ul>
			@endif
			@if($schema->front_view=='galeria_videos')
			<div class="video_box">
				@foreach($galeria as $item)
				<?php
					$video=XMLParser::getValue($item->param, 'video');
					$search = '/youtube\.com\/watch\?v=([a-zA-Z0-9]+)/smi';
					$replace= "youtube.com/embed/$1";    
					$url_video = preg_replace($search, $replace, $video);
				?>
				<div class="video">
					<div class="contendor_video">
						<iframe width="560" height="315" src="{{ $url_video }}" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
				@endforeach
			</div>
			@endif
		</div>
	@endforeach

	</div>
