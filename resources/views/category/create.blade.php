@extends('layouts.panel', [
    'button' => false,
])

@section('title')
    Crear Categoría | Panel | Armentia Propiedades
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/category/create.css') }}">
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
    <li id="categoria" class="tab-content opened">
        <section class="grid gap-4">
            <header class="title mx-4">
                <h1 class="MontereyFLF">Categoría</h3>
            </header>

            <main class="content-form pb-4 mx-4">
                <form action="/categories/create" method="post">
                    @csrf

                    @method("POST")

                    <main class="grid gap-4">
                        <section class="input-group grid gap-4">
                            <label for="category-name" class="input-name Work-Sans">Nombre:</label>

                            <input class="form-input input-field" type="text" name="name" id="category-name" placeholder="Example" value="{{ old('name') }}">
                            
                            <span class="Work-Sans support support-box support-name {{ !$errors->has("name") ? "hidden" : "visible" }}">
                                @if($errors->has("name"))
                                    {{ $errors->first("name") }}
                                @endif
                            </span>
                        </section>

                        <section class="text-center xl:text-right">
                            <button type="submit" class="form-submit category-form btn btn-background btn-red py-2 px-4">
                                <span>Confirmar</span>
                            </button>
                        </section>
                    </main>
                </form>
            </section>
        </section>
    </li>
@endsection

@section('js')
    <script>
        const validation = [{
            categories: @json(\App\Models\Category::$validation),
        }];
    </script>

    <script type="module" src="{{ asset('js/category/create.js') }}"></script>
@endsection