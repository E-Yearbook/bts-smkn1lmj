@extends('admin.layouts.app')

@section('title', 'Year Cover')
@php $page = 'yearcover'; @endphp

@section('content')

    @php
        function getYoutubeId(string $url): string
        {
            preg_match('/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
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
            <svg class="h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5M21 3.75H3M6.75 7.5h.008v.008H6.75V7.5z" />
            </svg>
            <h3 class="text-lg font-medium text-gray-700">No covers yet</h3>
            <p class="mt-1 text-sm text-gray-400">Click "Add Cover" to create the first annual cover.</p>
        </div>
    @else
        <div class="grid gap-4" style="grid-template-columns: repeat(auto-fill, minmax(220px, 1fr))">
            @foreach ($covers as $cover)
                @php $ytId = getYoutubeId($cover->youtube_link); @endphp

                <div class="group flex flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition-all duration-200 hover:border-brand-200 hover:shadow-lg hover:shadow-brand-50">
                    <div class="relative h-44 overflow-hidden bg-gradient-to-br from-blue-50 to-gray-100">
                        <img src="{{ Storage::url($cover->cover_path) }}" alt="Cover {{ $cover->year }}"
                            class="h-full w-full object-contain p-3 transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        <span class="absolute top-2 right-2 rounded-lg bg-brand-500 px-2.5 py-1 text-xs font-bold text-white shadow">
                            {{ $cover->year }}
                        </span>
                    </div>

                    <div class="flex flex-col gap-3 p-4 border-t border-gray-100">
                        <p class="text-sm font-semibold text-center text-gray-900">Year Cover {{ $cover->year }}</p>
                        <div class="grid grid-cols-3 gap-2">
                            <a href="{{ route('yearcover.show', $cover->id) }}"
                                class="inline-flex items-center justify-center gap-1 rounded-lg bg-brand-50 px-2.5 py-2 text-xs font-medium text-brand-500 hover:bg-brand-100 transition-colors whitespace-nowrap">
                                <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span>Detail</span>
                            </a>
                            <a href="{{ route('yearcover.edit', $cover->id) }}"
                                class="inline-flex items-center justify-center gap-1 rounded-lg bg-warning-50 px-2.5 py-2 text-xs font-medium text-warning-500 hover:bg-warning-100 transition-colors whitespace-nowrap">
                                <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                <span>Edit</span>
                            </a>
                            <button onclick="confirmDelete({{ $cover->id }}, {{ $cover->year }}, '{{ route('yearcover.destroy', $cover->id) }}')"
                                class="inline-flex items-center justify-center gap-1 rounded-lg bg-error-50 px-2.5 py-2 text-xs font-medium text-error-500 hover:bg-error-100 transition-colors whitespace-nowrap">
                                <svg class="h-4 w-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                <span>Delete</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <form id="deleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
        @include('admin.partials.sweetalert')
    @endpush

@endsection
