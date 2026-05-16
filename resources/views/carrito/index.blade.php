@extends('layouts.app')

@section('title', 'Carrito — Agrivall')
@section('body-class', 'page-carrito')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/carrito.css') }}">
@endpush

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
                <form
                  method="POST"
                  action="{{ route('carrito.actualizar', $item['id']) }}"
                  class="carrito-item__qty"
                >
                  @csrf
                  @method('PATCH')
                  <button type="button" class="carrito-item__qty-btn js-qty-dec" aria-label="Reducir cantidad">−</button>
                  <input
                    type="number"
                    name="cantidad"
                    class="carrito-item__qty-input"
                    value="{{ $item['cantidad'] }}"
                    min="1"
                    max="99"
                    aria-label="Cantidad de {{ $item['nombre'] }}"
                  >
                  <button type="button" class="carrito-item__qty-btn js-qty-inc" aria-label="Aumentar cantidad">+</button>
                </form>

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

@push('scripts')
<script>
  document.querySelectorAll('.carrito-item__qty').forEach(function (form) {
    var input = form.querySelector('.carrito-item__qty-input');
    var dec   = form.querySelector('.js-qty-dec');
    var inc   = form.querySelector('.js-qty-inc');

    dec.addEventListener('click', function () {
      var val = parseInt(input.value, 10);
      if (val > 1) { input.value = val - 1; form.submit(); }
    });

    inc.addEventListener('click', function () {
      var val = parseInt(input.value, 10);
      if (val < 99) { input.value = val + 1; form.submit(); }
    });

    input.addEventListener('change', function () {
      var val = parseInt(input.value, 10);
      if (val >= 1 && val <= 99) { form.submit(); }
    });
  });
</script>
@endpush
