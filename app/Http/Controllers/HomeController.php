<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function user_list()
    {
        $users = User::where('id','!=', Auth::id())->get();
        return view('admin.user.user_list',compact('users'));
    }

    public function user_delete($user_id)
    {
        User::find($user_id)->delete();
        return back()->with('user_delete','User Deleted Successfull!');
    }

    public function user_add(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);
        if($request->password != $request->confirm_password){
            return back()->with('pass_match','Password & Confirm Password does not Match!');
        }

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return back()->with('success','New User Added!');
    }
}
