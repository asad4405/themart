@extends('layouts.admin')
@section('title')
    Offer
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Offer 1</h3>
                </div>
                <div class="card-body">
                    @if (session('offer_one_success'))
                        <div class="alert alert-success">{{ session('offer_one_success') }}</div>
                    @endif
                    <form action="{{ route('offer.one.update', $offer_ones->first()->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Title"
                                value="{{ $offer_ones->first()->title }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Price</label>
                            <input type="text" class="form-control" name="price" placeholder="Price"
                                value="{{ $offer_ones->first()->price }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Discount Price</label>
                            <input type="text" class="form-control" name="discount_price" placeholder="Discount Price"
                                value="{{ $offer_ones->first()->discount_price }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image"
                                onchange="document.getElementById('blah').src =window.URL.createObjectUrl(this.file[0])">
                            <div class="my-2">
                                <img id="blash" width="100"
                                    src="{{ asset('uploads/offer_one') }}/{{ $offer_ones->first()->image }}" alt="">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Discount Price</label>
                            <input type="date" class="form-control" name="date"
                                value="{{ $offer_ones->first()->date }}">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Offer One</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Offer 2</h3>
                </div>
                <div class="card-body">
                    @if (session('offer_two_success'))
                        <div class="alert alert-success">{{ session('offer_two_success') }}</div>
                    @endif
                    <form action="{{ route('offer.two.update', $offer_twos->first()->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Title"
                                value="{{ $offer_twos->first()->title }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Sub Title</label>
                            <input type="text" class="form-control" name="subtitle" placeholder="Sub Title"
                                value="{{ $offer_twos->first()->subtitle }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image"
                                onchange="document.getElementById('blah2').src =window.URL.createObjectUrl(this.file[0])">
                            <div class="my-2">
                                <img id="blash2" width="100"
                                    src="{{ asset('uploads/offer_one') }}/{{ $offer_twos->first()->image }}"
                                    alt="">
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Offer Two</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
