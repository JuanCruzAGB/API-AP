@extends("layouts.index")

@section("head")
    {{-- Layout CSS --}}
    <link href={{ asset("css/layouts/property.css") }} rel="stylesheet">

    {{-- Section CSS --}}
    @yield("css")

    <title>@yield("title")</title>
@endsection

@section("body")
    <header class="header">
        @yield("nav")
    </header>
            
    <main id="{{ $name }}" class="main grid gap-8">
        @yield("main")
    </main>

    <footer class="footer mt-8"> 
        @yield("footer")
    </footer>

    @component("components.floating.whatsapp")@endcomponent
@endsection

@section("extras")
    {{-- Layout CSS --}}
    <script type="module" src={{ asset("js/layouts/property.js") }}></script>

    {{-- Section JS --}}
    @yield("js")
@endsection