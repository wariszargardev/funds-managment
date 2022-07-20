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
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Date(mm/dd/yyyy)') }}</label>
            <div class="col-lg-12">
                <input type="date"  placeholder="mm/dd/yyyy"  class="form-control" name="date" value="{{old('date') == '' ? Carbon\Carbon::now()->format('Y-m-d') : ''}}" >
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
            <label for="name" class=" col-lg-4 col-form-label text-md-left form-label   ">{{ __('Payment in') }}</label>
            <select class="form-select" aria-label="Default select example" name="payment_in">
                <option value="USD" {{$fund->payment_in == 'USD' ? 'selected' : ''}} >USD</option>
                <option value="EUR" {{$fund->payment_in == 'EUR' ? 'selected' : ''}}>EUR</option>
                <option value="GBP" {{$fund->payment_in == 'GBP' ? 'selected' : ''}}>GBP</option>
                <option value="CAD" {{$fund->payment_in == 'CAD' ? 'selected' : ''}}>CAD</option>
                <option value="AUD" {{$fund->payment_in == 'AUD' ? 'selected' : ''}}>AUD</option>
                <option value="INR" {{$fund->payment_in == 'INR' ? 'selected' : ''}}>INR</option>
                <option value="PKR" {{$fund->payment_in == 'PKR' ? 'selected' : ''}}>PKR</option>
                <option value="CNY" {{$fund->payment_in == 'CNY' ? 'selected' : ''}}>CNY</option>
                <option value="JPY" {{$fund->payment_in == 'JPY' ? 'selected' : ''}}>JPY</option>
                <option value="QAR" {{$fund->payment_in == 'QAR' ? 'selected' : ''}}>QAR</option>
            </select>
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
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Mode of Payment') }}</label>
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
            <label for="land_line_number" class="col-lg-4 col-form-label text-md-left">{{ __('Telephone Number') }}</label>
            <div class="col-lg-12">
                <input type="text" class="form-control" name="land_line_number" value="{{$fund->land_line_number}}"  id="land_line_number"  >
            </div>
        </div>

        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Country') }}</label>
            <div class="col-lg-12">
                <select class="form-select" aria-label="Default select example" name="country_id" id="countrydrp">
                    @foreach($countries as $country)
                        <option  value="{{$country->id}}" {{$fund->country_id ==  $country->id ? 'selected' : ''}}>
                            {{$country->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Province') }}</label>
            <div class="col-lg-12">
                <select class="form-select" aria-label="Default select example" name="province_id" id="provincedrp">
                    @foreach($provinces as $province)
                        <option  value="{{$province->id}}" {{$fund->province_id ==  $province->id ? 'selected' : ''}}>
                            {{$province->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-6">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('City') }}</label>
            <div class="col-lg-12">
                <select class="form-select" aria-label="Default select example" name="city_id" id="citydrp">
                    @foreach($cities as $city)
                        <option  value="{{$city->id}}" {{$fund->city_id ==  $city->id ? 'selected' : ''}}>
                            {{$city->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-lg-12">
            <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Address') }}</label>
            <div class="col-lg-12">
                <textarea type="text" class="form-control" name="address" rows="3">{{$fund->address}}</textarea>
            </div>
        </div>

    </div>



    <div class="row mb-0 mt-3">
        <div class="col-md-3 offset-md-5">
            <button type="button" onclick="history.back()" class="btn btn-secondary">
                {{ __('Cancel') }}
            </button>

            <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
            </button>

        </div>
    </div>
</form>
