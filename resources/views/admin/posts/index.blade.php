@extends('layouts.admin')

@section('title', 'Posts — Admin Agrivall')
@section('page-title', 'Posts del Blog')

@section('content')

  @if (session('success'))
    <div class="admin-alert admin-alert--success">
      <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
      {{ session('success') }}
    </div>
  @endif

  <div class="admin-page-header">
    <p class="admin-page-header__count">{{ $posts->total() }} posts en total</p>
    <a href="{{ route('admin.posts.create') }}" class="admin-btn admin-btn--primary">
      <i class="fa-solid fa-plus" aria-hidden="true"></i>
      Nuevo post
    </a>
  </div>

  <div class="admin-table-wrap">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Imagen</th>
          <th>Título</th>
          <th>Categoría</th>
          <th>Fecha</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($posts as $post)
          <tr>
            <td>
              <img
                src="{{ asset('images/' . ($post->imagen ?? 'bg-frutas.png')) }}"
                alt="{{ $post->titulo }}"
                class="admin-table__thumb"
              >
            </td>
            <td class="admin-table__name">{{ $post->titulo }}</td>
            <td>
              <span class="admin-badge admin-badge--green">{{ $post->tipo->tipo }}</span>
            </td>
            <td>{{ $post->fecha_public->format('d/m/Y') }}</td>
            <td class="admin-table__actions">
              <a href="{{ route('admin.posts.edit', $post) }}" class="admin-btn admin-btn--sm">
                <i class="fa-solid fa-pen" aria-hidden="true"></i>
                Editar
              </a>
              <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                    onsubmit="return confirm('¿Eliminar «{{ $post->titulo }}»?')">
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
            <td colspan="5" class="admin-table__empty">
              No hay posts todavía.
              <a href="{{ route('admin.posts.create') }}">Crea el primero</a>.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="admin-pagination">
    {{ $posts->links() }}
  </div>

@endsection
