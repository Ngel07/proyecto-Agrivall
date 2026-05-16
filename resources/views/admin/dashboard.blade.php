@extends('layouts.admin')

@section('title', 'Dashboard — Agrivall Admin')
@section('page-title', 'Dashboard')

@section('content')

  <div class="admin-dash-grid">

    <a href="{{ route('admin.productos.index') }}" class="admin-dash-card">
      <div class="admin-dash-card__icon">
        <i class="fa-solid fa-box" aria-hidden="true"></i>
      </div>
      <div class="admin-dash-card__body">
        <span class="admin-dash-card__label">Productos</span>
        <span class="admin-dash-card__sub">Gestionar catálogo</span>
      </div>
      <i class="fa-solid fa-chevron-right admin-dash-card__arrow" aria-hidden="true"></i>
    </a>

    <a href="{{ route('admin.pedidos.index') }}" class="admin-dash-card">
      <div class="admin-dash-card__icon">
        <i class="fa-solid fa-receipt" aria-hidden="true"></i>
      </div>
      <div class="admin-dash-card__body">
        <span class="admin-dash-card__label">Pedidos</span>
        <span class="admin-dash-card__sub">Ver y gestionar pedidos</span>
      </div>
      <i class="fa-solid fa-chevron-right admin-dash-card__arrow" aria-hidden="true"></i>
    </a>

    <a href="{{ route('admin.posts.index') }}" class="admin-dash-card">
      <div class="admin-dash-card__icon">
        <i class="fa-solid fa-newspaper" aria-hidden="true"></i>
      </div>
      <div class="admin-dash-card__body">
        <span class="admin-dash-card__label">Blog</span>
        <span class="admin-dash-card__sub">Publicar y editar posts</span>
      </div>
      <i class="fa-solid fa-chevron-right admin-dash-card__arrow" aria-hidden="true"></i>
    </a>

    <a href="{{ route('admin.reservas.index') }}" class="admin-dash-card">
      <div class="admin-dash-card__icon">
        <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
      </div>
      <div class="admin-dash-card__body">
        <span class="admin-dash-card__label">Reservas casilla</span>
        <span class="admin-dash-card__sub">Gestionar semanas disponibles</span>
      </div>
      <i class="fa-solid fa-chevron-right admin-dash-card__arrow" aria-hidden="true"></i>
    </a>

  </div>

@endsection
