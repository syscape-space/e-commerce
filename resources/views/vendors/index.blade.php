@extends('layouts.all_parts')
@section('title')

@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>vendors </h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-success" href="{{ route('vendors.create') }}"> Create New vendor</a>

            </div>

        </div>

    </div>

   

    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif

   

    <table class="table table-bordered">

        <tr>

            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>phone_number</th>
            <th>Address</th>
            <th>City</th>
            <th>Country</th>
           <th>zip-code</th>
           <th>is_active</th>
           <th>created_by</th>

            <th width="280px">Action</th>

        </tr>

        @foreach ($vendors as $vendor)

        <tr>

            <td>{{ ++$i }}</td>

            <td>{{ $vendor->name }}</td>
            <td>{{ $vendor->email }}</td>
            <td>{{ $vendor->phone_number }}</td>
            <td>{{ $vendor->address }}</td>
            <td>{{ $vendor->city}}</td>
            <td>{{ $vendor->country }}</td>
            <td>{{ $vendor->zipcode}}</td>
            <td>{{ $vendor->is_active }}</td>
            <td>{{ $vendor->created_by }}</td>


            <td>

                <form action="{{ route('vendors.destroy',$vendor->id) }}" method="POST">

   

                    <a class="btn btn-info" href="{{ route('vendors.show',$vendor->id) }}">Show</a>

    

                    <a class="btn btn-primary" href="{{ route('vendors.edit',$vendor->id) }}">Edit</a>

   

                    @csrf

                    @method('DELETE')

      

                    <button type="submit" class="btn btn-danger">Delete</button>

                </form>

            </td>

        </tr>

        @endforeach

    </table>

  

    {!! $vendors->links() !!}

    @endsection     