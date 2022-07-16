<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Editor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile',compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        Redirect::
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['required', 'string' ,'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $admin = Admin::where('email',$request->email)->where('id','!=',Auth::guard('admin')->user()->id)->get()->first();
        if ($admin){
            return redirect()->back()->withErrors(['email_unique'=>'Email already exists']);
        }

        $admin = Auth::guard('admin')->user();
        if($request->password){
            $admin->password = Hash::make($request->password);
        }
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone_number = $request->phone_number;
        $admin->save();

        return redirect()->back()->withSuccess('Profile update successfully');
    }
}
