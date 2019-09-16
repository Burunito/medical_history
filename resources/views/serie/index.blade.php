@extends('layouts.app', ['page' => __('Series'), 'pageSlug' => 'serie'])
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card ">
      <div class="card-header">
        <div class="row">
          <div class="col-12">
            <h4 class="card-title">{{ __('Series') }}</h4>
          </div>
        </div>
        <div class="card-body">
          <form method="post" autocomplete="off" class="form-filtros">
            <h6 class="heading-small text-muted mb-4">{{ __('Filtros') }}</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-6 col-md-3">
                  <div class="form-group">
                    <label class="form-control-label" for="filtro-fecha">{{ __('Fecha de captura') }}</label>
                    <input type="text" name="filtro-fecha" id="filtro-fecha" class="date-input form-control form-control-alternative" value="{{ old('filtro-fecha') }}">
                  </div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="form-group">
                    <label class="form-control-label" for="filtro-fecha_caducidad">{{ __('Fecha de caducidad') }}</label>
                    <input type="text" name="filtro-fecha_caducidad" id="filtro-fecha_caducidad" class="date-input form-control form-control-alternative" value="{{ old('filtro-fecha') }}">
                  </div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="form-group">
                    <label class="form-control-label" for="filtro-lote">{{ __('Lote') }}</label>
                    <select class="form-control form-control-alternative" name="filtro-lote" id="filtro-lote" required>
                      <option value=''>{{ __('Seleccione') }}</option>
                      @foreach($lotes as $lote)
                        <option value='{{ $lote->id }}' {{ old('filtro-lote') ? 'selected' : '' }}>{{ $lote->nombre }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="form-group">
                    <label class="form-control-label" for="filtro-serie">{{ __('Serie') }}</label>
                    <input type="text" name="filtro-serie" id="filtro-serie" class="form-control form-control-alternative" value="{{ old('filtro-serie') }}">
                  </div>
                </div>
              </div>
            </div>
          </form>
          <div class="row">
            <div class="col-3">
              <button type="button" class="btn btn-sm btn-primary clear-filters" >{{ __('Limpiar') }}</button>
            </div>
            <div class="col-3">
              <button type="button" class="btn btn-sm btn-primary dataTable-filters" >{{ __('Filtrar') }}</button>
            </div>
          </div>
          <div class="col-12 pull-right">
            @if(auth()->user()->hasPermission('Agregar-'.$permission))
            <div class="col-4 pull-right">
              <a href="{{ url('/serie/create') }}" class="btn btn-sm btn-primary">{{ __('Agregar serie') }}</a>
            </div>
            @endif
          </div>
        </div>
      </div>
      <div class="card-body">
        @include('alerts.success')
        <div class="">
          <table class="table datatable" id="serie-table"></table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
    {!!Html::script("js/catalogos/serie.js")!!}
@endsection