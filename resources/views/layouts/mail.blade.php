@extends('index')

@section('head')
  {{-- Layout CSS --}}
  <link href={{ asset('css/layouts/mail.css') }}
    rel="stylesheet">

  {{-- Section CSS --}}
  @yield('css')

  <title>
    @yield('title')
  </title>
@endsection

@section('body')
  <table>
    <tr>
      <td>
        <section id="mail">
          <header class="header">
            <a href="{{ config('app.catalog.url') }}"
              target="_blank">
              <figure>
                <img alt="Armentia Propiedades logo"
                  src="{{ asset('images/01-regular.png') }}">
              </figure>
            </a>
          </header>

          <main class="main container-fluid">
            <div class="row">
              @yield('main')
            </div>
          </main>

          <footer class="footer">
            <p>
              © Armentia Propiedades. Todos los Derechos Reservados. | Desarrollado por Juan Cruz Armentia
            </p>
          </footer>
        </section>
      </td>
    </tr>
  </table>
@endsection

@section('extras')
  {{-- Layout CSS --}}
  <script src={{ asset('js/layouts/mail.js') }}></script>

  {{-- Section JS --}}
  @yield('js')
@endsection