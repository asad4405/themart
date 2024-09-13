<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\About_gallery;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Color;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Inventory;
use App\Models\Offer_one;
use App\Models\Offer_two;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductGrallery;
use App\Models\Size;
use App\Models\Subscribe;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class FrontendController extends Controller
{
    function api_category()
    {
        $categories = file_get_contents('http://127.0.0.1:8000/api/get/category');
        $categories = json_decode($categories);
        return view('api_cat', compact('categories'));
    }

    function index()
    {
        $banners = Banner::all();
        $categories = Category::all();
        $offer_ones = Offer_one::all();
        $offer_twos = Offer_two::all();
        $products = Product::latest()->take(8)->get();
        $trending_products = Product::all();
        $recent_products = Product::latest()->take(3)->get();
        return view('frontend.index', [
            'banners' => $banners,
            'categories' => $categories,
            'offer_ones' => $offer_ones,
            'offer_twos' => $offer_twos,
            'products' => $products,
            'trending_products' => $trending_products,
            'recent_products' => $recent_products,
        ]);
    }

    function subscribe_store(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);
        Subscribe::insert([
            'customer_id' => 1,
            'email' => $request->email,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    function product_details($slug)
    {
        $product_id = Product::where('slug', $slug)->first()->id;
        $product = Product::find($product_id);
        $galleries = ProductGrallery::where('product_id', $product->id)->get();
        $available_colors = Inventory::where('product_id', $product->id)
            ->groupBy('color_id')
            ->selectRaw('sum(color_id) as sum, color_id')
            ->get();
        $available_sizes = Inventory::where('product_id', $product->id)
            ->groupBy('size_id')
            ->selectRaw('sum(size_id) as sum, size_id')
            ->get();
        $reviews = OrderProduct::where('product_id', $product->id)->whereNotNull('review')->get();

        // recent view
        $all = Cookie::get('recent-view');
        if (!$all) {
            $all = "[]";
        }
        $all_info = json_decode($all, true);
        $all_info = Arr::prepend($all_info, $product_id);
        $recent_product_id = json_encode($all_info);

        Cookie::queue('recent-view', $recent_product_id, 1000);

        return view('frontend.product_details', [
            'product' => $product,
            'galleries' => $galleries,
            'available_colors' => $available_colors,
            'available_sizes' => $available_sizes,
            'reviews' => $reviews,
        ]);
    }

    function get_size(Request $request)
    {
        $str = '';
        $sizes = Inventory::where([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
        ])->get();
        foreach ($sizes as $size) {
            if ($size->size->size_name == 'NA') {
                $str = '<li class="color"><input checked class="size_id" id="' . $size->size_id . '" type="radio"
                    name="size_id" value=" ' . $size->size_id . ' ">
                    <label for="' . $size->size_id . '">' . $size->size->size_name . '</label>
                    </li>';
            } else {
                $str .= '<li class="color"><input class="size_id" id="' . $size->size_id . '" type="radio"
                    name="size_id" value=" ' . $size->size_id . ' ">
                    <label for="' . $size->size_id . '">' . $size->size->size_name . '</label>
                    </li>';
            }
        }
        echo $str;
    }

    function get_quantity(Request $request)
    {
        $str = '';
        $quantity = Inventory::where([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
        ])->first()->quantity;
        $str = $quantity . ' In Stock';
        echo $str;
    }

    function review_store(Request $request, $product_id)
    {
        $request->validate([
            'review' => 'required',
            'stars' => 'required',
        ]);

        OrderProduct::where([
            'customer_id' => Auth::guard('customer')->id(),
            'product_id' => $product_id,
        ])->first()->update([
            'review' => $request->review,
            'star' => $request->stars,
            'updated_at' => Carbon::now(),
        ]);

        return back()->with('review', 'Review Submitted Successfully!');
    }

    function about()
    {
        $abouts = About::take(1)->get();
        // $about_galleries = About_gallery::where()
        return view('frontend.about',compact('abouts'));
    }

    function shop(Request $request)
    {
        $data = $request->all();

        $based = 'created_at';
        $type = 'DESC';

        if (!empty($data['sort']) && $data['sort'] != '' && $data['sort'] != 'undefined') {
            if ($data['sort'] == 1) {
                $based = 'after_discount';
                $type = 'ASC';
            } elseif ($data['sort'] == 2) {
                $based = 'after_discount';
                $type = 'DESC';
            } elseif ($data['sort'] == 3) {
                $based = 'product_name';
                $type = 'ASC';
            } elseif ($data['sort'] == 4) {
                $based = 'product_name';
                $type = 'DESC';
            }
        }

        $products = Product::where(function ($q) use ($data) {
            $min = 0;
            $max = 0;
            if (!empty($data['min']) && $data['min'] != '' && $data['min'] != 'undefined') {
                $min = $data['min'];
            } else {
                $min = 1;
            }

            if (!empty($data['max']) && $data['max'] != '' && $data['max'] != 'undefined') {
                $max = $data['max'];
            } else {
                $max = Product::max('product_price');
            }

            if (!empty($data['search_input']) && $data['search_input'] != '' && $data['search_input'] != 'undefined') {
                $q->where(function ($q) use ($data) {
                    $q->where('product_name', 'like', '%' . $data['search_input'] . '%');
                    $q->orWhere('short_desp', 'like', '%' . $data['search_input'] . '%');
                    $q->orWhere('long_desp', 'like', '%' . $data['search_input'] . '%');
                    $q->orWhere('addi_info', 'like', '%' . $data['search_input'] . '%');
                });
            }

            if (!empty($data['category_id']) && $data['category_id'] != '' && $data['category_id'] != 'undefined') {
                $q->where(function ($q) use ($data) {
                    $q->where('category_id', $data['category_id']);
                });
            }

            if (!empty($data['tag']) && $data['tag'] != '' && $data['tag'] != 'undefined') {
                $q->where(function ($q) use ($data) {
                    $all = '';
                    foreach (Product::all() as $product) {
                        $exploade = explode(',', $product->tags);
                        if (in_array($data['tag'], $exploade)) {
                            $all .= $product->id . ',';
                        }
                    }
                    $exploade2 = explode(',', $all);
                    $q->find($exploade2);
                });
            }

            if (!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined') {
                $q->whereHas('inventory', function ($q) use ($data) {
                    if (!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined') {
                        $q->whereHas('color', function ($q) use ($data) {
                            $q->where('colors.id', $data['color_id']);
                        });
                    }
                });
            }

            if (!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined' || !empty($data['size_id']) && $data['size_id'] != '' && $data['size_id'] != 'undefined') {
                $q->whereHas('inventory', function ($q) use ($data) {
                    if (!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined') {
                        $q->whereHas('color', function ($q) use ($data) {
                            $q->where('colors.id', $data['color_id']);
                        });
                    }
                    if (!empty($data['size_id']) && $data['size_id'] != '' && $data['size_id'] != 'undefined') {
                        $q->whereHas('size', function ($q) use ($data) {
                            $q->where('sizes.id', $data['size_id']);
                        });
                    }
                });
            }

            if (!empty($data['min']) && $data['min'] != '' && $data['min'] != 'undefined' || !empty($data['max']) && $data['max'] != '' && $data['max'] != 'undefined') {
                $q->whereBetween('product_price', [$min, $max]);
            }
        })->OrderBy($based, $type)->get();



        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $new_products = Product::latest()->take(3)->get();
        $tags = Tag::all();
        return view('frontend.shop', [
            'products' => $products,
            'categories' => $categories,
            'colors' => $colors,
            'sizes' => $sizes,
            'new_products' => $new_products,
            'tags' => $tags,
        ]);
    }

    function contact()
    {
        return view('frontend.contact');
    }

    function contact_post(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);

        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'adress' => $request->adress,
            'phone' => $request->phone,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Message send Successfully!');
    }

    function recent_view()
    {
        $recent_info = json_decode(Cookie::get('recent-view'), true);
        if ($recent_info == NULL) {
            $recent_viewed = [];
        } else {
            $recent_viewed = array_unique($recent_info);
        }
        $recent_view_products = Product::find($recent_viewed);
        return view('frontend.recent_view', compact('recent_view_products'));
    }

    function faqs()
    {
        $faqs = Faq::all();
        return view('frontend.faqs', compact('faqs'));
    }
}
