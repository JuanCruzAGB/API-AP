<form id="contact-form" action="/contactar" method="post">
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
            <label for="email" class="input-name Work-Sans"><span class="first-letter">C</span>orreo <span class="asterisk color-red">*</span></label>
            <input class="form-input input-field" type="text" name="email" id="email">
            @if($errors->has('email'))
                <span class="Work-Sans support support-box support-email hidden">{{ $errors->first('email') }}</span>
            @else
                <span class="Work-Sans support support-box support-email hidden"></span>
            @endif
        </div>
        <div class="input-group col-12 mb-3 p-0" title="El Teléfono es obligatorio">
            <label for="phone" class="input-name Work-Sans"><span class="first-letter">T</span>eléfono <span class="asterisk color-red">*</span></label>
            <input class="form-input input-field" type="text" name="phone" id="phone">
            @if($errors->has('phone'))
                <span class="Work-Sans support support-box support-phone hidden">{{ $errors->first('phone') }}</span>
            @else
                <span class="Work-Sans support support-box support-phone hidden"></span>
            @endif
        </div>
        <div class="input-group col-12 mb-3 p-0">
            <label for="message" class="input-name Work-Sans"><span class="first-letter">M</span>ensaje</label>
            <textarea class="form-input input-field" name="message" id="message" cols="30" rows="10"></textarea>
            @if($errors->has('message'))
                <span class="Work-Sans support support-box support-message hidden">{{ $errors->first('message') }}</span>
            @else
                <span class="Work-Sans support support-box support-message hidden"></span>
            @endif
        </div>
        {!! app('captcha')->display() !!}
        @if($errors->has('g-recaptcha-response'))
            <span class="Work-Sans support support-box support-message hidden">{{$errors->first('g-recaptcha-response')}}</span>
        @else
            <span class="Work-Sans support support-box support-message hidden"></span>
        @endif
        <div class="text-right col-12 mb-3 p-0">
            <button type="submit" class="form-submit contact-form btn btn-uno mx-0">Enviar</button>
        </div>
    </div>
</form>