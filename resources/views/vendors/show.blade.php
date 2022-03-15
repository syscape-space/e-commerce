@extends('layouts.all_parts')
@section('title')

  

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Show Vendor</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('vendors.index') }}"> Back</a>

            </div>

        </div>

    </div>

   

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Name:</strong>

                {{ $vendor->name }}
               
            

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Email:</strong>

                {{ $vendor->email }}

            </div>

        </div>

    
        <div class="col-xs-12 col-sm-12 col-md-12">

          <div class="form-group">

              <strong>phone number:</strong>

            {{ $vendor->phone_number }}

           </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>ِAddress:</strong>

                {{ $vendor->address }}
               
            

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>City:</strong>

                {{ $vendor->city}}

            </div>

        </div>

    
        <div class="col-xs-12 col-sm-12 col-md-12">

          <div class="form-group">

             <strong>country:</strong>

            {{ $vendor->country }}

           </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>zipcode:</strong>

                {{ $vendor->zipcode}}
               
            

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>is active:</strong>

                {{ $vendor->is_active }}

            </div>

        </div>

    
         <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

               <strong>created by:</strong>

                {{ $vendor->created_by }}

            </div>

         </div>
       </div>
@endsection