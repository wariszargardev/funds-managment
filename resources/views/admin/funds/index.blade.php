@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Funds list') }}
                        <form method="get" action="{{route('admin.funds.export')}}">
                            <button class="btn btn-outline-info float-end" type="submit">Excel Download</button>
                            <input type="hidden" name="column_name" value="{{request()->column_name}}" />
                            <input type="hidden" name="searchText" value="{{request()->searchText}}" />
                            <input type="hidden" name="from_date" value="{{request()->from_date}}" />
                            <input type="hidden" name="end_date" value="{{request()->end_date}}" />
                            <input type="hidden" name="sort_by_column" value="{{request()->sort_by_column}}" />
                            <input type="hidden" name="sort_by" value="{{request()->sort_by}}" />
                        </form>
                    </div>
                    <form method="get" id="date-filter">
                        <div class="row container mt-2">
                            <div class="col-md-3">
                                <label>Search based on</label>
                                <select class="form-select" name="column_name" aria-label="Default select example">
                                    <option value="received_from" {{request()->column_name == '' ? 'received_from' :''}}>Received from</option>
                                    <option value="phone_number" {{request()->column_name == 'phone_number' ? 'selected' :''}}>Phone number</option>
                                    <option value="company_name" {{request()->column_name == 'company_name' ? 'selected' :''}}>Company name</option>
                                    <option value="email" {{request()->column_name == 'email' ? 'selected' :''}}>Email</option>
                                    <option value="bank_name" {{request()->column_name == 'bank_name' ? 'selected' :''}}>Bank name</option>
                                    <option value="reference_by" {{request()->column_name == 'reference_by' ? 'selected' :''}}>Reference by</option>
                                    <option value="province" {{request()->column_name == 'province' ? 'selected' :''}}>Province</option>
                                    <option value="city" {{request()->column_name == 'city' ? 'selected' :''}}>City</option>
                                    <option value="country" {{request()->column_name == 'country' ? 'selected' :''}}>Country</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Search</label>
                                    <input type="text" placeholder="Search" name="searchText" class="form-control" value="{{request()->searchText}}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>From date(mm/dd/yyyy)</label>
                                    <input placeholder="mm/dd/yyyy" type="date" name="from_date" class="form-control" value="{{request()->from_date}}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>End date(mm/dd/yyyy)</label>
                                    <input  placeholder="mm/dd/yyyy"  type="date" name="end_date" class="form-control" value="{{request()->end_date}}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Sort based on</label>
                                <select class="form-select" name="sort_by_column" aria-label="Default select example">
                                    <option value="received_from" {{request()->sort_by_column == '' ? 'received_from' :''}}>Received from</option>
                                    <option value="phone_number" {{request()->sort_by_column == 'phone_number' ? 'selected' :''}}>Phone number</option>
                                    <option value="company_name" {{request()->sort_by_column == 'company_name' ? 'selected' :''}}>Company name</option>
                                    <option value="email" {{request()->sort_by_column == 'email' ? 'selected' :''}}>Email</option>
                                    <option value="bank_name" {{request()->sort_by_column == 'bank_name' ? 'selected' :''}}>Bank name</option>
                                    <option value="reference_by" {{request()->sort_by_column == 'reference_by' ? 'selected' :''}}>Reference by</option>
                                    <option value="province" {{request()->sort_by_column == 'province' ? 'selected' :''}}>Province</option>
                                    <option value="city" {{request()->sort_by_column == 'city' ? 'selected' :''}}>City</option>
                                    <option value="country" {{request()->sort_by_column == 'country' ? 'selected' :''}}>Country</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Search based on</label>
                                <select class="form-select" name="sort_by" aria-label="Default select example">
                                    <option value="asc" {{request()->sort_by == 'asc' ? 'selected' :''}}>Ascending </option>
                                    <option value="desc" {{request()->sort_by == 'desc' ? 'selected' :''}}>Descending </option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button @class('btn btn-info mt-4') type="submit"> Search</button>
                            </div>
                        </div>
                    </form>
                    <div class="card-body table-responsive">
                        @if (count($funds) != 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Phone number</th>
                                    <th scope="col">Received from</th>
                                    <th scope="col">Company name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Bank name</th>
                                    <th scope="col">Reference by</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date(y-m-d)</th>
                                    <th scope="col">Updated at </th>
                                    <th scope="col">Province</th>
                                    <th scope="col">City</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($funds as $fund)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1  }}</th>
                                            <td><a style="text-decoration: none" href="{{ route('admin.funds.show.all',$fund->user->id) }}" >{{ $fund->user->phone_number??'' }}</a></td>
                                            <td>{{ $fund->received_from }}</td>
                                            <td>{{ $fund->company_name }}</td>
                                            <td>{{ $fund->email }}</td>
                                            <td>{{ $fund->bank_name }}</td>
                                            <td>{{ $fund->reference_by }}</td>
                                            <td>{{ $fund->amount }}</td>
                                            <td>{{ $fund->date }}</td>
                                            <td>{{ $fund->updated_at}}</td>
                                            <td>{{ $fund->province }}</td>
                                            <td>{{ $fund->city }}</td>
                                            <td>{{ $fund->country }}</td>
                                            <td><a href="{{ route('admin.funds.show',$fund->id) }}" class="btn btn-outline-primary">Show</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="navbar-brand" >No record found.</p>
                        @endif
                    </div>
                    @if ($funds->hasPages())
                        <div class="d-flex justify-content-center">
                            {!! $funds->links() !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
