<!DOCTYPE html>
<html lang="es">
<head>
  @include('partials.head')
  <title>@yield('title', 'Agrivall — Naturaleza certificada, sabor inigualable')</title>
  @stack('styles')
</head>
<body class="@yield('body-class')">

  @include('partials.navbar')

  <main>
    @yield('content')
  </main>

  @include('partials.footer')

  <script src="{{ asset('js/navbar.js') }}"></script>
  @stack('scripts')

</body>
</html>
