@extends('layouts.app')

@section('title', 'Blog — Agrivall')
@section('body-class', 'page-blog')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
@endpush

@section('content')

  {{-- ── CABECERA ─────────────────────────────────────────────── --}}
  <section class="prod-filters">
    @include('partials.breadcrumb', ['items' => [
      ['label' => __('common.inicio'), 'url' => route('home')],
      ['label' => __('blog.title')],
    ]])
    <div class="prod-header__text">
      <h1 class="prod-header__title">{{ __('blog.title') }}</h1>
      <p class="prod-header__subtitle">
        {{ __('blog.subtitle') }}
      </p>
    </div>

    <form class="prod-filters__form" method="GET" action="{{ route('blog.index') }}">
      <div class="prod-filters__selects">
        <div class="prod-filters__group">
          <label for="f-categoria" class="sr-only">{{ __('blog.filter_category') }}</label>
          <div class="prod-filters__select-wrap">
            <select id="f-categoria" name="categoria" class="prod-filters__select">
              <option value="">{{ __('blog.filter_category') }}</option>
              @foreach ($tipos as $tipo)
                <option value="{{ $tipo->tipo }}" {{ request('categoria') === $tipo->tipo ? 'selected' : '' }}>
                  {{ $tipo->tipo }}
                </option>
              @endforeach
            </select>
            <i class="fa-solid fa-chevron-down prod-filters__arrow" aria-hidden="true"></i>
          </div>
        </div>
      </div>

      <button type="submit" class="prod-filters__btn">
        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        <span>{{ __('blog.search') }}</span>
      </button>
    </form>
  </section>

  {{-- ── GRID DE POSTS ────────────────────────────────────────── --}}
  <section class="blog-section">
    <ul class="blog-grid" role="list">

      @foreach ($posts as $post)
        <li class="blog-card {{ $loop->first ? 'blog-card--featured' : '' }}">

          {{-- Imagen --}}
          <a href="{{ route('blog.show', $post) }}" class="blog-card__img-link" tabindex="-1" aria-hidden="true">
            <div class="blog-card__img-wrap">
              <img
                src="{{ asset('images/' . ($post->imagen ?? 'bg-frutas.png')) }}"
                alt="{{ $post->titulo }}"
                class="blog-card__img"
                loading="lazy"
              >
              <span class="blog-card__badge">{{ $post->tipo->tipo }}</span>
            </div>
          </a>

          {{-- Cuerpo --}}
          <div class="blog-card__body">
            <span class="blog-card__date">
              <i class="fa-regular fa-calendar" aria-hidden="true"></i>
              {{ $post->fecha_public->format('d/m/Y') }}
            </span>
            <a href="{{ route('blog.show', $post) }}" class="blog-card__title">
              {{ $post->titulo }}
            </a>
            <p class="blog-card__excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($post->noticia), 180) }}</p>
            <a href="{{ route('blog.show', $post) }}" class="blog-card__btn">
              <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
              {{ __('blog.read_more') }}
            </a>
          </div>

        </li>
      @endforeach

    </ul>
  </section>

  @include('partials.trust-certs')

@endsection
