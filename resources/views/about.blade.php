@extends('layouts.index')

@section('title', 'Tentang — E-Yearbook SMKN 1')

@section('content')

<div class="relative min-h-screen bg-[#f8f7f4] overflow-x-hidden">

    {{-- Ambient orbs --}}
    <div class="absolute top-[-120px] right-[-100px] w-[500px] h-[500px] rounded-full bg-indigo-500/[0.07] blur-[90px] pointer-events-none"></div>
    <div class="absolute bottom-[-100px] left-[-80px] w-[400px] h-[400px] rounded-full bg-violet-500/[0.06] blur-[80px] pointer-events-none"></div>

    {{-- Dot grid --}}
    <div class="absolute inset-0 pointer-events-none"
        style="background-image:linear-gradient(rgba(0,0,0,0.028) 1px,transparent 1px),linear-gradient(90deg,rgba(0,0,0,0.028) 1px,transparent 1px);background-size:42px 42px;">
    </div>

    <div class="relative z-10 w-full max-w-4xl mx-auto px-6 py-16">

        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 font-mono text-[11px] tracking-[0.15em] text-gray-400 uppercase mb-10">
            <a href="/" class="hover:text-indigo-500 transition-colors duration-200">Home</a>
            <span class="text-gray-300">/</span>
            <span class="text-indigo-500">Tentang</span>
        </div>

        {{-- Hero --}}
        <div class="mb-16">
            <span class="inline-flex items-center gap-2.5 font-mono text-[11px] font-bold tracking-[0.3em] text-indigo-500 uppercase mb-4">
                <span class="w-1 h-1 rounded-full bg-indigo-500 inline-block"></span>
                E-Yearbook
                <span class="w-1 h-1 rounded-full bg-indigo-500 inline-block"></span>
            </span>
            <h1 class="text-4xl md:text-5xl font-normal italic text-gray-900 tracking-tight leading-tight mb-4">
                Tentang <em class="text-indigo-500 not-italic font-bold">BTS</em>
            </h1>
            <p class="text-gray-500 text-base leading-relaxed max-w-xl">
                Platform buku tahunan digital untuk mengabadikan kenangan terbaik setiap angkatan SMKN 1 Lumajang.
            </p>
        </div>

        {{-- School card --}}
        <div class="bg-white rounded-2xl border border-black/[0.06] shadow-sm p-8 mb-8 flex flex-col md:flex-row items-center gap-8">
            <div class="shrink-0">
                <div class="w-24 h-24 rounded-2xl bg-indigo-50 flex items-center justify-center overflow-hidden border border-indigo-100">
                    <img src="{{ asset('img/smkn1logo.png') }}" class="w-16 h-16 object-contain" alt="SMKN 1 Lumajang">
                </div>
            </div>
            <div>
                <p class="font-mono text-[10px] font-bold tracking-[0.28em] uppercase text-indigo-400 mb-1">Sekolah</p>
                <h2 class="text-xl font-bold text-gray-900 tracking-tight mb-1">SMKN 1 Lumajang</h2>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Sekolah Menengah Kejuruan Negeri 1 Lumajang — mencetak generasi terampil dan berkarakter sejak lama.
                    BTS (Buku Tahunan Sekolah) hadir dalam format digital agar kenangan bisa diakses kapan saja dan di mana saja.
                </p>
            </div>
        </div>

        {{-- Feature cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
            @foreach ([
                ['ri-book-open-line',   'indigo',  'Buku Digital',    'Baca buku tahunan langsung di browser dengan tampilan flipbook interaktif.'],
                ['ri-time-line',        'violet',  'Per Angkatan',    'Setiap angkatan punya koleksi buku sendiri, tersimpan rapi dan mudah dicari.'],
                ['ri-video-line',       'blue',    'Video Sambutan',  'Saksikan video sambutan dari setiap angkatan langsung di halaman buku.'],
            ] as [$icon, $color, $title, $desc])
            <div class="bg-white rounded-2xl border border-black/[0.06] shadow-sm p-6">
                <div class="w-10 h-10 rounded-xl bg-{{ $color }}-50 flex items-center justify-center mb-4">
                    <i class="{{ $icon }} text-{{ $color }}-500 text-lg"></i>
                </div>
                <h3 class="font-bold text-gray-800 text-sm mb-1">{{ $title }}</h3>
                <p class="text-gray-400 text-xs leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>


        {{-- Footer deco --}}
        <div class="flex items-center justify-center gap-5">
            <div class="h-px w-16 bg-gradient-to-r from-transparent to-gray-300"></div>
            <span class="font-mono text-[10px] tracking-[0.25em] uppercase text-gray-400">SMKN 1 Lumajang &mdash; Kenangan Terbaik</span>
            <div class="h-px w-16 bg-gradient-to-l from-transparent to-gray-300"></div>
        </div>

    </div>
</div>

@endsection
