@extends('layouts.admin')

@section('title', 'Editar producto — Admin Agrivall')
@section('page-title', 'Editar: ' . $producto->nombre)

@section('content')

  <div class="admin-form-card">
    <form method="POST" action="{{ route('admin.productos.update', $producto) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      @include('admin.productos._form')

      <div class="admin-form-actions">
        <a href="{{ route('admin.productos.index') }}" class="admin-btn">Cancelar</a>
        <button type="submit" class="admin-btn admin-btn--primary">
          <i class="fa-solid fa-floppy-disk" aria-hidden="true"></i>
          Guardar cambios
        </button>
      </div>
    </form>
  </div>

@endsection
