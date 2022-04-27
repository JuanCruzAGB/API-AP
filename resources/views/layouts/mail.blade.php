@extends('layouts.index')

@section('head')
    {{-- Layout CSS --}}
    <link href={{ asset('css/layouts/mail.css') }} rel="stylesheet">

    {{-- Section CSS --}}
    @yield('css')

    <title>@yield('title')</title>
@endsection

@section('body')
    <header class="header">
        @yield('nav')
    </header>

    <aside class="notification hidden"></aside>
            
    <main class="main container-fluid">
        <div class="row">
            @yield('main')
        </div>
    </main>

    <footer class="footer"> 
        @yield('footer')
    </footer>
        
    @component('components.floating.whatsapp')@endcomponent
@endsection

@section('extras')
    {{-- Layout CSS --}}
    <script src={{ asset('js/layouts/mail.js') }}></script>

    {{-- Section JS --}}
    @yield('js')
@endsection