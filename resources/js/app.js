import './bootstrap';

import { livewire_hot_reload } from 'virtual:livewire-hot-reload'

livewire_hot_reload();

// import Swiper and modules styles
import 'swiper/css';
//import 'swiper/css/navigation';
import 'swiper/css/pagination';

import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

window.Swiper=Swiper;
window.Navigation=Navigation;
window.Pagination=Pagination;



// import Alpine from 'alpinejs';
// window.Alpine = Alpine;
// import intersect from '@alpinejs/intersect'
// Alpine.plugin(intersect)
// Alpine.start();

// core version + navigation, pagination modules:






// import Swiper from 'swiper';
// import { Navigation, Pagination } from 'swiper/modules';
// // import Swiper and modules styles
// import 'swiper/css';
// import 'swiper/css/navigation';
// import 'swiper/css/pagination';

// // init Swiper:
// const swiper = new Swiper('.swiper', {
//     // configure Swiper to use modules
//     modules: [Navigation, Pagination],
//     pagination: {
//         el: '.swiper-pagination',
//     },
//     // Navigation arrows
//     navigation: {
//         nextEl: '.swiper-button-next',
//         prevEl: '.swiper-button-prev',
//     },
// });

