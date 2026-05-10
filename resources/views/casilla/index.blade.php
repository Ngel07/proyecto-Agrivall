@extends('layouts.app')

@section('title', 'Reserva la Casilla — Agrivall')
@section('body-class', 'page-casilla')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/casilla.css') }}">
@endpush

@section('content')

  {{-- ── CABECERA (mismo estilo que productos) ─────────────── --}}
  <section class="prod-filters">
    @include('partials.breadcrumb', ['items' => [
      ['label' => 'Inicio', 'url' => route('home')],
      ['label' => 'Reserva la Casilla'],
    ]])
    <div class="prod-header__text">
      <h1 class="prod-header__title">Reserva la Casilla</h1>
      <p class="prod-header__subtitle">
        Una casa rural en plena naturaleza, junto al río, rodeada de cultivos ecológicos.
      </p>
    </div>
  </section>

  {{-- ── SECCIÓN PRINCIPAL ──────────────────────────────────── --}}
  <section class="casilla-section">
    <div class="casilla-inner">

      {{-- ── COLUMNA IZQUIERDA: CARRUSEL + DESCRIPCIÓN ── --}}
      <div class="casilla-left">

        <div class="casilla-carousel" id="casilla-carousel">
          <div class="casilla-carousel__track" id="carousel-track">
            @foreach ([
              'FotosCasilla/fachada.jpg'  => 'Fachada de la casilla',
              'FotosCasilla/salonP.jpg'   => 'Salón principal',
              'FotosCasilla/cocina.jpg'   => 'Cocina',
              'FotosCasilla/hab1.jpg'     => 'Habitación 1',
              'FotosCasilla/hab2.jpg'     => 'Habitación 2',
              'FotosCasilla/hab3.jpg'     => 'Habitación 3',
              'FotosCasilla/rio.jpg'      => 'Vistas al río',
            ] as $img => $alt)
              <div class="casilla-carousel__slide">
                <img src="{{ asset('images/' . $img) }}" alt="{{ $alt }}" loading="lazy">
              </div>
            @endforeach
          </div>

          <button class="casilla-carousel__btn casilla-carousel__btn--prev" id="carousel-prev" aria-label="Foto anterior">
            <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
          </button>
          <button class="casilla-carousel__btn casilla-carousel__btn--next" id="carousel-next" aria-label="Foto siguiente">
            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
          </button>

          <div class="casilla-carousel__dots" id="carousel-dots" role="tablist" aria-label="Fotos">
            @foreach ([0,1,2,3,4,5,6] as $i)
              <button
                class="casilla-carousel__dot {{ $i === 0 ? 'is-active' : '' }}"
                data-index="{{ $i }}"
                role="tab"
                aria-label="Foto {{ $i + 1 }}"
              ></button>
            @endforeach
          </div>
        </div>

        <div class="casilla-desc">
          <h3 class="casilla-desc__title">Sobre la casilla</h3>
          <p class="casilla-desc__text">
            Disfruta de una semana en nuestra casilla rural, ubicada en plena naturaleza junto al río.
            Cuenta con cocina equipada, salón, tres habitaciones y acceso directo a los cultivos ecológicos
            de Agrivall. Ideal para familias o grupos que quieran desconectar y vivir de cerca
            la agricultura ecológica.
          </p>
          <ul class="casilla-desc__features">
            <li><i class="fa-solid fa-bed" aria-hidden="true"></i> 3 habitaciones</li>
            <li><i class="fa-solid fa-users" aria-hidden="true"></i> Hasta 8 personas</li>
            <li><i class="fa-solid fa-water" aria-hidden="true"></i> Junto al río</li>
            <li><i class="fa-solid fa-leaf" aria-hidden="true"></i> Entorno ecológico</li>
          </ul>
        </div>

      </div>

      {{-- ── PANEL DERECHO: PRECIO + CALENDARIO + FORMULARIO ── --}}
      <div class="casilla-panel">

        <div class="casilla-price-tag">
          <span class="casilla-price-tag__amount">150&euro;</span>
          <span class="casilla-price-tag__label">/ semana · IVA incluido</span>
        </div>

        <div class="casilla-cal" id="casilla-cal">
          <div class="casilla-cal__nav">
            <button class="casilla-cal__nav-btn" id="cal-prev" aria-label="Mes anterior">
              <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
            </button>
            <span class="casilla-cal__month-label" id="cal-month-label"></span>
            <button class="casilla-cal__nav-btn" id="cal-next" aria-label="Mes siguiente">
              <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
            </button>
          </div>

          <div class="casilla-cal__grid" id="cal-grid">
            @foreach(['L','M','X','J','V','S','D'] as $d)
              <div class="casilla-cal__weekday">{{ $d }}</div>
            @endforeach
          </div>

          <div class="casilla-cal__legend">
            <div class="casilla-cal__legend-item">
              <span class="casilla-cal__legend-dot casilla-cal__legend-dot--available"></span>
              Disponible
            </div>
            <div class="casilla-cal__legend-item">
              <span class="casilla-cal__legend-dot casilla-cal__legend-dot--unavailable"></span>
              No disponible
            </div>
            <div class="casilla-cal__legend-item">
              <span class="casilla-cal__legend-dot casilla-cal__legend-dot--selected"></span>
              Seleccionado
            </div>
          </div>
        </div>

        <form class="casilla-form" id="casilla-form" novalidate>
          @csrf
          <h2 class="casilla-form__title">Tus datos de contacto</h2>

          <div class="casilla-form__row">
            <div class="casilla-form__group">
              <label class="casilla-form__label" for="f-nombre">Nombre completo</label>
              <input class="casilla-form__input" type="text" id="f-nombre" name="nombre" placeholder="Juan García" required>
            </div>
            <div class="casilla-form__group">
              <label class="casilla-form__label" for="f-email">Correo electrónico</label>
              <input class="casilla-form__input" type="email" id="f-email" name="email" placeholder="juan@email.com" required>
            </div>
          </div>

          <div class="casilla-form__row">
            <div class="casilla-form__group">
              <label class="casilla-form__label" for="f-tlf">Teléfono</label>
              <input class="casilla-form__input" type="tel" id="f-tlf" name="telefono" placeholder="600 000 000">
            </div>
            <div class="casilla-form__group">
              <label class="casilla-form__label" for="f-personas">Número de personas</label>
              <input class="casilla-form__input" type="number" id="f-personas" name="personas" placeholder="2" min="1" max="10">
            </div>
          </div>

          <div class="casilla-form__group">
            <label class="casilla-form__label">Fechas seleccionadas</label>
            <div class="casilla-form__dates-display is-empty" id="dates-display">
              Selecciona las fechas en el calendario
            </div>
            <input type="hidden" name="fecha_inicio" id="f-fecha-inicio">
            <input type="hidden" name="fecha_fin" id="f-fecha-fin">
          </div>

          <div class="casilla-form__group">
            <label class="casilla-form__label" for="f-mensaje">Mensaje (opcional)</label>
            <textarea class="casilla-form__input" id="f-mensaje" name="mensaje" rows="3" placeholder="¿Alguna petición especial?"></textarea>
          </div>

          <button type="submit" class="casilla-form__btn">
            <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
            Enviar solicitud de reserva
          </button>
        </form>

      </div>

    </div>
  </section>

  @include('partials.trust-certs')

@endsection

@push('scripts')
<script>
(function () {
  const track = document.getElementById('carousel-track');
  const dots  = document.querySelectorAll('.casilla-carousel__dot');
  const total = dots.length;
  let current = 0;

  function goTo(index) {
    current = (index + total) % total;
    track.style.transform = 'translateX(-' + (current * 100) + '%)';
    dots.forEach((d, i) => d.classList.toggle('is-active', i === current));
  }

  document.getElementById('carousel-prev').addEventListener('click', () => goTo(current - 1));
  document.getElementById('carousel-next').addEventListener('click', () => goTo(current + 1));
  dots.forEach(d => d.addEventListener('click', () => goTo(+d.dataset.index)));

  let startX = 0;
  track.addEventListener('touchstart', e => { startX = e.touches[0].clientX; }, { passive: true });
  track.addEventListener('touchend',   e => {
    const diff = startX - e.changedTouches[0].clientX;
    if (Math.abs(diff) > 40) goTo(diff > 0 ? current + 1 : current - 1);
  });
})();

(function () {
  const MESES = ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
  let viewYear  = new Date().getFullYear();
  let viewMonth = new Date().getMonth();
  let startDate = null;
  let endDate   = null;

  const grid       = document.getElementById('cal-grid');
  const label      = document.getElementById('cal-month-label');
  const display    = document.getElementById('dates-display');
  const inputStart = document.getElementById('f-fecha-inicio');
  const inputEnd   = document.getElementById('f-fecha-fin');

  function pad(n) { return String(n).padStart(2, '0'); }
  function fmt(d) { return pad(d.getDate()) + '/' + pad(d.getMonth()+1) + '/' + d.getFullYear(); }
  function toISO(d){ return d.getFullYear() + '-' + pad(d.getMonth()+1) + '-' + pad(d.getDate()); }
  function isSame(a, b)     { return a && b && a.toDateString() === b.toDateString(); }
  function isBetween(d,a,b) { return a && b && d > a && d < b; }
  function isPast(d)        { const t = new Date(); t.setHours(0,0,0,0); return d < t; }

  function updateDisplay() {
    if (startDate && endDate) {
      display.textContent = fmt(startDate) + ' → ' + fmt(endDate);
      display.classList.remove('is-empty');
      inputStart.value = toISO(startDate);
      inputEnd.value   = toISO(endDate);
    } else if (startDate) {
      display.textContent = fmt(startDate) + ' → selecciona fecha fin';
      display.classList.remove('is-empty');
      inputStart.value = toISO(startDate);
      inputEnd.value   = '';
    } else {
      display.textContent = 'Selecciona las fechas en el calendario';
      display.classList.add('is-empty');
      inputStart.value = inputEnd.value = '';
    }
  }

  function renderMonth() {
    label.textContent = MESES[viewMonth] + ' ' + viewYear;
    grid.querySelectorAll('.casilla-cal__day').forEach(el => el.remove());

    const firstDay    = new Date(viewYear, viewMonth, 1);
    const daysInMonth = new Date(viewYear, viewMonth + 1, 0).getDate();
    let offset = firstDay.getDay() - 1;
    if (offset < 0) offset = 6;

    for (let i = 0; i < offset; i++) {
      const e = document.createElement('div');
      e.className = 'casilla-cal__day is-empty';
      grid.appendChild(e);
    }

    for (let day = 1; day <= daysInMonth; day++) {
      const d   = new Date(viewYear, viewMonth, day);
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'casilla-cal__day';
      btn.textContent = day;

      const today = new Date(); today.setHours(0,0,0,0);
      if (d.toDateString() === today.toDateString()) btn.classList.add('is-today');
      if (isPast(d))                             btn.classList.add('is-disabled');
      if (isSame(d, startDate) && !endDate)      btn.classList.add('is-selected');
      if (isSame(d, startDate) && endDate)       btn.classList.add('is-selected','is-range-start');
      if (isSame(d, endDate))                    btn.classList.add('is-selected','is-range-end');
      if (isBetween(d, startDate, endDate))      btn.classList.add('is-in-range');

      if (!isPast(d)) {
        btn.addEventListener('click', () => {
          if (!startDate || (startDate && endDate)) { startDate = d; endDate = null; }
          else { if (d <= startDate) { startDate = d; endDate = null; } else { endDate = d; } }
          updateDisplay(); renderMonth();
        });
      }
      grid.appendChild(btn);
    }
  }

  document.getElementById('cal-prev').addEventListener('click', () => {
    if (--viewMonth < 0) { viewMonth = 11; viewYear--; } renderMonth();
  });
  document.getElementById('cal-next').addEventListener('click', () => {
    if (++viewMonth > 11) { viewMonth = 0; viewYear++; } renderMonth();
  });

  renderMonth();
  updateDisplay();
})();
</script>
@endpush
