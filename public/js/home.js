// RTL detection helper
function isRTL() {
  return document.documentElement.dir === 'rtl' || getComputedStyle(document.documentElement).direction === 'rtl';
}

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


// Partners Slider - Removed conflicting autoplay function
// Using only the unified controller below


// Partners Slider - Fixed Implementation
(function () {
  const slider = document.getElementById('partners-slider');
  const track  = slider?.querySelector('.track');
  const prev   = document.getElementById('p-prev');
  const next   = document.getElementById('p-next');
  const dotsEl = document.getElementById('p-dots');
  
  if (!slider || !track || !prev || !next || !dotsEl) {
    console.warn('Partners slider: Missing required elements', {
      slider: !!slider,
      track: !!track, 
      prev: !!prev,
      next: !!next,
      dotsEl: !!dotsEl
    });
    return;
  }

  const cards = () => Array.from(track.querySelectorAll('.card-partner'));
  const toNumber = (value) => {
    const parsed = parseFloat(value ?? '');
    return Number.isFinite(parsed) ? parsed : 0;
  };

  function cardStride(list = cards()) {
    if (list.length <= 1) {
      const single = list[0];
      return single ? single.getBoundingClientRect().width : slider.clientWidth;
    }
    const delta = Math.abs(list[1].offsetLeft - list[0].offsetLeft);
    if (delta > 0) return delta;
    const width = list[0].getBoundingClientRect().width;
    return width || slider.clientWidth;
  }
  
  // Configuration
  let currentIndex = 0;
  let autoplayTimer = null;
  const AUTOPLAY_DELAY = 1500;

  function getVisibleCards() {
    const list = cards();
    if (!list.length) return 1;

    const stride = cardStride(list);
    if (!stride) return 1;

    const styles = window.getComputedStyle(slider);
    const paddingStart = toNumber(styles.paddingInlineStart || styles.paddingLeft);
    const paddingEnd = toNumber(styles.paddingInlineEnd || styles.paddingRight);
    const available = slider.clientWidth - paddingStart - paddingEnd;
    const usable = available > 0 ? available : slider.clientWidth;
    const approx = usable / stride;

    return Math.max(1, Math.round(approx));
  }

  function getMaxIndex() {
    const totalCards = cards().length;
    const visibleCards = getVisibleCards();
    return Math.max(0, totalCards - visibleCards);
  }

  function setIndex(index, stopAutoplay = false) {
    const list = cards();
    if (!list.length) return;

    const maxIdx = getMaxIndex();
    currentIndex = Math.max(0, Math.min(index, maxIdx));
    
    const stride = cardStride(list);
    const offset = stride * currentIndex;
    const rtlMode = isRTL();
    
    // Calculate translation in pixels to account for card gap + width
    const direction = rtlMode ? 1 : -1;
    const x = direction * offset;
    
    track.style.transform = `translateX(${x}px)`;
    updateDots();
    updateArrowsState();
    
    if (stopAutoplay) {
      restartAutoplay();
    }
  }

  function nextSlide(stopAutoplay = false) {
    const maxIdx = getMaxIndex();
    const nextIdx = currentIndex >= maxIdx ? 0 : currentIndex + 1; // wrap around
    setIndex(nextIdx, stopAutoplay);
  }

  function prevSlide(stopAutoplay = false) {
    const maxIdx = getMaxIndex();
    const prevIdx = currentIndex <= 0 ? maxIdx : currentIndex - 1; // wrap around
    setIndex(prevIdx, stopAutoplay);
  }

  // Dots management
  function buildDots() {
    const maxIdx = getMaxIndex();
    const numDots = Math.min(5, maxIdx + 1); // Max 5 dots, minimum 1
    dotsEl.innerHTML = '';
    
    for (let i = 0; i < numDots; i++) {
      const dot = document.createElement('span');
      dot.className = 'dot' + (i === 0 ? ' active' : '');
      dot.setAttribute('data-slide', i.toString());
      dot.addEventListener('click', () => setIndex(i, true));
      dotsEl.appendChild(dot);
    }
  }

  function updateDots() {
    const dots = dotsEl.querySelectorAll('.dot');
    dots.forEach((dot, index) => {
      dot.classList.toggle('active', index === currentIndex);
    });
  }

  function updateArrowsState() {
    // Enable wrap-around, so never disable buttons
    prev.disabled = false;
    next.disabled = false;
    
    // Optional: Add visual feedback for disabled state
    prev.style.opacity = '1';
    next.style.opacity = '1';
  }

  // Event listeners
  next.addEventListener('click', (e) => {
    e.preventDefault();
    nextSlide(true);
  });
  
  prev.addEventListener('click', (e) => {
    e.preventDefault();
    prevSlide(true);
  });

  // Autoplay functions
  function startAutoplay() {
    stopAutoplay();
    autoplayTimer = setInterval(() => nextSlide(), AUTOPLAY_DELAY);
  }

  function stopAutoplay() {
    if (autoplayTimer) {
      clearInterval(autoplayTimer);
      autoplayTimer = null;
    }
  }

  function restartAutoplay() {
    stopAutoplay();
    setTimeout(() => startAutoplay(), 1500); // Restart after 1.5s
  }

  // Pause autoplay on hover
  slider.addEventListener('mouseenter', stopAutoplay);
  slider.addEventListener('mouseleave', startAutoplay);

  // Handle window resize
  let resizeTimeout;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
      buildDots(); // Rebuild dots for new screen size
      setIndex(Math.min(currentIndex, getMaxIndex())); // Adjust current index if needed
    }, 250);
  });

  // Touch/swipe support for mobile
  let startX = 0;
  let isDragging = false;
  
  slider.addEventListener('touchstart', (e) => {
    startX = e.touches[0].clientX;
    isDragging = true;
    stopAutoplay();
  }, { passive: true });
  
  slider.addEventListener('touchend', (e) => {
    if (!isDragging) return;
    isDragging = false;
    
    const endX = e.changedTouches[0].clientX;
    const diffX = startX - endX;
    const threshold = 50; // Minimum swipe distance
    
    if (Math.abs(diffX) > threshold) {
      if (diffX > 0) {
        nextSlide(true); // Swipe left - next slide
      } else {
        prevSlide(true); // Swipe right - previous slide  
      }
    } else {
      restartAutoplay();
    }
  }, { passive: true });

  // Initialize slider
  function init() {
    const totalCards = cards().length;
    console.log(`Partners slider initialized with ${totalCards} cards`);
    
    if (totalCards === 0) {
      console.warn('No partner cards found');
      return;
    }
    
    buildDots();
    setIndex(0);
    updateArrowsState();
    startAutoplay();
  }

  // Wait for DOM to be ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();


// Tournaments slider (image + name), mirrors testimonials behavior
(() => {
  const root = document.getElementById('tr-slider');
  if (!root) return;

  const track = document.getElementById('tr-track');
  const btnPrev = document.getElementById('tr-prev');
  const btnNext = document.getElementById('tr-next');
  const dotsEl = document.getElementById('tr-dots');

  if (!track || !btnPrev || !btnNext || !dotsEl) return;

  const cards = () => Array.from(track.querySelectorAll('.card-tournament'));
  const AUTO_MS = 2000;
  let index = 0;
  let timer = null;
  let resizeId = null;

  const toNumber = (value) => {
    const parsed = parseFloat(value ?? '');
    return Number.isFinite(parsed) ? parsed : 0;
  };

  const cardStride = (list = cards()) => {
    if (list.length <= 1) {
      const single = list[0];
      return single ? single.getBoundingClientRect().width : root.clientWidth;
    }

    const delta = Math.abs(list[1].offsetLeft - list[0].offsetLeft);
    if (delta > 0) return delta;

    const width = list[0].getBoundingClientRect().width;
    return width || root.clientWidth;
  };

  const visibleCount = () => {
    const list = cards();
    if (!list.length) return 1;

    const stride = cardStride(list);
    if (!stride) return 1;

    const styles = window.getComputedStyle(root);
    const paddingStart = toNumber(styles.paddingInlineStart || styles.paddingLeft);
    const paddingEnd = toNumber(styles.paddingInlineEnd || styles.paddingRight);
    const available = root.clientWidth - paddingStart - paddingEnd;
    const usable = available > 0 ? available : root.clientWidth;

    return Math.max(1, Math.round(usable / stride));
  };

  const maxIndex = () => {
    const total = cards().length;
    const visible = visibleCount();
    return Math.max(0, total - visible);
  };

  const buildDots = () => {
    const count = Math.max(1, maxIndex() + 1);
    dotsEl.innerHTML = '';
    for (let i = 0; i < count; i++) {
      const dot = document.createElement('span');
      dot.className = 'dot' + (i === 0 ? ' active' : '');
      dot.addEventListener('click', () => setIndex(i, true));
      dotsEl.appendChild(dot);
    }
  };

  const updateDots = () => {
    Array.from(dotsEl.children).forEach((dot, idx) => {
      dot.classList.toggle('active', idx === index);
    });
  };

  const setIndex = (nextIndex, stopAuto = false) => {
    const max = maxIndex();
    if (max === 0) {
      index = 0;
      track.style.transform = '';
      updateDots();
      stopAutoplay();
      return;
    }

    index = (nextIndex + max + 1) % (max + 1);

    const stride = cardStride();
    const offset = stride * index;
    const rtl = isRTL();
    const translate = rtl ? offset : -offset;

    track.style.transform = `translateX(${translate}px)`;
    updateDots();

    if (stopAuto) restartAutoplay();
  };

  const next = (stopAuto = false) => setIndex(index + 1, stopAuto);
  const prev = (stopAuto = false) => setIndex(index - 1, stopAuto);

  const stopAutoplay = () => {
    if (timer) {
      clearInterval(timer);
      timer = null;
    }
  };

  const startAutoplay = () => {
    stopAutoplay();
    if (maxIndex() === 0) return; // nothing to slide
    timer = setInterval(next, AUTO_MS);
  };

  const restartAutoplay = () => {
    stopAutoplay();
    startAutoplay();
  };

  btnNext.addEventListener('click', () => next(true));
  btnPrev.addEventListener('click', () => prev(true));

  root.addEventListener('mouseenter', stopAutoplay);
  root.addEventListener('mouseleave', startAutoplay);

  // Touch swipe
  let startX = 0;
  let dragging = false;
  root.addEventListener('touchstart', (e) => {
    dragging = true;
    startX = e.touches[0].clientX;
    stopAutoplay();
  }, { passive: true });

  root.addEventListener('touchend', (e) => {
    if (!dragging) return;
    dragging = false;

    const dx = startX - e.changedTouches[0].clientX;
    const threshold = 50;
    if (Math.abs(dx) > threshold) {
      dx > 0 ? next(true) : prev(true);
    } else {
      restartAutoplay();
    }
  }, { passive: true });

  window.addEventListener('resize', () => {
    clearTimeout(resizeId);
    resizeId = setTimeout(() => {
      const previousMax = maxIndex();
      buildDots();
      const boundedIndex = Math.min(index, maxIndex());
      setIndex(boundedIndex);
      if (previousMax !== maxIndex()) {
        restartAutoplay();
      }
    }, 200);
  });

  const init = () => {
    if (!cards().length) return;
    buildDots();
    setIndex(0);
    startAutoplay();
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();


// Testimonials
(() => {
  // Unique, conflict-free names
  const ts_root   = document.getElementById('ts-slider');
  if (!ts_root) return;
  
  const ts_track  = ts_root.querySelector('.ts-track');
  if (!ts_track) return;
  
  const ts_cards  = Array.from(ts_track.querySelectorAll('.ts-card'));
  const ts_dotsEl = document.getElementById('ts-dots');
  const ts_prev   = document.getElementById('ts-prev');
  const ts_next   = document.getElementById('ts-next');
  
  if (!ts_dotsEl || !ts_prev || !ts_next || ts_cards.length === 0) return;

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
    const cardWidth = ts_cardWidth();
    const rtlMode = isRTL();
    
    // RTL support: reverse the translation direction
    const x = rtlMode ? (ts_index * cardWidth) : -(ts_index * cardWidth);
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

(function countdownTimer() {
  const countdownEl = document.querySelector('[data-countdown-target]');
  if (!countdownEl) return;

  const targetIso = countdownEl.getAttribute('data-countdown-target');
  if (!targetIso) return;

  const targetDate = new Date(targetIso);
  if (Number.isNaN(targetDate.getTime())) {
    console.warn('Invalid countdown target datetime', targetIso);
    return;
  }

  const partElements = {
    months: countdownEl.querySelector('[data-countdown-part="months"]'),
    days: countdownEl.querySelector('[data-countdown-part="days"]'),
    minutes: countdownEl.querySelector('[data-countdown-part="minutes"]'),
  };

  const pad = (value) => String(Math.max(0, value ?? 0)).padStart(2, '0');

  const setPart = (part, value) => {
    if (!partElements[part]) return;
    partElements[part].textContent = pad(value);
  };

  const computeDiff = (from, to) => {
    if (to <= from) {
      return { months: 0, days: 0, minutes: 0 };
    }

    let months =
      (to.getFullYear() - from.getFullYear()) * 12 +
      (to.getMonth() - from.getMonth());

    const anchor = new Date(from.getTime());
    anchor.setMonth(anchor.getMonth() + months);

    if (anchor > to) {
      months -= 1;
      anchor.setMonth(anchor.getMonth() - 1);
    }

    let remaining = to.getTime() - anchor.getTime();
    const dayMs = 24 * 60 * 60 * 1000;
    const hourMs = 60 * 60 * 1000;
    const days = Math.floor(remaining / dayMs);
    remaining -= days * dayMs;

    const hours = Math.floor(remaining / hourMs);
    remaining -= hours * hourMs;

    const minutes = Math.floor(remaining / 60000);

    return {
      months: Math.max(0, months),
      days: Math.max(0, days),
      minutes: Math.max(0, minutes),
    };
  };

  let timerId;

  const tick = () => {
    const now = new Date();
    const diff = computeDiff(now, targetDate);
    setPart('months', diff.months);
    setPart('days', diff.days);
    setPart('minutes', diff.minutes);
  };

  const scheduleNextTick = () => {
    clearTimeout(timerId);
    const now = new Date();
    const msUntilNextMinute =
      60000 - (now.getSeconds() * 1000 + now.getMilliseconds());
    timerId = setTimeout(() => {
      tick();
      scheduleNextTick();
    }, Math.max(1000, msUntilNextMinute));
  };

  tick();
  scheduleNextTick();
})();
