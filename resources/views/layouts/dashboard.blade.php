
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datepicker/daterangepicker.css') }}" />

    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ route('dashboard') }}">
                                Parking System
                            </a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center">
                    <div class="avatar avatar-xl me-3">
                        <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="" srcset="">
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <a href="javascript:void(0)">
                        {{ auth()->user()->name }}
                    </a>
                </div>

                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item @yield('dashboard')">
                            <a href="{{ auth()->user()->role == 0 ? route('dashboard') : route('dashboard.user') }}" class='sidebar-link'>
                                <i class="fas fa-tachometer-alt"></i>
                                <span>{{ auth()->user()->role == 0 ? 'Dashboard' : 'Parkir' }}</span>
                            </a>
                        </li>

                        @if( auth()->user()->role == 0 )
                        <li class="sidebar-item @yield('laporan')">
                            <a href="{{ route('dashboard.laporan') }}" class='sidebar-link'>
                                <i class="fas fa-archive"></i>
                                <span>Laporan</span>
                            </a>
                        </li>
                        @endif

                        {{-- @if( auth()->user()->role == 1 )
                        <li class="sidebar-item {{ request()->routeIs('laporan.*') ? 'active' : ''}}">
                            <a href="" class='sidebar-link'>
                                <i class="fas fa-parking"></i>
                                <span>Daftar Kendaraan</span>
                            </a>
                        </li>
                        @endif --}}

                        <li class="sidebar-item">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class='sidebar-link'>
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Keluar</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('content')

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer Template Admin</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="https://jokopurnomo.my.id">Joko Purnomo</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/vendors/datepicker/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datepicker/daterangepicker.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


    @if (session()->has('success'))
        <script>
            Swal.fire('Berhasil', '{{ session()->get('success') }}', 'success')
        </script>
    @endif

    @stack('after-script')
    
</body>

</html>