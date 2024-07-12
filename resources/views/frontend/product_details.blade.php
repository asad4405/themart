@extends('frontend.master')
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
                            <li><a href="product.html">Product</a></li>
                            <li>{{ $product->product_name }}</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <!-- product-single-section  start-->
    <div class="product-single-section section-padding">
        <div class="container">
            <div class="product-details">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="product-single-img">
                            <div class="product-active owl-carousel">
                                @foreach ($galleries as $gallery)
                                    <div class="item">
                                        <img height="400" src="{{ asset('uploads/gallery') }}/{{ $gallery->gallery }}"
                                            alt="">
                                    </div>
                                @endforeach
                            </div>
                            <div class="product-thumbnil-active  owl-carousel">
                                @foreach ($galleries as $gallery)
                                    <div class="item">
                                        <img height="100" src="{{ asset('uploads/gallery') }}/{{ $gallery->gallery }}"
                                            alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="product-single-content">
                            <h2>{{ $product->product_name }}</h2>
                            <div class="price">
                                <span class="present-price">{{ $product->after_discount }} Taka</span>
                                @if ($product->discount)
                                    <del class="old-price">{{ $product->product_price }} Taka</del>
                                @endif
                            </div>
                            <div class="rating-product">
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <i class="fi flaticon-star"></i>
                                <span>120</span>
                            </div>
                            <p>{!! $product->short_desp !!}
                            </p>
                            <div class="product-filter-item color">
                                <div class="color-name">
                                    <span>Color :</span>
                                    <ul>
                                        <li class="color1"><input id="a1" type="radio" name="color"
                                                value="30">
                                            <label for="a1"></label>
                                        </li>
                                        <li class="color2"><input id="a2" type="radio" name="color"
                                                value="30">
                                            <label for="a2"></label>
                                        </li>
                                        <li class="color3"><input id="a3" type="radio" name="color"
                                                value="30">
                                            <label for="a3"></label>
                                        </li>
                                        <li class="color4"><input id="a4" type="radio" name="color"
                                                value="30">
                                            <label for="a4"></label>
                                        </li>
                                        <li class="color5"><input id="a5" type="radio" name="color"
                                                value="30">
                                            <label for="a5"></label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-filter-item color filter-size">
                                <div class="color-name">
                                    <span>Sizes:</span>
                                    <ul>
                                        <li class="color"><input id="sz1" type="radio" name="size"
                                                value="30">
                                            <label for="sz1">S</label>
                                        </li>
                                        <li class="color"><input id="sz2" type="radio" name="size"
                                                value="30">
                                            <label for="sz2">M</label>
                                        </li>
                                        <li class="color"><input id="sz3" type="radio" name="size"
                                                value="30">
                                            <label for="sz3">L</label>
                                        </li>
                                        <li class="color"><input id="sz4" type="radio" name="size"
                                                value="30">
                                            <label for="sz4">X</label>
                                        </li>
                                        <li class="color"><input id="sz5" type="radio" name="size"
                                                value="30">
                                            <label for="sz5">XL</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="pro-single-btn">
                                <div class="quantity cart-plus-minus">
                                    <input class="text-value" type="text" value="1">
                                </div>
                                <a href="#" class="theme-btn-s2">Add to cart</a>
                                <a href="#" class="wl-btn"><i class="fi flaticon-heart"></i></a>
                            </div>
                            <ul class="important-text">
                                <li><span>SKU:</span>FTE569P</li>
                                <li><span>Categories:</span> {{ $product->category->category_name }}</li>
                                @php
                                    $after_explode = explode(',', $product->tags);
                                @endphp
                                <li><span>Tags:</span>
                                    @foreach ($after_explode as $tag)
                                        <a href="" class="badge bg-success">{{ $tag }}</a>
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-tab-area">
                <ul class="nav nav-mb-3 main-tab" id="tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="descripton-tab" data-bs-toggle="pill"
                            data-bs-target="#descripton" type="button" role="tab" aria-controls="descripton"
                            aria-selected="true">Description</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Ratings-tab" data-bs-toggle="pill" data-bs-target="#Ratings"
                            type="button" role="tab" aria-controls="Ratings" aria-selected="false">Reviews
                            (3)</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Information-tab" data-bs-toggle="pill"
                            data-bs-target="#Information" type="button" role="tab" aria-controls="Information"
                            aria-selected="false">Additional info</button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="descripton" role="tabpanel"
                        aria-labelledby="descripton-tab">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="Descriptions-item">
                                        {!! $product->long_desp !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Ratings" role="tabpanel" aria-labelledby="Ratings-tab">
                        <div class="container">
                            <div class="rating-section">
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <div class="comments-area">
                                            <div class="comments-section">
                                                <h3 class="comments-title">3 reviews for Stylish Pink Coat</h3>
                                                <ol class="comments">
                                                    <li class="comment even thread-even depth-1" id="comment-1">
                                                        <div id="div-comment-1">
                                                            <div class="comment-theme">
                                                                <div class="comment-image"><img
                                                                        src="{{ asset('frontend/assets') }}/images/blog-details/comments-author/img-1.jpg"
                                                                        alt></div>
                                                            </div>
                                                            <div class="comment-main-area">
                                                                <div class="comment-wrapper">
                                                                    <div class="comments-meta">
                                                                        <h4>Lily Zener</h4>
                                                                        <span class="comments-date">December 25, 2022 at
                                                                            5:30 am</span>
                                                                        <div class="rating-product">
                                                                            <i class="fi flaticon-star"></i>
                                                                            <i class="fi flaticon-star"></i>
                                                                            <i class="fi flaticon-star"></i>
                                                                            <i class="fi flaticon-star"></i>
                                                                            <i class="fi flaticon-star"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="comment-area">
                                                                        <p>Turpis nulla proin donec a ridiculus. Mi
                                                                            suspendisse faucibus sed lacus. Vitae risus eu
                                                                            nullam sed quam.
                                                                            Eget aenean id augue pellentesque turpis magna
                                                                            egestas arcu sed.
                                                                            Aliquam non faucibus massa adipiscing nibh sit.
                                                                            Turpis integer aliquam aliquam aliquam.
                                                                            <a class="comment-reply-link"
                                                                                href="#"><span>Reply...</span></a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <ul class="children">
                                                            <li class="comment">
                                                                <div>
                                                                    <div class="comment-theme">
                                                                        <div class="comment-image"><img
                                                                                src="{{ asset('frontend/assets') }}/images/blog-details/comments-author/img-2.jpg"
                                                                                alt></div>
                                                                    </div>
                                                                    <div class="comment-main-area">
                                                                        <div class="comment-wrapper">
                                                                            <div class="comments-meta">
                                                                                <h4>Leslie Alexander</h4>
                                                                                <div class="rating-product">
                                                                                    <i class="fi flaticon-star"></i>
                                                                                    <i class="fi flaticon-star"></i>
                                                                                    <i class="fi flaticon-star"></i>
                                                                                    <i class="fi flaticon-star"></i>
                                                                                    <i class="fi flaticon-star"></i>
                                                                                </div>
                                                                                <span class="comments-date">December 26,
                                                                                    2022 at 5:30 am</span>
                                                                            </div>
                                                                            <div class="comment-area">
                                                                                <p>Turpis nulla proin donec a ridiculus. Mi
                                                                                    suspendisse faucibus sed lacus. Vitae
                                                                                    risus eu nullam sed quam.
                                                                                    Eget aenean id augue pellentesque turpis
                                                                                    magna egestas arcu sed.
                                                                                    Aliquam non faucibus massa adipiscing
                                                                                    nibh sit. Turpis integer aliquam aliquam
                                                                                    aliquam.
                                                                                    <a class="comment-reply-link"
                                                                                        href="#"><span>Reply...</span></a>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="comment">
                                                        <div>
                                                            <div class="comment-theme">
                                                                <div class="comment-image"><img
                                                                        src="{{ asset('frontend/assets') }}/images/blog-details/comments-author/img-1.jpg"
                                                                        alt></div>
                                                            </div>
                                                            <div class="comment-main-area">
                                                                <div class="comment-wrapper">
                                                                    <div class="comments-meta">
                                                                        <h4>Jenny Wilson</h4>
                                                                        <div class="rating-product">
                                                                            <i class="fi flaticon-star"></i>
                                                                            <i class="fi flaticon-star"></i>
                                                                            <i class="fi flaticon-star"></i>
                                                                            <i class="fi flaticon-star"></i>
                                                                            <i class="fi flaticon-star"></i>
                                                                        </div>
                                                                        <span class="comments-date">December 30, 2022 at
                                                                            3:12 pm</span>
                                                                    </div>
                                                                    <div class="comment-area">
                                                                        <p>Turpis nulla proin donec a ridiculus. Mi
                                                                            suspendisse faucibus sed lacus. Vitae risus eu
                                                                            nullam sed quam.
                                                                            Eget aenean id augue pellentesque turpis magna
                                                                            egestas arcu sed.
                                                                            Aliquam non faucibus massa adipiscing nibh sit.
                                                                            Turpis integer aliquam aliquam aliquam.
                                                                            <a class="comment-reply-link"
                                                                                href="#"><span>Reply...</span></a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ol>
                                            </div> <!-- end comments-section -->
                                            <div class="col col-lg-10 col-12 review-form-wrapper">
                                                <div class="review-form">
                                                    <h4>Add a review</h4>
                                                    <form>
                                                        <div class="give-rat-sec">
                                                            <div class="give-rating">
                                                                <label>
                                                                    <input type="radio" name="stars" value="1">
                                                                    <span class="icon">★</span>
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="stars" value="2">
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="stars" value="3">
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="stars" value="4">
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="stars" value="5">
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <textarea class="form-control" placeholder="Write Comment..."></textarea>
                                                        </div>
                                                        <div class="name-input">
                                                            <input type="text" class="form-control" placeholder="Name"
                                                                required>
                                                        </div>
                                                        <div class="name-email">
                                                            <input type="email" class="form-control"
                                                                placeholder="Email" required>
                                                        </div>
                                                        <div class="rating-wrapper">
                                                            <div class="submit">
                                                                <button type="submit" class="theme-btn-s2">Post
                                                                    review</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> <!-- end comments-area -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Information" role="tabpanel" aria-labelledby="Information-tab">
                        <div class="container">
                            <div class="Additional-wrap">
                                <div class="row">
                                    <div class="col-12">
                                        {!! $product->addi_info !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="related-product">
        </div>
    </div>
    <!-- product-single-section  end-->
@endsection
