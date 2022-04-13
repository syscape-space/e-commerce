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
                                        <th>Order number</th>
                                        <th>Status</th>
                                        <th>Item count</th>
                                        <th>Price</th>
                                        <th>Shipping Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $subOrder)
                                        <tr>
                                            <td scope="row">
                                                {{ $subOrder->order_number }}
                                            </td>
                                            <td>
                                                {{ $subOrder->status }}
                                            </td>

                                            <td>
                                                {{ $subOrder->item_count }}
                                            </td>

                                            <td>
                                                ${{ $subOrder->grand_total }}
                                            </td>

                                            <td>
                                                {{ $subOrder->shipping_address }}
                                            </td>

                                            <td>
                                                @if ($subOrder->status != 'approved')
                                                    <a href=" {{ route('order.delete', $subOrder->id) }} "
                                                        class="btn btn-danger btn-sm">Delete</button>
                                                @endif

                                                @if ($subOrder->status == 'approved')
                                                    <a href=" {{ route('order.delivered', $subOrder->id) }} "
                                                        class="btn btn-success btn-sm">Mard as
                                                        delivered</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>No Order Added</td>
                                        </tr>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
