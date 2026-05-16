<!DOCTYPE html>
<html lang="es">
<head>
  @include('partials.head')
  <title>@yield('title', 'Agrivall — Naturaleza certificada, sabor inigualable')</title>
  @stack('styles')
</head>
<body class="@yield('body-class')">

  @include('partials.navbar')

  @if (session('carrito_ok'))
    <div class="flash-carrito" role="alert" id="flashCarrito">
      <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
      {{ session('carrito_ok') }}
    </div>
  @endif

  <main>
    @yield('content')
  </main>

  @include('partials.footer')

  <script src="{{ asset('js/navbar.js') }}"></script>
  @if (session('carrito_ok'))
  <script>
    (function () {
      var el = document.getElementById('flashCarrito');
      if (el) { setTimeout(function () { el.style.opacity = '0'; setTimeout(function () { el.remove(); }, 400); }, 3000); }
    })();
  </script>
  @endif
  @stack('scripts')

</body>
</html>
