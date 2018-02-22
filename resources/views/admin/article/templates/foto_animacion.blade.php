<?php
$imagen=\App\Util\XMLParser::getValue($article->media, 'imagen');
$hide_title=\App\Util\XMLParser::getValue($article->param, 'hide_title');

$directory=\App\CmsDirectory::select()->where('alias', 'animacion_home')->first()->path;
?>
<!--
	<div class="form-group">
		{!! Form::label('subtitle', 'Subtítulo', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		  {!! Form::text('subtitle', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
	  {!! Form::label('media[imagen]', 'Imagen', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	    <div class="input-group">
	      {!! Form::text('media[imagen]', $imagen, ['class'=>'form-control fmanager', 'id'=>'media_imagen', 'rel'=>$directory ]) !!}
	    </div>
	  </div>
	</div>
/-->
@include('admin.article.partials.enlace')
<!--
	<div class="form-group">
	  {!! Form::label('', '', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<label class="col-sm-9 col-lg-11">
		  {!! Form::checkbox('param[hide_title]', 1, $hide_title) !!}
			Ocultar el título
		</label>
	</div>
/-->