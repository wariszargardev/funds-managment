@extends('layouts.editor')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 mb-5">
                <div class="card" style="width: 100%;">
                    @if($fund->image != '')
                        <img src="{{asset('/public/funds/'.$fund->image)}}" style="height: 200px" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                        <p class="card-text"><b>Phone number: </b> {{$fund->user->phone_number}}</p>
                        <p class="card-text"><b>Date: </b>{{$fund->date}}</p>
                        <p class="card-text"><b>Received from: </b>{{$fund->received_from}}</p>
                        <p class="card-text"><b>Company name: </b>{{$fund->company_name}}</p>
                        <p class="card-text"><b>Bank name: </b>{{$fund->bank_name}}</p>
                        <p class="card-text"><b>Amount: </b>{{$fund->amount}}</p>
                        <p class="card-text"><b>Payment in: </b>{{$fund->payment_in}}</p>
                        <p class="card-text"><b>Reference by: </b>{{$fund->reference_by}}</p>
                        <p class="card-text"><b>Deposited by: </b>{{$fund->deposited_by}}</p>
                        <p class="card-text"><b>Amount type: </b>{{$fund->amount_type}}</p>
                        <p class="card-text"><b>Cheque / pay order no: </b>{{$fund->cheque_pay_order_no}}</p>
                        <p class="card-text"><b>Province: </b>{{$fund->province}}</p>
                        <p class="card-text"><b>City: </b>{{$fund->city}}</p>
                        <p class="card-text"><b>Country: </b>{{$fund->country}}</p>
                        <p class="card-text"><b>Address: </b>{{$fund->address}}</p>
                        <p class="card-text"><b>Created at: </b>{{$fund->created_at}}</p>
                        <p class="card-text"><b>Updated at: </b>{{$fund->updated_at}}</p>
                        <div class="text-center">
                            <button type="button" onclick="history.back()" class="btn btn-secondary">
                                {{ __('Cancel') }}
                            </button>
                            <a href="{{ route('editor.funds.edit',$fund->id) }}" class="btn btn-outline-primary">Edit</a>
                            <a href="{{ route('editor.funds.destroy',$fund->id) }}"  onclick="return confirm('Are you sure?')" class="btn btn-outline-secondary">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
