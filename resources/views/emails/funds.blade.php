@component('mail::message')

<div class="row justify-content-center mb-5">
    <h3 class="text-center">Thanks for your donation</h3>
    <h3>Donation info</h3>
    <div class="col-md-4 mb-5">
        <div class="card" style="width: 100%;">
            <img src="{{('/funds/'.$fund->image)}}" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><b>Phone number: </b>{{$fund->user->phone_number}}</p>
                <p class="card-text"><b>Date: </b>{{$fund->date}}</p>
                <p class="card-text"><b>Received from: </b>{{$fund->received_from}}</p>
                <p class="card-text"><b>Company name: </b>{{$fund->company_name}}</p>
                <p class="card-text"><b>Bank name: </b>{{$fund->bank_name}}</p>
                <p class="card-text"><b>Amount: </b>{{$fund->amount}}</p>
                <p class="card-text"><b>Deposited by: </b>{{$fund->deposited_by}}</p>
                <p class="card-text"><b>Amount type: </b>{{$fund->amount_type}}</p>
                <p class="card-text"><b>Cheque / pay order no: </b>{{$fund->cheque_pay_order_no}}</p>
                <p class="card-text"><b>Address: </b>{{$fund->address}}</p>
            </div>
        </div>
    </div>
</div>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
