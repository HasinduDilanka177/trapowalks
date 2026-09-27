/* ===== TrapoWalks — main.js ===== */

// ---------- 1. HERO IMAGE SLIDER (automatic + manual) ----------
(function heroSlider() {
    const slides = document.querySelectorAll('.hero-slide');
    const dotsWrap = document.getElementById('heroDots');
    if (!slides.length) return;

    let current = 0, timer;

    // Build dots
    slides.forEach((_, i) => {
        const dot = document.createElement('button');
        dot.className = 'dot' + (i === 0 ? ' active' : '');
        dot.setAttribute('aria-label', 'Go to slide ' + (i + 1));
        dot.addEventListener('click', () => { goTo(i); restart(); });
        dotsWrap.appendChild(dot);
    });
    const dots = dotsWrap.querySelectorAll('.dot');

    function goTo(n) {
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');
        current = (n + slides.length) % slides.length;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
    }
    function restart() {
        clearInterval(timer);
        timer = setInterval(() => goTo(current + 1), 5000);
    }

    document.getElementById('heroPrev').addEventListener('click', () => { goTo(current - 1); restart(); });
    document.getElementById('heroNext').addEventListener('click', () => { goTo(current + 1); restart(); });
    restart();
})();

// ---------- 2. SMOOTH SCROLLING ----------
document.querySelectorAll('.nav-smooth').forEach(link => {
    link.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            // collapse mobile menu after clicking
            const nav = document.getElementById('navMenu');
            if (nav && nav.classList.contains('show')) {
                bootstrap.Collapse.getOrCreateInstance(nav).hide();
            }
        }
    });
});

// ---------- 3. DESTINATION FILTERING (dynamic content update) ----------
(function destinationFilter() {
    const buttons = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.destination-item');
    const noResults = document.getElementById('noResults');
    if (!buttons.length) return;

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const filter = btn.dataset.filter;
            let shown = 0;

            items.forEach(item => {
                const match = filter === 'all' || item.dataset.category === filter;
                item.classList.toggle('hide', !match);
                if (match) {
                    shown++;
                    item.classList.remove('visible');
                    void item.offsetWidth; // restart animation
                    item.classList.add('visible');
                }
            });
            noResults.classList.toggle('d-none', shown > 0);
        });
    });
})();

// ---------- 4. FORM VALIDATION (client-side) ----------
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

function showErr(input, errEl, show) {
    errEl.classList.toggle('d-none', !show);
    input.classList.toggle('is-invalid', show);
}

// Registration form
const registerForm = document.getElementById('registerForm');
if (registerForm) {
    registerForm.addEventListener('submit', function (e) {
        let ok = true;
        const u = document.getElementById('username');
        const em = document.getElementById('email');
        const p = document.getElementById('password');
        const c = document.getElementById('confirmPassword');

        const uOk = u.value.trim().length >= 3;
        showErr(u, document.getElementById('usernameErr'), !uOk); ok = ok && uOk;

        const eOk = emailRegex.test(em.value.trim());
        showErr(em, document.getElementById('emailErr'), !eOk); ok = ok && eOk;

        const pOk = p.value.length >= 6;
        showErr(p, document.getElementById('passwordErr'), !pOk); ok = ok && pOk;

        const cOk = c.value === p.value && c.value !== '';
        showErr(c, document.getElementById('confirmErr'), !cOk); ok = ok && cOk;

        if (!ok) e.preventDefault();
    });
}

// Login form
const loginForm = document.getElementById('loginForm');
if (loginForm) {
    loginForm.addEventListener('submit', function (e) {
        const em = document.getElementById('loginEmail');
        const ok = emailRegex.test(em.value.trim());
        showErr(em, document.getElementById('loginEmailErr'), !ok);
        if (!ok) e.preventDefault();
    });
}

// Contact form
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
        let ok = true;
        const n = document.getElementById('cName');
        const em = document.getElementById('cEmail');
        const m = document.getElementById('cMessage');

        const nOk = n.value.trim().length >= 2;
        showErr(n, document.getElementById('cNameErr'), !nOk); ok = ok && nOk;

        const eOk = emailRegex.test(em.value.trim());
        showErr(em, document.getElementById('cEmailErr'), !eOk); ok = ok && eOk;

        const mOk = m.value.trim().length >= 10;
        showErr(m, document.getElementById('cMessageErr'), !mOk); ok = ok && mOk;

        if (!ok) e.preventDefault();
    });
}

// ---------- 5. SCROLL ANIMATIONS (fade-ins) ----------
const revealObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            revealObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.12 });
document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

// ---------- 6. ANIMATED COUNTERS ----------
const counterObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        const target = +el.dataset.target;
        let count = 0;
        const step = Math.max(1, Math.ceil(target / 90));
        const tick = setInterval(() => {
            count += step;
            if (count >= target) { count = target; clearInterval(tick); }
            el.textContent = count.toLocaleString() + (target === 98 ? '%' : '+');
        }, 22);
        counterObserver.unobserve(el);
    });
}, { threshold: 0.5 });
document.querySelectorAll('.counter').forEach(el => counterObserver.observe(el));

// ---------- 7. NAVBAR + BACK-TO-TOP ON SCROLL ----------
const nav = document.getElementById('mainNav');
const backToTop = document.getElementById('backToTop');
window.addEventListener('scroll', () => {
    if (nav) nav.classList.toggle('scrolled', window.scrollY > 60);
    if (backToTop) backToTop.style.display = window.scrollY > 400 ? 'flex' : 'none';
});
if (backToTop) {
    backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
}

// ---------- 8. EVENT HANDLING — hover tooltips on destination cards ----------
document.querySelectorAll('.dest-card img').forEach(img => {
    img.title = 'Click the filter buttons above to explore more like this!';
});
