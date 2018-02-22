<?php
$imagen=\App\Util\XMLParser::getValue($article->media, 'imagen');
$directory=\App\CmsDirectory::select()->where('alias', 'galeria_imagen')->first()->path;
?>
	<div class="form-group">
	  {!! Form::label('media[imagen]', 'Imagen', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	    <div class="input-group">
	      {!! Form::text('media[imagen]', $imagen, ['class'=>'form-control fmanager', 'id'=>'media_imagen', 'rel'=>$directory ]) !!}
	    </div>
	  </div>
	</div>
