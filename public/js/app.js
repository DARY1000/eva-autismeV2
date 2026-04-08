/* ============================================================
   EVA AUTISME - JavaScript principal
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {

    /* ---- NAVBAR BURGER ---- */
    const burger = document.querySelector('.navbar-burger');
    const navMenu = document.querySelector('.navbar-menu');
    const overlay = document.getElementById('nav-overlay');

    if (burger && navMenu) {
        burger.addEventListener('click', () => {
            burger.classList.toggle('open');
            navMenu.classList.toggle('open');
            if (overlay) overlay.classList.toggle('active');
            document.body.style.overflow = navMenu.classList.contains('open') ? 'hidden' : '';
        });
        if (overlay) {
            overlay.addEventListener('click', () => {
                burger.classList.remove('open');
                navMenu.classList.remove('open');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        }
        const closeBtn = document.getElementById('nav-close-btn');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                burger.classList.remove('open');
                navMenu.classList.remove('open');
                if (overlay) overlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        }
    }

    /* Mobile dropdown toggle */
    document.querySelectorAll('.nav-item .nav-link').forEach(link => {
        if (link.nextElementSibling && link.nextElementSibling.classList.contains('dropdown')) {
            link.addEventListener('click', (e) => {
                if (window.innerWidth <= 900) {
                    e.preventDefault();
                    const parent = link.parentElement;
                    const isOpen = parent.classList.contains('open');
                    document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('open'));
                    if (!isOpen) parent.classList.add('open');
                }
            });
        }
    });

    /* ---- HERO SLIDER ---- */
    const heroSlides = document.querySelector('.hero-slides');
    const dots = document.querySelectorAll('.hero-dot');
    const totalSlides = document.querySelectorAll('.hero-slide').length;
    let current = 0;
    let autoTimer;

    function goTo(n) {
        current = (n + totalSlides) % totalSlides;
        if (heroSlides) heroSlides.style.transform = `translateX(-${current * 100}%)`;
        dots.forEach((d, i) => d.classList.toggle('active', i === current));
    }

    function startAuto() {
        clearInterval(autoTimer);
        autoTimer = setInterval(() => goTo(current + 1), 5500);
    }

    if (heroSlides && totalSlides > 0) {
        goTo(0);
        startAuto();
        document.querySelector('.hero-prev')?.addEventListener('click', () => { goTo(current - 1); startAuto(); });
        document.querySelector('.hero-next')?.addEventListener('click', () => { goTo(current + 1); startAuto(); });
        dots.forEach((d, i) => d.addEventListener('click', () => { goTo(i); startAuto(); }));

        // Swipe support
        let touchStartX = 0;
        heroSlides.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; });
        heroSlides.addEventListener('touchend', e => {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 50) { goTo(diff > 0 ? current + 1 : current - 1); startAuto(); }
        });
    }

    /* ---- ACCORDION ---- */
    document.querySelectorAll('.accordion-header').forEach(header => {
        header.addEventListener('click', () => {
            const isActive = header.classList.contains('active');
            // Close all
            document.querySelectorAll('.accordion-header').forEach(h => {
                h.classList.remove('active');
                h.nextElementSibling?.classList.remove('open');
            });
            if (!isActive) {
                header.classList.add('active');
                header.nextElementSibling?.classList.add('open');
            }
        });
    });

    /* ---- TABS ---- */
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const target = btn.dataset.tab;
            const container = btn.closest('.tabs-wrapper') || document;
            container.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            container.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            btn.classList.add('active');
            container.querySelector(`#${target}`)?.classList.add('active');
        });
    });

    /* ---- COUNTER ANIMATION ---- */
    const counters = document.querySelectorAll('.stat-number[data-target]');
    const observerOpts = { threshold: 0.5 };
    const counterObs = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            const target = parseInt(el.dataset.target);
            const suffix = el.dataset.suffix || '';
            const duration = 1800;
            const start = Date.now();
            const update = () => {
                const elapsed = Date.now() - start;
                const progress = Math.min(elapsed / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                el.innerHTML = `${Math.floor(eased * target)}<span>${suffix}</span>`;
                if (progress < 1) requestAnimationFrame(update);
            };
            requestAnimationFrame(update);
            counterObs.unobserve(el);
        });
    }, observerOpts);
    counters.forEach(c => counterObs.observe(c));

    /* ---- LIGHTBOX ---- */
    const lightbox = document.getElementById('lightbox');
    if (lightbox) {
        const lightboxImg = lightbox.querySelector('img');
        document.querySelectorAll('[data-lightbox]').forEach(trigger => {
            trigger.addEventListener('click', () => {
                lightboxImg.src = trigger.dataset.lightbox;
                lightbox.classList.add('open');
                document.body.style.overflow = 'hidden';
            });
        });
        lightbox.addEventListener('click', e => {
            if (e.target === lightbox || e.target.classList.contains('lightbox-close')) {
                lightbox.classList.remove('open');
                document.body.style.overflow = '';
            }
        });
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') { lightbox.classList.remove('open'); document.body.style.overflow = ''; }
        });
    }

    /* ---- SCROLL-REVEAL ---- */
    const revealObs = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                revealObs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });
    document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));

    /* ---- FLASH MESSAGES AUTO CLOSE ---- */
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.4s ease';
            setTimeout(() => alert.remove(), 400);
        }, 4500);
    });

    /* ---- STICKY NAVBAR SHADOW ---- */
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 40);
        }, { passive: true });
    }

});
