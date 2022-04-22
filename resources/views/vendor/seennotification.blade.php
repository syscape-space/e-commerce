@extends('vendor.layouts.main')

@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Seen Notification </h2>
        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{route('admin.notifications')}}"> Back</a>

        </div>
        
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
        @if ($notification->read_at!==Null)
        <td>{{ $key+1}}</td>
        <td>{{ $notification->data['message'] }}</td>
        <td>
            <a href="{{ route('notifications.admin.markasunread',$notification->id)}}" class="btn btn-warning">Mark as un read</a>
            <a href="{{ route('admin.deleteNotification',$notification->id)}}" class="btn btn-danger">Delete</a>
        </td>
        @endif
        

    </tr> 
    @empty
        
    @endforelse
</table>
    <a href="{{route('admin.markAllAsUnRead.notification')}}" class="btn btn-warning ml-2">Mark all as unread</a>
    <a href="{{route('adminDeleteAllNotification')}}" class="btn btn-danger pull-right">Delete all</a>
@endsection