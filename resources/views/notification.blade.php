@extends('layouts.all_parts')


  

@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">
        <div class="pull-left">

            <h2>Notification </h2>

        </div>

    </div>

</div>



<table class="table table-bordered">

    <tr>
        <th>No</th>
        <th>notification</th>
       <th></th>
    </tr>

    @forelse ($users->notifications as $key =>$notification)
    <tr>
        @if ($notification->read_at===Null)
        <td>{{ $key+1}}</td>
        <td>{{ $notification->data['message'].$notification->data['name'] }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('products.show',$notification->data['product_id']) }}">Show</a>
            <a class="btn btn-success" href="{{ route('notifications.read',$notification->id) }}">mark as read</a>
            {{-- <a href="{{ route('products.soft.delete',$product->id)}}" class="btn btn-warning">SoftDelete</a> --}}

        </td>
        @endif
        

    </tr> 
    @empty
        
    @endforelse

    

</table>
@endsection