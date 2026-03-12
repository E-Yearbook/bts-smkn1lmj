@extends('admin.layouts.app')

@section('title', 'Categories')
@php $page = 'categories'; @endphp

@section('content')
  <div class="mb-6">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Categories</h2>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage product categories</p>
  </div>

  {{-- Table / content categories di sini --}}
  {{-- @include('admin.partials.table.categories-table') --}}
@endsection