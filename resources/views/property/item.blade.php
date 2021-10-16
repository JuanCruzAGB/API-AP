@extends("layouts.property", [
    "name" => "item",
])

@section("title")
    {{ $property->name }} | Armentia Propiedades
@endsection

@section("css")
    <link rel="stylesheet" href="{{asset("css/property/item.css")}}">
@endsection

@section("nav")
    @component("components.nav.global")
    @endcomponent
@endsection

@section("main")
    <section id="property" class="property grid gap-4">
        <header class="title mx-4 mt-8 xl:mx-0">
            <h2 class="MontereyFLF mb-0">{{ $property->name }}</h2>
        </header>
        <main class="grid gap-4">
            <section id="gallery-item" class="gallery vertical">
                <nav class="gallery-menu-list">
                    <ul>
                        @foreach ($property->files as $key => $image)
                            <li>
                                @if ($key == 0)
                                    <button class="gallery-item gallery-button active">
                                @else
                                    <button class="gallery-item gallery-button">
                                @endif
                                    <img src="{{ asset("storage/$image") }}" alt="{{ $property->name }} - Image {{ $key }}">
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </nav>
                <img class="gallery-item gallery-image md:mr-4 xl:mr-0" src="{{ asset("storage/" . $property->files[0]) }}" alt="{{ $property->name }} - Image selected">
            </section>
            <section class="details px-4 xl:px-0">
                <header class="header mb-3">
                    <h3 class="h5 text-left MontereyFLF mb-0 mt-4 mt-md-0">
                        <span class="category color-red">{{ $property->category->name }}</span>
                        <br>
                        <span class="location color-grey">{{ $property->location->name }}</span>
                    </h3>
                </header>
                <main>
                    <p class="description">{!! $property->description !!}</p>
                </main>
            </section>
        </div>
    </section>
@endsection

@section("footer")
    @component("components.footer.property", [
        "property" => $property,
    ])
    @endcomponent
@endsection

@section("js")
    <script>
        const validation = @json($validation);
    </script>
    <script type="module" src="{{asset("js/property/item.js")}}"></script>
@endsection