@extends('admin.layouts.app')

@section('title', 'Book Categories')
@php $page = 'categories'; @endphp

@section('content')

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h2 class="text-2xl font-semibold text-black">Book Categories</h2>
            <p class="text-sm text-gray-500 mt-1">Manage your book categories</p>
        </div>
        <a href="{{ route('categories.create') }}"
            class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Category
        </a>
    </div>

    <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">
            <h3 class="font-medium text-black">Category List</h3>
            <span class="rounded-full bg-brand-50 px-3 py-1 text-xs font-semibold text-brand-500">
                {{ $categories->count() }} categories
            </span>
        </div>

        <div class="p-4">
            @if ($categories->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 text-gray-400">
                    <svg class="w-12 h-12 mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <p class="text-sm font-medium">No categories yet</p>
                    <p class="text-xs opacity-70 mt-1">Click "Add Category" to create a new category</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">#</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Category</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500">Created</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold uppercase text-gray-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="px-4 py-3 text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 font-medium text-black">{{ $category->name }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $category->created_at->format('d M Y') }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="inline-flex items-center gap-1 rounded-lg bg-warning-50 px-3 py-1.5 text-xs font-medium text-warning-500 hover:bg-warning-100 transition-colors">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <button type="button" onclick="confirmDelete({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ route('categories.destroy', $category->id) }}')"
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
            @endif
        </div>
    </div>

    <form id="deleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
        @include('admin.partials.sweetalert')
    @endpush

@endsection
