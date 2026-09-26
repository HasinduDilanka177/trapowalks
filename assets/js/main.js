document.addEventListener('DOMContentLoaded', () => {
    setupSmoothScroll();
    setupSlider();
    setupFiltering();
    setupToggler();
    setupFormValidation();
    setupFadeInAnimation();
});

function setupSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach((link) => {
        link.addEventListener('click', (event) => {
            const targetId = link.getAttribute('href');
            if (targetId && targetId.length > 1) {
                const target = document.querySelector(targetId);
                if (target) {
                    event.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });
}

function setupSlider() {
    const slider = document.querySelector('[data-slider]');
    if (!slider) return;

    const slides = slider.querySelectorAll('img');
    if (slides.length === 0) return;

    let currentIndex = 0;

    const render = () => {
        slides.forEach((slide, index) => {
            slide.classList.toggle('active', index === currentIndex);
        });
    };

    const next = () => {
        currentIndex = (currentIndex + 1) % slides.length;
        render();
    };

    const prev = () => {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        render();
    };

    document.querySelector('[data-slider-next]')?.addEventListener('click', next);
    document.querySelector('[data-slider-prev]')?.addEventListener('click', prev);

    render();
    setInterval(next, 4000);
}

function setupFiltering() {
    const filterButtons = document.querySelectorAll('[data-filter]');
    const cards = document.querySelectorAll('[data-filter-container] [data-level]');
    if (filterButtons.length === 0 || cards.length === 0) return;

    filterButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const selected = button.getAttribute('data-filter');
            cards.forEach((card) => {
                const level = card.getAttribute('data-level');
                const show = selected === 'all' || selected === level;
                card.style.display = show ? 'block' : 'none';
            });
        });
    });
}

function setupToggler() {
    document.querySelectorAll('[data-toggle-target]').forEach((button) => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-toggle-target');
            const target = targetId ? document.getElementById(targetId) : null;
            if (!target) return;

            target.hidden = !target.hidden;
        });
    });
}

function setupFormValidation() {
    const forms = document.querySelectorAll('form[data-validate]');
    forms.forEach((form) => {
        form.addEventListener('submit', (event) => {
            let valid = true;
            const requiredInputs = form.querySelectorAll('input[required], textarea[required]');

            requiredInputs.forEach((input) => {
                const trimmedValue = input.value.trim();
                const isEmail = input.getAttribute('type') === 'email';
                const emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(trimmedValue);
                const inputValid = trimmedValue !== '' && (!isEmail || emailValid);

                input.classList.toggle('invalid', !inputValid);
                if (!inputValid) valid = false;
            });

            if (!valid) {
                event.preventDefault();
            }
        });
    });
}

function setupFadeInAnimation() {
    const sections = document.querySelectorAll('.fade-in');
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        sections.forEach((section) => observer.observe(section));
    } else {
        sections.forEach((section) => section.classList.add('visible'));
    }
}
