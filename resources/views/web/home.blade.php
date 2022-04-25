@extends("layouts.default", [
    "name" => "home",
])

@section("title")
    Armentia Propiedades | En los negocios no se consigue lo que se merece, se consigue lo que se negocia. Negocie con nosotros.
@endsection

@section("css")
    <link rel="stylesheet" href="{{ asset("css/web/home.css") }}">
@endsection

@section("nav")
    @component("components.nav.global")@endcomponent
@endsection

@section("main")
    @component("components.banner.title", [
        "title" => "¿Qué buscas?",
        "description" => "En los negocios no se consigue lo que se merece, se consigue lo que se negocia. Negocie con nosotros.",
        "image" => "/img/resources/banner/01-title.jpg",
    ])@endcomponent

    @component("components.location.favorites", [
        "locations" => $locations,
    ])@endcomponent
@endsection

@section("footer")
    @component("components.footer.global")@endcomponent
@endsection

@section("js")
    @if (config('app.env') != 'local')
        {!! NoCaptcha::renderJs() !!}
    @endif

    <script>
        const validation = [{
            mail: @json(\App\Models\Mail::$validation),
        }];
    </script>

    <script type="module" src="{{ asset("js/web/home.js") }}"></script>
@endsection