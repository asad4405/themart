@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Subscriber Lists</h3>
                </div>
                <div class="card-body">
                    @if (session('subscribe_delete'))
                        <div class="alert alert-success">{{ session('subscribe_delete') }}</div>
                    @endif
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($subscribes as $subscribe)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $subscribe->email }}</td>
                                <td>
                                    <a href="{{ route('subscribe.delete', $subscribe->id) }}" class="btn btn-danger btn-icon">
                                        <i data-feather="trash"></i>
                                    </a>
                                    <a href="" class="btn btn-success">Send Offer</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-danger text-center">No Suscribers Available!</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
