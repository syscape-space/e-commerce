@extends('layouts.all_parts')
@section('title')

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>SubCategories Trash </h2>
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
            <th>Category</th>
           <th></th>
  




        </tr>

        @foreach ($subCategories as $key =>  $subCategory)

        <tr>

            <td>{{ $key+1}}</td>

            <td>{{ $subCategory->name }}</td>
            <td>{{ $subCategory->categories->name  }}</td>
            <td>
            	<a class="btn btn-primary" href="{{ route('subCategories.back',$subCategory->id)}}">Back</a>
				<a class="btn btn-danger" href="{{ route('subCategories.hard.delete',$subCategory->id)}}">Delelte</a>
            </td>
        </tr>

        @endforeach

    </table>

  

    {!! $subCategories->links() !!}

    @endsection     