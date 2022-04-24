@extends('vendor.layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 ml-4 text-gray-800">Product</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product</li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>

        </ol>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-info">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="col-lg-10">
        <form action="{{ route('products.update', [$product->id]) }}" method="POST" enctype="multipart/form-data">@csrf
            {{ method_field('PUT') }}
            <div class="card mb-6">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Update Product</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror " id=""
                            aria-describedby="" placeholder="Enter name of product" value="{{ $product->name }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="" class="form-control @error('description') is-invalid @enderror ">
                        {!! $product->description !!}
                      </textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="">Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror  "
                                id="customFile" name="image">
                            <label class="custom-file-label  " for="customFile">Choose file</label>
                            <center> <img src="/storage/products_image/{{ $product->image }}" width="100"></center>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="">Price($)</label>
                        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror " id=""
                            aria-describedby="" value="{{ $product->price }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="form-group">

                      <label for="status">Select Brand</label>
                      <select name="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                          <option value="{{ $product->brand_id }}">Select a Brand</option>
                          @foreach ($brands as $brand)
                          <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                          @endforeach
                      </select>
                      @error('brand_id')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>

                    <livewire:category />

                    <button type="submit" class="btn btn-primary">Update</button>

                </div>
            </div>
        </form>

    </div>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        $("document").ready(function() {
            $('select[name="category"]').on('change', function() {
                var catId = $(this).val();
                if (catId) {
                    $.ajax({

                        url: '/subcatories/' + catId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subcategory"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory"]').append(
                                    '<option value=" ' + key + '">' + value +
                                    '</option>');
                            })
                        }


                    })
                } else {
                    $('select[name="subcategory"]').empty();
                }
            });


        });
    </script> --}}
@endsection
