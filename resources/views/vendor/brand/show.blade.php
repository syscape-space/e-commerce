@extends('vendor.layouts.main')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $brand->name }}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item">Description</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $brand->name }}</li>
            </ol>
        </div>



        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $brand->name }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Logo:</strong>
                    <img src="/storage/brands_logo/{{ $brand->logo }}" alt="" width="100">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>vendor:</strong>
                    {{ $brand->vendor->name }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Products count:</strong>
                    {{$brand->products->count()-\App\Models\Product::whereNull('is_acceptable')->get()->count()}}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Products:</strong>
                    @forelse ($products as $product)
                        <a class="list-group-item list-group-item-action"
                            href="{{ route('vendor.products.show', $product->id) }}">
                            <div class="card mb-3" style="max-width: 700px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="/storage/products_image/{{ $product->image }}"
                                            class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <p class="card-text">{{ $product->description }}</p>
                                            <p class="card-text">Price : <small
                                                    class="text-muted">${{ $product->price }}</small></p>
                                            <p class="card-text"><small
                                                    class="text-muted">{{ $product->updated_at }}</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        This brand doesn't have any product
                    @endforelse
                </div>
            </div>


            <div class="card-footer"></div>
        </div>
    </div>
@endsection
