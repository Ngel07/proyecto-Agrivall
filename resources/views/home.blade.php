@extends('layouts.app')

@section('title', 'Agrivall — Naturaleza certificada, sabor inigualable')
@section('description', 'Agrivall ofrece productos ecológicos certificados del Valle de Gallinera: cerezas, albaricoques, nueces y hierbas aromáticas. Directas del productor a tu mesa.')

@section('content')

  {{-- HERO --}}
  <section class="hero" id="inicio">

    <div class="hero__content">
      <div class="hero__line" aria-hidden="true">
        <img src="{{ asset('images/line.png') }}" alt="linea decorativa" width="550px" height="auto">
      </div>

      <h1 class="hero__heading">
        {!! nl2br(__('home.hero_title')) !!}
      </h1>

      <p class="hero__subtitle">
        {!! __('home.hero_subtitle') !!}
      </p>

      <a href="{{ route('productos.index') }}" class="hero__cta">
        {{ __('home.hero_cta') }}
      </a>

    </div><!-- /.hero__content -->

    <div class="hero__scroll" aria-hidden="true">
      <span>{{ __('home.hero_discover') }}</span>
      <i class="fa-solid fa-angles-down"></i>
    </div>
  </section>

  {{-- FEATURES — 3 tarjetas --}}
  <section class="features" id="features">
    <div class="features__grid">

      {{-- Tarjeta Productos --}}
      <article class="card card--green">
        <div class="card__icon-wrap card__icon-wrap--green" aria-hidden="true">
          <i class="fa-solid fa-apple-whole" aria-hidden="true"></i>
        </div>

        <div class="card__body">
          <h2 class="card__title card__title--green">{{ __('home.card_products_title') }}</h2>
          <p class="card__desc">{{ __('home.card_products_desc') }}</p>
          <a href="{{ route('productos.index') }}" class="card__link card__link--green">{{ __('home.card_products_link') }}</a>
        </div>

        <div class="card__watermark" aria-hidden="true">
          <i class="fa-solid fa-leaf"></i>
        </div>
      </article>

      {{-- Tarjeta Reserva --}}
      <article class="card card--pink">
        <div class="card__icon-wrap card__icon-wrap--pink" aria-hidden="true">
          <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
        </div>

        <div class="card__body">
          <h2 class="card__title card__title--red">{{ __('home.card_reserva_title') }}</h2>
          <p class="card__desc">{{ __('home.card_reserva_desc') }}</p>
          <a href="{{ route('casilla.index') }}" class="card__link card__link--red">{{ __('home.card_reserva_link') }}</a>
        </div>

        <div class="card__watermark" aria-hidden="true">
          <i class="fa-solid fa-leaf"></i>
        </div>
      </article>

      {{-- Tarjeta Blog --}}
      <article class="card card--cream">
        <div class="card__icon-wrap card__icon-wrap--cream" aria-hidden="true">
          <i class="fa-solid fa-pencil" aria-hidden="true"></i>
        </div>

        <div class="card__body">
          <h2 class="card__title card__title--orange">{{ __('home.card_blog_title') }}</h2>
          <p class="card__desc">{{ __('home.card_blog_desc') }}</p>
          <a href="{{ route('blog.index') }}" class="card__link card__link--orange">{{ __('home.card_blog_link') }}</a>
        </div>

        <div class="card__watermark" aria-hidden="true">
          <i class="fa-solid fa-leaf"></i>
        </div>
      </article>

    </div>
  </section>

  @include('partials.trust-certs', ['hideTrust' => true])

@endsection
