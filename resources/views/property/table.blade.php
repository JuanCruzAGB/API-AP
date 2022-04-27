@extends('layouts.panel', [
    'button' => true,
    'section' => 'properties',
])

@section('title')
    Propiedades | Panel | Armentia Propiedades
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/property/table.css') }}">
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
    <li id="propiedades" class="tab-content opened">
        <section class="grid gap-4">
            <header class="title mx-4">
                <h2 class="MontereyFLF">Propiedades</h2>
            </header>

            <main class="content-table pb-4">
                <section class="px-4">
                    <table class="table grid gap-4">
                        <thead class="pr-4 md:pr-0">
                            <tr class="flex gap-4 md:grid md:grid-cols-10 bg-red color-white text-center">
                                <th class="id py-2 color-grey"></th>

                                <th class="py-2 md:col-span-2 MontereyFLF">Nombre</th>

                                <th class="py-2 md:col-span-2 MontereyFLF">Categoría</th>

                                <th class="py-2 md:col-span-2 MontereyFLF">Ubicación</th>

                                <th class="updated_at py-2 MontereyFLF">Última vez actualizada</th>

                                <th class="actions py-2 md:col-span-2"></th>
                            </tr>
                        </thead>

                        <tbody class="flex flex-wrap gap-4 pr-4 md:pr-0">
                            @foreach ($properties as $property)
                                <tr class="flex gap-4 md:grid md:grid-cols-10">
                                    <td class="id color-grey Work-Sans">{{ $property->id_property }}</td>

                                    <td class="md:col-span-2 Work-Sans">
                                        <p>{{ $property->name }}</p>
                                    </td>

                                    <td class="md:col-span-2 Work-Sans">
                                        <p>
                                            @foreach ($property->categories as $category)
                                                {{ $category->name . " " }}
                                            @endforeach
                                        </p>
                                    </td>

                                    <td class="md:col-span-2 Work-Sans">
                                        <p>{{ $property->id_location ? $property->location->name : "" }}</p>
                                    </td>

                                    <td class="updated_at Work-Sans">{{ $property->updated_at->format('d/m/Y') }}</td>
                                    
                                    <td class="actions md:col-span-2">
                                        <a href="#" class="btn btn-icon btn-red p-2" title="Favorita">
                                            <i class="{{ $property->favorite ? "fas" : "far" }} fa-star"></i>
                                        </a>

                                        <a href="/properties/{{ $property->slug }}/folder" class="tab panel-tab-menu tab-button btn btn-icon btn-red p-2" title="Actualizar">
                                            <i class="fas fa-folder"></i>
                                        </a>

                                        <a href="/properties/{{ $property->slug }}/update" class="tab panel-tab-menu tab-button btn btn-icon btn-red p-2" title="Actualizar">
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
        const properties = @json($properties);
    </script>

    <script type="module" src="{{ asset('js/property/table.js') }}"></script>
@endsection