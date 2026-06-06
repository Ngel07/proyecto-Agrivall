{{-- ── TRUST BADGES ─────────────────────────────────────────── --}}
@unless($hideTrust ?? false)
<section class="trust" aria-label="Garantías">
  <ul class="trust__list" role="list">
    <li class="trust__item">
      <i class="fa-solid fa-leaf trust__icon" aria-hidden="true"></i>
      <span class="trust__label">{{ __('common.trust_eco') }}</span>
    </li>
    <li class="trust__item">
      <i class="fa-solid fa-tractor trust__icon" aria-hidden="true"></i>
      <span class="trust__label">{{ __('common.trust_direct') }}</span>
    </li>
    <li class="trust__item">
      <i class="fa-regular fa-clock trust__icon" aria-hidden="true"></i>
      <span class="trust__label">{!! __('common.trust_shipping') !!}</span>
    </li>
  </ul>
</section>
@endunless

{{-- ── CERTIFICACIONES ─────────────────────────────────────── --}}
<section class="certs" aria-label="Certificaciones">

  <div class="certs__heading-wrap">
    <img src="{{ asset('images/icon-leaf.png') }}" alt="" class="certs__leaf-icon" aria-hidden="true">
    <h2 class="certs__title">{!! __('common.certs_title') !!}</h2>
  </div>

  <p class="certs__subtitle">{{ __('common.certs_subtitle') }}</p>

  <div class="certs__logos">
    <a href="{{ route('conocenos.index') }}#certificaciones" class="certs__logo-item" aria-label="Más información sobre nuestra certificación ecológica">
      <div class="certs__logo-box">
        <img src="{{ asset('images/logo-caae.jpg') }}" alt="CAAE — Producción Ecológica">
      </div>
      <span class="certs__label">Producción<br>Ecológica</span>
    </a>
    <a href="{{ route('conocenos.index') }}#certificaciones" class="certs__logo-item" aria-label="Más información sobre nuestra certificación ES-ECO-001-CT">
      <div class="certs__logo-box">
        <img src="{{ asset('images/logo-eu-eco.png') }}" alt="ES-ECO-001-CT Agricultura UE">
      </div>
      <span class="certs__label">ES-ECO-001-CT<br>Agricultura UE</span>
    </a>
    <a href="{{ route('conocenos.index') }}#certificaciones" class="certs__logo-item" aria-label="Más información sobre Certirceo For Intereco">
      <div class="certs__logo-box">
        <img src="{{ asset('images/logo-intereco.jpg') }}" alt="Certirceo For Intereco">
      </div>
      <span class="certs__label">Certirceo<br>For Intereco</span>
    </a>
  </div>

  <div class="certs__leaves" aria-hidden="true">
    <img src="{{ asset('images/deco-leaves-left.png') }}"  alt="" class="certs__leaves-left">
    <img src="{{ asset('images/deco-leaves-right.png') }}" alt="" class="certs__leaves-right">
  </div>

</section>
