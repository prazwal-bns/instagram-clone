import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

window.Swiper=Swiper;
window.Navigation=Navigation;
window.Pagination=Pagination;

// import Swiper and modules styles
import 'swiper/css';
//import 'swiper/css/navigation';
import 'swiper/css/pagination';


import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

// import './echo';
