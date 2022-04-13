@extends('layout.app')

@section('content')
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif


        <div class="card">
            <div class="card-header">Search For product</div>
            <div class="card-body">

                <livewire:search />

            </div>
        </div>
    </div>
    {{-- <div class="card">
    <div class="card-header">Search By Category</div>
    <div class="card-body">
      @foreach (App\Models\Category::all() as $cat)
        <a href="{{route('product.category',$cat->name)}}"> 
          <button class="btn btn-secondary">{{$cat->name}}</button>
        </a>
      @endforeach

</div>
  </div> --}}

    <div class="album py-5 bg-light">
        <div class="container">
            <h2>Products</h2>
            <div class="row">

                @forelse($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img src="storage/products_image/{{ $product->image }}" height="200" style="width: 100%">
                            <div class="card-body">
                                <p><b>{{ $product->name }}</b></p>
                                <p class="card-text">
                                    {{ Str::limit($product->description, 30) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('product.view', $product->id) }}"><button type="button"
                                                class="btn btn-sm btn-outline-success">View</button></a>
                                        <a href="{{ route('cart.store', $product->id) }}"
                                            class="btn btn-sm btn-outline-primary">Add to cart</a>
                                    </div>
                                    <small class="text-muted">{{ $product->price }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <p><b>No products to show</b></p>
                            </div>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

    <div class="jumbotron">
        <h2>You May like</h2>

        <div id="carouselExampleFade" class="carousel slide " data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        @foreach ($randomActiveProducts as $product)
                            <div class="col-4">
                                <div class="card mb-4 shadow-sm">
                                    <img src="storage/products_image/{{ $product->image }}" height="200"
                                        style="width: 100%">
                                    <div class="card-body">
                                        <p><b>{{ $product->name }}</b></p>
                                        <p class="card-text">
                                            {{ Str::limit($product->description, 30) }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="{{ route('product.view', $product->id) }}"><button type="button"
                                                        class="btn btn-sm btn-outline-success">View</button></a>
                                                <a href="{{ route('cart.store', $product->id) }}"
                                                    class="btn btn-sm btn-outline-primary">Add to cart</a>
                                            </div>
                                            <small class="text-muted">{{ $product->price }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="row">
                        @foreach ($randomItemProducts as $product)
                            <div class="col-4">
                                <div class="card mb-4 shadow-sm">
                                    <img src="storage/products_image/{{ $product->image }}" height="200"
                                        style="width: 100%">
                                    <div class="card-body">
                                        <p><b>{{ $product->name }}</b></p>
                                        <p class="card-text">
                                            {{ Str::limit($product->description, 30) }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="{{ route('product.view', [$product->id]) }}"><button
                                                        type="button"
                                                        class="btn btn-sm btn-outline-success">View</button></a>
                                                <a href="{{ route('cart.store', $product->id) }}"
                                                    class="btn btn-sm btn-outline-primary">Add to cart</a>
                                            </div>
                                            <small class="text-muted">{{ $product->price }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>
    </div>
    <footer class="text-muted">
        <div class="container">
            <p class="float-right">
                <a href="#">Back to top</a>
            </p>
            <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
            <p>New to Bootstrap? <a href="https://getbootstrap.com/">Visit the homepage</a> or read our <a
                    href="/docs/4.4/getting-started/introduction/">getting started guide</a>.</p>
        </div>
    </footer>
    </div>
@endsection
