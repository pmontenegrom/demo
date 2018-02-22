<?php
$imagen=\App\Util\XMLParser::getValue($article->media, 'imagen');

$directory=\App\CmsDirectory::select()->where('alias', 'widget_icono')->first()->path;
?>
	<div class="form-group">
	  {!! Form::label('media[imagen]', 'Imagen', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	    <div class="input-group">
	      {!! Form::text('media[imagen]', $imagen, ['class'=>'form-control fmanager', 'id'=>'media_imagen', 'rel'=>$directory ]) !!}
	    </div>
	  </div>
	</div>
	<div class="form-group">
	  {!! Form::label('resumen', 'Resumen', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	      {!! Form::textarea('resumen', null, ['class'=>'form-control']) !!}
	  </div>
	</div>

<script type="text/javascript">
$(document).ready(function(){
CKEDITOR.replace( 'resumen',
    {
        toolbar : 'Basic',
        height:"100"
    });
});
</script>
