@extends('admin.layouts.main')

@section('content')

        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Show SubCategory {{$subcategory->name}}</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Subategory</li>
              <li class="breadcrumb-item active" aria-current="page">{{$subcategory->name}}</li>
            </ol>
          </div>



      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $subcategory->name }}         
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Category:</strong>
                {{ $subcategory->categories->name }}
            </div>
        </div>

        <div class="card-footer"></div>
              </div>
       </div>
  @endsection