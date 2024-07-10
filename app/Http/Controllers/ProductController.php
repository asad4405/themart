<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGrallery;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    function add_product()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        return view('admin.product.index', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'brands' => $brands,
        ]);
    }

    function get_subcategory(Request $request)
    {
        $str = '<option value="">Select Sub Category</option>';
        $subcategories = Subcategory::where('category_id', $request->category_id)->get();
        foreach ($subcategories as $subcategory) {
            $str .= '<option value="' . $subcategory->id . '">' . $subcategory->sub_category_name . '</option>';
        }
        return $str;
    }

    function product_store(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);

        $remove = array("@", "#", "(", ")", "*", "/", " ", "", '"');
        $preview = $request->preview;
        $extension = $preview->extension();
        $file_name = Str::lower(str_replace($remove, '-', $request->product_name)) . random_int(10000, 50000) . '.' . $extension;

        Image::make($preview)->save(public_path('uploads/product/' . $file_name));

        $product_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'discount' => $request->discount,
            'after_discount' => $request->product_price - $request->product_price * $request->discount / 100,
            'tags' => implode(',', $request->tags),
            'short_desp' => $request->short_desp,
            'long_desp' => $request->long_desp,
            'addi_info' => $request->addi_info,
            'preview' => $file_name,
            'created_at' => Carbon::now(),
        ]);

        $galleris = $request->gallery;

        foreach ($galleris as $gallery) {
            $remove = array("@", "#", "(", ")", "*", "/", " ", "", '"');
            $extension = $gallery->extension();
            $file_name = $product_id . '-' . Str::lower(str_replace($remove, '-', $request->product_name)) . random_int(10000, 50000) . '.' . $extension;

            Image::make($gallery)->save(public_path('uploads/gallery/' . $file_name));

            ProductGrallery::insert([
                'product_id' => $product_id,
                'gallery' => $file_name,
                'created_at' => Carbon::now(),
            ]);
        }

        return back()->with('product_success', 'New Product Added Successfull!');
    }

    function product_list()
    {
        $products = Product::all();
        return view('admin.product.list',compact('products'));
    }

    function product_show($product_id)
    {
        $product = Product::find($product_id);
        return view('admin.product.show',compact('product'));
    }

}
