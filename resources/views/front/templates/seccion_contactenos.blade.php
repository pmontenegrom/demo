<?php
use \App\Util\SEO;
use \App\Util\XMLParser;

$form=\App\CrmForm::select()->where('alias', 'contacto')->first();
//$group=\App\CmsParameterGroup::select()->where('alias', 'contacto')->first();
//$contacts = [null => 'Seleccionar'] + $group->parameters->lists('name', 'id')->toarray();
?>
<h1>{{ $page->title }}</h1>
<div class="box">
	<div class="texto100">
		{!! $page->description !!}
	</div>
	<div class="formulario">
    {!! Form::open(['id'=>'frm_contact', 'url' => 'ajax/form/post', 'method'=>'POST']) !!}
      {!! Form::hidden('form_id', $form->id) !!}
		<div class="campo">
			<div class="txt">
				Nombre:
			</div>
			<input type="text" name="first_name" id="first_name" required="true">
			<div class="clear"></div>
		</div>
		<div class="campo">
			<div class="txt">
				Apellido:
			</div>
			<input type="text" name="last_name" id="last_name" required="true">
			<div class="clear"></div>
		</div>
		<div class="campo">
			<div class="txt">
				Correo:
			</div>
			<input type="text" name="email" id="email" required="true">
			<div class="clear"></div>
		</div>
		<div class="campo">
			<div class="txt">
				Teléfono:
			</div>
			<input type="text" name="phone" id="phone" required="true">
			<div class="clear"></div>
		</div>
		<div class="campo">
			<div class="txt">
				Mensaje:
			</div>
			<textarea name="comment" id="comment" required="true"></textarea>
			<div class="clear"></div>
		</div>
		<div class="campo_termino">
			<input type="checkbox" name="optin" id="optin" value="1">
			<div class="txt">Acepto <a href="pie-de-pagina_bloque-de-paginas_terminos-y-condiciones.html" target="_blank">Términos y Condiciones</a></div>
		</div>

		<button type="submit" class="btn_rojo btn_eviar" style="border: 0px;">Enviar</button>
		<div class="clear"></div>
    {!! Form::close() !!}
		<div id="frm_msg" style="display:none">
		  <h3 style="font-weight: bold; font-size: large; margin-bottom:10px">​Sus datos se enviaron exitosamente.</h3>
		  <p>​Gracias por enviar su consulta, pronto estaremos en contacto.</p>
		</div>
	</div>
</div>
<script>
$(function(){
  $('.formulario').jqTransform({imgPath:'jqtransformplugin/img/'});
});
</script>
<script src="{{ asset('/assets/front/js/form_contacto.js') }}"></script>
<script>
var URL_ROOT="{{ url('/') }}";
</script>
