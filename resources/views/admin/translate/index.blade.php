@extends('layouts.admin')

@section('content')

<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($current_module->moduleIcon=='')?"fa-list":$current_module->moduleIcon; ?>"></i> {{ $current_module->name }}</h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

{!! Form::open(['route' => 'translate.index', 'method'=>'GET', 'class'=>'form-horizontal']) !!}
    {!! Form::hidden('module_id', $current_module->id) !!}
    {!! Form::hidden('group_id', $group_id) !!}
    <div class="form-group">
        <div class="col-sm-5">
            {!! Form::select('lang_id', $langs, $lang_id, ['class'=>'form-control', 'onchange'=>'this.form.submit()']) !!}
        </div>
        <div class="col-sm-5">
            <input name="filter" class="form-control" type="text" id="filter" value="{{ $filter }}" placeholder="Buscar por nombre" />
        </div>
        <div class="col-sm-2">
          <button type="submit" class="btn btn-success"><span class="fa fa-search"></span></button>
        </div>
    </div>
{!! Form::close() !!}

    <table class="table table-bordered table-hover">
    <tr>
        <th class="col-sm-10">Nombre</th>
        <th class="col-sm-2">Acciones</th>
    </tr>
    @foreach ($translates as $translate)
    <tr>
        <td>{{ $translate->name }}</td>
        <td>
        <a href="{{ route('translate.edit', $translate) }}" class = "btn btn-warning btn-xs">
            <i class="glyphicon glyphicon-edit"></i> Editar
        </a>
        </td>
    </tr>
    @endforeach
    </table>
    {!! $translates->render() !!}
  </div>
  <div class="box-footer">
  </div>
</div>

@include('admin.partials.delete_confirm')

@endsection
