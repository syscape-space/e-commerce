@extends('layouts.all_parts')
@section('title')

@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">
            <div class="pull-left">

                <h2> categories </h2>

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
            <th>Description</th>
            <th>Action</th>
        </tr>

        @foreach ($category as $key =>  $category)
        <tr>

            <td>{{ $key+1}}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>
                <a class="btn btn-primary" href="{{ route('Categories.edit',$category->id) }}">Edit</a>
                <a class="btn btn-info" href="{{ route('Categories.show',$category->id) }}">Show</a>
                <a href="{{ route('Categories.soft.delete',$category->id)}}" class="btn btn-warning">SoftDelete</a>


            </td>

        </tr>

        @endforeach

    </table>

    {{-- {!! $categories->links() !!} --}}

    @endsection
