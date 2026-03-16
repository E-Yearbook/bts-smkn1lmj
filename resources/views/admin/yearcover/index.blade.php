@extends('admin.layouts.app')

@section('title', 'Year Cover')

@php $page = 'yearcover'; @endphp

@section('content')

    @php
        function getYoutubeId(string $url): string
        {
            preg_match(
                '/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
                $url,
                $matches,
            );
            return $matches[1] ?? '';
        }
    @endphp

    {{-- Header --}}
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Year Cover</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola cover dan video tahunan sekolah</p>
        </div>
        <a href="{{ route('yearcover.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-blue-700 active:scale-95 transition-all duration-150 bg-brand-500 shadow-theme-xs hover:bg-brand-600">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Cover
        </a>
    </div>

    {{-- Empty State --}}
    @if ($covers->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <svg class="h-16 w-16 text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor"
                stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5M21 3.75H3M6.75 7.5h.008v.008H6.75V7.5z" />
            </svg>
            <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Belum ada cover</h3>
            <p class="mt-1 text-sm text-gray-400">Klik "Tambah Cover" untuk menambahkan cover tahunan pertama.</p>
        </div>
    @else
        {{-- Grid Cards --}}
        <div class="grid gap-4" style="grid-template-columns: repeat(auto-fill, minmax(220px, 1fr))">
            @foreach ($covers as $cover)
                @php $ytId = getYoutubeId($cover->youtube_link); @endphp

                <div
                    class="group flex flex-col overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition-all duration-200 hover:border-blue-200 hover:shadow-lg hover:shadow-blue-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:border-blue-500">

                    {{-- Cover Image --}}
                    <div
                        class="relative h-44 overflow-hidden bg-gradient-to-br from-blue-50 to-gray-100 dark:from-gray-700 dark:to-gray-900">
                        <img src="{{ Storage::url($cover->cover_path) }}" alt="Cover {{ $cover->year }}"
                            class="h-full w-full object-contain p-3 transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>

                        {{-- Year Badge --}}
                        <span
                            class="absolute top-2 right-2 rounded-lg bg-blue-600 px-2.5 py-1 text-xs font-bold text-white shadow">
                            {{ $cover->year }}
                        </span>
                    </div>

                    {{-- Card Body --}}
                    <div class="flex flex-col gap-2 p-3 border-t border-gray-100 dark:border-gray-700">
                        <p class="text-sm font-semibold text-center text-gray-900 dark:text-white">
                            Cover Tahun {{ $cover->year }}
                        </p>

                        {{-- Buttons --}}
                        <div class="flex gap-1.5">

                            {{-- Detail (Primary) --}}
                            <a href="{{ route('yearcover.show', $cover->id) }}"
                                class="flex-1 inline-flex items-center justify-center gap-1 rounded-lg 
                                bg-brand-500 hover:bg-brand-600 px-2 py-1.5 text-xs font-medium text-white 
                                transition-colors shadow-theme-xs leading-none">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5" />
                                </svg>

                                Detail
                            </a>

                            {{-- Edit (Warning) --}}
                            <a href="{{ route('yearcover.edit', $cover->id) }}"
                                class="flex-1 inline-flex items-center justify-center gap-1 rounded-lg 
                                bg-warning-500 hover:bg-warning-600 px-2 py-1.5 text-xs font-medium text-white 
                                transition-colors shadow-theme-xs leading-none">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2" />
                                </svg>

                                Edit
                            </a>

                            {{-- Hapus (Danger) --}}
                            <button onclick="confirmDelete({{ $cover->id }}, {{ $cover->year }})"
                                class="flex-1 inline-flex items-center justify-center gap-1 rounded-lg 
                                bg-error-500 hover:bg-error-600 px-2 py-1.5 text-xs font-medium text-white 
                                transition-colors shadow-theme-xs leading-none">

                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142" />
                                </svg>

                                Hapus
                            </button>

                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

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
                    confirmButtonText: '<i class="fa fa-trash"></i> Ya, Hapus!',
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

            // Flash success message
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 2500,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end',
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end',
                });
            @endif
        </script>
    @endpush

@endsection
