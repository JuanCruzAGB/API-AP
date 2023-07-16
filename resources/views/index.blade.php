<!DOCTYPE html>

<html lang="es">
  <head>
    {{-- Meta --}}
    <meta content="width=device-width, initial-scale=1.0"
      name="viewport">

    <meta content="{{ csrf_token() }}"
      name="csrf-token">

    <meta content="{{ asset("") }}"
      name="asset">

    {{-- Font Awesome --}}
    <link href="https://use.fontawesome.com/releases/v6.4.0/css/all.css"
      rel="stylesheet">

    {{-- Tailwind --}}
    <link href={{ asset("build/css/tailwind.css") }}
      rel="stylesheet">

    {{-- App CSS --}}
    <link href={{ asset("build/css/app.css") }}
      rel="stylesheet">

    {{-- Global variables --}}
    <script>
      const auth = "{{ Auth::check() }}";

      const env = "{{ config('app.env') }}";
      const name = "{{ config('app.name') }}";
      const url = "{{ config('app.url') }}";
      const development_url = "{{ config('app.development.url') }}";
      const local_url = "{{ config('app.local.url') }}";
      const production_url = "{{ config('app.production.url') }}";

      const auth_url = "{{ config('app.auth.url') }}";

      const catalog_url = "{{ config('app.catalog.url') }}";

      const panel_url = "{{ config('app.panel.url') }}";
    </script>

    {{-- Section CSS --}}
    @hasSection ('head')
      @yield("head")
    @else
      <title>
        {{ config('app.name') }}
      </title>
    @endif
  </head>

  <body>
    <main id="app">
      @yield("body")
    </main>

    {{-- App JS --}}
    <script src={{ asset("build/js/app.js") }}></script>

    {{-- Added extras section --}}
    @yield("extras")
  </body>
</html>