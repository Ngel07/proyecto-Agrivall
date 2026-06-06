@extends('layouts.app')

@section('description', 'Reserva la casilla rural de Agrivall en el Valle de Gallinera. Una escapada única en plena naturaleza ecológica certificada.')
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
      ['label' => __('common.inicio'), 'url' => route('home')],
      ['label' => __('casilla.title')],
    ]])
    <div class="prod-header__text">
      <h1 class="prod-header__title">{{ __('casilla.title') }}</h1>
      <p class="prod-header__subtitle">
        {{ __('casilla.subtitle') }}
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
          <h3 class="casilla-desc__title">{{ __('casilla.about_title') }}</h3>
          <p class="casilla-desc__text">
            {{ __('casilla.about_text') }}
          </p>
          <ul class="casilla-desc__features">
            <li><i class="fa-solid fa-bed" aria-hidden="true"></i> {{ __('casilla.feat_rooms') }}</li>
            <li><i class="fa-solid fa-users" aria-hidden="true"></i> {{ __('casilla.feat_people') }}</li>
            <li><i class="fa-solid fa-water" aria-hidden="true"></i> {{ __('casilla.feat_river') }}</li>
            <li><i class="fa-solid fa-leaf" aria-hidden="true"></i> {{ __('casilla.feat_eco') }}</li>
          </ul>
        </div>

      </div>

      {{-- ── PANEL DERECHO: PRECIO + CALENDARIO + FORMULARIO ── --}}
      <div class="casilla-panel">

        <div class="casilla-price-tag">
          <span class="casilla-price-tag__amount">150&euro;</span>
          <span class="casilla-price-tag__label">{{ __('casilla.price_label') }}</span>
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
              {{ __('casilla.cal_available') }}
            </div>
            <div class="casilla-cal__legend-item">
              <span class="casilla-cal__legend-dot casilla-cal__legend-dot--unavailable"></span>
              {{ __('casilla.cal_unavailable') }}
            </div>
            <div class="casilla-cal__legend-item">
              <span class="casilla-cal__legend-dot casilla-cal__legend-dot--selected"></span>
              {{ __('casilla.cal_selected') }}
            </div>
          </div>
        </div>

        <form class="casilla-form" id="casilla-form" novalidate>
          @csrf
          <h2 class="casilla-form__title">{{ __('casilla.form_title') }}</h2>

          <div class="casilla-form__row">
            <div class="casilla-form__group">
              <label class="casilla-form__label" for="f-nombre">{{ __('casilla.form_name') }}</label>
              <input class="casilla-form__input" type="text" id="f-nombre" name="nombre" placeholder="{{ __('casilla.form_name_placeholder') }}" required minlength="2">
              <span class="casilla-form__error" id="err-nombre"></span>
            </div>
            <div class="casilla-form__group">
              <label class="casilla-form__label" for="f-email">{{ __('casilla.form_email') }}</label>
              <input class="casilla-form__input" type="email" id="f-email" name="email" placeholder="{{ __('casilla.form_email_placeholder') }}" required>
              <span class="casilla-form__error" id="err-email"></span>
            </div>
          </div>

          <div class="casilla-form__row">
            <div class="casilla-form__group">
              <label class="casilla-form__label" for="f-tlf">{{ __('casilla.form_phone') }}</label>
              <input class="casilla-form__input" type="tel" id="f-tlf" name="telefono" placeholder="600 000 000" required pattern="[0-9 +]{9,15}" minlength="9">
              <span class="casilla-form__error" id="err-tlf"></span>
            </div>
            <div class="casilla-form__group">
              <label class="casilla-form__label" for="f-personas">{{ __('casilla.form_people') }}</label>
              <input class="casilla-form__input" type="number" id="f-personas" name="personas" placeholder="2" min="1" max="10" required>
              <span class="casilla-form__error" id="err-personas"></span>
            </div>
          </div>

          <div class="casilla-form__group">
            <label class="casilla-form__label">{{ __('casilla.form_dates') }}</label>
            <div class="casilla-form__dates-display is-empty" id="dates-display">
              {{ __('casilla.form_dates_placeholder') }}
            </div>
            <input type="hidden" name="fecha_inicio" id="f-fecha-inicio">
            <input type="hidden" name="fecha_fin" id="f-fecha-fin">
          </div>

          <div class="casilla-form__group">
              <label class="casilla-form__label" for="f-mensaje">{{ __('casilla.form_message') }}</label>
              <textarea class="casilla-form__input" id="f-mensaje" name="mensaje" rows="3" placeholder="{{ __('casilla.form_message_placeholder') }}"></textarea>
          </div>

          <button type="submit" class="casilla-form__btn">
            <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
            {{ __('casilla.form_submit') }}
          </button>
        </form>

        <div class="casilla-reserva-ok" id="reserva-ok" style="display:none;" role="alert">
          <i class="fa-solid fa-circle-check casilla-reserva-ok__icon" aria-hidden="true"></i>
          <p class="casilla-reserva-ok__text">Su solicitud de reserva se ha enviado correctamente. Nos pondremos en contacto con usted a la brevedad.</p>
        </div>

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
  function toISO(d){ return d.getFullYear() + '-' + pad(d.getMonth()+1) + '-' + pad(d.getDate()); }
  function isSame(a, b)     { return a && b && a.toDateString() === b.toDateString(); }
  function isBetween(d,a,b) { return a && b && d > a && d < b; }
  function isPast(d)        { const t = new Date(); t.setHours(0,0,0,0); return d < t; }

  function mondayOf(d) {
    const day = d.getDay();
    const diff = day === 0 ? -6 : 1 - day;
    const mon = new Date(d);
    mon.setDate(d.getDate() + diff);
    mon.setHours(0,0,0,0);
    return mon;
  }

  function sundayOf(mon) {
    const sun = new Date(mon);
    sun.setDate(mon.getDate() + 6);
    return sun;
  }

  function updateDisplay() {
    if (startDate && endDate) {
      const sameMonth = startDate.getMonth() === endDate.getMonth() && startDate.getFullYear() === endDate.getFullYear();
      let text;
      if (sameMonth) {
        text = 'Semana del ' + startDate.getDate() + ' al ' + endDate.getDate() + ' de ' + MESES[startDate.getMonth()] + ' de ' + startDate.getFullYear();
      } else {
        text = 'Semana del ' + startDate.getDate() + ' de ' + MESES[startDate.getMonth()] + ' al ' + endDate.getDate() + ' de ' + MESES[endDate.getMonth()] + ' de ' + endDate.getFullYear();
      }
      display.textContent = text;
      display.classList.remove('is-empty');
      inputStart.value = toISO(startDate);
      inputEnd.value   = toISO(endDate);
    } else {
      display.textContent = 'Selecciona una semana en el calendario';
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
      if (isSame(d, startDate))                  btn.classList.add('is-selected','is-range-start');
      if (isSame(d, endDate))                    btn.classList.add('is-selected','is-range-end');
      if (isBetween(d, startDate, endDate))      btn.classList.add('is-in-range');

      if (!isPast(d)) {
        btn.addEventListener('click', () => {
          const mon = mondayOf(d);
          const sun = sundayOf(mon);
          startDate = mon;
          endDate   = sun;
          updateDisplay();
          renderMonth();
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

// Formulario — validación y mensaje de éxito
document.getElementById('casilla-form').addEventListener('submit', function (e) {
  e.preventDefault();
  let valid = true;

  function fieldError(inputId, errorId, msg) {
    const input = document.getElementById(inputId);
    const err   = document.getElementById(errorId);
    const group = input.closest('.casilla-form__group');
    if (msg) {
      err.textContent = msg;
      err.style.display = 'block';
      group.classList.add('has-error');
      if (valid) { input.focus(); valid = false; }
    } else {
      err.textContent = '';
      err.style.display = 'none';
      group.classList.remove('has-error');
    }
  }

  const nombre   = document.getElementById('f-nombre').value.trim();
  const email    = document.getElementById('f-email').value.trim();
  const telefono = document.getElementById('f-tlf').value.trim();
  const personas = document.getElementById('f-personas').value.trim();
  const fechaIni = document.getElementById('f-fecha-inicio').value;

  fieldError('f-nombre',  'err-nombre',  !nombre || nombre.length < 2 ? 'El nombre es obligatorio (mínimo 2 caracteres)' : '');
  fieldError('f-email',   'err-email',   !email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email) ? 'Introduce un correo electrónico válido' : '');
  fieldError('f-tlf',     'err-tlf',     !telefono || telefono.replace(/\D/g,'').length < 9 ? 'El teléfono debe tener mínimo 9 dígitos' : '');
  fieldError('f-personas','err-personas',!personas || personas < 1 ? 'Indica el número de personas' : '');

  if (!fechaIni) {
    valid = false;
    document.getElementById('casilla-cal').scrollIntoView({ behavior: 'smooth' });
    const disp = document.getElementById('dates-display');
    disp.style.outline = '2px solid #e53e3e';
    disp.textContent = 'Debes seleccionar una semana en el calendario';
    setTimeout(() => { disp.style.outline = ''; }, 2500);
  }

  if (!valid) return;

  this.style.display = 'none';
  document.getElementById('reserva-ok').style.display = 'flex';
});
</script>
@endpush
