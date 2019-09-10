@extends('layouts.app')

@section('title', 'Trainer Create')

@section('content')
    @include('common.errors')
    {!! Form::open(['route' => 'trainer.store', 'method'=>'post', 'files'=>true]) !!}
		  @include('trainer.form')
			{!! Form::submit('Guardar', ['class' => 'btn btn-primary'])!!}
    {!! Form::close()!!}
@endsection
