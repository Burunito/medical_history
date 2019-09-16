<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Principal') }}</title>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('black') }}/img/apple-icon.png">
        <link rel="icon" type="image/png" href="{{ asset('black') }}/img/favicon.png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
        <link href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('black') }}/css/nucleo-icons.css" rel="stylesheet" />
        <!-- CSS -->
        <link href="{{ asset('black') }}/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
        <link href="{{ asset('black') }}/css/theme.css" rel="stylesheet" />
        <link href="{{ asset('assets/vendor/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />

    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <div class="wrapper">
                    @include('layouts.navbars.sidebar')
                <div class="main-panel">
                    @include('layouts.navbars.navbar')
                    <div class="content">
                        @yield('content')
                    </div>
                    @include('layouts.footer')
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            @include('layouts.navbars.navbar')
            <div class="wrapper wrapper-full-page">
                <div class="full-page {{ $contentClass ?? '' }}">
                    <div class="content">
                        <div class="container">
                            @yield('content')
                        </div>
                    </div>
                    @include('layouts.footer')
                </div>
            </div>
        @endauth
        <script src="{{ asset('black') }}/js/core/jquery.min.js"></script>
        <script src="{{ asset('black') }}/js/core/popper.min.js"></script>
        <script src="{{ asset('black') }}/js/core/bootstrap.min.js"></script>
        <script src="{{ asset('black') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <script src="{{ asset('black') }}/js/plugins/bootstrap-notify.js"></script>
        <script src="{{ asset('black') }}/js/black-dashboard.min.js?v=1.0.0"></script>
        <script src="{{ asset('black') }}/js/theme.js"></script>
        <script src="{{ asset('js/common/config.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/common/functions.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendor/moment/moment.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendor/DataTables/js/jquery.dataTables.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendor/DataTables/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendor/parsleyjs/parsley.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendor/parsleyjs/es.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendor/datetimepicker/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendor/select2/select2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendor/sweetalert/sweetalert2.all.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendor/filestyle2/bootstrap-filestyle.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendor/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
        @yield('js')
    </body>
</html>
