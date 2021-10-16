<form id="contact-form" action="/contactar" method="post">
    @csrf
    <div class="grid gap-4">
        <div class="input-group grid gap-4">
            <label for="name" class="input-name Work-Sans">Nombre y Apellido:</label>
            <input class="form-input input-field" type="text" name="name" id="name" placholder="Nombre y Apellido">
            @if($errors->has("name"))
                <span class="Work-Sans support support-box support-name hidden">{{ $errors->first("name") }}</span>
            @else
                <span class="Work-Sans support support-box support-name hidden"></span>
            @endif
        </div>
        <div class="input-group grid gap-4" title="El Correo es obligatorio">
            <label for="email" class="input-name Work-Sans">Correo: <span class="required color-red">*</label>
            <input class="form-input input-field" type="text" name="email" id="email" placholder="Correo">
            @if($errors->has("email"))
                <span class="Work-Sans support support-box support-email hidden">{{ $errors->first("email") }}</span>
            @else
                <span class="Work-Sans support support-box support-email hidden"></span>
            @endif
        </div>
        <div class="input-group grid gap-4" title="El Teléfono es obligatorio">
            <label for="phone" class="input-name Work-Sans">Teléfono: <span class="required color-red">*</label>
            <input class="form-input input-field" type="text" name="phone" id="phone" placholder="Tel;efono">
            @if($errors->has("phone"))
                <span class="Work-Sans support support-box support-phone hidden">{{ $errors->first("phone") }}</span>
            @else
                <span class="Work-Sans support support-box support-phone hidden"></span>
            @endif
        </div>
        <div class="input-group grid gap-4">
            <label for="message" class="input-name Work-Sans">Mensaje:</label>
            <textarea class="form-input input-field" name="message" id="message" placholder="Detalle su consulta..."></textarea>
            @if($errors->has("message"))
                <span class="Work-Sans support support-box support-message hidden">{{ $errors->first("message") }}</span>
            @else
                <span class="Work-Sans support support-box support-message hidden"></span>
            @endif
        </div>
        {!! app("captcha")->display() !!}
        @if($errors->has("g-recaptcha-response"))
            <span class="Work-Sans support support-box support-message hidden">{{$errors->first("g-recaptcha-response")}}</span>
        @else
            <span class="Work-Sans support support-box support-message hidden"></span>
        @endif
        <div class="text-center xl:text-right">
            <button type="submit" class="form-submit contact-form btn btn-background btn-red py-2 px-4">
                <span>Enviar</span>
            </button>
        </div>
    </div>
</form>