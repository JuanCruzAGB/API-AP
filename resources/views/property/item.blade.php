@extends("layouts.property", [
    "name" => "item",
])

@section("title")
    {{ $property->name }} | Armentia Propiedades
@endsection

@section("css")
    <link rel="stylesheet" href="{{ asset("css/property/item.css") }}">
@endsection

@section("nav")
    @component("components.nav.global")@endcomponent
@endsection

@section("main")
    <section id="property" class="property grid lg:grid-cols-6 gap-4">
        <header class="title lg:col-span-4 mx-4 mt-8 xl:mx-0">
            <h2 class="MontereyFLF mb-0">{{ $property->name }}</h2>
        </header>

        <main class="grid lg:col-span-6 lg:grid-cols-6 gap-4">
            <section id="gallery-item" class="gallery vertical lg:col-span-4">
                <nav class="gallery-nav">
                    <ul class="gallery-menu-list">
                        @if ($property->files && count($property->files))
                            @foreach ($property->files as $key => $image)
                                <li>
                                    <button class="gallery-item gallery-button {{ $key == 0 ? "active" : "" }}">
                                        <img src="{{ asset("storage/$image") }}" alt="{{ $property->name }} - Image {{ $key }}">
                                    </button>
                                </li>
                            @endforeach
                        @else
                            <li>
                                <button class="gallery-item gallery-button active">
                                    <img src="{{ asset('img/resources/sample.png') }}" alt="{{ $property->name }} - Sample image">
                                </button>
                            </li>
                        @endif
                    </ul>
                </nav>

                <img class="gallery-item gallery-image md:mr-4 xl:mr-0" src="{{ $property->files && count($property->files) ? asset('storage/' . $property->files[0]) : asset('img/resources/sample.png') }}" alt="{{ $property->name }} - Image selected">
            </section>

            <section class="details lg:col-span-2 px-4 xl:px-0">
                <header class="header mb-3">
                    <h3 class="h5 text-left MontereyFLF mb-0 mt-4 mt-md-0">
                        @foreach ($property->categories as $category)
                            <span class="category color-red">{{ $category->name }}</span>

                            <br>
                        @endforeach

                        @if ($property->id_location)
                            <span class="location color-grey">{{ $property->location->name }}</span>
                        @endif
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
    ])@endcomponent
@endsection

@section("js")
    <script>
        const validation = @json([
            'mail' => \App\Models\Mail::$validation,
        ]);
    </script>

    <script type="module" src="{{ asset("js/property/item.js") }}"></script>
@endsection