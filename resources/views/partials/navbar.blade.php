<!-- NAVBAR -->
<header class="navbar">
  <a href="{{ route('home') }}" class="navbar-logo">
    <img class="navbar-logo-icon" src="{{ asset('images/logo.png') }}" alt="logo Agrivall" aria-hidden="true">
  </a>

  <nav class="navbar__nav" id="navMenu" role="navigation" aria-label="Navegación principal">
    <a href="{{ route('productos.index') }}" class="navbar__link">Productos</a>
    <a href="{{ route('casilla.index') }}" class="navbar__link">Reserva</a>
    <a href="{{ route('blog.index') }}" class="navbar__link">Blog</a>
    <a href="{{ route('conocenos.index') }}" class="navbar__link">Conócenos</a>
    <a href="{{ route('contacto.index') }}" class="navbar__link">Contacto</a>

    {{-- Login / Admin visible solo en mobile --}}
    @auth
      @if(auth()->user()->is_admin)
        <a href="{{ route('admin.dashboard') }}" class="navbar__link navbar__link--login">
          <i class="fa-solid fa-user" aria-hidden="true"></i>
          Admin
        </a>
      @endif
    @else
      <a href="{{ route('login') }}" class="navbar__link navbar__link--login">
        <i class="fa-solid fa-user" aria-hidden="true"></i>
        Login
      </a>
    @endauth
  </nav>

  <div class="navbar__actions">

    {{-- Icono carrito --}}
    @php $carritoCount = collect(session('carrito', []))->sum('cantidad'); @endphp
    <a href="{{ route('carrito.index') }}" class="navbar__cart" aria-label="Ver carrito ({{ $carritoCount }} artículos)">
      <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
      @if ($carritoCount > 0)
        <span class="navbar__cart-badge">{{ $carritoCount }}</span>
      @endif
    </a>

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
