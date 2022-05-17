@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Editor list') }}
                        <a href="{{ route('admin.editor.create') }}"  class="btn btn-outline-primary float-end">+ Add new editor</a>
                    </div>
                    @include('component.messages')
                    <div class="card-body">
                        @if (count($editors) != 0)
                            <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($editors as $editor)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1  }}</th>
                                    <td>{{ $editor->name }}</td>
                                    <td>{{ $editor->email }}</td>
                                    <td>{{ $editor->phone_number }}</td>
                                    <td>
                                        <a href="{{ route('admin.editor.edit',$editor->id) }}" class="btn btn-outline-primary">Edit</a>
                                        <a href="{{ route('admin.editor.destroy',$editor->id) }}"  onclick="return confirm('Are you sure?')" class="btn btn-outline-secondary">Delete</a>
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
