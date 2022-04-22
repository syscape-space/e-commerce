@extends('vendor.layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 ml-4 text-gray-800">Brand</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Brand</li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>

        </ol>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-info">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="col-lg-10">
        <form action="{{ route('brand.update', [$brand->id]) }}" method="POST" enctype="multipart/form-data">@csrf
            {{ method_field('PUT') }}
            <div class="card mb-6">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Update brand</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror " id=""
                            aria-describedby="" placeholder="Enter name of brand" value="{{ $brand->name }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                </div>
                <div class="card-body">
                    <label for="">Logo</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('logo') is-invalid @enderror  " id="customFile"
                            name="logo">
                        <label class="custom-file-label  " for="customFile">Choose file</label>
                        <center> <img src="/storage/brands_logo/{{$brand->logo}}" width="100"></center>
                        @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>


                <br>

                <button type="submit" class="btn btn-primary">Update</button>

            </div>
    </div>
    </form>


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
