<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>E-notice - @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A premium admin dashboard template by mannatthemes" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @include('layouts.styles')

    </head>
    <body class="account-body">
        @if (Route::currentRouteName() != 'auth.index')
           @include('partials.topbar')
        @endif
        @yield('content')
        @include('layouts.scripts')
    </body>
</html>
