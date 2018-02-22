<?php
$fheads=App\CrmFormField::Select()
        ->Where('form_id', $form_id)
        ->get();
?>
<table>
<tr>
    <th>Nombres</th>
    <th>Apellidos</th>
    <th>DNI</th>
    <th>Direcci&oacute;n</th>
    <th>Tel&eacute;fono</th>
    <th>Email</th>
    <th>Comentario</th>
@foreach ($fheads as $fh)
    <th>{!! $fh->name !!}</th>
@endforeach
    <th>Fecha de Registro</th>
</tr>
@foreach ($registers as $register)
<tr>
    <td>{{ $register->first_name }}</td>
    <td>{{ $register->last_name }}</td>
    <td>{{ $register->dni }}</td>
    <td>{{ $register->address }}</td>
    <td>{{ $register->phone }}</td>
    <td>{{ $register->email }}</td>
    <td>{{ $register->comments }}</td>
@foreach ($fheads as $fh)
<?php
$rf=App\CrmRegisterField::Select()
        ->Where('register_id', $register->id)
        ->Where('field_id', $fh->id)
        ->first();
?>
    @if($rf!=null)
        <td>{!! $rf->get_value() !!}</td>
    @endif
@endforeach
    <td>{{ $register->created_at }}</td>
</tr>
@endforeach
</table>
