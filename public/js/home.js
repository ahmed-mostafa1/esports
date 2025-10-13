// Slider micro-lib used across pages
function makeSlider(root){
  const track = root.querySelector('.slider-track');
  const prev  = root.querySelector('.slider-btn.prev');
  const next  = root.querySelector('.slider-btn.next');
  const step = () => {
    if (!track.children.length) return;
    const first = track.children[0];
    track.appendChild(first.cloneNode(true));
    track.removeChild(first);
  };
  let auto = setInterval(step, 3500);
  const scrollByCards = (dir=1) => {
    const card = track.children[0];
    const w = card.getBoundingClientRect().width + 16;
    track.scrollBy({left: dir * w, behavior: 'smooth'});
  };
  prev && prev.addEventListener('click', () => { scrollByCards(-1); reset(); });
  next && next.addEventListener('click', () => { scrollByCards(1);  reset(); });
  const reset = () => { clearInterval(auto); auto = setInterval(step, 3500); };
  root.addEventListener('mouseenter', () => clearInterval(auto));
  root.addEventListener('mouseleave', () => reset());
}
document.querySelectorAll('[data-slider]').forEach(makeSlider);


// Parteners Slider
(function () {
  const slider = document.getElementById('partners-slider');
  if (!slider) return;

  const track = slider.querySelector('.track');
  if (!track) return;

  const cards = Array.from(track.querySelectorAll('.card-partner'));
  if (cards.length < 2) return;

  const state = {
    timer: null,
    interval: 1500,        // autoplay delay (ms)
    isPaused: false
  };

  function getStep() {
    // current card width + computed gap (responsive-safe)
    const cs = getComputedStyle(track);
    const gap = parseFloat(cs.columnGap || cs.gap) || 0;
    const card = cards[0];
    const cardW = card.getBoundingClientRect().width;
    return cardW + gap;
  }

  function atEnd() {
    // near the right edge?
    return slider.scrollLeft >= track.scrollWidth - slider.clientWidth - 1;
  }

  function next() {
    const step = getStep();
    if (atEnd()) {
      // jump back to start
      slider.scrollTo({ left: 0, behavior: 'smooth' });
    } else {
      slider.scrollBy({ left: step, behavior: 'smooth' });
    }
  }

  function start() {
    if (state.timer) return;
    state.timer = setInterval(() => {
      if (!state.isPaused) next();
    }, state.interval);
  }

  function stop() {
    if (!state.timer) return;
    clearInterval(state.timer);
    state.timer = null;
  }

  // Pause on user interaction; resume when they stop
  ['mouseenter', 'focusin', 'touchstart', 'pointerdown'].forEach(evt => {
    slider.addEventListener(evt, () => { state.isPaused = true; }, { passive: true });
  });
  ['mouseleave', 'focusout', 'touchend', 'pointerup', 'touchcancel'].forEach(evt => {
    slider.addEventListener(evt, () => { state.isPaused = false; }, { passive: true });
  });

  // Optional: keyboard control when focused
  slider.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight') { state.isPaused = true; next(); }
    if (e.key === 'ArrowLeft')  {
      const step = getStep();
      slider.scrollBy({ left: -step, behavior: 'smooth' });
      state.isPaused = true;
    }
  });

  // Keep steps correct on resize (debounced)
  let t;
  window.addEventListener('resize', () => {
    clearTimeout(t);
    t = setTimeout(() => {
      const step = getStep();
      const nearest = Math.round(slider.scrollLeft / step);
      // snap to nearest card after layout change
      slider.scrollTo({ left: nearest * step, behavior: 'auto' });
    }, 150);
  });

  // Start autoplay
  start();

  // (Optional) expose simple controls if you ever need them:
  slider.dataset.autoplay = 'on';
  slider.addEventListener('autoplay:stop', stop);
  slider.addEventListener('autoplay:start', start);
})();


// partners slider control btns

(function () {
  const slider = document.getElementById('partners-slider');
  const track  = slider?.querySelector('.track');
  const prev   = document.getElementById('p-prev');
  const next   = document.getElementById('p-next');
  const dotsEl = document.getElementById('p-dots');
  if (!slider || !track || !prev || !next || !dotsEl) return;

  const cards = () => Array.from(track.querySelectorAll('.card-partner'));

  // --- helpers --------------------------------------------------------------
  function getGap() {
    const cs = getComputedStyle(track);
    return parseFloat(cs.columnGap || cs.gap) || 0;
  }
  function getStep() {
    // one "page" == one card width + gap (your autoplay step)
    const c = cards()[0];
    if (!c) return 1;
    return c.getBoundingClientRect().width + getGap();
  }
  function perView() {
    const step = getStep() || 1;
    return Math.max(1, Math.round(slider.clientWidth / step));
  }
  function maxIndex() {
    const total = cards().length;
    const pv = perView();
    return Math.max(0, total - pv);
  }
  function getIndex() {
    const step = getStep() || 1;
    return Math.round(slider.scrollLeft / step);
  }
  function scrollToIndex(i, behavior = 'smooth') {
    const mi = maxIndex();
    const clamped = Math.max(0, Math.min(i, mi));
    slider.scrollTo({ left: clamped * getStep(), behavior });
    setActiveDot(clamped);
  }
  function atStart() { return getIndex() <= 0; }
  function atEnd()   { return getIndex() >= maxIndex(); }

  // --- autoplay cooperation (from previous snippet) ------------------------
  function pauseAutoplay() { slider.dispatchEvent(new Event('autoplay:stop')); }
  let resumeTimer;
  function resumeAutoplaySoon(delay = 2500) {
    clearTimeout(resumeTimer);
    resumeTimer = setTimeout(() => slider.dispatchEvent(new Event('autoplay:start')), delay);
  }

  // --- dots ----------------------------------------------------------------
  let dots = [];
  function buildDots() {
    const pages = maxIndex() + 1; // number of snap positions
    dotsEl.innerHTML = '';
    dots = Array.from({ length: pages }, (_, i) => {
      const dot = document.createElement('span');
      dot.className = 'dot' + (i === 0 ? ' active' : '');
      dot.role = 'button';
      dot.tabIndex = 0;
      dot.ariaLabel = `Go to slide ${i + 1}`;
      dot.addEventListener('click', () => {
        pauseAutoplay();
        scrollToIndex(i);
        resumeAutoplaySoon();
      });
      dot.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); dot.click(); }
      });
      dotsEl.appendChild(dot);
      return dot;
    });
  }
  function setActiveDot(i) {
    const idx = Math.max(0, Math.min(i, dots.length - 1));
    dots.forEach((d, j) => d.classList.toggle('active', j === idx));
  }

  // --- nav buttons ---------------------------------------------------------
  function updateArrowsDisabled() {
    // If you prefer wrap-around, comment these two lines out.
    prev.disabled = atStart();
    next.disabled = atEnd();
  }
  next.addEventListener('click', () => {
    pauseAutoplay();
    if (atEnd()) {
      // wrap to start; remove this block if you don't want wrapping
      scrollToIndex(0);
    } else {
      scrollToIndex(getIndex() + 1);
    }
    resumeAutoplaySoon();
  });
  prev.addEventListener('click', () => {
    pauseAutoplay();
    if (atStart()) {
      // wrap to end; remove this block if you don't want wrapping
      scrollToIndex(maxIndex());
    } else {
      scrollToIndex(getIndex() - 1);
    }
    resumeAutoplaySoon();
  });

  // --- keep UI in sync while user scrolls ---------------------------------
  let raf = null;
  slider.addEventListener('scroll', () => {
    if (raf) return;
    raf = requestAnimationFrame(() => {
      raf = null;
      const i = getIndex();
      setActiveDot(i);
      updateArrowsDisabled();
    });
  }, { passive: true });

  // --- react to layout changes --------------------------------------------
  let rezTimer;
  window.addEventListener('resize', () => {
    clearTimeout(rezTimer);
    rezTimer = setTimeout(() => {
      const i = getIndex();
      buildDots();               // rebuild because perView may change
      scrollToIndex(i, 'auto');  // snap to the nearest new index
      updateArrowsDisabled();
    }, 120);
  });

  // --- init ----------------------------------------------------------------
  buildDots();
  setActiveDot(0);
  updateArrowsDisabled();
})();


// Testimonials
(() => {
  // Unique, conflict-free names
  const ts_root   = document.getElementById('ts-slider');
  const ts_track  = ts_root.querySelector('.ts-track');
  const ts_cards  = Array.from(ts_track.querySelectorAll('.ts-card'));
  const ts_dotsEl = document.getElementById('ts-dots');
  const ts_prev   = document.getElementById('ts-prev');
  const ts_next   = document.getElementById('ts-next');

  // Show 2 at a time, slide 1 by 1
  const TS_VISIBLE = 2;
  const ts_maxIndex = Math.max(0, ts_cards.length - TS_VISIBLE);
  const ts_dotsCount = Math.max(1, ts_maxIndex + 1);
  let ts_index = 0;
  let ts_timer = null;
  const TS_AUTOPLAY_MS = 1500;

  // Build dots
  ts_dotsEl.innerHTML = '';
  for (let i = 0; i < ts_dotsCount; i++) {
    const d = document.createElement('span');
    d.className = 'dot' + (i === 0 ? ' active' : '');
    d.addEventListener('click', () => ts_setIndex(i, true));
    ts_dotsEl.appendChild(d);
  }

  function ts_cardWidth() {
    const el = ts_cards[0];
    return el ? el.getBoundingClientRect().width : 0;
  }

  function ts_setIndex(n, stopAuto = false) {
    ts_index = (n + ts_maxIndex + 1) % (ts_maxIndex + 1);   // wrap 0..maxIndex
    const x = -(ts_index * ts_cardWidth());
    ts_track.style.transform = `translateX(${x}px)`;

    // update dots
    Array.from(ts_dotsEl.children).forEach((d, i) =>
      d.classList.toggle('active', i === ts_index)
    );

    if (stopAuto) ts_restartAutoplay();
  }

  function ts_nextStep(stop=false){ ts_setIndex(ts_index + 1, stop); }
  function ts_prevStep(stop=false){ ts_setIndex(ts_index - 1, stop); }

  ts_next.addEventListener('click', () => ts_nextStep(true));
  ts_prev.addEventListener('click', () => ts_prevStep(true));

  // autoplay with pause on hover
  function ts_startAutoplay(){ ts_stopAutoplay(); ts_timer = setInterval(ts_nextStep, TS_AUTOPLAY_MS); }
  function ts_stopAutoplay(){ if (ts_timer) clearInterval(ts_timer); ts_timer = null; }
  function ts_restartAutoplay(){ ts_stopAutoplay(); ts_startAutoplay(); }

  // ts_root.addEventListener('mouseenter', ts_stopAutoplay);
  ts_root.addEventListener('mouseleave', ts_startAutoplay);
  window.addEventListener('resize', () => ts_setIndex(ts_index)); // keep alignment on resize

  // init
  ts_setIndex(0);
  ts_startAutoplay();
})();

(() => {
  const SEL = '[data-reveal]';
  const els = Array.from(document.querySelectorAll(SEL));

  // If nothing to reveal, bail
  if (!els.length) return;

  // Utility: apply visible state with optional per-element delay
  const reveal = (el) => {
    const delay = parseInt(el.getAttribute('data-reveal-delay') || '0', 10);
    if (delay) el.style.transitionDelay = `${delay}ms`;
    el.classList.add('is-visible');

    // If 'stagger' is on a container, reveal its children in a cascade
    if (el.getAttribute('data-reveal')?.includes('stagger')) {
      requestAnimationFrame(() => el.classList.add('is-visible'));
    }
  };

  // Observer options: adjust rootMargin to trigger a bit before the item hits center
  const io = ('IntersectionObserver' in window)
    ? new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          const el = entry.target;
          const onceAttr = el.getAttribute('data-reveal-once');
          const once = onceAttr === null || onceAttr === 'true'; // default true

          if (entry.isIntersecting) {
            reveal(el);
            if (once) io.unobserve(el);
          } else if (!once) {
            // allow re-trigger when scrolled away and back
            el.classList.remove('is-visible');
            el.style.transitionDelay = '';
          }
        });
      }, { root: null, rootMargin: '0px 0px -10% 0px', threshold: 0.18 })
    : null;

  // Observe or fallback
  els.forEach(el => {
    if (io) io.observe(el);
    else reveal(el); // no IO support → show immediately
  });

  // Keep layout tidy on route/page resizes
  window.addEventListener('resize', () => {
    // no-op for now; transitions remain correct
  }, { passive: true });
})();



// make tstimonials cards same size
(function () {
  // Select all testimonials’ inner boxes
  const SELECTOR = '.ts-inner';

  function syncHeights() {
    const els = Array.from(document.querySelectorAll(SELECTOR));
    if (!els.length) return;

    // Reset before measuring
    els.forEach(el => el.style.minHeight = '');

    // Measure tallest (padding included, margin excluded)
    const tallest = Math.max(...els.map(el => el.getBoundingClientRect().height));

    // Apply uniform min-height
    els.forEach(el => { el.style.minHeight = tallest + 'px'; });
  }

  // Re-run on resize (debounced) and after load (images/fonts)
  let t;
  window.addEventListener('resize', () => {
    clearTimeout(t);
    t = setTimeout(syncHeights, 120);
  });

  if (document.readyState === 'complete') syncHeights();
  else window.addEventListener('load', syncHeights);

  // Keep heights in sync if any card’s content changes (images, async text, etc.)
  const ro = new ResizeObserver(syncHeights);
  const mo = new MutationObserver(syncHeights);

  function observeAll() {
    const els = document.querySelectorAll(SELECTOR);
    els.forEach(el => ro.observe(el));
  }
  observeAll();
  mo.observe(document.documentElement, { childList: true, subtree: true });
})();

// swap hero-tag word
(function () {
  const words = ['Esports', 'Events', 'Tournaments'];
  const el = document.getElementById('swapword');
  if (!el) return;

  let i = 0;
  const DURATION = 2200;   // time each word stays (ms)
  const XFADE = 350;       // match CSS transition (.35s)

  function next() {
    // fade out current
    el.classList.add('is-out');

    // after fade-out, swap text, fade back in
    setTimeout(() => {
      i = (i + 1) % words.length;
      el.textContent = words[i];
      el.classList.remove('is-out');
      el.classList.add('is-in');
      // clean the 'is-in' class after the transition
      setTimeout(() => el.classList.remove('is-in'), XFADE + 20);
    }, Math.min(200, XFADE)); // small overlap for a snappy feel
  }

  // start the loop
  setInterval(next, DURATION);
})();


// progressbar increase with scroll
(function () {
  const section = document.querySelector('section.hero#home');
  const fill    = document.querySelector('.progress-fill');
  const label   = document.querySelector('.progress-label'); // optional
  if (!section || !fill) return;

  // CONFIG:
  const MAX = 1.0;   // 1.0 = 100%. Set to 0.65 if you want to cap at 65%
  const USE_PERCENT_LABEL = false; // set true to show "42%" instead of "Esports"

  // Respect reduced motion: just snap to MAX once visible
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Compute progress of scrolling through the section (0..1)
  function progressOf(el) {
    const r  = el.getBoundingClientRect();
    const vh = window.innerHeight || document.documentElement.clientHeight;

    // Start counting when the top hits the bottom of the viewport,
    // finish when the bottom leaves the top of the viewport.
    const total = vh + r.height;
    const passed = Math.min(total, Math.max(0, vh - r.top));
    return total ? (passed / total) : 0;
  }

  let ticking = false;
  function update() {
    ticking = false;

    if (prefersReduced) {
      fill.style.width = (MAX * 100).toFixed(2) + '%';
      if (label && USE_PERCENT_LABEL) label.textContent = Math.round(MAX * 100) + '%';
      return;
    }

    const p   = Math.max(0, Math.min(1, progressOf(section)));
    const val = p * MAX;
    fill.style.width = (val * 100).toFixed(2) + '%';

    if (label && USE_PERCENT_LABEL) {
      label.textContent = Math.round(val * 100) + '%';
    }
  }

  function onScroll() {
    if (!ticking) {
      requestAnimationFrame(update);
      ticking = true;
    }
  }

  // Update when section is in/near the viewport (saves work)
  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) {
          window.addEventListener('scroll', onScroll, { passive: true });
          window.addEventListener('resize', onScroll);
          update();
        } else {
          window.removeEventListener('scroll', onScroll);
          window.removeEventListener('resize', onScroll);
        }
      });
    }, { root: null, threshold: [0, 0.01, 1] });
    io.observe(section);
  } else {
    // Fallback
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
    update();
  }

  // Initial paint
  update();
})();

// // === Random single TRIANGLES on both sides ===
// document.addEventListener('DOMContentLoaded', () => {
//   const host = document.getElementById('starfield');
//   if (!host) return;

//   // Tweak to taste
//   const MAX_TRIS   = 14;     // triangles on screen
//   const SPAWN_EVERY= 1200;   // ms between spawn attempts
//   const LIFE_MIN   = 9000;   // ms a triangle stays alive
//   const LIFE_MAX   = 15000;

//   const vw = () => Math.max(document.documentElement.clientWidth,  window.innerWidth  || 0);
//   const r  = (min, max) => Math.random() * (max - min) + min;
//   const pick = (a) => a[Math.floor(Math.random()*a.length)];

//   function spawnTri(){
//     // keep population tasteful
//     if (host.querySelectorAll('.tri-piece').length >= MAX_TRIS) return;

//     const el = document.createElement('div');
//     el.className = 'tri-piece ' + pick(['v1','v2','v3']);

//     // size & scale
//     const base = r(32, 64);           // base px
//     const scale = r(0.7, 1.2);
//     el.style.width = el.style.height = `${base}px`;
//     el.style.transform = `scale(${scale})`;

//     // vertical position (avoid extreme edges)
//     const y = r(6, 92); // %
//     el.style.top = `calc(${y}vh - ${(base*scale)/2}px)`;

//     // choose side, stick near edge with light jitter
//     const side = Math.random() < 0.5 ? 'left' : 'right';
//     const margin = 8;                 // px from edge
//     const jitter = r(-8, 8);
//     if (side === 'left') el.style.left = `${margin + jitter}px`;
//     else el.style.left = `${vw() - margin - base*scale + jitter}px`;

//     // unique animation timings per instance
//     el.style.setProperty('--twinkle', `${r(2.1, 3.4).toFixed(2)}s`);
//     el.style.setProperty('--spin',    `${r(14, 24).toFixed(2)}s`);
//     el.style.setProperty('--sway',    `${r(5.2, 8.2).toFixed(2)}s`);
//     el.style.setProperty('--rot',     `${r(0, 360).toFixed(1)}deg`);

//     // de-sync
//     el.style.animationDelay = `${r(0,.6).toFixed(2)}s, ${r(0,.6).toFixed(2)}s, 0s, ${r(0,.6).toFixed(2)}s`;

//     host.appendChild(el);

//     // lifespan + fade-out removal
//     const lifespan = r(LIFE_MIN, LIFE_MAX);
//     const fadeOut = 700;
//     setTimeout(() => {
//       el.style.transition = `opacity ${fadeOut}ms ease`;
//       el.style.opacity = '0';
//       setTimeout(() => el.remove(), fadeOut + 50);
//     }, lifespan);
//   }

//   // pump spawns
//   const timer = setInterval(spawnTri, SPAWN_EVERY);

//   // seed a few at start
//   for (let i = 0; i < Math.min(MAX_TRIS, 8); i++) spawnTri();

//   // on resize, re-seed positions so they hug the new edges
//   let ro;
//   window.addEventListener('resize', () => {
//     clearTimeout(ro);
//     ro = setTimeout(() => {
//       host.innerHTML = '';
//       for (let i = 0; i < Math.min(MAX_TRIS, 8); i++) spawnTri();
//     }, 180);
//   }, { passive: true });
// });
