@extends('layouts.app')

@section('title', 'Agrivall — Naturaleza certificada, sabor inigualable')

@section('content')

  {{-- HERO --}}
  <section class="hero" id="inicio">

    <div class="hero__content">
      <div class="hero__line" aria-hidden="true">
        <img src="{{ asset('images/line.png') }}" alt="linea decorativa" width="550px" height="auto">
      </div>

      <h1 class="hero__heading">
        {!! nl2br(e(__('home.hero_title'))) !!}
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

  {{-- CERTIFICATIONS --}}
  <section class="certs">
    <div class="certs__heading-wrap">
      <img class="certs__leaf-icon" src="{{ asset('images/icon-leaf.png') }}" alt="" aria-hidden="true">
      <h2 class="certs__title">{!! __('home.certs_title') !!}</h2>
    </div>
    <h3 class="certs__subtitle">{{ __('home.certs_subtitle') }}</h3>

    <div class="certs__logos">

      {{-- CAAE --}}
      <div class="certs__logo-item">
        <div class="certs__logo-box">
          <img src="{{ asset('images/logo-caae.jpg') }}" alt="Logo CAAE">
        </div>
        <span class="certs__label">PRODUCCIÓN<br>ECOLÓGICA</span>
      </div>

      {{-- EU Eco --}}
      <div class="certs__logo-item">
        <div class="certs__logo-box">
          <img src="{{ asset('images/logo-eu-eco.png') }}" alt="Logo EU Agricultura Ecológica">
        </div>
        <span class="certs__label">ES-ECO-001-CT<br>AGRICULTURA UE</span>
      </div>

      {{-- INTERECO --}}
      <div class="certs__logo-item">
        <div class="certs__logo-box">
          <img src="{{ asset('images/logo-intereco.jpg') }}" alt="Logo INTERECO">
        </div>
        <span class="certs__label">CERTIFICADO<br>POR INTERECO</span>
      </div>

    </div>

    {{-- Decorative leaves bottom --}}
    <div class="certs__leaves" aria-hidden="true">
      <img class="certs__leaves-left" src="{{ asset('images/deco-leaves-left.png') }}" alt="">
      <img class="certs__leaves-right" src="{{ asset('images/deco-leaves-right.png') }}" alt="">
    </div>
  </section>

@endsection
