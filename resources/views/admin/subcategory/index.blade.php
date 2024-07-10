@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3> Sub Category List</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-lg-6 my-2">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>{{ $category->category_name }}</h4>
                                    </div>
                                    <div class="card-body">
                                        @if (session('subcategory_delete'))
                                            <div class="alert alert-success">{{ session('subcategory_delete') }}</div>
                                        @endif
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Sub Category</th>
                                                <th>Action</th>
                                            </tr>
                                            @forelse (App\Models\Subcategory::where('category_id',$category->id)->get() as $subcategory)
                                                <tr>
                                                    <td>{{ $subcategory->sub_category_name }}</td>
                                                    <td>
                                                        <a href="{{ route('sub.category.edit', $subcategory->id) }}"
                                                            class="btn btn-primary btn-icon">
                                                            <i data-feather="edit"></i>
                                                        </a>
                                                        <a
                                                        href="{{ route('sub.category.delete', $subcategory->id) }}"
                                                        class="btn btn-danger btn-icon
                                                        {{-- delete_btn --}}
                                                        "
                                                            {{-- data-link="{{ route('sub.category.delete', $subcategory->id) }}" --}}
                                                            >
                                                            <i data-feather="trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="text-danger text-center">No Sub Category
                                                        Found!</td>
                                                </tr>
                                            @endforelse
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
                    <h3>Add New Sub Category</h3>
                </div>
                <div class="card-body">
                    @if (session('sub_category_success'))
                        <div class="alert alert-success">{{ session('sub_category_success') }}</div>
                    @endif
                    @if (session('exists'))
                        <div class="alert alert-warning">{{ session('exists') }}</div>
                    @endif

                    <form action="{{ route('sub.category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Category Name</label>
                            <select name="category_id" class="form-select">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Sub Category Name</label>
                            <input type="text" class="form-control" name="sub_category_name"
                                placeholder="Sub Category Name">
                            @error('sub_category_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Sub Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')
    <script>
        $('.delete_btn').click(function() {
            var link = $(this).attr('data-link')
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;

                }
            });
        });
    </script>

    @if (session('subcategory_delete'))
        <script>
            Swal.fire({
                title: "Deleted!",
                text: "{{ session('subcategory_delete') }}",
                icon: "success"
            });
        </script>
    @endif
@endsection
