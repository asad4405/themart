@extends('layouts.admin')
@section('title')
    Category Add & List
@endsection
@section('content')
    @can('category_access')
        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('checked.delete') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3> Category List</h3>
                        </div>
                        <div class="card-body">
                            @if (session('soft_delete'))
                                <div class="alert alert-success">{{ session('soft_delete') }}</div>
                            @endif

                            <table class="table table-bordered">
                                <tr>
                                    <th><input type="checkbox" name="" id="selectAll" class="form-check"> All</th>
                                    <th>SL</th>
                                    <th>Category Name</th>
                                    <th>Category Icon</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($categories as $sl => $category)
                                    <tr>
                                        <td><input type="checkbox" name="category_id[]" class="chkDel form-check"
                                                value="{{ $category->id }}"></td>
                                        <td>{{ $sl + 1 }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>
                                            <img src="{{ asset('uploads/category') }}/{{ $category->icon }}" alt="">
                                        </td>
                                        <td>
                                            @can('category_edit')
                                                <a href="{{ route('category.edit', $category->id) }}"
                                                    class="btn btn-primary btn-icon">
                                                    <i data-feather="edit"></i>
                                                </a>
                                            @endcan
                                            @can('category_delete')
                                                <a href="{{ route('category.soft.delete', $category->id) }}"
                                                    class="btn btn-danger btn-icon">
                                                    <i data-feather="trash"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-danger">Delete Checked</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            @can('add_category')
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add New Category</h3>
                        </div>
                        <div class="card-body">
                            @if (session('category_success'))
                                <div class="alert alert-success">{{ session('category_success') }}</div>
                            @endif

                            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" name="category_name"
                                        value="{{ old('category_name') }}" placeholder="Category Name">
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
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Add Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endcan

        </div>
    @endcan
@endsection
@section('footer_script')
    <script>
        $("#selectAll").on('click', function() {
            this.checked ? $(".chkDel").prop("checked", true) : $(".chkDel").prop("checked", false);
        });
    </script>
@endsection
