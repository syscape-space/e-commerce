@extends('admin.layouts.main')


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 ml-4 text-gray-800">Brand</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">brands</li>
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
          <h6 class="m-0 font-weight-bold text-primary">All Brands</h6>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th>SN</th>                
                <th>logo</th>
                <th>Name</th>
                <th>Vendor</th>
                <th>Products count</th>
                <th>Action</th>  
              </tr>
            </thead>
                    
            <tbody>
              @if(count($brands)>0)
              @foreach($brands as $key=> $brand)
              <tr>
                <td><a href="#">{{$key+1}}</a></td>
                <td>
                  <img src="/storage/brands_logo/{{$brand->logo}}" width="100">
                </td>
                <td>{{$brand->name}}</td>
                <td>{{$brand->vendor->name}}</td>
                <td>{{$brand->products->count()}}
                </td>
                <td><a href="{{ route('brand.soft.delete',$brand->id)}}" class="btn btn-danger">Delete</a>
                  <a class="btn btn-info" href="{{ route('brand.show',$brand->id) }}">Show</a>
                </td>

                 
              </tr>
              @endforeach
              @else
              <td>No brand created yet!</td>
              @endif
            

            </tbody>
          </table>
        </div>
      </div>
    </div>

 @endsection