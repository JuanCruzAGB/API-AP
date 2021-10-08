@extends('layouts.auth')

@section('title')
    Armentia Propiedades - Iniciar Sesión
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/auth/login.css')}}">
@endsection

@section('nav')
    @component('components.nav.auth')
    @endcomponent
@endsection

@section('main')
    <section id="login" class="form col-12 col-md-8 col-xl-6 p-5">
        <form action="/login" method="post">
            @csrf
            <div class="row px-xl-5">
                <div class="input-group col-12 mb-3 p-0" title="El Correo es obligatorio">
                    <label for="email" class="input-name Work-Sans"><span class="first-letter">C</span>orreo <span class="required color-red">*</span></label>
                    <input class="input-field" type="email" name="email" id="email" value="{{ old('email') }}">
                </div>
                <div class="input-group col-12 mb-3 p-0" title="La Contraseña es obligatorio">
                    <label for="password" class="input-name Work-Sans"><span class="first-letter">C</span>ontraseña <span class="required color-red">*</span></label>
                    <input class="input-field" type="password" name="password" id="password">
                </div>
                <div class="text-right col-12 mb-3 p-0">
                    <button type="submit" class="btn btn-uno mx-0">Enviar</button>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('js')
    <script src="{{asset('js/auth/login.js')}}"></script>
@endsection