
// slider
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

document.addEventListener('DOMContentLoaded', () => {
    const swiper = new Swiper('.job-swiper__swiper', {
        modules: [Navigation, Pagination, Autoplay],

        slidesPerView: 1,
        spaceBetween: 24,

        loop: true,

        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },

        navigation: {
            nextEl: '.button-navigation--job-right',
            prevEl: '.button-navigation--job-left',
        },

        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
    });
});


let currentSlide = 0;
const slides = document.querySelectorAll('.slider-slide');
const dots = document.querySelectorAll('.slider-dot');
let slideInterval;


// Initialize slider
function initSlider() {
    if (slides.length === 0) return;

    // Show first slide
    showSlide(0);

    // Start auto-slide
    startAutoSlide();
}

// Show specific slide
function showSlide(index) {
    // Hide all slides
    slides.forEach((slide, i) => {
        slide.classList.remove('active');
        slide.style.opacity = '0';
        slide.style.visibility = 'hidden';
    });

    // Hide all dots
    dots.forEach(dot => {
        dot.classList.remove('active');
        dot.classList.add('bg-white/50');
        dot.classList.remove('bg-white');
    });

    // Show current slide
    currentSlide = index;
    slides[currentSlide].classList.add('active');
    slides[currentSlide].style.opacity = '1';
    slides[currentSlide].style.visibility = 'visible';

    // Highlight current dot
    if (dots[currentSlide]) {
        dots[currentSlide].classList.add('active');
        dots[currentSlide].classList.remove('bg-white/50');
        dots[currentSlide].classList.add('bg-white');
    }
}

// Next slide
function nextSlide() {
    const nextIndex = (currentSlide + 1) % slides.length;
    showSlide(nextIndex);
    resetAutoSlide();
}

// Previous slide
function prevSlide() {
    const prevIndex = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(prevIndex);
    resetAutoSlide();
}

// Go to specific slide
function goToSlide(index) {
    showSlide(index);
    resetAutoSlide();
}

// Start auto-slide
function startAutoSlide() {
    slideInterval = setInterval(() => {
        nextSlide();
    }, 7000); // Change slide every 7 seconds
}

// Reset auto-slide timer
function resetAutoSlide() {
    clearInterval(slideInterval);
    startAutoSlide();
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', initSlider);

