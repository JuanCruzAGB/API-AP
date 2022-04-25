<form id="query-form" action="/query/properties/{{ $property->slug }}" method="post">
    @csrf

    <main class="grid gap-4">
        <section class="input-group grid gap-4">
            <label for="name" class="input-name Work-Sans">Nombre y Apellido:</label>

            <input class="form-input input-field" type="text" name="name" id="name" placeholder="Nombre y Apellido">
            
            <span class="Work-Sans support support-box support-name {{ !$errors->has("name") ? "hidden" : "visible" }}">
                @if($errors->has("name"))
                    {{ $errors->first("name") }}
                @endif
            </span>
        </section>
        
        <section class="input-group grid gap-4" title="El Correo es obligatorio">
            <label for="email" class="input-name Work-Sans">Correo: <span class="required color-red">*</label>

            <input class="form-input input-field" type="text" name="email" id="email" placeholder="Correo">

            <span class="Work-Sans support support-box support-email {{ !$errors->has("email") ? "hidden" : "visible" }}">
                @if($errors->has("email"))
                    {{ $errors->first("email") }}
                @endif
            </span>
        </section>

        <section class="input-group grid gap-4" title="El Teléfono es obligatorio">
            <label for="phone" class="input-name Work-Sans">Teléfono: <span class="required color-red">*</label>

            <input class="form-input input-field" type="text" name="phone" id="phone" placeholder="Teléfono">

            <span class="Work-Sans support support-box support-phone {{ !$errors->has("phone") ? "hidden" : "visible" }}">
                @if($errors->has("phone"))
                    {{ $errors->first("phone") }}
                @endif
            </span>
        </section>

        <section class="input-group grid gap-4" title="La Consulta es obligatoria">
            <label for="message" class="input-name Work-Sans">Consulta:</label>

            <textarea class="form-input input-field" name="message" id="message" placeholder="Detalle su consulta..."></textarea>

            <span class="Work-Sans support support-box support-message {{ !$errors->has("message") ? "hidden" : "visible" }}">
                @if($errors->has("message"))
                    {{ $errors->first("message") }}
                @endif
            </span>
        </section>

        <section class="text-center xl:text-right">
            <button type="submit" class="form-submit query-form btn btn-background btn-red py-2 px-4">
                <span>Enviar</span>
            </button>
        </section>
    </main>
</form>