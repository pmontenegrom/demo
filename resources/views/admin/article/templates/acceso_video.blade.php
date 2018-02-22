<?php
$imagen=\App\Util\XMLParser::getValue($article->media, 'imagen');
$video=\App\Util\XMLParser::getValue($article->param, 'video');

$directory=\App\CmsDirectory::select()->where('alias', 'pagina_imagen')->first()->path;

?>
	<div class="form-group">
	  {!! Form::label('resumen', 'Resumen', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	      {!! Form::textarea('resumen', null, ['class'=>'form-control']) !!}
	  </div>
	</div>
	<div class="form-group">
		{!! Form::label('param[video]', 'URL Video', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
	      {!! Form::text('param[video]', $video, ['class'=>'form-control' ]) !!}
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

	@include('admin.article.partials.enlace')

<script type="text/javascript">
$(document).ready(function(){
CKEDITOR.replace( 'resumen',
    {
        toolbar : 'Basic',
        height:"100"
    });
});
</script>
