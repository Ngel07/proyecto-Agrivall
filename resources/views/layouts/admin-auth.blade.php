<!DOCTYPE html>
<html lang="es">
<head>
  @include('partials.head')
  <title>@yield('title', 'Admin — Agrivall')</title>
  <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
  @stack('styles')
</head>
<body class="admin-login-body">
  @yield('content')
</body>
</html>
