<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editors = Editor::all();
        return view('admin.editor.index',compact('editors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.editor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:editors'],
            'phone_number' => ['required', 'string' ,'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $admin = Auth::guard('admin')->user();
        $editor = new Editor();
        $editor->name = $request->name;
        $editor->email = $request->email;
        $editor->phone_number = $request->phone_number;
        $editor->password = Hash::make($request->password);
        $editor->admin_id = $admin->id;
        $editor->save();

        return redirect()->route('admin.editor.index')->withSuccess('Editor create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editor = Editor::find($id);
        return view('admin.editor.edit',compact('editor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => ['required', 'string' ,'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);
        $editor = Editor::where('email',$request->email)->where('id','!=',$id)->get()->first();
        if ($editor){
            return redirect()->back()->withErrors(['email_unique'=>'Email already exists']);
        }
        $editor = Editor::find($id);
        if($request->password){
            $editor->password = Hash::make($request->password);
        }
        $editor->name = $request->name;
        $editor->email = $request->email;
        $editor->phone_number = $request->phone_number;
        $editor->save();

        return redirect()->route('admin.editor.index')->withSuccess('Editor update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Editor::find($id)->delete();
        return redirect()->back()->withSuccess('Record deleted successfully');
    }
}
