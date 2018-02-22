<?php
$documento=\App\Util\XMLParser::getValue($article->media, 'documento');

$directory=\App\CmsDirectory::select()->where('alias', 'pagina_documento')->first()->path;
?>
		<div class="form-group">
		  {!! Form::label('media[documento]', 'Documento', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		  <div class="col-sm-9 col-lg-11">
		    <div class="input-group">
		      {!! Form::text('media[documento]', $documento, ['class'=>'form-control fmanager', 'id'=>'media_documento', 'rel'=>$directory ]) !!}
		    </div>
		  </div>
		</div>
