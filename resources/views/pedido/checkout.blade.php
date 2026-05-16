@extends('layouts.app')

@section('title', 'Checkout — Agrivall')
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
      ['label' => 'Carrito', 'url' => route('carrito.index')],
      ['label' => 'Finalizar pedido'],
    ]])
    <div class="prod-header__text">
      <h1 class="prod-header__title">Finalizar pedido</h1>
      <p class="prod-header__subtitle">
        <a href="{{ route('carrito.index') }}" style="color:inherit;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
          <i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Volver al carrito
        </a>
      </p>
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
    <div class="checkout-step checkout-step--active">
      <div class="checkout-step__circle">2</div>
      <span class="checkout-step__label">Datos y pago</span>
    </div>
    <div class="checkout-step">
      <div class="checkout-step__circle">3</div>
      <span class="checkout-step__label">Confirmación</span>
    </div>
  </div>

  {{-- ── SECCIÓN PRINCIPAL ──────────────────────────────────────── --}}
  <section class="checkout-section">
    <form method="POST" action="{{ route('pedido.confirmar') }}" novalidate>
      @csrf

      <div class="checkout-inner">

        {{-- ── ERRORES DE VALIDACIÓN ── --}}
        @if ($errors->any())
          <div class="checkout-errors" role="alert">
            <i class="fa-solid fa-circle-exclamation" aria-hidden="true"></i>
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        {{-- ── COLUMNA FORMULARIO ── --}}
        <div class="checkout-form-col">

          {{-- ── DATOS DE ENVÍO ── --}}
          <div class="checkout-block">
            <h2 class="checkout-block__title">
              <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
              Datos de envío
            </h2>

            <div class="checkout-grid checkout-grid--2">

              <div class="checkout-field">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Juan" autocomplete="given-name">
              </div>

              <div class="checkout-field">
                <label for="apellidos">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" placeholder="García López" autocomplete="family-name">
              </div>

              <div class="checkout-field checkout-grid--col-span-2">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" placeholder="Calle Mayor, 14, 2ºA" autocomplete="street-address">
              </div>

              <div class="checkout-field">
                <label for="cp">Código postal</label>
                <input type="text" id="cp" name="cp" value="{{ old('cp') }}" placeholder="28001" autocomplete="postal-code" maxlength="5">
              </div>

              <div class="checkout-field">
                <label for="localidad">Localidad</label>
                <input type="text" id="localidad" name="localidad" value="{{ old('localidad') }}" placeholder="Madrid" autocomplete="address-level2">
              </div>

              <div class="checkout-field">
                <label for="provincia">Provincia</label>
                <select id="provincia" name="provincia" autocomplete="address-level1">
                  <option value="" disabled selected>Selecciona...</option>
                  <option>Álava</option>
                  <option>Albacete</option>
                  <option>Alicante</option>
                  <option>Almería</option>
                  <option>Asturias</option>
                  <option>Ávila</option>
                  <option>Badajoz</option>
                  <option>Baleares</option>
                  <option>Barcelona</option>
                  <option>Burgos</option>
                  <option>Cáceres</option>
                  <option>Cádiz</option>
                  <option>Cantabria</option>
                  <option>Castellón</option>
                  <option>Ciudad Real</option>
                  <option>Córdoba</option>
                  <option>Cuenca</option>
                  <option>Girona</option>
                  <option>Granada</option>
                  <option>Guadalajara</option>
                  <option>Guipúzcoa</option>
                  <option>Huelva</option>
                  <option>Huesca</option>
                  <option>Jaén</option>
                  <option>La Coruña</option>
                  <option>La Rioja</option>
                  <option>Las Palmas</option>
                  <option>León</option>
                  <option>Lleida</option>
                  <option>Lugo</option>
                  <option>Madrid</option>
                  <option>Málaga</option>
                  <option>Murcia</option>
                  <option>Navarra</option>
                  <option>Ourense</option>
                  <option>Palencia</option>
                  <option>Pontevedra</option>
                  <option>Salamanca</option>
                  <option>Santa Cruz de Tenerife</option>
                  <option>Segovia</option>
                  <option>Sevilla</option>
                  <option>Soria</option>
                  <option>Tarragona</option>
                  <option>Teruel</option>
                  <option>Toledo</option>
                  <option>Valencia</option>
                  <option>Valladolid</option>
                  <option>Vizcaya</option>
                  <option>Zamora</option>
                  <option>Zaragoza</option>
                </select>
              </div>

              <div class="checkout-field">
                <label for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}" placeholder="612 345 678" autocomplete="tel">
              </div>

              <div class="checkout-field checkout-grid--col-span-2">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="juan@ejemplo.com" autocomplete="email">
              </div>

              <div class="checkout-field checkout-grid--col-span-2">
                <label for="notas">Notas del pedido <span style="font-weight:400;text-transform:none;">(opcional)</span></label>
                <input type="text" id="notas" name="notas" value="{{ old('notas') }}" placeholder="Instrucciones especiales, horario de entrega...">
              </div>

            </div>
          </div>{{-- /.checkout-block --}}

          {{-- ── MÉTODO DE PAGO ── --}}
          <div class="checkout-block">
            <h2 class="checkout-block__title">
              <i class="fa-solid fa-credit-card" aria-hidden="true"></i>
              Método de pago
            </h2>

            <div class="checkout-payment-options" role="radiogroup" aria-label="Selecciona un método de pago">

              {{-- Transferencia bancaria --}}
              <label class="checkout-payment-option">
                <input type="radio" name="metodo_pago" value="transferencia" checked>
                <span class="checkout-payment-option__radio" aria-hidden="true"></span>
                <span class="checkout-payment-option__icon" aria-hidden="true">
                  <i class="fa-solid fa-building-columns"></i>
                </span>
                <span class="checkout-payment-option__info">
                  <span class="checkout-payment-option__name">Transferencia bancaria</span>
                  <span class="checkout-payment-option__desc">
                    Recibirás los datos bancarios por correo electrónico tras confirmar el pedido.
                  </span>
                </span>
              </label>

              {{-- Bizum --}}
              <label class="checkout-payment-option">
                <input type="radio" name="metodo_pago" value="bizum">
                <span class="checkout-payment-option__radio" aria-hidden="true"></span>
                <span class="checkout-payment-option__icon" aria-hidden="true">
                  <i class="fa-solid fa-mobile-screen-button"></i>
                </span>
                <span class="checkout-payment-option__info">
                  <span class="checkout-payment-option__name">Bizum</span>
                  <span class="checkout-payment-option__desc">
                    Realiza el pago directamente desde tu app bancaria con Bizum.
                  </span>
                </span>
              </label>

            </div>
          </div>{{-- /.checkout-block --}}

        </div>{{-- /.checkout-form-col --}}

        {{-- ── RESUMEN LATERAL ── --}}
        <aside class="checkout-summary" aria-label="Resumen del pedido">

          <h2 class="checkout-summary__title">Tu pedido</h2>

          <ul class="checkout-summary__items" role="list">
            @foreach ($items as $item)
              <li class="checkout-summary__item">
                <div class="checkout-summary__item-img">
                  <img src="{{ asset($item['imagen']) }}" alt="{{ $item['nombre'] }}" loading="lazy">
                </div>
                <div class="checkout-summary__item-name">
                  {{ $item['nombre'] }}
                  <span class="checkout-summary__item-qty">
                    {{ $item['formato'] }} &times; {{ $item['cantidad'] }}
                  </span>
                </div>
                <span class="checkout-summary__item-price">
                  {{ number_format($item['precio'] * $item['cantidad'], 2, ',', '.') }}&euro;
                </span>
              </li>
            @endforeach
          </ul>

          <div class="checkout-summary__row">
            <span>Subtotal</span>
            <span>{{ number_format($subtotal, 2, ',', '.') }}&euro;</span>
          </div>

          <div class="checkout-summary__row">
            <span>Envío</span>
            <span>{{ $envio > 0 ? number_format($envio, 2, ',', '.') . '€' : 'Gratis' }}</span>
          </div>

          <div class="checkout-summary__row checkout-summary__row--total">
            <span>Total</span>
            <span>{{ number_format($total, 2, ',', '.') }}&euro;</span>
          </div>

          <button type="submit" class="checkout-summary__btn">
            <i class="fa-solid fa-check" aria-hidden="true"></i>
            Confirmar pedido
          </button>

          <p class="checkout-summary__secure">
            <i class="fa-solid fa-shield-halved" aria-hidden="true"></i>
            Pago seguro · Datos protegidos
          </p>

        </aside>

      </div>{{-- /.checkout-inner --}}
    </form>
  </section>

  @include('partials.trust-certs')

@endsection
