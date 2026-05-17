@extends('layouts.app')

@section('title', 'Productos — Agrivall')
@section('body-class', 'page-productos')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
@endpush

@section('content')
  
  {{-- ── FILTROS ──────────────────────────────────────────────── --}}
  <section class="prod-filters">
    @include('partials.breadcrumb', ['items' => [
      ['label' => __('common.inicio'), 'url' => route('home')],
      ['label' => __('productos.title')],
    ]])
    <div class="prod-header__text">
      <h1 class="prod-header__title">{{ __('productos.title') }}</h1>
      <p class="prod-header__subtitle">
        {{ __('productos.subtitle') }}
      </p>
    <form class="prod-filters__form" method="GET" action="{{ route('productos.index') }}">

      <div class="prod-filters__selects">

        <div class="prod-filters__group">
          <label for="f-categoria" class="sr-only">{{ __('productos.filter_category') }}</label>
          <div class="prod-filters__select-wrap">
            <select id="f-categoria" name="categoria" class="prod-filters__select">
              <option value="">{{ __('productos.filter_category') }}</option>
              @foreach ($categorias as $cat)
                <option value="{{ $cat }}" @selected(request('categoria') === $cat)>{{ $cat }}</option>
              @endforeach
            </select>
            <i class="fa-solid fa-chevron-down prod-filters__arrow" aria-hidden="true"></i>
          </div>
        </div>

        <div class="prod-filters__group prod-filters__group--tipo">
          <label for="f-tipo" class="sr-only">{{ __('productos.filter_type') }}</label>
          <div class="prod-filters__select-wrap">
            <select id="f-tipo" name="tipo" class="prod-filters__select">
              <option value="">{{ __('productos.filter_type') }}</option>
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
              <option value="nombre"      @selected(request('orden', 'nombre') === 'nombre')>{{ __('productos.filter_order_name') }}</option>
              <option value="precio_asc"  @selected(request('orden') === 'precio_asc')>{{ __('productos.filter_order_price_asc') }}</option>
              <option value="precio_desc" @selected(request('orden') === 'precio_desc')>{{ __('productos.filter_order_price_desc') }}</option>
            </select>
            <i class="fa-solid fa-chevron-down prod-filters__arrow" aria-hidden="true"></i>
          </div>
        </div>

      </div>

      <button type="submit" class="prod-filters__btn">
        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        <span>{{ __('productos.search') }}</span>
      </button>

    </form>
  </section>

  {{-- ── GRID DE PRODUCTOS ────────────────────────────────────── --}}
  <section class="prod-section">

    @if ($productos->isEmpty())
      <p class="prod-empty">{{ __('productos.empty') }}</p>
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
                <span class="prod-card__badge">{{ __('productos.badge_bio') }}</span>
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
                  <span>{{ __('productos.add_to_cart') }}</span>
                </button>
              </form>
            </div>

          </li>
        @endforeach
      </ul>
    @endif

  </section>

  @include('partials.trust-certs')

@endsection
