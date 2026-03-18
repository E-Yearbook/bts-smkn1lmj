@extends('admin.layouts.app')

@section('title', 'Books')
@php $page = 'books'; @endphp

@section('content')

<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Books</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage all books</p>
    </div>
    <a href="{{ route('books.create') }}"
        class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600 transition-all">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Add Book
    </a>
</div>

@if ($books->isEmpty())
    <div class="flex flex-col items-center justify-center py-20 text-center">
        <svg class="h-16 w-16 text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
        </svg>
        <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">No books yet</h3>
        <p class="mt-1 text-sm text-gray-400">Click "Add Book" to add the first book.</p>
    </div>
@else
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800 overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 dark:bg-gray-700 text-xs uppercase text-gray-500 dark:text-gray-400">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Cover</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Publisher</th>
                    <th class="px-4 py-3">Category</th>
                    <th class="px-4 py-3">Year</th>
                    <th class="px-4 py-3">Uploader</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @foreach ($books as $i => $book)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <td class="px-4 py-3 text-gray-500">{{ $i + 1 }}</td>
                    <td class="px-4 py-3">
                        @if ($book->book_cover)
                            <img src="{{ Storage::url($book->book_cover) }}" alt="{{ $book->name }}" class="h-12 w-9 object-cover rounded shadow">
                        @else
                            <div class="h-12 w-9 rounded bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $book->name }}</td>
                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $book->publisher }}</td>
                    <td class="px-4 py-3">
                        <span class="rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                            {{ $book->category->name ?? '-' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $book->yearCover->year ?? '-' }}</td>
                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $book->user->name ?? '-' }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('books.show', $book->id) }}"
                                class="inline-flex items-center justify-center rounded-lg bg-brand-500 hover:bg-brand-600 px-3 py-1.5 text-xs font-medium text-white transition-colors">
                                Detail
                            </a>
                            <a href="{{ route('books.edit', $book->id) }}"
                                class="inline-flex items-center justify-center rounded-lg bg-warning-500 hover:bg-warning-600 px-3 py-1.5 text-xs font-medium text-white transition-colors">
                                Edit
                            </a>
                            <button onclick="confirmDelete({{ $book->id }}, '{{ addslashes($book->name) }}')"
                                class="inline-flex items-center justify-center rounded-lg bg-error-500 hover:bg-error-600 px-3 py-1.5 text-xs font-medium text-white transition-colors">
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<form id="deleteForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Delete Book?',
            html: `Book <strong>${name}</strong> will be permanently deleted.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f04438',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, Delete!',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('deleteForm');
                form.action = `/books/${id}`;
                form.submit();
            }
        });
    }

    @if (session('success'))
        Swal.fire({ icon: 'success', title: 'Success!', text: '{{ session('success') }}', timer: 2500, showConfirmButton: false, toast: true, position: 'top-end' });
    @endif
    @if (session('error'))
        Swal.fire({ icon: 'error', title: 'Failed!', text: '{{ session('error') }}', timer: 3000, showConfirmButton: false, toast: true, position: 'top-end' });
    @endif
</script>
@endpush

@endsection
