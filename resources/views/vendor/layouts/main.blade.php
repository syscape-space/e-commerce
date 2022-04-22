@include('vendor.layouts.header')
  <div id="wrapper">
    <!-- Sidebar -->
@include('vendor.layouts.sidebar')
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
@include('vendor.layouts.navbar')
        <!-- Topbar -->

        <!-- Container Fluid-->
     @yield('content')
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
    @include('vendor.layouts.fotter')
      <!-- Footer -->
    </div>
  </div>