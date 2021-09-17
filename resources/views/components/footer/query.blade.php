<section class="contact col-12">
    <div class="row">
        <div class="form col-12 col-md-5 col-xl-6 p-5">
            <header class="pb-3 pt-md-3">
                <h2 class="h4 mb-0 text-center MontereyFLF">Consulta acerca de {{ $property->name }}</h2>
            </header>
            @component('components.forms.query', [
                'property' => $property
            ])
            @endcomponent
        </div>
        <div class="personal-data col-12 col-md-7 col-xl-6 p-5">
            <header class="py-3">
                <h3 class="h5 mb-0 text-center MontereyFLF">
                    <span class="color-red">Información</span> 
                    <span class="color-grey">de contacto</span>
                </h3>
            </header>
            <main class="p-3">
                <ul class="row mb-0 px-3">
                    <li class="col-12 p-0 pb-3">
                        <span>Juan Manuel Armentia</span>
                    </li>
                    <li class="col-12 p-0 py-3">
                        <span>Pedro N. Carrera 961</span>
                    </li>
                    <li class="col-12 p-0 py-3">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:jmarmentia2010@hotmail.com">jmarmentia2010@hotmail.com</a>
                    </li>
                    <li class="col-12 p-0 pt-3">
                        <i class="fab fa-whatsapp"></i>
                        <a href="#">+54 9 2983649476</a>
                    </li>
                </ul>
            </main>
        </div>
    </div>
</section>