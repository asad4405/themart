@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <form action="{{ route('checked.restore') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3> Category Trash List</h3>
                    </div>
                    <div class="card-body">
                        @if (session('restore'))
                            <div class="alert alert-success">{{ session('restore') }}</div>
                        @endif
                        @if (session('category_delete'))
                            <div class="alert alert-success">{{ session('category_delete') }}</div>
                        @endif
                        <table class="table table-bordered">
                            <tr>
                                <th><input type="checkbox" name="" id="selectAll" class="form-check"> All</th>
                                <th>SL</th>
                                <th>Category Name</th>
                                <th>Category Icon</th>
                                <th>Action</th>
                            </tr>
                            @forelse ($categories as $sl => $category)
                                <tr>
                                    <td><input type="checkbox" name="category_id[]" class="chkDel form-check"
                                            value="{{ $category->id }}"></td>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/category') }}/{{ $category->icon }}" alt="">
                                    </td>
                                    <td>
                                        <a title="Restore" href="{{ route('category.restore', $category->id) }}"
                                            class="btn btn-success btn-icon">
                                            <i data-feather="rotate-cw"></i>
                                        </a>
                                        <a title="Permanent Delete"
                                            href="{{ route('category.permanent.delete', $category->id) }}"
                                            class="btn btn-danger btn-icon">
                                            <i data-feather="trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-danger text-center">No Trash Category Found!</td>
                                </tr>
                            @endforelse
                        </table>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-success">Restore Checked</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('footer_script')
    <script>
        $("#selectAll").on('click', function() {
            this.checked ? $(".chkDel").prop("checked", true) : $(".chkDel").prop("checked", false);
        });
    </script>
@endsection
