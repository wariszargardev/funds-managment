<?php

namespace App\Http\Controllers\editor;

use App\Http\Controllers\Controller;
use App\Mail\FundsMail;
use App\Models\City;
use App\Models\Country;
use App\Models\Province;
use App\Models\User;
use App\Models\UserInfo;
use Exception;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FundsController extends Controller
{
    public $validate_field = [
        'phone_number' => ['required', 'string' ,'max:255'],
        'received_from' => ['required', 'string', 'max:255'],
        'date' => ['required', 'date'],
        'company_name' => ['required', 'string' ,'max:255'],
        'email' => ['nullable', 'string'],
        'amount' => ['required', 'string'],
        'reference_by' => ['required', 'string'],
        'payment_in' => ['required', 'string'],
        'deposited_by' => ['required'],
        'bank_name' => ['required', 'string','max:255'],
        'cheque_pay_order_no' => ['required', 'string','max:255'],
        'amount_type' => ['required'],
        'image' => ['required', 'mimes:png,jpeg,jpg'],
        'address' => ['required', 'string'],
        'province_id' => ['required', 'string'],
        'city_id' => ['required', 'string'],
        'country_id' => ['required', 'string'],
        'land_line_number' => ['required', 'string'],
    ];

    public function index(){
        $user_id= Auth::guard('editor')->id();
        $funds = User::where('editor_id',$user_id)->pluck('id')->toArray();
        $funds = UserInfo::whereIn('user_id',$funds)->orderBy('id','desc')->paginate(30);
        return view('editor.funds.index',compact('funds'));
    }

    public function create(Request $request){
        $countries= Country::all();
        $provinces = Province::where('country_id',$request->country == null ? 167 :$request->country)->get();
        $cities = City::where('state_id',$request->province == null ? 3176 :$request->province)->get();
        return view('editor.funds.create', compact('countries','provinces', 'cities'));
    }

    public function store(Request $request){
        $fields = $this->validate_field;
        if(!in_array($request->deposited_by, ['Bank draft','Pay order'])){
            unset($fields['cheque_pay_order_no']);
            unset($fields['image']);
        }
        $request->validate($fields);

        $phone_number = $request->phone_number;
        $user = User::where(['phone_number'=>$phone_number,'editor_id'=>Auth::guard('editor')->id()])->first();
        if (!$user){
            $user = User::create([
                'phone_number' =>$phone_number,
                'editor_id'=>Auth::guard('editor')->id(),
            ]);
        }

        $file_name =  $this->uploadMediaFile($request, 'image','funds');
        $user_info = UserInfo::create([
            'received_from'=>$request->received_from,
            'company_name'=>$request->company_name,
            'address'=>$request->address,
            'bank_name'=>$request->bank_name,
            'amount'=>$request->amount,
            'deposited_by'=>$request->deposited_by,
            'amount_type'=>$request->amount_type,
            'user_id'=>$user->id,
            'image'=>$file_name ?? '',
            'date'=>$request->date,
            'email'=>$request->email,
            'cheque_pay_order_no'=>$request->cheque_pay_order_no ?? '',
            'payment_in' => $request->payment_in,
            'reference_by' => $request->reference_by,
            'street' => '',
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'country_id' => $request->country_id,
            'land_line_number' => $request->land_line_number,
        ]);
        if (env('IS_ENABLED_SEND_EMAIL') == 1){
            try {
                Mail::to($request->email)->send(new FundsMail($user_info));
            }
            catch (Exception $ex){

            }
        }
        if (env('IS_ENABLED_SEND_SMS') == 1 && $phone_number ==  '+923086529243'){
            try {
                $message = 'Thanks you for your donation of amount $'.$request->amount;
                $this->sendMessage($message,'+923086529243');

            }
            catch (Exception $exception){
            }

        }
        return redirect()->route('editor.funds.index')->withSuccess('Record save successfully');

    }

    public function show($id){
        $fund = UserInfo::find($id);
        return view('editor.funds.show',compact('fund'));
    }

    public function showAll($id){
        $funds = User::with('userInfos')->find($id);
        return view('editor.funds.show_all',compact('funds'));
    }

    public function edit($id){
        $fund = UserInfo::find($id);
        $countries= Country::all();
        $provinces = Province::where('country_id',$fund->country_id)->get();
        $cities = City::where('state_id',$fund->province_id)->get();
        return view('editor.funds.edit',compact('fund','countries','cities','provinces'));
    }

    public function update(Request $request, $id){
        $fields = $this->validate_field;
        if(!in_array($request->deposited_by, ['Bank draft','Pay order'])){
            unset($fields['cheque_pay_order_no']);
            unset($fields['image']);
        }
        else{
            unset($fields['image'][0]);
        }
        $request->validate($fields);
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
        $user_info->image = $file_name ?? '';
        $user_info->date = $request->date;
        $user_info->email = $request->email;
        $user_info->cheque_pay_order_no = $request->cheque_pay_order_no ?? '';
        $user_info->payment_in = $request->payment_in;
        $user_info->reference_by = $request->reference_by;
        $user_info->street = '';
        $user_info->province_id = $request->province_id;
        $user_info->city_id = $request->city_id;
        $user_info->country_id = $request->country_id;
        $user_info->land_line_number = $request->land_line_number;
        $user_info->save();
        return redirect()->route('editor.funds.index')->withSuccess('Record update successfully');
    }

    public function uploadMediaFile($file, $input_name, $location)
    {
        if ($file->hasFile($input_name)) {
            ini_set('memory_limit', '-1');
            $file = $file->file($input_name);
            $file_name = time().$file->getClientOriginalName();
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

    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients,
            ['from' => $twilio_number, 'body' => $message] );
    }

    public function checkIsPhoneNumberExists(Request $request){
        $phoneNumber =  $request->phoneNumber;
        $user = User::where('phone_number',$phoneNumber)->get()->first();
        if ($user){
            $fund = $user->userInfos->last();
            $countries= Country::all();
            $provinces = Province::where('country_id',$fund->country_id)->get();
            $cities = City::where('state_id',$fund->province_id)->get();
            $view =  view('editor.funds.create_pre_filled_form',compact('fund','countries','provinces','cities'))->render();
            return response()->json(['view'=> $view, 'status' => 200]);
        }
    }
}
