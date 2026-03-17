@extends('admin.layouts.app')

@section('title', 'Add Year Cover')

@php $page = 'yearcover'; @endphp

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/dropzone.min.css" />
<style>
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

    .dropzone {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        background: #f9fafb;
        min-height: 180px;
        padding: 20px;
        transition: border-color 0.2s ease, background 0.2s ease;
    }
    .dropzone.dz-drag-hover { border-color: #3b82f6; background: #eff6ff; }
    .dropzone .dz-message { margin: 0; }
    .dark .dropzone { border-color: #374151; background: #111827; }
    .dark .dropzone.dz-drag-hover { border-color: #3b82f6; background: #1e3a5f; }
</style>
@endpush

@section('content')

<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Add Cover</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage school annual covers and videos</p>
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
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-white">
                            Year <span style="color: var(--color-error-500);">*</span>
                        </label>
                        <input type="number" name="year" id="year"
                            value="{{ old('year') }}" min="2000" max="2100"
                            placeholder="Contoh: 2024"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 focus:outline-none dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-500" />
                    </div>

                    <div class="mt-3">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-white">
                            YouTube Link <span style="color: var(--color-error-500);">*</span>
                        </label>
                        <input type="text" name="youtube_link" id="youtube_link"
                            value="{{ old('youtube_link') }}"
                            placeholder="https://youtu.be/xxxxxx"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 focus:outline-none dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-500" />
                        <p class="mt-1 text-xs text-gray-400">Video preview appears automatically after entering the link.</p>
                    </div>

                </div>
            </div>

            {{-- YouTube Preview --}}
            <div id="yt-preview" class="hidden rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-700 dark:bg-gray-800">
                <h3 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">YouTube Video Preview</h3>
                <div class="overflow-hidden rounded-xl bg-black">
                    <iframe id="yt-iframe" src="" width="100%" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen style="aspect-ratio:16/9; display:block;"></iframe>
                </div>
            </div>
        </div>

        {{-- RIGHT: Upload Cover --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
            <h3 class="mb-1 text-base font-semibold text-gray-800 dark:text-white">Book Cover</h3>
            <p class="mb-4 text-xs text-gray-400">Format: JPG, PNG • Maks: 5MB</p>

            {{-- Dropzone --}}
            <div id="coverDropzone" class="dropzone rounded-xl">
                <div class="dz-message needsclick">
                    <div class="mb-4 flex justify-center">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-50 dark:bg-blue-900/30">
                            <svg class="h-7 w-7 text-blue-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-white mb-1">Drag & Drop file</p>
                    <p class="text-xs text-gray-400 dark:text-gray-300">or click to select a file</p>
                </div>
            </div>
            <input type="file" name="cover" id="coverInput" class="hidden" />

        </div>
    </div>{{-- end grid --}}

    {{-- Tombol Submit — di dalam form, di luar grid --}}
    <div class="mt-6 flex items-center justify-end gap-3">
        <a href="{{ route('yearcover') }}"
           class="inline-flex items-center gap-2 rounded-lg rounded-xl bg-white px-5 py-3.5 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-inset ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]">
            Cancel
        </a>
        <button type="submit" id="submitBtn"
            class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-6 py-2.5 text-sm font-medium text-white hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 transition-all shadow-theme-xs">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            Save Cover
        </button>
    </div>

</form>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/dropzone.min.js"></script>
<script>
Dropzone.autoDiscover = false;

let droppedFile = null;

const myDropzone = new Dropzone('#coverDropzone', {
    url: '/',
    autoProcessQueue: false,
    maxFiles: 1,
    maxFilesize: 5,
    acceptedFiles: 'image/jpeg,image/png',
    addRemoveLinks: true,
    dictDefaultMessage: '',
    init: function () {
        this.on('addedfile', function (file) {
            if (this.files.length > 1) this.removeFile(this.files[0]);
            droppedFile = file;
        });
        this.on('removedfile', function () {
            droppedFile = null;
        });
        this.on('error', function (file, message) {
            Swal.fire({ icon: 'error', title: 'Oops!', text: message, confirmButtonColor: '#465fff' });
            this.removeFile(file);
        });
    }
});

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

document.getElementById('yearCoverForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const year   = document.getElementById('year').value.trim();
    const ytLink = document.getElementById('youtube_link').value.trim();

    if (!year)
        return Swal.fire({ icon: 'warning', title: 'Attention!', text: 'Year is required.', confirmButtonColor: '#465fff' });
    if (year < 2000 || year > 2100)
        return Swal.fire({ icon: 'warning', title: 'Attention!', text: 'Year must be between 2000–2100.', confirmButtonColor: '#465fff' });
    if (!droppedFile)
        return Swal.fire({ icon: 'warning', title: 'Attention!', text: 'Cover not selected.', confirmButtonColor: '#465fff' });
    if (!ytLink)
        return Swal.fire({ icon: 'warning', title: 'Attention!', text: 'YouTube link is required.', confirmButtonColor: '#465fff' });
    if (!extractYoutubeId(ytLink))
        return Swal.fire({ icon: 'warning', title: 'Invalid Link!', text: 'Enter a valid YouTube link.', confirmButtonColor: '#465fff' });

    Swal.fire({
        title: 'Save Cover?',
        html: `Year <strong>${year}</strong> cover will be saved.`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#465fff',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, Save!',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
    }).then(result => {
        if (result.isConfirmed) {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = `<svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Saving...`;

            const dt = new DataTransfer();
            dt.items.add(droppedFile);
            document.getElementById('coverInput').files = dt.files;

            document.getElementById('yearCoverForm').submit();
        }
    });
});
</script>
@endpush

@endsection
