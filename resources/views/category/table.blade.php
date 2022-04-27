@extends('layouts.panel', [
    'button' => true,
    'section' => 'categories',
])

@section('title')
    Categorías | Panel | Armentia Propiedades
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/category/table.css') }}">
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
    <li id="categorias" class="tab-content opened">
        <section class="grid gap-4">
            <header class="title mx-4">
                <h2 class="MontereyFLF">Categorías</h2>
            </header>

            <main class="content-table pb-4">
                <section class="px-4">
                    <table class="table grid gap-4">
                        <thead class="pr-4 md:pr-0">
                            <tr class="flex gap-4 md:grid md:grid-cols-8 bg-red color-white text-center">
                                <th class="id py-2 color-grey"></th>

                                <th class="py-2 md:col-span-4 MontereyFLF">Nombre</th>

                                <th class="updated_at py-2 md:col-span-2 MontereyFLF">Última vez actualizada</th>

                                <th class="actions py-2"></th>
                            </tr>
                        </thead>

                        <tbody class="flex flex-wrap gap-4 pr-4 md:pr-0">
                            @foreach ($categories as $category)
                                <tr class="flex gap-4 md:grid md:grid-cols-8">
                                    <td class="id color-grey Work-Sans">{{ $category->id_category }}</td>
                                    
                                    <td class="md:col-span-4 Work-Sans">
                                        <p>{{ $category->name }}</p>
                                    </td>

                                    <td class="updated_at md:col-span-2 Work-Sans">{{ $category->updated_at->format('d/m/Y') }}</td>

                                    <td class="actions">
                                        <a href="/categories/{{ $category->slug }}/update" class="tab panel-tab-menu tab-button btn btn-icon btn-red p-2" title="Actualizar">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </main>
        </section>
    </li>
@endsection

@section('js')
    <script>
        const categories = @json($categories);
    </script>

    <script type="module" src="{{ asset('js/category/table.js') }}"></script>
@endsection