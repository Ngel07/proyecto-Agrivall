<!-- NAVBAR -->
<header class="navbar">
  <a href="{{ route('home') }}" class="navbar-logo">
    <img class="navbar-logo-icon" src="{{ asset('images/logo.png') }}" alt="logo Agrivall" aria-hidden="true">
  </a>

  <nav class="navbar__nav" id="navMenu" role="navigation" aria-label="Navegación principal">
    <a href="{{ route('productos.index') }}" class="navbar__link">Productos</a>
    <a href="{{ route('casilla.index') }}" class="navbar__link">Reserva</a>
    <a href="{{ route('blog.index') }}" class="navbar__link">Blog</a>
  </nav>

  <div class="navbar__actions">
    @auth
      @if(auth()->user()->is_admin)
        <a href="{{ route('admin.dashboard') }}" class="navbar__login" aria-label="Panel de administración">
          <i class="fa-solid fa-user" aria-hidden="true"></i>
          Admin
        </a>
      @endif
    @else
      <a href="{{ route('login') }}" class="navbar__login" aria-label="Iniciar sesión">
        <i class="fa-solid fa-user" aria-hidden="true"></i>
        Login
      </a>
    @endauth

    <!-- Hamburger (mobile) -->
    <button class="navbar__hamburger" id="hamburgerBtn" aria-label="Abrir menú" aria-expanded="false" aria-controls="navMenu">
      <i class="fa-solid fa-bars" aria-hidden="true"></i>
    </button>
  </div>
</header>
