@extends('layouts.app')

@section('title', 'Blog — Agrivall')
@section('body-class', 'page-blog')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
@endpush

@section('content')

@php
$categorias = ['Noticias', 'Consejos', 'Recetas'];

$posts = [
  [
    'titulo'   => 'Temporada de cerezas: todo lo que necesitas saber',
    'extracto' => 'Las cerezas ecológicas de Agrivall maduran bajo el sol de primavera y llegan directas del árbol a tu mesa. Descubre cuándo es el mejor momento para comprarlas, cómo conservarlas y por qué son tan especiales las variedades que cultivamos.',
    'fecha'    => '2 may. 2026',
    'tipo'     => 'Noticias',
    'imagen'   => 'bg-frutas.png',
    'featured' => true,
  ],
  [
    'titulo'   => 'Los beneficios de la agricultura ecológica para tu salud',
    'extracto' => 'Cada vez más estudios confirman que los productos cultivados sin pesticidas aportan más nutrientes y menos residuos químicos. Te explicamos qué dice la ciencia.',
    'fecha'    => '18 abr. 2026',
    'tipo'     => 'Noticias',
    'imagen'   => 'bg-productos.png',
    'featured' => false,
  ],
  [
    'titulo'   => 'Cómo conservar las nueces durante todo el invierno',
    'extracto' => 'La nuez ecológica es uno de los frutos secos más saludables, pero requiere ciertas condiciones de almacenamiento para no perder sus propiedades. Sigue estos consejos.',
    'fecha'    => '5 abr. 2026',
    'tipo'     => 'Consejos',
    'imagen'   => 'bg-frutas.png',
    'featured' => false,
  ],
  [
    'titulo'   => '5 recetas fáciles con albaricoques de temporada',
    'extracto' => 'El albaricoque ecológico es versátil en la cocina: mermeladas, tartas, salsas y ensaladas. Te proponemos cinco recetas sencillas para aprovechar la temporada.',
    'fecha'    => '22 mar. 2026',
    'tipo'     => 'Recetas',
    'imagen'   => 'bg-productos.png',
    'featured' => false,
  ],
  [
    'titulo'   => 'Qué significa el sello CAAE y por qué importa',
    'extracto' => 'La certificación ecológica no es un simple logotipo: implica años de trabajo, controles rigurosos y un compromiso con el medio ambiente. Te explicamos el proceso.',
    'fecha'    => '10 mar. 2026',
    'tipo'     => 'Noticias',
    'imagen'   => 'bg-frutas.png',
    'featured' => false,
  ],
  [
    'titulo'   => 'Hierbas aromáticas ecológicas: propiedades y usos en cocina',
    'extracto' => 'Tomillo, romero, orégano… las hierbas aromáticas que crecen en nuestros campos tienen usos medicinales y culinarios sorprendentes. Aprende a sacarles el máximo partido.',
    'fecha'    => '28 feb. 2026',
    'tipo'     => 'Consejos',
    'imagen'   => 'bg-productos.png',
    'featured' => false,
  ],
];
@endphp

  {{-- ── CABECERA ─────────────────────────────────────────────── --}}
  <section class="prod-filters">
    @include('partials.breadcrumb', ['items' => [
      ['label' => 'Inicio', 'url' => route('home')],
      ['label' => 'Blog'],
    ]])
    <div class="prod-header__text">
      <h1 class="prod-header__title">Blog</h1>
      <p class="prod-header__subtitle">
        Noticias, consejos y curiosidades sobre agricultura ecológica
      </p>
    </div>

    <form class="prod-filters__form" method="GET" action="{{ route('blog.index') }}">
      <div class="prod-filters__selects">
        <div class="prod-filters__group">
          <label for="f-categoria" class="sr-only">Categoría</label>
          <div class="prod-filters__select-wrap">
            <select id="f-categoria" name="categoria" class="prod-filters__select">
              <option value="">Categoría</option>
              @foreach ($categorias as $cat)
                <option value="{{ $cat }}">{{ $cat }}</option>
              @endforeach
            </select>
            <i class="fa-solid fa-chevron-down prod-filters__arrow" aria-hidden="true"></i>
          </div>
        </div>
      </div>

      <button type="submit" class="prod-filters__btn">
        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        <span>BUSCAR</span>
      </button>
    </form>
  </section>

  {{-- ── GRID DE POSTS ────────────────────────────────────────── --}}
  <section class="blog-section">
    <ul class="blog-grid" role="list">

      @foreach ($posts as $post)
        <li class="blog-card {{ $post['featured'] ? 'blog-card--featured' : '' }}">

          {{-- Imagen --}}
          <a href="{{ route('blog.show', 1) }}" class="blog-card__img-link" tabindex="-1" aria-hidden="true">
            <div class="blog-card__img-wrap">
              <img
                src="{{ asset('images/' . $post['imagen']) }}"
                alt="{{ $post['titulo'] }}"
                class="blog-card__img"
                loading="lazy"
              >
              <span class="blog-card__badge">{{ $post['tipo'] }}</span>
            </div>
          </a>

          {{-- Cuerpo --}}
          <div class="blog-card__body">
            <span class="blog-card__date">
              <i class="fa-regular fa-calendar" aria-hidden="true"></i>
              {{ $post['fecha'] }}
            </span>
            <a href="{{ route('blog.show', 1) }}" class="blog-card__title">
              {{ $post['titulo'] }}
            </a>
            <p class="blog-card__excerpt">{{ $post['extracto'] }}</p>
            <a href="{{ route('blog.show', 1) }}" class="blog-card__btn">
              <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
              Leer más
            </a>
          </div>

        </li>
      @endforeach

    </ul>
  </section>

  @include('partials.trust-certs')

@endsection
