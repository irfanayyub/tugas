<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rental Mobil</title>
    <link href="{{ asset('sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Tambahkan CSS kustom jika ada -->
</head>
<body id="page-top">

<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-car"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Rental Mobil</div>
        </a>
        
        <!-- Tautan Dashboard -->
        <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        <!-- Tautan Daftar Mobil -->
        <li class="nav-item {{ request()->routeIs('mobils.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('mobils.index') }}">
                <i class="fas fa-fw fa-car"></i>
                <span>Daftar Mobil</span>
            </a>
        </li>
        
        <!-- Tautan Pemesanan -->
        <li class="nav-item {{ request()->routeIs('pemesan.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pemesan.index') }}">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Pemesanan</span>
            </a>
        </li>

        <!-- Tautan Pelanggan -->
        <li class="nav-item {{ request()->routeIs('customers.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('customers.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Pelanggan</span>
            </a>
        </li>

        <!-- Tautan Transaksi -->
        <li class="nav-item {{ request()->routeIs('transaksis.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('transaksis.index') }}">
                <i class="fas fa-fw fa-money-bill"></i>
                <span>Transaksi</span>
            </a>
        </li>
    </ul>
    <!-- End of Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <ul class="navbar-nav ml-auto">
                    <!-- Tautan Login dan Register untuk Pengguna Tamu -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <!-- Dropdown untuk Pengguna yang Sudah Login -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('sb-admin-2/img/undraw_profile.svg') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </nav>

            <div class="container-fluid">
                @yield('content') <!-- Tempat untuk konten dari halaman lain -->
            </div>
        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>© 2023 Rental Mobil</span>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="{{ asset('sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('sb-admin-2/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
