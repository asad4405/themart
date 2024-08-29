@extends('layouts.admin')
@section('title')
    FAQ Show
@endsection
@section('content')
    <div class="row">
        <div class="m-auto col-lg-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>FAQ Single View</h3>
                    <a href="{{ route('faq.create') }}" class="btn btn-primary">Add FAQ</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Question</td>
                            <td>{{ $faq->questions }}</td>
                        </tr>
                        <tr>
                            <td>Answer</td>
                            <td>{{ $faq->answer }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
