<?php

namespace App\Http\Controllers\editor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FundsController extends Controller
{
    public function index(){
        $user_id= Auth::guard('editor')->id();
        $funds = User::where('editor_id',$user_id)->pluck('id')->toArray();
        $funds = UserInfo::whereIn('user_id',$funds)->get();
        return view('editor.funds.index',compact('funds'));
    }

    public function create(){
        return view('editor.funds.create');
    }

    public function store(Request $request){
        $request->validate([
            'received_from' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'company_name' => ['required', 'string' ,'max:255'],
            'phone_number' => ['required', 'string' ,'max:255'],
            'address' => ['nullable', 'string'],
            'amount' => ['required', 'string'],
            'bank_name' => ['required', 'string','max:255'],
            'cheque_pay_order_no' => ['required', 'string','max:255'],
            'image' => ['nullable', 'mimes:png,jpeg,jpg'],
        ]);

        $phone_number = $request->phone_number;
        $user = User::where('phone_number',$phone_number)->first();
        if (!$user){
            $user = User::create([
                'phone_number' =>$phone_number,
                'editor_id'=>Auth::guard('editor')->id(),
            ]);
        }

        $file_name =  $this->uploadMediaFile($request, 'image','funds');
        UserInfo::create([
            'received_from'=>$request->received_from,
            'company_name'=>$request->company_name,
            'address'=>$request->address,
            'bank_name'=>$request->bank_name,
            'amount'=>$request->amount,
            'deposited_by'=>$request->deposited_by,
            'amount_type'=>$request->amount_type,
            'user_id'=>$user->id,
            'image'=>$file_name,
            'date'=>$request->date,
            'cheque_pay_order_no'=>$request->cheque_pay_order_no,
        ]);

        return redirect()->route('editor.funds.index')->withSuccess('Record save successfully');

    }

    public function show($id){
        $funds = User::with('userInfos')->find($id);
        return view('editor.funds.show',compact('funds'));
    }

    public function edit($id){
        $fund = UserInfo::find($id);
        return view('editor.funds.edit',compact('fund'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'received_from' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'company_name' => ['required', 'string' ,'max:255'],
            'address' => ['nullable', 'string'],
            'amount' => ['required', 'string'],
            'bank_name' => ['required', 'string','max:255'],
            'cheque_pay_order_no' => ['required', 'string','max:255'],
            'image' => ['nullable', 'mimes:png,jpeg,jpg'],
        ]);
        $user_info =UserInfo::find($id);
        $file_name = $user_info->image;
        if ($request->hasFile('image')) {
            $file_name = $this->uploadMediaFile($request, 'image', 'funds');
        }

            $user_info->received_from = $request->received_from;
            $user_info->company_name = $request->company_name;
            $user_info->address = $request->address;
            $user_info->bank_name = $request->bank_name;
            $user_info->amount = $request->amount;
            $user_info->deposited_by = $request->deposited_by;
            $user_info->amount_type = $request->amount_type;
            $user_info->image = $file_name;
            $user_info->date = $request->date;
            $user_info->cheque_pay_order_no = $request->cheque_pay_order_no;

        $user_info->save();
        return redirect()->route('editor.funds.index')->withSuccess('Record update successfully');

    }

    public function uploadMediaFile($file, $input_name, $location)
    {
        if ($file->hasFile($input_name)) {
            ini_set('memory_limit', '-1');
            $file = $file->file($input_name);
            $file_name = time() . '.' . $file->getClientOriginalName();
            $file->move($location, $file_name);
            return $file_name;
        }
    }

    public function destroy($id){
        $user_info =UserInfo::find($id);
        $user_info_count =UserInfo::where('user_id',$user_info->user_id)->count();
        if ($user_info_count == 1 || $user_info_count ==  0){
            User::find($user_info->user_id)->delete();
        }
        $user_info->delete();
        return redirect()->back()->withSuccess('Funds deleted successfully');
    }

}
