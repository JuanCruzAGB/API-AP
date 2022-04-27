@extends('layouts.panel', [
    'button' => false,
])

@section('title')
    {{ $category->name }} | Panel | Armentia Propiedades
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/category/update.css') }}">
@endsection

@section('tab-menu-list')
    <li id="tab-categorias" class="tab panel-tab-menu">
        <a href="/category/table" class="tab-link sidebar-link Work-Sans">
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
            <header class="title flex items-end justify-between mx-4">
                <h2 class="MontereyFLF">{{ $category->name }}</h2>

                <section class="actions flex gap-4 pb-1">
                    <form action="/categories/{{ $category->slug }}/delete" method="post">
                        @csrf

                        @method("DELETE")

                        <main class="flex gap-4">
                            <section class="input-group grid gap-2">
                                <input type="text" class="form-input input-field" name="message" placeholder='Escribí "BORRAR"' value="{{ old('message') }}">
                            </section>

                            <section>
                                <button type="submit" class="form-submit category-form btn btn-icon-bg btn-red btn-delete p-2" title="Confirmar">
                                    <i class="fas fa-check"></i>
                                </button>
                            </section>
                        </main>
                    </form>
                </section>
            </header>

            <main class="content-form pb-4 mx-4">
                <form action="/categories/{{ $category->slug }}/update" method="post">
                    @csrf

                    @method("PUT")

                    <main class="grid gap-4">
                        <section class="input-group grid gap-4">
                            <label for="category-name" class="input-name Work-Sans">Nombre:</label>

                            <input class="form-input input-field" type="text" name="name" id="category-name" placeholder="Example" value="{{ old('name', $category->name) }}">
                            
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
        const category = @json($category);

        const validation = [{
            categories: @json(\App\Models\Category::$validation),
        }];
    </script>

    <script type="module" src="{{ asset('js/category/update.js') }}"></script>
@endsection