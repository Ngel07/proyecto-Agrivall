@extends('layouts.app')

@section('title', 'Productos — Agrivall')
@section('body-class', 'page-productos')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
@endpush

@section('content')
  
  {{-- ── FILTROS ──────────────────────────────────────────────── --}}
  <section class="prod-filters">
    <div class="prod-header__text">
      <h1 class="prod-header__title">PRODUCTOS</h1>
      <p class="prod-header__subtitle">
        Frutas, frutos secos y hierbas comestibles ecológicas
      </p>
    <form class="prod-filters__form" method="GET" action="{{ route('productos.index') }}">

      <div class="prod-filters__selects">

        <div class="prod-filters__group">
          <label for="f-categoria" class="sr-only">Categoría</label>
          <div class="prod-filters__select-wrap">
            <select id="f-categoria" name="categoria" class="prod-filters__select">
              <option value="">Categoría</option>
              @foreach ($categorias as $cat)
                <option value="{{ $cat }}" @selected(request('categoria') === $cat)>{{ $cat }}</option>
              @endforeach
            </select>
            <i class="fa-solid fa-chevron-down prod-filters__arrow" aria-hidden="true"></i>
          </div>
        </div>

        <div class="prod-filters__group prod-filters__group--tipo">
          <label for="f-tipo" class="sr-only">Tipo</label>
          <div class="prod-filters__select-wrap">
            <select id="f-tipo" name="tipo" class="prod-filters__select">
              <option value="">Tipo</option>
              @foreach ($formatos as $fmt)
                <option value="{{ $fmt }}" @selected(request('tipo') === $fmt)>{{ $fmt }}</option>
              @endforeach
            </select>
            <i class="fa-solid fa-chevron-down prod-filters__arrow" aria-hidden="true"></i>
          </div>
        </div>

        <div class="prod-filters__group">
          <label for="f-orden" class="sr-only">Ordenar por</label>
          <div class="prod-filters__select-wrap">
            <select id="f-orden" name="orden" class="prod-filters__select">
              <option value="nombre"      @selected(request('orden', 'nombre') === 'nombre')>Ordenar por: Nombre</option>
              <option value="precio_asc"  @selected(request('orden') === 'precio_asc')>Ordenar por: Precio ↑</option>
              <option value="precio_desc" @selected(request('orden') === 'precio_desc')>Ordenar por: Precio ↓</option>
            </select>
            <i class="fa-solid fa-chevron-down prod-filters__arrow" aria-hidden="true"></i>
          </div>
        </div>

      </div>

      <button type="submit" class="prod-filters__btn">
        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        <span>BUSCAR</span>
      </button>

    </form>
  </section>

  {{-- ── GRID DE PRODUCTOS ────────────────────────────────────── --}}
  <section class="prod-section">

    @if ($productos->isEmpty())
      <p class="prod-empty">No hay productos disponibles con estos filtros.</p>
    @else
      <ul class="prod-grid" role="list">
        @foreach ($productos as $producto)
          <li class="prod-card">

            {{-- Imagen --}}
            <a href="{{ route('productos.show', $producto) }}" class="prod-card__img-link" tabindex="-1" aria-hidden="true">
              <div class="prod-card__img-wrap">
                <img
                  src="{{ $producto->imagen ? asset($producto->imagen) : asset('images/cereza-default.png') }}"
                  alt="{{ $producto->nombre }}"
                  class="prod-card__img"
                  loading="lazy"
                >
                <span class="prod-card__badge">BIO</span>
              </div>
            </a>

            {{-- Info --}}
            <div class="prod-card__body">
              <a href="{{ route('productos.show', $producto) }}" class="prod-card__name">
                {{ $producto->nombre }}
                @if($producto->variedad)
                  <span class="prod-card__variedad">{{ $producto->variedad }}</span>
                @endif
                @if($producto->formato)
                  <span class="prod-card__formato">{{ $producto->formato }}</span>
                @endif
              </a>

              <p class="prod-card__precio">
                {{ number_format($producto->precio, 2, ',', '.') }}&euro;
              </p>

              <form method="POST" action="{{ route('carrito.añadir', $producto) }}">
                @csrf
                <button type="submit" class="prod-card__btn">
                  <i class="fa-solid fa-cart-plus" aria-hidden="true"></i>
                  <span>Añadir al carrito</span>
                </button>
              </form>
            </div>

          </li>
        @endforeach
      </ul>
    @endif

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
