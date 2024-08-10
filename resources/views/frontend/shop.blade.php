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
                            <li><a href="index.html">Home</a></li>
                            <li>Shop</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <!-- product-area-start -->
    <div class="shop-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="shop-filter-wrap">
                        <div class="filter-item">
                            <div class="shop-filter-item">
                                <div class="shop-filter-search">
                                    <form>
                                        <div>
                                            <input id="search_input2" type="text" class="form-control"
                                                placeholder="Search..">
                                            <button class="search_btn2" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="shop-filter-item category-widget">
                                <h2>Categories</h2>
                                <ul>
                                    @forelse ($categories as $category)
                                        <li>
                                            <label class="topcoat-radio-button__label">
                                                {{ $category->category_name }}
                                                <span>({{ App\Models\Product::where('category_id', $category->id)->count() }})</span>
                                                <input type="radio" name="category_id" value="{{ $category->id }}">
                                                <span class="topcoat-radio-button"></span>
                                            </label>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="shop-filter-item">
                                <h2>Filter by price</h2>
                                <div class="shopWidgetWraper">
                                    <div class="priceFilterSlider">
                                        <form action="#" method="" class="clearfix">
                                            <div class="d-flex">
                                                <div class="col-lg-6 pe-2">
                                                    <label for="" class="form-label">Min</label>
                                                    <input type="text" class="form-control" id="min"
                                                        placeholder="Min">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="" class="form-label">Max</label>
                                                    <input type="text" class="form-control" id="max"
                                                        placeholder="Max">
                                                </div>
                                            </div>
                                            <div class="mt-4 col-lg-12">
                                                <button class="form-control bg-light">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="shop-filter-item">
                                <h2>Color</h2>
                                <ul>
                                    @foreach ($colors as $color)
                                        <li>
                                            <label class="topcoat-radio-button__label">
                                                {{ $color->color_name }}
                                                <span>({{ App\Models\Inventory::where('color_id', $color->id)->count() }})</span>
                                                <input type="radio" name="color_id" value="{{ $color->id }}">
                                                <span class="topcoat-radio-button"></span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="shop-filter-item">
                                <h2>Size</h2>
                                <ul>
                                    @foreach ($sizes as $size)
                                        <li>
                                            <label class="topcoat-radio-button__label">
                                                {{ $size->size_name }}
                                                <span>({{ App\Models\Inventory::where('size_id', $size->id)->count() }})</span>
                                                <input type="radio" name="size_id" value="{{ $size->id }}">
                                                <span class="topcoat-radio-button"></span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="shop-filter-item new-product">
                                <h2>New Products</h2>
                                <ul>
                                    @forelse ($new_products as $new_product)
                                        <li>
                                            <div class="product-card">
                                                <div class="card-image">
                                                    <div class="image">
                                                        <img src="{{ asset('uploads/product') }}/{{ $new_product->preview }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <h3><a
                                                            href="{{ route('product_details', $new_product->slug) }}">{{ $new_product->product_name }}</a>
                                                    </h3>
                                                    <div class="rating-product">
                                                        @php
                                                            $reviews = App\Models\OrderProduct::where(
                                                                'product_id',
                                                                $new_product->id,
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
                                                            <p>No reviews</p>
                                                        @endif
                                                    </div>
                                                    <div class="price">
                                                        <span class="present-price">{{ $new_product->after_discount }}
                                                            Taka</span>
                                                        @if ($new_product->after_discount)
                                                            <del class="old-price">{{ $new_product->product_price }}
                                                                Taka</del>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="shop-filter-item tag-widget">
                                <h2>Popular Tags</h2>
                                <ul>
                                    <li><a href="#">Fashion</a></li>
                                    <li><a href="#">Shoes</a></li>
                                    <li><a href="#">Kids</a></li>
                                    <li><a href="#">Theme</a></li>
                                    <li><a href="#">Stylish</a></li>
                                    <li><a href="#">Women</a></li>
                                    <li><a href="#">Shop</a></li>
                                    <li><a href="#">Men</a></li>
                                    <li><a href="#">Blog</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="shop-section-top-inner">
                        <div class="shoping-product">
                            <p>We found <span>{{ $products->count() }} items</span> for you!</p>
                        </div>
                        <div class="short-by">
                            <ul>
                                <li>
                                    Sort by:
                                </li>
                                <li>
                                    <select name="show" class="sort">
                                        <option value="">Default Sorting</option>
                                        <option value="1">Price Low To High</option>
                                        <option value="2">Price High To Low</option>
                                        <option value="2">A To Z</option>
                                        <option value="2">Z To A</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="row align-items-center">
                            @forelse ($products as $product)
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="product-item">
                                        <div class="image">
                                            <img width="150"
                                                src="{{ asset('uploads/product') }}/{{ $product->preview }}"
                                                alt="">
                                            @if ($product->after_discount)
                                                <div class="tag sale">Sale</div>
                                            @else
                                                <div class="tag new">New</div>
                                            @endif
                                        </div>
                                        <div class="text">
                                            <h2><a
                                                    href="{{ route('product_details', $product->slug) }}">{{ $product->product_name }}</a>
                                            </h2>
                                            <div class="rating-product">
                                                @php
                                                    $reviews = App\Models\OrderProduct::where(
                                                        'product_id',
                                                        $product->id,
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
                                                    <p>No reviews</p>
                                                @endif
                                            </div>
                                            <div class="price">
                                                <span class="present-price">{{ $product->after_discount }} Taka</span>
                                                @if ($product->after_discount)
                                                    <del class="old-price">{{ $product->product_price }} Taka</del>
                                                @endif
                                            </div>
                                            <div class="shop-btn">
                                                <a class="theme-btn-s2"
                                                    href="{{ route('product_details', $product->slug) }}">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div>
                                    <h1>No Product Available</h1>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product-area-end -->
@endsection
@section('footer_script')
    <script>
        $('.search-btn').click(function() {
            var search_input = $('#search_input').val();
            var link = "{{ route('shop') }}" + "?search_input=" + search_input;
            window.location.href = link;
        });
    </script>

    <script>
        $('.search_btn2').click(function() {
            var search_input2 = $('#search_input2').val();
            var link = "{{ route('shop') }}" + "?search_input=" + search_input2;
            window.location.href = link;
        });
    </script>
@endsection
