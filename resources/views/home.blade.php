<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $years = $covers->pluck('year')->sort()->values();
        $count = $years->count();
        $seoTitle = $count > 0
            ? 'Buku Tahunan Digital SMKN 1 Lumajang | Angkatan ' . $years->first() . '–' . $years->last()
            : 'Buku Tahunan Digital SMKN 1 Lumajang | E-Yearbook Resmi';
        $seoDescription = $count > 0
            ? 'Jelajahi buku tahunan digital SMKN 1 Lumajang. Lihat foto dan kenangan setiap angkatan dari tahun ' . $years->first() . ' hingga ' . $years->last() . ' secara online.'
            : 'Buku tahunan digital resmi SMKN 1 Lumajang. Arsip kenangan dan foto setiap angkatan siswa secara online.';
        $seoKeywords = 'buku tahunan digital, buku tahunan smkn 1 lumajang, e-yearbook smkn 1 lumajang, yearbook online, yearbook sekolah, yearbook digital, album kenangan, foto angkatan, kenangan sekolah, alumni smkn 1 lumajang, smkn 1 lumajang, smk negeri 1 lumajang, sekolah menengah kejuruan lumajang, buku kenangan sekolah, archive foto siswa, angkatan smkn 1 lumajang, dokumentasi sekolah, foto siswa smkn 1 lumajang';
        $ogImage = asset('img/smkn1logo.png');
        $siteName = 'E-Yearbook SMKN 1 Lumajang';
    @endphp

    {{-- Basic Meta Tags --}}
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="{{ $seoKeywords }}">
    <meta name="author" content="SMKN 1 Lumajang">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="{{ request()->url() }}">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Logo SMKN 1 Lumajang">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:locale" content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ request()->url() }}">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">
    <meta name="twitter:image:alt" content="Logo SMKN 1 Lumajang">

    {{-- Additional SEO --}}
    <meta name="theme-color" content="#6366f1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="{{ $siteName }}">
    <meta name="application-name" content="{{ $siteName }}">
    <meta name="msapplication-TileColor" content="#6366f1">
    <meta name="msapplication-config" content="{{ asset('browserconfig.xml') }}">

    {{-- Geographic Tags --}}
    <meta name="geo.region" content="ID-JI">
    <meta name="geo.placename" content="Lumajang, Jawa Timur">
    <meta name="geo.position" content="-8.133056;113.224444">
    <meta name="ICBM" content="-8.133056, 113.224444">


    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/smkn1logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#fafaf9] m-0 overflow-hidden">

    <section class="relative font-serif" style="height:100dvh;overflow:hidden;display:flex;flex-direction:column;">

        {{-- Ambient background --}}
        <div class="absolute inset-0 pointer-events-none z-0">
            <div class="absolute top-[-200px] right-[-150px] w-[600px] h-[600px] rounded-full bg-indigo-500/[0.09] blur-[100px]"></div>
            <div class="absolute bottom-[-180px] left-[-120px] w-[500px] h-[500px] rounded-full bg-violet-500/[0.06] blur-[100px]"></div>
            <div class="absolute top-[40%] left-[40%] w-[350px] h-[350px] rounded-full bg-blue-400/[0.05] blur-[100px]"></div>
            <div class="absolute inset-0" style="background-image:linear-gradient(rgba(0,0,0,0.024) 1px,transparent 1px),linear-gradient(90deg,rgba(0,0,0,0.024) 1px,transparent 1px);background-size:48px 48px;"></div>
            <div class="absolute inset-0 opacity-[0.018]" style="background-image:url(\"data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E\");background-size:160px 160px;"></div>
        </div>

        {{-- Main content wrapper --}}
        <div class="relative z-10 flex flex-col h-full">

            {{-- Header --}}
            <header class="text-center px-8 pt-6 pb-2 flex-shrink-0" data-aos="fade-down" data-aos-duration="600">
                <div class="inline-flex items-center gap-2.5 font-mono text-[10px] font-bold tracking-[0.32em] uppercase text-indigo-500 mb-3">
                    <span class="w-[3px] h-[3px] rounded-full bg-indigo-500"></span>
                    E-Yearbook
                    <span class="w-[3px] h-[3px] rounded-full bg-indigo-500"></span>
                </div>
                <h1 class="font-normal text-[#111] tracking-[-0.035em] leading-[1.1] mb-2" style="font-size:clamp(1.8rem,5vw,3.2rem)">
                    Pilih Buku<br>
                    <em class="text-indigo-500" style="font-style:italic">Angkatan</em>
                </h1>
                <p class="font-mono text-[11px] text-[#a3a3a3] tracking-[0.06em] m-0">
                    Jelajahi kenangan indah dari setiap generasi
                </p>
            </header>

            {{-- Stage --}}
            <div class="flex-1 flex flex-col justify-center min-h-0 py-2" data-aos="fade-up" data-aos-duration="700" data-aos-delay="120">

                @if ($count === 0)
                    {{-- Empty state --}}
                    <div class="flex flex-col items-center justify-center gap-5">
                        <div class="w-[80px] h-[80px] rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center">
                            <svg class="w-9 h-9 text-indigo-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                                <line x1="9" y1="7" x2="15" y2="7"/>
                                <line x1="9" y1="11" x2="13" y2="11"/>
                            </svg>
                        </div>
                        <div class="text-center">
                            <p class="text-[1.1rem] font-bold italic text-[#1a1a1a] tracking-tight mb-1">Belum ada buku angkatan</p>
                            <p class="font-mono text-[11px] text-[#a3a3a3] tracking-[0.06em]">Admin belum menambahkan data tahun angkatan</p>
                        </div>
                    </div>

                @else
                    {{-- Carousel row --}}
                    <div class="ybk-row">

                        {{-- Prev button --}}
                        <div class="ybk-arrow-col">
                            <button id="ybkPrev" class="ybk-btn-arrow" aria-label="Sebelumnya">
                                <svg class="w-[15px] h-[15px] pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="15 18 9 12 15 6"/>
                                </svg>
                            </button>
                        </div>

                        {{-- Stage / viewport --}}
                        <div class="ybk-stage swiper" id="ybkStage">
                            <div class="ybk-track swiper-wrapper" id="ybkTrack">

                                {{-- ── Items (no infinite clone, mentok di ujung) ── --}}
                                @foreach ($years as $year)
                                    @php $cover = $covers->firstWhere('year', $year); @endphp
                                    <div class="ybk-item swiper-slide"
                 data-year="{{ $year }}"
                 data-href="{{ route('book', $year) }}">

                                        {{-- Cover --}}
                                        <div class="ybk-cover rounded-[14px] overflow-hidden bg-[#f0f0f0] border border-black/[0.07] relative">

                                            <img src="{{ $cover ? asset('storage/' . $cover->cover_path) : '' }}"
                                                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
                                                 class="w-full h-full object-cover block"
                                                 alt="Cover Buku Tahunan SMKN 1 Lumajang {{ $year }}"
                                                 draggable="false">

                                            {{-- Fallback cover --}}
                                            <div class="ybk-fallback absolute inset-0 hidden flex-col items-center justify-center bg-gradient-to-br from-[#eef2ff] to-[#e0e7ff]">
                                                <svg class="w-[52px] h-[52px] text-indigo-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                                                    <line x1="9" y1="7" x2="15" y2="7"/>
                                                    <line x1="9" y1="11" x2="13" y2="11"/>
                                                </svg>
                                            </div>

                                            {{-- Hover overlay --}}
                                            <div class="ybk-overlay absolute inset-0 flex items-end justify-center pb-[18px]">
                                                <span class="ybk-buka-btn inline-flex items-center gap-[5px] px-4 py-[7px] rounded-full bg-white/[0.92] backdrop-blur-[8px] font-mono text-[10px] font-bold tracking-[0.14em] uppercase text-indigo-600 shadow-[0_2px_12px_rgba(0,0,0,0.12)]">
                                                    Buka
                                                    <svg class="w-[11px] h-[11px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="9 6 15 12 9 18"/>
                                                    </svg>
                                                </span>
                                            </div>

                                            {{-- Shine sweep --}}
                                            <div class="ybk-shine absolute top-[-50%] left-[-75%] w-1/2 h-[200%] bg-gradient-to-r from-transparent via-white/35 to-transparent -skew-x-[20deg] pointer-events-none"></div>
                                        </div>

                                        {{-- Label --}}
                                        <div class="flex flex-col items-center gap-[3px] text-center" style="margin-top:clamp(10px,1.5vh,18px)">
                                            <span class="ybk-lbl-top font-mono text-[9px] font-bold tracking-[0.28em] uppercase text-[#a3a3a3]">Angkatan</span>
                                            <span class="ybk-lbl-year font-bold italic tracking-[-0.04em] leading-none text-[#1a1a1a]" style="font-size:clamp(1.2rem,3vw,1.7rem)">{{ $year }}</span>
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>

                        {{-- Next button --}}
                        <div class="ybk-arrow-col">
                            <button id="ybkNext" class="ybk-btn-arrow" aria-label="Berikutnya">
                                <svg class="w-[15px] h-[15px] pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 6 15 12 9 18"/>
                                </svg>
                            </button>
                        </div>

                    </div>

                    {{-- Dots --}}
                    <div class="flex justify-center gap-[6px] mt-4" id="ybkDots"></div>

                @endif
            </div>

            {{-- Footer --}}
            <footer class="flex items-center justify-center gap-5 px-8 pb-5 flex-shrink-0" data-aos="fade-up" data-aos-duration="500" data-aos-delay="200">
                <div class="h-px w-14 bg-gradient-to-r from-transparent to-[#d4d4d4]"></div>
                <span class="font-mono text-[9.5px] tracking-[0.28em] uppercase text-[#c4c4c4]">SMKN 1 &mdash; Kenangan Terbaik</span>
                <div class="h-px w-14 bg-gradient-to-l from-transparent to-[#d4d4d4]"></div>
            </footer>

        </div>
    </section>

</body>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
{{-- ═══════════════════════════════════════
     CSS
═══════════════════════════════════════ --}}
<style>
/* ── Layout ───────────────────────────────────────────────── */
.ybk-row        { display:flex; align-items:center; width:100%; }
.ybk-arrow-col  { flex:0 0 64px; display:flex; align-items:center; justify-content:center; position: relative; z-index: 10; }

/* ── Arrow buttons ────────────────────────────────────────── */
.ybk-btn-arrow {
    width:42px; height:42px; border-radius:99px;
    background:white; border:1px solid rgba(0,0,0,0.08);
    box-shadow:0 1px 4px rgba(0,0,0,0.06), 0 4px 16px rgba(0,0,0,0.06);
    display:flex; align-items:center; justify-content:center;
    color:#737373; cursor:pointer;
    transition:background 0.2s, color 0.2s, border-color 0.2s, box-shadow 0.2s, transform 0.15s, opacity 0.2s;
    flex-shrink:0;
}
.ybk-btn-arrow:hover:not(:disabled) {
    background:#6366f1; color:white; border-color:#6366f1;
    box-shadow:0 4px 20px rgba(99,102,241,0.35);
    transform:scale(1.08);
}
.ybk-btn-arrow:active:not(:disabled) { transform:scale(0.96); }
/* Disabled state when at edge */
.ybk-btn-arrow:disabled {
    opacity:0.3; cursor:not-allowed;
    transform:none !important;
    box-shadow:none !important;
}

/* ── Stage (viewport) ─────────────────────────────────────── */
.ybk-stage {
    flex: 1; min-width: 0;
    overflow: hidden;
    position: relative;
    padding: 20px 0;
    cursor: grab;
}

/* ── Swiper reset ─────────────────────────────────────────── */
.swiper { overflow: visible !important; }
.swiper-wrapper { align-items: center; transition-timing-function: cubic-bezier(0.25,1,0.5,1) !important; }

/* ── Items ────────────────────────────────────────────────── */
.swiper-slide {
    width: auto !important;
    display: flex;
    flex-direction: column;
    align-items: center;
    cursor: pointer;
    transition: opacity 0.45s cubic-bezier(0.25,1,0.5,1), transform 0.45s cubic-bezier(0.25,1,0.5,1);
    opacity: 0.36;
    transform: scale(0.82);
    will-change: transform, opacity;
}
.swiper-slide-active {
    opacity: 1;
    transform: scale(1);
}

/* ── Cover box ────────────────────────────────────────────── */
.ybk-cover {
    width: clamp(110px, 15vh, 170px);
    height: clamp(155px, 21vh, 238px);
    box-shadow:
        0 2px 4px rgba(0,0,0,0.04),
        0 6px 20px rgba(0,0,0,0.08),
        0 20px 40px rgba(0,0,0,0.06);
    transition:
        width  0.45s cubic-bezier(0.25,1,0.5,1),
        height 0.45s cubic-bezier(0.25,1,0.5,1),
        box-shadow 0.35s ease,
        border-color 0.35s ease;
}
.swiper-slide-active .ybk-cover {
    width: clamp(160px, 22vh, 240px);
    height: clamp(220px, 31vh, 336px);
}
.swiper-slide-active:hover .ybk-cover {
    box-shadow:
        0 4px 8px rgba(0,0,0,0.04),
        0 16px 40px rgba(99,102,241,0.18),
        0 32px 64px rgba(99,102,241,0.10);
    border-color: rgba(129,140,248,0.25) !important;
}

/* ── Labels ───────────────────────────────────────────────── */
.ybk-lbl-top  { transition: color 0.2s ease; }
.ybk-lbl-year { transition: color 0.25s ease; }
.swiper-slide-active:hover .ybk-lbl-top  { color: #818cf8; }
.swiper-slide-active:hover .ybk-lbl-year { color: #4f46e5; }

/* ── Overlay & Buka badge ─────────────────────────────────── */
.ybk-overlay {
    background: rgba(79,70,229,0);
    transition: background 0.3s ease;
}
.swiper-slide-active:hover .ybk-overlay { background: rgba(79,70,229,0.08); }

.ybk-buka-btn {
    opacity: 0;
    transform: translateY(6px);
    transition: opacity 0.25s ease, transform 0.25s ease;
    pointer-events: none;
}
.swiper-slide-active:hover .ybk-buka-btn {
    opacity: 1;
    transform: translateY(0);
}

/* ── Shine sweep ──────────────────────────────────────────── */
.ybk-shine { transition: left 0.7s ease; }
.swiper-slide-active:hover .ybk-shine { left: 130% !important; }

/* ── Dots ─────────────────────────────────────────────────── */
.ybk-dot {
    width: 5px; height: 5px; border-radius: 99px;
    background: #d4d4d4; cursor: pointer;
    transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
    border: none; padding: 0; flex-shrink: 0;
    display: inline-block;
}
.ybk-dot.is-active {
    background: #6366f1; width: 24px;
    box-shadow: 0 0 8px rgba(99,102,241,0.45);
}

/* ── Arrow disabled via Swiper ────────────────────────────── */
.ybk-btn-arrow.swiper-button-disabled {
    opacity: 0.3;
    cursor: not-allowed;
    transform: none !important;
    box-shadow: none !important;
}

/* ── Responsive ───────────────────────────────────────────── */
@media (max-width: 540px) {
    .ybk-arrow-col { flex: 0 0 44px; }
    .ybk-btn-arrow { width: 36px; height: 36px; }
}
</style>

{{-- ═══════════════════════════════════════
     JavaScript
═══════════════════════════════════════ --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    @if ($count > 0)

        const activeYear = {{ $activeYear ?? 'null' }};
        const years = @json($years->values());
        let initialIdx = years.indexOf(activeYear);
        if (initialIdx < 0) initialIdx = 0;

        const swiper = new Swiper('#ybkStage', {
            slidesPerView: 'auto',
            centeredSlides: true,
            spaceBetween: 24,
            initialSlide: initialIdx,
            speed: 650,
            grabCursor: true,
            keyboard: { enabled: true },
            navigation: {
                nextEl: '#ybkNext',
                prevEl: '#ybkPrev',
            },
            pagination: {
                el: '#ybkDots',
                clickable: true,
                bulletClass: 'ybk-dot',
                bulletActiveClass: 'is-active',
            },
            autoplay: {
                delay: 3200,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            on: {
                click(swiper, event) {
                    const clickedSlide = swiper.clickedSlide;
                    if (!clickedSlide) return;
                    if (clickedSlide.classList.contains('swiper-slide-active')) {
                        window.location.href = clickedSlide.dataset.href;
                    } else {
                        swiper.slideTo(swiper.clickedIndex);
                    }
                }
            }
        });

    @endif
});
</script>
</html>
