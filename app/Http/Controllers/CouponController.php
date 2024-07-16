<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function coupon()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.coupon',compact('coupons'));
    }

    function coupon_store(CouponRequest $request)
    {
        Coupon::insert([
            'coupon' => $request->coupon,
            'type' => $request->type,
            'amount' => $request->amount,
            'validity' => $request->validity,
            'limit' => $request->limit,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('coupon_success','Coupon Added!');
    }

    function coupon_status($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        if($coupon->status == 1){
            $coupon->update([
                'status' => 0,
            ]);
            return back();
        }else{
            $coupon->update([
                'status' => 1,
            ]);
            return back();
        }
    }

    function coupon_delete($coupon_id)
    {
        Coupon::find($coupon_id)->delete();
        return back()->with('coupon_delete','Coupon Deleted!');
    }

}
