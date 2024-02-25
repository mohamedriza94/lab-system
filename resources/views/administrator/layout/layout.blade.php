<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>Lab</title>
    <link href="{{ asset('assets/node_modules/morrisjs/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/pages/ecommerce.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
</head>

<body class="skin-default fixed-layout">

    {{-- Loader --}}
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Lab</p>
        </div>
    </div>

    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <h3>LAB SYSTEM</h3>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav me-auto"></ul>
                    <ul class="navbar-nav my-lg-0"></ul>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <div class="user-profile">
                    <div class="user-pro-body">
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                @auth('administrator')
                                Admin
                                @endauth

                                @auth('doctor')
                                {{ Auth::guard('doctor')->user()->name }}
                                @endauth

                                @auth('patient')
                                {{ Auth::guard('patient')->user()->name }}
                                @endauth
                                <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu animated flipInY">
                                @auth('administrator')
                                <a href="{{ route('administrator.logout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                                @endauth

                                @auth('doctor')
                                <a href="{{ route('doctor.logout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                                @endauth

                                @auth('patient')
                                <a href="{{ route('patient.logout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                                @endauth
                            </div>
                        </form>
                    </div>
                </div>

                <nav class="sidebar-nav">
                    @auth('administrator')
                    <li><a class="has-arrow waves-effect waves-dark" href="{{ route('administrator.dashboard') }}">Dashboard</a></li>
                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)">Patients</a></li>
                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)">Appointments</a></li>
                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)">Doctors</a></li>
                    @endauth
                    @auth('doctor')
                    <li><a class="has-arrow waves-effect waves-dark" href="{{ route('doctor.dashboard') }}">Dashboard</a></li>
                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)">Appointments</a></li>
                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)">My Tests</a></li>
                    @endauth
                    @auth('patient')
                    <li><a class="has-arrow waves-effect waves-dark" href="{{ route('patient.dashboard') }}">Dashboard</a></li>
                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)">My Appointments</a></li>
                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)">My Tests</a></li>
                    @endauth
                </nav>
            </div>
        </div>
    </aside>

    <div class="page-wrapper">
        @yield('contents')
        @yield('scripts')
    </div>

    <footer class="footer">
        © 2024 Lab System
    </footer>
</div>

<script src="{{ asset('assets/node_modules/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('dist/js/waves.js') }}"></script>
<script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('dist/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('assets/node_modules/morrisjs/morris.min.js') }}"></script>
<script src="{{ asset('dist/js/ecom-dashboard.js') }}"></script>
</body>

</html>
