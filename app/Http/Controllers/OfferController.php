<?php

namespace App\Http\Controllers;

use App\Models\Offer_one;
use App\Models\Offer_two;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class OfferController extends Controller
{
    function offer()
    {
        $offer_ones = Offer_one::all();
        $offer_twos = Offer_two::all();
        return view('admin.offer.offer', compact('offer_ones', 'offer_twos'));
    }

    function offer_one_update(Request $request, $offer_one_id)
    {
        $request->validate([
            '*' => 'required',
        ]);

        if ($request->image == '') {
            Offer_one::find($offer_one_id)->update([
                'title' => $request->title,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'date' => $request->date,
            ]);
            return back()->with('offer_one_success','Offer One Updated');
        } else {
            $offer_one = Offer_one::find($offer_one_id);
            $current = public_path('uploads/offer/' . $offer_one->image);
            unlink($current);

            $image = $request->image;
            $extension = $image->extension();
            $file_name = 'offer_one-' . random_int(1000, 9000) . '.' . $extension;

            Image::make($image)->save(public_path('uploads/offer/' . $file_name));

            Offer_one::find($offer_one_id)->update([
                'title' => $request->title,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'image' => $file_name,
                'date' => $request->date,
            ]);
            return back()->with('offer_one_success','Offer One Updated');
        }
    }

    function offer_two_update(Request $request, $offer_two_id)
    {
        $request->validate([
            '*' => 'required',
        ]);

        if ($request->image == '') {
            Offer_two::find($offer_two_id)->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
            ]);
            return back()->with('offer_two_success', 'Offer Two Updated');
        } else {
            $offer_two = Offer_two::find($offer_two_id);
            $current = public_path('uploads/offer/' . $offer_two->image);
            unlink($current);

            $image = $request->image;
            $extension = $image->extension();
            $file_name = 'offer_two-' . random_int(1000, 9000) . '.' . $extension;

            Image::make($image)->save(public_path('uploads/offer/' . $file_name));

            Offer_two::find($offer_two_id)->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'image' => $file_name,
            ]);
            return back()->with('offer_two_success', 'Offer Two Updated');
        }
    }
}
