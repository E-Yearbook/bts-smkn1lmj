@extends('layouts.index')
{{-- viewbook page --}}
@section('content')

{{--
    Dummy data — ganti dengan data dari controller
    Contoh: $year = 2025, $categories = [...]
--}}
@php
    $year = $year ?? 2025;
    $categories = $categories ?? [
        [
            'slug'    => 'kelas',
            'label'   => 'Kelas',
            'icon'    => 'class',
            'color'   => 'indigo',
            'books'   => [
                ['title' => 'XII RPL 1', 'cover' => 'storage/cover1.png'],
                ['title' => 'XII RPL 2', 'cover' => 'storage/cover2.png'],
                ['title' => 'XII TKJ 1', 'cover' => 'storage/cover3.png'],
                ['title' => 'XII TKJ 2', 'cover' => 'storage/cover4.png'],
                ['title' => 'XII MM 1',  'cover' => 'storage/cover5.png'],
                ['title' => 'XII MM 2',  'cover' => 'storage/cover6.png'],
            ],
        ],
        [
            'slug'    => 'ekstrakurikuler',
            'label'   => 'Ekstrakurikuler',
            'icon'    => 'star',
            'color'   => 'violet',
            'books'   => [
                ['title' => 'OSIS',      'cover' => null],
                ['title' => 'Pramuka',   'cover' => null],
                ['title' => 'PMR',       'cover' => null],
                ['title' => 'Basket',    'cover' => null],
            ],
        ],
        [
            'slug'    => 'organisasi',
            'label'   => 'Organisasi',
            'icon'    => 'users',
            'color'   => 'blue',
            'books'   => [
                ['title' => 'OSIS',      'cover' => null],
                ['title' => 'MPK',       'cover' => null],
                ['title' => 'Rohis',     'cover' => null],
            ],
        ],
        [
            'slug'    => 'guru',
            'label'   => 'Struktur Guru',
            'icon'    => 'academic',
            'color'   => 'emerald',
            'books'   => [
                ['title' => 'Kepala Sekolah & Wakil', 'cover' => null],
                ['title' => 'Staff TU',               'cover' => null],
                ['title' => 'Wali Kelas',             'cover' => null],
            ],
        ],
        [
            'slug'    => 'lainnya',
            'label'   => 'Lainnya',
            'icon'    => 'grid',
            'color'   => 'rose',
            'books'   => [
                ['title' => 'Kenangan Wisuda', 'cover' => null],
                ['title' => 'Study Tour',      'cover' => null],
            ],
        ],
    ];

    $colorMap = [
        'indigo'  => ['bg' => 'bg-indigo-50',  'text' => 'text-indigo-500',  'border' => 'border-indigo-200/60',  'badge' => 'bg-indigo-100 text-indigo-600',  'hover_shadow' => 'hover:shadow-[0_12px_36px_rgba(99,102,241,0.18)]',  'hover_border' => 'hover:border-indigo-300/60'],
        'violet'  => ['bg' => 'bg-violet-50',  'text' => 'text-violet-500',  'border' => 'border-violet-200/60',  'badge' => 'bg-violet-100 text-violet-600',  'hover_shadow' => 'hover:shadow-[0_12px_36px_rgba(139,92,246,0.18)]',   'hover_border' => 'hover:border-violet-300/60'],
        'blue'    => ['bg' => 'bg-blue-50',    'text' => 'text-blue-500',    'border' => 'border-blue-200/60',    'badge' => 'bg-blue-100 text-blue-600',      'hover_shadow' => 'hover:shadow-[0_12px_36px_rgba(59,130,246,0.18)]',   'hover_border' => 'hover:border-blue-300/60'],
        'emerald' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-500', 'border' => 'border-emerald-200/60', 'badge' => 'bg-emerald-100 text-emerald-600','hover_shadow' => 'hover:shadow-[0_12px_36px_rgba(16,185,129,0.18)]',  'hover_border' => 'hover:border-emerald-300/60'],
        'rose'    => ['bg' => 'bg-rose-50',    'text' => 'text-rose-500',    'border' => 'border-rose-200/60',    'badge' => 'bg-rose-100 text-rose-600',      'hover_shadow' => 'hover:shadow-[0_12px_36px_rgba(244,63,94,0.18)]',   'hover_border' => 'hover:border-rose-300/60'],
    ];
@endphp

<div class="relative min-h-screen bg-[#f8f7f4] overflow-x-hidden">

    {{-- Background orbs --}}
    <div class="absolute top-[-120px] right-[-100px] w-[500px] h-[500px] rounded-full bg-blue-500/[0.07] blur-[90px] pointer-events-none"></div>
    <div class="absolute bottom-[-100px] left-[-80px] w-[400px] h-[400px] rounded-full bg-indigo-500/[0.06] blur-[80px] pointer-events-none"></div>

    {{-- Dot grid --}}
    <div class="absolute inset-0 pointer-events-none"
        style="background-image: linear-gradient(rgba(0,0,0,0.028) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,0.028) 1px, transparent 1px); background-size: 42px 42px;">
    </div>

    <div class="relative z-10 w-full max-w-6xl mx-auto px-6 py-16">

        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 font-mono text-[11px] tracking-[0.15em] text-gray-400 uppercase mb-10"
            data-aos="fade-down" data-aos-duration="500">
            <a href="/" class="hover:text-indigo-500 transition-colors duration-200">Home</a>
            <span class="text-gray-300">/</span>
            <a href="/" class="hover:text-indigo-500 transition-colors duration-200">Angkatan</a>
            <span class="text-gray-300">/</span>
            <span class="text-indigo-500">{{ $year }}</span>
        </div>

        {{-- Page header --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-14"
            data-aos="fade-down" data-aos-duration="700">
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

            {{-- Back button --}}
            <a href="/"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                       bg-white border border-black/[0.07] shadow-sm
                       font-mono text-[11px] font-bold tracking-[0.15em] uppercase text-gray-500
                       transition-all duration-200 hover:border-indigo-300 hover:text-indigo-600 hover:shadow-md
                       self-start md:self-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                Kembali
            </a>
        </div>

        {{-- Category filter tabs --}}
        <div class="flex items-center gap-2 flex-wrap mb-10" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
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

        {{-- Categories --}}
        @foreach ($categories as $i => $cat)
        @php $c = $colorMap[$cat['color']]; @endphp
        <div class="category-section mb-14" data-category="{{ $cat['slug'] }}"
            data-aos="fade-up" data-aos-duration="700" data-aos-delay="{{ $i * 80 }}">

            {{-- Section header --}}
            <div class="flex items-center gap-3 mb-6">
                {{-- Icon --}}
                <div class="w-9 h-9 rounded-xl {{ $c['bg'] }} flex items-center justify-center shrink-0">
                    @if ($cat['icon'] === 'class')
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 {{ $c['text'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                        <line x1="9" y1="7" x2="15" y2="7"/><line x1="9" y1="11" x2="13" y2="11"/>
                    </svg>
                    @elseif ($cat['icon'] === 'star')
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 {{ $c['text'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                    </svg>
                    @elseif ($cat['icon'] === 'users')
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 {{ $c['text'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    @elseif ($cat['icon'] === 'academic')
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 {{ $c['text'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
                    </svg>
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 {{ $c['text'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                    </svg>
                    @endif
                </div>

                <div>
                    <h2 class="text-lg font-bold italic text-gray-800 tracking-tight leading-none mb-0.5">
                        {{ $cat['label'] }}
                    </h2>
                    <p class="font-mono text-[10px] tracking-[0.18em] uppercase text-gray-400">
                        {{ count($cat['books']) }} buku tersedia
                    </p>
                </div>

                {{-- Divider line --}}
                <div class="flex-1 h-px bg-gradient-to-r from-gray-200 to-transparent ml-2"></div>
            </div>

            {{-- Books grid --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-5">
                @foreach ($cat['books'] as $bi => $book)
                <a href="/yearbook/{{ $year }}/{{ $cat['slug'] }}/{{ $bi + 1 }}"
                    class="book-card group flex flex-col items-center gap-3 cursor-pointer"
                    data-aos="zoom-in" data-aos-duration="500" data-aos-delay="{{ $bi * 60 }}">

                    {{-- Book cover --}}
                    <div class="relative w-full aspect-[3/4] rounded-xl overflow-hidden
                                border {{ $c['border'] }} bg-white
                                shadow-[0_2px_12px_rgba(0,0,0,0.07)]
                                transition-all duration-300
                                group-hover:-translate-y-2
                                {{ $c['hover_shadow'] }}
                                {{ $c['hover_border'] }}">

                        @if (!empty($book['cover']))
                        <img src="{{ asset($book['cover']) }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            alt="{{ $book['title'] }}">
                        @else
                        {{-- Fallback cover --}}
                        <div class="w-full h-full flex flex-col items-center justify-center {{ $c['bg'] }} relative">
                            {{-- Book spine accent --}}
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

                        {{-- Open badge on hover --}}
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
                    <p class="font-mono text-[11px] font-bold tracking-[0.08em] text-gray-600 text-center leading-tight
                               group-hover:text-gray-900 transition-colors duration-200 line-clamp-2">
                        {{ $book['title'] }}
                    </p>

                </a>
                @endforeach
            </div>
        </div>
        @endforeach

        {{-- Footer deco --}}
        <div class="flex items-center justify-center gap-5 pt-4 pb-8"
            data-aos="fade-up" data-aos-duration="600">
            <div class="h-px w-16 bg-gradient-to-r from-transparent to-gray-300"></div>
            <span class="font-mono text-[10px] tracking-[0.25em] uppercase text-gray-300">SMKN 1 &mdash; Angkatan {{ $year }}</span>
            <div class="h-px w-16 bg-gradient-to-l from-transparent to-gray-300"></div>
        </div>

    </div>
</div>

<style>
    /* Filter active state */
    .active-filter {
        background: #6366f1 !important;
        color: white !important;
        border-color: #6366f1 !important;
        box-shadow: 0 4px 14px rgba(99,102,241,0.3);
    }
    .filter-btn:not(.active-filter) {
        background: white;
        color: #6b7280;
        border-color: rgba(0,0,0,0.07);
    }

    /* Category section hide/show */
    .category-section { transition: opacity 0.3s ease, transform 0.3s ease; }
    .category-section.hidden-cat { display: none; }
</style>

<script>
function filterCategory(slug) {
    // Update button states
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active-filter');
        btn.classList.add('filter-btn');
    });
    document.querySelector(`[data-cat="${slug}"]`).classList.add('active-filter');

    // Show/hide sections
    document.querySelectorAll('.category-section').forEach(section => {
        if (slug === 'all' || section.dataset.category === slug) {
            section.classList.remove('hidden-cat');
        } else {
            section.classList.add('hidden-cat');
        }
    });
}
</script>

@endsection
