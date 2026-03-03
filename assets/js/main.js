// ===================================================
// Nandhu's Beauty Salon — Main JavaScript
// ===================================================

(function () {
    'use strict';

    // ---- Hamburger Menu ----
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('navLinks');

    if (hamburger && navLinks) {
        hamburger.addEventListener('click', () => {
            const isOpen = navLinks.classList.toggle('open');
            hamburger.setAttribute('aria-expanded', isOpen);
        });
        // Close on outside click
        document.addEventListener('click', (e) => {
            if (!hamburger.contains(e.target) && !navLinks.contains(e.target)) {
                navLinks.classList.remove('open');
                hamburger.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // ---- Sticky Navbar shadow on scroll ----
    const navbar = document.getElementById('navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            navbar.style.boxShadow = window.scrollY > 20
                ? '0 4px 32px rgba(93,58,58,0.12)'
                : '';
        }, { passive: true });
    }

    // ---- Scroll Reveal Animation ----
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    document.querySelectorAll('.service-card, .testimonial-card, .mission-card, .why-item, .contact-card, .gallery-item')
        .forEach(el => {
            el.classList.add('fade-in');
            observer.observe(el);
        });

    // ---- Gallery Lightbox ----
    const lightbox = document.getElementById('lightbox');
    const lbImg = document.getElementById('lbImg');
    const lbClose = document.getElementById('lbClose');
    const lbPrev = document.getElementById('lbPrev');
    const lbNext = document.getElementById('lbNext');
    let lbImages = [];
    let lbCurrent = 0;

    document.querySelectorAll('[data-lightbox]').forEach((el, idx) => {
        el.setAttribute('data-lb-index', idx);
        lbImages.push(el.dataset.lightbox);
        el.addEventListener('click', () => openLightbox(idx));
    });

    function openLightbox(idx) {
        if (!lightbox) return;
        lbCurrent = idx;
        lbImg.src = lbImages[idx];
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        if (!lightbox) return;
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
        lbImg.src = '';
    }

    function showNext() {
        lbCurrent = (lbCurrent + 1) % lbImages.length;
        lbImg.src = lbImages[lbCurrent];
    }

    function showPrev() {
        lbCurrent = (lbCurrent - 1 + lbImages.length) % lbImages.length;
        lbImg.src = lbImages[lbCurrent];
    }

    if (lbClose) lbClose.addEventListener('click', closeLightbox);
    if (lbNext) lbNext.addEventListener('click', showNext);
    if (lbPrev) lbPrev.addEventListener('click', showPrev);
    if (lightbox) {
        lightbox.addEventListener('click', (e) => { if (e.target === lightbox) closeLightbox(); });
    }
    document.addEventListener('keydown', (e) => {
        if (!lightbox || !lightbox.classList.contains('active')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') showNext();
        if (e.key === 'ArrowLeft') showPrev();
    });

    // ---- Date Picker: block past dates ----
    const datePicker = document.getElementById('appointment_date');
    if (datePicker) {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        datePicker.min = `${yyyy}-${mm}-${dd}`;
    }

    // ---- Booking Form: live validation feedback ----
    const bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
        bookingForm.addEventListener('submit', (e) => {
            let valid = true;
            bookingForm.querySelectorAll('[required]').forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    valid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            if (!valid) {
                e.preventDefault();
                const firstErr = bookingForm.querySelector('.is-invalid');
                if (firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else {
                const btn = bookingForm.querySelector('[type="submit"]');
                if (btn) { btn.textContent = 'Booking…'; btn.disabled = true; }
            }
        });

        bookingForm.querySelectorAll('.form-control').forEach(field => {
            field.addEventListener('input', () => field.classList.remove('is-invalid'));
        });
    }

    // ---- Contact Form submit feedback ----
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            const btn = contactForm.querySelector('[type="submit"]');
            if (btn && contactForm.checkValidity()) {
                btn.textContent = 'Sending…'; btn.disabled = true;
            }
        });
    }

    // ---- Smooth scroll for anchor links ----
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ---- CSS fade-in animation (injected once) ----
    const style = document.createElement('style');
    style.textContent = `
        .fade-in { opacity: 0; transform: translateY(24px); transition: opacity 0.55s ease, transform 0.55s ease; }
        .fade-in.visible { opacity: 1; transform: translateY(0); }
    `;
    document.head.appendChild(style);

})();
