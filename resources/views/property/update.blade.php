@extends('layouts.panel', [
    'button' => false,
])

@section('title')
    {{ $property->name }} | Panel | Armentia Propiedades
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/property/update.css') }}">
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
    <li id="propiedad" class="item tab-content opened">
        <section class="grid gap-4">
            <header class="title flex items-end justify-between mx-4">
                <h1 class="MontereyFLF">
                    <a href="/properties/{{ $property->slug }}/details" target="_blank" class="btn btn-text btn-black">
                        <span>{{ $property->name }}</span>
                    </a>
                </h1>

                <section class="actions flex gap-4 pb-1">
                    <a href="/properties/{{ $property->slug }}/folder" class="btn btn-icon btn-red p-2" title="Actualizar">
                        <i class="fas fa-folder"></i>
                    </a>

                    <form action="/properties/{{ $property->slug }}/delete" method="post">
                        @csrf

                        @method("DELETE")

                        <main class="flex gap-4">
                            <section class="input-group grid gap-2">
                                <input type="text" class="form-input input-field" name="message" placeholder='Escribí "BORRAR"' value="{{ old('message') }}">
                            </section>

                            <section>
                                <button type="submit" class="form-submit property-form btn btn-icon-bg btn-red btn-delete p-2" title="Confirmar">
                                    <i class="fas fa-check"></i>
                                </button>
                            </section>
                        </main>
                    </form>
                </section>
            </header>

            <main class="content-form pb-4 mx-4">
                <form action="/properties/{{ $property->slug }}/update" method="post" enctype="multipart/form-data">
                    @csrf

                    @method("PUT")

                    <main class="grid lg:grid-cols-2 gap-4">
                        <section class="input-group grid lg:col-span-2 gap-4">
                            <label for="property-name" class="input-name Work-Sans">Nombre:</label>

                            <input class="form-input input-field" type="text" name="name" id="property-name" placeholder="Example" value="{{ old('name', $property->name) }}">
                            
                            <span class="Work-Sans support support-box support-name {{ !$errors->has("name") ? "hidden" : "visible" }}">
                                @if($errors->has("name"))
                                    {{ $errors->first("name") }}
                                @endif
                            </span>
                        </section>

                        <section class="input-group grid lg:col-span-2 gap-4">
                            <label for="property-description" class="input-name Work-Sans">Descripción:</label>

                            <textarea class="form-input input-field" name="description" id="property-description" cols="30" rows="10" placeholder="Example">{{ old("description", $property->description) }}</textarea>

                            <span class="Work-Sans support support-box support-description {{ !$errors->has("description") ? "hidden" : "visible" }}">
                                @if($errors->has("description"))
                                    {{ $errors->first("description") }}
                                @endif
                            </span>
                        </section>

                        <section class="input-group grid gap-4">
                            <label for="property-id_category" class="input-name Work-Sans">Categoría:</label>

                            <select class="form-input input-field" name="id_category" id="property-id_category">
                                <option selected disabled>Elegir categoría</option>

                                @foreach ($categories as $category)
                                    <option @if (old('id_category', $property->id_category) == $category->id_category) selected @endif value="{{ $category->id_category }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                            <span class="Work-Sans support support-box support-id_category {{ !$errors->has("id_category") ? "hidden" : "visible" }}">
                                @if($errors->has("id_category"))
                                    {{ $errors->first("id_category") }}
                                @endif
                            </span>
                        </section>

                        <section class="input-group grid gap-4">
                            <label for="property-id_location" class="input-name Work-Sans">Ubicación:</label>

                            <select class="form-input input-field" name="id_location" id="property-id_location">
                                <option selected disabled>Elegir ubicación</option>

                                @foreach ($locations as $location)
                                    <option @if (old('id_location', $property->id_location) == $location->id_location) selected @endif value="{{ $location->id_location }}">{{ $location->name }}</option>
                                @endforeach
                            </select>

                            <span class="Work-Sans support support-box support-id_location {{ !$errors->has("id_location") ? "hidden" : "visible" }}">
                                @if($errors->has("id_location"))
                                    {{ $errors->first("id_location") }}
                                @endif
                            </span>
                        </section>

                        <section class="text-center xl:text-right lg:col-start-2">
                            <button type="submit" class="form-submit property-form btn btn-background btn-red py-2 px-4">
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
            properties: @json(\App\Models\Property::$validation),
        }];
    </script>

    <script type="module" src="{{ asset('js/property/update.js') }}"></script>
@endsection