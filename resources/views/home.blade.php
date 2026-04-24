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
        NATURALEZA<br>
        <span class="hero__heading--accent">CERTIFICADA,</span><br>
        SABOR<br>
        INIGUALABLE
      </h1>

      <p class="hero__subtitle">
        Frutas seleccionadas con el máximo cuidado,<br>
        directo del campo a tu mesa en <strong class="hero__gold">24h</strong>.
      </p>

      <a href="{{ route('productos.index') }}" class="hero__cta">
        VER PRODUCTOS
      </a>

    </div><!-- /.hero__content -->

    <div class="hero__scroll" aria-hidden="true">
      <span>Descubre más</span>
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
          <h2 class="card__title card__title--green">PRODUCTOS</h2>
          <p class="card__desc">Descubre nuestra selección de frutas de temporada.</p>
          <a href="{{ route('productos.index') }}" class="card__link card__link--green">Ver catálogo →</a>
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
          <h2 class="card__title card__title--red">RESERVA</h2>
          <p class="card__desc">Reserva la Casilla.</p>
          <a href="{{ route('casilla.index') }}" class="card__link card__link--red">Reservar ahora →</a>
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
          <h2 class="card__title card__title--orange">BLOG</h2>
          <p class="card__desc">Consejos, recetas y novedades del mundo agrícola.</p>
          <a href="{{ route('blog.index') }}" class="card__link card__link--orange">Leer artículos →</a>
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
      <h2 class="certs__title">CALIDAD CERTIFICADA,<br>CONFIANZA GARANTIZADA</h2>
    </div>
    <h3 class="certs__subtitle">Cumplimos con los más altos estándares de producción ecológica.</h3>

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
