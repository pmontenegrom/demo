@extends('layouts.admin')

@section('content')

<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($current_module->moduleIcon=='')?"fa-list":$current_module->moduleIcon; ?>"></i> {{ $current_module->name }}</h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

{!! Form::open(['route' => 'parameter.index', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
    {!! Form::hidden('module_id', $current_module->id) !!}
    {!! Form::hidden('group_id', $group_id) !!}
    <div class="form-group">
        <div class="col-sm-4">
            {!! Form::select('lang_id', $langs, $lang_id, ['class'=>'form-control', 'onchange'=>'this.form.submit()']) !!}
        </div>
        <div class="col-sm-6">
            <input name="filter" class="form-control" type="text" id="filter" value="{{ $filter }}" placeholder="Buscar por nombre" />
        </div>
        <div class="col-sm-2">
          <button type="submit" class="btn btn-success"><span class="fa fa-search"></span> Buscar</button>
        </div>
    </div>
{!! Form::close() !!}

    <table class="table table-bordered table-hover">
    <tr>
        <th class="col-sm-9">Nombre</th>
        <th class="col-sm-1 text-center">Activo</th>
        <th class="col-sm-2">Acciones</th>
    </tr>
    @foreach ($parameters as $parameter)
    <?php
        $active = $parameter->active? '<i class="fa fa-check"></i>' : NULL;
    ?>
    <tr>
        <td>{{ $parameter->name }}</td>
        <td class="text-center">{!! $active !!}</td>
        <td>
        <a href="{{ route('parameter.edit', $parameter) }}" class = "btn btn-warning btn-xs">
            <i class="glyphicon glyphicon-edit"></i> Editar
        </a>
        {!! Form::open(array('id'=>'frm_del-'.$parameter->id, 'method'=>'DELETE', 'route' => array('parameter.destroy', $parameter->id), 'style' => 'display:inline'
        )) !!}
            {!! Form::hidden('module_id', $current_module->id) !!}
            {!! Form::hidden('lang_id', $lang_id) !!}
            {!! Form::hidden('group_id', $group_id) !!}
        <label data-form="#frm_del-{{$parameter->id}}" data-title="Eliminar {{ $current_module->title }}" data-message="Esta seguro que desea eliminar <strong>'{{ $parameter->name }}'</strong>?" >
            <a class = "btn btn-danger btn-xs mod_delete" href="">
                <i class="glyphicon glyphicon-trash"></i> Borrar 
            </a>
        </label>
        {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
    {!! $parameters->render() !!}
  </div>
  <div class="box-footer">
    <a class="btn btn-success" id="btn_add" role="button" href="{{ route('parameter.create') }}{{ $module_params }}">
    <span class="fa fa-plus"></span> agregar {{ $current_module->title }} </a>
  </div>
</div>

@include('admin.partials.delete_confirm')
<script type="text/javascript">
/*
  $(function(){
    $('#btn_add').click(function(e){
      e.preventDefault();
      var url=$(this).attr('href');
      location.href=url+'&lang_id='+$('form select[name=lang_id]').val();
    });
  });
*/
</script>

@endsection
