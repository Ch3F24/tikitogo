<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
{{--        @include('partials.meta')--}}
{{--        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">--}}
{{--        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">--}}
{{--        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">--}}

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
{{--        <script src="{{ mix('js/app.js') }}" defer></script>--}}
{{--        <script src="{{ mix('js/nav.js') }}" defer></script>--}}
{{--        <script src="//unpkg.com/alpinejs" defer></script>--}}
    @if(\Illuminate\Support\Facades\App::environment('production'))
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-XWMSBLNS3H"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-XWMSBLNS3H');
        </script>
    @endif
    </head>
    <body class="min-h-screen flex flex-col">
        @yield('body')
    </body>
</html>
