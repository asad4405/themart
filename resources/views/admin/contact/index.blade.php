@extends('layouts.admin')
@section('title')
    Contact List
@endsection
@section('content')
    <div class="row">
        <div class="m-auto col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h3>Contact List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($contacts as $contact)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>
                                    <a href="{{ route('contact.show',$contact->id) }}" class="btn btn-primary">Show Message</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-danger">No Contacts Available!</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
