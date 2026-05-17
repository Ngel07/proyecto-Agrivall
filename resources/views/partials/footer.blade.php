<footer class="site-footer" aria-label="Pie de página">

  {{-- ── FRANJA SUPERIOR: 3 columnas ────────────────────────── --}}
  <div class="site-footer__top">
    <div class="site-footer__inner">

      {{-- Col 1: Contacto --}}
      <div class="site-footer__col site-footer__col--brand">
        <p class="site-footer__col-title">Dónde encontrarnos</p>
        <address class="site-footer__address">
          <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
          CV-700, Km 36 · 03788 Alpatró<br>
          La Vall de Gallinera, Alacant
        </address>
        <a href="tel:+34679765842" class="site-footer__phone">
          <i class="fa-solid fa-phone" aria-hidden="true"></i>
          679 765 842
        </a>
        <a href="{{ route('contacto.index') }}" class="site-footer__contact-link">
          <i class="fa-solid fa-envelope" aria-hidden="true"></i>
          Escríbenos
        </a>

        <div class="site-footer__social" aria-label="Redes sociales">
          <a href="https://www.instagram.com/agrivall" class="site-footer__social-btn" aria-label="Instagram de Agrivall" target="_blank" rel="noopener">
            <i class="fa-brands fa-instagram" aria-hidden="true"></i>
          </a>
          <a href="https://www.linkedin.com/in/javier-savall-agrivall" class="site-footer__social-btn" aria-label="LinkedIn de Agrivall" target="_blank" rel="noopener">
            <i class="fa-brands fa-linkedin-in" aria-hidden="true"></i>
          </a>
          <a href="https://wa.me/34679765842" class="site-footer__social-btn" aria-label="WhatsApp de Agrivall" target="_blank" rel="noopener">
            <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
          </a>
        </div>
      </div>

      {{-- Col 2: Mapa del sitio --}}
      <div class="site-footer__col">
        <p class="site-footer__col-title">Explora</p>
        <nav aria-label="Mapa del sitio">
          <ul class="site-footer__nav-list" role="list">
            <li><a href="{{ route('home') }}" class="site-footer__nav-link">
              <i class="fa-solid fa-house" aria-hidden="true"></i> Inicio
            </a></li>
            <li><a href="{{ route('productos.index') }}" class="site-footer__nav-link">
              <i class="fa-solid fa-basket-shopping" aria-hidden="true"></i> Productos
            </a></li>
            <li><a href="{{ route('casilla.index') }}" class="site-footer__nav-link">
              <i class="fa-solid fa-tree" aria-hidden="true"></i> La Casilla
            </a></li>
            <li><a href="{{ route('blog.index') }}" class="site-footer__nav-link">
              <i class="fa-solid fa-newspaper" aria-hidden="true"></i> Blog
            </a></li>
            <li><a href="{{ route('contacto.index') }}" class="site-footer__nav-link">
              <i class="fa-solid fa-envelope" aria-hidden="true"></i> Contacto
            </a></li>
          </ul>
        </nav>
      </div>

      {{-- Col 3: Valoraciones --}}
      <div class="site-footer__col site-footer__col--reviews">
        <p class="site-footer__col-title">Valoraciones</p>
        <a href="#" class="site-footer__reviews-score" aria-label="Ver 47 reseñas, puntuación 4,8 sobre 5">
          <span class="site-footer__reviews-num">4,8</span>
          <div class="site-footer__stars" aria-hidden="true">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star-half-stroke"></i>
          </div>
          <span class="site-footer__reviews-count">47 reseñas</span>
        </a>
      </div>

    </div>
  </div>

  {{-- ── FRANJA INFERIOR: legal + copyright ──────────────────── --}}
  <div class="site-footer__bottom">
    <div class="site-footer__inner">
      <p class="site-footer__copy">
        &copy; {{ date('Y') }} Agrivall · Todos los derechos reservados
      </p>
      <nav class="site-footer__legal" aria-label="Enlaces legales">
        <a href="#" class="site-footer__legal-link">Aviso legal</a>
        <a href="#" class="site-footer__legal-link">Política de privacidad</a>
        <a href="#" class="site-footer__legal-link">Política de cookies</a>
      </nav>
    </div>
  </div>

</footer>
