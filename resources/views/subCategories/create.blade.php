@extends('layouts.all_parts')


  

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New subCategory</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('subCategories.index') }}"> Back</a>
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


   

<form action="{{ route('subCategories.store') }}" method="POST">
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
                <strong>Category:</strong>
                <input type="text" name="categories_id" class="form-control" placeholder="Category">
            </div>
        </div>

       

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>

    </div>

</form>

@endsection