@extends('admin.layouts.main')

@section('content')

        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Category</li>
              <li class="breadcrumb-item active" aria-current="page">Trash</li>
            </ol>
          </div>

@if ($message = Session::get('success'))
  <div class="alert alert-danger">
      <p>{{ $message }}</p>
  </div>
@endif

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All Trashed Products</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>SN</th>                
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Vendor</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($products)>0)
                      @foreach($products as $key=> $product)
                      <tr>

                        <td>{{$key+1}}</td>
                        <td>{{$product->name}}</td>
                        <td>{!!  $product->description !!}</td>
                        <td>${{$product->price}}</td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->vendor_id}}</td>
                        <td>
                          <a class="btn btn-primary" href="{{ route('products.back',$product->id)}}">Back</a>
                          <a class="btn btn-danger" href="{{ route('products.hard.delete',$product->id)}}">Delelte</a>
                           
                        </td>

                      </tr>
                      @endforeach

                      @else
                      <td>No product moved to trash yet!</td>
                      @endif
                      
                    </tbody>
                  </table>
                  
                  {!! $products->links() !!}
                
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->
        </div>
  @endsection