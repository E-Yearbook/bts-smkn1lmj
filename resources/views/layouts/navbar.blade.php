<nav x-data="{ open: false }"
     class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-black/[0.06]">

    <div class="max-w-6xl mx-auto px-6">
        <div class="flex justify-between items-center h-16">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-3 no-underline">
                <div class="w-9 h-9 rounded-xl bg-indigo-50 flex items-center justify-center overflow-hidden shrink-0">
                    <img src="{{ asset('img/smkn1logo.png') }}" class="w-7 h-7 object-contain" alt="SMKN 1">
                </div>
                <div class="flex flex-col leading-none">
                    <span class="font-mono text-sm font-bold tracking-[0.12em] text-indigo-600">E-YEARBOOK</span>
                    <span class="font-mono text-[9px] tracking-[0.2em] text-gray-400 uppercase">SMKN 1</span>
                </div>
            </a>

            {{-- Desktop links --}}
            <div class="hidden md:flex items-center gap-1">
                @foreach ([['/', 'Home'],
                // ['#galeri', 'Galeri'],
                ['#tentang', 'Tentang']
                ] as [$href, $label])
                <a href="{{ $href }}"
                   class="relative px-4 py-2 rounded-lg font-mono text-[11px] font-bold tracking-[0.15em] uppercase text-gray-500
                          transition-all duration-200 hover:text-indigo-600 hover:bg-indigo-50 no-underline
                          after:absolute after:bottom-1 after:left-4 after:right-4 after:h-[1.5px] after:bg-indigo-500
                          after:scale-x-0 after:transition-transform after:duration-200 after:origin-left
                          hover:after:scale-x-100">
                    {{ $label }}
                </a>
                @endforeach
            </div>

            {{-- Hamburger --}}
            <button @click="open = !open"
                    class="md:hidden flex flex-col gap-[5px] p-2 bg-transparent border-none cursor-pointer">
                <span :class="open ? 'rotate-45 translate-y-[7px]' : ''"
                      class="block w-[22px] h-0.5 bg-gray-700 rounded transition-all duration-250 origin-center"></span>
                <span :class="open ? 'opacity-0 scale-x-0' : ''"
                      class="block w-[22px] h-0.5 bg-gray-700 rounded transition-all duration-250"></span>
                <span :class="open ? '-rotate-45 -translate-y-[7px]' : ''"
                      class="block w-[22px] h-0.5 bg-gray-700 rounded transition-all duration-250 origin-center"></span>
            </button>

        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="md:hidden border-t border-black/[0.06] bg-white/95">
        <div class="flex flex-col px-6 py-3 gap-1">
            @foreach ([['/', 'Home'], ['#angkatan', 'Angkatan'], ['#galeri', 'Galeri'], ['#tentang', 'Tentang']] as [$href, $label])
            <a href="{{ $href }}"
               @click="open = false"
               class="px-4 py-3 rounded-xl font-mono text-xs font-bold tracking-[0.15em] uppercase text-gray-600
                      hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200 no-underline">
                {{ $label }}
            </a>
            @endforeach
        </div>
    </div>

</nav>
