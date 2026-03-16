@extends('admin.layouts.app')

@section('title', 'Tambah Year Cover')

@php $page = 'yearcover'; @endphp

@push('styles')
<style>
    #dropArea {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        background: #f9fafb;
        min-height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: border-color 0.2s ease, background 0.2s ease;
    }
    #dropArea:hover,
    #dropArea.drag-over {
        border-color: #3b82f6;
        background: #eff6ff;
    }
    #dropArea.has-file {
        border-color: #22c55e;
        background: #f0fdf4;
    }
    .dark #dropArea                  { border-color: #374151; background: #111827; }
    .dark #dropArea:hover,
    .dark #dropArea.drag-over        { border-color: #3b82f6; background: #1e3a5f; }
    .dark #dropArea.has-file         { border-color: #16a34a; background: #052e16; }

    /* Improve input and label color contrast for dark mode */
    .dark input[type="number"],
    .dark input[type="text"] {
        background-color: #111827;
        color: #fff;
        border-color: #374151;
    }
    .dark input[type="number"]::placeholder,
    .dark input[type="text"]::placeholder {
        color: #6b7280;
        opacity: 1;
    }
    .dark label {
        color: #d1d5db !important;
    }
    /* Always make asterisk red */
    .required-asterisk, .text-red-700, .text-red-500, .dark .text-red-700, .dark .text-red-500, .dark .required-asterisk {
        color: #ef4444 !important;
    }
</style>
@endpush

@section('content')

<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Tambah Cover</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola cover dan video tahunan sekolah</p>
    </div>
</div>

<form id="yearCoverForm" action="{{ route('yearcover.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

        {{-- LEFT: Tahun & YouTube --}}
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white">Informasi Cover</h3>
                <div class="space-y-4">

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tahun <span class="required-asterisk">*</span>
                        </label>
                        <input type="number" name="year" id="year"
                            value="{{ old('year') }}" min="2000" max="2100"
                            placeholder="Contoh: 2024"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:outline-none dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-500" />
                    </div>

                    <div class="mt-3">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Link YouTube <span class="required-asterisk">*</span>
                        </label>
                        <input type="text" name="youtube_link" id="youtube_link"
                            value="{{ old('youtube_link') }}"
                            placeholder="https://youtu.be/xxxxxx"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:outline-none dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-500" />
                        <p class="mt-1 text-xs text-gray-400">Preview video muncul otomatis setelah link dimasukkan.</p>
                    </div>

                </div>
            </div>

            {{-- YouTube Preview --}}
            <div id="yt-preview" class="hidden rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-700 dark:bg-gray-800">
                <h3 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Preview Video YouTube</h3>
                <div class="overflow-hidden rounded-xl bg-black">
                    <iframe id="yt-iframe" src="" width="100%" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen style="aspect-ratio:16/9; display:block;"></iframe>
                </div>
            </div>
        </div>

        {{-- RIGHT: Upload Cover --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-1 text-base font-semibold text-gray-800 dark:text-white">Cover Buku</h3>
            <p class="mb-4 text-xs text-gray-400">Format: JPG, PNG • Maks: 5MB</p>

            {{-- INPUT FILE — harus ada di dalam form, accept batasi di browser --}}
            <input type="file" name="cover" id="coverInput"
                   accept="image/jpeg,image/png"
                   class="hidden" />

            {{-- Drop Area --}}
            <div id="dropArea">
                <div id="dropMessage" class="text-center px-4 py-2 w-full">
                    <div class="mb-4 flex justify-center">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-50 dark:bg-blue-900/30">
                            <svg class="h-7 w-7 text-blue-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Drag & Drop file di sini</p>
                    <p class="text-xs text-gray-400 mb-4">atau klik tombol di bawah untuk memilih file</p>
                    <button type="button" onclick="document.getElementById('coverInput').click()"
                        class="inline-flex items-center gap-2 rounded-lg bg-blue-500 px-4 py-2 text-sm font-medium text-white hover:bg-blue-600 transition-colors">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                        </svg>
                        Pilih File
                    </button>
                </div>

                {{-- Preview setelah file dipilih --}}
                <div id="filePreview" class="hidden w-full px-4 py-4">
                    <div class="flex items-center gap-4">
                        <img id="imgPreview" src="" alt="Preview"
                             class="h-20 w-20 rounded-xl object-cover border-2 border-green-300 flex-shrink-0 shadow" />
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-semibold text-gray-800 dark:text-white truncate" id="fileName"></p>
                            <p class="text-xs text-gray-400 mt-0.5" id="fileSize"></p>
                            <span class="mt-1 inline-block rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                File siap diupload
                            </span>
                        </div>
                        <button type="button" onclick="removeFile()"
                                class="flex-shrink-0 rounded-lg border border-red-200 bg-red-50 p-2 text-red-500 hover:bg-red-100 transition-colors">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                    <button type="button" onclick="document.getElementById('coverInput').click()"
                        class="mt-3 w-full rounded-lg border border-gray-200 py-1.5 text-xs text-gray-500 hover:bg-gray-50 transition-colors dark:border-gray-700 dark:hover:bg-gray-700">
                        Ganti File
                    </button>
                </div>
            </div>

        </div>
    </div>{{-- end grid --}}

    {{-- Tombol Submit — di dalam form, di luar grid --}}
    <div class="mt-6 flex items-center justify-end gap-3">
        <a href="{{ route('yearcover') }}"
           class="inline-flex items-center gap-2 rounded-lg rounded-xl bg-white px-5 py-3.5 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-inset ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
            Batal
        </a>
        <button type="submit" id="submitBtn"
            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all bg-brand-500 shadow-theme-xs hover:bg-brand-600">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            Simpan Cover
        </button>
    </div>

</form>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const coverInput = document.getElementById('coverInput');
const dropArea   = document.getElementById('dropArea');

// ── 1. Klik drop area (selain tombol) → buka file picker ──────────────────
dropArea.addEventListener('click', function (e) {
    // Jangan trigger kalau yang diklik adalah tombol atau anak tombol
    if (e.target.closest('button')) return;
    coverInput.click();
});

// ── 2. Drag & Drop ────────────────────────────────────────────────────────
dropArea.addEventListener('dragenter', (e) => { e.preventDefault(); dropArea.classList.add('drag-over'); });
dropArea.addEventListener('dragover',  (e) => { e.preventDefault(); dropArea.classList.add('drag-over'); });
dropArea.addEventListener('dragleave', (e) => { e.preventDefault(); dropArea.classList.remove('drag-over'); });
dropArea.addEventListener('drop', (e) => {
    e.preventDefault();
    dropArea.classList.remove('drag-over');
    const files = e.dataTransfer.files;
    if (files.length > 0) processFile(files[0]);
});

// ── 3. Input change (pilih file lewat dialog) ─────────────────────────────
coverInput.addEventListener('change', function () {
    if (this.files.length > 0) processFile(this.files[0]);
});

// ── 4. Proses & validasi file ─────────────────────────────────────────────
function processFile(file) {
    const allowed = ['image/jpeg', 'image/png'];

    if (!allowed.includes(file.type)) {
        Swal.fire({ icon: 'error', title: 'Format Tidak Valid!', text: 'Hanya file JPG dan PNG yang diperbolehkan.', confirmButtonColor: '#3b82f6' });
        coverInput.value = '';
        return;
    }
    if (file.size > 5 * 1024 * 1024) {
        Swal.fire({ icon: 'error', title: 'File Terlalu Besar!', text: 'Ukuran file maksimal 5MB.', confirmButtonColor: '#3b82f6' });
        coverInput.value = '';
        return;
    }

    // Jika file datang dari drag-drop, masukkan ke input agar ikut form submit
    if (!coverInput.files.length || coverInput.files[0].name !== file.name) {
        try {
            const dt = new DataTransfer();
            dt.items.add(file);
            coverInput.files = dt.files;
        } catch (err) {
            // DataTransfer tidak support (browser lama) — file sudah ada dari input.change, skip
        }
    }

    // Tampilkan preview gambar
    const reader = new FileReader();
    reader.onload = (e) => { document.getElementById('imgPreview').src = e.target.result; };
    reader.readAsDataURL(file);

    document.getElementById('fileName').textContent = file.name;
    document.getElementById('fileSize').textContent  = (file.size / 1024 / 1024).toFixed(2) + ' MB';

    // Tukar tampilan
    document.getElementById('dropMessage').classList.add('hidden');
    document.getElementById('filePreview').classList.remove('hidden');
    dropArea.classList.add('has-file');
}

function removeFile() {
    coverInput.value = '';
    document.getElementById('imgPreview').src = '';
    document.getElementById('filePreview').classList.add('hidden');
    document.getElementById('dropMessage').classList.remove('hidden');
    dropArea.classList.remove('has-file');
}

// ── 5. YouTube Preview ────────────────────────────────────────────────────
function extractYoutubeId(url) {
    const m = url.match(/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/);
    return m ? m[1] : null;
}

let ytTimer;
document.getElementById('youtube_link').addEventListener('input', function () {
    clearTimeout(ytTimer);
    const val = this.value.trim();
    ytTimer = setTimeout(() => {
        const ytId    = extractYoutubeId(val);
        const preview = document.getElementById('yt-preview');
        const iframe  = document.getElementById('yt-iframe');
        if (ytId) {
            iframe.src = 'https://www.youtube.com/embed/' + ytId;
            preview.classList.remove('hidden');
        } else {
            iframe.src = '';
            preview.classList.add('hidden');
        }
    }, 600);
});

// ── 6. Submit dengan konfirmasi SweetAlert ────────────────────────────────
document.getElementById('yearCoverForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const year   = document.getElementById('year').value.trim();
    const ytLink = document.getElementById('youtube_link').value.trim();
    const file   = coverInput.files[0];

    if (!year)
        return Swal.fire({ icon: 'warning', title: 'Perhatian!', text: 'Tahun wajib diisi.', confirmButtonColor: '#3b82f6' });
    if (year < 2000 || year > 2100)
        return Swal.fire({ icon: 'warning', title: 'Perhatian!', text: 'Tahun harus antara 2000–2100.', confirmButtonColor: '#3b82f6' });
    if (!file)
        return Swal.fire({ icon: 'warning', title: 'Perhatian!', text: 'Cover belum dipilih.', confirmButtonColor: '#3b82f6' });
    if (!ytLink)
        return Swal.fire({ icon: 'warning', title: 'Perhatian!', text: 'Link YouTube wajib diisi.', confirmButtonColor: '#3b82f6' });
    if (!extractYoutubeId(ytLink))
        return Swal.fire({ icon: 'warning', title: 'Link Tidak Valid!', text: 'Masukkan link YouTube yang valid.', confirmButtonColor: '#3b82f6' });

    Swal.fire({
        title: 'Simpan Cover?',
        html: `Cover tahun <strong>${year}</strong> akan disimpan.`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3b82f6',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Simpan!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
    }).then(result => {
        if (!result.isConfirmed) return;

        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerHTML = `<svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Menyimpan...`;

        fetch('{{ route('yearcover.store') }}', {
            method: 'POST',
            body: new FormData(document.getElementById('yearCoverForm')),
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, confirmButtonColor: '#3b82f6' })
                    .then(() => window.location.href = data.redirect);
            } else {
                btn.disabled = false;
                btn.innerHTML = `<svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> Simpan Cover`;
                const msg = data.errors ? Object.values(data.errors).flat().join('\n') : (data.message ?? 'Terjadi kesalahan.');
                Swal.fire({ icon: 'error', title: 'Gagal!', text: msg, confirmButtonColor: '#3b82f6' });
            }
        })
        .catch(() => {
            btn.disabled = false;
            btn.innerHTML = `<svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> Simpan Cover`;
            Swal.fire({ icon: 'error', title: 'Error!', text: 'Terjadi kesalahan jaringan.', confirmButtonColor: '#3b82f6' });
        });
    });
});
</script>
@endpush

@endsection
