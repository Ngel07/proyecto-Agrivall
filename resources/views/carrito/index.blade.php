@extends('layouts.app')

@section('title', 'Carrito — Agrivall')
@section('body-class', 'page-carrito')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/carrito.css') }}">
@endpush

@php
  // Datos de ejemplo (sin lógica real)
  $items = [
    [
      'id'         => 1,
      'nombre'     => 'Cerezas ecológicas',
      'variedad'   => 'Picota del Jerte',
      'formato'    => '1 kg',
      'precio'     => 5.90,
      'cantidad'   => 2,
      'imagen'     => 'images/cereza-default.png',
    ],
    [
      'id'         => 2,
      'nombre'     => 'Almendras crudas',
      'variedad'   => 'Marcona',
      'formato'    => '500 g',
      'precio'     => 8.50,
      'cantidad'   => 1,
      'imagen'     => 'images/cereza-default.png',
    ],
    [
      'id'         => 3,
      'nombre'     => 'Menta fresca',
      'variedad'   => null,
      'formato'    => '200 g',
      'precio'     => 2.40,
      'cantidad'   => 3,
      'imagen'     => 'images/cereza-default.png',
    ],
  ];

  $subtotal = collect($items)->sum(fn($i) => $i['precio'] * $i['cantidad']);
  $envio    = $subtotal >= 40 ? 0 : 4.95;
  $total    = $subtotal + $envio;
@endphp

@section('content')

  {{-- ── CABECERA ─────────────────────────────────────────────── --}}
  <section class="prod-filters">
    @include('partials.breadcrumb', ['items' => [
      ['label' => 'Inicio', 'url' => route('home')],
      ['label' => 'Carrito'],
    ]])
    <div class="prod-header__text">
      <h1 class="prod-header__title">Carrito</h1>
      <p class="prod-header__subtitle">
        {{ count($items) }} {{ count($items) === 1 ? 'artículo' : 'artículos' }}
      </p>
    </div>
  </section>

  {{-- ── CONTENIDO PRINCIPAL ─────────────────────────────────── --}}
  <section class="carrito-section">
    <div class="carrito-inner">

      {{-- ── ARTÍCULOS ──────────────────────────────────────── --}}
      <div>

        @if (empty($items))

          {{-- Estado vacío --}}
          <div class="carrito-empty">
            <i class="fa-solid fa-cart-shopping carrito-empty__icon" aria-hidden="true"></i>
            <p class="carrito-empty__title">Tu carrito está vacío</p>
            <p class="carrito-empty__text">
              Explora nuestra selección de productos ecológicos y añade los que más te gusten.
            </p>
            <a href="{{ route('productos.index') }}" class="carrito-empty__btn">
              <i class="fa-solid fa-leaf" aria-hidden="true"></i>
              Ver productos
            </a>
          </div>

        @else

          <ul class="carrito-items" role="list">
            @foreach ($items as $item)
              <li class="carrito-item">

                {{-- Imagen --}}
                <div class="carrito-item__img-wrap">
                  <img
                    src="{{ asset($item['imagen']) }}"
                    alt="{{ $item['nombre'] }}"
                    loading="lazy"
                  >
                </div>

                {{-- Info --}}
                <div class="carrito-item__info">
                  <span class="carrito-item__name">{{ $item['nombre'] }}</span>
                  @if($item['variedad'])
                    <span class="carrito-item__meta">{{ $item['variedad'] }}</span>
                  @endif
                  <span class="carrito-item__meta">{{ $item['formato'] }}</span>
                  <span class="carrito-item__unit-price">
                    {{ number_format($item['precio'], 2, ',', '.') }}&euro; / ud.
                  </span>
                </div>

                {{-- Eliminar --}}
                <form method="POST" action="{{ route('carrito.eliminar', $item['id']) }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="carrito-item__remove" aria-label="Eliminar artículo">
                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                  </button>
                </form>

                {{-- Cantidad --}}
                <div class="carrito-item__qty">
                  <button type="button" class="carrito-item__qty-btn" aria-label="Reducir cantidad">−</button>
                  <input
                    type="number"
                    class="carrito-item__qty-input"
                    value="{{ $item['cantidad'] }}"
                    min="1"
                    max="99"
                    aria-label="Cantidad de {{ $item['nombre'] }}"
                  >
                  <button type="button" class="carrito-item__qty-btn" aria-label="Aumentar cantidad">+</button>
                </div>

                {{-- Subtotal --}}
                <span class="carrito-item__subtotal">
                  {{ number_format($item['precio'] * $item['cantidad'], 2, ',', '.') }}&euro;
                </span>

              </li>
            @endforeach
          </ul>

          {{-- Barra de acciones --}}
          <div class="carrito-actions-bar">
            <a href="{{ route('productos.index') }}" class="carrito-actions-bar__link">
              <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
              Seguir comprando
            </a>
            <form method="POST" action="{{ route('carrito.vaciar') }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="carrito-actions-bar__vaciar">
                <i class="fa-solid fa-trash" aria-hidden="true"></i>
                Vaciar carrito
              </button>
            </form>
          </div>

        @endif

      </div>

      {{-- ── RESUMEN DEL PEDIDO ─────────────────────────────── --}}
      @if (!empty($items))
        <aside class="carrito-summary" aria-label="Resumen del pedido">

          <h2 class="carrito-summary__title">Resumen del pedido</h2>

          <div class="carrito-summary__row">
            <span>Subtotal</span>
            <span>{{ number_format($subtotal, 2, ',', '.') }}&euro;</span>
          </div>

          <div class="carrito-summary__row">
            <span>Envío</span>
            <span>{{ $envio > 0 ? number_format($envio, 2, ',', '.') . '€' : 'Gratis' }}</span>
          </div>

          @if ($envio > 0)
            <p class="carrito-summary__shipping-free">
              <i class="fa-solid fa-truck-fast" aria-hidden="true"></i>
              Envío gratis a partir de 40,00&euro;
            </p>
          @endif

          <div class="carrito-summary__row carrito-summary__row--total">
            <span>Total</span>
            <span>{{ number_format($total, 2, ',', '.') }}&euro;</span>
          </div>

          <a href="{{ route('pedido.checkout') }}" class="carrito-summary__btn">
            <i class="fa-solid fa-lock" aria-hidden="true"></i>
            Proceder al pago
          </a>

          <p class="carrito-summary__disclaimer">
            <i class="fa-solid fa-shield-halved" aria-hidden="true"></i>
            Pago 100% seguro · SSL cifrado
          </p>

        </aside>
      @endif

    </div>
  </section>

  @include('partials.trust-certs')

@endsection
