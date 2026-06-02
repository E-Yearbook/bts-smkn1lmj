@extends('layouts.index')

@section('title', 'BTS | Angkatan ' . $year)
{{-- viewbook page --}}
@section('content')

@php
    $colorMap = [
        'indigo'  => ['bg' => 'bg-indigo-50',  'text' => 'text-indigo-500',  'border' => 'border-indigo-200/60',  'badge' => 'bg-indigo-100 text-indigo-600',  'hover_shadow' => 'hover:shadow-[0_12px_36px_rgba(99,102,241,0.18)]',  'hover_border' => 'hover:border-indigo-300/60'],
        'violet'  => ['bg' => 'bg-violet-50',  'text' => 'text-violet-500',  'border' => 'border-violet-200/60',  'badge' => 'bg-violet-100 text-violet-600',  'hover_shadow' => 'hover:shadow-[0_12px_36px_rgba(139,92,246,0.18)]',   'hover_border' => 'hover:border-violet-300/60'],
        'blue'    => ['bg' => 'bg-blue-50',    'text' => 'text-blue-500',    'border' => 'border-blue-200/60',    'badge' => 'bg-blue-100 text-blue-600',      'hover_shadow' => 'hover:shadow-[0_12px_36px_rgba(59,130,246,0.18)]',   'hover_border' => 'hover:border-blue-300/60'],
        'emerald' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-500', 'border' => 'border-emerald-200/60', 'badge' => 'bg-emerald-100 text-emerald-600','hover_shadow' => 'hover:shadow-[0_12px_36px_rgba(16,185,129,0.18)]',  'hover_border' => 'hover:border-emerald-300/60'],
        'rose'    => ['bg' => 'bg-rose-50',    'text' => 'text-rose-500',    'border' => 'border-rose-200/60',    'badge' => 'bg-rose-100 text-rose-600',      'hover_shadow' => 'hover:shadow-[0_12px_36px_rgba(244,63,94,0.18)]',   'hover_border' => 'hover:border-rose-300/60'],
    ];

    $parseYoutubeIds = function($rawLink) {
        $ids = [];
        if ($rawLink) {
            $links = preg_split('/[\s,]+/', $rawLink, -1, PREG_SPLIT_NO_EMPTY);
            foreach ($links as $link) {
                preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([a-zA-Z0-9_-]{11})/', $link, $m);
                if ($id = $m[1] ?? null) {
                    $ids[] = $id;
                }
            }
        }
        return $ids;
    };

    $youtubeEmbedIds         = $parseYoutubeIds($youtubeLink ?? null);
    $youtubeEmbedIdsAngkatan = $parseYoutubeIds($youtubeLinkAngkatan ?? null);
@endphp

{{-- DearFlip CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@dearhive/dearflip-jquery-flipbook@1.7.3/dflip/css/dflip.min.css">

<style>
    .books-slider::-webkit-scrollbar {
    height: 4px;
}
.books-slider::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.04);
    border-radius: 99px;
}
.books-slider::-webkit-scrollbar-thumb {
    background: rgba(0, 0, 0, 0.10);
    border-radius: 99px;
}
.books-slider::-webkit-scrollbar-thumb:hover {
    background: rgba(0, 0, 0, 0.1);
}
</style>


{{-- ══════════════════════════════════════════
     Main Page
══════════════════════════════════════════ --}}
<div class="relative min-h-screen bg-[#f8f7f4] overflow-x-hidden">

    {{-- Background orbs --}}
    <div class="absolute top-[-120px] right-[-100px] w-[500px] h-[500px] rounded-full bg-blue-500/[0.07] blur-[90px] pointer-events-none"></div>
    <div class="absolute bottom-[-100px] left-[-80px] w-[400px] h-[400px] rounded-full bg-indigo-500/[0.06] blur-[80px] pointer-events-none"></div>

    {{-- Dot grid --}}
    <div class="absolute inset-0 pointer-events-none"
        style="background-image: linear-gradient(rgba(0,0,0,0.028) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,0.028) 1px, transparent 1px); background-size: 42px 42px;">
    </div>

    <div class="relative z-10 w-full max-w-6xl mx-auto px-6 py-16">

        {{-- ── Breadcrumb ── --}}
        <div class="flex items-center gap-2 font-mono text-[11px] tracking-[0.15em] text-gray-400 uppercase mb-10"
            data-aos="fade-down" data-aos-duration="500">
            <a href="/" class="hover:text-indigo-500 transition-colors duration-200">Home</a>
            <span class="text-gray-300">/</span>
            <a href="/" class="hover:text-indigo-500 transition-colors duration-200">Angkatan</a>
            <span class="text-gray-300">/</span>
            <span class="text-indigo-500">{{ $year }}</span>
        </div>

        {{-- ── Page Header ── --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-14"
            data-aos="fade-down" data-aos-duration="700">

            {{-- Kiri: judul --}}
            <div>
                <span class="inline-flex items-center gap-2.5 font-mono text-[11px] font-bold tracking-[0.3em] text-indigo-500 uppercase mb-4">
                    <span class="w-1 h-1 rounded-full bg-indigo-500 inline-block"></span>
                    E-Yearbook
                    <span class="w-1 h-1 rounded-full bg-indigo-500 inline-block"></span>
                </span>
                <h1 class="text-4xl md:text-5xl font-normal italic text-gray-900 tracking-tight leading-tight mb-2">
                    Angkatan <span class="text-indigo-500">{{ $year }}</span>
                </h1>
                <p class="font-mono text-xs text-gray-400 tracking-wider">
                    Pilih buku yang ingin kamu jelajahi
                </p>
            </div>

            {{-- Kanan: tombol-tombol --}}
            <div class="flex items-center gap-3 flex-wrap self-start md:self-auto">

                @if (count($youtubeEmbedIds) > 0)
                <button onclick="openVideoModal('sambutan')"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                           bg-indigo-500 border border-indigo-400 shadow-sm
                           font-mono text-[11px] font-bold tracking-[0.15em] uppercase text-white
                           transition-all duration-200 hover:bg-indigo-600 hover:shadow-[0_6px_20px_rgba(99,102,241,0.35)]
                           hover:-translate-y-0.5 active:translate-y-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                    Video Sambutan
                    @if (count($youtubeEmbedIds) > 1)
                    <span class="ml-1 text-[10px] bg-white/20 px-1.5 py-0.5 rounded-full">{{ count($youtubeEmbedIds) }}</span>
                    @endif
                </button>
                @endif

                @if (count($youtubeEmbedIdsAngkatan) > 0)
                <button onclick="openVideoModal('angkatan')"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                           bg-blue-600 border border-blue-500 shadow-sm
                           font-mono text-[11px] font-bold tracking-[0.15em] uppercase text-white
                           transition-all duration-200 hover:bg-blue-700 hover:shadow-[0_6px_20px_rgba(37,99,235,0.35)]
                           hover:-translate-y-0.5 active:translate-y-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                    Video Angkatan
                    @if (count($youtubeEmbedIdsAngkatan) > 1)
                    <span class="ml-1 text-[10px] bg-white/20 px-1.5 py-0.5 rounded-full">{{ count($youtubeEmbedIdsAngkatan) }}</span>
                    @endif
                </button>

                @endif

                <a href="/"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                           bg-white border border-black/[0.07] shadow-sm
                           font-mono text-[11px] font-bold tracking-[0.15em] uppercase text-gray-500
                           transition-all duration-200 hover:border-indigo-300 hover:text-indigo-600 hover:shadow-md
                           hover:-translate-y-0.5 active:translate-y-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                    Kembali
                </a>

            </div>
        </div>

        {{-- ── Category Filter Tabs ── --}}
        <div class="flex items-center gap-2 flex-wrap mb-10"
            data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
            <button onclick="filterCategory('all')"
                class="filter-btn active-filter font-mono text-[10px] font-bold tracking-[0.18em] uppercase
                       px-4 py-2 rounded-full border transition-all duration-200 cursor-pointer"
                data-cat="all">
                Semua
            </button>
            @foreach ($categories as $cat)
            <button onclick="filterCategory('{{ $cat['slug'] }}')"
                class="filter-btn font-mono text-[10px] font-bold tracking-[0.18em] uppercase
                       px-4 py-2 rounded-full border border-black/[0.07] bg-white text-gray-500
                       transition-all duration-200 hover:border-indigo-300 hover:text-indigo-600 cursor-pointer"
                data-cat="{{ $cat['slug'] }}">
                {{ $cat['label'] }}
            </button>
            @endforeach
        </div>

        {{-- ── Categories & Books ── --}}
        @foreach ($categories as $i => $cat)
        @php $c = $colorMap[$cat['color']]; @endphp

        <div class="category-section mb-14" data-category="{{ $cat['slug'] }}"
            data-aos="fade-up" data-aos-duration="700" data-aos-delay="{{ $i * 80 }}">

            {{-- Section header --}}
            <div class="flex items-center gap-3 mb-6">
                <div>
                    <h2 class="text-lg font-bold italic text-gray-800 tracking-tight leading-none mb-0.5">
                        {{ $cat['label'] }}
                    </h2>
                    <p class="font-mono text-[10px] tracking-[0.18em] uppercase text-gray-400">
                        {{ count($cat['books']) }} buku tersedia
                    </p>
                </div>
                <div class="flex-1 h-px bg-gradient-to-r from-gray-200 to-transparent ml-2"></div>
            </div>

            {{-- Books slider --}}
            <div class="relative">

                {{-- Tombol kiri --}}
                <button onclick="slideLeft(this)"
                    class="absolute -left-4 top-1/2 -translate-y-1/2 z-10
                           w-8 h-8 rounded-full bg-white border border-gray-200
                           shadow-md flex items-center justify-center
                           hover:bg-gray-50 transition-all duration-200
                           opacity-0 pointer-events-none slider-btn-left">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                </button>

                {{-- Scrollable track --}}
                <div class="books-slider flex gap-4 overflow-x-auto pb-3 scroll-smooth"
                    style="scrollbar-width: thin; scrollbar-color: rgba(0,0,0,0.15) rgba(0,0,0,0.04);"
                    onscroll="updateSliderButtons(this)">

                    @foreach ($cat['books'] as $bi => $book)
                    <div onclick="openDearFlip({{ json_encode($book['title']) }}, {{ json_encode($book['file'] ?? '') }})"
                        class="book-card group flex flex-col items-center gap-3 cursor-pointer flex-shrink-0 w-36"
                        data-aos="zoom-in" data-aos-duration="500" data-aos-delay="{{ $bi * 60 }}">

                        {{-- Book cover --}}
                        <div class="relative w-full aspect-[9/16] rounded-xl overflow-hidden
                                    border {{ $c['border'] }} bg-white
                                    shadow-[0_2px_12px_rgba(0,0,0,0.07)]
                                    transition-all duration-300
                                    group-hover:-translate-y-2
                                    {{ $c['hover_shadow'] }} {{ $c['hover_border'] }}">

                            @if (!empty($book['cover']))
                            <img src="{{ asset($book['cover']) }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                alt="{{ $book['title'] }}"
                                loading="lazy">
                            @else
                            <div class="w-full h-full flex flex-col items-center justify-center {{ $c['bg'] }} relative">
                                <div class="absolute left-2.5 top-3 bottom-3 w-1.5 rounded-full
                                            bg-gradient-to-b from-current opacity-20 {{ $c['text'] }}"></div>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-8 h-8 {{ $c['text'] }} opacity-40 mb-2 transition-transform duration-300 group-hover:-rotate-6 group-hover:scale-110"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                                    <line x1="9" y1="7" x2="15" y2="7"/>
                                    <line x1="9" y1="11" x2="13" y2="11"/>
                                </svg>
                                <span class="font-mono text-[9px] font-bold tracking-[0.15em] uppercase {{ $c['text'] }} opacity-50 text-center px-2 leading-relaxed">
                                    {{ $book['title'] }}
                                </span>
                            </div>
                            @endif

                            {{-- Hover overlay --}}
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/[0.06] transition-all duration-300"></div>

                            {{-- "Buka" badge on hover --}}
                            <div class="absolute bottom-2 left-1/2 -translate-x-1/2
                                        opacity-0 group-hover:opacity-100 translate-y-1 group-hover:translate-y-0
                                        transition-all duration-250">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full
                                             {{ $c['badge'] }} font-mono text-[9px] font-bold tracking-[0.1em] uppercase
                                             shadow-sm backdrop-blur-sm whitespace-nowrap">
                                    Buka
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 h-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="9 6 15 12 9 18"/>
                                    </svg>
                                </span>
                            </div>

                            {{-- Shine sweep --}}
                            <div class="absolute top-[-50%] left-[-75%] w-1/2 h-[200%]
                                        bg-gradient-to-r from-transparent via-white/25 to-transparent
                                        -skew-x-12 pointer-events-none
                                        transition-[left] duration-700 group-hover:left-[125%]"></div>
                        </div>

                        {{-- Book title --}}
                        <p class="text-sm font-semibold text-gray-800 text-center leading-snug group-hover:text-black transition-colors duration-200 line-clamp-2 w-full">
                            {{ $book['title'] }}
                        </p>
                        <p class="mt-1 text-xs font-medium text-gray-500 text-center leading-tight group-hover:text-gray-700 transition-colors duration-200 line-clamp-1 w-full">
                            Publisher : {{ $book['publisher'] }}
                        </p>

                    </div>
                    @endforeach {{-- end books --}}

                </div>

                {{-- Tombol kanan --}}
                <button onclick="slideRight(this)"
                    class="absolute -right-4 top-1/2 -translate-y-1/2 z-10
                           w-8 h-8 rounded-full bg-white border border-gray-200
                           shadow-md flex items-center justify-center
                           hover:bg-gray-50 transition-all duration-200
                           slider-btn-right">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 6 15 12 9 18"/>
                    </svg>
                </button>

            </div>{{-- end .relative (slider wrapper) --}}

        </div>{{-- end .category-section --}}
        @endforeach {{-- end categories --}}

        {{-- Footer deco --}}
        <div class="flex items-center justify-center gap-5 pt-4 pb-8"
            data-aos="fade-up" data-aos-duration="600">
            <div class="h-px w-16 bg-gradient-to-r from-transparent to-gray-600"></div>
            <span class="font-mono text-[10px] tracking-[0.25em] uppercase text-gray-600">
                @if ($year == '2026')
                CUSTOM FOOTER
                @else
                Digital Yearbook SMKN 1 LUMAJANG
                @endif
            </span>
            <div class="h-px w-16 bg-gradient-to-l from-transparent to-gray-600"></div>
        </div>

    </div>{{-- end max-w-6xl --}}
</div>{{-- end .relative.min-h-screen --}}

{{-- ══════════════════════════════════════════
     Modal: DearFlip Flipbook
══════════════════════════════════════════ --}}
<div id="df-overlay"
    class="fixed inset-0 z-[999] bg-black/90 backdrop-blur-sm
           flex flex-col items-center justify-center gap-3
           opacity-0 pointer-events-none"
    style="transition: opacity 0.3s ease;">

    <div class="flex items-center justify-between w-full px-6" style="max-width: 980px;">
        <span id="df-title"
            class="font-mono text-sm font-bold tracking-widest uppercase text-white/80 truncate"
            style="max-width: 70%;">
        </span>
        <button onclick="closeDearFlip()"
            class="w-9 h-9 rounded-full bg-white/10 hover:bg-red-500/80 border border-white/20
                   flex items-center justify-center text-white transition-all duration-200 shrink-0">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>

    <div id="df-loading" style="display:flex; flex-direction:column; align-items:center; gap:12px; color:rgba(255,255,255,0.5);">
        <svg class="w-8 h-8 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
        </svg>
        <span class="font-mono text-xs tracking-widest">Memuat buku...</span>
    </div>

    <div id="df-nofile" style="display:none; flex-direction:column; align-items:center; gap:12px; color:rgba(255,255,255,0.5);">
        <svg style="width:56px;height:56px;opacity:0.4;" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
        </svg>
        <p class="font-mono text-sm tracking-widest">File PDF belum tersedia</p>
    </div>

    <div id="df-book-wrap" style="display:none; width:100%; max-width:980px; padding:0 1rem;">
        <div id="df-flipbook" style="width:100%; height:72vh;"></div>
    </div>

    <p class="font-mono text-white/25 tracking-widest" style="font-size:10px; margin-top:4px;">
        Klik luar area buku &nbsp;·&nbsp; ESC untuk menutup
    </p>
</div>

{{-- ══════════════════════════════════════════
     Modal: Video Sambutan
══════════════════════════════════════════ --}}
@if (count($youtubeEmbedIds) > 0)
<div id="video-modal"
    class="fixed inset-0 z-[1000] bg-black/90 backdrop-blur-sm
           flex flex-col items-center justify-center gap-4
           opacity-0 pointer-events-none"
    style="transition: opacity 0.35s ease;">

    <div class="flex items-center justify-between w-full px-6" style="max-width: 860px;">
        <div>
            <span class="font-mono text-[10px] font-bold tracking-[0.3em] text-indigo-400 uppercase">
                ▶ Video Sambutan
            </span>
            <p class="font-mono text-sm text-white/60 tracking-wider mt-0.5">
                Angkatan {{ $year }}
            </p>
        </div>
        @if (count($youtubeEmbedIds) > 1)
        <span id="video-counter" class="font-mono text-xs text-white/40 tracking-wider">
            1 / {{ count($youtubeEmbedIds) }}
        </span>
        @endif
        <button onclick="closeVideoModal()"
            class="w-9 h-9 rounded-full bg-white/10 hover:bg-red-500/80 border border-white/20
                   flex items-center justify-center text-white transition-all duration-200 shrink-0">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>

    <div class="relative w-full" style="max-width: 860px; padding: 0 1.5rem;">
        @if (count($youtubeEmbedIds) > 1)
        <button id="video-prev" style="display:none;"
            class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 lg:-translate-x-6
                   w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm
                   flex items-center justify-center text-white transition-all duration-200 z-10">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
        </button>
        @endif

        <div style="position:relative; padding-bottom:56.25%; height:0; border-radius:16px; overflow:hidden; background:#000;
                    box-shadow: 0 32px 80px rgba(0,0,0,0.6);">
            <iframe id="video-iframe" src=""
                style="position:absolute; top:0; left:0; width:100%; height:100%; border:none;"
                allow="autoplay; encrypted-media; picture-in-picture"
                referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen>
            </iframe>
        </div>

        @if (count($youtubeEmbedIds) > 1)
        <button id="video-next"
            class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 lg:translate-x-6
                   w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm
                   flex items-center justify-center text-white transition-all duration-200 z-10">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </button>
        @endif
    </div>

    @if (count($youtubeEmbedIds) > 1)
    <div class="flex items-center justify-center gap-2 mt-3 flex-wrap" id="video-thumbnails">
        @foreach ($youtubeEmbedIds as $idx => $vidId)
        <button class="video-thumb-btn rounded-full transition-all duration-200 bg-white/30 hover:bg-white/60"
                data-index="{{ $idx }}"
                style="width: {{ $idx == 0 ? '24px' : '8px' }}; height:8px; {{ $idx == 0 ? 'background-color: rgba(255,255,255,0.8);' : '' }}">
        </button>
        @endforeach
    </div>
    @endif

    <p class="font-mono text-white/25 tracking-widest" style="font-size:10px;">
        @if (count($youtubeEmbedIds) > 1)◀  Geser atau klik tombol  ▶  &nbsp;·&nbsp;@endif
        Klik luar area video &nbsp;·&nbsp; ESC untuk menutup
    </p>
</div>
@endif

{{-- ══════════════════════════════════════════
     Modal: Video Angkatan
══════════════════════════════════════════ --}}
@if (count($youtubeEmbedIdsAngkatan) > 0)
<div id="video-modal-angkatan"
    class="fixed inset-0 z-[1000] bg-black/90 backdrop-blur-sm
           flex flex-col items-center justify-center gap-4
           opacity-0 pointer-events-none"
    style="transition: opacity 0.35s ease;">

    <div class="flex items-center justify-between w-full px-6" style="max-width: 860px;">
        <div>
            <span class="font-mono text-[10px] font-bold tracking-[0.3em] text-violet-400 uppercase">
                ▶ Video Angkatan
            </span>
            <p class="font-mono text-sm text-white/60 tracking-wider mt-0.5">
                Angkatan {{ $year }}
            </p>
        </div>
        @if (count($youtubeEmbedIdsAngkatan) > 1)
        <span id="video-counter-angkatan" class="font-mono text-xs text-white/40 tracking-wider">
            1 / {{ count($youtubeEmbedIdsAngkatan) }}
        </span>
        @endif
        <button onclick="closeVideoModalAngkatan()"
            class="w-9 h-9 rounded-full bg-white/10 hover:bg-red-500/80 border border-white/20
                   flex items-center justify-center text-white transition-all duration-200 shrink-0">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>

    <div class="relative w-full" style="max-width: 860px; padding: 0 1.5rem;">
        @if (count($youtubeEmbedIdsAngkatan) > 1)
        <button id="video-prev-angkatan" style="display:none;"
            class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 lg:-translate-x-6
                   w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm
                   flex items-center justify-center text-white transition-all duration-200 z-10">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
        </button>
        @endif

        <div style="position:relative; padding-bottom:56.25%; height:0; border-radius:16px; overflow:hidden; background:#000;
                    box-shadow: 0 32px 80px rgba(0,0,0,0.6);">
            <iframe id="video-iframe-angkatan" src=""
                style="position:absolute; top:0; left:0; width:100%; height:100%; border:none;"
                allow="autoplay; encrypted-media; picture-in-picture"
                referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen>
            </iframe>
        </div>

        @if (count($youtubeEmbedIdsAngkatan) > 1)
        <button id="video-next-angkatan"
            class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 lg:translate-x-6
                   w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-sm
                   flex items-center justify-center text-white transition-all duration-200 z-10">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </button>
        @endif
    </div>

    @if (count($youtubeEmbedIdsAngkatan) > 1)
    <div class="flex items-center justify-center gap-2 mt-3 flex-wrap" id="video-thumbnails-angkatan">
        @foreach ($youtubeEmbedIdsAngkatan as $idx => $vidId)
        <button class="video-thumb-btn-angkatan rounded-full transition-all duration-200 bg-white/30 hover:bg-white/60"
                data-index="{{ $idx }}"
                style="width: {{ $idx == 0 ? '24px' : '8px' }}; height:8px; {{ $idx == 0 ? 'background-color: rgba(255,255,255,0.8);' : '' }}">
        </button>
        @endforeach
    </div>
    @endif

    <p class="font-mono text-white/25 tracking-widest" style="font-size:10px;">
        @if (count($youtubeEmbedIdsAngkatan) > 1)◀  Geser atau klik tombol  ▶  &nbsp;·&nbsp;@endif
        Klik luar area video &nbsp;·&nbsp; ESC untuk menutup
    </p>
</div>
@endif

{{-- ── Styles & Scripts ── --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@dearhive/dearflip-jquery-flipbook@1.7.3/dflip/css/dflip.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@dearhive/dearflip-jquery-flipbook@1.7.3/dflip/css/themify-icons.min.css">
<link rel="stylesheet" href="{{ asset('css/book.css') }}">

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@dearhive/dearflip-jquery-flipbook@1.7.3/dflip/js/dflip.min.js"></script>
<script src="{{ asset('_func/book.js') }}"></script>

<script>
// ── Video Modal ──────────────────────────────────────────────────────────
@if (count($youtubeEmbedIds) > 0)
var videoIds = @json($youtubeEmbedIds);
@else
var videoIds = [];
@endif

@if (count($youtubeEmbedIdsAngkatan) > 0)
var videoIdsAngkatan = @json($youtubeEmbedIdsAngkatan);
@else
var videoIdsAngkatan = [];
@endif

function createVideoPlayer(modalId, iframeId, prevBtnId, nextBtnId, counterId, thumbClass, ids) {
    var modal   = document.getElementById(modalId);
    var iframe  = document.getElementById(iframeId);
    var prevBtn = document.getElementById(prevBtnId);
    var nextBtn = document.getElementById(nextBtnId);
    var counter = document.getElementById(counterId);
    var curIdx  = 0;

    function loadVideo(index) {
        if (!ids[index]) return;
        iframe.src = 'https://www.youtube.com/embed/' + ids[index] + '?autoplay=1&rel=0&enablejsapi=1';
        if (counter) counter.textContent = (index + 1) + ' / ' + ids.length;
        if (prevBtn) prevBtn.style.display = index === 0 ? 'none' : 'flex';
        if (nextBtn) nextBtn.style.display = index === ids.length - 1 ? 'none' : 'flex';
        document.querySelectorAll('.' + thumbClass).forEach(function(btn, i) {
            btn.style.width = i === index ? '24px' : '8px';
            btn.style.backgroundColor = i === index ? 'rgba(255,255,255,0.8)' : 'rgba(255,255,255,0.3)';
        });
    }

    function open() {
        curIdx = 0;
        loadVideo(curIdx);
        if (modal) {
            modal.classList.add('vm-active');
            modal.style.opacity = '1';
            modal.style.pointerEvents = 'all';
            document.body.style.overflow = 'hidden';
        }
    }

    function close() {
        if (iframe) iframe.src = '';
        if (modal) {
            modal.classList.remove('vm-active');
            modal.style.opacity = '0';
            modal.style.pointerEvents = 'none';
            document.body.style.overflow = '';
        }
    }

    function next() { if (curIdx < ids.length - 1) { curIdx++; loadVideo(curIdx); } }
    function prev() { if (curIdx > 0) { curIdx--; loadVideo(curIdx); } }

    if (prevBtn) prevBtn.addEventListener('click', prev);
    if (nextBtn) nextBtn.addEventListener('click', next);

    document.querySelectorAll('.' + thumbClass).forEach(function(btn) {
        btn.addEventListener('click', function() {
            var idx = parseInt(this.dataset.index);
            if (!isNaN(idx) && idx !== curIdx) { curIdx = idx; loadVideo(curIdx); }
        });
    });

    if (modal) {
        modal.addEventListener('click', function(e) { if (e.target === this) close(); });
    }

    document.addEventListener('keydown', function(e) {
        if (!modal || !modal.classList.contains('vm-active')) return;
        if (e.key === 'ArrowLeft')       { e.preventDefault(); prev(); }
        else if (e.key === 'ArrowRight') { e.preventDefault(); next(); }
        else if (e.key === 'Escape')     { close(); }
    });

    return { open, close };
}

@if (count($youtubeEmbedIds) > 0)
var playerSambutan = createVideoPlayer(
    'video-modal', 'video-iframe', 'video-prev', 'video-next', 'video-counter',
    'video-thumb-btn', videoIds
);
@endif

@if (count($youtubeEmbedIdsAngkatan) > 0)
var playerAngkatan = createVideoPlayer(
    'video-modal-angkatan', 'video-iframe-angkatan',
    'video-prev-angkatan', 'video-next-angkatan', 'video-counter-angkatan',
    'video-thumb-btn-angkatan', videoIdsAngkatan
);
@endif

function openVideoModal(type) {
    type = type || 'sambutan';
    if (type === 'angkatan') {
        @if (count($youtubeEmbedIdsAngkatan) > 0) playerAngkatan.open(); @endif
    } else {
        @if (count($youtubeEmbedIds) > 0) playerSambutan.open(); @endif
    }
}

function closeVideoModal() {
    @if (count($youtubeEmbedIds) > 0) playerSambutan.close(); @endif
}

function closeVideoModalAngkatan() {
    @if (count($youtubeEmbedIdsAngkatan) > 0) playerAngkatan.close(); @endif
}

@if (count($youtubeEmbedIds) > 0)
window.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() { openVideoModal('sambutan'); }, 700);
});
@endif

document.addEventListener('keydown', function(e) {
    if (e.key !== 'Escape') return;
    var sambutanModal = document.getElementById('video-modal');
    var angkatanModal = document.getElementById('video-modal-angkatan');
    if (sambutanModal && sambutanModal.classList.contains('vm-active')) { closeVideoModal(); return; }
    if (angkatanModal && angkatanModal.classList.contains('vm-active')) { closeVideoModalAngkatan(); return; }
    closeDearFlip();
});

// ── Slider ───────────────────────────────────────────────────────────────
function slideLeft(btn) {
    const slider = btn.closest('.relative').querySelector('.books-slider');
    slider.scrollBy({ left: -480, behavior: 'smooth' });
}

function slideRight(btn) {
    const slider = btn.closest('.relative').querySelector('.books-slider');
    slider.scrollBy({ left: 480, behavior: 'smooth' });
}

function updateSliderButtons(slider) {
    const container = slider.closest('.relative');
    const leftBtn   = container.querySelector('.slider-btn-left');
    const rightBtn  = container.querySelector('.slider-btn-right');
    const atStart   = slider.scrollLeft <= 0;
    const atEnd     = slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 4;

    leftBtn.classList.toggle('opacity-0', atStart);
    leftBtn.classList.toggle('pointer-events-none', atStart);
    rightBtn.classList.toggle('opacity-0', atEnd);
    rightBtn.classList.toggle('pointer-events-none', atEnd);
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.books-slider').forEach(function(slider) {
        updateSliderButtons(slider);
    });
});
</script>

@endsection
