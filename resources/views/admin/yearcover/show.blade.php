@extends('admin.layouts.app')

@section('title', 'Detail Cover ' . $yearcover->year)
@php $page = 'yearcover'; @endphp

@section('content')

    @php
        preg_match_all(
            '/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
            $yearcover->youtube_link,
            $matches
        );
        $ytIds = array_unique($matches[1] ?? []);
    @endphp

    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Year Cover {{ $yearcover->year }}</h1>
            <p class="mt-1 text-sm text-gray-500">Complete information about the annual cover and video</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('yearcover') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>
    </div>

    <div class="space-y-6">
        <!-- Banner Card -->
        <div class="rounded-2xl border border-gray-200 bg-white overflow-hidden shadow-sm">
            <!-- decorative top gradient -->
            <div class="h-8 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
            <div class="p-6 sm:p-8 flex flex-col sm:flex-row items-center sm:items-start gap-6 sm:gap-8">
                <!-- Cover Image -->
                <div class="shrink-0 relative group">
                    <div
                        class="absolute inset-0 bg-blue-500 rounded-xl blur opacity-20 group-hover:opacity-40 transition duration-300">
                    </div>
                    <img src="{{ Storage::url($yearcover->cover_path) }}" alt="Cover {{ $yearcover->year }}"
                        class="relative h-48 w-auto max-w-[140px] border border-gray-100 object-contain rounded-xl shadow-lg bg-white p-1">
                </div>

                <!-- Meta Info -->
                <div class="flex-1 text-center sm:text-left pt-2">
                    <div
                        class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 mb-3 border border-blue-100 shadow-sm">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Year {{ $yearcover->year }}
                    </div>
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Cover {{ $yearcover->year }}</h2>
                    <p class="mt-2 text-sm text-gray-500 max-w-2xl font-medium mx-auto sm:mx-0">
                        Detailed presentation and video highlight for the class of {{ $yearcover->year }}.
                    </p>

                    <div class="mt-6 flex flex-wrap items-center justify-center sm:justify-start gap-4 sm:gap-8">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 border border-indigo-100 text-indigo-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Added Date</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $yearcover->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Last Update</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $yearcover->updated_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Video Section -->
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="mb-6 flex items-center justify-center sm:justify-start gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-red-500">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                    </svg>
                </div>
                <div class="text-center sm:text-left">
                    <h3 class="text-lg font-bold text-gray-900">Featured Video</h3>
                    <p class="text-sm font-medium text-gray-500">Video highlight presentation for this year</p>
                </div>
            </div>

            @if (count($ytIds) > 0)
                <div class="flex flex-col gap-6 w-full max-w-4xl mx-auto">
                @foreach($ytIds as $idx => $ytId)
                    <div class="space-y-4">
                        <div class="overflow-hidden rounded-xl bg-gray-900 shadow-md ring-1 ring-gray-900/5 mx-auto max-w-4xl w-full">
                            <iframe src="https://www.youtube.com/embed/{{ $ytId }}" width="100%" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="block aspect-video w-full"></iframe>
                        </div>

                        <div
                            class="flex flex-col sm:flex-row items-center sm:justify-between gap-4 rounded-xl bg-gray-50 border border-gray-100 p-4 mx-auto max-w-4xl w-full hover:border-gray-200 transition">
                            <div class="flex items-center gap-4 w-full sm:w-auto overflow-hidden">
                                <img src="https://img.youtube.com/vi/{{ $ytId }}/mqdefault.jpg" alt="Thumbnail"
                                    class="h-16 w-28 rounded-lg object-cover shadow-sm ring-1 ring-black/5 flex-shrink-0">
                                <div class="min-w-0 flex-1">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">YouTube Video {{ $idx + 1 }}</p>
                                    <a href="https://www.youtube.com/watch?v={{ $ytId }}" target="_blank"
                                        class="text-sm font-medium text-blue-600 hover:text-blue-700 hover:underline break-all block truncate">
                                        https://youtube.com/watch?v={{ $ytId }}
                                    </a>
                                </div>
                            </div>
                            <a href="https://www.youtube.com/watch?v={{ $ytId }}" target="_blank"
                                class="w-full sm:w-auto flex-shrink-0 inline-flex justify-center items-center gap-2 rounded-xl bg-red-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 transition-all">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                                Watch Full Video
                            </a>
                        </div>
                    </div>
                @endforeach
                </div>
            @else
                <div
                    class="flex flex-col items-center justify-center py-16 text-center rounded-xl bg-gray-50 border border-dashed border-gray-200 mx-auto max-w-4xl">
                    <div class="rounded-full bg-gray-100 p-4 mb-4">
                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900">No Video Available</h3>
                    <p class="mt-1 text-sm text-gray-500">The provided YouTube link is invalid or missing.</p>
                </div>
            @endif
        </div>
    </div>

    <form id="deleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
        <script>
            function confirmDelete(id, year) {
                Swal.fire({
                    title: 'Delete Cover?',
                    html: `Year <strong>${year}</strong> cover will be permanently deleted.<br>This action cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, Delete!',
                    cancelButtonText: 'Cancel',
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
