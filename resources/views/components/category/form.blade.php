<li id="categoria" class="tab-content">
    <main class="grid gap-4">
        <header class="title mx-4">
            <h3 class="MontereyFLF">Categoría</h3>
        </header>
        <section class="content-form pb-4 mx-4">
            <form id="category-form" action="#">
                @csrf
                @method('POST')
                <main class="grid gap-4">
                    <div class="input-group grid gap-4">
                        <label for="category-name" class="input-name Work-Sans">Nombre:</label>
                        <input class="form-input input-field" type="text" name="name" id="category-name" placeholder="Example">
                        @if($errors->has("name"))
                            <span class="Work-Sans support support-box support-name hidden">{{ $errors->first("name") }}</span>
                        @else
                            <span class="Work-Sans support support-box support-name hidden"></span>
                        @endif
                    </div>
                    <div class="text-center xl:text-right">
                        <button type="submit" class="form-submit category-form btn btn-background btn-red py-2 px-4">
                            <span>Enviar</span>
                        </button>
                    </div>
                </main>
            </form>
        </section>
    </main>
</li>