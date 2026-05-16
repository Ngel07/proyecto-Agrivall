@extends('layouts.admin')

@section('title', 'Nuevo producto — Admin Agrivall')
@section('page-title', 'Nuevo producto')

@section('content')

  <div class="admin-form-card">
    <form method="POST" action="{{ route('admin.productos.store') }}" enctype="multipart/form-data">
      @csrf

      @include('admin.productos._form')

      <div class="admin-form-actions">
        <a href="{{ route('admin.productos.index') }}" class="admin-btn">Cancelar</a>
        <button type="submit" class="admin-btn admin-btn--primary">
          <i class="fa-solid fa-floppy-disk" aria-hidden="true"></i>
          Guardar producto
        </button>
      </div>
    </form>
  </div>

@endsection
