@extends('admin.layouts.app')

@section('title', 'Book Detail')
@php $page = 'books'; @endphp

@section('content')

<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Book Detail</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $book->name }}</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('books.edit', $book->id) }}"
            class="inline-flex items-center gap-2 rounded-lg bg-warning-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-warning-600 transition-all">
            Edit
        </a>
        <a href="{{ route('books.index') }}"
            class="inline-flex items-center gap-2 rounded-lg bg-white px-5 py-2.5 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 transition">
            Back
        </a>
    </div>
</div>

<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

    {{-- Cover --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800 flex flex-col items-center gap-4">
        @if ($book->book_cover)
            <img src="{{ Storage::url($book->book_cover) }}" alt="{{ $book->name }}" class="w-full max-w-[200px] rounded-xl shadow-md object-cover">
        @else
            <div class="flex h-48 w-full max-w-[200px] items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-700">
                <svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
        @endif

        @if ($book->book_path)
            <a href="{{ Storage::url($book->book_path) }}" target="_blank"
                class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-red-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-red-600 transition">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM6 20V4h5v7h7v9H6z"/>
                </svg>
                View PDF
            </a>
        @endif
    </div>

    {{-- Details --}}
    <div class="lg:col-span-2 rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
        <h3 class="mb-5 text-base font-semibold text-gray-800 dark:text-white">Book Information</h3>
        <dl class="space-y-4">
            <div class="flex flex-col sm:flex-row sm:gap-4">
                <dt class="w-32 shrink-0 text-sm font-medium text-gray-500 dark:text-gray-400">Name</dt>
                <dd class="text-sm text-gray-900 dark:text-white font-semibold">{{ $book->name }}</dd>
            </div>
            <div class="flex flex-col sm:flex-row sm:gap-4">
                <dt class="w-32 shrink-0 text-sm font-medium text-gray-500 dark:text-gray-400">Publisher</dt>
                <dd class="text-sm text-gray-900 dark:text-white">{{ $book->publisher }}</dd>
            </div>
            <div class="flex flex-col sm:flex-row sm:gap-4">
                <dt class="w-32 shrink-0 text-sm font-medium text-gray-500 dark:text-gray-400">Category</dt>
                <dd>
                    @if ($book->category)
                        <span class="rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                            {{ $book->category->name }}
                        </span>
                    @else
                        <span class="text-sm text-gray-400">—</span>
                    @endif
                </dd>
            </div>
            <div class="flex flex-col sm:flex-row sm:gap-4">
                <dt class="w-32 shrink-0 text-sm font-medium text-gray-500 dark:text-gray-400">Year Cover</dt>
                <dd class="text-sm text-gray-900 dark:text-white">{{ $book->yearCover->year ?? '—' }}</dd>
            </div>
            <div class="flex flex-col sm:flex-row sm:gap-4">
                <dt class="w-32 shrink-0 text-sm font-medium text-gray-500 dark:text-gray-400">Uploader</dt>
                <dd class="text-sm text-gray-900 dark:text-white">{{ $book->user->name ?? '—' }}</dd>
            </div>
            <div class="flex flex-col sm:flex-row sm:gap-4">
                <dt class="w-32 shrink-0 text-sm font-medium text-gray-500 dark:text-gray-400">Added</dt>
                <dd class="text-sm text-gray-900 dark:text-white">{{ $book->created_at->format('d M Y, H:i') }}</dd>
            </div>
        </dl>
    </div>

</div>

@endsection
