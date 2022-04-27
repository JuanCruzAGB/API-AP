@extends("layouts.index")

@section("head")
    {{-- Layout CSS --}}
    <link rel="stylesheet" href="{{ asset('css/layouts/panel.css') }}">

    {{-- Section CSS --}}
    @yield("css")

    <title>@yield("title")</title>
@endsection

@section("body")
    <main id="panel-tab-menu" class="tab-menu vertical">
        <header class="tab-header md:hidden">
            <a href="#panel-sidebar" class="sidebar-button panel-sidebar open left">
                <i class="fas fa-bars"></i>
            </a>

            <a href="/home">
                <picture>
                    <source srcset="{{ asset('img/resources/logo/02-regular-white.png') }}"
                        media="(min-width: 768px)"/>

                    <img src="{{ asset('img/resources/logo/04-small-white.png') }}" 
                        alt="Armentia Propiedades Logo"/>
                </picture>

                <h1 class="hidden">Armentia Propiedades</h1>
            </a>
        </header>

        <section id="panel-sidebar" class="tabs sidebar left">
            <main class="tab-body sidebar-body">
                <header class="tab-header sidebar-header">
                    <a href="/home" class="sidebar-title">
                        <picture>
                            <source srcset="{{ asset('img/resources/logo/02-regular-white.png') }}"
                                media="(min-width: 768px)"/>
                                
                            <img src="{{ asset('img/resources/logo/04-small-white.png') }}" 
                                alt="Armentia Propiedades Logo"/>
                        </picture>

                        <h2 class="hidden">Armentia Propiedades</h2>
                    </a>

                    <a href="#_" class="sidebar-button panel-sidebar close left hidden">
                        <span>Close</span>
                    </a>
                </header>
                
                <section class="tab-content sidebar-content">
                    <ul class="tab-menu-list sidebar-menu-list">
                        @yield("tab-menu-list")

                        <li class="tab">
                            <a href="/logout" class="tab-button sidebar-link Work-Sans">
                                <span>Cerrar Sesión</span>
                            </a>
                        </li>
                    </ul>
                    
                    @if ($button)
                        <aside class="panel floating-menu bottom right">
                            <a href="/{{ $section }}/create" title="Agregar" class="tab panel-tab-menu tab-button add-data floating-button btn btn-red btn-background round">
                                <i class="fas fa-plus"></i>
                            </a>
                        </aside>
                    @endif
                </section>
            </main>
        </section>

        <section class="tab-content-list">
            <ul class="list py-8 lg:py-20 overflow-x-hidden">
                @yield("tab-content-list")
            </ul>
        </section>
    </main>
@endsection

@section("extras")
    {{-- Layout CSS --}}
    <script type="module" src="{{ asset('js/layouts/panel.js') }}"></script>

    {{-- Section JS --}}
    @yield("js")
@endsection