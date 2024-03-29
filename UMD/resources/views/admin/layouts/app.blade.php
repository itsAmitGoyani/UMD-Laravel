<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/css/owl.theme.default.min.css') }}">
    <link href="{{ asset('vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="/admin" class="brand-logo">
                <img src="{{ asset('images/logo.png')}}" alt="">
                <img class="logo-compact" src="{{ asset('images/logo-text.png')}}" alt="">
                <img class="brand-title" src="{{ asset('images/logo-text.png')}}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <li class="nav-item">
                                <span>Welcome, {{Auth::user()->name}} ! </span>
                            </li>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="/admin/messages">
                                    <i class="mdi mdi-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>

                            </li>

                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="/admin/profile" class="dropdown-item">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="/admin/logout" class="dropdown-item">
                                        <i class="fa fa-key" aria-hidden="true"></i>
                                        <span class="ml-2">Logout</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-building-o" aria-hidden="true"></i><span class="nav-text">{{ __('NGO') }}</span></a>
                        <ul aria-expanded="false">
                            <li><a href="/admin/registerngo">{{ __('Register NGO') }}</a></li>
                            <li><a href="/admin/displayngos">{{ __('Display All NGOs') }}</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-user-plus" aria-hidden="true"></i><span class="nav-text">{{ __('NGO Manager') }}</span></a>
                        <ul aria-expanded="false">
                            <li><a href="/admin/registermanager">{{ __('Register NGO Manager') }}</a></li>
                            <li><a href="/admin/displaymanagers">{{ __('Display All Manager') }}</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('ViewDonationHistory-Admin') }}"><i class="fa fa-history" aria-hidden="true"></i><span class="nav-text">{{ __('View Donation History') }}</span></a>
                    <li><a href="/admin/medicinestock" aria-expanded="false"><i class="fa fa-cubes" aria-hidden="true"></i><span class="nav-text">{{ __('View Medicine Stock') }}</span></a></li>
                    <li><a href="/admin/managedonators" aria-expanded="false"><i class="fa fa-user-times" aria-hidden="true"></i><span class="nav-text">{{ __('Manage Donators') }}</span></a></li>
                    <li class="nav-label">User Menu</li>
                    <li><a href="{{ route('Profile-Admin') }}" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i><span class="nav-text">{{ __('Profile') }}</span></a></li>
                    <li><a href="{{ route('ChangePassword-Admin') }}" aria-expanded="false"><i class="fa fa-key" aria-hidden="true"></i></i><span class="nav-text">{{ __('Change Password') }}</span></a></li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        @yield('content')
        <!--**********************************
            Content body end
        ***********************************-->
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    <a href="#">MedCharity</a> All rights reserved</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/quixnav-init.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>


    <!-- Vectormap -->
    <script src="{{ asset('vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('vendor/morris/morris.min.js') }}"></script>


    <script src="{{ asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>

    <script src="{{ asset('vendor/gaugeJS/dist/gauge.min.js') }}"></script>

    <!--  flot-chart js -->
    <script src="{{ asset('vendor/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('vendor/flot/jquery.flot.resize.js') }}"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>

    <!-- Counter Up -->
    <script src="{{ asset('vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>


    <script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>

    <script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
</body>

</html>