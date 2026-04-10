@extends('admin.layouts.app')

@section('title', 'Book Detail')
@php
    $page = 'books';
    $pdfUrl = $book->book_path ? Storage::url($book->book_path) : null;
    $coverUrl = $book->book_cover ? Storage::url($book->book_cover) : null;
@endphp

@push('styles')
    <style>
        @media (min-width: 1024px) {
            .book-pdf-breakout {
                margin-left: -1.5rem;
                margin-right: -1.5rem;
            }
        }
    </style>
@endpush

@section('content')
    {{-- Tambahkan x-data di sini agar variabel showModal bisa diakses oleh semua elemen di dalamnya --}}
    <div class="space-y-6" x-data="{ showModal: false }">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Book Detail</h1>
                <p class="mt-1 text-sm text-gray-500">{{ $book->name }}</p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('books.index') }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-white px-5 py-2.5 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-inset ring-gray-300 transition hover:bg-gray-50">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back
                </a>
            </div>
        </div>

        <div class="space-y-6">
            <!-- Preview PDF Section -->
            <div class="book-pdf-breakout rounded-2xl border border-gray-200 bg-white p-2 sm:p-3 lg:p-4">
                <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">Preview PDF</h3>
                        <p class="text-sm text-gray-500">
                            Dokumen tampil langsung di halaman agar lebih cepat dibaca.
                        </p>
                    </div>

                    @if ($pdfUrl)
                        <a href="{{ $pdfUrl }}" target="_blank"
                            class="inline-flex items-center gap-2 self-start rounded-lg bg-red-500 px-4 py-2 text-sm font-medium text-white transition hover:bg-red-600">
                            Buka Tab Baru
                        </a>
                    @endif
                </div>

                @if ($pdfUrl)
                    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-gray-50">
                        <iframe src="{{ $pdfUrl }}#toolbar=1&navpanes=0&scrollbar=1"
                            title="Preview PDF {{ $book->name }}" class="w-full bg-white"
                            style="height: 85vh; min-height: 800px;">
                        </iframe>
                    </div>
                @else
                    <div
                        class="flex h-[420px] items-center justify-center rounded-2xl border border-dashed border-gray-300 bg-gray-50 text-center">
                        <div class="max-w-sm space-y-2 px-6">
                            <p class="text-base font-semibold text-gray-800">PDF belum tersedia</p>
                            <p class="text-sm text-gray-500">
                                File buku belum diunggah, jadi belum ada preview yang bisa ditampilkan.
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Ringkasan Buku Section -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6">
                <div class="mb-5">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-gray-400">
                        Ringkasan Buku
                    </p>
                    <h2 class="mt-2 text-lg font-semibold text-gray-900">{{ $book->name }}</h2>
                </div>

                <dl class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3 xl:gap-x-8">
                    <div class="rounded-xl bg-gray-50 px-4 py-3">
                        <dt class="text-sm text-gray-500">Publisher</dt>
                        <dd class="mt-1 text-sm font-semibold text-gray-900">
                            {{ $book->publisher ?: 'Belum diisi' }}
                        </dd>
                    </div>
                    <div class="rounded-xl bg-gray-50 px-4 py-3">
                        <dt class="text-sm text-gray-500">Category</dt>
                        <dd class="mt-1 text-sm font-semibold text-gray-900">
                            {{ $book->category->name ?? '-' }}
                        </dd>
                    </div>
                    <div class="rounded-xl bg-gray-50 px-4 py-3">
                        <dt class="text-sm text-gray-500">Year Cover</dt>
                        <dd class="mt-1 text-sm font-semibold text-gray-900">
                            {{ $book->yearCover->year ?? '-' }}
                        </dd>
                    </div>
                    <div class="rounded-xl bg-gray-50 px-4 py-3">
                        <dt class="text-sm text-gray-500">Uploader</dt>
                        <dd class="mt-1 text-sm font-semibold text-gray-900">
                            {{ $book->user->name ?? '-' }}
                        </dd>
                    </div>
                    <div class="rounded-xl bg-gray-50 px-4 py-3">
                        <dt class="text-sm text-gray-500">Added</dt>
                        <dd class="mt-1 text-sm font-semibold text-gray-900">
                            {{ $book->created_at->format('d M Y, H:i') }}
                        </dd>
                    </div>
                    <div class="rounded-xl bg-gray-50 px-4 py-3">
                        <dt class="text-sm text-gray-500 mb-1">Cover Buku</dt>
                        <dd class="mt-1">
                            @if ($coverUrl)
                                <div class="flex items-center gap-3">
                                    <img src="{{ $coverUrl }}" alt="Cover"
                                        class="h-10 w-10 rounded-md border border-gray-200 object-cover shadow-sm bg-white cursor-pointer"
                                        @click="showModal = true">
                                    <button type="button" @click="showModal = true"
                                        class="inline-flex items-center gap-1.5 rounded bg-white px-3 py-1.5 text-xs font-medium text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 transition hover:bg-gray-50">
                                        <svg class="h-3.5 w-3.5 text-gray-500" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat
                                    </button>
                                </div>
                            @else
                                <span class="text-sm font-medium text-gray-900">-</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Modal Preview Cover -->
        <template x-if="showModal">
            <div class="fixed inset-0 z-[99] flex items-center justify-center overflow-y-auto px-4 py-6"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <!-- Overlay -->
                <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm" @click="showModal = false"></div>

                <!-- Modal Content -->
                <div class="relative max-w-2xl w-full rounded-2xl bg-white p-4 shadow-2xl" @click.stop
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="scale-95 opacity-0" x-transition:enter-end="scale-100 opacity-100">
                    <div class="flex items-center justify-between mb-4 border-b pb-3">
                        <h3 class="text-lg font-semibold text-gray-900">Cover Preview</h3>
                        <button @click="showModal = false" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex justify-center bg-gray-50 rounded-lg overflow-hidden border border-gray-100">
                        <img src="{{ $coverUrl }}" alt="Full Cover" class="w-auto object-contain"
                            style="width: 70vh">
                    </div>
                    <div class="mt-5 flex justify-end">
                        <button @click="showModal = false"
                            class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>
@endsection
