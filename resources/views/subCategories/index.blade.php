@extends('layouts.all_parts')
@section('title')

@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">
            <div class="pull-left">

                <h2>SubCategories </h2>

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
            <th>Category</th>
           <th></th>
        </tr>

        @foreach ($subCategories as $key =>  $subCategory)

        <tr>

            <td>{{ $key+1}}</td>
            <td>{{ $subCategory->name }}</td>
            <td>{{ $subCategory->categories->name }}</td>
            <td>
                <a class="btn btn-primary" href="{{ route('subCategories.edit',$subCategory->id) }}">Edit</a>
                <a class="btn btn-info" href="{{ route('subCategories.show',$subCategory->id) }}">Show</a>
                <a href="{{ route('subCategories.soft.delete',$subCategory->id)}}" class="btn btn-warning">SoftDelete</a>

            <!--
                 <form action="{{ route('subCategories.destroy',$subCategory->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            -->

            </td>

        </tr>

        @endforeach

    </table>

  

    {!! $subCategories->links() !!}

    @endsection     