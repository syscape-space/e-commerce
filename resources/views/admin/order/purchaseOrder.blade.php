@extends('admin.layouts.main')


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 ml-4 text-gray-800">Order</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('AdminDashbord')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Order</li>
            <li class="breadcrumb-item active" aria-current="page">purchase Order</li>

        </ol>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-info">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Order List</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>SN</th>
                                <th>Order Number</th>
                                <th>User name</th>
                                <th>Item count</th>
                                <th>Price</th>
                                <th>Actions</th>

                            </tr>
                        </thead>

                        <tbody>
                            @if (count($orders) > 0)
                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <td><a href="#">{{ $key + 1 }}</a></td>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->item_count }}</td>
                                        <td>${{ $order->grand_total }}</td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('order.accept', $order->id) }}">Accept</a>
                                            <a class="btn btn-danger"
                                                href="{{ route('order.decline', $order->id) }}">Decline</a>

                                        </td>


                                    </tr>
                                @endforeach
                            @else
                                <td>No Order added yet!</td>
                            @endif


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @endsection
