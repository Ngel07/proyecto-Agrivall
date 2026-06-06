@extends('layouts.admin')

@section('title', 'Nuevo post — Admin Agrivall')
@section('page-title', 'Nuevo post')

@section('content')

  <div class="admin-form-card">
    <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
      @csrf

      @include('admin.posts._form')

      <div class="admin-form-actions">
        <a href="{{ route('admin.posts.index') }}" class="admin-btn">Cancelar</a>
        <button type="submit" class="admin-btn admin-btn--primary">
          <i class="fa-solid fa-floppy-disk" aria-hidden="true"></i>
          Guardar post
        </button>
      </div>
    </form>
  </div>

@endsection
