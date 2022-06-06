<form method="POST" action="{{ route('editor.funds.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        @include('component.messages')
    </div>

    <div class="row mb-3">

        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Phone number') }}</label>
            <div class="col-lg-12">
                <input id="name" type="text" class="form-control" name="phone_number" value="{{$fund->user->phone_number}}"  autofocus>
            </div>
        </div>

        <input type="hidden" name="prefilled" value="1" />
        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Received From') }}</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" name="received_from" value="{{$fund->received_from}}" >
            </div>
        </div>
        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Date') }}</label>
            <div class="col-lg-12">
                <input type="date" class="form-control" name="date" value="{{$fund->date}}" >
            </div>
        </div>
        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Company name') }}</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" name="company_name" value="{{$fund->company_name}}" >
            </div>
        </div>

        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Email') }}</label>
            <div class="col-lg-12">
                <input type="email" class="form-control" name="email" value="{{$fund->email}}" >
            </div>
        </div>

        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Amount') }}</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" name="amount" value="{{$fund->amount}}" >
            </div>
        </div>

        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Reference by') }}</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" name="reference_by" value="{{$fund->reference_by}}" >
            </div>
        </div>

        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label mt-2 text-md-left">{{ __('Payment in') }}</label>
            <div class="col-lg-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_in" id="payment_in1" {{$fund->payment_in == 'PKR' ? "checked" : ''}}  value="PKR">
                    <label class="form-check-label" for="payment_in1">PKR</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_in" id="payment_in2" {{$fund->payment_in == '$' ? "checked" : ''}} value="$">
                    <label class="form-check-label" for="payment_in2">USD</label>
                </div>
            </div>
        </div>


        <div class="col-lg-6">

        </div>
        <div class="col-lg-12">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Deposited by') }}</label>
            <div class="col-lg-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{$fund->deposited_by == 'Bank draft' ? "checked" : ''}} type="radio" name="deposited_by" id="deposited_by1" value="Bank draft">
                    <label class="form-check-label" for="deposited_by1">Bank draft</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{$fund->deposited_by == 'Pay order' ? "checked" : ''}} type="radio" name="deposited_by" id="deposited_by2" value="Pay order">
                    <label class="form-check-label" for="deposited_by2">Pay order</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{$fund->deposited_by == 'Cheque' ? "checked" : ''}} type="radio" name="deposited_by" id="deposited_by3" value="Cheque">
                    <label class="form-check-label" for="deposited_by3">Cheque</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{$fund->deposited_by == 'Cash">' ? "checked" : ''}} type="radio" name="deposited_by" id="deposited_by4" value="Cash">
                    <label class="form-check-label" for="deposited_by4">Cash</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{$fund->deposited_by == 'Online' ? "checked" : ''}} type="radio" name="deposited_by" id="deposited_by5" value="Online">
                    <label class="form-check-label" for="deposited_by5">Online</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="deposited_by" id="deposited_by6" {{$fund->deposited_by == 'Paypal' ? "checked" : ''}}  value="Paypal">
                    <label class="form-check-label" for="deposited_by6">Paypal</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="deposited_by" id="deposited_by7" {{$fund->deposited_by == 'Stripe' ? "checked" : ''}}  value="Stripe">
                    <label class="form-check-label" for="deposited_by7">Stripe</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="deposited_by" id="deposited_by8" {{$fund->deposited_by == 'With in country' ? "checked" : ''}}  value="With in country">
                    <label class="form-check-label" for="deposited_by8">With in country</label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Bank name') }}</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" name="bank_name" value="{{$fund->bank_name}}" >

            </div>
        </div>

        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Cheque / Pay Order No') }}</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" name="cheque_pay_order_no" value="{{$fund->cheque_pay_order_no}}" >

            </div>
        </div>
        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Deposited by') }}</label>
            <div class="col-lg-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="amount_type" id="amount_type1"  {{$fund->amount_type == "Zakat" ? 'checked' : '' }} value="Zakat">
                    <label class="form-check-label" for="amount_type1">Zakat</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="amount_type" id="amount_type2" {{$fund->amount_type ==  "Sadqa" ? 'checked' : ''}} value="Sadqa">
                    <label class="form-check-label" for="amount_type2">Sadqa</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="amount_type" id="amount_type3" {{$fund->amount_type ==  "Donation" ? 'checked' : ''}} value="Donation">
                    <label class="form-check-label" for="amount_type3">Donation</label>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Image') }}</label>
            <div class="col-lg-12">
                <input type="file" class="form-control" name="image" />
            </div>
        </div>

        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Street') }}</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" name="street" value="{{$fund->street}}" >
            </div>
        </div>

        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Province') }}</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" name="province" value="{{$fund->province}}" >
            </div>
        </div>

        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('City') }}</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" name="city" value="{{$fund->city}}" >
            </div>
        </div>

        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Country') }}</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" name="country" value="{{$fund->country}}" >
            </div>
        </div>


        <div class="col-lg-12">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Address') }}</label>
            <div class="col-lg-12">
                <textarea type="text" class="form-control" name="address" rows="3">{{$fund->address}}</textarea>
            </div>
        </div>

    </div>


    <div class="row mb-0">
        <div class="col-md-6 offset-md-5">
            <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
            </button>
        </div>
    </div>
</form>
