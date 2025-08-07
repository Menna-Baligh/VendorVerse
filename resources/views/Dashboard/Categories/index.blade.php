@extends('layouts.dashboard')
@section('title', 'Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">Categories</li>

@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success text-center mx-auto w-50 py-2 px-3 small">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-center align-items-center mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-success">Add Category</a>
    </div>
    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">parent_id</th>
        <th scope="col">name</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
        <tr>
            <th scope="row">{{ $category->id }}</th>
            <td>
                <img src="{{ asset('storage/' . $category->image) }}" class="img-fluid" style="max-width: 100px; max-height: 100px; object-fit: cover;" alt="{{ $category->name }}">
            </td>
            <td>{{ $category->parent_id }}</td>
            <td>{{ $category->name }}</td>
            <td>
                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">No categories found</td>
        </tr>
        @endforelse


    </tbody>
    </table>
@endsection
