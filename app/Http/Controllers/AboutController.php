<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\About_gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{
    function admin_about()
    {
        $abouts = About::all();
        return view('admin.about.about',compact('abouts'));
    }

    function admin_about_store(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);

        $preview = $request->preview;
        $extension = $preview->extension();
        $file_name = 'about' . random_int(1000, 5000) . '.' . $extension;

        Image::make($preview)->save(public_path('uploads/about/' . $file_name));

        $about_id = About::insertGetId([
            'heading' => $request->heading,
            'details' => $request->details,
            'preview' => $file_name,
            'created_at' => Carbon::now(),
        ]);

        $galleries = $request->about_gallery;

        foreach ($galleries as $gallery) {
            $extension = $gallery->extension();
            $file_name = $about_id . 'about-gallery' . random_int(1000, 5000) . '.' . $extension;

            Image::make($gallery)->save(public_path('uploads/about_galleries/' . $file_name));

            About_gallery::insert([
                'about_id' => $about_id,
                'about_gallery' => $file_name,
                'created_at' => Carbon::now(),
            ]);
        }

        return back()->with('success', 'About Added!');
    }

    function admin_about_delete($id)
    {
        About::find($id)->delete();
        return back();
    }
}
