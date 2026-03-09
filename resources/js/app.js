import './bootstrap';

import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()

// Smooth Scroll (Lenis)
import Lenis from '@studio-freight/lenis'

const lenis = new Lenis()

function raf(time) {
    lenis.raf(time)
    requestAnimationFrame(raf)
}

requestAnimationFrame(raf)


// Scroll Animation (AOS)
import AOS from 'aos'
import 'aos/dist/aos.css'

AOS.init({
    duration: 800,
    once: true
})


import Swiper from 'swiper'
import { EffectCoverflow, Pagination, Navigation, Autoplay } from 'swiper/modules'

import 'swiper/css'
import 'swiper/css/effect-coverflow'
import 'swiper/css/pagination'
import 'swiper/css/navigation'

Swiper.use([EffectCoverflow, Pagination, Navigation, Autoplay])

window.Swiper = Swiper
