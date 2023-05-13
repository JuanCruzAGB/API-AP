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

      {{-- Global layout CSS --}}
      <link href={{ asset("css/styles.css") }}
        rel="stylesheet">

      {{-- Section CSS --}}
      @yield("head")
  </head>

  <body>
    @yield("body")

    {{-- JQuery --}}
    <script src={{ asset("js/mdb/jquery.min.js") }}></script>

    {{-- Added extras section --}}
    @yield("extras")
  </body>
</html>