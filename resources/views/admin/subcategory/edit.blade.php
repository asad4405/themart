@extends('layouts.admin')
@section('title')
    Subcategory Edit
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Sub Category</h3>
                </div>
                <div class="card-body">
                    @if (session('subcategory_success'))
                        <div class="alert alert-success">{{ session('subcategory_success') }}</div>
                    @endif

                    <form action="{{ route('sub.category.update', $subcategory->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Category Name</label>
                            <select name="category_id" class="form-select">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option {{ $subcategory->category_id == $category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="sub_category_name"
                                value="{{ $subcategory->sub_category_name }}" placeholder="Sub Category Name">
                            @error('sub_category_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Sub Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
