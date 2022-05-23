@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Funds list') }}
                    </div>
                    <form method="get" id="date-filter">
                        <div class="row container mt-2">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Search</label>
                                    <input type="text" placeholder="Search" name="searchText" class="form-control" value="{{request()->searchText}}" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Select date</label>
                                    <input type="date" name="date" class="form-control" value="{{request()->date}}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button @class('btn btn-info mt-4') type="submit"> Search</button>
                            </div>
                        </div>
                    </form>
                    <div class="card-body">
                        @if (count($funds) != 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Phone number</th>
                                    <th scope="col">Received from</th>
                                    <th scope="col">Company name</th>
                                    <th scope="col">Bank name</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($funds as $fund)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1  }}</th>
                                            <td>
                                                <a style="text-decoration: none" href="{{ route('admin.funds.show',$fund->user->id) }}" >                                                {{ $fund->user->phone_number??'' }}</a>
                                            </td>
                                            <td>{{ $fund->received_from }}</td>
                                            <td>{{ $fund->company_name }}</td>
                                            <td>{{ $fund->bank_name }}</td>
                                            <td>${{ $fund->amount }}</td>
                                            <td>
                                                {{ $fund->date }}</td>
                                            <td>
                                                <a href="{{ route('admin.funds.show',$fund->user->id) }}" class="btn btn-outline-primary">Show</a>
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
