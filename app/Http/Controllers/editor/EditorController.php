<?php

namespace App\Http\Controllers\editor;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Editor;
use App\Models\Province;
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

    public function loadProvinceCity(Request $request){
        $data = array();
        if($request->countryId){
            $data = Province::where('country_id',$request->countryId)->get();
        }
        if ($request->province){
            $data = City::where('state_id',$request->province)->get();
        }
        $view =  view('editor.funds.make_select_option',compact('data'))->render();
        return response()->json(['view'=> $view, 'status' => 200]);
    }
}
