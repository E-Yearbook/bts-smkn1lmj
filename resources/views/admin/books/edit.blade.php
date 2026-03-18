@extends('admin.layouts.app')

@section('title', 'Edit Book')
@php $page = 'books'; @endphp

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/dropzone.min.css" />
<style>
    .dropzone { border: 2px dashed #d1d5db; border-radius: 12px; background: #f9fafb; min-height: 140px; padding: 16px; transition: border-color .2s, background .2s; }
    .dropzone.dz-drag-hover { border-color: #3b82f6; background: #eff6ff; }
    .dropzone .dz-message { margin: 0; }
    .dark .dropzone { border-color: #374151; background: #111827; }
    .dropzone .dz-preview .dz-image { border-radius: 8px; background: #f3f4f6; }
    .dropzone .dz-preview .dz-image img { object-fit: contain; }
    .dropzone .dz-preview.dz-file-preview .dz-image { background: #e5e7eb; }
    .dark .dropzone .dz-preview .dz-image { background: #374151; }
    .dark .dropzone .dz-preview.dz-file-preview .dz-image { background: #374151; }
    .dropzone .dz-preview .dz-details { background: rgba(0,0,0,0.4); }
    .dropzone .dz-preview .dz-filename span, .dropzone .dz-preview .dz-size { color: #fff; }
</style>
@endpush

@section('content')

<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Edit Book</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Update book details</p>
    </div>
</div>

<form id="bookForm" action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

        {{-- LEFT: Book Info --}}
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                <h3 class="mb-4 text-base font-semibold text-gray-800 dark:text-white">Book Information</h3>
                <div class="space-y-4">

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-white">
                            Book Name <span style="color: var(--color-error-500);">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name', $book->name) }}" placeholder="Enter book name"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 focus:outline-none dark:border-gray-600 dark:bg-gray-900 dark:text-white @error('name') !border-error-500 @enderror" />
                        @error('name') <p class="mt-1 text-xs text-error-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-white">
                            Publisher <span style="color: var(--color-error-500);">*</span>
                        </label>
                        <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}" placeholder="Enter publisher name"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 focus:outline-none dark:border-gray-600 dark:bg-gray-900 dark:text-white @error('publisher') !border-error-500 @enderror" />
                        @error('publisher') <p class="mt-1 text-xs text-error-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-white">Category</label>
                        <select name="book_category_id"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 focus:outline-none dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            <option value="">— Select Category —</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('book_category_id', $book->book_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-white">Year Cover</label>
                        <select name="year_cover_id"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 focus:outline-none dark:border-gray-600 dark:bg-gray-900 dark:text-white">
                            <option value="">— Select Year —</option>
                            @foreach ($yearCovers as $yc)
                                <option value="{{ $yc->id }}" {{ old('year_cover_id', $book->year_cover_id) == $yc->id ? 'selected' : '' }}>{{ $yc->year }}</option>
                            @endforeach
                        </select>
                    </div>

            </div>
        </div>

        {{-- RIGHT: File Uploads --}}
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                <h3 class="mb-1 text-base font-semibold text-gray-800 dark:text-white">Book Cover</h3>
                <p class="mb-3 text-xs text-gray-400">Format: JPG, PNG • Max: 5MB • Leave empty to keep current</p>
                @if ($book->book_cover)
                    <div class="mb-3 flex items-center gap-3 rounded-lg bg-gray-50 p-3 dark:bg-gray-700">
                        <img src="{{ Storage::url($book->book_cover) }}" alt="Current cover" class="h-16 w-12 object-cover rounded shadow">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Current cover</p>
                    </div>
                @endif
                <div id="coverDropzone" class="dropzone rounded-xl">
                    <div class="dz-message needsclick text-center">
                        <p class="text-sm font-semibold text-gray-700 dark:text-white mb-1">Drag & Drop new image</p>
                        <p class="text-xs text-gray-400">or click to select</p>
                    </div>
                </div>
                <input type="file" name="book_cover" id="coverInput" class="hidden" />
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                <h3 class="mb-1 text-base font-semibold text-gray-800 dark:text-white">Book File (PDF)</h3>
                <p class="mb-3 text-xs text-gray-400">Format: PDF • Max: 20MB • Leave empty to keep current</p>
                @if ($book->book_path)
                    <div class="mb-3 flex items-center gap-3 rounded-lg bg-gray-50 p-3 dark:bg-gray-700">
                        <svg class="h-8 w-8 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM6 20V4h5v7h7v9H6z"/>
                        </svg>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Current PDF file exists</p>
                    </div>
                @endif
                <div id="pdfDropzone" class="dropzone rounded-xl">
                    <div class="dz-message needsclick text-center">
                        <p class="text-sm font-semibold text-gray-700 dark:text-white mb-1">Drag & Drop new PDF</p>
                        <p class="text-xs text-gray-400">or click to select</p>
                    </div>
                </div>
                <input type="file" name="book_path" id="pdfInput" class="hidden" />
            </div>
        </div>

    </div>

    <div class="mt-6 flex items-center justify-end gap-3">
        <a href="{{ route('books.index') }}"
            class="inline-flex items-center gap-2 rounded-lg bg-white px-5 py-3.5 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-inset ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700">
            Cancel
        </a>
        <button type="button" id="submitBtn"
            class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-6 py-2.5 text-sm font-medium text-white hover:bg-brand-600 transition-all shadow-theme-xs">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            Update Book
        </button>
    </div>

</form>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/dropzone.min.js"></script>
<script>
Dropzone.autoDiscover = false;
let coverFile = null, pdfFile = null;

const coverDz = new Dropzone('#coverDropzone', {
    url: '/', autoProcessQueue: false, maxFiles: 1, maxFilesize: 5,
    acceptedFiles: 'image/jpeg,image/png', addRemoveLinks: true, dictDefaultMessage: '',
    init: function () {
        this.on('addedfile', f => { if (this.files.length > 1) this.removeFile(this.files[0]); coverFile = f; });
        this.on('removedfile', () => coverFile = null);
        this.on('error', (f, msg) => { Swal.fire({ icon: 'error', title: 'Error', text: msg }); this.removeFile(f); });
    }
});

const pdfDz = new Dropzone('#pdfDropzone', {
    url: '/', autoProcessQueue: false, maxFiles: 1, maxFilesize: 20,
    acceptedFiles: 'application/pdf', addRemoveLinks: true, dictDefaultMessage: '',
    init: function () {
        this.on('addedfile', f => { if (this.files.length > 1) this.removeFile(this.files[0]); pdfFile = f; });
        this.on('removedfile', () => pdfFile = null);
        this.on('error', (f, msg) => { Swal.fire({ icon: 'error', title: 'Error', text: msg }); this.removeFile(f); });
    }
});

document.getElementById('submitBtn').addEventListener('click', function () {
    const name = document.querySelector('[name="name"]').value.trim();
    const publisher = document.querySelector('[name="publisher"]').value.trim();

    if (!name) return Swal.fire({ icon: 'warning', title: 'Attention!', text: 'Book name is required.', confirmButtonColor: '#465fff' });
    if (!publisher) return Swal.fire({ icon: 'warning', title: 'Attention!', text: 'Publisher is required.', confirmButtonColor: '#465fff' });

    Swal.fire({
        title: 'Update Book?', text: `Update book "${name}"?`, icon: 'question',
        showCancelButton: true, confirmButtonColor: '#465fff', cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, Update!', cancelButtonText: 'Cancel', reverseButtons: true,
    }).then(result => {
        if (result.isConfirmed) {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = `<svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Updating...`;

            if (coverFile) { const dt = new DataTransfer(); dt.items.add(coverFile); document.getElementById('coverInput').files = dt.files; }
            if (pdfFile)   { const dt = new DataTransfer(); dt.items.add(pdfFile);   document.getElementById('pdfInput').files   = dt.files; }

            document.getElementById('bookForm').submit();
        }
    });
});

@if($errors->any())
    Swal.fire({ icon: 'error', title: 'Validation Failed', html: `{!! implode('<br>', $errors->all()) !!}`, confirmButtonColor: '#f04438' });
@endif
</script>
@endpush

@endsection
