<!DOCTYPE html>
<html lang="es">
<head>
  @include('partials.head')
  <title>@yield('title', 'Agrivall — Naturaleza certificada, sabor inigualable')</title>
</head>
<body>

  @include('partials.navbar')

  <main>
    @yield('content')
  </main>

  <script src="{{ asset('js/navbar.js') }}"></script>
  @stack('scripts')

</body>
</html>
