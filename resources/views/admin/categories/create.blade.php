@extends('admin.layouts.app')

@section('title', 'Add Category')
@php $page = 'categories'; @endphp

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Page Header --}}
<div class="mb-6">
  <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
  </div>
  <h2 class="text-2xl font-semibold text-black dark:text-white">Add Category</h2>
  <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Add a new book category</p>
</div>

{{-- Form Card --}}
<div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900 max-w-xl">
  <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
    <h3 class="font-medium text-black dark:text-white">Category Form</h3>
  </div>

  <form id="createForm" method="POST" action="{{ route('categories.store') }}" class="p-6">
    @csrf

    {{-- Name Field --}}
    <div class="mb-5">
      <label for="name" class="mb-2.5 block font-medium text-black dark:text-white text-sm">
        Category Name <span style="color: var(--color-error-500);">*</span>
      </label>
      <input
        type="text"
        name="name"
        id="name"
        placeholder="Example: Siswa, Guru"
        value="{{ old('name') }}"
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

    {{-- Buttons --}}
    <div class="flex items-center gap-3 mt-6">
      <button
        type="button"
        id="submitBtn"
        class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-6 py-3 text-sm font-medium text-white hover:bg-brand-600 transition"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        Save Category
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
  document.getElementById('submitBtn').addEventListener('click', function () {
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
      title: 'Save Category?',
      text: `Add category "${value}"?`,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#465fff',
      cancelButtonColor: '#6B7280',
      confirmButtonText: 'Yes, Save!',
      cancelButtonText: 'Cancel',
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('createForm').submit();
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
