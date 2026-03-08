import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


import AOS from "aos";
import 'aos/dist/aos.css'

AOS.init({
    duration: 1000,
    once: true,
    offset: 100
});
