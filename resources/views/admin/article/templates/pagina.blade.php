<?php
$texto_contacto=\App\Util\XMLParser::getValue($article->param, 'texto_contacto');

?>
	<div class="form-group">
	  {!! Form::label('description', 'Descripción', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	      {!! Form::textarea('description', null, ['class'=>'form-control ckeditor']) !!}
	  </div>
	</div>
	<div class="form-group">
	  {!! Form::label('param[texto_contacto]', 'Texto Contacto', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	      {!! Form::textarea('param[texto_contacto]', $texto_contacto, ['class'=>'form-control ckeditor']) !!}
		  <br/>Contáctenos para conocer más sobre...
	  </div>
	</div>
<script type="text/javascript">
$(document).ready(function(){
CKEDITOR.replace( 'param[texto_contacto]',
    {
        toolbar : 'Basic',
        height:"100"
    });
});
</script>
