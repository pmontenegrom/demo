<?php
//$imagen=\App\Util\XMLParser::getValue($article->media, 'imagen');
$show_menu=\App\Util\XMLParser::getValue($article->param, 'show_menu');
$show_page=\App\Util\XMLParser::getValue($article->param, 'show_page');

//$directory=\App\CmsDirectory::select()->where('alias', 'seccion_imagen')->first()->path;
?>
<!--
	<div class="form-group">
		{!! Form::label('subtitle', 'Subtítulo', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		  {!! Form::text('subtitle', null, ['class'=>'form-control']) !!}
		</div>
	</div>
/-->
	<div class="form-group">
	  {!! Form::label('description', 'Descripción', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	      {!! Form::textarea('description', null, ['class'=>'form-control ckeditor']) !!}
	  </div>
	</div>
	<div class="form-group">
	  {!! Form::label('', '', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<label class="col-sm-9 col-lg-11">
		  {!! Form::checkbox('param[show_menu]', 1, $show_menu) !!}
			Mostrar en menú
		</label>
	</div>
	<div class="form-group">
	  {!! Form::label('', '', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<label class="col-sm-9 col-lg-11">
		  {!! Form::checkbox('param[show_page]', 1, $show_page) !!}
			Ver como página
		</label>
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
