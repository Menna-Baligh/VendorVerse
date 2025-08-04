@extends('layouts.dashboard')
@section('title', 'Show Category')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">Category</li>
    <li class="breadcrumb-item active" aria-current="page">Show Category</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Category Details</h1>

                <div class="card mt-4">
                    <div class="card-body">
                        <h4><strong>Name:</strong> {{ $category->name }}</h4>

                        <p><strong>Description:</strong><br> {{ $category->description }}</p>

                        <p><strong>Status:</strong>
                            @if($category->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Archived</span>
                            @endif
                        </p>

                        <p><strong>Parent Category:</strong>
                            {{ $category->parent_id ? $category->parent_id : 'None' }}
                        </p>

                        <p><strong>Image:</strong></p>
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" style="max-width: 300px;" class="img-thumbnail">
                        @else
                            <p>No image available.</p>
                        @endif
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to List</a>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Edit Category</a>
                </div>
            </div>
        </div>
    </div>
@endsection
