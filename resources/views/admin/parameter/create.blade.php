@extends('layouts.admin')

@section('content')
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i> Crear {{ $current_module->title }}:</h2><i class="fa fa-close pull-right" onclick="javascript: history.back();"></i>
	</div>
	
	{!! Form::model($parameter, ['route' => 'parameter.store', 'method'=>'POST', 'class'=>'form-horizontal']) !!}
		{!! Form::hidden('module_id', $current_module->id) !!}
	    {!! Form::hidden('lang_id', $lang_id) !!}
	    {!! Form::hidden('group_id', $group_id) !!}

		@include('admin.parameter.partials.fields')

	{!! Form::close() !!}
</div>
@endsection
