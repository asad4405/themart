@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Show Banners</h3>
                </div>
                <div class="card-body">
                    @if (session('banner_delete'))
                        <div class="alert alert-success">{{ session('banner_delete') }}</div>
                    @endif
                    <table class="table table-bordered">
                        <tr>
                            <th>Image</th>
                            <th>Title </th>
                            <th>Action</th>
                        </tr>
                        @forelse ($banners as $banner)
                            <tr>
                                <td>
                                    <img src="{{ asset('uploads/banner') }}/{{ $banner->image }}" alt=""
                                        width="200">
                                </td>
                                <td>{{ $banner->title }}</td>
                                <td>
                                    <a href="{{ route('banner.delete',$banner->id) }}" class="btn btn-danger btn-icon">
                                        <i data-feather="trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    @if (session('banner_success'))
                        <div class="alert alert-success">{{ session('banner_success') }}</div>
                    @endif
                    <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Title">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Page Link</label>
                            <select name="category_id" class="form-select">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Banner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
