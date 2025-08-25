@extends('layouts.dashboard')
@section('title', 'Trashed Categories')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Categories</li>
    <li class="breadcrumb-item active" aria-current="page">Trash</li>

@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success text-center mx-auto w-50 py-2 px-3 small">
            {{ session('success') }}
        </div>
    @endif


    <div class="d-flex justify-content-center align-items-center mb-3">
        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-info">Back</a>
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
                <form action="" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-sm btn-success">Restore</button>
                </form>

                <form action="" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Force Delete</button>
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
