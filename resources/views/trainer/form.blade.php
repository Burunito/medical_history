<div class="form-group">
  {!! Form::label('name', 'Nombre')!!}
  {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('description', 'Descripcion')!!}
  {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('avatar', 'Avatar')!!}
  {!! Form::File('avatar') !!}
</div>