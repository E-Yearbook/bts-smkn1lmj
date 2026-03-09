document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".yearbookSwiper", {
        loop: true,

        centeredSlides: true,

        slidesPerView: 3,

        spaceBetween: 40,

        effect: "coverflow",

        grabCursor: true,

        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 180,
            modifier: 1.8,
            slideShadows: false,
        },

        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },

        speed: 900,
    });
});
