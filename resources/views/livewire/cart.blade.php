<div>
    {{-- In work, do what you enjoy. --}}

    <div class="cart-main-area pt-95 pb-100">
        <div class="container">



            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Shopping Cart</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($cartItems) > 0)
                                        @foreach ($cartItems as $key => $item)
                                            <tr>
                                                <td>{{ $item['name'] }}</td>
                                                <td>
                                                    <livewire:cart-update-form :item="$item" :key="$item['id']" />
                                                </td>
                                                <td>${{ Cart::session(auth()->id())->get($item['id'])->getPriceSum() }}
                                                </td>
                                                <td>
                                                    <a class="btn btn-danger"
                                                        href="{{ route('cart.remove', $item['id']) }}">Delete</a>
                                                </td>


                                            </tr>
                                        @endforeach
                                    @else
                                        <td>No product Added to cart</td>
                                    @endif


                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if(Cart::session(auth()->id())->getTotal()!=0)
                    <div class="p-2">
                        <a class="btn btn-danger" href="{{ route('cart.clear') }}">Delete all list</a>
                    </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div>
                    <h2>Cart totals</h2>
                    <ul>
                        <li>Total <span>${{ \Cart::session(auth()->id())->getTotal() }}</span></li>
                    </ul>
                    @if (\Cart::session(auth()->id())->getTotal() != 0)
                        <a class="btn btn-primary" href="{{ route('cart.checkout') }}">Proceed to checkout</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
