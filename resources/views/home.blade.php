<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DIGITAL YEARBOOK</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/smkn1logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#fafaf9] m-0 overflow-hidden">

    @php
        $years = $covers->pluck('year')->sort()->values();
        $count = $years->count();
    @endphp

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
                    <div class="ybk-row">
                        <div class="ybk-arrow-col">
                            <button id="ybkPrev" class="ybk-btn-arrow">
                                <svg class="w-[15px] h-[15px] pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="15 18 9 12 15 6"/>
                                </svg>
                            </button>
                        </div>

                        <div class="ybk-stage" id="ybkStage">
                            <div class="ybk-track" id="ybkTrack">
                                @foreach ($years as $year)
                                    @php $cover = $covers->firstWhere('year', $year); @endphp
                                    <div class="ybk-item" data-year="{{ $year }}" data-href="{{ route('book', $year) }}">
                                        <div class="ybk-cover rounded-[14px] overflow-hidden bg-[#f0f0f0] border border-black/[0.07] relative">
                                            <img src="{{ $cover ? asset('storage/' . $cover->cover_path) : '' }}"
                                                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
                                                 class="w-full h-full object-cover block"
                                                 alt="Cover {{ $year }}">
                                            <div class="absolute inset-0 hidden flex-col items-center justify-center bg-gradient-to-br from-[#eef2ff] to-[#e0e7ff]">
                                                <svg class="w-[52px] h-[52px] text-indigo-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                                                    <line x1="9" y1="7" x2="15" y2="7"/>
                                                    <line x1="9" y1="11" x2="13" y2="11"/>
                                                </svg>
                                            </div>
                                            <div class="ybk-overlay absolute inset-0 flex items-end justify-center pb-[18px]">
                                                <span class="ybk-buka-btn inline-flex items-center gap-[5px] px-4 py-[7px] rounded-full bg-white/[0.92] backdrop-blur-[8px] font-mono text-[10px] font-bold tracking-[0.14em] uppercase text-indigo-600 shadow-[0_2px_12px_rgba(0,0,0,0.12)]">
                                                    Buka
                                                    <svg class="w-[11px] h-[11px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="9 6 15 12 9 18"/>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="ybk-shine absolute top-[-50%] left-[-75%] w-1/2 h-[200%] bg-gradient-to-r from-transparent via-white/35 to-transparent -skew-x-[20deg] pointer-events-none"></div>
                                        </div>
                                        <div class="flex flex-col items-center gap-[3px] text-center" style="margin-top:clamp(10px,1.5vh,18px)">
                                            <span class="ybk-lbl-top font-mono text-[9px] font-bold tracking-[0.28em] uppercase text-[#a3a3a3]">Angkatan</span>
                                            <span class="ybk-lbl-year font-bold italic tracking-[-0.04em] leading-none text-[#1a1a1a]" style="font-size:clamp(1.2rem,3vw,1.7rem)">{{ $year }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="ybk-arrow-col">
                            <button id="ybkNext" class="ybk-btn-arrow">
                                <svg class="w-[15px] h-[15px] pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 6 15 12 9 18"/>
                                </svg>
                            </button>
                        </div>
                    </div>

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

<style>
    .ybk-row { display:flex; align-items:center; width:100%; }

    .ybk-arrow-col { flex:0 0 64px; display:flex; align-items:center; justify-content:center; }

    .ybk-btn-arrow {
        width:42px; height:42px; border-radius:99px; background:white;
        border:1px solid rgba(0,0,0,0.08);
        box-shadow:0 1px 4px rgba(0,0,0,0.06),0 4px 16px rgba(0,0,0,0.06);
        display:flex; align-items:center; justify-content:center;
        color:#737373; cursor:pointer; transition:all 0.2s; flex-shrink:0;
    }
    .ybk-btn-arrow:hover { background:#6366f1; color:white; border-color:#6366f1; box-shadow:0 4px 20px rgba(99,102,241,0.35); transform:scale(1.08); }
    .ybk-btn-arrow:active { transform:scale(0.96); }

    /* Stage clips */
    .ybk-stage { flex:1; min-width:0; overflow:hidden; position:relative; padding:10px 0; cursor:grab; }
    .ybk-stage:active { cursor:grabbing; }

    /* Track */
    .ybk-track {
        display:flex; align-items:center; gap:24px;
        will-change:transform;
        transition:transform 0.55s cubic-bezier(0.25,1,0.5,1);
        user-select:none;
    }

    /* Items */
    .ybk-item { flex:0 0 auto; display:flex; flex-direction:column; align-items:center; cursor:pointer; }

    .ybk-item.is-inactive { opacity:0.36; transform:scale(0.84); transition:opacity 0.4s,transform 0.4s cubic-bezier(0.25,1,0.5,1); }
    .ybk-item.is-active   { opacity:1;    transform:scale(1);    transition:opacity 0.4s,transform 0.4s cubic-bezier(0.25,1,0.5,1); }

    /* Cover */
    .ybk-cover {
        width:clamp(130px,18vh,200px); height:clamp(180px,26vh,280px);
        box-shadow:0 2px 4px rgba(0,0,0,0.04),0 6px 20px rgba(0,0,0,0.08),0 20px 40px rgba(0,0,0,0.06);
        transition:box-shadow 0.35s,border-color 0.35s;
    }
    .ybk-item.is-active:hover .ybk-cover {
        box-shadow:0 4px 8px rgba(0,0,0,0.04),0 16px 40px rgba(99,102,241,0.18),0 32px 64px rgba(99,102,241,0.10);
        border-color:rgba(129,140,248,0.25) !important;
    }

    /* Labels */
    .ybk-lbl-top  { transition:color 0.2s; }
    .ybk-lbl-year { transition:color 0.25s; }
    .ybk-item.is-active:hover .ybk-lbl-top  { color:#818cf8; }
    .ybk-item.is-active:hover .ybk-lbl-year { color:#4f46e5; }

    /* Overlay */
    .ybk-overlay { background:rgba(79,70,229,0); transition:background 0.3s; }
    .ybk-item.is-active:hover .ybk-overlay { background:rgba(79,70,229,0.08); }

    /* Buka btn */
    .ybk-buka-btn { opacity:0; transform:translateY(6px); transition:opacity 0.25s,transform 0.25s; }
    .ybk-item.is-active:hover .ybk-buka-btn { opacity:1; transform:translateY(0); }

    /* Shine */
    .ybk-shine { transition:left 0.7s; }
    .ybk-item.is-active:hover .ybk-shine { left:130% !important; }

    /* Dots */
    .ybk-dot {
        width:5px; height:5px; border-radius:99px; background:#d4d4d4;
        cursor:pointer; transition:all 0.3s cubic-bezier(0.34,1.56,0.64,1);
        border:none; padding:0; flex-shrink:0;
    }
    .ybk-dot.is-active { background:#6366f1; width:24px; box-shadow:0 0 8px rgba(99,102,241,0.45); }

    @media (max-width:540px) {
        .ybk-arrow-col { flex:0 0 44px; }
        .ybk-btn-arrow { width:36px; height:36px; }
        .ybk-track { gap:18px; }
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
@if ($count > 0)

    const years      = @json($years->values());
    const activeYear = {{ $activeYear }};
    const GAP        = 24; // matches CSS gap (px)

    const stage   = document.getElementById('ybkStage');
    const track   = document.getElementById('ybkTrack');
    const btnPrev = document.getElementById('ybkPrev');
    const btnNext = document.getElementById('ybkNext');
    const dotsEl  = document.getElementById('ybkDots');

    // ── 1. Clone nodes for infinite buffer ──────────────────────────────────
    const origItems = Array.from(track.children);
    const n = origItems.length;

    // Clone enough sets so viewport is always filled on both sides.
    // With n items and typical viewport showing ~5 cards, 3 copies each side is safe.
    const SIDE = Math.max(3, Math.ceil(10 / n));

    for (let c = 0; c < SIDE; c++) {
        // Prepend (insert in reverse so order is preserved)
        for (let i = n - 1; i >= 0; i--) {
            const cl = origItems[i].cloneNode(true);
            track.insertBefore(cl, track.firstChild);
        }
        // Append
        for (let i = 0; i < n; i++) {
            track.appendChild(origItems[i].cloneNode(true));
        }
    }

    const allItems = Array.from(track.children);
    // Real items start at index SIDE * n
    const REAL_START = SIDE * n;

    // ── 2. Helpers ───────────────────────────────────────────────────────────
    let itemW = 0;

    function measure() {
        itemW = allItems[0].getBoundingClientRect().width;
    }

    function centerOffset(idx) {
        return -(idx * (itemW + GAP)) + (stage.offsetWidth / 2 - itemW / 2);
    }

    function setPos(offset, anim) {
        if (!anim) {
            track.style.transition = 'none';
            track.style.transform  = `translateX(${offset}px)`;
            track.getBoundingClientRect(); // flush
            track.style.transition = '';
        } else {
            track.style.transform = `translateX(${offset}px)`;
        }
    }

    // Logical index 0..n-1
    let currentIdx = REAL_START + Math.max(0, years.indexOf(activeYear));

    function logicalIdx() {
        return ((currentIdx - REAL_START) % n + n) % n;
    }

    // ── 3. Refresh visual state ──────────────────────────────────────────────
    // Only the EXACT currentIdx gets is-active — not all clones with same logical index
    function refresh() {
        const li = logicalIdx();
        allItems.forEach((item, i) => {
            const act = i === currentIdx;
            item.classList.toggle('is-active',   act);
            item.classList.toggle('is-inactive', !act);
        });
        Array.from(dotsEl.children).forEach((dot, i) => {
            dot.classList.toggle('is-active', i === li);
        });
    }

    // ── 4. Teleport silently if we're running out of clones ──────────────────
    function rebase() {
        // Stay within [REAL_START - n*(SIDE-1), REAL_START + n*SIDE]
        const lo = REAL_START - n * (SIDE - 1);
        const hi = REAL_START + n * SIDE;
        if (currentIdx < lo) {
            currentIdx += n;
            setPos(centerOffset(currentIdx), false);
        } else if (currentIdx > hi) {
            currentIdx -= n;
            setPos(centerOffset(currentIdx), false);
        }
    }

    // ── 5. Navigate ───────────────────────────────────────────────────────────
    let busy = false;

    function go(idx, anim = true) {
        currentIdx = idx;
        setPos(centerOffset(currentIdx), anim);
        refresh();
    }

    function step(dir) {
        if (busy) return;
        busy = true;
        go(currentIdx + dir);
        setTimeout(() => { busy = false; rebase(); }, 580);
    }

    btnPrev.addEventListener('click', () => step(-1));
    btnNext.addEventListener('click', () => step(+1));

    // ── 6. Dots ───────────────────────────────────────────────────────────────
    years.forEach((_, i) => {
        const dot = document.createElement('button');
        dot.className = 'ybk-dot';
        dot.addEventListener('click', () => {
            if (busy) return;
            busy = true;
            const diff = ((i - logicalIdx()) + n) % n;
            const step_  = diff <= n / 2 ? diff : diff - n;
            go(currentIdx + step_);
            setTimeout(() => { busy = false; rebase(); }, 580);
        });
        dotsEl.appendChild(dot);
    });

    // ── 7 & 8. Drag / swipe (mouse + touch) ──────────────────────────────────
    let dragStartX = 0, dragCurX = 0, dragStartOffset = 0;
    let isDragging = false, hasDragged = false;
    let clickedItem = null;

    function currentOffset() {
        const mat = new DOMMatrix(getComputedStyle(track).transform);
        return mat.m41;
    }

    stage.addEventListener('pointerdown', e => {
        // Ignore button clicks
        if (e.target.closest('.ybk-btn-arrow')) return;
        isDragging  = true;
        hasDragged  = false;
        dragStartX  = e.clientX;
        dragCurX    = e.clientX;
        dragStartOffset = currentOffset();
        clickedItem = e.target.closest('.ybk-item');
        track.style.transition = 'none';
        stage.setPointerCapture(e.pointerId);
    });

    stage.addEventListener('pointermove', e => {
        if (!isDragging) return;
        const dx = e.clientX - dragStartX;
        if (Math.abs(dx) > 5) hasDragged = true;
        dragCurX = e.clientX;
        track.style.transform = `translateX(${dragStartOffset + dx}px)`;
    });

    stage.addEventListener('pointerup', e => {
        if (!isDragging) return;
        isDragging = false;
        track.style.transition = '';

        const dx = e.clientX - dragStartX;

        if (!hasDragged) {
            // It's a click
            if (!clickedItem) return;
            if (clickedItem.classList.contains('is-active')) {
                window.location.href = clickedItem.dataset.href;
            } else {
                if (busy) return;
                busy = true;
                const idx = allItems.indexOf(clickedItem);
                go(idx);
                setTimeout(() => { busy = false; rebase(); }, 580);
            }
        } else {
            // It's a drag — snap to nearest or step
            if (Math.abs(dx) > 40) {
                step(dx < 0 ? 1 : -1);
            } else {
                // Snap back to current
                setPos(centerOffset(currentIdx), true);
            }
        }
    });

    stage.addEventListener('pointercancel', () => {
        if (!isDragging) return;
        isDragging = false;
        track.style.transition = '';
        setPos(centerOffset(currentIdx), true);
    });

    // ── 9. Autoplay ────────────────────────────────────────────────────────
    let timer = setInterval(() => step(1), 3200);
    stage.addEventListener('pointerenter', () => clearInterval(timer));
    stage.addEventListener('pointerleave', () => { timer = setInterval(() => step(1), 3200); });

    // ── 10. Init ───────────────────────────────────────────────────────────
    requestAnimationFrame(() => requestAnimationFrame(() => {
        measure();
        go(currentIdx, false);
    }));

    let resizeT;
    window.addEventListener('resize', () => {
        clearTimeout(resizeT);
        resizeT = setTimeout(() => { measure(); setPos(centerOffset(currentIdx), false); }, 80);
    });

@endif
});
</script>

</html>
