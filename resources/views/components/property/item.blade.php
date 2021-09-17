@if (count($properties))
    @foreach ($properties as $property)
        <li class="property card">
            <a href="/propiedad/{{ $property->slug }}/detalles" class="card-body grid">
                <figure class="card-image">
                    <img src="{{ asset('storage/' . $property->files[0]) }}" alt="{{ $property->name }}">
                </figure>
                <header class="card-title p-4 Work-Sans color-red">
                    <h3 class="text-center">{{ $property->name }}</h3>
                </header>
                <div class="card-icon">
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