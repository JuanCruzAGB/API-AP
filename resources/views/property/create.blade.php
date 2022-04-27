@extends('layouts.panel', [
    'button' => false,
])

@section('title')
    Crear Categoría | Panel | Armentia Propiedades
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/property/create.css') }}">
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
    <li id="propiedad" class="tab-content opened">
        <section class="grid gap-4">
            <header class="title mx-4">
                <h2 class="MontereyFLF">Propiedad</h2>
            </header>

            <main class="content-form pb-4 mx-4">
                <form action="/properties/create" method="post" enctype="multipart/form-data">
                    @csrf

                    @method('POST')

                    <main class="grid lg:grid-cols-2 gap-4">
                        <section class="input-group grid lg:col-span-2 gap-4">
                            <label for="property-name" class="input-name Work-Sans">Nombre:</label>

                            <input class="form-input input-field" type="text" name="name" id="property-name" placeholder="Example" value="{{ old('name') }}">
                            
                            <span class="Work-Sans support support-box support-name {{ !$errors->has("name") ? "hidden" : "visible" }}">
                                @if($errors->has("name"))
                                    {{ $errors->first("name") }}
                                @endif
                            </span>
                        </section>

                        <section class="input-group grid lg:col-span-2 gap-4">
                            <label for="property-files" class="input-name Work-Sans">Imágenes:</label>

                            <input class="form-input input-field" type="file" name="files[]" id="property-files" multiple>
                            
                            <span class="Work-Sans support support-box support-files {{ !($errors->has("files") || $errors->has("files.*")) ? "hidden" : "visible" }}">
                                @if($errors->has("files") || $errors->has("files.*"))
                                    {{ $errors->first("files") }}
                                @endif
                            </span>
                        </section>

                        <section class="input-group grid lg:col-span-2 gap-4">
                            <label for="property-description" class="input-name Work-Sans">Descripción:</label>

                            <textarea class="form-input input-field" name="description" id="property-description" cols="30" rows="10" placeholder="Example">{{ old("description") }}</textarea>

                            <span class="Work-Sans support support-box support-description {{ !$errors->has("description") ? "hidden" : "visible" }}">
                                @if($errors->has("description"))
                                    {{ $errors->first("description") }}
                                @endif
                            </span>
                        </section>

                        <section class="input-group grid gap-4">
                            <label for="property-categories" class="input-name Work-Sans">Categoría:</label>

                            <select class="form-input input-field" name="categories[]" id="property-categories" multiple>
                                <option disabled>Elegir categoría</option>

                                @foreach ($categories as $category)
                                    <option @if (is_array(old('categories')) && in_array($category->id_category, old('categories'))) selected @endif value="{{ $category->id_category }}">{{ $category->name }}</option>
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
                                    <option @if (old('id_location') == $location->id_location) selected @endif value="{{ $location->id_location }}">{{ $location->name }}</option>
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

    <script type="module" src="{{ asset('js/property/create.js') }}"></script>
@endsection