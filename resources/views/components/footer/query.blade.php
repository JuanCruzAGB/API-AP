<section id="query" class="contact">
    <main class="grid md:grid-cols-2 gap-4">
        <section class="form grid gap-4 p-4 py-8 xl:ml-32">
            <header>
                <h2 class="text-center MontereyFLF">Consulta acerca de <span class="color-red">{{ $property->name }}</span></h2>
            </header>

            @component('components.forms.query', [
                'property' => $property
            ])@endcomponent
        </section>
        
        @component('components.footer.personal_data')@endcomponent
    </main>
</section>