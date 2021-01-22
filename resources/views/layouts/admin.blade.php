<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @stack('styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="py-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <x-card>
                    <x-slot name="header">@yield('header')</x-slot>
                    <x-error-message :errors="$errors" />
                    <x-message />
                    @yield('content')
                    <x-slot name="footer">@yield('buttons')</x-slot>
                </x-card>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    @stack('scripts')
</body>
</html>