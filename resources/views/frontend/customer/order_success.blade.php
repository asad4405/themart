@extends('frontend.master')
@section('title')
    Orders
@endsection
@if (session('success'))

    @section('content')
        <!-- start wpo-page-title -->
        <section class="wpo-page-title">
            <h2 class="d-none">Hide</h2>
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="wpo-breadcumb-wrap">
                            <ol class="wpo-breadcumb-wrap">
                                <li><a href="{{ route('index') }}">Home</a></li>
                                <li><a href="">Order Success</a></li>
                            </ol>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>
        <!-- end page-title -->

        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3>Order ID: {{ session('success') }}</h3>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('frontend/assets/images/order.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@else
    @php
        abort('404');
    @endphp
@endif
