<?php
$plano=\App\Util\XMLParser::getValue($article->media, 'plano');
$color=\App\Util\XMLParser::getValue($article->param, 'color');
$punto=\App\Util\XMLParser::getValue($article->param, 'punto');
$index=\App\Util\XMLParser::getValue($article->param, 'index');
$video=\App\Util\XMLParser::getValue($article->media, 'video');
$mapa=\App\Util\XMLParser::getValue($parent->media, 'mapa');

$arr_color = ['rojo'=>'rojo', 'celeste'=>'celeste', 'verde'=>'verde', 'amarillo'=>'amarillo'];

$dir_proyectop=\App\CmsDirectory::select()->where('alias', 'proyecto_plano')->first()->path;

if(empty($punto)) $punto='0,0';
?>
	<div class="form-group">
		{!! Form::label('subtitle', 'Lugar / Ciudad', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		  {!! Form::text('subtitle', null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
	  {!! Form::label('media[plano]', 'Plano', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	    <div class="input-group">
	      {!! Form::text('media[plano]', $plano, ['class'=>'form-control fmanager', 'id'=>'media_plano', 'rel'=>$dir_proyectop]) !!}
	    </div>
	  </div>
	</div>
	<div class="form-group">
		{!! Form::label('param[color]', 'Color Ícono', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		  {!! Form::select('param[color]', $arr_color, $color, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
	  {!! Form::label('param[punto]', 'Coordenadas', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
	  <div class="col-sm-9 col-lg-11">
	    <div class="input-group">
	      {!! Form::text('param[punto]', $punto, ['class'=>'form-control', 'id'=>'pointer']) !!}
	      <span class="input-group-btn">
	      <button class="btn btn-info btn-flat" type="button" id="launcher"><i class="fa fa-map-marker"></i></button>
	      </span>
	    </div>
	  </div>
	</div>
	<div class="form-group">
		{!! Form::label('param[video]', 'URL Video', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
	      {!! Form::text('media[video]', $video, ['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('param[index]', 'z-index', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		  {!! Form::input('number', 'param[index]', $index, ['class'=>'form-control']) !!}
		  ej: 999999901
		</div>
	</div>

<div class="modal fade" id="mod_punto" tabindex="-1" role="dialog" aria-labelledby="Coordenadas" aria-hidden="true">
  <div class="modal-dialog" style="width: 800px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Ubica las coordenadas en el mapa:</h4>
      </div>
      <div class="modal-body" style="background-color: #ddeeee; padding: 0">
      	<img id="mapa" src="{{ asset('/userfiles/'.$mapa)}}" />
      	<i class="fa fa-map-marker fa-2x" id="pin"></i>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger col-sm-2 pull-right" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<style type="text/css">
#pin{
	position: absolute;
	color: #00BFFF;
	display: block;
	z-index: 999999;
}
</style>
<script type="text/javascript">
function setPointer(e, obj){
    var offset = $(obj).offset();
    var x=parseInt(e.clientX - offset.left)-7;
    var y=parseInt(e.clientY - offset.top)-25;
    $('#pointer').val(x + "," + y);
    return Array(x, y);
}
function doBounce(element, a) {
    $('#pin').css({left: a[0]+'px', top: a[1]+'px'});
    for(i = 0; i < 2; i++) {
        element.animate({top: '-=10px'}, 300).animate({top: '+=10px'}, 300);
    }        
}

$(function(){
    $('#launcher').click(function(){
		$(document).scrollTop(0);
    	$('#mod_punto').modal('toggle');
    	setTimeout(function(){
	        var a=$('#pointer').val().split(',');
	        doBounce($('#pin'), a);
    	}, 500);
    });

	$('#mapa').click(function(e){
      if($('#pin').is(':animated')) return;
      var a=setPointer(e, this);
	  doBounce($('#pin'), a);
	  setTimeout(function(){ $('#mod_punto').modal('hide'); }, 1000);
	});
});
</script>