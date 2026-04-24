// Mobile hamburger toggle
const btn = document.getElementById('hamburgerBtn');
const menu = document.getElementById('navMenu');

btn.addEventListener('click', () => {
  const open = menu.classList.toggle('is-open');
  btn.setAttribute('aria-expanded', open);
});
