(() => {
  const root = document.documentElement;
  const motion = root.classList.contains('motion');
  const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;

  document.querySelectorAll('[data-year]').forEach((el) => { el.textContent = new Date().getFullYear(); });

  /* ---------- Navigation ---------- */
  const header = document.querySelector('.site-header');
  const toggle = document.querySelector('.nav-toggle');
  const nav = document.querySelector('.site-nav');
  const mobile = window.matchMedia('(max-width: 960px)');
  nav?.querySelectorAll('li').forEach((li, i) => li.querySelector('.nav-link')?.style.setProperty('--i', i));
  const setOpen = (open) => {
    if (!toggle || !nav) return;
    nav.classList.toggle('is-open', open);
    toggle.classList.toggle('is-open', open);
    header?.classList.toggle('nav-is-open', open);
    toggle.setAttribute('aria-expanded', String(open));
    toggle.setAttribute('aria-label', open ? 'メニューを閉じる' : 'メニューを開く');
    document.body.classList.toggle('nav-open', open);
    nav.inert = mobile.matches && !open;
    if (open) header?.classList.remove('is-hidden');
  };
  if (toggle && nav) {
    setOpen(false);
    toggle.addEventListener('click', () => setOpen(toggle.getAttribute('aria-expanded') !== 'true'));
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && nav.classList.contains('is-open')) { setOpen(false); toggle.focus(); }
    });
    nav.addEventListener('click', (event) => { if (event.target.closest('a')) setOpen(false); });
    mobile.addEventListener('change', () => setOpen(false));
  }

  /* ---------- Dropdown groups (WordPress menus) ---------- */
  document.querySelectorAll('.nav-link--group').forEach((button) => {
    const item = button.closest('.menu-item-has-children');
    button.addEventListener('click', () => {
      const open = !item.classList.contains('is-submenu-open');
      document.querySelectorAll('.is-submenu-open').forEach((other) => {
        if (other !== item) {
          other.classList.remove('is-submenu-open');
          other.querySelector('.nav-link--group')?.setAttribute('aria-expanded', 'false');
        }
      });
      item.classList.toggle('is-submenu-open', open);
      button.setAttribute('aria-expanded', String(open));
    });
  });
  document.addEventListener('click', (event) => {
    if (mobile.matches || event.target.closest('.menu-item-has-children')) return;
    document.querySelectorAll('.is-submenu-open').forEach((item) => {
      item.classList.remove('is-submenu-open');
      item.querySelector('.nav-link--group')?.setAttribute('aria-expanded', 'false');
    });
  });

  /* ---------- Article table of contents ---------- */
  const toc = document.querySelector('[data-toc]');
  const content = document.querySelector('.entry-content');
  if (toc && content) {
    const headings = [...content.querySelectorAll(':scope > h2, :scope > h3, :scope > .wp-block-group h2')];
    if (headings.length >= 2) {
      const list = toc.querySelector('ol');
      const used = new Set();
      headings.forEach((heading, i) => {
        if (!heading.id) {
          let id = `section-${i + 1}`;
          while (used.has(id) || document.getElementById(id)) id += '-x';
          heading.id = id;
        }
        used.add(heading.id);
        const li = document.createElement('li');
        li.className = heading.tagName === 'H3' ? 'is-sub' : '';
        const link = document.createElement('a');
        link.href = `#${heading.id}`;
        link.textContent = heading.textContent.trim();
        li.append(link);
        list.append(li);
      });
      toc.hidden = false;
      if ('IntersectionObserver' in window) {
        const links = new Map([...toc.querySelectorAll('a')].map((a) => [a.getAttribute('href').slice(1), a]));
        const spy = new IntersectionObserver((entries) => {
          entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            links.forEach((a) => a.classList.remove('is-current'));
            links.get(entry.target.id)?.classList.add('is-current');
          });
        }, { rootMargin: '-20% 0px -70% 0px' });
        headings.forEach((h) => spy.observe(h));
      }
    }
  }

  /* ---------- Toast + copy ---------- */
  let toast;
  const showToast = (message) => {
    if (!toast) {
      toast = document.createElement('div');
      toast.className = 'toast';
      toast.setAttribute('role', 'status');
      document.body.append(toast);
    }
    toast.textContent = message;
    toast.classList.add('is-visible');
    clearTimeout(showToast.timer);
    showToast.timer = setTimeout(() => toast.classList.remove('is-visible'), 1800);
  };
  document.querySelectorAll('[data-copy-text]').forEach((button) => {
    button.addEventListener('click', async () => {
      const text = button.dataset.copyText;
      try {
        await navigator.clipboard.writeText(text);
        showToast(button.dataset.copyLabel || `${text} をコピーしました`);
      } catch {
        showToast(`コピーできませんでした。接続先: ${text}`);
      }
    });
  });

  /* ---------- Kinetic headings ---------- */
  document.querySelectorAll('[data-split]').forEach((el) => {
    const label = el.textContent.replace(/\s+/g, ' ').trim();
    const lines = el.innerHTML.split(/<br\s*\/?>/i);
    let index = 0;
    el.innerHTML = lines.map((line) => {
      const temp = document.createElement('div');
      temp.innerHTML = line;
      const chars = [...temp.textContent.trim()].map((ch) => `<span class="char" style="--i:${index++}">${ch === '&' ? '&amp;' : ch === '<' ? '&lt;' : ch}</span>`).join('');
      return `<span class="line" aria-hidden="true">${chars}</span>`;
    }).join('');
    el.setAttribute('aria-label', label);
    el.classList.add('split');
  });

  /* ---------- Ready state (after the intro loader on home) ---------- */
  const markReady = () => root.classList.add('is-ready');
  if (root.classList.contains('has-loader')) {
    const start = performance.now();
    const done = () => setTimeout(markReady, Math.max(0, 1100 - (performance.now() - start)));
    if (document.readyState === 'complete') done(); else window.addEventListener('load', done, { once: true });
    setTimeout(markReady, 2600);
  } else {
    requestAnimationFrame(markReady);
  }

  /* ---------- Reveal on scroll ---------- */
  const revealTargets = document.querySelectorAll('[data-reveal], .split, .footer-wordmark, [data-count]');
  if (!motion || !('IntersectionObserver' in window)) {
    revealTargets.forEach((el) => el.classList.add('is-in'));
  } else {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        (entry.target.__revealChild || entry.target).classList.add('is-in');
        if (entry.target.hasAttribute('data-count')) countUp(entry.target);
        io.unobserve(entry.target);
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -6% 0px' });
    revealTargets.forEach((el) => {
      // A clipped (wiped) frame has no visible area, so watch its parent instead.
      if (el.dataset.reveal === 'wipe' && el.parentElement) {
        el.parentElement.__revealChild = el;
        io.observe(el.parentElement);
      } else {
        io.observe(el);
      }
    });
  }

  function countUp(el) {
    const target = Number(el.dataset.count);
    if (!Number.isFinite(target)) return;
    const suffix = el.dataset.suffix || '';
    const duration = 1400;
    const t0 = performance.now();
    const tick = (now) => {
      const p = Math.min(1, (now - t0) / duration);
      const eased = 1 - Math.pow(1 - p, 4);
      el.textContent = `${Math.round(target * eased)}${suffix}`;
      if (p < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  }

  /* ---------- Card spotlight ---------- */
  if (finePointer) {
    document.addEventListener('pointermove', (event) => {
      const card = event.target.closest?.('.card, .world-panel');
      if (!card) return;
      const rect = card.getBoundingClientRect();
      card.style.setProperty('--mx', `${event.clientX - rect.left}px`);
      card.style.setProperty('--my', `${event.clientY - rect.top}px`);
    }, { passive: true });
  }

  /* ---------- Magnetic buttons ---------- */
  if (motion && finePointer) {
    document.querySelectorAll('[data-magnetic]').forEach((el) => {
      el.style.transition = 'transform 500ms cubic-bezier(0.16, 1, 0.3, 1), color 300ms, border-color 300ms';
      el.addEventListener('pointermove', (event) => {
        const rect = el.getBoundingClientRect();
        const x = (event.clientX - rect.left - rect.width / 2) * 0.22;
        const y = (event.clientY - rect.top - rect.height / 2) * 0.32;
        el.style.transform = `translate(${x}px, ${y}px)`;
      });
      el.addEventListener('pointerleave', () => { el.style.transform = ''; });
    });
  }

  /* ---------- Scroll-linked effects ---------- */
  const progress = document.querySelector('.scroll-progress');
  const hero = document.querySelector('[data-hero]');
  const parallax = [...document.querySelectorAll('[data-parallax]')];
  const hscroll = document.querySelector('[data-hscroll]');
  const track = hscroll?.querySelector('[data-hscroll-track]');
  const hbar = hscroll?.querySelector('[data-hscroll-bar]');
  const wide = window.matchMedia('(min-width: 1101px)');
  let pinned = false;
  let lastY = window.scrollY;

  const layoutHScroll = () => {
    if (!hscroll || !track) return;
    pinned = motion && wide.matches;
    hscroll.classList.toggle('is-pinned', pinned);
    if (!pinned) {
      hscroll.style.height = '';
      track.style.transform = '';
      return;
    }
    const distance = Math.max(0, track.scrollWidth - window.innerWidth);
    hscroll.style.height = `${distance + window.innerHeight}px`;
    hscroll.dataset.distance = String(distance);
  };

  const update = () => {
    const y = window.scrollY;
    const vh = window.innerHeight;
    const max = document.documentElement.scrollHeight - vh;
    progress?.style.setProperty('--progress', max > 0 ? (y / max).toFixed(4) : '0');

    if (header) {
      header.classList.toggle('is-scrolled', y > 24);
      const navOpen = nav?.classList.contains('is-open');
      if (!navOpen && y > 240 && y > lastY + 4) header.classList.add('is-hidden');
      else if (y < lastY - 4 || y <= 240) header.classList.remove('is-hidden');
    }
    lastY = y;

    if (!motion) return;

    if (hero) {
      const p = Math.min(1, Math.max(0, y / (hero.offsetHeight || vh)));
      hero.style.setProperty('--hero-p', p.toFixed(4));
    }

    parallax.forEach((el) => {
      const rect = el.getBoundingClientRect();
      if (rect.bottom < -200 || rect.top > vh + 200) return;
      const speed = Number(el.dataset.parallax) || 0.1;
      const offset = (rect.top + rect.height / 2 - vh / 2) * -speed;
      el.style.transform = `translate3d(0, ${offset.toFixed(1)}px, 0)`;
    });

    if (pinned && track) {
      const start = hscroll.offsetTop;
      const distance = Number(hscroll.dataset.distance) || 0;
      const p = distance ? Math.min(1, Math.max(0, (y - start) / distance)) : 0;
      track.style.transform = `translate3d(${(-p * distance).toFixed(1)}px, 0, 0)`;
      hbar?.style.setProperty('--p', p.toFixed(4));
    }
  };

  let ticking = false;
  const onScroll = () => {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(() => { update(); ticking = false; });
  };

  layoutHScroll();
  update();
  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', () => { layoutHScroll(); update(); });
  window.addEventListener('load', () => { layoutHScroll(); update(); });
  wide.addEventListener?.('change', () => { layoutHScroll(); update(); });
})();
