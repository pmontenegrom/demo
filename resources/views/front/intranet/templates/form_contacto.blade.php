<?php
use \App\Util\SEO;
use \App\Util\XMLParser;

$form=\App\CrmForm::select()->where('alias', 'contacto_intra')->first();
$asunto=\App\CrmFormField::select()->where('alias', 'asunto')->first();

$group=\App\CmsParameterGroup::select()->where('alias', 'contacto')->first();
$contacts = [null => 'Seleccionar'] + $group->parameters->lists('name', 'id')->toarray();
?>
<h2>{{ $page->title }}</h2>
<div class="texto100">
	{!! $page->description !!}
	<div class="formulario">
    {!! Form::open(['id'=>'frm_contact', 'url' => 'ajax/form/post', 'method'=>'POST']) !!}
      {!! Form::hidden('form_id', $form->id) !!}
		<div class="texto100">
			{!! $page->description !!}
		</div>

		<div class="campo">
			<div class="txt">
				Asunto:
			</div>
			<input type="text" name="fields[asunto]" id="fields_asunto" required="true">
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
			<div class="txt">Acepto <a href="intranet_terminos-y-condiciones.html" target="_blank">Términos y Condiciones</a></div>
		</div>

		<button type="submit" class="btn_rojo btn_eviar" style="border: 0px; padding-top: 0; font-size: 12px;">Enviar</button>
		<div class="clear"></div>
    {!! Form::close() !!}
    </div>
	<div id="frm_msg" style="display:none">
	  <h3 style="font-weight: bold; font-size: large; margin-bottom:10px">Sus datos se enviaron exitosamente.</h3>
	  <p>Gracias por registrarse, pronto estaremos en contacto.</p>
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
