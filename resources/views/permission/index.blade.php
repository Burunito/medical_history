@extends('layouts.app', ['page' => __('Roles'), 'pageSlug' => 'permission'])

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card ">
      <div class="card-header">
        <div class="row">
          <div class="col-8">
            <h4 class="card-title">{{ __('Roles') }}</h4>
          </div>
        </div>
        <div class="card-body">
          <form method="post" autocomplete="off" class="form-filtros">
            <h6 class="heading-small text-muted mb-4">{{ __('Filtros') }}</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-6 col-md-3">
                  <div class="form-group">
                    <label class="form-control-label" for="filtro-rol">{{ __('Rol') }}</label>
                    <input type="text" name="filtro-rol" id="filtro-rol" class="form-control form-control-alternative" value="{{ old('filtro-rol') }}">
                  </div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="form-group">
                    <label class="form-control-label" for="filtro-descripcion">{{ __('Descripción') }}</label>
                    <input type="text" name="filtro-descripcion" id="filtro-descripcion" class="form-control form-control-alternative" value="{{ old('filtro-descripcion') }}">
                  </div>
                </div>
                <div class="col-3 form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="showInactive" name="showInactive" value="1">
                    <span class="form-check-sign">Inactivos</span>
                  </label>
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
            <div class="col-12 pull-right">
              @if(auth()->user()->hasPermission('Agregar-'.$permission))
              <div class="col-4 pull-right">
                <a href="{{ url('/user/create') }}" class="btn btn-sm btn-primary">{{ __('Agregar usuario') }}</a>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        @include('alerts.success')
        <div class="">
            <table class="table datatable" id="permission-table">
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
    {!!Html::script("js/catalogos/permission.js")!!}
@endsection