@extends('layouts.all_parts')


  

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
        </div>
    </div>
</div>

   
@if ($errors->any())
    <div class="card mt-3">
        <div class="card-body">
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                   <p> {{ $error }}<p>
                @endforeach
            </div>
        </div>
    </div>
@endif


   

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">

         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <input type="text" name="description" class="form-control" placeholder="Description">
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Price:</strong>
                <input type="number" name="price" class="form-control" placeholder="Price">
            </div>
        </div>

        {{-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>

                    <option value="1">One</option>
                    
                </select>
            </div>
        </div> --}}

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image:</strong>
                <input type="file" name="image" class="form-control">
            </div>
        </div>
       

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>

    </div>

</form>

@endsection