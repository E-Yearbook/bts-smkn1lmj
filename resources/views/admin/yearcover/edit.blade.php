@extends('admin.layouts.app')

@section('title', 'Edit Year Cover')
@php $page = 'yearcover'; @endphp

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/dropzone.min.css" />
    <style>
        .dropzone {
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            background: #f9fafb;
            min-height: 200px;
            padding: 20px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .dropzone.dz-drag-hover {
            border-color: #3b82f6;
            background: #eff6ff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            transform: scale(1.01);
        }

        .dropzone .dz-message {
            margin: 0;
        }

        .dropzone .dz-preview {
            margin: 0;
            position: relative;
        }

        .dropzone .dz-preview.dz-file-preview {
            background: transparent;
            border: none;
            padding: 0;
            margin: 0;
        }

        .dropzone .dz-details {
            display: none;
        }

        .dropzone .dz-remove {
            position: absolute;
            top: 8px;
            right: 8px;
            opacity: 0;
            transition: opacity 0.2s ease;
            z-index: 10;
        }

        .dropzone .dz-preview:hover .dz-remove {
            opacity: 1;
        }

        .file-preview-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            padding: 12px;
        }

        .file-preview-img {
            max-width: 100%;
            max-height: 140px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            object-fit: contain;
            background: white;
            padding: 4px;
        }

        .file-info {
            text-align: center;
            width: 100%;
        }

        .file-name {
            font-size: 0.875rem;
            font-weight: 500;
            color: #1f2937;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 4px;
        }

        .file-meta {
            font-size: 0.75rem;
            color: #6b7280;
            display: flex;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .progress-bar-wrapper {
            width: 100%;
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 8px;
            display: none;
        }

        .progress-bar-wrapper.show {
            display: block;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
            width: 0%;
            transition: width 0.3s ease;
        }
    </style>
@endpush

@section('content')

    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Edit Year Cover {{ $yearcover->year }}</h1>
            <p class="mt-1 text-sm text-gray-500">Update school annual covers and videos</p>
        </div>
    </div>

    <form id="editForm" action="{{ route('yearcover.update', $yearcover->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="space-y-6">
                <div class="rounded-2xl border border-gray-200 bg-white p-6">
                    <h3 class="mb-4 text-base font-semibold text-gray-800">Cover Information</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                Year <span class="text-error-500">*</span>
                            </label>
                            <input type="number" name="year" id="year" value="{{ old('year', $yearcover->year) }}"
                                min="2000" max="2100"
                                class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 focus:outline-none" />
                        </div>
                        <div class="mt-3">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                Video Sambutan
                            </label>
                            <input type="text" name="title_video_sambutan" id="title_video_sambutan" value="{{ old('title_video_sambutan', $yearcover->title_video_sambutan) }}" placeholder="Judul Video Sambutan"
                                class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 focus:outline-none mb-2" />
                            <textarea name="youtube_link_sambutan" id="youtube_link_sambutan" rows="2"
                                placeholder="https://youtu.be/xxxxxx"
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 focus:outline-none">{{ old('youtube_link_sambutan', $yearcover->youtube_link_sambutan) }}</textarea>
                        </div>
                        <div class="mt-3">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">
                                Video Angkatan
                            </label>
                            <input type="text" name="title_video_angkatan" id="title_video_angkatan" value="{{ old('title_video_angkatan', $yearcover->title_video_angkatan) }}" placeholder="Judul Video Angkatan"
                                class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 focus:outline-none mb-2" />
                            <textarea name="youtube_link_angkatan" id="youtube_link_angkatan" rows="2"
                                placeholder="https://youtu.be/yyyyyy"
                                class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 focus:outline-none">{{ old('youtube_link_angkatan', $yearcover->youtube_link_angkatan) }}</textarea>
                            <p class="mt-1 text-xs text-gray-400">Video preview appears automatically after entering the
                                link.</p>
                        </div>
                    </div>
                </div>

                <div id="yt-preview"
                    class="{{ ($yearcover->youtube_link_sambutan || $yearcover->youtube_link_angkatan) ? '' : 'hidden' }} rounded-2xl border border-gray-200 bg-white p-5">
                    <h3 class="mb-3 text-sm font-semibold text-gray-700">YouTube Video Preview</h3>
                    <div id="yt-iframe-container" class="overflow-hidden rounded-xl bg-black flex flex-col gap-2">
                        @php
                            $allLinks = $yearcover->youtube_link_sambutan . ',' . $yearcover->youtube_link_angkatan;
                            preg_match_all(
                                '/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
                                $allLinks,
                                $matches,
                            );
                            $ytIds = array_unique($matches[1] ?? []);
                        @endphp
                        @foreach ($ytIds as $ytId)
                            <iframe src="https://www.youtube.com/embed/{{ $ytId }}" width="100%" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen referrerpolicy="strict-origin-when-cross-origin "class="block"
                                style="aspect-ratio:16/9;"></iframe>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <h3 class="mb-1 text-base font-semibold text-gray-800">Book Cover</h3>
                <p class="mb-4 text-xs text-gray-400">Format: JPG, PNG • Maks: 5MB</p>

                <div class="mb-4 rounded-xl border border-gray-200 bg-gray-50 p-3">
                    <p class="mb-2 text-xs font-medium text-gray-500">Current Cover:</p>
                    <img src="{{ Storage::url($yearcover->cover_path) }}" alt="Current Cover"
                        class="h-28 w-full object-contain rounded-lg">
                </div>

                <input type="file" name="cover" id="coverInput" accept="image/jpeg,image/png" class="hidden" />

                <div id="coverDropzone" class="dropzone rounded-xl">
                    <div class="dz-message needsclick">
                        <div class="mb-4 flex justify-center">
                            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-50">
                                <svg class="h-7 w-7 text-blue-500" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-gray-700 mb-1">Drag & Drop new file</p>
                        <p class="text-xs text-gray-400">or click to select a replacement file</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-3">
            <a href="{{ route('yearcover') }}"
                class="inline-flex items-center gap-2 rounded-lg bg-white px-5 py-3.5 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-inset ring-gray-300 transition hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" id="submitBtn"
                class="inline-flex items-center gap-2 rounded-lg bg-warning-500 px-6 py-2.5 text-sm font-medium text-white hover:bg-warning-600 focus:outline-none focus:ring-2 focus:ring-warning-500 focus:ring-offset-2 transition-all shadow-theme-xs">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                Update Cover
            </button>
        </div>
    </form>

    @push('scripts')
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
                addRemoveLinks: false,
                dictDefaultMessage: '',
                previewTemplate: `<div class="dz-preview dz-file-preview"><div class="file-preview-container"><img class="file-preview-img dz-image" src="" alt="Preview" /><div class="file-info"><div class="file-name" title="">File Name</div><div class="file-meta"><span class="file-size"></span><span class="file-type"></span></div></div><div class="progress-bar-wrapper"><div class="progress-bar dz-upload" style="width: 0%"></div></div><button class="dz-remove mt-2 inline-flex items-center gap-1.5 rounded-lg bg-red-50 px-3 py-2 text-xs font-medium text-red-700 hover:bg-red-100 transition"><svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>Remove</button></div></div>`,
                init: function() {
                    this.on('addedfile', function(file) {
                        if (this.files.length > 1) this.removeFile(this.files[0]);
                        droppedFile = file;
                        const preview = file.previewElement;
                        const reader = new FileReader();
                        reader.onload = () => {
                            preview.querySelector('.file-preview-img').src = reader.result;
                            preview.querySelector('.file-name').textContent = file.name;
                            preview.querySelector('.file-name').title = file.name;
                            preview.querySelector('.file-size').textContent = (file.size / 1024)
                                .toFixed(2) + ' KB';
                            preview.querySelector('.file-type').textContent = file.type.split('/')[1]
                                .toUpperCase();
                        };
                        if (file.type.startsWith('image/')) reader.readAsDataURL(file);
                    });
                    this.on('removedfile', () => droppedFile = null);
                    this.on('error', (file, message) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: message,
                            confirmButtonColor: '#465fff'
                        });
                        this.removeFile(file);
                    });
                    this.on('uploadprogress', (file, progress) => {
                        if (file.previewElement) {
                            file.previewElement.querySelector('.progress-bar-wrapper').classList.add(
                                'show');
                            file.previewElement.querySelector('.progress-bar').style.width = progress + '%';
                        }
                    });
                    this.on('addedfile', (file) => {
                        const removeBtn = file.previewElement.querySelector('.dz-remove');
                        if (removeBtn) removeBtn.addEventListener('click', (e) => {
                            e.preventDefault();
                            e.stopPropagation();
                            this.removeFile(file);
                        });
                    });
                }
            });

            function extractYoutubeIds(text) {
                const ids = [];
                // Regex for direct URLs
                const urlRegex = /(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/g;
                // Regex for iframe src
                const iframeRegex = /src=["'](?:https?:\/\/)?(?:www\.)?youtube\.com\/embed\/([a-zA-Z0-9_-]{11})["']/g;

                let match;
                // Extract from URLs
                while((match = urlRegex.exec(text)) !== null) {
                    if(!ids.includes(match[1])) ids.push(match[1]);
                }
                // Extract from iframe tags
                while((match = iframeRegex.exec(text)) !== null) {
                    if(!ids.includes(match[1])) ids.push(match[1]);
                }
                return ids;
            }

            let ytTimerSambutan, ytTimerAngkatan;

            function updatePreview(fieldId, containerId) {
                const sambutanVal = document.getElementById('youtube_link_sambutan').value.trim();
                const angkatanVal = document.getElementById('youtube_link_angkatan').value.trim();
                const allText = sambutanVal + '\n' + angkatanVal;
                const ytIds = extractYoutubeIds(allText);
                const preview = document.getElementById('yt-preview');
                const container = document.getElementById(containerId);
                container.innerHTML = '';
                if (ytIds.length > 0) {
                    ytIds.forEach(id => {
                        const iframe = document.createElement('iframe');
                        iframe.src = 'https://www.youtube.com/embed/' + id;
                        iframe.width = '100%';
                        iframe.frameBorder = '0';
                        iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
                        iframe.allowFullscreen = true;
                        iframe.className = 'block';
                        iframe.style.aspectRatio = '16/9';
                        iframe.setAttribute('referrerpolicy', 'strict-origin-when-cross-origin');
                        container.appendChild(iframe);
                    });
                    preview.classList.remove('hidden');
                } else {
                    preview.classList.add('hidden');
                }
            }

            document.getElementById('youtube_link_sambutan').addEventListener('input', function () {
                clearTimeout(ytTimerSambutan);
                ytTimerSambutan = setTimeout(() => updatePreview('youtube_link_sambutan', 'yt-iframe-container'), 600);
            });

            document.getElementById('youtube_link_angkatan').addEventListener('input', function () {
                clearTimeout(ytTimerAngkatan);
                ytTimerAngkatan = setTimeout(() => updatePreview('youtube_link_angkatan', 'yt-iframe-container'), 600);
            });

            document.getElementById('editForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const year = document.getElementById('year').value.trim();
                const ytLinkSambutan = document.getElementById('youtube_link_sambutan').value.trim();
                const ytLinkAngkatan = document.getElementById('youtube_link_angkatan').value.trim();
                const extractedYtIdsSambutan = extractYoutubeIds(ytLinkSambutan);
                const extractedYtIdsAngkatan = extractYoutubeIds(ytLinkAngkatan);
                if (!year) return Swal.fire({
                    icon: 'warning',
                    title: 'Attention!',
                    text: 'Year is required.',
                    confirmButtonColor: '#465fff'
                });
                if (year < 2000 || year > 2100) return Swal.fire({
                    icon: 'warning',
                    title: 'Attention!',
                    text: 'Year must be between 2000 – 2100.',
                    confirmButtonColor: '#465fff'
                });
                if (!ytLinkSambutan && !ytLinkAngkatan) return Swal.fire({
                    icon: 'warning',
                    title: 'Attention!',
                    text: 'At least one YouTube link is required.',
                    confirmButtonColor: '#465fff'
                });
                if (ytLinkSambutan && extractedYtIdsSambutan.length === 0) return Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Link!',
                    text: 'Enter valid YouTube links for Sambutan.',
                    confirmButtonColor: '#465fff'
                });
                if (ytLinkAngkatan && extractedYtIdsAngkatan.length === 0) return Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Link!',
                    text: 'Enter valid YouTube links for Angkatan.',
                    confirmButtonColor: '#465fff'
                });

                Swal.fire({
                    title: 'Update Cover?',
                    html: `Year <strong>${year}</strong> cover will be updated.`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#f79009',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, Update!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true,
                }).then(result => {
                    if (result.isConfirmed) {
                        const btn = document.getElementById('submitBtn');
                        btn.disabled = true;
                        btn.innerHTML =
                            `<svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Updating...`;
                        if (droppedFile) {
                            const dt = new DataTransfer();
                            dt.items.add(droppedFile);
                            document.getElementById('coverInput').files = dt.files;
                        }
                        document.getElementById('editForm').submit();
                    }
                });
            });
        </script>
    @endpush

@endsection
