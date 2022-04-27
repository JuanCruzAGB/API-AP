@extends('layouts.default')

@section('title')
    Proximamente
@endsection

@section('css')
    <link href={{ asset('css/web/coming_soon.css') }} rel="stylesheet">
@endsection

@section('main')
    <section class='col-12'>
        <header class="mb-2">
            <h1 class="mb-0 no-text">
                <img src="{{asset('img/resources/logo/01-regular.png')}}" alt="Armentia Propiedades Logo">

                <span>ArmentiaPropiedades</span>
            </h1>
        </header>

        <main class="mt-2">
            <p>Proximamente</p>
            <div class="social-media">
                <ul>
                    <li>
                        <a href="https://www.facebook.com/ArmentiaPropiedades/" target="_blank">
                            <i class="social-icon mr-2 fab fa-facebook-square"></i>

                            <span>/<span class="initial">A</span>rmentia<span class="initial">P</span>ropiedades</span>
                        </a>
                    </li>

                    <li>
                        <a href="https://www.instagram.com/armentiapropiedades/" target="_blank">
                            <i class="social-icon mr-2 fab fa-instagram"></i>
                            
                            <span>@armentiapropiedades</span>
                        </a>
                    </li>
                </ul>
            </div>
        </main>
    </section>
@endsection

@section('js')
    <script src={{ asset('js/web/coming_soon.js') }}></script>
@endsection