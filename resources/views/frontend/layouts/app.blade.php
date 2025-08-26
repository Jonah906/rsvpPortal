<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="RSVP Booking">
        <meta name="keywords" content="Sona, unica, creative, html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RSVP Bookings</title>
        <link rel="shortcut icon" href="{{ asset('welcome/assets/img/free.jpg') }}">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

        <!-- Css Styles -->
        @include('frontend.layouts.styles')
  
        @yield('styles')
    </head>

    <body>

        @include('frontend.partials.topmenu')
        @include('frontend.partials.header')

        @yield('content')

        @include('frontend.partials.footer')
        @yield('scripts')
    </body>
</html>