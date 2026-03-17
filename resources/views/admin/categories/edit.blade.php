@extends('admin.layouts.app')

@section('title', 'Edit Category')
@php $page = 'categories'; @endphp

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Page Header --}}
<div class="mb-6">
  <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
    <a href="{{ route('categories.index') }}" class="hover:text-brand-500 transition">Categories</a>
    <span>/</span>
    <span class="text-black dark:text-white">Edit</span>
  </div>
  <h2 class="text-2xl font-semibold text-black dark:text-white">Edit Category</h2>
  <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Update the category name</p>
</div>

{{-- Form Card --}}
<div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900 max-w-xl">
  <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800 flex items-center justify-between">
    <h3 class="font-medium text-black dark:text-white">Edit Category</h3>
    <span class="text-xs text-gray-400 dark:text-gray-500">ID: #{{ $category->id }}</span>
  </div>

  <form id="editForm" method="POST" action="{{ route('categories.update', $category->id) }}" class="p-6">
    @csrf
    @method('PUT')

    {{-- Name Field --}}
    <div class="mb-5">
      <label for="name" class="mb-2.5 block font-medium text-black dark:text-white text-sm">
        Category Name <span style="color: var(--color-error-500);">*</span>
      </label>
      <input
        type="text"
        name="name"
        id="name"
        value="{{ old('name', $category->name) }}"
        placeholder="Enter category name..."
        class="w-full rounded-lg border border-gray-200 bg-white px-5 py-3 text-black outline-none transition focus:border-brand-500 active:border-brand-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:focus:border-brand-500
          @error('name') !border-error-500 @enderror"
      />
      @error('name')
        <p class="mt-1.5 text-xs text-error-500 flex items-center gap-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          {{ $message }}
        </p>
      @enderror
    </div>

    {{-- Created At Info --}}
    <div class="mb-5 rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-700 dark:bg-gray-800">
      <p class="text-xs text-gray-500 dark:text-gray-400">
        Created at:
        <span class="font-medium text-black dark:text-white">{{ $category->created_at->format('d M Y, H:i') }}</span>
      </p>
    </div>

    {{-- Buttons --}}
    <div class="flex items-center gap-3 mt-6">
      <button
        type="button"
        id="updateBtn"
        class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-6 py-3 text-sm font-medium text-white hover:bg-brand-600 transition"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
        </svg>
        Update Category
      </button>
      <a
        href="{{ route('categories.index') }}"
        class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-6 py-3 text-sm font-medium text-black hover:bg-gray-50 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 transition"
      >
        Cancel
      </a>
    </div>
  </form>
</div>

<script>
  document.getElementById('updateBtn').addEventListener('click', function () {
    const nameInput = document.getElementById('name');
    const value = nameInput.value.trim();

    if (!value) {
      Swal.fire({ icon: 'warning', title: 'Oops!', text: 'Category name is required.', confirmButtonColor: '#465fff' });
      return;
    }
    if (value.length < 2) {
      Swal.fire({ icon: 'warning', title: 'Too Short', text: 'Category name must be at least 2 characters.', confirmButtonColor: '#465fff' });
      return;
    }
    if (value.length > 100) {
      Swal.fire({ icon: 'warning', title: 'Too Long', text: 'Category name must be no more than 100 characters.', confirmButtonColor: '#465fff' });
      return;
    }

    Swal.fire({
      title: 'Update Category?',
      text: `Save name change to "${value}"?`,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#465fff',
      cancelButtonColor: '#6B7280',
      confirmButtonText: 'Yes, Update!',
      cancelButtonText: 'Cancel',
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('editForm').submit();
      }
    });
  });

  @if($errors->any())
    Swal.fire({
      icon: 'error',
      title: 'Validation Failed',
      html: `{!! implode('<br>', $errors->all()) !!}`,
      confirmButtonColor: '#f04438',
    });
  @endif
</script>

@endsection
