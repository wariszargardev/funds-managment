@extends('layouts.editor')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Funds add') }}</div>

                    <div class="card-body" id="updateNewForm">
                        <form method="POST" action="{{ route('editor.funds.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                @include('component.messages')
                            </div>
                            <div class="row mb-3">

                                <div class="col-lg-6">
                                    <label for="phoneNumber" class="col-lg-4 col-form-label text-md-left">{{ __('Phone number') }}</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="phone_number" value="{{old('phone_number')}}" autocomplete="phone" id="phoneNumber"  autofocus>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Received From') }}</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="received_from" value="{{old('received_from')}}" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Date(mm/dd/yyyy)') }}</label>
                                    <div class="col-lg-12">
                                        <input  placeholder="mm/dd/yyyy"  type="date" class="form-control" name="date" value="{{old('date') == '' ? Carbon\Carbon::now()->format('Y-m-d') : ''}}" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Company name') }}</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="company_name" value="{{old('company_name')}}" >
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Email') }}</label>
                                    <div class="col-lg-12">
                                        <input type="email" class="form-control" name="email" value="{{old('email')}}" >
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Amount') }}</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="amount" value="{{old('amount')}}" >
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Reference by') }}</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="reference_by" value="{{old('reference_by')}}" >
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="name" class=" col-lg-4 col-form-label text-md-left form-label   ">{{ __('Payment in') }}</label>
                                    <select class="form-select" aria-label="Default select example" name="payment_in">
                                        <option value="USD" {{old('payment_in') == 'USD' ? 'selected' : ''}} >USD</option>
                                        <option value="EUR" {{old('payment_in') == 'EUR' ? 'selected' : ''}}>EUR</option>
                                        <option value="GBP" {{old('payment_in') == 'GBP' ? 'selected' : ''}}>GBP</option>
                                        <option value="CAD" {{old('payment_in') == 'CAD' ? 'selected' : ''}}>CAD</option>
                                        <option value="AUD" {{old('payment_in') == 'AUD' ? 'selected' : ''}}>AUD</option>
                                        <option value="INR" {{old('payment_in') == 'INR' ? 'selected' : ''}}>INR</option>
                                        <option value="PKR" {{old('payment_in') == 'PKR' ? 'selected' : ''}}>PKR</option>
                                        <option value="CNY" {{old('payment_in') == 'CNY' ? 'selected' : ''}}>CNY</option>
                                        <option value="JPY" {{old('payment_in') == 'JPY' ? 'selected' : ''}}>JPY</option>
                                        <option value="QAR" {{old('payment_in') == 'QAR' ? 'selected' : ''}}>QAR</option>
                                    </select>
                                </div>

                                <div class="col-lg-12">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Deposited by') }}</label>
                                    <div class="col-lg-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="deposited_by" id="deposited_by1"  {{old('deposited_by') == 'Bank draft' ? 'checked' : ''}} value="Bank draft" checked>
                                            <label class="form-check-label" for="deposited_by1">Bank draft</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="deposited_by" id="deposited_by2" {{old('deposited_by') == 'Pay order' ? 'checked' : ''}} value="Pay order">
                                            <label class="form-check-label" for="deposited_by2">Pay order</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="deposited_by" id="deposited_by3" {{old('deposited_by') == 'Cheque' ? 'checked' : ''}} value="Cheque">
                                            <label class="form-check-label" for="deposited_by3">Cheque</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="deposited_by" id="deposited_by4" {{old('deposited_by') == 'Cash' ? 'checked' : ''}} value="Cash">
                                            <label class="form-check-label" for="deposited_by4">Cash</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="deposited_by" id="deposited_by5" {{old('deposited_by') == 'Online' ? 'checked' : ''}} value="Online">
                                            <label class="form-check-label" for="deposited_by5">Online</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="deposited_by" id="deposited_by6" {{old('deposited_by') == 'Paypal' ? 'checked' : ''}} value="Paypal">
                                            <label class="form-check-label" for="deposited_by6">Paypal</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="deposited_by" id="deposited_by7" {{old('deposited_by') == 'Stripe' ? 'checked' : ''}} value="Stripe">
                                            <label class="form-check-label" for="deposited_by7">Stripe</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="deposited_by" id="deposited_by8" {{old('deposited_by') == 'With in country' ? 'checked' : ''}} value="With in country">
                                            <label class="form-check-label" for="deposited_by8">With in country</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 mt-2" >
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Bank name') }}</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="bank_name" value="{{old('bank_name')}}" >

                                    </div>
                                </div>

                                <div class="col-lg-6 mt-2">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Cheque / Pay Order No') }}</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="cheque_pay_order_no" value="{{old('cheque_pay_order_no')}}" >

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Mode of Payment') }}</label>
                                    <div class="col-lg-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="amount_type" id="amount_type1"  {{old('amount_type')  == 'Zakat' ? 'checked':""}} value="Zakat">
                                            <label class="form-check-label" for="amount_type1">Zakat</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="amount_type" id="amount_type2" {{old('amount_type')  == 'Sadqa' ? 'checked':""}} value="Sadqa">
                                            <label class="form-check-label" for="amount_type2">Sadqa</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="amount_type" id="amount_type3" {{old('amount_type')  == 'Donation' ? 'checked':""}} value="Donation" checked>
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
                                    <label for="land_line_number" class="col-lg-4 col-form-label text-md-left">{{ __('Land line number') }}</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="land_line_number" value="{{old('land_line_number')}}"  id="land_line_number"  >
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Country') }}</label>
                                    <div class="col-lg-12">
                                        <select class="form-select" aria-label="Default select example" name="country_id" id="countrydrp">
                                            @foreach($countries as $country)
                                                <option  value="{{$country->id}}" {{old('country_id') ==  $country->id ? 'selected' : $country->id == 167 ? 'selected' :''}}>
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
                                                <option  value="{{$province->id}}" {{old('province_id') ==  $province->id ? 'selected' : $province->id == 3176 ? 'selected' :''}}>
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
                                                <option  value="{{$city->id}}" {{old('city_id') ==  $city->id ? 'selected' : $city->id == 85572 ? 'selected' :''}}>
                                                    {{$city->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Address') }}</label>
                                    <div class="col-lg-12">
                                        <textarea type="text" class="form-control" name="address" rows="3">{{old('address')}}</textarea>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#phoneNumber").keyup(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('editor.funds.check_is_exists_phone_number')  }}",
                    method: 'get',
                    data: {
                        phoneNumber: $('#phoneNumber').val(),
                    },
                    success: function(result){
                        if(result.status == 200){
                            $('#updateNewForm').empty()
                            $('#updateNewForm').append(result.view)
                            callAfterLoad();
                        }
                    }});
            });
            callAfterLoad();
        });
        function callAfterLoad(){

            $("#countrydrp").on('change',function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('loadProvinceCity')  }}",
                    method: 'get',
                    data: {
                        countryId: $('#countrydrp').val(),
                    },
                    success: function(result){
                        if(result.status == 200){
                            $('#provincedrp').empty()
                            $('#citydrp').empty()
                            $('#provincedrp').append(result.view)
                        }
                    }});
            });

            $("#provincedrp").on('change',function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('loadProvinceCity')  }}",
                    method: 'get',
                    data: {
                        province: $('#provincedrp').val(),
                    },
                    success: function(result){
                        if(result.status == 200){
                            $('#citydrp').empty()
                            $('#citydrp').append(result.view)
                        }
                    }});
            });
        }
    </script>
@endsection
