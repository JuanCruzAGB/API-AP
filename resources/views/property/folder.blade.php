@extends('layouts.panel', [
    'button' => false,
])

@section('title')
    Imágenes | {{ $property->name }} | Propiedades | Panel | Armentia Propiedades
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/property/folder.css') }}">
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
                <h2 class="MontereyFLF">{{ $property->name }} | Imágenes</h2>
            </header>

            <main class="content-form pb-4 mx-4">
                <form action="/properties/{{ $property->slug }}/folder/update" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    
                    @csrf

                    <main class="grid gap-4">
                        <section class="input-group grid grid-cols-3 lg:col-span-2 gap-4">
                            <input class="form-input input-field col-span-2" type="file" name="files[]" id="property-files" multiple>
                            
                            <button type="submit" class="form-submit property-form btn btn-background btn-red py-2 px-4">
                                <span>Confirmar</span>
                            </button>
                            
                            <span class="Work-Sans support support-box support-files col-span-2 {{ !($errors->has("files") || $errors->has("files.*")) ? "hidden" : "visible" }}">
                                @if($errors->has("files") || $errors->has("files.*"))
                                    {{ $errors->first("files") }}
                                @endif
                            </span>
                        </section>

                        <ul class="files grid md:grid-cols-2 xl:grid-cols-3 col-span-2 gap-4">
                            @if ($property->files)
                                @foreach ($property->files as $key => $file)
                                    <li class="file">
                                        <figure>
                                            <img src='{{ asset("storage/$file") }}' alt="{{ $property->name }} image">
                                        </figure>
                                        <label>
                                            <input type="checkbox" name="list[{{ $key }}]">
                                            <span class="btn btn-icon p-2" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </label>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </main>
                </form>
            </main>
        </section>
    </li>
@endsection

@section('js')
    <script>
        const property = @json($property);
    </script>

    <script type="module" src="{{ asset('js/property/folder.js') }}"></script>
@endsection