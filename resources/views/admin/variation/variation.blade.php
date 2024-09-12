@extends('layouts.admin')
@section('title')
    Product Variation
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Color List</h3>
                </div>
                <div class="card-body">
                    @if (session('color_delete'))
                        <div class="alert alert-success">{{ session('color_delete') }}</div>
                    @endif
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Color Name</th>
                            <th>Color Code</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($colors as $sl => $color)
                            <tr>
                                <td>{{ $sl + 1 }}</td>
                                <td>{{ $color->color_name }}</td>
                                <td>
                                    <i
                                        style=" display:inline-block; width:50px; height:30px; background:{{ $color->color_name == 'NA' ? '' : $color->color_code }}; color:{{ $color->color_name == 'NA' ? '' : 'transparent' }}">{{ $color->color_name == 'NA' ? 'NA' : $color->color_name }}
                                    </i>
                                </td>
                                <td>
                                    <a href="{{ route('color.delete', $color->id) }}" class="btn btn-danger btn-icon">
                                        <i data-feather="trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">
                    <h3>Size List</h3>
                </div>
                <div class="card-body">
                    @if (session('size_delete'))
                        <div class="alert alert-success">{{ session('size_delete') }}</div>
                    @endif
                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-lg-6">
                                <div class="card mt-2">
                                    <div class="card-header">
                                        <h5>{{ $category->category_name }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Size Name</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach (App\Models\Size::where('category_id', $category->id)->get() as $size)
                                                <tr>
                                                    <td>{{ $size->size_name }}</td>
                                                    <td>
                                                        <a href="{{ route('size.delete', $size->id) }}"
                                                            class="btn btn-danger btn-icon">
                                                            <i data-feather="trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Color</h3>
                </div>
                <div class="card-body">
                    @if (session('color_success'))
                        <div class="alert alert-success">{{ session('color_success') }}</div>
                    @endif
                    <form action="{{ route('color.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Color Name</label>
                            <input type="text" name="color_name" class="form-control" placeholder="Color Name">
                            @error('color_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Color Code</label>
                            <input type="text" name="color_code" class="form-control" placeholder="Color Code">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Color</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h3>Add Size</h3>
                </div>
                <div class="card-body">
                    @if (session('size_success'))
                        <div class="alert alert-success">{{ session('size_success') }}</div>
                    @endif
                    <form action="{{ route('size.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Size Name</label>
                            <select name="category_id" class="form-select">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Size Name</label>
                            <input type="text" name="size_name" class="form-control" placeholder="Size Name">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Size</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
