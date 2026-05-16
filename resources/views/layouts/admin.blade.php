<!DOCTYPE html>
<html lang="es">
<head>
  @include('partials.head')
  <title>@yield('title', 'Panel Admin — Agrivall')</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin-panel.css') }}">
  @stack('styles')
</head>
<body class="admin-panel-body">

  {{-- ── SIDEBAR ─────────────────────────────────────────────── --}}
  <aside class="admin-sidebar" id="adminSidebar">
    <a href="{{ route('admin.dashboard') }}" class="admin-sidebar__logo">
      <img src="{{ asset('images/logo.png') }}" alt="Agrivall">
    </a>

    <nav class="admin-sidebar__nav" aria-label="Menú admin">
      <a href="{{ route('admin.dashboard') }}"
         class="admin-sidebar__link {{ request()->routeIs('admin.dashboard') ? 'admin-sidebar__link--active' : '' }}">
        <i class="fa-solid fa-gauge" aria-hidden="true"></i>
        Dashboard
      </a>
      <a href="{{ route('admin.productos.index') }}"
         class="admin-sidebar__link {{ request()->routeIs('admin.productos.*') ? 'admin-sidebar__link--active' : '' }}">
        <i class="fa-solid fa-box" aria-hidden="true"></i>
        Productos
      </a>
      <a href="{{ route('admin.pedidos.index') }}"
         class="admin-sidebar__link {{ request()->routeIs('admin.pedidos.*') ? 'admin-sidebar__link--active' : '' }}">
        <i class="fa-solid fa-receipt" aria-hidden="true"></i>
        Pedidos
      </a>
      <a href="{{ route('admin.posts.index') }}"
         class="admin-sidebar__link {{ request()->routeIs('admin.posts.*') ? 'admin-sidebar__link--active' : '' }}">
        <i class="fa-solid fa-newspaper" aria-hidden="true"></i>
        Blog
      </a>
      <a href="{{ route('admin.reservas.index') }}"
         class="admin-sidebar__link {{ request()->routeIs('admin.reservas.*') ? 'admin-sidebar__link--active' : '' }}">
        <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
        Reservas
      </a>
    </nav>

    <div class="admin-sidebar__footer">
      <span class="admin-sidebar__user">
        <i class="fa-solid fa-circle-user" aria-hidden="true"></i>
        {{ auth()->user()->name }}
      </span>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="admin-sidebar__logout">
          <i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i>
          Cerrar sesión
        </button>
      </form>
    </div>
  </aside>

  {{-- ── CONTENIDO PRINCIPAL ─────────────────────────────────── --}}
  <div class="admin-main">
    <header class="admin-topbar">
      <button class="admin-topbar__toggle" id="sidebarToggle" aria-label="Abrir/cerrar menú">
        <i class="fa-solid fa-bars" aria-hidden="true"></i>
      </button>
      <h1 class="admin-topbar__title">@yield('page-title', 'Dashboard')</h1>
    </header>

    <main class="admin-content">
      @yield('content')
    </main>
  </div>

  <script src="{{ asset('js/admin.js') }}" defer></script>
  @stack('scripts')

</body>
</html>
