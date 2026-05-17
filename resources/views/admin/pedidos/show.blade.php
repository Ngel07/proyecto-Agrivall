@extends('layouts.admin')

@section('title', 'Pedido #' . $pedido->id . ' — Admin Agrivall')
@section('page-title', 'Pedido #' . $pedido->id)

@section('content')

  @if (session('success'))
    <div class="admin-alert admin-alert--success">
      <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
      {{ session('success') }}
    </div>
  @endif

  <div class="admin-page-header">
    <a href="{{ route('admin.pedidos.index') }}" class="admin-btn admin-btn--sm">
      <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
      Volver
    </a>
  </div>

  <div class="admin-pedido-grid">

    {{-- Datos del cliente --}}
    <div class="admin-form-card">
      <h2 class="admin-card-title">
        <i class="fa-solid fa-user" aria-hidden="true"></i> Cliente
      </h2>
      <dl class="admin-dl">
        <dt>Nombre</dt>
        <dd>{{ $pedido->nombre_cliente }}</dd>
        <dt>Teléfono</dt>
        <dd>{{ $pedido->tlf_cliente ?? '—' }}</dd>
        <dt>Email</dt>
        <dd>{{ $pedido->email_cliente }}</dd>
        <dt>Dirección</dt>
        <dd>{{ $pedido->direccion_envio }}</dd>
        <dt>Método de pago</dt>
        <dd>{{ ucfirst($pedido->metodo_pago) }}</dd>
        <dt>Fecha</dt>
        <dd>{{ $pedido->fecha_pedido->format('d/m/Y') }}</dd>
      </dl>
    </div>

    {{-- Cambio de estado --}}
    <div class="admin-form-card">
      <h2 class="admin-card-title">
        <i class="fa-solid fa-truck" aria-hidden="true"></i> Estado del pedido
      </h2>
      <p class="admin-estado-actual">
        Estado actual:
        @php
          $badgeClass = match($pedido->estado) {
            'enviado'   => 'admin-badge--blue',
            'entregado' => 'admin-badge--green',
            default     => 'admin-badge--orange',
          };
        @endphp
        <span class="admin-badge {{ $badgeClass }}">{{ ucfirst($pedido->estado) }}</span>
      </p>
      <form method="POST" action="{{ route('admin.pedidos.updateEstado', $pedido) }}" class="admin-estado-form">
        @csrf
        @method('PATCH')
        <div class="admin-form-field">
          <label for="estado">Cambiar a</label>
          <select name="estado" id="estado">
            @foreach ($estados as $est)
              <option value="{{ $est }}" {{ $pedido->estado === $est ? 'selected' : '' }}>
                {{ ucfirst($est) }}
              </option>
            @endforeach
          </select>
          @error('estado') <span class="admin-form-error">{{ $message }}</span> @enderror
        </div>
        <div class="admin-form-actions" style="border-top:none; padding-top:12px;">
          <button type="submit" class="admin-btn admin-btn--primary">
            <i class="fa-solid fa-floppy-disk" aria-hidden="true"></i>
            Guardar estado
          </button>
        </div>
      </form>
    </div>

  </div>

  {{-- Líneas del pedido --}}
  <div class="admin-table-wrap" style="margin-top:24px;">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Imagen</th>
          <th>Producto</th>
          <th>Formato</th>
          <th>Precio ud.</th>
          <th>Cantidad</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pedido->lineas as $linea)
          <tr>
            <td>
              <img
                src="{{ asset($linea->producto->imagen ?? 'images/cereza-default.png') }}"
                alt="{{ $linea->producto->nombre ?? '' }}"
                class="admin-table__thumb"
              >
            </td>
            <td class="admin-table__name">{{ $linea->producto->nombre ?? '(eliminado)' }}</td>
            <td>{{ $linea->formato ?? '—' }}</td>
            <td>{{ number_format($linea->precio_unitario, 2, ',', '.') }}&euro;</td>
            <td>{{ $linea->cantidad }}</td>
            <td>{{ number_format($linea->precio_unitario * $linea->cantidad, 2, ',', '.') }}&euro;</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5" style="text-align:right; font-weight:700; padding:12px 16px;">TOTAL</td>
          <td style="font-weight:700; padding:12px 16px;">
            {{ number_format($pedido->precio_pedido, 2, ',', '.') }}&euro;
          </td>
        </tr>
      </tfoot>
    </table>
  </div>

@endsection
