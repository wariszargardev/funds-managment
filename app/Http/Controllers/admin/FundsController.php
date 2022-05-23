<?php

namespace App\Http\Controllers\admin;

use App\Exports\FundsExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class FundsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){
        $funds = new UserInfo();
        if ($request->date){
            $funds = $funds->where('date',Carbon::parse($request->date)->format('Y-m-d'));
        }
        if ($request->searchText){
            $searchText = $request->searchText;
            $funds = $funds->where('received_from', 'like', '%' . $searchText. '%');
            $funds = $funds->orWhere('company_name', 'like', '%' . $searchText. '%');
            $funds = $funds->orWhere('bank_name', 'like', '%' . $searchText. '%');
            $funds = $funds->orWhere('deposited_by', 'like', '%' . $searchText. '%');
        }
        $funds = $funds->get();
        return view('admin.funds.index',compact('funds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $funds = User::with('userInfos')->find($id);
        return view('admin.funds.show',compact('funds'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function export($id=null)
    {
        if ($id==null) {
            $funds = UserInfo::all();
        }
        else{
            $funds = UserInfo::where('user_id',$id)->get();
        }
        $data = array();
        foreach ($funds as $fund){
            $temp  = array();
            $temp[] = $fund->id;
            $temp[] = $fund->email;
            $temp[] = $fund->user->phone_number;
            $temp[] = $fund->received_from;
            $temp[] = $fund->company_name;
            $temp[] = $fund->bank_name;
            $temp[] = '$'.$fund->amount;
            $temp[] = $fund->deposited_by;
            $temp[] = $fund->amount_type;
            $temp[] = $fund->date;
            $temp[] = $fund->cheque_pay_order_no;
            $temp[] = $fund->address;
            $data[] = $temp;
        }
        return Excel::download(new FundsExport($data), 'funds.xlsx');
    }

}
