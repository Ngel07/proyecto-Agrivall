@extends('layouts.app')

@section('title', $producto->nombre . ' — Agrivall')
@section('body-class', 'page-productos')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
@endpush

@section('content')

  {{-- ── CABECERA ──────────────────────────────────────────────── --}}
  <section class="detail-header">
    @include('partials.breadcrumb', ['items' => [
      ['label' => 'Inicio', 'url' => route('home')],
      ['label' => 'Productos', 'url' => route('productos.index')],
      ['label' => $producto->nombre],
    ]])
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

  @include('partials.trust-certs')

@endsection
