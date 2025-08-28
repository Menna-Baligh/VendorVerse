@extends('layouts.dashboard')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">Products</li>
@endsection

@section('content')

    {{-- Success Message --}}
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
                        placeholder="Search by product name..." value="{{ request('name') }}"/>
                </div>
            </div>

            <div class="col-md-3">
                <select name="status" class="form-select shadow-sm">
                    <option value="">All Status</option>
                    <option value="active"  @selected(request('status') == 'active') >Active</option>
                    <option value="draft"  @selected(request('status') == 'draft') >Draft</option>
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
        <a href="{{ route('products.create') }}" class="btn btn-sm btn-success">Add Product</a>
        {{-- <a href="{{ route('products.trash') }}" class="btn btn-sm btn-dark ms-2">Trashed Products</a> --}}
    </div>

    <table class="table table-hover text-center align-middle">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Store</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Compare Price</th>
                <th scope="col">Rating</th>
                <th scope="col">Featured</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
            <tr>
                <th scope="row">{{ $product->id }}</th>
                <td>
                    @if($product->image)
                        <img src="{{ $product->image }}" class="img-thumbnail"
                            style="max-width: 80px; max-height: 80px; object-fit: cover;" alt="{{ $product->name }}">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->store->name ?? '-' }}</td>
                <td>{{ $product->category->name ?? '-' }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>
                    @if($product->compare_price)
                        <del>${{ number_format($product->compare_price, 2) }}</del>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>{{ $product->rating }}</td>
                <td>
                    @if($product->featured)
                        <span class="badge bg-success">Yes</span>
                    @else
                        <span class="badge bg-secondary">No</span>
                    @endif
                </td>
                <td>
                    <span class="badge
                        @if($product->status == 'active') bg-success
                        @elseif($product->status == 'draft') bg-warning text-dark
                        @else bg-danger @endif">
                        {{ ucfirst($product->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center">No products found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $products->withQueryString()->links() }}
    </div>

@endsection
