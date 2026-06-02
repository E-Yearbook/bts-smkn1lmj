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

    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Year Covers</h1>
            <p class="mt-1 text-sm text-gray-500">Manage school annual covers and videos</p>
        </div>
        <a href="{{ route('yearcover.create') }}"
            class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600 transition-all">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Add Cover
        </a>
    </div>

    @if ($covers->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <svg class="h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" stroke-width="1.5"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5M21 3.75H3M6.75 7.5h.008v.008H6.75V7.5z" />
            </svg>
            <h3 class="text-lg font-medium text-gray-700">No covers yet</h3>
            <p class="mt-1 text-sm text-gray-400">Click "Add Cover" to create the first annual cover.</p>
        </div>
    @else
        {{-- Table --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600 w-12">#</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600 w-20">Cover</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600">Year</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-600 w-40">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($covers as $cover)
                        <tr class="hover:bg-gray-50 transition-colors">

                            {{-- No --}}
                            <td class="px-4 py-3 text-center text-gray-400">
                                {{ $covers->firstItem() + $loop->index }}
                            </td>

                            {{-- Thumbnail --}}
                            <td class="px-4 py-3">
                                <img src="{{ Storage::url($cover->cover_path) }}" alt="Cover {{ $cover->year }}"
                                    class="h-12 w-10 rounded-lg object-contain border border-gray-100 bg-gray-50 mx-auto">
                            </td>

                            {{-- Year --}}
                            <td class="px-4 py-3 text-center font-semibold text-gray-800">
                                <span
                                    class="inline-flex items-center rounded-lg bg-brand-50 px-2.5 py-1 text-xs font-bold text-brand-600">
                                    {{ $cover->year }}
                                </span>
                            </td>

                            {{-- Actions --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('yearcover.show', $cover->id) }}"
                                        class="inline-flex items-center justify-center gap-1 rounded-lg bg-brand-50 px-2.5 py-1.5 text-xs font-medium text-brand-500 hover:bg-brand-100 transition-colors">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Detail
                                    </a>
                                    <a href="{{ route('yearcover.edit', $cover->id) }}"
                                        class="inline-flex items-center justify-center gap-1 rounded-lg bg-warning-50 px-2.5 py-1.5 text-xs font-medium text-warning-500 hover:bg-warning-100 transition-colors">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <button
                                        onclick="confirmDelete({{ $cover->id }}, {{ $cover->year }}, '{{ route('yearcover.destroy', $cover->id) }}')"
                                        class="inline-flex items-center justify-center gap-1 rounded-lg bg-error-50 px-2.5 py-1.5 text-xs font-medium text-error-500 hover:bg-error-100 transition-colors">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($covers->hasPages())
            @php($pages = collect(range(1, $covers->lastPage()))->filter(fn($p) => $p == 1 || $p == $covers->lastPage() || abs($p - $covers->currentPage()) <= 1))
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-sm text-gray-500 bg-gray-50 px-4 py-1.5 rounded-full">Showing {{ $covers->firstItem() }} –
                    {{ $covers->lastItem() }} of {{ $covers->total() }} results</p>
                <nav class="flex items-center gap-1">
                    @if (!$covers->onFirstPage())
                        <a href="{{ $covers->previousPageUrl() }}"
                            class="px-3 py-2 rounded-xl border border-gray-200 bg-white text-gray-600 hover:bg-brand-50 hover:text-brand-600 transition-all text-sm"><span
                                class="hidden sm:inline">Previous</span><svg class="w-4 h-4 inline sm:hidden" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg></a>
                    @endif
                    @foreach ($pages as $i => $page)
                        @if ($i > 0 && $page - $pages[$i - 1] > 1)
                            <span class="w-9 text-center text-gray-400">...</span>
                        @endif
                        @if ($page == $covers->currentPage())
                            <span
                                class="min-w-[38px] h-10 px-3 inline-flex items-center justify-center rounded-xl bg-brand-500 text-white font-bold shadow-md ring-2 ring-brand-200">{{ $page }}</span>
                        @else
                            <a href="{{ $covers->url($page) }}"
                                class="min-w-[36px] h-9 px-2 inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-600 hover:bg-brand-50 hover:text-brand-600 transition-all">{{ $page }}</a>
                        @endif
                    @endforeach
                    @if ($covers->hasMorePages())
                        <a href="{{ $covers->nextPageUrl() }}"
                            class="px-3 py-2 rounded-xl border border-gray-200 bg-white text-gray-600 hover:bg-brand-50 hover:text-brand-600 transition-all text-sm"><span
                                class="hidden sm:inline">Next</span><svg class="w-4 h-4 inline sm:hidden" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg></a>
                    @endif
                </nav>
            </div>
        @endif
    @endif

    <form id="deleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
        @include('admin.partials.sweetalert')
    @endpush

@endsection
