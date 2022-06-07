@extends('layouts.editor')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Funds list') }}
                        <a href="{{ route('editor.funds.create') }}"  class="btn btn-outline-primary float-end">+ Add new </a>
                    </div>
                    @include('component.messages')
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
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($funds as $fund)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1  }}</th>
                                            <td>
                                                <a style="text-decoration: none" href="{{ route('editor.funds.show.all',$fund->user->id) }}" >                                                {{ $fund->user->phone_number??'' }}</a>
                                            </td>
                                            <td>{{ $fund->received_from }}</td>
                                            <td>{{ $fund->company_name }}</td>
                                            <td>{{ $fund->bank_name }}</td>
                                            <td>${{ $fund->amount }}</td>
                                            <td>
                                                <a href="{{ route('editor.funds.show',$fund->id) }}" class="btn btn-outline-primary">Show</a>
                                                <a href="{{ route('editor.funds.edit',$fund->id) }}" class="btn btn-outline-primary">Edit</a>
                                                <a href="{{ route('editor.funds.destroy',$fund->id) }}"  onclick="return confirm('Are you sure?')" class="btn btn-outline-secondary">Delete</a>
                                            </td>
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
