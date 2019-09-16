@extends('layouts.app', ['page' => __('Roles'), 'pageSlug' => 'permission'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Roles') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('/permission') }}" class="btn btn-sm btn-primary">{{ __('Regresar') }}</a>
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
                            <h6 class="heading-small text-muted mb-4">{{ __('Rol información') }}</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                  <div class="col-4">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                      <label class="form-control-label" for="input-name">{{ __('Nombre') }}</label>
                                      <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}" value="{{ old('name', isset($record) ? $record->name : '') }}" required autofocus>
                                      @include('alerts.feedback', ['field' => 'name'])
                                    </div>
                                  </div>
                                  <div class="col-4">
                                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                      <label class="form-control-label" for="input-description">{{ __('Descripción') }}</label>
                                      <input type="text" name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Descripción') }}" value="{{ old('description', isset($record) ? $record->description : '') }}" autofocus>
                                      @include('alerts.feedback', ['field' => 'description'])
                                    </div>
                                  </div>
                                </div>
                                <h1 class="text-center">{{ __('Permisos') }}</h1>
                                <input type="checkbox" class="checkbox" id="checkAll">{{ __('Seleccionar todos los permisos') }}<br>
                                <div class="row">
                                @foreach($permisos as $permiso_grupo => $grupo)
                                    <div class="form-group col-12 col-md-3">
                                      <h2 class="text-center">{{ $permiso_grupo }}</h2>
                                      <div class="form-group grupo-permisos">
                                        <div class="col-12">
                                          <input type="checkbox" class="checkbox checkgroup" id="check{{ $permiso_grupo }}">{{ __('Seleccionar todo el grupo') }}
                                        </div>
                                        <div class="col-12">
                                          <label>{{ __('Acciones') }}</label>
                                        </div>
                                        @foreach($grupo as $permiso)
                                              <div class="col-12">
                                                @php $permiso_nombre = explode('-', $permiso->action);@endphp
                                                <input type="checkbox" class="checkbox" name="permisos[{{$permiso->id}}]" value="true"
                                                @if(isset($role_permissions))
                                                  {{ in_array($permiso->id, $role_permissions) ? 'checked' : '' }}
                                                @else
                                                  {{ old('permisos[$permiso->id]') ? 'checked' : ''}}
                                                @endif
                                                >{{ __($permiso_nombre[0]) }} {{ __($permiso_nombre[1]) }}
                                            </div>
                                        @endforeach
                                      </div>
                                    </div>
                                @endforeach
                                </div>
                          <div class="form-group col-12">
                            @if($method != 'show')
                            <div class="text-center">
                              <button type="submit" class="btn btn-success mt-4">{{ __('Guardar') }}</button>
                            </div>
                            @endif
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    {!!Html::script("js/catalogos/permission.js")!!}
@endsection