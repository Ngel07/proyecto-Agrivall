@extends('layouts.app')

@section('title', 'Conócenos — Agrivall')
@section('body-class', 'page-conocenos')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/conocenos.css') }}">
@endpush

@section('content')

  {{-- ── CABECERA ──────────────────────────────────────────────── --}}
  <section class="prod-filters">
    @include('partials.breadcrumb', ['items' => [
      ['label' => 'Inicio', 'url' => route('home')],
      ['label' => 'Conócenos'],
    ]])
    <div class="prod-header__text">
      <h1 class="prod-header__title">CONÓCENOS</h1>
      <p class="prod-header__subtitle">
        Agricultura sinérgica en el corazón de la Vall de Gallinera, Alicante.
      </p>
    </div>
  </section>

  {{-- ── QUIÉNES SOMOS ─────────────────────────────────────────── --}}
  <section class="conocenos-section">
    <div class="conocenos-inner">
      <div class="conocenos-story">
        <div class="conocenos-story__text">
          <h2 class="conocenos-section__title">Agrivall</h2>
          <p>
            <strong>Agrivall</strong> es un proyecto agrícola de vanguardia nacido en el corazón de la
            <strong>Vall de Gallinera (Alicante)</strong>, fundado y dirigido por
            <strong>Javier Savall</strong>, Ingeniero Técnico Agrícola y docente apasionado del sector agroecológico.
          </p>
          <p>
            Nos dedicamos al cultivo ecológico de la cereza y otras variedades frutales de la montaña de Alicante,
            apostando firmemente por la biodiversidad y la sostenibilidad. En Agrivall entendemos la tierra como un
            ecosistema vivo; por ello, implementamos un modelo de <strong>agricultura sinérgica</strong> que respeta
            los ciclos naturales y aprovecha el potencial de las plantas silvestres y las cubiertas verdes para
            enriquecer el suelo y proteger nuestros cultivos.
          </p>
          <p>
            Nuestro compromiso es ofrecer un <strong>producto local de máxima calidad</strong>, fusionando los
            conocimientos técnicos de la agronomía moderna con el respeto profundo por las tradiciones y el territorio.
          </p>
        </div>
        <div class="conocenos-story__image">
          <img src="{{ asset('images/FotosCasilla/agrivall.jpg') }}" alt="Campos de Agrivall en la Vall de Gallinera" loading="lazy">
        </div>
      </div>

      {{-- Galería --}}
      <div class="conocenos-gallery">
        <img src="{{ asset('images/FotosCasilla/agrivall2.png') }}" alt="Agrivall — cultivo ecológico" loading="lazy">
        <img src="{{ asset('images/FotosCasilla/agrivall3.png') }}" alt="Agrivall — frutos de temporada" loading="lazy">
      </div>
    </div>
  </section>

  {{-- ── CERTIFICACIÓN ─────────────────────────────────────────── --}}
  <section class="conocenos-section conocenos-section--alt">
    <div class="conocenos-inner">

      <h2 class="conocenos-section__title">
        Cultivo Ecológico Certificado
      </h2>
      <p class="conocenos-section__lead">
        En Agrivall, la sostenibilidad no es solo una declaración de intenciones; es un método riguroso avalado
        por los máximos organismos reguladores de la agricultura biológica. Cada cereza y fruto de nuestras tierras
        cuenta con el <strong>sello de Garantía Oficial</strong> que certifica que todo nuestro proceso productivo
        respeta la integridad natural del suelo y del entorno.
      </p>

      <h3 class="conocenos-subsection__title">¿Qué garantiza nuestra certificación?</h3>

      <ul class="conocenos-guarantees" role="list">
        <li class="conocenos-guarantees__item">
          <span class="conocenos-guarantees__icon" aria-hidden="true">
            <i class="fa-solid fa-ban"></i>
          </span>
          <div>
            <strong>Ausencia Absoluta de Químicos de Síntesis</strong>
            <p>Cero pesticidas, herbicidas químicos ni fertilizantes sintéticos. Protegemos los árboles empleando
            exclusivamente técnicas ecológicas e insumos autorizados de origen natural.</p>
          </div>
        </li>
        <li class="conocenos-guarantees__item">
          <span class="conocenos-guarantees__icon" aria-hidden="true">
            <i class="fa-solid fa-leaf"></i>
          </span>
          <div>
            <strong>Sostenibilidad en Cada Etapa</strong>
            <p>Desde el mantenimiento de las cubiertas verdes nativas hasta la recogida artesanal, cada paso está
            sometido a estrictos controles que garantizan la regeneración del suelo de la Vall de Gallinera
            y la biodiversidad silvestre.</p>
          </div>
        </li>
        <li class="conocenos-guarantees__item">
          <span class="conocenos-guarantees__icon" aria-hidden="true">
            <i class="fa-solid fa-shield-halved"></i>
          </span>
          <div>
            <strong>Trazabilidad y Seguridad Alimentaria</strong>
            <p>El consumidor final recibe un alimento de alta densidad nutritiva y pureza organoléptica, con el
            origen 100% garantizado en la montaña de Alicante.</p>
          </div>
        </li>
      </ul>

      {{-- Sellos --}}
      <h3 class="conocenos-subsection__title">Sellos Oficiales que nos respaldan</h3>
      <p class="conocenos-sellos__text">
        Nuestros campos y cultivos se rigen estrictamente bajo el código de control
        <strong>ES-ECO-020-CV</strong> del <strong>CAECV</strong>
        (Comité de Agricultura Ecológica de la Comunitat Valenciana). Asimismo, lucimos con orgullo la
        <strong>«Eurohoja»</strong>, el distintivo oficial de la Unión Europea para alimentos ecológicos,
        asegurando el cumplimiento exhaustivo del <strong>Reglamento (UE) 2018/848</strong>.
      </p>
      <div class="conocenos-sellos__logos">
        <img src="{{ asset('images/logo-caae.jpg') }}" alt="Sello CAECV — ES-ECO-020-CV" loading="lazy">
        <img src="{{ asset('images/logo-eu-eco.png') }}" alt="Eurohoja — Agricultura Ecológica UE" loading="lazy">
        <img src="{{ asset('images/logo-intereco.jpg') }}" alt="Intereco" loading="lazy">
      </div>
      <p class="conocenos-sellos__cta">
        <strong>Comprar en Agrivall es sinónimo de elegir salud para ti y respeto por nuestro planeta.</strong>
      </p>

    </div>
  </section>

  {{-- ── CTA ──────────────────────────────────────────────────── --}}
  <section class="conocenos-cta">
    <div class="conocenos-inner">
      <h2 class="conocenos-cta__title">¿Listo para probar la diferencia?</h2>
      <div class="conocenos-cta__buttons">
        <a href="{{ route('productos.index') }}" class="conocenos-cta__btn conocenos-cta__btn--primary">
          <i class="fa-solid fa-basket-shopping" aria-hidden="true"></i>
          Ver productos
        </a>
        <a href="{{ route('contacto.index') }}" class="conocenos-cta__btn">
          <i class="fa-solid fa-envelope" aria-hidden="true"></i>
          Escríbenos
        </a>
      </div>
    </div>
  </section>

@endsection

