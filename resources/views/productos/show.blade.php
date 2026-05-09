@extends('layouts.app')

@section('title', $producto->nombre . ' — Agrivall')
@section('body-class', 'page-productos')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
@endpush

@section('content')

  {{-- ── CABECERA ──────────────────────────────────────────────── --}}
  <section class="detail-header">
    <a href="{{ route('productos.index') }}" class="detail-header__back">
      <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
      Volver a productos
    </a>
    <h1 class="detail-header__title">
      {{ $producto->nombre }}
      @if($producto->variedad)
        <span class="detail-header__sub">{{ $producto->variedad }}</span>
      @endif
    </h1>
  </section>

  {{-- ── DETALLE ───────────────────────────────────────────────── --}}
  <section class="detail-section">
    <div class="detail-inner">

      {{-- Imagen --}}
      <div class="detail-img-wrap">
        <img
          src="{{ $producto->imagen ? asset($producto->imagen) : asset('images/cereza-default.png') }}"
          alt="{{ $producto->nombre }}"
          class="detail-img"
        >
        <span class="detail-badge">BIO</span>
      </div>

      {{-- Info --}}
      <div class="detail-info">

        <div class="detail-tags">
          @if($producto->variedad)
            <span class="detail-tag">{{ $producto->variedad }}</span>
          @endif
          @if($producto->formato)
            <span class="detail-tag">{{ $producto->formato }}</span>
          @endif
          <span class="detail-tag">100% Ecológico</span>
        </div>

        <div>
          <p class="detail-precio">
            {{ number_format($producto->precio, 2, ',', '.') }}&euro;
          </p>
          <span class="detail-precio__label">IVA incluido · Envío en 24h</span>
        </div>

        <p class="detail-desc">
          Producto ecológico certificado, cultivado directamente en nuestros campos
          y recogido en el momento óptimo de madurez para garantizar el mejor sabor
          y los mayores valores nutricionales.
        </p>

        <form method="POST" action="{{ route('carrito.añadir', $producto) }}">
          @csrf
          <button type="submit" class="detail-btn">
            <i class="fa-solid fa-cart-plus" aria-hidden="true"></i>
            Añadir al carrito
          </button>
        </form>

      </div>
    </div>
  </section>

  {{-- ── TRUST BADGES ─────────────────────────────────────────── --}}
  <section class="trust" aria-label="Garantías">
    <ul class="trust__list" role="list">
      <li class="trust__item">
        <i class="fa-solid fa-leaf trust__icon" aria-hidden="true"></i>
        <span class="trust__label">100% Ecológico</span>
      </li>
      <li class="trust__item">
        <i class="fa-solid fa-tractor trust__icon" aria-hidden="true"></i>
        <span class="trust__label">Directo del Campo</span>
      </li>
      <li class="trust__item">
        <i class="fa-regular fa-clock trust__icon" aria-hidden="true"></i>
        <span class="trust__label">Envío en <strong>24h</strong></span>
      </li>
    </ul>
  </section>

  {{-- ── CERTIFICACIONES ─────────────────────────────────────── --}}
  <section class="certs" aria-label="Certificaciones">

    <div class="certs__heading-wrap">
      <img src="{{ asset('images/icon-leaf.png') }}" alt="" class="certs__leaf-icon" aria-hidden="true">
      <h2 class="certs__title">Calidad certificada,<br>confianza garantizada</h2>
    </div>

    <p class="certs__subtitle">Todos nuestros productos cuentan con certificación oficial</p>

    <div class="certs__logos">
      <div class="certs__logo-item">
        <div class="certs__logo-box">
          <img src="{{ asset('images/logo-caae.jpg') }}" alt="CAAE — Producción Ecológica">
        </div>
        <span class="certs__label">Producción<br>Ecológica</span>
      </div>
      <div class="certs__logo-item">
        <div class="certs__logo-box">
          <img src="{{ asset('images/logo-eu-eco.png') }}" alt="ES-ECO-001-CT Agricultura UE">
        </div>
        <span class="certs__label">ES-ECO-001-CT<br>Agricultura UE</span>
      </div>
      <div class="certs__logo-item">
        <div class="certs__logo-box">
          <img src="{{ asset('images/logo-intereco.jpg') }}" alt="Certirceo For Intereco">
        </div>
        <span class="certs__label">Certirceo<br>For Intereco</span>
      </div>
    </div>

    <div class="certs__leaves" aria-hidden="true">
      <img src="{{ asset('images/deco-leaves-left.png') }}"  alt="" class="certs__leaves-left">
      <img src="{{ asset('images/deco-leaves-right.png') }}" alt="" class="certs__leaves-right">
    </div>

  </section>

@endsection
