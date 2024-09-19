@extends('layouts.admin')
@section('title')
    Brand
@endsection
@section('content')
    @can('brand_access')
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Brand List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Brand Name</th>
                                <th>Brand Image</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($brands as $sl => $brand)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/brand') }}/{{ $brand->brand_logo }}" alt=""
                                            width="50">
                                    </td>
                                    <td>
                                        @can('brand_edit')
                                            <a href="" class="btn btn-primary btn-icon">
                                                <i data-feather="edit"></i>
                                            </a>
                                        @endcan
                                        @can('brand_delete')
                                            <a href="" class="btn btn-danger btn-icon">
                                                <i data-feather="trash"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            @can('brand_add')
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add New Brand</h3>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">Brand Name</label>
                                    <input type="text" class="form-control" name="brand_name" placeholder="Brand Name">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Brand Logo</label>
                                    <input type="file" class="form-control" name="brand_logo">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Add Brand</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    @endcan
@endsection
