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
                        @if(auth()->user()->hasPermission('Agregar-'.$permission))
                        <div class="col-4 text-right">
                            <a href="{{ url('permission/create') }}" class="btn btn-sm btn-primary">{{ __('Agregar rol') }}</a>
                        </div>
                        @endif
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