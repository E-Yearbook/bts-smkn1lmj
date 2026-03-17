@extends('layouts.index')
@section('content')
    @php
    $years = $covers->pluck('year')->sort()->values();
    $count = $years->count();
    $useLoop = $count >= 3;
    $slideItems = $useLoop
        ? array_merge($years->toArray(), $years->toArray(), $years->toArray())
        : $years->toArray();
@endphp

    <section class="relative min-h-screen flex items-center bg-[#fafaf9] overflow-hidden font-serif">

        {{-- ── Ambient background ── --}}
        <div class="absolute inset-0 pointer-events-none z-0">
            {{-- Orbs --}}
            <div
                class="absolute top-[-200px] right-[-150px] w-[600px] h-[600px] rounded-full bg-indigo-500/[0.09] blur-[100px]">
            </div>
            <div
                class="absolute bottom-[-180px] left-[-120px] w-[500px] h-[500px] rounded-full bg-violet-500/[0.06] blur-[100px]">
            </div>
            <div class="absolute top-[40%] left-[40%] w-[350px] h-[350px] rounded-full bg-blue-400/[0.05] blur-[100px]">
            </div>
            {{-- Grid --}}
            <div class="absolute inset-0"
                style="background-image: linear-gradient(rgba(0,0,0,0.024) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,0.024) 1px, transparent 1px); background-size: 48px 48px;">
            </div>
            {{-- Noise --}}
            <div class="absolute inset-0 opacity-[0.018]"
                style="background-image: url(\"data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E\"); background-size: 160px 160px;">
            </div>
        </div>

        <div class="relative z-10 w-full py-[72px]">

            {{-- ── Header ── --}}
            <header class="text-center mb-16 max-w-4xl mx-auto px-8" data-aos="fade-down" data-aos-duration="600">
                <div
                    class="inline-flex items-center gap-2.5 font-mono text-[10px] font-bold tracking-[0.32em] uppercase text-indigo-500 mb-5">
                    <span class="w-[3px] h-[3px] rounded-full bg-indigo-500"></span>
                    E-Yearbook
                    <span class="w-[3px] h-[3px] rounded-full bg-indigo-500"></span>
                </div>
                <h1
                    class="text-[clamp(2.6rem,6vw,4rem)] font-normal not-italic text-[#111] tracking-[-0.035em] leading-[1.1] mb-4">
                    Pilih Buku<br>
                    <em class="italic text-indigo-500 not-italic" style="font-style:italic">Angkatan</em>
                </h1>
                <p class="font-mono text-[11.5px] text-[#a3a3a3] tracking-[0.06em] m-0">
                    Jelajahi kenangan indah dari setiap generasi
                </p>
            </header>

            {{-- ── Stage ── --}}
            <div class="pt-6 pb-14" data-aos="fade-up" data-aos-duration="700" data-aos-delay="120">

                {{-- Row: [prev] [swiper] [next] --}}
                <div class="ybk-row">

                    {{-- Arrow PREV --}}
                    <div class="ybk-arrow-col">
                        <button class="ybk-arrow-prev ybk-btn-arrow">
                            <svg class="w-[15px] h-[15px] pointer-events-none" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6" />
                            </svg>
                        </button>
                    </div>

                    {{-- Swiper col --}}
                    <div class="ybk-stage">
                    <div class="swiper yearbookSwiper">
                    <div class="swiper-wrapper">
                        @foreach ($slideItems as $year)
                            <div
                                class="swiper-slide ybk-slide flex justify-center transition-[opacity,transform] duration-[400ms] ease-[cubic-bezier(0.25,1,0.5,1)]">

                                {{-- Card --}}
                                <a href="{{ route('book') }}" data-url="/yearbook/{{ $year }}"
                                    class="yearbook-card group flex flex-col items-center gap-[18px] no-underline cursor-pointer select-none outline-none">

                                    {{-- Cover --}}
                                    <div
                                        class="ybk-cover relative w-[190px] h-[260px] rounded-[14px] overflow-hidden bg-[#f0f0f0] border border-black/[0.07]
                                        shadow-[0_2px_4px_rgba(0,0,0,0.04),0_6px_20px_rgba(0,0,0,0.08),0_20px_40px_rgba(0,0,0,0.06)]
                                        transition-[transform,box-shadow,border-color] duration-[350ms] ease-[cubic-bezier(0.34,1.56,0.64,1)]
                                        group-hover:rotate-x-2
                                        group-hover:shadow-[0_4px_8px_rgba(0,0,0,0.04),0_16px_40px_rgba(99,102,241,0.18),0_32px_64px_rgba(99,102,241,0.10)]
                                        group-hover:border-indigo-400/25">

                                        {{-- Image --}}
                                        @php
                                            $cover = $covers->firstWhere('year', $year);
                                        @endphp
                                        <img src="{{ $cover ? asset('storage/' . $cover->cover_path) : '' }}"
                                            onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
                                            class="w-full h-full object-cover block transition-none"
                                            alt="Cover {{ $year }}">
                                        {{-- Fallback --}}
                                        <div
                                            class="absolute inset-0 hidden flex-col items-center justify-center bg-gradient-to-br from-[#eef2ff] to-[#e0e7ff]">
                                            <svg class="w-[52px] h-[52px] text-indigo-300" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="1.2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                                                <line x1="9" y1="7" x2="15" y2="7" />
                                                <line x1="9" y1="11" x2="13" y2="11" />
                                            </svg>
                                        </div>

                                        {{-- Overlay --}}
                                        <div
                                            class="absolute inset-0 flex items-end justify-center pb-[18px] bg-[rgba(79,70,229,0)] transition-[background] duration-300 group-hover:bg-[rgba(79,70,229,0.08)]">
                                            <span
                                                class="inline-flex items-center gap-[5px] px-4 py-[7px] rounded-full bg-white/[0.92] backdrop-blur-[8px]
                                                 font-mono text-[10px] font-bold tracking-[0.14em] uppercase text-indigo-600
                                                 shadow-[0_2px_12px_rgba(0,0,0,0.12)]
                                                 opacity-0 translate-y-[6px] transition-all duration-[250ms]
                                                 group-hover:opacity-100 group-hover:translate-y-0">
                                                Buka
                                                <svg class="w-[11px] h-[11px]" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <polyline points="9 6 15 12 9 18" />
                                                </svg>
                                            </span>
                                        </div>

                                        {{-- Shine --}}
                                        <div
                                            class="absolute top-[-50%] left-[-75%] w-1/2 h-[200%] bg-gradient-to-r from-transparent via-white/35 to-transparent -skew-x-[20deg] pointer-events-none transition-[left] duration-700 group-hover:left-[130%]">
                                        </div>
                                    </div>

                                    {{-- Label --}}
                                    <div class="flex flex-col items-center gap-[3px] w-[190px] text-center">
                                        <span
                                            class="font-mono text-[9px] font-bold tracking-[0.28em] uppercase text-[#a3a3a3] transition-colors duration-200 group-hover:text-indigo-400">
                                            Angkatan
                                        </span>
                                        <span
                                            class="text-[1.7rem] font-bold italic tracking-[-0.04em] leading-none text-[#1a1a1a] transition-colors duration-[250ms] group-hover:text-indigo-600">
                                            {{ $year }}
                                        </span>
                                    </div>

                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                </div>

                    {{-- Arrow NEXT --}}
                    <div class="ybk-arrow-col">
                        <button class="ybk-arrow-next ybk-btn-arrow">
                            <svg class="w-[15px] h-[15px] pointer-events-none" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 6 15 12 9 18" />
                            </svg>
                        </button>
                    </div>

                </div>{{-- end ybk-row --}}

                {{-- Pagination --}}
                <div class="ybk-dots swiper-pagination !relative !bottom-auto flex justify-center mt-0"></div>
            </div>

            {{-- ── Footer deco ── --}}
            <footer class="flex items-center justify-center gap-5 mt-[52px] max-w-4xl mx-auto px-8" data-aos="fade-up" data-aos-duration="500"
                data-aos-delay="200">
                <div class="h-px w-14 bg-gradient-to-r from-transparent to-[#d4d4d4]"></div>
                <span class="font-mono text-[9.5px] tracking-[0.28em] uppercase text-[#c4c4c4]">
                    SMKN 1 &mdash; Kenangan Terbaik
                </span>
                <div class="h-px w-14 bg-gradient-to-l from-transparent to-[#d4d4d4]"></div>
            </footer>

        </div>
    </section>

    <style>
        /* ── Unavoidable Swiper overrides (cannot be done in Tailwind) ── */

        /* Row layout: arrow | swiper | arrow — full viewport width */
        .ybk-row {
            display: flex;
            align-items: center;
            width: 100%;
        }

        /* Arrow columns: fixed width, centered button */
        .ybk-arrow-col {
            flex: 0 0 64px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ybk-btn-arrow {
            width: 42px;
            height: 42px;
            border-radius: 99px;
            background: white;
            border: 1px solid rgba(0,0,0,0.08);
            box-shadow: 0 1px 4px rgba(0,0,0,0.06), 0 4px 16px rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #737373;
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .ybk-btn-arrow:hover {
            background: #6366f1;
            color: white;
            border-color: #6366f1;
            box-shadow: 0 4px 20px rgba(99,102,241,0.35);
            transform: scale(1.08);
        }

        .ybk-btn-arrow:active {
            transform: scale(0.96);
        }

        /* Swiper col: takes remaining space, clips overflow */
        .ybk-stage {
            flex: 1;
            min-width: 0;
            overflow: hidden;
        }

        .yearbookSwiper {
            overflow: visible !important;
            padding: 8px 0 !important;
        }

        .yearbookSwiper .swiper-slide {
            width: auto !important;
        }

        .ybk-slide:not(.swiper-slide-active) {
            opacity: 0.38;
            transform: scale(0.84);
        }

        .ybk-slide.swiper-slide-active {
            opacity: 1;
            transform: scale(1);
        }

        .ybk-arrow-prev::after,
        .ybk-arrow-next::after {
            display: none !important;
            content: '' !important;
        }

        .ybk-dots {
            position: relative !important;
        }

        .ybk-dots .swiper-pagination-bullet {
            width: 5px;
            height: 5px;
            background: #d4d4d4;
            opacity: 1 !important;
            border-radius: 99px;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            margin: 0 3px !important;
        }

        .ybk-dots .swiper-pagination-bullet-active {
            background: #6366f1;
            width: 24px;
            box-shadow: 0 0 8px rgba(99, 102, 241, 0.45);
        }

        @media (max-width: 540px) {
            .ybk-arrow-col {
                flex: 0 0 48px;
            }
        }
    </style>

    <script>
document.addEventListener("DOMContentLoaded", function () {
    const years      = @json($years->values());
    const activeYear = {{ $activeYear }};
    const useLoop    = {{ $useLoop ? 'true' : 'false' }};
    const count      = years.length;

    const activeIdx  = years.indexOf(activeYear);
    const safeIdx    = activeIdx !== -1 ? activeIdx : years.length - 1;
    const initialSlide = useLoop ? (count + safeIdx) : safeIdx;

    const swiper = new Swiper(".yearbookSwiper", {
        centeredSlides: true,
        spaceBetween: 28,
        grabCursor: true,
        speed: 680,
        initialSlide: initialSlide,

        // Loop hanya jika data >= 3
        loop: useLoop,
        loopedSlides: useLoop ? count * 3 : undefined,

        autoplay: useLoop
            ? { delay: 3200, disableOnInteraction: false, pauseOnMouseEnter: true }
            : false,

        navigation: { prevEl: ".ybk-arrow-prev", nextEl: ".ybk-arrow-next" },
        pagination: { el: ".ybk-dots", clickable: true },

        breakpoints: {
            0:   { slidesPerView: 'auto', spaceBetween: 20 },
            540: { slidesPerView: 'auto', spaceBetween: 24 },
            768: { slidesPerView: 'auto', spaceBetween: 28 },
        },
    });

    // Drag vs click
    const wrapper = document.querySelector(".yearbookSwiper");
    let startX = 0, dragged = false;
    wrapper.addEventListener("pointerdown", e => { startX = e.clientX; dragged = false; });
    wrapper.addEventListener("pointermove", e => { if (Math.abs(e.clientX - startX) > 6) dragged = true; });
    wrapper.addEventListener("pointerup", e => {
        if (dragged) return;
        const card = e.target.closest(".yearbook-card");
        if (!card) return;
        const slide = card.closest(".swiper-slide");
        const isActive = slide?.classList.contains("swiper-slide-active");
        // Jika tidak loop (data < 3), semua slide bisa diklik langsung
        if (isActive || !useLoop) {
            window.location.href = card.getAttribute("href") || card.dataset.url;
        }
    });
});
</script>
@endsection
