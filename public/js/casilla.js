/* casilla.js — carrusel + calendario de reserva */

/* ── CARRUSEL ─────────────────────────────────────────────────── */
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

/* ── CALENDARIO ───────────────────────────────────────────────── */
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
          updateDisplay();
          renderMonth();
        });
      }
      grid.appendChild(btn);
    }
  }

  document.getElementById('cal-prev').addEventListener('click', () => {
    if (--viewMonth < 0) { viewMonth = 11; viewYear--; }
    renderMonth();
  });
  document.getElementById('cal-next').addEventListener('click', () => {
    if (++viewMonth > 11) { viewMonth = 0; viewYear++; }
    renderMonth();
  });

  renderMonth();
  updateDisplay();
})();
