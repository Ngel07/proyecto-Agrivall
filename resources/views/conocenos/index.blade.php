@extends('layouts.app')

@section('title', 'Conócenos — Agrivall')
@section('body-class', 'page-conocenos')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/conocenos.css') }}">
@endpush

@section('content')

  {{-- ── CABECERA ──────────────────────────────────────────────── --}}
  <section class="prod-filters">
    @include('partials.breadcrumb', ['items' => [
      ['label' => __('common.inicio'), 'url' => route('home')],
      ['label' => __('conocenos.title')],
    ]])
    <div class="prod-header__text">
      <h1 class="prod-header__title">{{ __('conocenos.title') }}</h1>
      <p class="prod-header__subtitle">
        {{ __('conocenos.subtitle') }}
      </p>
    </div>
  </section>

  {{-- ── QUIÉNES SOMOS ─────────────────────────────────────────── --}}
  <section class="conocenos-section">
    <div class="conocenos-inner">
      <div class="conocenos-story">
        <div class="conocenos-story__text">
          <h2 class="conocenos-section__title">{{ __('conocenos.story_title') }}</h2>
          <p>{!! __('conocenos.story_p1') !!}</p>
          <p>{!! __('conocenos.story_p2') !!}</p>
          <p>{!! __('conocenos.story_p3') !!}</p>
        </div>
        <div class="conocenos-story__image">
          <img src="{{ asset('images/FotosCasilla/agrivall.jpg') }}" alt="Campos de Agrivall en la Vall de Gallinera" loading="lazy">
        </div>
      </div>

      {{-- Galería --}}
      <div class="conocenos-gallery">
        <img src="{{ asset('images/FotosCasilla/agrivall2.png') }}" alt="Agrivall — cultivo ecológico" loading="lazy">
        <img src="{{ asset('images/FotosCasilla/agrivall3.png') }}" alt="Agrivall — frutos de temporada" loading="lazy">
      </div>
    </div>
  </section>

  {{-- ── CERTIFICACIÓN ─────────────────────────────────────────── --}}
  <section id="certificaciones" class="conocenos-section conocenos-section--alt">
    <div class="conocenos-inner">

      <h2 class="conocenos-section__title">
        {{ __('conocenos.cert_title') }}
      </h2>
      <p class="conocenos-section__lead">
        {!! __('conocenos.cert_lead') !!}
      </p>

      <h3 class="conocenos-subsection__title">{{ __('conocenos.cert_q') }}</h3>

      <ul class="conocenos-guarantees" role="list">
        <li class="conocenos-guarantees__item">
          <span class="conocenos-guarantees__icon" aria-hidden="true">
            <i class="fa-solid fa-ban"></i>
          </span>
          <div>
            <strong>{{ __('conocenos.g1_title') }}</strong>
            <p>{{ __('conocenos.g1_text') }}</p>
          </div>
        </li>
        <li class="conocenos-guarantees__item">
          <span class="conocenos-guarantees__icon" aria-hidden="true">
            <i class="fa-solid fa-leaf"></i>
          </span>
          <div>
            <strong>{{ __('conocenos.g2_title') }}</strong>
            <p>{{ __('conocenos.g2_text') }}</p>
          </div>
        </li>
        <li class="conocenos-guarantees__item">
          <span class="conocenos-guarantees__icon" aria-hidden="true">
            <i class="fa-solid fa-shield-halved"></i>
          </span>
          <div>
            <strong>{{ __('conocenos.g3_title') }}</strong>
            <p>{{ __('conocenos.g3_text') }}</p>
          </div>
        </li>
      </ul>

      {{-- Sellos --}}
      <h3 class="conocenos-subsection__title">{{ __('conocenos.seals_title') }}</h3>
      <p class="conocenos-sellos__text">
        {!! __('conocenos.seals_text') !!}
      </p>
      <div class="conocenos-sellos__logos">
        <img src="{{ asset('images/logo-caae.jpg') }}" alt="Sello CAECV — ES-ECO-020-CV" loading="lazy">
        <img src="{{ asset('images/logo-eu-eco.png') }}" alt="Eurohoja — Agricultura Ecológica UE" loading="lazy">
        <img src="{{ asset('images/logo-intereco.jpg') }}" alt="Intereco" loading="lazy">
      </div>
      <p class="conocenos-sellos__cta">
        {!! __('conocenos.seals_cta') !!}
      </p>

    </div>
  </section>

  {{-- ── CTA ──────────────────────────────────────────────────── --}}
  <section class="conocenos-cta">
    <div class="conocenos-inner">
      <h2 class="conocenos-cta__title">{{ __('conocenos.cta_title') }}</h2>
      <div class="conocenos-cta__buttons">
        <a href="{{ route('productos.index') }}" class="conocenos-cta__btn conocenos-cta__btn--primary">
          <i class="fa-solid fa-basket-shopping" aria-hidden="true"></i>
          {{ __('conocenos.cta_products') }}
        </a>
        <a href="{{ route('contacto.index') }}" class="conocenos-cta__btn">
          <i class="fa-solid fa-envelope" aria-hidden="true"></i>
          {{ __('conocenos.cta_contact') }}
        </a>
      </div>
    </div>
  </section>

@endsection

