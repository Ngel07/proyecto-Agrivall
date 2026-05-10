// Mobile hamburger toggle
const btn  = document.getElementById('hamburgerBtn');
const menu = document.getElementById('navMenu');

btn.addEventListener('click', () => {
  const open = menu.classList.toggle('is-open');
  btn.setAttribute('aria-expanded', open);
});

// Navbar scroll: fondo traslúcido al bajar
const navbar = document.querySelector('.navbar');

function updateNavbar() {
  if (window.scrollY > 20) {
    navbar.classList.add('is-scrolled');
  } else {
    navbar.classList.remove('is-scrolled');
  }
}

window.addEventListener('scroll', updateNavbar, { passive: true });
updateNavbar(); // aplicar en carga por si la página no empieza arriba del todo
