@extends('layouts.admin-auth')

@section('title', 'Acceso Admin — Agrivall')

@section('content')

<div class="admin-login">

  {{-- Fondo --}}
  <div class="admin-login__bg" aria-hidden="true"></div>

  {{-- Tarjeta --}}
  <div class="admin-login__card">

    {{-- Logo --}}
    <a href="{{ route('home') }}" class="admin-login__logo-link" tabindex="-1">
      <img src="{{ asset('images/logo.png') }}" alt="Agrivall" class="admin-login__logo">
    </a>

    <h1 class="admin-login__title">Panel de administración</h1>
    <p class="admin-login__subtitle">Accede con tu cuenta de administrador</p>

    {{-- Errores --}}
    @if ($errors->any())
      <div class="admin-login__alert" role="alert">
        <i class="fa-solid fa-circle-exclamation" aria-hidden="true"></i>
        {{ $errors->first() }}
      </div>
    @endif

    {{-- Formulario --}}
    <form class="admin-login__form" method="POST" action="{{ route('login') }}" novalidate>
      @csrf

      <div class="admin-login__group">
        <label class="admin-login__label" for="email">
          <i class="fa-solid fa-envelope" aria-hidden="true"></i>
          Correo electrónico
        </label>
        <input
          class="admin-login__input @error('email') is-invalid @enderror"
          type="email"
          id="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="admin@agrivall.com"
          autocomplete="email"
          autofocus
          required
        >
      </div>

      <div class="admin-login__group">
        <label class="admin-login__label" for="password">
          <i class="fa-solid fa-lock" aria-hidden="true"></i>
          Contraseña
        </label>
        <div class="admin-login__pass-wrap">
          <input
            class="admin-login__input"
            type="password"
            id="password"
            name="password"
            placeholder="••••••••"
            autocomplete="current-password"
            required
          >
          <button type="button" class="admin-login__eye" id="togglePass" aria-label="Mostrar/ocultar contraseña">
            <i class="fa-solid fa-eye" id="eyeIcon" aria-hidden="true"></i>
          </button>
        </div>
      </div>

      <button type="submit" class="admin-login__btn">
        <i class="fa-solid fa-right-to-bracket" aria-hidden="true"></i>
        Iniciar sesión
      </button>

    </form>

    <a href="{{ route('home') }}" class="admin-login__back">
      <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
      Volver al sitio
    </a>

  </div>{{-- /.admin-login__card --}}

</div>{{-- /.admin-login --}}

@endsection

@push('scripts')
  <script src="{{ asset('js/admin-login.js') }}"></script>
@endpush
