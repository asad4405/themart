@extends('layouts.admin')
@section('title')
    Contact Show
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Contact List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Header</th>
                            <th>Details</th>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{ $contact->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $contact->email }}</td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td>{{ $contact->phone }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{ $contact->adress }}</td>
                        </tr>
                        <tr>
                            <td>Message</td>
                            <td class="my-2">{{ $contact->message }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
