@extends('admin.layouts.app')

@section('title', 'Users')
@php $page = 'users'; @endphp

@section('content')
  <div class="mb-6">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Users</h2>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage all registered users</p>
  </div>

  {{-- Table / content users di sini --}}
  {{-- @include('admin.partials.table.users-table') --}}
@endsection