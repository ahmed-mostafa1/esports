
// About page
(() => {
  const els = Array.from(document.querySelectorAll('[data-reveal]'));
  if (!els.length || !('IntersectionObserver' in window)) {
    els.forEach(el => el.classList.add('is-visible'));
    return;
  }

  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        const el = e.target;
        el.classList.add('is-visible');
        // if it's a stagger container, nudge children
        if ((el.getAttribute('data-reveal')||'').includes('stagger')) {
          requestAnimationFrame(()=> el.classList.add('is-visible'));
        }
        io.unobserve(el);
      }
    });
  }, { root: null, rootMargin: '0px 0px -10% 0px', threshold: 0.16 });

  els.forEach(el => {
    // base hidden state (if not already styled globally)
    el.style.opacity ??= 0;
    io.observe(el);
  });
})();

