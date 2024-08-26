<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TagController extends Controller
{
    function tag()
    {
        $tags = Tag::all();
        return view('admin.tag.tag',compact('tags'));
    }
    function tag_store(Request $request)
    {
        $request->validate([
            'tag_name' => 'required',
        ]);

        Tag::insert([
            'tag_name' => $request->tag_name,
            'created_at' => Carbon::now(),
        ]);

        return back()->with('success','New Tag Added!');
    }

    function tag_delete($id)
    {
        Tag::where('id',$id)->delete();
        return back();
    }
}
