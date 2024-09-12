@extends('frontend.master')
@section('title')
    Recent View
@endsection
@section('content')
    <!-- start wpo-page-title -->
    <section class="wpo-page-title">
        <h2 class="d-none">Hide</h2>
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap">
                        <ol class="wpo-breadcumb-wrap">
                            {{ Breadcrumbs::render('recent.view') }}
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <!-- start of themart-interestproduct-section -->
    <section class="themart-interestproduct-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="wpo-section-title">
                        <h2>Recently Viewed Product </h2>
                    </div>
                </div>
            </div>
            <div class="product-wrap">
                <div class="row">
                    @forelse ($recent_view_products as $recent_view_product)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product-item">
                                <div class="image">
                                    <img width="150"
                                        src="{{ asset('uploads/product') }}/{{ $recent_view_product->preview }}"
                                        alt="">
                                    @if ($recent_view_product->after_discount)
                                        <div class="tag sale">- {{ $recent_view_product->discount }}%</div>
                                    @else
                                        <div class="tag new">New</div>
                                    @endif
                                </div>
                                <div class="text">
                                    <h2><a
                                            href="{{ route('product_details', $recent_view_product->slug) }}">{{ $recent_view_product->product_name }}</a>
                                    </h2>
                                    <div class="rating-product">
                                        @php
                                            $reviews = App\Models\OrderProduct::where(
                                                'product_id',
                                                $recent_view_product->id,
                                            )
                                                ->whereNotNull('review')
                                                ->get();
                                        @endphp
                                        @if ($reviews->count())
                                            @for ($i = 1; $i <= $reviews->average('star'); $i++)
                                                <i class="fi flaticon-star"></i>
                                            @endfor
                                            @for ($i = 1; $i <= 5 - $reviews->average('star'); $i++)
                                                <i class="fa fa-star-o"></i>
                                            @endfor
                                            <span>{{ $reviews->count() }}</span>
                                        @else
                                            <span>No reviews</span>
                                        @endif
                                    </div>
                                    <div class="price">
                                        <span class="present-price">{{ $recent_view_product->after_discount }} Taka</span>
                                        @if ($recent_view_product->after_discount)
                                            <del class="old-price">{{ $recent_view_product->product_price }} Taka</del>
                                        @endif
                                    </div>
                                    <div class="shop-btn">
                                        <a class="theme-btn-s2"
                                            href="{{ route('product_details', $recent_view_product->slug) }}">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td>
                                <span class="text-center alert alert-danger">
                                    No Recent View Available
                                </span>
                            </td>
                        </tr>
                    @endforelse
                    <div class="more-btn">
                        <a class="theme-btn-s2" href="{{ route('shop') }}">Load More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
