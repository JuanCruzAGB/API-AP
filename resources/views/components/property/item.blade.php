@if (count($properties))
    @foreach ($properties as $property)
        <li class="property card">
            <a href="/properties/{{ $property->slug }}/details" class="card-body grid">
                <figure class="card-image">
                    <img src="{{ $property->files && count($property->files) ? asset('storage/' . $property->files[0]) : asset('img/resources/sample.png') }}" alt="{{ $property->name }}">
                </figure>

                <header class="card-title p-4 Work-Sans color-white bg-red">
                    @if (array_search(Route::current()->getName(), ['web.index', 'web.home']))
                        <h3 class="text-center">{{ $property->name }}</h3>
                    @endif

                    @if (Route::current()->getName() == 'property.list')
                        <h2 class="text-center">{{ $property->name }}</h2>
                    @endif
                </header>

                <div class="card-icon color-red">
                    <i class="fas fa-sign-in-alt"></i>
                </div>
            </a>
        </li>
    @endforeach
@else
    <li class="property card">
        <span>No contamos con propiedades aún</span>
    </li>
@endif