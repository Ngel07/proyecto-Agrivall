@extends('layouts.admin')

@section('title', 'Pedidos — Admin Agrivall')
@section('page-title', 'Pedidos')

@section('content')

  @if (session('success'))
    <div class="admin-alert admin-alert--success">
      <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
      {{ session('success') }}
    </div>
  @endif

  {{-- Filtro por estado --}}
  <form method="GET" action="{{ route('admin.pedidos.index') }}" class="admin-filter-bar">
    <select name="estado" onchange="this.form.submit()" class="admin-filter-select">
      <option value="">Todos los estados</option>
      @foreach (['pendiente', 'enviado', 'entregado'] as $est)
        <option value="{{ $est }}" {{ request('estado') === $est ? 'selected' : '' }}>
          {{ ucfirst($est) }}
        </option>
      @endforeach
    </select>
    @if (request('estado'))
      <a href="{{ route('admin.pedidos.index') }}" class="admin-btn admin-btn--sm">
        <i class="fa-solid fa-xmark" aria-hidden="true"></i> Limpiar
      </a>
    @endif
  </form>

  <div class="admin-page-header">
    <p class="admin-page-header__count">{{ $pedidos->total() }} pedidos</p>
  </div>

  <div class="admin-table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Fecha</th>
          <th>Cliente</th>
          <th>Email</th>
          <th>Total</th>
          <th>Pago</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($pedidos as $pedido)
          <tr>
            <td>{{ $pedido->id }}</td>
            <td>{{ $pedido->fecha_pedido->format('d/m/Y') }}</td>
            <td class="admin-table__name">{{ $pedido->nombre_cliente }}</td>
            <td>{{ $pedido->email_cliente }}</td>
            <td>{{ number_format($pedido->precio_pedido, 2, ',', '.') }}&euro;</td>
            <td>{{ ucfirst($pedido->metodo_pago) }}</td>
            <td>
              @php
                $badgeClass = match($pedido->estado) {
                  'enviado'   => 'admin-badge--blue',
                  'entregado' => 'admin-badge--green',
                  default     => 'admin-badge--orange',
                };
              @endphp
              <span class="admin-badge {{ $badgeClass }}">{{ ucfirst($pedido->estado) }}</span>
            </td>
            <td>
              <a href="{{ route('admin.pedidos.show', $pedido) }}" class="admin-btn admin-btn--sm">
                <i class="fa-solid fa-eye" aria-hidden="true"></i>
                Ver
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="admin-table__empty">No hay pedidos todavía.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if ($pedidos->hasPages())
    <div class="admin-pagination">
      {{ $pedidos->appends(request()->query())->links() }}
    </div>
  @endif

@endsection
