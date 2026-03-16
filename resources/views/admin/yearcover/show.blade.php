@extends('admin.layouts.app')

@section('title', 'Detail Cover ' . $yearcover->year)

@php $page = 'yearcover'; @endphp

@section('content')

@php
    function getYoutubeIdDetail(string $url): string
    {
        preg_match(
            '/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
            $url,
            $matches,
        );
        return $matches[1] ?? '';
    }
    $ytId = getYoutubeIdDetail($yearcover->youtube_link);
@endphp

{{-- Header --}}
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Detail Cover {{ $yearcover->year }}</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Informasi lengkap cover dan video tahunan</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('yearcover.edit', $yearcover->id) }}"
           class="inline-flex items-center gap-2 rounded-xl bg-amber-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-amber-600 transition-colors">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edit
        </a>
        <a href="{{ route('yearcover') }}"
           class="inline-flex items-center gap-2 rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>
</div>

<div class="grid grid-cols-1 gap-6 lg:grid-cols-5">

    {{-- LEFT: Cover Image --}}
    <div class="lg:col-span-2 space-y-4">
        <div class="rounded-2xl border border-gray-200 bg-white overflow-hidden dark:border-gray-700 dark:bg-gray-800">
            <div class="bg-gradient-to-br from-blue-50 to-gray-100 dark:from-gray-700 dark:to-gray-900 p-6 flex items-center justify-center" style="min-height: 280px;">
                <img src="{{ Storage::url($yearcover->cover_path) }}"
                     alt="Cover {{ $yearcover->year }}"
                     class="max-h-64 w-auto object-contain rounded-lg shadow-md">
            </div>
            <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Tahun</span>
                    <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $yearcover->year }}</span>
                </div>
                <div class="mt-2 flex items-center justify-between">
                    <span class="text-xs text-gray-400">Ditambahkan</span>
                    <span class="text-xs text-gray-600 dark:text-gray-400">{{ $yearcover->created_at->format('d M Y') }}</span>
                </div>
                <div class="mt-1 flex items-center justify-between">
                    <span class="text-xs text-gray-400">Diperbarui</span>
                    <span class="text-xs text-gray-600 dark:text-gray-400">{{ $yearcover->updated_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex gap-3">
            <a href="{{ route('yearcover.edit', $yearcover->id) }}"
               class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl bg-amber-500 py-2.5 text-sm font-medium text-white hover:bg-amber-600 transition-colors">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Cover
            </a>
            <button onclick="confirmDelete({{ $yearcover->id }}, {{ $yearcover->year }})"
                    class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl bg-red-500 py-2.5 text-sm font-medium text-white hover:bg-red-600 transition-colors border-0 cursor-pointer">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Hapus
            </button>
        </div>
    </div>

    {{-- RIGHT: YouTube Video --}}
    <div class="lg:col-span-3 space-y-4">
        <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
            <div class="mb-4 flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-50 dark:bg-red-900/30">
                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-gray-800 dark:text-white">Video Tahun {{ $yearcover->year }}</h3>
                    <p class="text-xs text-gray-400">Klik play untuk menonton video</p>
                </div>
            </div>

            @if($ytId)
            <div class="overflow-hidden rounded-xl bg-black shadow-lg">
                <iframe
                    src="https://www.youtube.com/embed/{{ $ytId }}"
                    width="100%"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen
                    style="aspect-ratio: 16/9; display: block;">
                </iframe>
            </div>

            {{-- YouTube Thumbnail & Link --}}
            <div class="mt-4 flex items-center gap-3 rounded-xl bg-gray-50 p-3 dark:bg-gray-900">
                <img src="https://img.youtube.com/vi/{{ $ytId }}/mqdefault.jpg"
                     alt="Thumbnail"
                     class="h-14 w-24 rounded-lg object-cover flex-shrink-0">
                <div class="min-w-0">
                    <p class="text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Link YouTube:</p>
                    <a href="{{ $yearcover->youtube_link }}" target="_blank"
                       class="text-xs text-blue-500 hover:text-blue-600 hover:underline break-all">
                        {{ $yearcover->youtube_link }}
                    </a>
                </div>
                <a href="{{ $yearcover->youtube_link }}" target="_blank"
                   class="ml-auto flex-shrink-0 inline-flex items-center gap-1.5 rounded-lg bg-red-500 px-3 py-2 text-xs font-medium text-white hover:bg-red-600 transition-colors">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                    Buka YouTube
                </a>
            </div>
            @else
            <div class="flex flex-col items-center justify-center py-12 text-center rounded-xl bg-gray-50 dark:bg-gray-900">
                <svg class="h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/>
                </svg>
                <p class="text-sm text-gray-400">Link YouTube tidak valid</p>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Hidden Delete Form --}}
<form id="deleteForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id, year) {
        Swal.fire({
            title: 'Hapus Cover?',
            html: `Cover tahun <strong>${year}</strong> akan dihapus permanen.<br>Aksi ini tidak dapat dibatalkan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            focusCancel: true,
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('deleteForm');
                form.action = `/yearcover/${id}`;
                form.submit();
            }
        });
    }
</script>
@endpush

@endsection