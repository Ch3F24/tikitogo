@extends('layouts.app')

@section('body')
    @include('partials.nav', ['subpage' => 'index'])

    <!-- Page Heading -->
    @yield('header')

    @yield('topics-bar')

    <!-- Page Content -->
{{--    <main id="app" class="w-full xl:container px-5 lg:px-14 mx-auto relative">--}}
    <main id="app" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative my-8 lg:container">
        @yield('content')
    </main>
    @include('partials.footer')

    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        // Create BP element on the window
        window["bp"] = window["bp"] || function () {
            (window["bp"].q = window["bp"].q || []).push(arguments);
        };
        window["bp"].l = 1 * new Date();

        // Insert a script tag on the top of the head to load bp.js
        scriptElement = document.createElement("script");
        firstScript = document.getElementsByTagName("script")[0];
        scriptElement.async = true;
        scriptElement.src = 'https://pixel.barion.com/bp.js';
        firstScript.parentNode.insertBefore(scriptElement, firstScript);
        window['barion_pixel_id'] = 'BP-cx3GPs0mIA-3F';

        // Send init event
        bp('init', 'addBarionPixelId', window['barion_pixel_id']);
    </script>

    <noscript>
        <img height="1" width="1" style="display:none" alt="Barion Pixel" src="https://pixel.barion.com/a.gif?ba_pixel_id='BP-cx3GPs0mIA-3F'&ev=contentView&noscript=1">
    </noscript>

@endsection
