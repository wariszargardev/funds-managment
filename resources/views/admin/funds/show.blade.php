@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 mb-5">
                <div class="card" style="width: 100%;">
                    <img src="{{('/funds/'.$fund->image)}}" style="height: 200px" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text"><b>Phone number: </b>{{$fund->user->phone_number}}</p>
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
                        <p class="card-text"><b>Street: </b>{{$fund->street}}</p>
                        <p class="card-text"><b>Province: </b>{{$fund->province}}</p>
                        <p class="card-text"><b>City: </b>{{$fund->city}}</p>
                        <p class="card-text"><b>Country: </b>{{$fund->country}}</p>
                        <p class="card-text"><b>Address: </b>{{$fund->address}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
