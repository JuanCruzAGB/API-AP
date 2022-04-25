@extends("layouts.property", [
    "name" => "list",
])

@section("title")
    Propiedades | Armentia Propiedades
@endsection

@section("css")
    <meta name="asset" content="{{ asset("storage") }}">
    
    <link rel="stylesheet" href="{{ asset("css/property/list.css") }}">
@endsection

@section("nav")
    @component("components.nav.filter", [
        "categories" => $categories,
        "locations" => $locations,
    ])@endcomponent
@endsection

@section("main")
    @component("components.property.list", [
        "properties" => $properties,
    ])@endcomponent
@endsection

@section("footer")
    @component("components.footer.properties")@endcomponent
@endsection

@section("js")
    <script>
        const properties = @json($properties);
    </script>

    <script type="module" src="{{ asset("js/property/list.js") }}"></script>
@endsection