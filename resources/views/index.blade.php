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
    <link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
      rel="stylesheet">

    {{-- Tailwind --}}
    <link href={{ asset("build/css/tailwind.css") }}
      rel="stylesheet">

    {{-- App CSS --}}
    <link href={{ asset("build/css/app.css") }}
      rel="stylesheet">

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