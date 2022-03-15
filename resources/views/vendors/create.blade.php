@extends('layouts.all_parts')


  

@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Add New Vendor</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('vendors.index') }}"> Back</a>

        </div>

    </div>

</div>

   

@if ($errors->any())

    <div class="alert alert-danger">

        <strong>Whoops!</strong> There were some problems with your input.<br><br>

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

   

<form action="{{ route('vendors.store') }}" method="POST">

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

                <strong>Email:</strong>

                <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

           <div class="form-group">

           <strong>Phone Number:</strong>

           <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>

           </div>

        </div>
            
        <div class="col-xs-12 col-sm-12 col-md-12">

           <div class="form-group">

           <strong>Address:</strong>

           <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>

           </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

          <div class="form-group">

          <strong>City:</strong>

           <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>

          </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

          <div class="form-group">

            <strong>country:</strong>

             <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>

           </div>

         </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

          <div class="form-group">

            <strong>zipcode:</strong>

           <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>

         </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

           <div class="form-group">

             <strong>is_active:</strong>

             <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>

          </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">

           <div class="form-group">

             <strong>created_by:</strong>

             <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>

          </div>

        </div>



        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Submit</button>

        </div>

    </div>

   

</form>

@endsection