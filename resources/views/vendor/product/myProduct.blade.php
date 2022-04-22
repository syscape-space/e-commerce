@extends('vendor.layouts.main')


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 ml-4 text-gray-800">Product</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Products</li>
        <li class="breadcrumb-item active" aria-current="page">View</li>

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
          <h6 class="m-0 font-weight-bold text-primary">All Products</h6>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th>SN</th>                
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Vendor</th>
                <th>Brand</th>
                <th>Actions</th>
                        
              </tr>
            </thead>
                    
            <tbody>
              @if(count($products)>0)
              @foreach($products as $key=> $product)
              <tr>
                <td><a href="#">{{$key+1}}</a></td>
                <td>
                  <img src="/storage/products_image/{{$product->image}}" width="60">
                </td>
                <td>{{$product->name}}</td>
                <td>{!!  $product->description !!}</td>
                <td>${{$product->price}}</td>
                <td>{{$product->category->name}}</td>
                <td>{{$product->vendor->name}}</td>
                <td>{{$product->brand->name}}</td>
                <td>
                  @if(Auth::user()->id==$product->vendor_id)
                  <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                  @endif
                  <a class="btn btn-info" href="{{ route('vendor.products.show',$product->id) }}">Show</a>
                  <a href="{{ route('product.vendor.soft.delete',$product->id)}}" class="btn btn-warning">SoftDelete</a>
                </td>

                 
              </tr>
              @endforeach
              @else
              <td>No product created yet!</td>
              @endif
            

            </tbody>
          </table>
        </div>
      </div>
    </div>

 @endsection