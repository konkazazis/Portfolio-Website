import './bootstrap';

// resources/js/app.js
// Scroll-reveal + sticky-header behaviour. No dependencies.
// Content is visible by default; we only opt into the hide/animate
// path once JS confirms it can run — so it degrades gracefully.

document.documentElement.classList.add('js');

(function () {
    'use strict';

    // Sticky header hairline on scroll
    const head = document.getElementById('siteHead');
    const onScroll = () => head && head.classList.toggle('scrolled', window.scrollY > 8);
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // Mobile "Menu" jumps to contact
    const navToggle = document.getElementById('navToggle');
    navToggle?.addEventListener('click', () =>
        document.getElementById('contact')?.scrollIntoView({ behavior: 'smooth' })
    );

    // Scroll reveal
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const els = Array.from(document.querySelectorAll('.reveal'));
    const show = (el) => el.classList.add('in');
    const inView = (el) => {
        const r = el.getBoundingClientRect();
        const h = window.innerHeight || document.documentElement.clientHeight;
        return r.top < h * 0.92 && r.bottom > 0;
    };

    if (reduce || !('IntersectionObserver' in window)) {
        els.forEach(show);
        return;
    }

    const io = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
            if (e.isIntersecting) { show(e.target); io.unobserve(e.target); }
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -6% 0px' });

    els.forEach((el) => io.observe(el));
    requestAnimationFrame(() => els.forEach((el) => inView(el) && show(el)));
    // Failsafe: never leave content invisible.
    setTimeout(() => els.forEach(show), 1600);
})();
