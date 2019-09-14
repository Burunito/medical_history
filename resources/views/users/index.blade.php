@extends('layouts.app', ['page' => __('Administración de usuario'), 'pageSlug' => 'users'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">{{ __('Users') }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">{{ __('Agregar usuario') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table datatable" id="user-table">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    {!!Html::script("js/catalogos/user.js")!!}
@endsection