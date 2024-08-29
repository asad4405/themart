@extends('layouts.admin')
@section('title')
    FAQ List
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>FAQ List</h3>
                    <a href="{{ route('faq.create') }}" class="btn btn-primary">Add FAQ</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>SL</td>
                            <td>Question</td>
                            <td>Answer</td>
                            <td>Action</td>
                        </tr>
                        @forelse ($faqs as $faq)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $faq->questions }}</td>
                                <td>{{ $faq->answer }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('faq.show', $faq->id) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('faq.edit', $faq->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('faq.destroy', $faq->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-danger" colspan="4">No FAQ List Available!</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
