@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Category</h3>
                </div>
                <div class="card-body">
                    @if (session('category_success'))
                        <div class="alert alert-success">{{ session('category_success') }}</div>
                    @endif

                    <form action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="category_name"
                                value="{{ $category->category_name }}" placeholder="Category Name" >
                            @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Category Icon</label>
                            <input type="file" class="form-control" name="icon">
                            @error('icon')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="my-2">
                                <img src="{{ asset('uploads/category') }}/{{ $category->icon }}" alt="" width="50">
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
