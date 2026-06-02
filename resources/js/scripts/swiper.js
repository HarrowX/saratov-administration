// swiper
import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

document.addEventListener('DOMContentLoaded', function() {

  const swiperElement = document.querySelector('.job-swiper__swiper');

    const swiper = new Swiper('.job-swiper__swiper', {
      modules: [Navigation, Pagination],

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
