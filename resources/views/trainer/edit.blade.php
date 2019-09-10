@extends('layouts.app')

@section('title', 'Trainer Edit')

@section('content')
    {!! Form::model($trainer, ['route' => ['trainer.update', $trainer], 'method'=> 'PUT', 'files'=> true]) !!}
      @include('trainer.form')
			
			{!! Form::submit('Actualizar', ['class' => 'btn btn-primary'])!!}
    {!! Form::close() !!}
@endsection
