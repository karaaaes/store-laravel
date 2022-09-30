<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>
    @stack('prepend-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css" />
    <link href="/style/main.css" rel="stylesheet" />
    @stack('addon-style')
</head>

<body>

    <div class="page-dashboard">
        <div class="d-flex" id="wrapper" data-aos="fade-right">
            <!--Sidebar-->
            <div class="border-right" id="sidebar-wrapper">
                <div class="sidebar-heading text-center">
                    <h5>Dashboard Admin</h5>
                    <h6 class="text-muted">BWA Store</h6>
                    <img src="/images/admin.png" class="my-4" alt="" style="max-width: 150px;" />
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin-dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
                    <a href="{{ route('product.index') }}" class="list-group-item list-group-item-action {{ (request()->is('admin/product')) ? 'active' : ''}}">Products</a>
                    <a href="{{ route('product-gallery.index') }}" class="list-group-item list-group-item-action {{ (request()->is('admin/product-gallery*')) ? 'active' : ''}}">Products Gallery</a>
                    <a href="{{ route('category.index') }}" class="list-group-item list-group-item-action {{ (request()->is('admin/category*')) ? 'active' : ''}}">Categories</a>
                    <a href="{{ route('transaction.index') }}" class="list-group-item list-group-item-action {{ (request()->is('admin/transaction*')) ? 'active' : ''}}">Transactions</a>
                    <a href="{{ route('user.index') }}" class="list-group-item list-group-item-action {{ (request()->is('admin/user*')) ? 'active' : ''}}">Users</a>
                    <a href="index.html" class="list-group-item list-group-item-action"> Sign Out</a>
                </div>
            </div>
            <!--Page Content-->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
                    <!--Container Fluid Bikin Navbar Menu jadi paling pojok-->
                    <div class="container-fluid">
                        <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
                            &laquo; Menu
                        </button>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent">
                            <span class="navbar-toggler-icon"> </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Desktop Menu -->
                            <ul class="navbar-nav d-none d-lg-flex ml-auto">
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link" id="navbarDropdown" role="button"
                                        data-toggle="dropdown">
                                        <img src="/images/icon_user.png" alt=""
                                            class="rounded-circle mr-2 profil-picture">Hi, Raka
                                    </a>
                                    <div class="dropdown-menu">

                                        <a href="index.html" class="dropdown-item">Log Out</a>

                                    </div>
                                </li>
                            </ul>

                            <!-- MOBILE MENU -->
                            <ul class="navbar-nav d-block d-lg-none">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Hi, Raka
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Cart
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                {{-- Content --}}
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script> -->
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        //Menggeser Sidebar Menu Agar Hilang
        $('#menu-toggle').click(function(e) {
            e.preventDefault();
            $('#wrapper').toggleClass("toggled");
        })
    </script>

    @stack('addon-script')
</body>

</html>
