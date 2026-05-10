@extends('layouts.app')

@section('title', 'Temporada de cerezas — Blog Agrivall')
@section('body-class', 'page-blog')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
@endpush

@php
$post = [
  'titulo'    => 'Temporada de cerezas: todo lo que necesitas saber',
  'tipo'      => 'Noticias',
  'fecha'     => '2 de mayo de 2026',
  'imagen'    => 'bg-frutas.png',
  'contenido' => [
    [
      'tipo'  => 'p',
      'texto' => 'Las cerezas ecológicas de Agrivall maduran bajo el sol de primavera y llegan directas del árbol a tu mesa. Cultivadas sin pesticidas, con un suelo cuidado durante años, cada cereza concentra en su interior todo el sabor que la naturaleza puede ofrecer.',
    ],
    [
      'tipo'  => 'h2',
      'texto' => '¿Cuándo es el mejor momento para comprarlas?',
    ],
    [
      'tipo'  => 'p',
      'texto' => 'La temporada de cerezas en nuestra zona comienza a finales de abril y se extiende hasta principios de julio, dependiendo de la variedad y las condiciones climáticas de cada año. Las primeras en llegar son las más dulces; a medida que avanza la temporada aparecen variedades más ácidas, perfectas para mermeladas y repostería.',
    ],
    [
      'tipo'  => 'blockquote',
      'texto' => 'Una cereza recién cogida del árbol es uno de los placeres más puros que puede ofrecer la naturaleza.',
    ],
    [
      'tipo'  => 'h2',
      'texto' => 'Cómo conservarlas correctamente',
    ],
    [
      'tipo'  => 'p',
      'texto' => 'Las cerezas son delicadas y se deterioran rápidamente si no se guardan bien. Lo ideal es mantenerlas en el frigorífico dentro de un recipiente semi-abierto, sin lavarlas hasta el momento de consumirlas. Así pueden aguantar perfectamente entre 5 y 7 días sin perder frescura.',
    ],
    [
      'tipo'  => 'lista',
      'items' => [
        'Guárdalas sin lavar en el frigorífico.',
        'Usa un recipiente con algo de ventilación.',
        'Consúmelas en los primeros 7 días.',
        'Retira las que estén dañadas para que no afecten al resto.',
      ],
    ],
    [
      'tipo'  => 'h2',
      'texto' => 'Por qué son especiales las variedades de Agrivall',
    ],
    [
      'tipo'  => 'p',
      'texto' => 'En Agrivall cultivamos variedades autóctonas adaptadas al microclima de nuestra zona. Esto no solo garantiza un sabor superior, sino que también reduce la necesidad de intervenciones externas: árboles más resistentes, menos plagas, más equilibrio natural. El resultado es una fruta que concentra más nutrientes y menos agua, con un color intenso y un sabor que no encontrarás en el supermercado.',
    ],
  ],
  'relacionados' => [
    [
      'titulo' => 'Los beneficios de la agricultura ecológica para tu salud',
      'tipo'   => 'Noticias',
      'fecha'  => '18 abr. 2026',
      'imagen' => 'bg-productos.png',
    ],
    [
      'titulo' => '5 recetas fáciles con albaricoques de temporada',
      'tipo'   => 'Recetas',
      'fecha'  => '22 mar. 2026',
      'imagen' => 'bg-frutas.png',
    ],
    [
      'titulo' => 'Hierbas aromáticas ecológicas: propiedades y usos en cocina',
      'tipo'   => 'Consejos',
      'fecha'  => '28 feb. 2026',
      'imagen' => 'bg-productos.png',
    ],
  ],
];
@endphp

@section('content')

  {{-- ── CABECERA ─────────────────────────────────────────────── --}}
  <section class="blog-detail-header">
    <div class="blog-detail-header__inner">

      @include('partials.breadcrumb', ['items' => [
        ['label' => 'Inicio', 'url' => route('home')],
        ['label' => 'Blog', 'url' => route('blog.index')],
        ['label' => $post['titulo']],
      ]])

      <a href="{{ route('blog.index') }}" class="detail-header__back">
        <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
        Volver al blog
      </a>

      <div class="blog-detail-header__meta">
        <span class="blog-card__badge blog-detail-header__badge">{{ $post['tipo'] }}</span>
        <span class="blog-card__date">
          <i class="fa-regular fa-calendar" aria-hidden="true"></i>
          {{ $post['fecha'] }}
        </span>
      </div>

      <h1 class="blog-detail-header__title">{{ $post['titulo'] }}</h1>

    </div>
  </section>

  {{-- ── CONTENIDO ───────────────────────────────────────────── --}}
  <section class="blog-detail-section">
    <div class="blog-detail-inner">

      {{-- Columna principal --}}
      <article class="blog-detail-article">

        {{-- Imagen portada --}}
        <div class="blog-detail-article__cover">
          <img
            src="{{ asset('images/' . $post['imagen']) }}"
            alt="{{ $post['titulo'] }}"
            class="blog-detail-article__cover-img"
          >
        </div>

        {{-- Cuerpo del artículo --}}
        <div class="blog-detail-article__body">
          @foreach ($post['contenido'] as $bloque)

            @if ($bloque['tipo'] === 'p')
              <p>{{ $bloque['texto'] }}</p>

            @elseif ($bloque['tipo'] === 'h2')
              <h2>{{ $bloque['texto'] }}</h2>

            @elseif ($bloque['tipo'] === 'blockquote')
              <blockquote>{{ $bloque['texto'] }}</blockquote>

            @elseif ($bloque['tipo'] === 'lista')
              <ul>
                @foreach ($bloque['items'] as $item)
                  <li>{{ $item }}</li>
                @endforeach
              </ul>
            @endif

          @endforeach
        </div>

        {{-- Footer del artículo --}}
        <div class="blog-detail-article__footer">
          <span class="blog-detail-article__footer-label">Comparte este artículo</span>
          <div class="blog-detail-article__share">
            <a href="#" class="blog-detail-article__share-btn" aria-label="Compartir en Facebook">
              <i class="fa-brands fa-facebook-f" aria-hidden="true"></i>
            </a>
            <a href="#" class="blog-detail-article__share-btn" aria-label="Compartir en X">
              <i class="fa-brands fa-x-twitter" aria-hidden="true"></i>
            </a>
            <a href="#" class="blog-detail-article__share-btn" aria-label="Compartir en WhatsApp">
              <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
            </a>
          </div>
        </div>

      </article>

      {{-- Sidebar --}}
      <aside class="blog-detail-sidebar">

        <div class="blog-detail-sidebar__block">
          <h3 class="blog-detail-sidebar__title">Posts relacionados</h3>
          <ul class="blog-detail-sidebar__list" role="list">
            @foreach ($post['relacionados'] as $rel)
              <li class="blog-detail-sidebar__item">
                <a href="{{ route('blog.show', 1) }}" class="blog-detail-sidebar__link">
                  <div class="blog-detail-sidebar__img-wrap">
                    <img
                      src="{{ asset('images/' . $rel['imagen']) }}"
                      alt="{{ $rel['titulo'] }}"
                      loading="lazy"
                    >
                    <span class="blog-card__badge">{{ $rel['tipo'] }}</span>
                  </div>
                  <div class="blog-detail-sidebar__meta">
                    <span class="blog-detail-sidebar__item-title">{{ $rel['titulo'] }}</span>
                    <span class="blog-card__date">
                      <i class="fa-regular fa-calendar" aria-hidden="true"></i>
                      {{ $rel['fecha'] }}
                    </span>
                  </div>
                </a>
              </li>
            @endforeach
          </ul>
        </div>

        <div class="blog-detail-sidebar__block blog-detail-sidebar__block--cta">
          <i class="fa-solid fa-leaf blog-detail-sidebar__cta-icon" aria-hidden="true"></i>
          <p class="blog-detail-sidebar__cta-text">¿Te interesan nuestros productos ecológicos?</p>
          <a href="{{ route('productos.index') }}" class="blog-detail-sidebar__cta-btn">
            Ver productos
          </a>
        </div>

      </aside>

    </div>
  </section>

  @include('partials.trust-certs')

@endsection
