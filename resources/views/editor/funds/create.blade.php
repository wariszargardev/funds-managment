@extends('layouts.editor')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Funds add') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('editor.funds.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                @include('component.messages')
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Received From') }}</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="received_from" value="{{old('received_from')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Date') }}</label>
                                    <div class="col-lg-12">
                                        <input type="date" class="form-control" name="date" value="{{old('date')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Company name') }}</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="company_name" value="{{old('company_name')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Phone number') }}</label>
                                    <div class="col-lg-12">
                                        <input id="name" type="text" class="form-control" name="phone_number" value="{{old('phone_number')}}" required  autofocus>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Email') }}</label>
                                    <div class="col-lg-12">
                                        <input type="email" class="form-control" name="email" value="{{old('email')}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Amount') }}</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="amount" value="{{old('amount')}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Address') }}</label>
                                    <div class="col-lg-12">
                                        <textarea type="text" class="form-control" name="address" rows="3">{{old('address')}}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Deposited by') }}</label>
                                    <div class="col-lg-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="deposited_by" id="deposited_by1" checked value="Bank draft">
                                            <label class="form-check-label" for="deposited_by1">Bank draft</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="deposited_by" id="deposited_by2" value="Pay order">
                                            <label class="form-check-label" for="deposited_by2">Pay order</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="deposited_by" id="deposited_by3" value="Cheque">
                                            <label class="form-check-label" for="deposited_by3">Cheque</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="deposited_by" id="deposited_by4" value="Cash">
                                            <label class="form-check-label" for="deposited_by4">Cash</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="deposited_by" id="deposited_by5" value="Online">
                                            <label class="form-check-label" for="deposited_by5">Online</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Bank name') }}</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="bank_name" value="{{old('bank_name')}}" required>

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Cheque / Pay Order No') }}</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="cheque_pay_order_no" value="{{old('cheque_pay_order_no')}}" required>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="name" class="col-lg-4 col-form-label text-md-left">{{ __('Deposited by') }}</label>
                                    <div class="col-lg-12">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="amount_type" id="amount_type1" checked value="Zakat">
                                            <label class="form-check-label" for="amount_type1">Zakat</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="amount_type" id="amount_type2" value="Sadqa">
                                            <label class="form-check-label" for="amount_type2">Sadqa</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="amount_type" id="amount_type3" value="Donation">
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
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-5">
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
@endsection