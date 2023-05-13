@extends('layouts.mail')

@section('css')
  {{-- View CSS --}}
  <link href={{ asset('css/mails/contact.css') }}
    rel="stylesheet">
@endsection

@section('title')
  {{ $data['from']['name'] }} quiere contactarte
@endsection

@section('main')
  <section id="contact">
    <h2>
      {{ $data['from']['name'] }} quiere contactarte
    </h2>

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
  <script src={{ asset('js/mails/contact.js') }}></script>
@endsection