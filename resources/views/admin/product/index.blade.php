@extends('layouts.admin')
@section('content')
    @can('product_add')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Add New Product</h3>
                        <a href="{{ route('add.product') }}" class="btn btn-primary"><i data-feather="list"></i> Product List</a>
                    </div>

                    <div class="card-body">
                        @if (session('product_success'))
                            <div class="alert alert-success">{{ session('product_success') }}</div>
                        @endif

                        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Category Name</label>
                                        <select name="category_id" class="form-select category">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Sub Category Name</label>
                                        <select name="subcategory_id" id="" class="form-select subcategory">
                                            <option value="">Select Sub Category</option>
                                            @foreach ($subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}">{{ $subcategory->sub_category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('sub_category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Brand Name</label>
                                        <select name="brand_id" id="" class="form-select">
                                            <option value="">Select Brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" name="product_name"
                                            placeholder="Product Name">
                                        @error('product_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Product Price</label>
                                        <input type="text" class="form-control" name="product_price"
                                            placeholder="Product Price">
                                        @error('product_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Discount</label>
                                        <input type="text" class="form-control" name="discount" placeholder="Discount">
                                        @error('discount')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Tags</label>
                                        <input type="text" name="tags[]" placeholder="Tags" id="tags">
                                        @error('tags')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Short Description</label>
                                        <input type="text" class="form-control" name="short_desp"
                                            placeholder="Short Description">
                                        @error('short_desp')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Long Description</label>
                                        <textarea name="long_desp" class="form-control" id="summernote" cols="30" rows="10"></textarea>
                                        @error('long_desp')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Additonal Information</label>
                                        <textarea name="addi_info" class="form-control" id="summernote_two" cols="30" rows="10"></textarea>
                                        @error('addi_info')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Preview Image</label>
                                        <input type="file" class="form-control" name="preview">
                                        @error('preview')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Gallery Image</label>
                                        <input type="file" class="form-control" name="gallery[]" multiple>
                                        @error('gallery')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Add Product</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
@section('footer_script')
    <script>
        $("#tags").selectize({
            delimiter: ",",
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    text: input,
                };
            },
        });
    </script>

    <script>
        $('.category').change(function() {
            var category_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/getsubcategory',
                type: 'POST',
                data: {
                    'category_id': category_id
                },
                success: function(data) {
                    $('.subcategory').html(data);
                }
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });

        $(document).ready(function() {
            $('#summernote_two').summernote();
        });
    </script>
@endsection
