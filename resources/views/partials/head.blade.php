<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="description" content="@yield('description', 'Agrivall — Productos ecológicos certificados del Valle de Gallinera. Cerezas, albaricoques, nueces y hierbas directas del productor.')" />
<link rel="canonical" href="{{ url()->current() }}" />
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
{{-- Open Graph --}}
<meta property="og:type"        content="website" />
<meta property="og:site_name"   content="Agrivall" />
<meta property="og:title"       content="@yield('title', 'Agrivall — Naturaleza certificada, sabor inigualable')" />
<meta property="og:description" content="@yield('description', 'Agrivall — Productos ecológicos certificados del Valle de Gallinera. Cerezas, albaricoques, nueces y hierbas directas del productor.')" />
<meta property="og:url"         content="{{ url()->current() }}" />
<meta property="og:image"       content="{{ asset('images/bg-frutas.png') }}" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
