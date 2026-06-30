@extends('admin.layouts.app')

@section('title', 'Add Book')
@php $page = 'books'; @endphp

@push('styles')
<style>
    .dropzone { border: 2px dashed #d1d5db; border-radius: 12px; background: #f9fafb; min-height: 160px; padding: 16px; transition: all 0.2s ease; cursor: pointer; }
    .dropzone.dz-drag-hover { border-color: #3b82f6; background: #eff6ff; }
    .dropzone .dz-message { margin: 0; }
    .dropzone .dz-preview .dz-success-mark,
    .dropzone .dz-preview .dz-error-mark,
    .dropzone .dz-preview .dz-progress { display: none !important; }
    .file-preview-container { display: flex; flex-direction: column; align-items: center; gap: 10px; padding: 8px; }
    .file-preview-img { max-width: 100%; max-height: 120px; border-radius: 8px; border: 1px solid #e5e7eb; object-fit: contain; background: #fff; padding: 4px; }
    .file-name { font-size: 0.8rem; font-weight: 500; color: #1f2937; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px; text-align: center; }
    .file-meta { font-size: 0.75rem; color: #6b7280; text-align: center; }
    .dz-remove-btn { display: inline-flex; align-items: center; gap: 4px; border-radius: 8px; background: #fef2f2; padding: 6px 12px; font-size: 0.75rem; font-weight: 500; color: #b91c1c; border: none; cursor: pointer; transition: background 0.2s; }
    .dz-remove-btn:hover { background: #fee2e2; }
</style>
@endpush

@section('content')

<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900">Add Book</h1>
        <p class="mt-1 text-sm text-gray-500">Fill in the book details below</p>
    </div>
</div>

<form id="bookForm" action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        {{-- LEFT: Book Info --}}
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <h3 class="mb-4 text-base font-semibold text-gray-800">Book Information</h3>
                <div class="space-y-4">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700">
                            Book Name <span class="text-error-500">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter book name"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 focus:outline-none @error('name') !border-error-500 @enderror" />
                        @error('name') <p class="mt-1 text-xs text-error-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700">
                            Publisher <span class="text-error-500">*</span>
                        </label>
                        <input type="text" name="publisher" value="{{ old('publisher') }}" placeholder="Enter publisher name"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 focus:outline-none @error('publisher') !border-error-500 @enderror" />
                        @error('publisher') <p class="mt-1 text-xs text-error-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700">Category</label>
                        <select name="book_category_id"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 focus:outline-none">
                            <option value="">— Select Category —</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('book_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700">Year Cover</label>
                        <select name="year_cover_id"
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 focus:outline-none">
                            <option value="">— Select Year —</option>
                            @foreach ($yearCovers as $yc)
                                <option value="{{ $yc->id }}" {{ old('year_cover_id') == $yc->id ? 'selected' : '' }}>{{ $yc->year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT: File Uploads --}}
        <div class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <h3 class="mb-1 text-base font-semibold text-gray-800">Book Cover</h3>
                <p class="mb-4 text-xs text-gray-400">Format: JPG, PNG • Max: 5MB</p>
                <div id="coverDropzone" class="dropzone rounded-xl">
                    <div class="dz-message needsclick text-center py-4">
                        <svg class="mx-auto mb-2 h-8 w-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                        </svg>
                        <p class="text-sm font-semibold text-gray-700 mb-1">Drag & Drop image</p>
                        <p class="text-xs text-gray-400">or click to select</p>
                    </div>
                </div>
                <input type="file" name="book_cover" id="coverInput" class="hidden" />
                @error('book_cover') <p class="mt-1 text-xs text-error-500">{{ $message }}</p> @enderror
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <h3 class="mb-1 text-base font-semibold text-gray-800">Book File (PDF)</h3>
                <p class="mb-4 text-xs text-gray-400">Format: PDF • Max: 20MB</p>
                <div id="pdfDropzone" class="dropzone rounded-xl">
                    <div class="dz-message needsclick text-center py-4">
                        <svg class="mx-auto mb-2 h-8 w-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                        <p class="text-sm font-semibold text-gray-700 mb-1">Drag & Drop PDF</p>
                        <p class="text-xs text-gray-400">or click to select</p>
                    </div>
                </div>
                <input type="file" name="book_path" id="pdfInput" class="hidden" />
                @error('book_path') <p class="mt-1 text-xs text-error-500">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-3">
        <a href="{{ route('books.index') }}"
            class="inline-flex items-center gap-2 rounded-lg bg-white px-5 py-3.5 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-inset ring-gray-300 transition hover:bg-gray-50">
            Cancel
        </a>
        <button type="button" id="submitBtn"
            class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-6 py-2.5 text-sm font-medium text-white hover:bg-brand-600 transition-all shadow-theme-xs">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            Save Book
        </button>
    </div>
</form>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/dropzone.min.js"></script>
<script>
Dropzone.autoDiscover = false;
let coverFile = null, pdfFile = null;

const imageTemplate = `<div class="dz-preview"><div class="file-preview-container"><img class="file-preview-img" src="" alt="Preview" /><div class="file-name"></div><div class="file-meta"></div><button type="button" class="dz-remove-btn"><svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg> Remove</button></div></div>`;

const pdfTemplate = `<div class="dz-preview"><div class="file-preview-container"><div class="flex items-center justify-center w-16 h-20 rounded-lg bg-red-50 border border-red-200"><svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM6 20V4h5v7h7v9H6z"/></svg></div><div class="file-name"></div><div class="file-meta"></div><button type="button" class="dz-remove-btn"><svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg> Remove</button></div></div>`;

const coverDz = new Dropzone('#coverDropzone', {
    url: '/', autoProcessQueue: false, maxFiles: 1, maxFilesize: 5,
    acceptedFiles: 'image/jpeg,image/png', addRemoveLinks: false,
    dictDefaultMessage: '', previewTemplate: imageTemplate,
    init: function () {
        this.on('addedfile', (file) => {
            if (this.files.length > 1) this.removeFile(this.files[0]);
            coverFile = file;
            const el = file.previewElement;
            const reader = new FileReader();
            reader.onload = (e) => { el.querySelector('.file-preview-img').src = e.target.result; };
            reader.readAsDataURL(file);
            el.querySelector('.file-name').textContent = file.name;
            el.querySelector('.file-meta').textContent = (file.size / 1024).toFixed(1) + ' KB';
            el.querySelector('.dz-remove-btn').addEventListener('click', (e) => { e.preventDefault(); e.stopPropagation(); this.removeFile(file); });
        });
        this.on('removedfile', () => coverFile = null);
        this.on('error', (f, msg) => { Swal.fire({ icon: 'error', title: 'Error', text: msg }); this.removeFile(f); });
    }
});

const pdfDz = new Dropzone('#pdfDropzone', {
    url: '/', autoProcessQueue: false, maxFiles: 1, maxFilesize: 25,
    acceptedFiles: 'application/pdf', addRemoveLinks: false,
    dictDefaultMessage: '', previewTemplate: pdfTemplate,
    init: function () {
        this.on('addedfile', (file) => {
            if (this.files.length > 1) this.removeFile(this.files[0]);
            pdfFile = file;
            const el = file.previewElement;
            el.querySelector('.file-name').textContent = file.name;
            el.querySelector('.file-meta').textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB • PDF';
            el.querySelector('.dz-remove-btn').addEventListener('click', (e) => { e.preventDefault(); e.stopPropagation(); this.removeFile(file); });
        });
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
        title: 'Save Book?', text: `Add book "${name}"?`, icon: 'question',
        showCancelButton: true, confirmButtonColor: '#465fff', cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, Save!', cancelButtonText: 'Cancel', reverseButtons: true,
    }).then(result => {
        if (result.isConfirmed) {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = `<svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Saving...`;
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
