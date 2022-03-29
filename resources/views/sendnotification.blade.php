@extends('layouts.all_parts')


  

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Send Email</h2>
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

@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

   

<form action="{{ route('send.email.to.all.users') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">

         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email header</strong>
                <input type="text" name="head" class="form-control" placeholder="Email header">
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email Body</strong>
                <input type="text" name="body" class="form-control" placeholder="Email body">
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>URl</strong>
                <input type="text" name="urlaction" class="form-control" placeholder="URL">
            </div>
        </div>
       

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>

    </div>

</form>

@endsection