@extends('layouts.index')
@section('content')

<section class="relative min-h-screen bg-[#f8f7f4] flex items-center overflow-hidden">
    {{-- decoration --}}
    <div class="absolute top-[-120px] right-[-100px] w-[520px] h-[520px] rounded-full bg-blue-500/[0.07] blur-[90px] pointer-events-none"></div>
    <div class="absolute bottom-[-100px] left-[-80px] w-[420px] h-[420px] rounded-full bg-indigo-500/[0.06] blur-[80px] pointer-events-none"></div>
    <div class="absolute inset-0 pointer-events-none"
        style="background-image: linear-gradient(rgba(0,0,0,0.028) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,0.028) 1px, transparent 1px); background-size: 42px 42px;">
</div>

    {{-- content section --}}
    <div class="relative z-10 w-full max-w-5xl mx-auto px-6 py-12">
        {{-- header --}}
        <div class="text-center mb-14" data-aos="fade-down" data-aos-duration="700">
            <span class="inline-flex items-center gap-2.5 font-mono text-[11px] font-bold tracking-[0.3em] text-indigo-500 uppercase mb-5">
                <span class="w-1 h-1 rounded-full bg-indigo-500 inline-block"></span>
                E-Yearbook
                <span class="w-1 h-1 rounded-full bg-indigo-500 inline-block"></span>
            </span>
            <h1 class="text-4xl md:text-5xl font-normal italic text-gray-900 tracking-tight leading-tight mb-3">
                Pilih Buku Angkatan
            </h1>
            <p class="font-mono text-xs text-gray-400 tracking-wider">
                Jelajahi kenangan indah dari setiap generasi
            </p>
        </div>

        {{-- Swiper area — outer wrapper holds arrows + swiper + pagination --}}
        <div class="relative" data-aos="fade-up" data-aos-duration="800" data-aos-delay="150">

            {{-- Arrow PREV — sits outside swiper, vertically centered on card only (not label) --}}
            <button class="ybk-prev swiper-button-prev
                           absolute left-0 z-20
                           w-10 h-10 rounded-full bg-white border border-black/[0.08] shadow-md
                           flex items-center justify-center text-gray-400 cursor-pointer
                           transition-all duration-200
                           hover:bg-indigo-500 hover:text-white hover:border-indigo-500
                           hover:shadow-[0_4px_18px_rgba(99,102,241,0.3)]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
            </button>

            {{-- Arrow NEXT --}}
            <button class="ybk-next swiper-button-next
                           absolute right-0 z-20
                           w-10 h-10 rounded-full bg-white border border-black/[0.08] shadow-md
                           flex items-center justify-center text-gray-400 cursor-pointer
                           transition-all duration-200
                           hover:bg-indigo-500 hover:text-white hover:border-indigo-500
                           hover:shadow-[0_4px_18px_rgba(99,102,241,0.3)]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 6 15 12 9 18"/>
                </svg>
            </button>

            <div class="swiper yearbookSwiper mx-14">
                <div class="swiper-wrapper">
                    @foreach ([2025, 2024, 2023] as $year)
                    <div class="swiper-slide yearbook-slide">

                        <div class="flex flex-col items-center gap-5">

                            {{-- Card --}}
                            <a href="/yearbook/{{ $year }}"
                                data-url="/yearbook/{{ $year }}"
                                class="yearbook-card group relative block w-[190px] h-[260px] rounded-2xl overflow-hidden
                                       shadow-[0_4px_20px_rgba(0,0,0,0.08)] border border-black/[0.07]
                                       cursor-pointer select-none
                                       transition-all duration-300
                                       hover:-translate-y-2
                                       hover:shadow-[0_16px_48px_rgba(99,102,241,0.22)]
                                       hover:border-indigo-300/60">

                                {{-- Cover image --}}
                                <img src="{{ asset('img/cover-' . $year . '.jpg') }}"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    alt="Cover {{ $year }}">

                                {{-- Fallback --}}
                                <div class="absolute inset-0 hidden flex-col items-center justify-center bg-gradient-to-br from-[#eef2ff] to-[#dbeafe]">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-14 h-14 text-indigo-300 transition-transform duration-300 group-hover:-rotate-6 group-hover:scale-110"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                                        <line x1="9" y1="7" x2="15" y2="7"/>
                                        <line x1="9" y1="11" x2="13" y2="11"/>
                                    </svg>
                                </div>

                                {{-- Hover tint --}}
                                <div class="absolute inset-0 bg-indigo-600/0 group-hover:bg-indigo-600/[0.08] transition-all duration-300 rounded-2xl"></div>

                                {{-- Shine sweep --}}
                                <div class="absolute top-[-50%] left-[-75%] w-1/2 h-[200%]
                                            bg-gradient-to-r from-transparent via-white/30 to-transparent
                                            -skew-x-12 pointer-events-none
                                            transition-[left] duration-700 group-hover:left-[125%]"></div>
                            </a>

                            {{-- Label below — fixed width matches card so text-center is truly centered --}}
                            <div class="w-[190px] text-center">
                                <p class="font-mono text-[10px] font-bold tracking-[0.25em] uppercase text-gray-400 mb-1 m-0">
                                    Angkatan
                                </p>
                                <p class="text-[1.6rem] font-bold italic tracking-tight text-gray-800 leading-none m-0">
                                    {{ $year }}
                                </p>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Pagination — outside swiper, with generous top margin --}}
            <div class="ybk-pagination swiper-pagination !relative !bottom-auto mt-8 flex justify-center"></div>

        </div>

        {{-- Footer deco --}}
        <div class="flex items-center justify-center gap-5 mt-12" data-aos="fade-up" data-aos-duration="600" data-aos-delay="300">
            <div class="h-px w-16 bg-gradient-to-r from-transparent to-gray-300"></div>
            <span class="font-mono text-[10px] tracking-[0.25em] uppercase text-gray-300">SMKN 1 &mdash; Kenangan Terbaik</span>
            <div class="h-px w-16 bg-gradient-to-l from-transparent to-gray-300"></div>
        </div>

    </div>
</section>

<style>
    /* Swiper overflow */
    .yearbookSwiper { overflow: visible !important; }

    .yearbook-slide { transition: opacity 0.4s ease, transform 0.4s ease; }
    .yearbook-slide:not(.swiper-slide-active) { opacity: 0.42; transform: scale(0.86); }
    .yearbook-slide.swiper-slide-active         { opacity: 1;    transform: scale(1); }

    .ybk-prev::after, .ybk-next::after { display: none !important; content: '' !important; }

    /* Arrow vertical centering — aligned to card height (260px), not label */
    .ybk-prev, .ybk-next { top: calc(260px / 2); transform: translateY(-50%); }

    /* Pagination bullets */
    .ybk-pagination { position: relative !important; }
    .ybk-pagination .swiper-pagination-bullet {
        width: 6px; height: 6px;
        background: #d1d5db; opacity: 1;
        transition: all 0.3s ease;
        display: inline-block; margin: 0 4px;
    }
    .ybk-pagination .swiper-pagination-bullet-active {
        background: #6366f1; width: 22px; border-radius: 99px;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const swiper = new Swiper(".yearbookSwiper", {
        loop: true,
        centeredSlides: true,
        slidesPerView: 1.4,
        spaceBetween: 20,
        grabCursor: true,
        speed: 700,
        autoplay: { delay: 3000, disableOnInteraction: false, pauseOnMouseEnter: true },
        navigation: { prevEl: ".ybk-prev", nextEl: ".ybk-next" },
        pagination: { el: ".ybk-pagination", clickable: true },
        breakpoints: {
            480: { slidesPerView: 1.6, spaceBetween: 24 },
            640: { slidesPerView: 2.2, spaceBetween: 28 },
            768: { slidesPerView: 3,   spaceBetween: 32 },
            1024:{ slidesPerView: 3,   spaceBetween: 36 },
        },
    });

    const wrapper = document.querySelector(".yearbookSwiper");
    let startX = 0, dragged = false;

    wrapper.addEventListener("pointerdown", e => { startX = e.clientX; dragged = false; });
    wrapper.addEventListener("pointermove", e => { if (Math.abs(e.clientX - startX) > 6) dragged = true; });
    wrapper.addEventListener("pointerup", e => {
        if (dragged) return;
        const card = e.target.closest(".yearbook-card");
        if (!card) return;
        if (card.closest(".swiper-slide")?.classList.contains("swiper-slide-active")) {
            window.location.href = card.getAttribute("href") || card.dataset.url;
        }
    });
});
</script>

@endsection
