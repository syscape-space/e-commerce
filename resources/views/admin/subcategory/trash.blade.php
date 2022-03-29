@extends('admin.layouts.main')

@section('content')

        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">SubCategory</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">SubCategory</li>
              <li class="breadcrumb-item active" aria-current="page">Trash</li>
            </ol>
          </div>

@if ($message = Session::get('success'))
  <div class="alert alert-danger">
      <p>{{ $message }}</p>
  </div>
@endif

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All Trashed SubCategories </h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($subcategories)>0)
                      @foreach($subcategories as $key=> $subcategory)
                      <tr>

                        <td><a href="#">{{$key+1}}</a></td>
                        <td>{{$subcategory->name}}</td>
                        <td>{{$subcategory->categories->name}}</td>
                        <td>
                          <a class="btn btn-primary" href="{{ route('subCategories.back',$subcategory->id)}}">Back</a>
                          <a class="btn btn-danger" href="{{ route('subCategories.hard.delete',$subcategory->id)}}">Delelte</a>
                           
                        </td>

                      </tr>
                      @endforeach

                      @else
                      <td>No category moved to trash yet!</td>
                      @endif
                      
                    </tbody>
                  </table>
                  
                  {!! $subcategories->links() !!}
                
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->
        </div>
  @endsection