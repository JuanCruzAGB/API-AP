@extends('layouts.mail')

@section('title')
    ¡Gracias por contactarse!
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mail/thanks.css') }}">
@endsection

@section('nav')
    @component('components.nav.global')@endcomponent
@endsection

@section('main')
    <section id="banner" class="banner col-12">
        <aside class="banner-img"></aside>
        
        <div class="banner-body row">
            <header class="banner-title col-12 mb-3">
                <h2 class="MontereyFLF mb-0">¡Gracias por contactarse!</h2>
            </header>

            <main class="banner-content col-12">
                <p class="Work-Sans mb-0 text-center">Le responderemos en la brevedad</p>

                <a href="/home" class="btn btn-uno mt-3">Regresar al inicio</a>
            </main>
        </div>
    </section>
@endsection

@section('footer')
    @component('components.footer.panel')@endcomponent
@endsection

@section('js')
    <script type="module" src="{{ asset('js/mail/thanks.js') }}"></script>
@endsection