<?php
$profiles=\App\Profile::select()
	->whereNull('sa')
	->where('active', true)
	->pluck('name', 'id');

?>
<div class="box-body">

	<div class="form-group">
		{!! Form::label('name', 'Nombres', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		{!! Form::text('name', null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('email', 'Email', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		{!! Form::text('email', null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('password', 'Contraseña', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		{!! Form::password('password', ['class'=>'form-control', 'autocomplete' => 'off']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('profile_id', 'Perfil de Usuario', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
		@if(!isset($user) || !$user->default)
			{!! Form::select('profile_id', $profiles, null, ['class'=>'form-control']) !!}
		@else
			{!! Form::hidden('profile_id') !!}
			{{ $user->profile->name }}
		@endif
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('', '', ['class'=>'col-sm-3 col-lg-1 control-label']) !!}
		<div class="col-sm-9 col-lg-11">
			<label>
		{!! Form::checkbox('active', '1') !!}
		Activo
			</label>
		</div>
	</div>

</div>
<div class="box-footer">
	<button type="submit" class="btn btn-success"><span class="fa fa-check"></span> guardar </button>
	<a href="{{ route('user.index') }}" class="btn btn-danger"><span class="fa fa-arrow-left"></span> cancelar </a>
</div>
