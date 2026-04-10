@extends('admin.layouts.app')

@section('title', 'Books')
@php $page = 'books'; @endphp

@section('content')

<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900">Books</h1>
        <p class="mt-1 text-sm text-gray-500">
            Manage all books
            @if (!$books->isEmpty())
                <span class="ml-2 inline-block rounded-full bg-brand-100 px-2.5 py-0.5 text-xs font-medium text-brand-700">
                    Total: {{ $books->total() }} books
                </span>
            @endif
        </p>
    </div>
    <a href="{{ route('books.create') }}"
        class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600 transition-colors">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Add Book
    </a>
</div>

@if ($books->isEmpty())
    <div class="flex flex-col items-center justify-center py-20 text-center">
        <svg class="h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
        </svg>
        <h3 class="text-lg font-medium text-gray-700">No books yet</h3>
        <p class="mt-1 text-sm text-gray-400">Click "Add Book" to add the first book.</p>
    </div>
@else
    <div class="rounded-2xl border border-gray-200 bg-white overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-xs uppercase text-gray-500">
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
            <tbody class="divide-y divide-gray-100">
                @foreach ($books as $i => $book)
                <tr class="bg-white">
                    <td class="px-4 py-3 text-gray-500">{{ $i + 1 }}</td>
                    <td class="px-4 py-3">
                        @if ($book->book_cover)
                            <img src="{{ Storage::url($book->book_cover) }}" alt="{{ $book->name }}" class="h-12 w-9 object-cover rounded shadow">
                        @else
                            <div class="h-12 w-9 rounded bg-gray-100 flex items-center justify-center">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $book->name }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $book->publisher }}</td>
                    <td class="px-4 py-3">
                        <span class="rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-700">
                            {{ $book->category->name ?? '-' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ $book->yearCover->year ?? '-' }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $book->user->name ?? '-' }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('books.show', $book->id) }}"
                                class="inline-flex items-center gap-1 rounded-lg bg-brand-50 px-3 py-1.5 text-xs font-medium text-brand-500 hover:bg-brand-100 transition-colors">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Detail
                            </a>
                            <a href="{{ route('books.edit', $book->id) }}"
                                class="inline-flex items-center gap-1 rounded-lg bg-warning-50 px-3 py-1.5 text-xs font-medium text-warning-500 hover:bg-warning-100 transition-colors">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            <button onclick="confirmDelete({{ $book->id }}, '{{ addslashes($book->name) }}')"
                                class="inline-flex items-center gap-1 rounded-lg bg-error-50 px-3 py-1.5 text-xs font-medium text-error-500 hover:bg-error-100 transition-colors">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
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

    <div class="mt-6">
        {{ $books->links('pagination::tailwind') }}
    </div>
@endif

<form id="deleteForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
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
