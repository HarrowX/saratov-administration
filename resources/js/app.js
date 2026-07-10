
import './bootstrap';
import './scripts/journey'
import './scripts/notification';
import './scripts/gallery';
import './scripts/slider';
import './scripts/yandex-map';

import './scripts/calendar';

const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const mobileMenu = document.getElementById('mobileMenu');

mobileMenuBtn?.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
});

function closeMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    const menuBtn = document.getElementById('mobileMenuBtn');
    if (menu && !menu.classList.contains('hidden')) {
        menu.classList.add('hidden');
        const hamIcon = menuBtn?.querySelector('.ham');
        if (hamIcon) {
            hamIcon.classList.remove('active');
        }
    }
}

document.addEventListener('click', function(e) {
    const menu = document.getElementById('mobileMenu');
    const menuBtn = document.getElementById('mobileMenuBtn');

    if (menu && !menu.classList.contains('hidden')) {
        const isClickInsideMenu = menu.contains(e.target);
        const isClickOnButton = menuBtn && menuBtn.contains(e.target);

        if (!isClickInsideMenu && !isClickOnButton) {
            closeMobileMenu();
        }
    }
})

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeMobileMenu();
    }
});

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            const offset = 80; // Navigation height
            const targetPosition = target.offsetTop - offset;
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
            closeMobileMenu();
        }
    });
});

function animateCounter(element, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        element.textContent = Math.floor(progress * (end - start) + start);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

// Animate counters on scroll
const observerOptions = {
    threshold: 0.5,
    rootMargin: '0px'
};

const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const counter = entry.target;
            const target = parseInt(counter.textContent);
            animateCounter(counter, 0, target, 2000);
            counterObserver.unobserve(counter);
        }
    });
}, observerOptions);

// Observe all counters
document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        counterObserver.observe(counter);
    });
});

