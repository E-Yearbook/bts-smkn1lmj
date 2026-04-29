// resources/js/app.js

import './bootstrap';
import './bundle';
import './fix-debugger';


// === TailAdmin + Alpine.js ===
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';   // kalau TailAdmin pakai persist

Alpine.plugin(persist);   // tambahkan ini jika ada error persist

window.Alpine = Alpine;
Alpine.start();

// === Kode Frontend Kamu ===
import Lenis from '@studio-freight/lenis';

const lenis = new Lenis();

function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}
requestAnimationFrame(raf);

// Scroll Animation (AOS)
import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init({
    duration: 800,
    once: true
});

// Swiper
import Swiper from 'swiper';
import { EffectCoverflow, Pagination, Navigation, Autoplay } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/effect-coverflow';
import 'swiper/css/pagination';
import 'swiper/css/navigation';

Swiper.use([EffectCoverflow, Pagination, Navigation, Autoplay]);
window.Swiper = Swiper;

// Tambahkan kode custom kamu di sini jika perlu
document.addEventListener('alpine:init', () => {
    console.log('Alpine.js + Frontend siap');
});
