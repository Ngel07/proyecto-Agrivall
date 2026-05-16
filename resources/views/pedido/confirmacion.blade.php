@extends('layouts.app')

@section('title', 'Pedido confirmado — Agrivall')
@section('body-class', 'page-checkout')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush

@section('content')

  {{-- ── CABECERA ─────────────────────────────────────────────── --}}
  <section class="prod-filters">
    @include('partials.breadcrumb', ['items' => [
      ['label' => 'Inicio', 'url' => route('home')],
      ['label' => 'Pedido confirmado'],
    ]])
    <div class="prod-header__text">
      <h1 class="prod-header__title">¡Pedido confirmado!</h1>
      <p class="prod-header__subtitle">Gracias por tu compra, {{ $pedido->nombre_cliente }}</p>
    </div>
  </section>

  {{-- ── PASOS ────────────────────────────────────────────────── --}}
  <div class="checkout-steps">
    <div class="checkout-step checkout-step--done">
      <div class="checkout-step__circle">
        <i class="fa-solid fa-check" aria-hidden="true"></i>
      </div>
      <span class="checkout-step__label">Carrito</span>
    </div>
    <div class="checkout-step checkout-step--done">
      <div class="checkout-step__circle">
        <i class="fa-solid fa-check" aria-hidden="true"></i>
      </div>
      <span class="checkout-step__label">Datos y pago</span>
    </div>
    <div class="checkout-step checkout-step--active">
      <div class="checkout-step__circle">3</div>
      <span class="checkout-step__label">Confirmación</span>
    </div>
  </div>

  {{-- ── CONTENIDO ───────────────────────────────────────────── --}}
  <section class="checkout-section">
    <div class="checkout-confirm-wrap">

      {{-- Icono de éxito --}}
      <div class="checkout-confirm__icon" aria-hidden="true">
        <i class="fa-solid fa-circle-check"></i>
      </div>

      <h2 class="checkout-confirm__title">Pedido #{{ $pedido->id }}</h2>
      <p class="checkout-confirm__sub">
        Hemos recibido tu pedido correctamente. En breve recibirás instrucciones de pago.
      </p>

      {{-- Resumen --}}
      <div class="checkout-confirm__card">

        <div class="checkout-confirm__row">
          <span>Fecha</span>
          <span>{{ $pedido->fecha_pedido->format('d/m/Y') }}</span>
        </div>

        <div class="checkout-confirm__row">
          <span>Nombre</span>
          <span>{{ $pedido->nombre_cliente }}</span>
        </div>

        @if ($pedido->tlf_cliente)
          <div class="checkout-confirm__row">
            <span>Teléfono</span>
            <span>{{ $pedido->tlf_cliente }}</span>
          </div>
        @endif

        @if ($pedido->email_cliente)
          <div class="checkout-confirm__row">
            <span>Email</span>
            <span>{{ $pedido->email_cliente }}</span>
          </div>
        @endif

        <div class="checkout-confirm__row">
          <span>Dirección de envío</span>
          <span>{{ $pedido->direccion_envio }}</span>
        </div>

        <div class="checkout-confirm__row">
          <span>Método de pago</span>
          <span>{{ $pedido->metodo_pago === 'bizum' ? 'Bizum' : 'Transferencia bancaria' }}</span>
        </div>

        {{-- Líneas del pedido --}}
        <div class="checkout-confirm__divider"></div>

        @foreach ($pedido->lineas as $linea)
          <div class="checkout-confirm__row">
            <span>
              {{ $linea->producto->nombre ?? '—' }}
              @if ($linea->formato)
                <small class="checkout-confirm__meta">{{ $linea->formato }}</small>
              @endif
              &times; {{ $linea->cantidad }}
            </span>
            <span>{{ number_format($linea->precio_unitario * $linea->cantidad, 2, ',', '.') }}&euro;</span>
          </div>
        @endforeach

        <div class="checkout-confirm__divider"></div>

        <div class="checkout-confirm__row checkout-confirm__row--total">
          <span>Total</span>
          <span>{{ number_format($pedido->precio_pedido, 2, ',', '.') }}&euro;</span>
        </div>

      </div>{{-- /.checkout-confirm__card --}}

      @if ($pedido->metodo_pago === 'transferencia')
        <div class="checkout-confirm__info">
          <i class="fa-solid fa-building-columns" aria-hidden="true"></i>
          <p>Recibirás los datos bancarios para realizar la transferencia. El pedido se procesará una vez confirmado el pago.</p>
        </div>
      @else
        <div class="checkout-confirm__info">
          <i class="fa-solid fa-mobile-screen-button" aria-hidden="true"></i>
          <p>Te contactaremos para facilitarte el número de Bizum al que realizar el pago.</p>
        </div>
      @endif

      <a href="{{ route('productos.index') }}" class="checkout-confirm__btn">
        <i class="fa-solid fa-leaf" aria-hidden="true"></i>
        Seguir comprando
      </a>

    </div>
  </section>

  @include('partials.trust-certs')

@endsection
