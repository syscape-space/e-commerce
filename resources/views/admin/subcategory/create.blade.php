@extends('admin.layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 ml-4 text-gray-800">SubCategory</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">SubCategory</li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
    </div>

    <div class="row justify-content-center">

      <div class="col-lg-10">
        <form action="{{ route('subCategories.store') }}" method="POST" enctype="multipart/form-data">@csrf

          <div class="card mb-6">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Create SubCategory</h6>
            </div>
            <div class="card-body">

              <div class="form-group"> 
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror " placeholder="Enter name of subcategory" >
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Choose Category</label>
                  <select name="category" class="form-control @error('category') is-invalid @enderror" >
                    <option value="">select</option>
                    @foreach(App\Models\Category::all() as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>

                 @error('category')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror       
              </div>

              <button type="submit" class="btn btn-primary">Create</button>

            </div>
          </div>
        </form>  

      </div>
    </div>
@endsection