@extends('layouts.app', ['class' => 'login-page', 'page' => _('Buscar'), 'contentClass' => 'login-page'])

@section('content')
    <div class="col-md-10 text-center ml-auto mr-auto">
        <h3 class="mb-5"></h3>
    </div>
    <div class="col-lg-8 col-md-10 ml-auto mr-auto">
        <form class="form" method="post" action="{{ url('buscar') }}">
            @csrf
            <div class="card card-login card-white">
                <div class="card-header">
                    <h1 class="login-title center-text">{{ _('Buscar medicamento') }}</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <p class="text-resultado center-text">{{ $mensaje }}</h1>
                          </div>
                        </div>
                      </div>
                    </div>
                <div class="card-footer text-center">
                    <a href="{{ url('buscar') }}" class="btn btn-md btn-primary">{{ _('Volver') }}</a>
                </div>
            </div>
        </form>
    </div>
@endsection
