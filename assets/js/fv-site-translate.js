/**
 * Traduce el cuerpo de una landing de producto con Google Translate
 * según el idioma del selector del sitio (data-fv-google-lang).
 * El chrome del sitio debe llevar class="notranslate".
 */
(function () {
  const root = document.querySelector('[data-fv-google-lang]');
  if (!root) return;
  const target = (root.getAttribute('data-fv-google-lang') || '').trim();
  if (!target || target === 'es') return;

  const host = document.createElement('div');
  host.id = 'google_translate_element';
  host.setAttribute('aria-hidden', 'true');
  host.style.cssText = 'position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0 0 0 0);white-space:nowrap';
  document.body.appendChild(host);

  function setCookie(name, value) {
    const expires = new Date(Date.now() + 864e5).toUTCString();
    document.cookie = name + '=' + value + ';expires=' + expires + ';path=/';
  }

  // Preferencia antes de cargar el widget (evita flash en español).
  setCookie('googtrans', '/es/' + target);
  setCookie('googtrans', '/es/' + target);

  window.googleTranslateElementInit = function () {
    // eslint-disable-next-line no-new
    new google.translate.TranslateElement(
      { pageLanguage: 'es', autoDisplay: false, includedLanguages: '' },
      'google_translate_element'
    );

    let tries = 0;
    const timer = setInterval(function () {
      tries += 1;
      const select = document.querySelector('#google_translate_element select.goog-te-combo');
      if (select && select.options && select.options.length > 1) {
        if (select.value !== target) {
          select.value = target;
          select.dispatchEvent(new Event('change', { bubbles: true }));
        }
        clearInterval(timer);
      } else if (tries > 80) {
        clearInterval(timer);
      }
    }, 250);
  };

  const s = document.createElement('script');
  s.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
  s.async = true;
  document.head.appendChild(s);
})();
