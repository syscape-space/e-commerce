@extends('admin.layouts.main')


  

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 ml-4 text-gray-800">Email</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Email</li>
              <li class="breadcrumb-item active" aria-current="page">Send</li>
            </ol>
    </div>


@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

   
<div class="row justify-content-center">
      <div class="col-lg-10">
        <form action="{{ route('send.email.to.all.users') }}" method="POST" enctype="multipart/form-data">@csrf
        <div class="card mb-6">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Send Email</h6>
            </div>
            <div class="card-body">

                <div class="form-group"> 
                    <label for="header">Email header</label>
                    <input type="text" name="head" class="form-control @error('head') is-invalid @enderror " id="header" aria-describedby=""
                      placeholder="Email header">
                      @error('head')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                <div class="form-group"> 
                    <label for="body">Email Body</label>
                    <input type="text" name="body" class="form-control @error('body') is-invalid @enderror " id="body" aria-describedby=""
                      placeholder="Email body">
                      @error('body')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group"> 
                    <label for="url">URl</label>
                    <input type="url" name="urlaction" class="form-control @error('urlaction') is-invalid @enderror " id="url" aria-describedby=""
                      placeholder="URL">
                      @error('urlaction')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
       
               <button type="submit" class="btn btn-primary">Send</button>
    </div>
</div>

</form>

@endsection