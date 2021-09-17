@extends("layouts.index")

@section("head")
    {{-- Layout CSS --}}
    {{-- <link href={{ asset("css/layouts/default.css") }} rel="stylesheet"> --}}

    {{-- Section CSS --}}
    @yield("css")

    <title>@yield("title")</title>
@endsection

@section("body")
    <header class="header">
        @yield("nav")
    </header>
            
    <main class="main grid gap-8">
        @yield("main")
    </main>

    <footer class="footer"> 
        @yield("footer")
    </footer>

    <aside class="aside">
        @component("components.floating.whatsapp")
        @endcomponent
    </aside>
@endsection

@section("extras")
    {{-- Layout CSS --}}
    {{-- <script src={{ asset("js/layouts/default.js") }}></script> --}}

    {{-- Section JS --}}
    @yield("js")
@endsection