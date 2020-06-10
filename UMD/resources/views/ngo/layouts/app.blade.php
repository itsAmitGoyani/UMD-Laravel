<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    @if(Auth::guard('manager')->check())
    <title> NGO Manager Dashboard </title>
    @elseif(Auth::guard('verifier')->check())
    <title> Medicine Verifier Dashboard </title>
    @elseif(Auth::guard('pickupman')->check())
    <title> Pickup Man Dashboard </title>
    @else
    <title> NGO Panel </title>
    @endif
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
            @if(Auth::guard('manager')->check())
            <a href="/ngo/manager" class="brand-logo">
            @elseif(Auth::guard('verifier')->check())
            <a href="/ngo/verifier" class="brand-logo">
            @elseif(Auth::guard('pickupman')->check())
            <a href="/ngo/pickupman" class="brand-logo">
            @endif
                <img class="logo-abbr" src="{{ asset('images/logo.png')}}" alt="">
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
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item">
                                <span>Welcome, {{Auth::user()->name}} ! </span>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    
                                    @if(Auth::guard('manager')->check())
                                    <a href="/ngo/manager/profile" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="/ngo/manager/logout" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout</span>
                                    </a>
                                    @elseif(Auth::guard('verifier')->check())
                                    <a href="/ngo/verifier/profile" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="/ngo/verifier/logout" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout</span>
                                    </a>
                                    @elseif(Auth::guard('pickupman')->check())
                                    <a href="/ngo/pickupman/profile" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="/ngo/pickupman/logout" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout</span>
                                    </a>
                                    @endif
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
                    @if(Auth::guard('manager')->check())
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('Verifier') }}</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('RegisterVerifier') }}">{{ __('Register Verifier') }}</a></li>
                            <li><a href="{{ route('DisplayVerifier') }}">{{ __('Display All Verifier') }}</a></li>

                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('Pickupman') }}</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('RegisterPickupman') }}">{{ __('Register Pickupman') }}</a></li>
                            <li><a href="{{ route('DisplayPickupmen') }}">{{ __('Display All Pickupmen') }}</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('ViewPickedUpDs-Manager') }}"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('View Picked Up Donations') }}</span></a>
                    <li><a href="{{ route('ViewDonationHistory-Manager') }}"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('View Donation History') }}</span></a>
                    <li><a href="{{ route('ViewMedicineStock-Manager') }}"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('View Medicine Stock') }}</span></a>
                    <li><a href="{{ route('EditDPD-Manager') }}"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('Edit DPD') }}</span></a>
                    <li class="nav-label">User Menu</li>
                    <li><a href="{{ route('Profile-Manager') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('Profile') }}</span></a></li>
                    <li><a href="{{ route('ChangePassword-Manager') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('Change Password') }}</span></a></li>
                    @endif
                    @if(Auth::guard('verifier')->check())
                    <li><a href="{{ route('ViewPDs-Verifier') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('View Pending Donations') }}</span></a></li>
                    <li><a href="{{ route('ViewTD-Verifier') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('View Taken Donation') }}</span></a></li>
                    <li><a href="{{ route('GiveFeedback-Verifier') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('Give Feedback') }}</span></a></li>
                    <li><a href="{{ route('AddMCategory-Verifier') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('Add Medicine Category') }}</span></a></li>
                    <li class="nav-label">User Menu</li>
                    <li><a href="{{ route('Profile-Verifier') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('Profile') }}</span></a></li>
                    <li><a href="{{ route('ChangePassword-Verifier') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('Change Password') }}</span></a></li>
                    @endif
                    @if(Auth::guard('pickupman')->check())
                    <li><a href="{{ route('ViewPDs-Pickupman') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('View Pending Donations') }}</span></a></li>
                    <li><a href="{{ route('ViewTDs-Pickupman') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('View Taken Donations') }}</span></a></li>
                    <li class="nav-label">User Menu</li>
                    <li><a href="{{ route('Profile-Pickupman') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('Profile') }}</span></a></li>
                    <li><a href="{{ route('ChangePassword-Pickupman') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">{{ __('Change Password') }}</span></a></li>
                    @endif
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
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
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

    <!-- <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/quixnav-init.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script> -->



    <!-- Datatable -->
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>

</body>

</html>