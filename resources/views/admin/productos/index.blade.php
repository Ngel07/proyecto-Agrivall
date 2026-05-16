@extends('layouts.admin')

@section('title', 'Productos — Admin Agrivall')
@section('page-title', 'Productos')

@section('content')

  @if (session('success'))
    <div class="admin-alert admin-alert--success">
      <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
      {{ session('success') }}
    </div>
  @endif

  <div class="admin-page-header">
    <p class="admin-page-header__count">{{ $productos->total() }} productos en total</p>
    <a href="{{ route('admin.productos.create') }}" class="admin-btn admin-btn--primary">
      <i class="fa-solid fa-plus" aria-hidden="true"></i>
      Nuevo producto
    </a>
  </div>

  <div class="admin-table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Imagen</th>
          <th>Nombre</th>
          <th>Variedad</th>
          <th>Formato</th>
          <th>Precio</th>
          <th>Disponible</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($productos as $producto)
          <tr>
            <td>
              <img
                src="{{ asset($producto->imagen ?? 'images/cereza-default.png') }}"
                alt="{{ $producto->nombre }}"
                class="admin-table__thumb"
              >
            </td>
            <td class="admin-table__name">{{ $producto->nombre }}</td>
            <td>{{ $producto->variedad ?? '—' }}</td>
            <td>{{ $producto->formato ?? '—' }}</td>
            <td>{{ number_format($producto->precio, 2, ',', '.') }}&euro;</td>
            <td>
              <span class="admin-badge {{ $producto->disponible ? 'admin-badge--green' : 'admin-badge--gray' }}">
                {{ $producto->disponible ? 'Sí' : 'No' }}
              </span>
            </td>
            <td class="admin-table__actions">
              <a href="{{ route('admin.productos.edit', $producto) }}" class="admin-btn admin-btn--sm">
                <i class="fa-solid fa-pen" aria-hidden="true"></i>
                Editar
              </a>
              <form method="POST" action="{{ route('admin.productos.destroy', $producto) }}"
                    onsubmit="return confirm('¿Eliminar «{{ $producto->nombre }}»?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="admin-btn admin-btn--sm admin-btn--danger">
                  <i class="fa-solid fa-trash" aria-hidden="true"></i>
                  Eliminar
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="admin-table__empty">
              No hay productos todavía.
              <a href="{{ route('admin.productos.create') }}">Crea el primero</a>.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if ($productos->hasPages())
    <div class="admin-pagination">
      {{ $productos->links() }}
    </div>
  @endif

@endsection
