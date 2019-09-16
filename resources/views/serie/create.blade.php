@extends('layouts.app', ['page' => __('Serie'), 'pageSlug' => 'serie'])
@section('content')
@php echo json_encode($errors) @endphp
<div class="container-fluid mt--7">
  <div class="row">
    <div class="col-xl-12 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">{{ __('Series') }}</h3>
            </div>
            <div class="col-4 text-right">
              <a href="{{ url($url) }}" class="btn btn-sm btn-primary">{{ __('Regresar') }}</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form method="post" action="{{ url($url) }}" autocomplete="off">
            @csrf
            @if(isset($record))
              <input name="_method" type="hidden" value="PUT">
              <input name="id" type="hidden" value="{{$record->id}}">
            @endif
            <input type="hidden" id="form-method" value="{{ $method }}">
            <h6 class="heading-small text-muted mb-4">{{ __('Series información') }}</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-4">
                  <div class="form-group{{ $errors->has('lote') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-lote">{{ __('Lote') }}</label>
                    <select class="form-control form-control-alternative{{ $errors->has('lote_id') ? ' is-invalid' : '' }}" name="lote_id" id="input-lote" required>
                      <option value=''>{{ __('Seleccione') }}</option>
                      @foreach($lotes as $lote)
                        <option value='{{ $lote->id }}' {{ $lote->id == old('lote_id') ? 'selected' : ''}}>{{ $lote->nombre }}</option>
                      @endforeach
                    </select>
                    @include('alerts.feedback', ['field' => 'lote_id'])
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group{{ $errors->has('fecha_caducidad') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-fecha_caducidad">{{ __('Fecha de caducidad') }}</label>
                    <input type="text" name="fecha_caducidad" id="input-fecha_caducidad" class="date-input form-control form-control-alternative{{ $errors->has('fecha_caducidad') ? ' is-invalid' : '' }}" placeholder="{{ __('Fecha de caducidad') }}" value="{{ old('fecha_caducidad', isset($record) ? $record->fecha_caducidad : '') }}" required autofocus>
                    @include('alerts.feedback', ['field' => 'fecha_caducidad'])
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group{{ $errors->has('cantidad') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="input-cantidad">{{ __('Cantidad') }}</label>
                    <input type="text" name="cantidad" id="input-cantidad" class="form-control form-control-alternative{{ $errors->has('cantidad') ? ' is-invalid' : '' }}" placeholder="{{ __('Cantidad') }}" value="{{ old('cantidad', isset($record) ? $record->cantidad : '') }}" required autofocus>
                    @include('alerts.feedback', ['field' => 'cantidad'])
                  </div>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-success mt-4">{{ __('Guardar') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
