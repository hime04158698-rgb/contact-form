import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
  const openBtn = document.querySelector(".js-open-modal");
  const closeBtn = document.querySelector(".js-close-modal");
  const modal = document.querySelector(".modal");

  if (!openBtn || !closeBtn || !modal) return;

  openBtn.addEventListener("click", () => modal.classList.add("is-open"));
  closeBtn.addEventListener("click", () => modal.classList.remove("is-open"));

  modal.addEventListener("click", (e) => {
    if (e.target === modal) modal.classList.remove("is-open");
  });
});
