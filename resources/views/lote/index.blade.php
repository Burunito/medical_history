@extends('layouts.app', ['page' => __('Lotes'), 'pageSlug' => 'lotes'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('Lotes') }}</h4>
                        </div>
                        @if(auth()->user()->hasPermission('Agregar-'.$permission))
                        <div class="col-4 text-right">
                            <a href="{{ url('/lote/create') }}" class="btn btn-sm btn-primary">{{ __('Agregar lote') }}</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table datatable" id="lote-table"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    {!!Html::script("js/catalogos/lote.js")!!}
@endsection