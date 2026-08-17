//swiper
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay} from 'swiper/modules';
import { Thumbs } from "swiper/modules";
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

function placeDetailSwiper() {
    const wrapper = document.querySelector(".gallery-detail-swiper");
    if (!wrapper) return;
    if (wrapper) {
        wrapper.style.opacity = '1';
    }

    const main = wrapper.querySelector(".place-detail-swiper-main");
    const thumbs = wrapper.querySelector(".place-detail-swiper-thumbs");
    if (!main) return;

    const hasThumbs = thumbs && thumbs.querySelectorAll('.swiper-slide').length > 0;

    if (!hasThumbs) {
        const mainSwiper = new Swiper(main, {
            modules: [Pagination, Navigation, Autoplay],
            loop: true,
            roundLengths: true,
            slidesPerView: 1,
            watchOverflow: true,
            pagination: {
                el: '.main-pagination',
                clickable: true,
                dynamicBullets: true,
                dynamicMainBullets: 4,
            },
            navigation: {
                nextEl: '.button-navigation--main-right',
                prevEl: '.button-navigation--main-left',
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
                pauseOnMouseEnter: false,
            },
        });
        return;
    }

    const thumbsSwiper = new Swiper(thumbs, {
        modules: [Thumbs, Navigation, Autoplay],
        slidesPerView: 5,
        spaceBetween: 10,
        breakpoints: {
            1024: {
                spaceBetween: 10,
            },
            1920: {
                spaceBetween: 10,
            }
        },
        loop: false,
        roundLengths: true,
        slideToClickedSlide: true,
        watchSlidesProgress: true,
        navigation: {
            nextEl: '.thumbs-button-next',
            prevEl: '.thumbs-button-prev',
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: false,
        },
    });

    const mainSwiper = new Swiper(main, {
        modules: [Thumbs, Pagination, Navigation, Autoplay],
        loop: true,
        roundLengths: true,
        slidesPerView: 'auto',
        watchOverflow: true,
        thumbs: {
            swiper: thumbsSwiper,
            autoScrollOffset: 1,
        },
        pagination: {
            el: '.main-pagination',
            clickable: true,
            dynamicBullets: true,
            dynamicMainBullets: 4,
        },
        navigation: {
            nextEl: '.button-navigation--main-right',
            prevEl: '.button-navigation--main-left',
        },
        on: {
            init: function() {
                this.autoplay.start();
            }
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: false,
        },

    });
}

document.addEventListener('DOMContentLoaded', () => {
    placeDetailSwiper();
});
