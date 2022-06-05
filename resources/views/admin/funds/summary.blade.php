@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Funds summary list') }}
                        <a class="btn btn-outline-info float-end" href="{{route('admin.funds.export')}}">Excel Download</a>
                    </div>
                    <form method="get" id="date-filter">
                        <div class="row container mt-2">
                            <div class="col-md-2">
                                <label>Search based on</label>
                                <select class="form-select" name="column_name" aria-label="Default select example">
                                    <option value="received_from" {{request()->column_name == '' ? 'received_from' :''}}>Received from</option>
                                    <option value="company_name" {{request()->column_name == 'company_name' ? 'selected' :''}}>Company name</option>
                                    <option value="email" {{request()->column_name == 'email' ? 'selected' :''}}>Email</option>
                                    <option value="bank_name" {{request()->column_name == 'bank_name' ? 'selected' :''}}>Bank name</option>
                                    <option value="reference_by" {{request()->column_name == 'reference_by' ? 'selected' :''}}>Reference by</option>
                                    <option value="street" {{request()->column_name == 'street' ? 'selected' :''}}>Street</option>
                                    <option value="province" {{request()->column_name == 'province' ? 'selected' :''}}>Province</option>
                                    <option value="city" {{request()->column_name == 'city' ? 'selected' :''}}>City</option>
                                    <option value="country" {{request()->column_name == 'country' ? 'selected' :''}}>Country</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Search</label>
                                    <input type="text" placeholder="Search" name="searchText" class="form-control" value="{{request()->searchText}}" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>Sort by</label>
                                <select id="sort_by" class="form-select" name="sort_by" aria-label="Default select example">
                                    <option {{request()->sort_by == '' ? 'selected' :''}}>Sort by</option>
                                    <option value="total_entry"  {{request()->sort_by == 'total_entry' ? 'selected' :''}}>Entries</option>
                                    <option value="last_entry_date"  {{request()->sort_by == 'last_entry_date' ? 'selected' :''}}>Last date</option>
                                    <option value="account_status"  {{request()->sort_by == 'account_status' ? 'selected' :''}}>Status</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>From date/Single date</label>
                                    <input type="date" name="from_date" class="form-control" value="{{request()->from_date}}" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>End date</label>
                                    <input type="date" name="end_date" class="form-control" value="{{request()->end_date}}" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button @class('btn btn-info mt-4') type="submit"> Search</button>
                            </div>
                        </div>
                    </form>
                    <div class="card-body">
                        @if (count($users) != 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Phone number</th>
                                    <th scope="col">Last entry date(y-m-d)</th>
                                    <th scope="col">Total amount in PKR</th>
                                    <th scope="col">Total amount in Dollar</th>
                                    <th scope="col">Total entries</th>
                                    <th scope="col">Account status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1  }}</th>
                                            <td>{{ $user->phone_number  }}</td>
                                            <td>{{ $user->last_entry_date  }}</td>
                                            <td>{{ $user->total_amount_in_pkr  }}</td>
                                            <td>{{ $user->total_amount_in_dollar  }}</td>
                                            <td>{{ $user->total_entry  }}</td>
                                            <td>{{ $user->account_status  }}</td>
                                            <td>
                                                <a style="text-decoration: none " @class('btn btn-outline-info') href="{{ route('admin.funds.show',$user->id) }}" >  Show </a>                                              {{ $fund->user->phone_number??'' }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="navbar-brand" >No record found.</p>
                        @endif
                    </div>
{{--                    @if ($users->hasPages())--}}
{{--                        <div class="d-flex justify-content-center">--}}
{{--                            {!! $users->links() !!}--}}
{{--                        </div>--}}
{{--                    @endif--}}
                </div>
            </div>
        </div>
    </div>

@endsection
