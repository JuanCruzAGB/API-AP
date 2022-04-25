@extends('layouts.index')

@section("head")
    {{-- Section CSS --}}
    <link rel="stylesheet" href="{{ asset('css/web/dashboard.css') }}">

    <title>Dashboard | Armentia Propiedades</title>
@endsection

@section('body')
    <header class="header">
        @component("components.nav.dashboard")@endcomponent
    </header>
            
    <main id="dashboard" class="px-4">
        @component('components.panel.shortcuts')@endcomponent

        @component('components.panel.stadistics')@endcomponent
    </main>

    <footer class="footer mt-8"> 
        {{--  --}}
    </footer>
@endsection

@section('js')
    <script type="module" src="{{ asset('js/web/dashboard.js') }}"></script>
@endsection