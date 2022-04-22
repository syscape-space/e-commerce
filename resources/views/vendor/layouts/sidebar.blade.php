    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('VendorDashbord') }}">
            <div class="sidebar-brand-icon">
                Laravel
                <!--    <img src="{{ asset('admin/img/logo/logo2.png') }}"> -->
            </div>
            <div class="sidebar-brand-text mx-3">Ecommerce</div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item active">
            <a class="nav-link" href="{{ url('VendorDashbord') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Features
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap3"
                aria-expanded="true" aria-controls="collapseBootstrap3">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Brand</span>
            </a>
            <div id="collapseBootstrap3" class="collapse" aria-labelledby="headingBootstrap"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Brand </h6>
                    <a class="collapse-item" href="{{route('all.vendor.brands')}}">My Brands</a>
                    <a class="collapse-item" href="{{ route('brand.create') }}">Create</a>
                    <a class="collapse-item" href="{{route('brand.vendor.trash')}}">Trash</a>

                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Category</span>
            </a>
            <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Category </h6>
                    <a class="collapse-item" href="{{ route('vendor.all.category') }}">View</a>


                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap1"
                aria-expanded="true" aria-controls="collapseBootstrap1">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>SubCategory</span>
            </a>
            <div id="collapseBootstrap1" class="collapse" aria-labelledby="headingBootstrap"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">SubCategory </h6>
                    <a class="collapse-item" href="{{ route('vendor.all.subcategory') }}">View</a>

                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap2"
                aria-expanded="true" aria-controls="collapseBootstrap2">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>products</span>
            </a>
            <div id="collapseBootstrap2" class="collapse" aria-labelledby="headingBootstrap"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Products </h6>
                    <a class="collapse-item" href="{{ route('product.vendor.all') }}">all products</a>
                    <a class="collapse-item" href="{{ route('product.vendor.myProduct') }}">My product</a>
                    <a class="collapse-item" href="{{ route('products.create') }}">Create</a>
                    <a class="collapse-item" href="{{ route('product.vendor.trash') }}">Trash</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">

        <li class="nav-item">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        <hr class="sidebar-divider">
    </ul>
