<?php

namespace App\Http\Controllers\editor;

use App\Exports\FundsExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class FundsSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexOld(Request $request){
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

        $funds = $funds->orderBy('id','desc')->paginate(30);
        return view('editor.fundssummary.index',compact('funds'));
    }

    public function index(Request $request){
        $users = new UserInfo();
        $users = $users->select('user_infos.*');
        $users = $users->join('users', 'user_infos.user_id', '=', 'users.id' );
        $column_name = $request->column_name;
        $searchText = $request->searchText;
        $sort_by_column = $request->sort_by_column;
        $sort_by = $request->sort_by;
        if($column_name != '' && $searchText != ''){
            if ($column_name == 'phone_number'){
                $users = $users->where('users.'.$column_name, 'like', '%' . $searchText. '%');
            }
            else{
                $users = $users->where('user_infos.'.$column_name, 'like', '%' . $searchText. '%');
            }
        }
        if ($request->from_date != '' && $request->end_date != ''){
            $users = $users->whereBetween('user_infos.date', [Carbon::parse($request->from_date)->format('Y-m-d'), Carbon::parse($request->end_date)->format('Y-m-d')]);
        }
        elseif($request->from_date != '' ){
            $users = $users->where('user_infos.date',Carbon::parse($request->from_date)->format('Y-m-d'));
        }
        elseif($request->end_date != ''){
            $users = $users->where('user_infos.date',Carbon::parse($request->end_date)->format('Y-m-d'));
        }

        if($sort_by_column){
            if ($sort_by_column == 'phone_number'){
                $users = $users->orderBy('users.'.$sort_by_column, $sort_by);
            }
            else{
                $users = $users->orderBy('user_infos.'.$sort_by_column, $sort_by);
            }
        }
        else{
            $users = $users->orderBy('users.phone_number', 'asc');
        }
        $funds = $users->paginate(30);
        return view('editor.fundssummary.index',compact('funds'));
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
        $fund = UserInfo::find($id);
        return view('editor.fundssummary.show',compact('fund'));
    }

    public function showAll($id){
        $funds = User::with('userInfos')->find($id);
        return view('editor.fundssummary.show_all',compact('funds'));
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

    public function export(Request $request , $id=null)
    {
        $users = new UserInfo();
        $users = $users->select('user_infos.*');
        $users = $users->join('users', 'user_infos.user_id', '=', 'users.id' );
        $column_name = $request->column_name;
        $searchText = $request->searchText;
        $sort_by_column = $request->sort_by_column;
        $sort_by = $request->sort_by;
        if($column_name != '' && $searchText != ''){
            if ($column_name == 'phone_number'){
                $users = $users->where('users.'.$column_name, 'like', '%' . $searchText. '%');
            }
            else{
                $users = $users->where('user_infos.'.$column_name, 'like', '%' . $searchText. '%');
            }
        }
        if ($request->from_date != '' && $request->end_date != ''){
            $users = $users->whereBetween('user_infos.date', [Carbon::parse($request->from_date)->format('Y-m-d'), Carbon::parse($request->end_date)->format('Y-m-d')]);
        }
        elseif($request->from_date != '' ){
            $users = $users->where('user_infos.date',Carbon::parse($request->from_date)->format('Y-m-d'));
        }
        elseif($request->end_date != ''){
            $users = $users->where('user_infos.date',Carbon::parse($request->end_date)->format('Y-m-d'));
        }

        if($sort_by_column){
            if ($sort_by_column == 'phone_number'){
                $users = $users->orderBy('users.'.$sort_by_column, $sort_by);
            }
            else{
                $users = $users->orderBy('user_infos.'.$sort_by_column, $sort_by);
            }
        }
        else{
            $users = $users->orderBy('users.phone_number', 'asc');
        }

        if ($id==null) {
            $funds = $users->get();
        }
        else{
            $funds = $users->where('users.id',$id)->get();
        }

        $data = array();
        foreach ($funds as $fund){
            $temp  = array();
            $temp[] = $fund->id;
            $temp[] = $fund->user->phone_number;
            $temp[] = $fund->received_from;
            $temp[] = $fund->date;
            $temp[] = $fund->company_name;
            $temp[] = $fund->email;
            $temp[] = $fund->payment_in;
            $temp[] = $fund->amount;
            $temp[] = $fund->reference_by;
            $temp[] = $fund->deposited_by;
            $temp[] = $fund->bank_name;
            $temp[] = $fund->cheque_pay_order_no;
            $temp[] = $fund->amount_type;
            $temp[] = $fund->province;
            $temp[] = $fund->city;
            $temp[] = $fund->country;
            $temp[] = $fund->address;
            $data[] = $temp;
        }
        return Excel::download(new FundsExport($data), 'funds.xlsx');
    }

    public function summaryOld(Request $request){
        $users = new User();
        $users = $users->select('users.*','user_infos.user_id');
        $users = $users->join('user_infos', 'users.id', '=', 'user_infos.user_id');
        $column_name = $request->column_name;
        $searchText = $request->searchText;
        if($column_name != '' && $searchText != ''){
            $users = $users->where('user_infos.'.$column_name, 'like', '%' . $searchText. '%');
        }
        if ($request->from_date != '' && $request->end_date != ''){
            $users = $users->whereBetween('user_infos.date', [Carbon::parse($request->from_date)->format('Y-m-d'), Carbon::parse($request->end_date)->format('Y-m-d')]);
        }
        elseif($request->from_date != '' ){
            $users = $users->where('user_infos.date',Carbon::parse($request->from_date)->format('Y-m-d'));
        }
        elseif($request->end_date != ''){
            $users = $users->where('user_infos.date',Carbon::parse($request->end_date)->format('Y-m-d'));
        }
        $users = $users->groupBy('user_infos.user_id');

        $users = $users->get();
        if($request->sort_by != null && $request->sort_by != ''){
            $users =  $users->sortByDesc($request->sort_by);
        }
        return view('editor.fundssummary.summary',compact('users'));
    }

    public function summary(Request $request){
        $users = new User();
        $users = $users->select('users.*','user_infos.user_id');
        $users = $users->join('user_infos', 'users.id', '=', 'user_infos.user_id');
        $searchText = $request->searchText;
        if($searchText != ''){
            $users = $users->where('users.phone_number', 'like', '%' . $searchText. '%');
        }
        $users = $users->groupBy('user_infos.user_id');
        $users = $users->get();
        if($request->sort_by != null && $request->sort_by != ''){
            $users =  $users->sortByDesc($request->sort_by);
        }
        if ($request->filter != '' && $request->filter != 'all'){
            foreach ($users as $key => $user){
                if ($user->account_status != $request->filter ){
                    $users->forget($key);
                }
            }
        }
        return view('editor.fundssummary.summary',compact('users'));
    }
}
