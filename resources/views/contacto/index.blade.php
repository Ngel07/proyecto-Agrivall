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
      ['label' => __('common.inicio'), 'url' => route('home')],
      ['label' => __('contacto.title')],
    ]])
    <div class="prod-header__text">
      <h1 class="prod-header__title">{{ __('contacto.title') }}</h1>
      <p class="prod-header__subtitle">
        {{ __('contacto.subtitle') }}
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
        {{ __('contacto.intro') }}
      </p>
    </div>

    <div class="contacto-card">
      <form method="POST" action="#" novalidate>
        @csrf

        <div class="contacto-field">
          <label for="nombre">{{ __('contacto.name') }}</label>
          <input
            type="text"
            id="nombre"
            name="nombre"
            placeholder="{{ __('contacto.name_ph') }}"
            autocomplete="name"
          >
        </div>

        <div class="contacto-field">
          <label for="email">{{ __('contacto.email') }}</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="{{ __('contacto.email_ph') }}"
            autocomplete="email"
          >
        </div>

        <div class="contacto-field">
          <label for="mensaje">{{ __('contacto.message') }}</label>
          <textarea
            id="mensaje"
            name="mensaje"
            placeholder="{{ __('contacto.message_ph') }}"
          ></textarea>
        </div>

        <button type="button" class="contacto-btn">
          <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
          {{ __('contacto.send') }}
        </button>

      </form>
    </div>

    {{-- ── MAPA PLACEHOLDER ────────────────────────────────────── --}}
    <div class="contacto-map" aria-label="Ubicación de Agrivall">
      <div class="contacto-map__placeholder">
        <i class="fa-solid fa-map-location-dot" aria-hidden="true"></i>
        <p>{{ __('contacto.map_title') }}</p>
      </div>
        <div class="contacto-map__caption">
        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
        {{ __('contacto.map_caption') }}
      </div>
    </div>

  </section>

  @include('partials.trust-certs')

@endsection
