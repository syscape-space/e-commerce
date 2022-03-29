@extends('layouts.all_parts')
@section('title')

@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">
            <div class="pull-left">

                <h2>Products </h2>

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
            <th>###</th>
           <th></th>
        </tr>

        @foreach ($products as $key =>  $product)

        <tr>

            <td>{{ $key+1}}</td>
            <td>{{ $product->name }}</td>
            <td>
                <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                <a href="{{ route('products.soft.delete',$product->id)}}" class="btn btn-warning">SoftDelete</a>

            <!--
                 <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            -->

            </td>

        </tr>

        @endforeach

    </table>



    {!! $products->links() !!}

    @endsection
