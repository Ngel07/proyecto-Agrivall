@extends('layouts.app')

@section('title', 'Contacto — Agrivall')
@section('body-class', 'page-contacto')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/contacto.css') }}">
@endpush

@section('content')

  {{-- ── CABECERA ─────────────────────────────────────────────── --}}
  <section class="prod-filters">
    @include('partials.breadcrumb', ['items' => [
      ['label' => 'Inicio', 'url' => route('home')],
      ['label' => 'Contacto'],
    ]])
    <div class="prod-header__text">
      <h1 class="prod-header__title">Contacto</h1>
      <p class="prod-header__subtitle">
        Escríbenos y te responderemos lo antes posible
      </p>
    </div>
  </section>

  {{-- ── FORMULARIO ──────────────────────────────────────────────── --}}
  <section class="contacto-section">

    <div class="contacto-intro">
      <div class="contacto-intro__icon" aria-hidden="true">
        <i class="fa-solid fa-seedling"></i>
      </div>
      <p class="contacto-intro__text">
        ¿Tienes dudas sobre nuestros productos, quieres hacer un pedido especial
        o necesitas información sobre la casilla rural? Estaremos encantados de ayudarte.
      </p>
    </div>

    <div class="contacto-card">
      <form method="POST" action="#" novalidate>
        @csrf

        <div class="contacto-field">
          <label for="nombre">Nombre</label>
          <input
            type="text"
            id="nombre"
            name="nombre"
            placeholder="Tu nombre"
            autocomplete="name"
          >
        </div>

        <div class="contacto-field">
          <label for="email">Correo electrónico</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="tucorreo@ejemplo.com"
            autocomplete="email"
          >
        </div>

        <div class="contacto-field">
          <label for="mensaje">Mensaje</label>
          <textarea
            id="mensaje"
            name="mensaje"
            placeholder="Escribe aquí tu consulta..."
          ></textarea>
        </div>

        <button type="button" class="contacto-btn">
          <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
          Enviar mensaje
        </button>

      </form>
    </div>

    {{-- ── MAPA PLACEHOLDER ────────────────────────────────────── --}}
    <div class="contacto-map" aria-label="Ubicación de Agrivall">
      <div class="contacto-map__placeholder">
        <i class="fa-solid fa-map-location-dot" aria-hidden="true"></i>
        <p>Ubicación de Agrivall</p>
      </div>
      <div class="contacto-map__caption">
        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
        Valle del Jerte, Cáceres, Extremadura
      </div>
    </div>

  </section>

  @include('partials.trust-certs')

@endsection
