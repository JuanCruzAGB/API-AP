<!DOCTYPE html>
<html lang="es">
    <head>
        {{-- Meta --}}
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <meta name="asset" content="{{ asset("") }}">

        {{-- Font Awesome --}}
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

        {{-- App CSS --}}
        <link href={{ asset("css/app.css") }} rel="stylesheet">

        {{-- External Repositories CSS --}}
        <link href={{ asset("submodules/TabMenuJS/css/styles.css") }} rel="stylesheet">
        <link href={{ asset("submodules/FloatingMenuJS/css/styles.css") }} rel="stylesheet">
        <link href={{ asset("submodules/DropdownJS/css/styles.css") }} rel="stylesheet">
        <link href={{ asset("submodules/SidebarJS/css/styles.css") }} rel="stylesheet">
        <link href={{ asset("submodules/NavMenuJS/css/styles.css") }} rel="stylesheet">
        <link href={{ asset("submodules/NotificationJS/css/styles.css") }} rel="stylesheet">
        <link href={{ asset("submodules/ValidationJS/css/styles.css") }} rel="stylesheet">
        <link href={{ asset("submodules/GalleryJS/css/styles.css") }} rel="stylesheet">

        {{-- Global layout CSS --}}
        <link href={{ asset("css/styles.css") }} rel="stylesheet">

        {{-- Section CSS --}}
        @yield("head")
    </head>
    <body>
        @yield("body")
        {{-- JQuery --}}
        <script src={{ asset("js/mdb/jquery.min.js") }}></script>

        {{-- App modules --}}
        {{-- <script src="{{ asset("js/app.js") }}"></script> --}}

        {{-- External Repositories js --}}

        {{-- Global layout JS --}}
        <script type="module" src={{ asset("js/script.js") }}></script>

        {{-- Added extras section --}}
        @yield("extras")
    </body>
</html>