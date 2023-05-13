@extends('layouts.mail')

@section('css')
  {{-- View CSS --}}
  <link href={{ asset('css/mails/query.css') }}
    rel="stylesheet">
@endsection

@section('title')
  {{ $data['from']['name'] }} desea consultar sobre la propiedad: {{ $data['property']->name }}
@endsection

@section('main')
  <section id="query">
    <h2>
      {{ $data['from']['name'] }} desea consultar sobre la propiedad: {{ $data['property']->name }}
    </h2>

    <a href="{{ config('app.panel.url') }}/properties/{{ $data['property']->slug }}/details"
      target="_blank">
      <header>
        <h3>
          {{ $data['property']->name }}
        </h3>
      </header>

      <figure>
        <img alt="{{ $data['property']->name }} image"
          src="{{ $data['property']->files && count($data['property']->files)
            ? asset('storage/' . $data['property']->files[0])
            : asset('img/sample.png') }}">
      </figure>
    </a>

    <ul>
      <li>
        <strong>
          Se ha contactado:
        </strong>

        {{ $data['from']['name'] }} desde tu sitio web.
      </li>

      <li>
        <strong>
          Email:
        </strong>

        {{ $data['from']['email'] }}
      </li>

      <li>
        <strong>
          Telefono:
        </strong>

        {{ $data['from']['phone'] }}
      </li>
    </ul>

    <p>
      {{ $data['from']['message'] }}
    </p>
  </section>
@endsection

@section('js')
  {{-- Layout CSS --}}
  <script src={{ asset('js/mails/query.js') }}></script>
@endsection