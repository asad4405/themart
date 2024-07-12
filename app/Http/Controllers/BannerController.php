<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    function banner()
    {
        $categories = Category::all();
        $banners = Banner::all();
        return view('admin.banner.banner', compact('categories','banners'));
    }

    function banner_store(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);

        $image = $request->image;
        $extension = $image->extension();
        $file_name = 'banner-' . random_int(10000, 50000) . '.' . $extension;

        Image::make($image)->save(public_path('uploads/banner/' . $file_name));

        Banner::insert([
            'title' => $request->title,
            'image' => $file_name,
            'category_id' => $request->category_id,
            'created_at' => Carbon::now(),
        ]);

        return back()->with('banner_success', 'Banner Added!');
    }

    function banner_delete($banner_id)
    {
        Banner::find($banner_id)->delete();
        return back()->with('banner_delete','Banner Deleted!');
    }
}
