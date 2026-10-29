(function () {
  'use strict';
  const KEY = 'tactica_theme';
  const root = document.documentElement;

  function get() {
    return localStorage.getItem(KEY) || 'light';
  }
  function set(theme) {
    localStorage.setItem(KEY, theme);
    root.setAttribute('data-theme', theme);
    document.dispatchEvent(new CustomEvent('theme:updated', { detail: theme }));
    updateButtons();
  }
  function toggle() {
    set(get() === 'dark' ? 'light' : 'dark');
  }
  function updateButtons() {
    const theme = get();
    document.querySelectorAll('[data-action="theme-toggle"]').forEach((btn) => {
      btn.textContent = theme === 'dark' ? '[DARK]' : '[LIGHT]';
      btn.setAttribute('aria-label', theme === 'dark' ? 'Включить светлую тему' : 'Включить тёмную тему');
    });
  }

  root.setAttribute('data-theme', get());

  document.addEventListener('DOMContentLoaded', updateButtons);

  document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-action="theme-toggle"]');
    if (!btn) return;
    toggle();
  });

  window.TacticaTheme = { get, set, toggle };
})();