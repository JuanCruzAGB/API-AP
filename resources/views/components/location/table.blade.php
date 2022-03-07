<li id="ubicaciones" class="tab-content">
    <main class="grid gap-4">
        <header class="title mx-4">
            <h3 class="MontereyFLF">Ubicaciones</h3>
        </header>
        <section class="content-table pb-4">
            <div class="px-4">
                <table class="table grid gap-4">
                    <thead>
                        <tr class="flex gap-4 md:grid md:grid-cols-8 bg-red color-white text-center">
                            <th class="id py-2 color-grey"></th>
                            <th class="py-2 md:col-span-4 MontereyFLF">Nombre</th>
                            <th class="updated_at py-2 md:col-span-2 MontereyFLF">Última vez actualizada</th>
                            <th class="actions py-2"></th>
                        </tr>
                    </thead>
                    <tbody class="flex flex-wrap gap-4">
                        @foreach ($locations as $location)
                            <tr class="flex gap-4 md:grid md:grid-cols-8">
                                <td class="id color-grey Work-Sans">{{ $location->id_location }}</td>
                                <td class="md:col-span-4 Work-Sans">
                                    <p>{{ $location->name }}</p>
                                </td>
                                <td class="updated_at md:col-span-2 Work-Sans">{{ $location->updated_at->format('d/m/Y') }}</td>
                                <td class="actions">
                                    <a href="#" class="btn btn-icon btn-red p-2" title="Favorita">
                                        @if ($location->favorite)
                                            <i class="fas fa-star"></i>
                                        @endif
                                        @if (!$location->favorite)
                                            <i class="far fa-star"></i>
                                        @endif
                                    </a>
                                    <a href="#ubicacion?slug={{ $location->slug }}" class="tab panel-tab-menu tab-button btn btn-icon btn-red p-2" title="Actualizar">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</li>