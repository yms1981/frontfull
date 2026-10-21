(function () {
  const catalogNode = document.getElementById('fv-catalog');
  const uiNode = document.getElementById('fv-ui');
  let catalog = [];
  let ui = { empty: '', hint: '', kinds: {} };
  try {
    catalog = JSON.parse(catalogNode ? catalogNode.textContent || '[]' : '[]');
    ui = JSON.parse(uiNode ? uiNode.textContent || '{}' : '{}');
  } catch (error) {
    catalog = [];
  }

  const searchModal = document.getElementById('search-modal');
  const videoModal = document.getElementById('video-modal');
  const searchInput = document.getElementById('search-input');
  const searchResults = document.getElementById('search-results');
  let lastFocus = null;

  function fold(value) {
    const text = (value || '').toLocaleLowerCase();
    try {
      return text.normalize('NFD').replace(/\p{M}/gu, '');
    } catch (error) {
      return text;
    }
  }

  function openModal(modal) {
    if (!modal) return;
    lastFocus = document.activeElement;
    modal.hidden = false;
    document.body.classList.add('modal-open');
    const field = modal.querySelector('input, button');
    if (field) field.focus();
  }

  function closeModals() {
    [searchModal, videoModal].forEach(function (modal) {
      if (modal) modal.hidden = true;
    });
    document.body.classList.remove('modal-open');
    if (lastFocus && typeof lastFocus.focus === 'function') lastFocus.focus();
  }

  function renderSearch(query) {
    if (!searchResults) return;
    searchResults.replaceChildren();
    const needle = fold(query.trim());
    const matches = needle === ''
      ? catalog.slice(0, 6)
      : catalog.filter(function (item) {
          return fold(item.title + ' ' + item.text).includes(needle);
        }).slice(0, 8);

    if (matches.length === 0) {
      const empty = document.createElement('p');
      empty.className = 'empty';
      empty.textContent = (ui.empty || '').replace('{q}', query.trim());
      const hint = document.createElement('p');
      hint.className = 'muted';
      hint.textContent = ui.hint || '';
      searchResults.append(empty, hint);
      return;
    }

    matches.forEach(function (item) {
      const link = document.createElement('a');
      link.href = item.href;
      link.className = 'search-hit';
      const kind = document.createElement('small');
      kind.textContent = (ui.kinds && ui.kinds[item.kind]) || item.kind;
      const title = document.createElement('strong');
      title.textContent = item.title;
      const text = document.createElement('span');
      text.textContent = item.text;
      link.append(kind, title, text);
      searchResults.append(link);
    });
  }

  document.addEventListener('click', function (event) {
    const opener = event.target.closest('[data-open]');
    if (opener) {
      event.preventDefault();
      if (opener.dataset.open === 'search') {
        openModal(searchModal);
        if (searchInput) {
          searchInput.value = '';
          renderSearch('');
        }
      }
      if (opener.dataset.open === 'video') openModal(videoModal);
      return;
    }
    if (event.target.closest('[data-close]')) {
      closeModals();
      return;
    }
    document.querySelectorAll('details[open]').forEach(function (details) {
      if (!details.contains(event.target)) details.removeAttribute('open');
    });
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      closeModals();
      document.querySelectorAll('details[open]').forEach(function (details) {
        details.removeAttribute('open');
      });
    }
    if ((event.metaKey || event.ctrlKey) && event.key.toLowerCase() === 'k') {
      event.preventDefault();
      openModal(searchModal);
      renderSearch('');
    }
  });

  if (searchInput) {
    searchInput.addEventListener('input', function () {
      renderSearch(searchInput.value);
    });
  }

  const slides = Array.prototype.slice.call(document.querySelectorAll('[data-slide]'));
  let slideIndex = 0;
  function showSlide(next) {
    if (!slides.length) return;
    slideIndex = (next + slides.length) % slides.length;
    slides.forEach(function (slide, index) {
      slide.classList.toggle('is-on', index === slideIndex);
    });
  }
  const prev = document.querySelector('[data-slide-prev]');
  const next = document.querySelector('[data-slide-next]');
  if (prev) prev.addEventListener('click', function () { showSlide(slideIndex - 1); });
  if (next) next.addEventListener('click', function () { showSlide(slideIndex + 1); });

  document.querySelectorAll('.lang-filter').forEach(function (input) {
    input.addEventListener('input', function () {
      const needle = fold(input.value.trim());
      const panel = input.closest('.lang-panel');
      if (!panel) return;
      panel.querySelectorAll('.lang-option').forEach(function (option) {
        const hay = fold(option.dataset.name || option.textContent || '');
        option.hidden = needle !== '' && !hay.includes(needle);
      });
    });
    input.addEventListener('click', function (event) {
      event.stopPropagation();
    });
  });

  const header = document.querySelector('.site-header');
  function onScroll() {
    if (header) header.classList.toggle('is-stuck', window.scrollY > 4);
  }
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });
})();
