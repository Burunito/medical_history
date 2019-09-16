@php $pageSlug='Buscar'; @endphp
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
                <div class="card-body form-buscar">
                    <p class="text-dark mb-2 text-center">{{ _('Ingrese los datos de su medicamento para verificar su autenticidad') }}</p>
                <div class="row text-center p-2">
                    <div class="col-12">
                      <div class="form-group">
                        <label class="form-control-label" for="fecha">{{ __('Fecha de caducidad') }}</label>
                        <input type="text" name="fecha" id="fecha" class="date-input form-control form-control-alternative" value="{{ old('fecha') }}">
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label class="form-control-label" for="lote">{{ __('Lote') }}</label>
                        <select class="form-control form-control-alternative" name="lote" id="lote" required>
                          <option value=''>{{ __('Seleccione') }}</option>
                          @foreach($lotes as $lote)
                            <option value='{{ $lote->id }}' {{ old('lote') ? 'selected' : '' }}>{{ $lote->nombre }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label class="form-control-label" for="serie">{{ __('Serie') }}</label>
                        <input type="text" name="serie" id="serie" class="form-control form-control-alternative" value="{{ old('serie') }}">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" href="" class="btn btn-primary btn-lg btn-md mb-3">{{ _('Enviar') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
