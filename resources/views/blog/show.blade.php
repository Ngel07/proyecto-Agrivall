@extends('layouts.app')

@section('title', $post->titulo . ' — Blog Agrivall')
@section('description', \Illuminate\Support\Str::limit(strip_tags($post->noticia), 155))
@section('body-class', 'page-blog')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
@endpush

@section('content')

  {{-- ── CABECERA ─────────────────────────────────────────────── --}}
  <section class="blog-detail-header">
    <div class="blog-detail-header__inner">

      @include('partials.breadcrumb', ['items' => [
        ['label' => 'Inicio', 'url' => route('home')],
        ['label' => 'Blog', 'url' => route('blog.index')],
        ['label' => $post->titulo],
      ]])

      <a href="{{ route('blog.index') }}" class="detail-header__back">
        <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
        Volver al blog
      </a>

      <div class="blog-detail-header__meta">
        <span class="blog-card__badge blog-detail-header__badge">{{ $post->tipo->tipo }}</span>
        <span class="blog-card__date">
          <i class="fa-regular fa-calendar" aria-hidden="true"></i>
          {{ $post->fecha_public->format('d/m/Y') }}
        </span>
      </div>

      <h1 class="blog-detail-header__title">{{ $post->titulo }}</h1>

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
            src="{{ asset('images/' . ($post->imagen ?? 'bg-frutas.png')) }}"
            alt="{{ $post->titulo }}"
            class="blog-detail-article__cover-img"
          >
        </div>

        {{-- Cuerpo del artículo --}}
        <div class="blog-detail-article__body">
          {!! $post->noticia !!}
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
            @foreach ($relacionados as $rel)
              <li class="blog-detail-sidebar__item">
                <a href="{{ route('blog.show', $rel) }}" class="blog-detail-sidebar__link">
                  <div class="blog-detail-sidebar__img-wrap">
                    <img
                      src="{{ asset('images/' . ($rel->imagen ?? 'bg-frutas.png')) }}"
                      alt="{{ $rel->titulo }}"
                      loading="lazy"
                    >
                    <span class="blog-card__badge">{{ $rel->tipo->tipo }}</span>
                  </div>
                  <div class="blog-detail-sidebar__meta">
                    <span class="blog-detail-sidebar__item-title">{{ $rel->titulo }}</span>
                    <span class="blog-card__date">
                      <i class="fa-regular fa-calendar" aria-hidden="true"></i>
                      {{ $rel->fecha_public->format('d/m/Y') }}
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
