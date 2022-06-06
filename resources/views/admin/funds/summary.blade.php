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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Search by number</label>
                                    <input type="text" placeholder="Search by number" name="searchText" class="form-control" value="{{request()->searchText}}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Sort by</label>
                                <select id="sort_by" class="form-select" name="sort_by" aria-label="Default select example">
                                    <option {{request()->sort_by == '' ? 'selected' :''}}>Sort by</option>
                                    <option value="total_entry"  {{request()->sort_by == 'total_entry' ? 'selected' :''}}>Entries</option>
                                    <option value="last_entry_date"  {{request()->sort_by == 'last_entry_date' ? 'selected' :''}}>Last date</option>
                                    <option value="account_status"  {{request()->sort_by == 'account_status' ? 'selected' :''}}>Status</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label>Status filter</label>
                                <select id="sort_by" class="form-select" name="filter" aria-label="Default select example">
                                    <option value="all" {{request()->filter == '' ? 'selected' :''}}>All</option>
                                    <option value="Active"  {{request()->filter == 'Active' ? 'selected' :''}}>Active</option>
                                    <option value="In-active"  {{request()->filter == 'In-active' ? 'selected' :''}}>In-active</option>
                                    <option value="Dormant"  {{request()->filter == 'Dormant' ? 'selected' :''}}>Dormant</option>
                                </select>
                            </div>
                            <div class="col-md-3">
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
                                                <a style="text-decoration: none " @class('btn btn-outline-info') href="{{ route('admin.funds.show.all',$user->id) }}" >  Show </a>                                              {{ $fund->user->phone_number??'' }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="navbar-brand" >No record found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
