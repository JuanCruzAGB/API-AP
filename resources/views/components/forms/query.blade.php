<form id="query-form" action="/consultar/propiedad/{{ $property->slug }}" method="post">
    @csrf
    <div class="row px-xl-5">
        <div class="input-group col-12 mb-3 p-0">
            <label for="name" class="input-name Work-Sans"><span class="first-letter">N</span>ombre y <span class="first-letter">A</span>pellido</label>
            <input class="form-input input-field" type="text" name="name" id="name">
            @if($errors->has('name'))
                <span class="Work-Sans support support-box support-name hidden">{{ $errors->first('name') }}</span>
            @else
                <span class="Work-Sans support support-box support-name hidden"></span>
            @endif
        </div>
        <div class="input-group col-12 mb-3 p-0" title="El Correo es obligatorio">
            <label for="email" class="input-name Work-Sans"><span class="first-letter">C</span>orreo <span class="required color-red">*</span></label>
            <input class="form-input input-field" type="text" name="email" id="email">
            @if($errors->has('email'))
                <span class="Work-Sans support support-box support-email hidden">{{ $errors->first('email') }}</span>
            @else
                <span class="Work-Sans support support-box support-email hidden"></span>
            @endif
        </div>
        <div class="input-group col-12 mb-3 p-0" title="El Teléfono es obligatorio">
            <label for="phone" class="input-name Work-Sans"><span class="first-letter">T</span>eléfono <span class="required color-red">*</span></label>
            <input class="form-input input-field" type="text" name="phone" id="phone">
            @if($errors->has('phone'))
                <span class="Work-Sans support support-box support-phone hidden">{{ $errors->first('phone') }}</span>
            @else
                <span class="Work-Sans support support-box support-phone hidden"></span>
            @endif
        </div>
        <div class="input-group col-12 mb-3 p-0" title="La Consulta es obligatoria">
            <label for="message" class="input-name Work-Sans"><span class="first-letter">C</span>onsulta <span class="required color-red">*</span></label>
            <textarea class="form-input input-field" name="message" id="message" cols="30" rows="10"></textarea>
            @if($errors->has('message'))
                <span class="Work-Sans support support-box support-message hidden">{{ $errors->first('message') }}</span>
            @else
                <span class="Work-Sans support support-box support-message hidden"></span>
            @endif
        </div>
        <div class="text-right col-12 mb-3 p-0">
            <button type="submit" class="form-submit query-form btn btn-uno mx-0">Enviar</button>
        </div>
    </div>
</form>