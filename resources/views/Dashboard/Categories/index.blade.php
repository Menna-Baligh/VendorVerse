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
    <form action="{{ URL::current() }}" method="get" class="mb-4">
        <div class="row g-2 align-items-center justify-content-center">

            <div class="col-md-4">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <x-form.input type="text" name="name" class="form-control"
                        placeholder="Search by name..." value="{{ request('name') }}"/>
                </div>
            </div>

            <div class="col-md-3">
                <select name="status" class="form-select shadow-sm">
                    <option value="">All Status</option>
                    <option value="active"  @selected(request('status') == 'active') >Active</option>
                    <option value="archived"  @selected(request('status') == 'archived') >Archived</option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100 shadow-sm" type="submit">
                    <i class="bi bi-funnel"></i> Filter
                </button>
            </div>

            <div class="col-md-2">
                <a href="{{ URL::current() }}" class="btn btn-outline-secondary w-100 shadow-sm">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </div>

        </div>
    </form>

    <div class="d-flex justify-content-center align-items-center mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-success">Add Category</a>
        <a href="{{ route('categories.trash') }}" class="btn btn-sm btn-dark ms-2">Trashed Categories</a>
    </div>
    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">name</th>
        <th scope="col">parent_name</th>
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
            <td>{{ $category->name }}</td>
            <td>{{ $category->parent_name }}</td>

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
            <td colspan="6" class="text-center">No categories found</td>
        </tr>
        @endforelse


    </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $categories->withQueryString()->links() }}
    </div>
@endsection
