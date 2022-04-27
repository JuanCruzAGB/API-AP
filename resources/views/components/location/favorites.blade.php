<section id="favorites" class="favorites">
    <main>
        @if (count($locations))
            <ul class="locations grid gap-4">
                @foreach ($locations as $location)
                    <li class="location grid gap-4">
                        <header class="title mx-4 xl:mx-32 pb-2">
                            <a href="/properties?ubicaciones={{ $location->slug }}" class="flex items-center">
                                <i class="fas fa-angle-right"></i>

                                <h2 class="MontereyFLF">{{ $location->name }}</h2>
                            </a>
                        </header>

                        @component("components.property.list", [
                            "properties" => $location->favorite_properties,
                        ])@endcomponent
                    </li>
                @endforeach
            </ul>
        @else
            <ul class="locations grid gap-4">
                <li class="location">
                    <header class="title">
                        <h2 class="MontereyFLF">No hay ubicaciones recomendadas</h2>
                    </header>
                </li>
            </ul>
        @endif
    </main>
</section>