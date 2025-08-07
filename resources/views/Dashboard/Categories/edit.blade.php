@extends('layouts.dashboard')
@section('title', 'Edit Category')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">Category</li>
    <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Edit Category</h1>
                <form action="{{ route('categories.update', $category->id) }}" class="mt-4" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    @include('Dashboard.Categories._form',['button_name' => 'Update'])
                </form>
            </div>
        </div>
    </div>
@endsection
