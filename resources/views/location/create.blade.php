@extends('layouts.panel', [
    'button' => false,
])

@section('title')
    Crear Ubicación | Panel | Armentia Propiedades
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/location/create.css') }}">
@endsection

@section('tab-menu-list')
    <li id="tab-categorias" class="tab panel-tab-menu">
        <a href="/categories/table" class="tab-link sidebar-link Work-Sans">
            <span>Categorías</span>
        </a>
    </li>

    <li id="tab-propiedades" class="tab panel-tab-menu">
        <a href="/properties/table" class="tab-link sidebar-link Work-Sans">
            <span>Propiedades</span>
        </a>
    </li>

    <li id="tab-ubicaciones" class="tab panel-tab-menu">
        <a href="/locations/table" class="tab-link sidebar-link Work-Sans">
            <span>Ubicaciónes</span>
        </a>
    </li>
@endsection

@section('tab-content-list')
    <li id="ubicacion" class="tab-content opened">
        <section class="grid gap-4">
            <header class="title mx-4">
                <h2 class="MontereyFLF">Ubicación</h2>
            </header>

            <main class="content-form pb-4 mx-4">
                <form action="/locations/create" method="post">
                    @csrf

                    @method("POST")

                    <main class="grid gap-4">
                        <section class="input-group grid gap-4">
                            <label for="locations-name" class="input-name Work-Sans">Nombre:</label>

                            <input class="form-input input-field" type="text" name="name" id="location-name" placeholder="Example" value="{{ old('name') }}">
                            
                            <span class="Work-Sans support support-box support-name {{ !$errors->has("name") ? "hidden" : "visible" }}">
                                @if($errors->has("name"))
                                    {{ $errors->first("name") }}
                                @endif
                            </span>
                        </section>

                        <section class="text-center xl:text-right">
                            <button type="submit" class="form-submit location-form btn btn-background btn-red py-2 px-4">
                                <span>Confirmar</span>
                            </button>
                        </section>
                    </main>
                </form>
            </main>
        </section>
    </li>
@endsection

@section('js')
    <script>
        const validation = [{
            locations: @json(\App\Models\Location::$validation),
        }];
    </script>

    <script type="module" src="{{ asset('js/location/create.js') }}"></script>
@endsection