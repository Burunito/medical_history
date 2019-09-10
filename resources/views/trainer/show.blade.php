@extends('layouts.app')

@section('title', 'Trainer')

@section('content')
    @include('common.success')
		<img style="height: 100px; width: 100px; background-color: #EFEFEF; margin: 20px;" class="card-img-top rounded-circle mx-auto d-block" src="/images/{{$trainer->avatar}}" alt="">
		<div class="text-center">
			<h5 class="card-title">{{$trainer->name}}</h5>
			<div class="text-center">{{$trainer->description}}</div>
			<a href="/trainer/{{$trainer->slug}}/edit" class="btn btn-primary">Editar</a>
			{!! Form::open(['route'=>['trainer.destroy', $trainer->slug], 'method' => 'DELETE']) !!}
			  {!! Form::submit('Eliminar', ['class'=>'btn btn-danger']) !!}
			{!! Form::close() !!}
		</div>
@endsection

