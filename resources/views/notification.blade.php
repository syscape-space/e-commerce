@extends('layout.app')
@section('content')
    <div class="cart-main-area pt-95 pb-100">
        <div class="container">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif


            <div class="row">

                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Notification </h2>
                        <a href="{{ route('notifications.read') }}" style="float: right;" class="btn btn-primary mb-2">Seen notification</a>
                    </div>
                </div>
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>notification</th>
                                        <th>#</th>
                                    </tr>

                                    @forelse ($users->notifications as $key =>$notification)
                                        <tr>
                                            @if ($notification->read_at === null)
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $notification->data['message'] }}</td>
                                                <td>
                                                    <a class="btn btn-success"
                                                        href="{{ route('notifications.markasread', $notification->id) }}">mark
                                                        as read</a>
                                                    <a href="{{ route('deleteNotification', $notification->id) }}"
                                                        class="btn btn-danger">Delete</a>

                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                    @endforelse
                            </table>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="{{ route('markAllAsRead.notification') }}" class="btn btn-warning ml-2">Mark all
                        as
                        read</a>
                    <a href="{{ route('deleteAllNotification') }}" class="btn btn-danger pull-right">Delete
                        all</a>
                </div>
            </div>
        </div>
    </div>
@endsection
