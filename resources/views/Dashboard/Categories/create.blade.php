@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Create Category</h1>
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('Dashboard.Categories._form')
                </form>
            </div>
        </div>
    </div>
@endsection
