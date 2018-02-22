@extends('layouts.admin')

@section('content')
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i> Editar {{ $current_module->title }}: {{$translate->name}}</h2><i class="fa fa-close pull-right"  onclick="javascript:history.back();"></i>
	</div>

	{!! Form::model($translate, ['route' => ['translate.update', $translate], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
		{!! Form::hidden('module_id', $current_module->id) !!}

		@include('admin.translate.partials.fields')

	{!! Form::close() !!}
</div>
@endsection
