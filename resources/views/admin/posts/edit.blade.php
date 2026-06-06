@extends('layouts.admin')

@section('title', 'Editar post — Admin Agrivall')
@section('page-title', 'Editar: ' . $post->titulo)

@section('content')

  <div class="admin-form-card">
    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      @include('admin.posts._form')

      <div class="admin-form-actions">
        <a href="{{ route('admin.posts.index') }}" class="admin-btn">Cancelar</a>
        <button type="submit" class="admin-btn admin-btn--primary">
          <i class="fa-solid fa-floppy-disk" aria-hidden="true"></i>
          Guardar cambios
        </button>
      </div>
    </form>
  </div>

@endsection
