<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPhotoRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class UserController extends Controller
{
    public function user_update()
    {
        return view('admin.user.profile');
    }

    public function user_update_post(Request $request)
    {
        User::find(Auth::id())->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return back()->with('user_update', 'Profile Updated Successfull!');
    }

    public function password_update(UserRequest $request)
    {
        $user = User::find(Auth::id());

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);

            return back()->with('password_update', 'Password Updated Successfull!');
        } else {
            return back()->with('password_wrong', 'Current Password Wrong');
        }
    }

    public function photo_update(UserPhotoRequest $request)
    {

        if (Auth::user()->photo == null) {
            $photo = $request->photo;
            $exension = $photo->extension();
            $file_name = Auth::id() . '.' . $exension;

            Image::make($photo)->save(public_path('uploads/user/' . $file_name));

            User::find(Auth()->id())->update([
                'photo' => $file_name,
            ]);

            return back()->with('photo_update', 'Photo Udated Successfull!');
        } else {
            $current_img = public_path('uploads/user/' . Auth::user()->photo);
            unlink($current_img);

            $photo = $request->photo;
            $exension = $photo->extension();
            $file_name = Auth::id() . '.' . $exension;

            Image::make($photo)->save(public_path('uploads/user/' . $file_name));

            User::find(Auth()->id())->update([
                'photo' => $file_name,
            ]);

            return back()->with('photo_update', 'Photo Udated Successfull!');
        }
    }
}
