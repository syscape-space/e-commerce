    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('AdminDashbord') }}">
            <div class="sidebar-brand-icon">
                Laravel
                <!--    <img src="{{ asset('admin/img/logo/logo2.png') }}"> -->
            </div>
            <div class="sidebar-brand-text mx-3">Ecommerce</div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item active">
            <a class="nav-link" href="{{ url('AdminDashbord') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Features
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#category"
                aria-expanded="true" aria-controls="category">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Category</span>
            </a>
            <div id="category" class="collapse" aria-labelledby="headingBootstrap"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Category </h6>
                    <a class="collapse-item" href="{{ route('categories.index') }}">View</a>
                    <a class="collapse-item" href="{{ route('categories.create') }}">Create</a>
                    <a class="collapse-item" href="{{ route('categories.trash') }}">Trash</a>


                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#subcategory"
                aria-expanded="true" aria-controls="subcategory">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>SubCategory</span>
            </a>
            <div id="subcategory" class="collapse" aria-labelledby="headingBootstrap"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">SubCategory </h6>
                    <a class="collapse-item" href="{{ route('subCategories.index') }}">View</a>
                    <a class="collapse-item" href="{{ route('subCategories.create') }}">Create</a>
                    <a class="collapse-item" href="{{ route('subCategories.trash') }}">Trash</a>

                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product"
                aria-expanded="true" aria-controls="product">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>products</span>
            </a>
            <div id="product" class="collapse" aria-labelledby="headingBootstrap"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Products </h6>
                    <a class="collapse-item" href="{{ route('products.index') }}">View</a>
                    <a class="collapse-item" href="{{ route('products.trash') }}">Trash</a>
                    <a class="collapse-item" href="{{ route('products.accept.list') }}">Accept</a>

                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#vendor"
                aria-expanded="true" aria-controls="vendor">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Vendors</span>
            </a>
            <div id="vendor" class="collapse" aria-labelledby="headingBootstrap"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Vendors </h6>
                    <a class="collapse-item" href="{{route('vendors.list')}}">List</a>
                    <a class="collapse-item" href="{{route('vendors.to.accept')}}">Accept</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brand"
                aria-expanded="true" aria-controls="brand">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Brand</span>
            </a>
            <div id="brand" class="collapse" aria-labelledby="headingBootstrap"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Brand </h6>
                    <a class="collapse-item" href="{{route('brand.index')}}">View all Brands</a>
                    <a class="collapse-item" href="{{route('brand.trash')}}">Trash</a>
                </div>
            </div>
        </li>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user"
                aria-expanded="true" aria-controls="user">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Users</span>
            </a>
            @if (auth()->user()->hasrole('administrator'))
                <div id="collapseBootstrap4" class="collapse" aria-labelledby="headingBootstrap"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Users </h6>
                        <a class="collapse-item" href="{{ url('/' . ($page = 'users')) }}">View all users</a>
                        <a class="collapse-item" href="{{route('users.create')}}">Create</a>
                    </div>
                </div>
            @endif
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#order"
                aria-expanded="true" aria-controls="order">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>User Order</span>
            </a>
            <div id="order" class="collapse" aria-labelledby="headingBootstrap"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Order </h6>
                    <a class="collapse-item" href="{{ route('products.accept.list') }}">Product order</a>
                    <a class="collapse-item" href="{{ route('orders.accept.list') }}">Purchase order</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#email"
                aria-expanded="true" aria-controls="email">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Send Email</span>
            </a>
            <div id="email" class="collapse" aria-labelledby="headingBootstrap"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Send Email </h6>
                    <a class="collapse-item" href="{{ route('send.email') }}">To all users</a>

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
