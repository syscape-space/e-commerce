@extends('layout.app')




@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Seen Notification </h2>
                </div>

                <div class="pull-right">

                    <a class="btn btn-primary" href="{{ route('notifications') }}"> Back</a>

                </div>

            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif



            <table class="table table-bordered">

                <tr>
                    <th>No</th>
                    <th>notification</th>
                    <th>#</th>
                </tr>

                @forelse ($users->notifications as $key =>$notification)
                    <tr>
                        @if ($notification->read_at !== null)
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $notification->data['message'] }}</td>
                            <td>
                                <a href="{{ route('notifications.markasunread', $notification->id) }}"
                                    class="btn btn-warning">Mark as un read</a>
                                <a href="{{ route('deleteNotification', $notification->id) }}"
                                    class="btn btn-danger">Delete</a>
                            </td>
                        @endif


                    </tr>
                @empty
                @endforelse
            </table>
            <a href="{{ route('markAllAsUnRead.notification') }}" class="btn btn-warning ml-2">Mark all as unread</a>
            <a href="{{ route('deleteAllNotification') }}" class="btn btn-danger pull-right">Delete all</a>
        </div>
    </div>
@endsection
