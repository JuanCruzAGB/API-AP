@extends('layouts.auth')

@section('title')
    Iniciar Sesión | Armentia Propiedades
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/auth/login.css')}}">
@endsection

@section('nav')
    @component('components.nav.auth')@endcomponent
@endsection

@section('main')
    <section id="login" class="form flex justify-center">
        <form id="login-form" action="/login" method="post" class="w-1/3">
            @csrf
            <main class="grid gap-4 p-4 py-8">
                <section class="input-group grid gap-4" title="El Correo es obligatorio">
                    <label for="email" class="input-name Work-Sans">Correo <span class="required color-red">*</span></label>

                    <input class="input-field" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="example@mail.com">

                    <span class="Work-Sans support support-box support-email {{ !$errors->has("email") ? "hidden" : "visible" }}">
                        @if($errors->has("email"))
                            {{ $errors->first("email") }}
                        @endif
                    </span>
                </section>

                <section class="input-group grid gap-4" title="La Contraseña es obligatorio">
                    <label for="password" class="input-name Work-Sans">Contraseña <span class="required color-red">*</span></label>
                    
                    <div class="grid grid-cols-4 gap-4">
                        <input class="input-field col-span-3" type="password" name="password" id="password" placeholder="********">
                        
                        <button class="switch-password btn btn-icon-bg btn-red" data-for="password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>

                    <span class="Work-Sans support support-box support-password {{ !$errors->has("password") ? "hidden" : "visible" }}">
                        @if($errors->has("password"))
                            {{ $errors->first("password") }}
                        @endif
                    </span>
                </section>

                <section class="text-center">
                    <button type="submit" class="form-submit login-form btn btn-background btn-red py-2 px-4">
                        <span>Ingresar</span>
                    </button>
                </section>
            </main>
        </form>
    </section>
@endsection

@section('js')
    <script src="{{ asset('js/auth/login.js') }}"></script>
@endsection