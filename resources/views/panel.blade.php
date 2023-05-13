@extends('layouts.index')

@section('head')
  {{-- Layout CSS --}}
  <link href={{ asset('build/css/panel.css') }}
    rel="stylesheet">

  {{-- Section CSS --}}
  @yield('css')

  <title>
    @yield('title')
  </title>
@endsection

@section('body')
  <div id="panel">
    @yield('app')
  </div>
@endsection

@section('extras')
  {{-- Layout CSS --}}
  <script src={{ asset('build/js/panel.js') }}></script>

  {{-- Section JS --}}
  @yield('js')
@endsection