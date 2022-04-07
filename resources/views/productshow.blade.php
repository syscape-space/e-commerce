@extends('layout.app')

@section('content')


    <div class="container">



        <div class="card">
            <div class="row">
                <aside class="col-sm-5 border-right">
                    <section class="gallery-wrap">
                        <div class="img-big-wrap">
                            <div> <a href="#">
                                    <img src="../storage/products_image/{{$product->image}}" width="450"></a>
                            </div>
                        </div>

                    </section>
                </aside>



                <aside class="col-sm-7">
                    <section class="card-body p-5">
                        <h3 class="title mb-3">{{ $product->name }} </h3>

                        <p class="price-detail-wrap">
                            <span class="price h3 text-danger">
                                <span class="currency">US $</span>
                                {{ $product->price }}
                            </span>

                        </p> <!-- price-detail-wrap .// -->
                        <h3>Description</h3>
                        <p>{!! $product->description !!}</p>


                        <hr>


                        <a href="{{ route('cart.store', $product->id) }}" class="btn btn-sm btn-outline-primary">Add to cart</a>
                    </section>
                </aside>

            </div>
        </div>

        @if (count($productFromSameCategory) > 0)
            <div class="jumbotron">
                <h3>You may like </h3>

                <div class="row">

                    @foreach ($productFromSameCategory as $product)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="../storage/products_image/{{$product->image}}" height="200" style="width: 100%">



                                <div class="card-body">
                                    <p><b>{{ $product->name }}</b></p>
                                    <p class="card-text">
                                        {{ Str::limit($product->description, 30) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ route('product.view', $product->id) }}"> <button type="button"
                                                    class="btn btn-sm btn-outline-success">View</button>
                                            </a>
                                            <a href="{{ route('cart.store', $product->id) }}" class="btn btn-sm btn-outline-primary">Add to cart</a>
                                        </div>
                                        <small class="text-muted">${{ $product->price }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        @endif


    </div>

@endsection
