@extends('layouts.all_parts')
@section('title')

  

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Show SubCategory</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('subCategories.index') }}"> Back</a>

            </div>

        </div>

    </div>

   

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Name:</strong>

                {{ $subCategory->name }}
               
            

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Category:</strong>

                {{ $subCategory->categories_id }}

            </div>

        </div>

    
        
       </div>
@endsection