<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="{{ asset('/js/jquery.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}"/>
        <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/js/custom.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('/css/custom.css') }}"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


        <title>BugHunter | @stack('title')</title>
        <style>
            @stack('style')
        </style>
    </head>
    <body style="margin:0px;">

        {{-- project new include --}}
        @include('project/new')

        {{-- Add new-item include --}}
        @include('component/new-item')

        @yield('content')
    </body>
</html>
