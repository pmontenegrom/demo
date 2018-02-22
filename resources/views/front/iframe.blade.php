<?php
$parent=\App\CmsArticle::find($page->parent_id);
$categories=$page->children;
$color=\App\Util\XMLParser::getValue($parent->param, 'color');
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Ositran</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="shortcut icon" href="{{ asset('/assets/front/favicon.ico') }}">
	<link rel="stylesheet" href="{{ asset('/assets/front/css/main.css') }}" media="screen">
	<script src="{{ asset('/assets/front/js/jquery-1.11.3.min.js') }}"></script>
	<script src="{{ asset('/assets/front/js/funciones.js') }}"></script>
	<script src="{{ asset('/assets/front/js/jquery.jqtransform.js') }}"></script>
</head>
<body>
  	<div class="wrapper page_informate"> 
	    <section class="wrapper_principal wrapper_interna wrapper_principal_fancy">
			<div class="container no-padding">
				
				<div class="contenedor_fancy {{ $color }}">
					<h1>{{ $parent->title }}<br>
						<span>{{ $parent->subtitle }}</span>
					</h1>
					<div class="box_lista_descargas">
						<ul class="lista_layer_descargas">
						@foreach($categories as $category)
						<?php
							$items=$category->children;
						?>
							<li>
								<div class="word">
									{{ $category->title }}
									<div class="solapa"></div>
								</div>
								<ul class="lista_descargas">
								@foreach($items as $item)
								<?php
									$doc=\App\Util\XMLParser::getValue($item->media, 'documento');
									$url=!empty($doc)? asset('/userfiles/'.$doc): '#';
								?>
									<li>
										{{ $item->title }}
										<div class="btn_descargar">
											<a href="{{ $url }}" target="_blank" class="full"></a>
											Descargar
											<div class="ico">
												<img src="{{ asset('/assets/front/images/layer_descargas_ico_pdf_'.$color.'.png') }}">
											</div>
										</div>
									</li>
								@endforeach
								</ul>
							</li>
						@endforeach
						</ul>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			
	  	</section> 
	    
	</div>
</body>
</html>