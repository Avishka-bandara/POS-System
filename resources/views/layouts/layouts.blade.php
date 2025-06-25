<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'POS System') }} - @yield('title')</title>

    @vite([
    'resources/css/sb-admin-2.css',
    'resources/css/custom.scss',
    'resources/css/toast.scss',

    ])
    @vite([
    'resources/js/sb-admin-2.js',
    'resources/js/app.js'
    ])

</head>



<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" >
                <div class="sidebar-brand-icon rotate-n-15">
                    {{-- <i class="fas fa-laugh-wink"></i> --}}
                </div>
                <div class="sidebar-brand-text mx-3" id="shopName">Grocery shop</div>
            </a>

            <hr class="sidebar-divider my-0">
            <div id="componentName">
                <li class="nav-item active">
                    <a class="nav-link" href="#">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <hr class="sidebar-divider">
                <div class="sidebar-heading">POS Management</div>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('sales.index') }}">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>POS</span>
                    </a>
                </li>

                <hr class="sidebar-divider">
                <div class="sidebar-heading">Stock Management</div>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#product" role="button"
                        aria-expanded="false" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Products</span>
                    </a>
                    <div id="product" class="collapse">
                        <div class="py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('product.index') }}">View Product</a>
                            <a class="collapse-item" href="{{ route('product.add_product') }}">Add Product</a>
                            <a class="collapse-item" href="{{ route('product.category') }}">Category</a>
                        </div>
                    </div>
                </li>

                <hr class="sidebar-divider d-none d-md-block">
                <div class="sidebar-heading">Profile Management</div>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#profile" role="button"
                        aria-expanded="false" aria-controls="profile">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Profile</span>
                    </a>
                    <div id="profile" class="collapse">
                        <div class=" py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('profile.edit') }}">Permission</a>
                            <a class="collapse-item" href="{{ route('profile.role') }}">Role</a>
                        </div>
                    </div>
                </li>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none me-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- <form class="d-none d-sm-inline-block w-100">
                        <div class="input-group col-4">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="button-addon" style="box-shadow: none;">
                            <button class="btn btn-primary" type="button" id="button-addon" style="box-shadow: none;">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </form> -->

                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end p-3 shadow" aria-labelledby="searchDropdown">
                                <form class="w-100 ">
                                    <div class="input-group col-12">
                                        <input type="text" class="form-control bg-light border-0 small "
                                            placeholder="Search .." aria-label="Search"
                                            aria-describedby="button-addon2">
                                        <button class="btn btn-success" type="button" id="button-addon2">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge bg-danger rounded-pill">3+</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">Alerts Center</h6>
                            </div>
                        </li>

                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="badge bg-danger rounded-pill">7</span>
                            </a>
                        </li> -->

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="me-2 d-none d-lg-inline text-black text-bold m-1">
                                    {{ Auth::user()->first_name }}
                                </span>
                                {{-- <img class="img-profile rounded-circle" src="img/undraw_profile.svg"> --}}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                                    {{ __('Dashboard') }}
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">
                    @yield('content')


                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
        </div>

        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Select "Logout" below if you are ready to end your current session.
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="button" onclick="handleLogout()">Logout</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function handleLogout() {
                // Create a form dynamically to send POST request with CSRF token
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/logout';

                // Add CSRF token (assuming Laravel's CSRF meta tag is present in your layout)
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);

                // Append form to body and submit
                document.body.appendChild(form);
                form.submit();
            }
        </script>
    </div>



</body>





</html>