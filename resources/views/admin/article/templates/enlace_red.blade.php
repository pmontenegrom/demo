<?php
$icono=\App\Util\XMLParser::getValue($article->media, 'icono');
$icono_small=\App\Util\XMLParser::getValue($article->media, 'icono_small');

$directory=\App\CmsDirectory::select()->where('alias', 'redes_icono')->first()->path;
?>
	<div class="form-group">
	  {!! Form::label('media[icono]', 'Imagen (icono)', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	    <div class="input-group">
	      {!! Form::text('media[icono]', $icono, ['class'=>'form-control fmanager', 'id'=>'media_icono', 'rel'=>$directory ]) !!}
	    </div>
	  </div>
	</div>
	<div class="form-group">
	  {!! Form::label('media[icono_small]', 'Imagen (icono header)', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	    <div class="input-group">
	      {!! Form::text('media[icono_small]', $icono_small, ['class'=>'form-control fmanager', 'id'=>'media_icono_small', 'rel'=>$directory ]) !!}
	    </div>
	  </div>
	</div>
	@include('admin.article.partials.enlace')
