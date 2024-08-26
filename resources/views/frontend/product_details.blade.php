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
                            {{-- {{ Breadcrumbs::render('product.details','') }} --}}
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
                <form action="{{ route('add.cart') }}" method="POST">
                    @csrf
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
                                <div class="product-thumbnil-active owl-carousel">
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
                                    @if ($reviews->count())
                                        @for ($i = 1; $i <= $reviews->average('star'); $i++)
                                            <i class="fi flaticon-star"></i>
                                        @endfor
                                        @for ($i = 1; $i <= 5 - $reviews->average('star'); $i++)
                                            <i class="fa fa-star-o"></i>
                                        @endfor
                                        <span>{{ $reviews->count() }}</span>
                                    @else
                                        <p>No reviews</p>
                                    @endif
                                </div>
                                <p>{!! $product->short_desp !!}
                                </p>
                                <div class="product-filter-item color">
                                    <div class="color-name">
                                        <span>Color :</span>
                                        <ul>
                                            @foreach ($available_colors as $available_color)
                                                @if ($available_color->color->color_name == 'NA')
                                                    <li class="color1">
                                                        <input checked id="color{{ $available_color->color_id }}"
                                                            type="radio" name="color_id" class="color_id"
                                                            value="{{ $available_color->color_id }}">
                                                        <label title="{{ $available_color->color->color_name }}"
                                                            for="color{{ $available_color->color_id }}"
                                                            style="background: {{ $available_color->color->color_code }}">NA
                                                        </label>
                                                    </li>
                                                @else
                                                    <li class="color1">
                                                        <input id="{{ $available_color->color_id }}" type="radio"
                                                            name="color_id" class="color_id"
                                                            value="{{ $available_color->color_id }}">
                                                        <label title="{{ $available_color->color->color_name }}"
                                                            for="{{ $available_color->color_id }}"
                                                            style="background: {{ $available_color->color->color_code }}">
                                                        </label>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        @error('color_id')
                                            <span class="text-danger">Color is Required!</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="product-filter-item color filter-size">
                                    <div class="color-name">
                                        <span>Sizes:</span>
                                        <ul class="available_size">
                                            @foreach ($available_sizes as $available_size)
                                                @if ($available_size->size->size_name == 'NA')
                                                    <li class="color"><input checked class="size_id"
                                                            id="{{ $available_size->size_id }}" type="radio"
                                                            name="size_id" value="{{ $available_size->size_id }}">
                                                        <label
                                                            for="{{ $available_size->size_id }}">{{ $available_size->size->size_name }}</label>
                                                    </li>
                                                @else
                                                    <li class="color"><input class="size_id"
                                                            id="{{ $available_size->size_id }}" type="radio"
                                                            name="size_id" value="{{ $available_size->size_id }}">
                                                        <label
                                                            for="{{ $available_size->size_id }}">{{ $available_size->size->size_name }}</label>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        @error('size_id')
                                            <span class="text-danger">Size is Required!</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="pro-single-btn">
                                    <div class="quantity cart-plus-minus">
                                        <input class="text-value" type="text" value="1" name="quantity">
                                    </div>
                                    @auth('customer')
                                        <button type="submit" class="theme-btn-s2">Add to cart</button>
                                    @else
                                        <a href="{{ route('customer.login') }}" class="theme-btn-s2">Login</a>
                                    @endauth
                                    <a href="#" class="wl-btn"><i class="fi flaticon-heart"></i></a>
                                </div>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <ul class="important-text">
                                    <li><span>SKU:</span>FTE569P</li>
                                    <li><span>Categories:</span> {{ $product->category->category_name }}</li>
                                    @php
                                        $after_explode = explode(',', $product->tags);
                                    @endphp
                                    <li><span>Tags:</span>
                                        @foreach ($after_explode as $tag)
                                            <a class="badge bg-success">{{ App\Models\Tag::find($tag)->tag_name }}</a>
                                        @endforeach
                                    </li>
                                    <li>
                                        <p>Stock:
                                            <span id="quantity"> Color and Size</span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
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
                            ({{ $reviews->count() }})</button>
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
                                                <h3 class="comments-title">{{ $reviews->count() }} reviews for
                                                    {{ $product->product_name }}</h3>
                                                <ol class="comments">
                                                    @foreach ($reviews as $review)
                                                        <li class="comment">
                                                            <div>
                                                                <div class="comment-theme">
                                                                    <div class="comment-image">
                                                                        @if ($review->customer->photo)
                                                                            <img width="100"
                                                                                src="{{ asset('uploads/customer') }}/{{ $review->customer->photo }}"
                                                                                alt>
                                                                        @else
                                                                            <img width="100"
                                                                                src="{{ Avatar::create($review->customer->fname)->toBase64() }}" />
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="comment-main-area">
                                                                    <div class="comment-wrapper">
                                                                        <div class="comments-meta">
                                                                            <h4>{{ $review->customer->fname }}
                                                                                {{ $review->customer->lname }}</h4>
                                                                            <div class="rating-product">
                                                                                @for ($i = 1; $i <= $review->star; $i++)
                                                                                    <i class="fi flaticon-star"></i>
                                                                                @endfor
                                                                                @for ($i = 1; $i <= 5 - $review->star; $i++)
                                                                                    <i class="fa fa-star-o"></i>
                                                                                @endfor
                                                                            </div>
                                                                            <span class="comments-date">
                                                                                {{ $review->updated_at->format('M d') }},
                                                                                {{ $review->updated_at->format('Y') }} at
                                                                                {{ $review->updated_at->format('h:i A') }}</span>
                                                                            {{-- <span class="comments-date">December 30, 2022
                                                                                at
                                                                                3:12 pm</span> --}}
                                                                        </div>
                                                                        <div class="comment-area">
                                                                            <p>{{ $review->review }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ol>
                                            </div> <!-- end comments-section -->

                                            @auth('customer')
                                                @if (App\Models\OrderProduct::where('customer_id', Auth::guard('customer')->id())->where('product_id', $product->id)->exists())
                                                    @if (App\Models\OrderProduct::where('customer_id', Auth::guard('customer')->id())->whereNotNull('review')->first() ==
                                                            false)
                                                        <div class="col col-lg-10 col-12 review-form-wrapper">
                                                            <div class="review-form">
                                                                <h4>Add a review</h4>
                                                                @if (session('review'))
                                                                    <div class="alert alert-success">{{ session('review') }}
                                                                    </div>
                                                                @endif
                                                                <form action="{{ route('review.store', $product->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="give-rat-sec">
                                                                        <div class="give-rating">
                                                                            <label>
                                                                                <input type="radio" name="stars"
                                                                                    value="1">
                                                                                <span class="icon">★</span>
                                                                            </label>
                                                                            <label>
                                                                                <input type="radio" name="stars"
                                                                                    value="2">
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                            </label>
                                                                            <label>
                                                                                <input type="radio" name="stars"
                                                                                    value="3">
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                            </label>
                                                                            <label>
                                                                                <input type="radio" name="stars"
                                                                                    value="4">
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                            </label>
                                                                            <label>
                                                                                <input type="radio" name="stars"
                                                                                    value="5">
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                                <span class="icon">★</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    @error('stars')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                    <div>
                                                                        <textarea name="review" class="form-control" placeholder="Write Comment..."></textarea>
                                                                        @error('review')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="name-input">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Name" disabled
                                                                            value="{{ Auth::guard('customer')->user()->fname }} {{ Auth::guard('customer')->user()->lname }}">
                                                                    </div>
                                                                    <div class="name-email">
                                                                        <input type="email" class="form-control"
                                                                            placeholder="Email"
                                                                            value="{{ Auth::guard('customer')->user()->email }}"
                                                                            disabled>
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
                                                    @else
                                                        <h3 class="alert alert-warning">You Already Review this Product</h3>
                                                    @endif
                                                @else
                                                    <h3 class="alert alert-warning">You did not purchase this product yet </h3>
                                                @endif
                                            @endauth

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
@section('footer_script')
    <script>
        $('.color_id').click(function() {
            var color_id = $(this).val();
            var product_id = {{ $product->id }};

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/getsize',
                type: 'POST',
                data: {
                    'color_id': color_id,
                    'product_id': product_id
                },
                success: function(data) {
                    $('.available_size').html(data)

                    $('.size_id').click(function() {
                        var size_id = $(this).val();

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            }
                        });

                        $.ajax({
                            url: '/getquantity',
                            type: 'POST',
                            data: {
                                'color_id': color_id,
                                'product_id': product_id,
                                'size_id': size_id
                            },
                            success: function(data) {
                                $('#quantity').html(data);
                                $('#quantity').removeClass('d-none');
                            }
                        });
                    });
                }
            });
        });
    </script>

    @if (session('cart_success'))
        <script>
            Swal.fire({
                position: 'top-right',
                icon: 'success',
                title: '{{ session('cart_success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endsection
