@extends('admin.layouts.main')

@section('content')

        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Vendor Tables</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Vendor</li>
              <li class="breadcrumb-item active" aria-current="page">Vendor Tables</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All Vendors</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @if(count($vendors)>0)
                      @foreach($vendors as $key=> $vendor)
                      <tr>

                        <td><a href="#">{{$key+1}}</a></td>
                       
                        <td>{{$vendor->name}}</td>
                        <td>{{$vendor->email}}</td>
                        <td>
                          <a href="{{route('block.vendor',$vendor->id)}}"><button class="btn btn-danger">Block</button></a>
                        </td>
                        
                        
                        
                      </tr>
                      @endforeach

                      @else
                      <td>No vendors to display</td>
                      @endif
                      
                      
                      
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->
        </div>

  @endsection