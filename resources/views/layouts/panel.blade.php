@extends("layouts.index")

@section("head")
    {{-- Layout CSS --}}
    <link href={{ asset("css/layouts/panel.css") }} rel="stylesheet">

    {{-- Section CSS --}}
    @yield("css")

    <title>@yield("title")</title>
@endsection

@section("body")
    <main id="tab-panel" class="tab-menu vertical relative grid">
        <section class="tabs background bg-one mb-4 mb-md-0">
            <a href="/inicio" class="tab-header logo">
                <picture>
                    <source srcset="{{asset("img/resources/logo/01-regular_white.png")}}"
                        media="(min-width: 768px)"/>
                    <img src="{{asset("img/resources/logo/03-small_white.png")}}" 
                        alt="Armentia Propiedades Logo"/>
                </picture>
                <h1 class="mb-0">Armentia Propiedades</h1>
            </a>
            
            <ul class="tab-menu-list mb-0 mt-md-3">
                @yield("menu")
            </ul>
            
            <footer class="tab-footer d-flex justify-content-center">
                <a href="/cerrar-sesion" class="btn btn-uno btn-small p-md-3">
                    <i class="link-icon left fas fa-sign-out-alt"></i>
                    <span class="link-text">Cerrar Sesión</span>
                </a>
            </footer>
        </section>

        <section class="tab-content-list mx-auto">
            @yield("content")
        </section>
    </main>
@endsection

@section("extras")
    {{-- Layout CSS --}}
    <script src={{ asset("js/layouts/panel.js") }}></script>

    {{-- Section JS --}}
    @yield("js")
@endsection