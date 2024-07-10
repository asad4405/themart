<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    function brand()
    {
        $brands = Brand::all();
        return view('admin.brand.brand',compact('brands'));
    }

    function brand_store(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);

        $brand_logo = $request->brand_logo;
        $extension = $brand_logo->extension();
        $file_name = Str::lower(str_replace(' ','-',$request->brand_name)).random_int(10000,50000).'.'.$extension;

        Image::make($brand_logo)->save(public_path('uploads/brand/'.$file_name));

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_logo' => $file_name,
            'created_at' => Carbon::now(),
        ]);

        return back()->with('success','New Brand Added Successfull!');
    }
}
