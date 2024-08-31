@extends('frontend.master')
@section('title')
    API
@endsection
@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>API</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($categories as $category)
                                <div class="col-lg-4 my-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>{{ $category->category_name }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <img width="100" src="{{ env('CATEGORY_IMAGE') }}/{{ $category->icon }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
