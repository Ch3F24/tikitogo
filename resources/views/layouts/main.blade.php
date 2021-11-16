@extends('layouts.app')

@section('body')
    @include('partials.nav', ['subpage' => 'index'])

    <!-- Page Heading -->
    @yield('header')

    @yield('topics-bar')

    <!-- Page Content -->
{{--    <main id="app" class="w-full xl:container px-5 lg:px-14 mx-auto relative">--}}
    <main id="app" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto relative my-8">
        @yield('content')
    </main>
    @include('partials.footer')

    <script src="{{ mix('js/app.js') }}"></script>
@endsection
