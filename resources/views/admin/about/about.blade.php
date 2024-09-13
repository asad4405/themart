@extends('layouts.admin')
@section('title')
    About
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>About</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Heading</th>
                            <th>Preview</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($abouts as $about)
                            <tr>
                                <td>{{ $about->heading }}</td>
                                <td>
                                    <img src="{{ asset('uploads/about') }}/{{ $about->preview }}" alt="">
                                </td>
                                <td>
                                    <a href="{{ route('admin.about.delete',$about->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-danger" colspan="3">No About Available!</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add About</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Heading</label>
                            <input type="text" class="form-control" name="heading">
                            @error('heading')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Details</label>
                            <textarea name="details" rows="4" class="form-control"></textarea>
                            @error('details')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Preview</label>
                            <input type="file" class="form-control" name="preview">
                            @error('preview')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">About Gallery</label>
                            <input type="file" class="form-control" name="about_gallery[]" multiple>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add About</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
