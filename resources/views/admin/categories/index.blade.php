@extends('admin.layouts.app')

@section('title', 'Categories')
@php $page = 'categories'; @endphp

@section('content')
  <div class="mb-6">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Categories</h2>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage product categories</p>
  </div>

  <form method="POST" action="{{ route('categories.store') }}">
    @csrf
    
    <input type="text" name="username" placeholder="Type categories book..." />
    <button type="submit">Submit</button>
  </form>

  <table border="1">
<thead>
<tr>
    <th>ID</th>
    <th>Category Name</th>
    <th>Actions</th>
</tr>
</thead>

<tbody>

@foreach ($category as $categor)
<tr>

<form method="POST" action="{{ route('categories.update', $categor->id) }}">
@csrf
@method('PUT')

<td>{{ $categor->id }}</td>

<td>
    <input type="text" name="name" value="{{ $categor->name }}">
</td>

<td>
    <button type="submit">Update</button>
</form>

<form method="POST" action="{{ route('categories.destroy', $categor->id) }}" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>

</td>

</tr>
@endforeach

</tbody>
</table>
@endsection