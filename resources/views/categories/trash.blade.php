@extends('layouts.all_parts')
@section('title')

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products Trash </h2>
            </div>
        </div>
    </div>

   
    @if ($message = Session::get('success'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">

        <tr>

            <th>No</th>
            <th>Name</th>
            <th>###</th>
           <th></th>
  




        </tr>

        @foreach ($products as $key =>  $product)

        <tr>

            <td>{{ $key+1}}</td>

            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name  }}</td>
            <td>
            	<a class="btn btn-primary" href="{{ route('products.back',$product->id)}}">Back</a>
				<a class="btn btn-danger" href="{{ route('products.hard.delete',$product->id)}}">Delelte</a>
            </td>
        </tr>

        @endforeach

    </table>

  

    {!! $products->links() !!}

    @endsection     