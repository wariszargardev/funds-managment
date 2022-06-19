<?php

namespace App\Http\Controllers\editor;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditorController extends Controller
{

    public function dashboard()
    {
        return view('editor.dashboard');
    }

    public function profile()
    {
        $admin = Auth::guard('editor')->user();
        return view('editor.profile',compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['required', 'string' ,'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);


        $admin = Editor::where('email',$request->email)->where('id','!=',Auth::guard('editor')->user()->id)->get()->first();
        if ($admin){
            return redirect()->back()->withErrors(['email_unique'=>'Email already exists']);
        }


        $admin = Auth::guard('editor')->user();
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
