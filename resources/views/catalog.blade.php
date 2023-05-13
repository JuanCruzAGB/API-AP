@extends('layouts.index')

@section('head')
  {{-- Layout CSS --}}
  <link href={{ asset('build/css/catalog.css') }}
    rel="stylesheet">

  {{-- Section CSS --}}
  @yield('css')

  <title>
    @yield('title')
  </title>
@endsection

@section('body')
  <div id="catalog">
    @yield('app')
  </div>
@endsection

@section('extras')
  {{-- Layout CSS --}}
  <script src={{ asset('build/js/catalog.js') }}></script>

  {{-- Section JS --}}
  @yield('js')
@endsection