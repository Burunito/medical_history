@extends('layouts.app', ['page' => __('Lote'), 'pageSlug' => 'users'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Lote') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/lote') }}" class="btn btn-sm btn-primary">{{ __('Regresar') }}</a>
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
                            <h6 class="heading-small text-muted mb-4">{{ __('Lote información') }}</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-nombre">{{ __('Nombre') }}</label>
                                            <input type="text" name="nombre" id="input-nombre" class="form-control form-control-alternative{{ $errors->has('nombre') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}" value="{{ old('nombre', isset($record) ? $record->nombre : '') }}" required autofocus>
                                            @include('alerts.feedback', ['field' => 'nombre'])
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
