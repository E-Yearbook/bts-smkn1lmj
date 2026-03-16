@extends('admin.layouts.app')

@section('title', 'Edit Year Cover')

@php $page = 'yearcover'; @endphp

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@6/dist/dropzone.css" />
<style>
    .dropzone {
        border: 2px dashed #d1d5db !important;
        border-radius: 12px !important;
        background: #f9fafb !important;
        min-height: 160px !important;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: border-color 0.2s, background 0.2s;
        cursor: pointer;
    }
    .dropzone:hover, .dropzone.dz-drag-hover {
        border-color: #3b82f6 !important;
        background: #eff6ff !important;
    }
    .dropzone .dz-message { margin: 0 !important; }
    .dropzone .dz-preview .dz-image { border-radius: 8px; }
    .dark .dropzone { border-color: #374151 !important; background: #111827 !important; }
    .dark .dropzone:hover { border-color: #3b82f6 !important; background: #1e3a5f !important; }
</style>
@endpush

@section('content')

<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Edit Cover {{ $yearcover->year }}</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Perbarui cover dan video tahunan sekolah</p>
    </div>
    <a href="{{ route('yearcover') }}"
       class="inline-flex items-center gap-2 rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali
    </a>
</div>

<form id="editForm" action="{{ route('yearcover.update', $yearcover->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

        {{-- LEFT --}}
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white">Informasi Cover</h3>
                <div class="space-y-4">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tahun <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="year" id="year"
                            value="{{ old('year', $yearcover->year) }}"
                            min="2000" max="2100"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:outline-none dark:border-gray-600 dark:bg-gray-900 dark:text-white"/>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Link YouTube <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="youtube_link" id="youtube_link"
                            value="{{ old('youtube_link', $yearcover->youtube_link) }}"
                            placeholder="https://youtu.be/xxxxxx"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:outline-none dark:border-gray-600 dark:bg-gray-900 dark:text-white"/>
                    </div>
                </div>
            </div>

            {{-- YouTube Preview --}}
            <div id="yt-preview" class="{{ $yearcover->youtube_link ? '' : 'hidden' }} rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-700 dark:bg-gray-800">
                <h3 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">Preview Video YouTube</h3>
                <div class="overflow-hidden rounded-xl bg-black">
                    <iframe id="yt-iframe"
                        src="{{ $yearcover->youtube_link ? 'https://www.youtube.com/embed/' . preg_replace('/.*(?:youtu\.be\/|v=)([a-zA-Z0-9_-]{11}).*/','$1',$yearcover->youtube_link) : '' }}"
                        width="100%" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen style="aspect-ratio:16/9;"></iframe>
                </div>
            </div>
        </div>

        {{-- RIGHT --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-1 text-base font-semibold text-gray-800 dark:text-white">Cover Buku</h3>
            <p class="mb-4 text-xs text-gray-400">Kosongkan jika tidak ingin mengganti cover. Format: JPG, PNG • Maks: 5MB</p>

            {{-- Current Cover --}}
            <div class="mb-4 rounded-xl border border-gray-200 bg-gray-50 p-3 dark:border-gray-700 dark:bg-gray-900">
                <p class="mb-2 text-xs font-medium text-gray-500 dark:text-gray-400">Cover Saat Ini:</p>
                <img src="{{ Storage::url($yearcover->cover_path) }}" alt="Current Cover"
                     class="h-28 w-full object-contain rounded-lg">
            </div>

            <div class="dropzone" id="coverDropzone">
                <div class="dz-message text-center px-4">
                    <div class="mb-3 flex justify-center">
                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-blue-50 dark:bg-blue-900/30">
                            <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                            </svg>
                        </div>
                    </div>
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Drag & Drop file baru</h4>
                    <p class="text-xs text-gray-400 mb-3">atau klik untuk memilih file pengganti</p>
                    <span class="inline-block rounded-lg bg-blue-500 px-3 py-1.5 text-xs font-medium text-white">Browse File</span>
                </div>
            </div>

            <input type="file" name="cover" id="coverInput" accept=".jpg,.jpeg,.png" class="hidden"/>

            <div id="fileInfo" class="hidden mt-3 flex items-center gap-3 rounded-lg bg-green-50 border border-green-200 p-3 dark:bg-green-900/20 dark:border-green-700">
                <svg class="h-5 w-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="min-w-0">
                    <p class="text-xs font-medium text-green-700 truncate" id="fileName"></p>
                    <p class="text-xs text-green-500" id="fileSize"></p>
                </div>
                <button type="button" onclick="removeFile()" class="ml-auto text-green-400 hover:text-red-500">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-3">
        <a href="{{ route('yearcover') }}"
           class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
            Batal
        </a>
        <button type="submit" id="submitBtn"
            class="inline-flex items-center gap-2 rounded-lg bg-amber-500 px-6 py-2.5 text-sm font-medium text-white hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 transition-all">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            Update Cover
        </button>
    </div>
</form>

@push('scripts')
<script src="https://unpkg.com/dropzone@6/dist/dropzone.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Dropzone.autoDiscover = false;

    const dz = new Dropzone('#coverDropzone', {
        url: '/',
        autoProcessQueue: false,
        maxFiles: 1,
        maxFilesize: 5,
        acceptedFiles: 'image/jpeg,image/png',
        addRemoveLinks: false,
        init: function () {
            this.on('addedfile', function (file) {
                const allowed = ['image/jpeg', 'image/png'];
                if (!allowed.includes(file.type)) {
                    this.removeFile(file);
                    return Swal.fire({ icon: 'error', title: 'Format Tidak Valid!', text: 'Hanya JPG dan PNG.', confirmButtonColor: '#3b82f6' });
                }
                if (file.size > 5 * 1024 * 1024) {
                    this.removeFile(file);
                    return Swal.fire({ icon: 'error', title: 'File Terlalu Besar!', text: 'Maksimal 5MB.', confirmButtonColor: '#3b82f6' });
                }
                if (this.files.length > 1) this.removeFile(this.files[0]);

                const dt = new DataTransfer();
                dt.items.add(file);
                document.getElementById('coverInput').files = dt.files;
                document.getElementById('fileName').textContent = file.name;
                document.getElementById('fileSize').textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
                document.getElementById('fileInfo').classList.remove('hidden');
            });
            this.on('removedfile', function () {
                document.getElementById('coverInput').value = '';
                document.getElementById('fileInfo').classList.add('hidden');
            });
        }
    });

    function removeFile() {
        dz.removeAllFiles();
        document.getElementById('coverInput').value = '';
        document.getElementById('fileInfo').classList.add('hidden');
    }

    function extractYoutubeId(url) {
        const match = url.match(/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/);
        return match ? match[1] : null;
    }

    let ytDebounce;
    document.getElementById('youtube_link').addEventListener('input', function () {
        clearTimeout(ytDebounce);
        const val = this.value.trim();
        ytDebounce = setTimeout(() => {
            const ytId = extractYoutubeId(val);
            const preview = document.getElementById('yt-preview');
            const iframe = document.getElementById('yt-iframe');
            if (ytId) {
                iframe.src = `https://www.youtube.com/embed/${ytId}`;
                preview.classList.remove('hidden');
            } else {
                iframe.src = '';
                preview.classList.add('hidden');
            }
        }, 600);
    });

    document.getElementById('editForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const year   = document.getElementById('year').value.trim();
        const ytLink = document.getElementById('youtube_link').value.trim();

        if (!year) return Swal.fire({ icon: 'warning', title: 'Perhatian!', text: 'Tahun wajib diisi.', confirmButtonColor: '#3b82f6' });
        if (year < 2000 || year > 2100) return Swal.fire({ icon: 'warning', title: 'Perhatian!', text: 'Tahun harus antara 2000 – 2100.', confirmButtonColor: '#3b82f6' });
        if (!ytLink) return Swal.fire({ icon: 'warning', title: 'Perhatian!', text: 'Link YouTube wajib diisi.', confirmButtonColor: '#3b82f6' });
        if (!extractYoutubeId(ytLink)) return Swal.fire({ icon: 'warning', title: 'Link Tidak Valid!', text: 'Masukkan link YouTube yang valid.', confirmButtonColor: '#3b82f6' });

        Swal.fire({
            title: 'Update Cover?',
            html: `Cover tahun <strong>${year}</strong> akan diperbarui.`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#f59e0b',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Update!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
        }).then(result => {
            if (result.isConfirmed) {
                const btn = document.getElementById('submitBtn');
                btn.disabled = true;
                btn.innerHTML = `<svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Memperbarui...`;

                const formData = new FormData(this);

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, confirmButtonColor: '#3b82f6' })
                            .then(() => window.location.href = data.redirect);
                    } else {
                        btn.disabled = false;
                        btn.innerHTML = `<svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> Update Cover`;
                        const errors = data.errors ? Object.values(data.errors).flat().join('\n') : data.message;
                        Swal.fire({ icon: 'error', title: 'Gagal!', text: errors, confirmButtonColor: '#3b82f6' });
                    }
                })
                .catch(() => {
                    btn.disabled = false;
                    Swal.fire({ icon: 'error', title: 'Error!', text: 'Terjadi kesalahan.', confirmButtonColor: '#3b82f6' });
                });
            }
        }.bind(this));
    });
</script>
@endpush

@endsection