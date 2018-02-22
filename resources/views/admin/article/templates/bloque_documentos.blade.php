<?php
$icono=\App\Util\XMLParser::getValue($article->media, 'icono');

$directory=\App\CmsDirectory::select()->where('alias', 'pagina_icono')->first()->path;
?>
	<div class="form-group">
	  {!! Form::label('media[icono]', 'Ícono', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	    <div class="input-group">
	      {!! Form::text('media[icono]', $icono, ['class'=>'form-control fmanager', 'id'=>'media_icono', 'rel'=>$directory ]) !!}
	    </div>
	  </div>
	</div>
