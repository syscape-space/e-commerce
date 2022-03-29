@extends('admin.layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 ml-4 text-gray-800">Category</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Category</li>
              <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">@csrf

          <div class="card mb-6">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Create Category</h6>
            </div>
            <div class="card-body">
              <div class="form-group"> 
                <label for="">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror " id="" aria-describedby=""
                  placeholder="Enter name of category">
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              
              </div>
              <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror "></textarea>
                 @error('description')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                @enderror
                
              </div>

              <div class="form-group">
                <div class="custom-file">
                  <input type="file" name="image" class="form-control custom-file-input @error('image') is-invalid @enderror" id="customFile" >
                  <label class="custom-file-label" for="customFile">Choose image</label>
                  
                  @error('image')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div> 
               </div> 
             
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </div>
        </form>

      </div>
    </div>
@endsection