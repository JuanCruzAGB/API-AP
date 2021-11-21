<li id="propiedad" class="tab-content">
    <main class="grid gap-4">
        <header class="title mx-4">
            <h3 class="MontereyFLF">
                <a href="#" class="btn btn-text btn-black">
                    <span>Propiedad</span>
                    <i class="fas fa-eye"></i>
                </a>
            </h3>
        </header>
        <section class="content-form pb-4 mx-4">
            <form action="#">
                @csrf
                @method('POST')
                <main class="grid lg:grid-cols-2 gap-4">
                    <section class="property-gallery lg:col-span-2"></section>
                    <div class="input-group grid lg:col-span-2 gap-4">
                        <label for="property-name" class="input-name Work-Sans">Nombre:</label>
                        <input class="form-input input-field" type="text" name="name" id="property-name" placeholder="Example">
                        @if($errors->has("name"))
                            <span class="Work-Sans support support-box support-name hidden">{{ $errors->first("name") }}</span>
                        @else
                            <span class="Work-Sans support support-box support-name hidden"></span>
                        @endif
                    </div>
                    <div class="input-group grid lg:col-span-2 gap-4">
                        <label for="property-description" class="input-name Work-Sans">Descripción:</label>
                        <textarea class="form-input input-field" name="description" id="property-description" cols="30" rows="10" placeholder="Example"></textarea>
                        @if($errors->has("description"))
                            <span class="Work-Sans support support-box support-description hidden">{{ $errors->first("description") }}</span>
                        @else
                            <span class="Work-Sans support support-box support-description hidden"></span>
                        @endif
                    </div>
                    <div class="input-group grid gap-4">
                        <label for="property-id_category" class="input-name Work-Sans">Categoría:</label>
                        <select class="form-input input-field" name="id_category" id="property-id_category">
                            <option selected disabled>Elegir categoría</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id_category }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has("id_category"))
                            <span class="Work-Sans support support-box support-id_category hidden">{{ $errors->first("id_category") }}</span>
                        @else
                            <span class="Work-Sans support support-box support-id_category hidden"></span>
                        @endif
                    </div>
                    <div class="input-group grid gap-4">
                        <label for="property-id_location" class="input-name Work-Sans">Ubicación:</label>
                        <select class="form-input input-field" name="id_location" id="property-id_location">
                            <option selected disabled>Elegir ubicación</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id_location }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has("id_location"))
                            <span class="Work-Sans support support-box support-id_location hidden">{{ $errors->first("id_location") }}</span>
                        @else
                            <span class="Work-Sans support support-box support-id_location hidden"></span>
                        @endif
                    </div>
                    <div class="text-center xl:text-right lg:col-start-2">
                        <button type="submit" class="form-submit property-form btn btn-background btn-red py-2 px-4">
                            <span>Enviar</span>
                        </button>
                    </div>
                </main>
            </form>
        </section>
    </main>
</li>