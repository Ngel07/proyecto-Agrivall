@if (!empty($items))
<nav class="breadcrumb" aria-label="Migas de pan">
  <ol class="breadcrumb__list">
    @foreach ($items as $i => $crumb)
      @if ($i < count($items) - 1)
        <li class="breadcrumb__item">
          <a href="{{ $crumb['url'] }}" class="breadcrumb__link">{{ $crumb['label'] }}</a>
          <span class="breadcrumb__sep" aria-hidden="true">/</span>
        </li>
      @else
        <li class="breadcrumb__item breadcrumb__item--current" aria-current="page">
          {{ $crumb['label'] }}
        </li>
      @endif
    @endforeach
  </ol>
</nav>
@endif
