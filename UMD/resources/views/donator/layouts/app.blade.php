<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MedCharity</title>
    <link rel="icon" href="/dpanel/img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/dpanel/css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="/dpanel/css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="/dpanel/css/owl.carousel.min.css">
    <!-- themify CSS -->
    <link rel="stylesheet" href="/dpanel/css/themify-icons.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="/dpanel/css/all.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="/dpanel/css/flaticon.css">
    <!-- magnific popup CSS -->
    <link rel="stylesheet" href="/dpanel/css/magnific-popup.css">
    <!-- nice select CSS -->
    <link rel="stylesheet" href="/dpanel/css/nice-select.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="/dpanel/css/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="/dpanel/css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="/"> <img src="/dpanel/img/logo.png" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="ti-menu"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-end" id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item">
                                    <a class="nav-link" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/about">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/contact">Contact</a>
                                </li>
                                @if(Auth::guard('donator')->check())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('viewDonations-Donator') }}">Donation History</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/profile">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/logout">Logout</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link" href="/login">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/register">Register</a>
                                </li>
                                @endif                                
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->

    @yield('content')

    <!--::footer_part start::-->
    <footer class="footer_part">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-lg-4">
                    <div class="single_footer_part">
                        <img src="/dpanel/img/footer_logo.png" class="footer_logo" alt="">
                        <p>Heaven fruitful doesn't over lesser days appear creeping seasons so behold bearing days open
                        </p>
                        <div class="work_hours">
                            <h5>Working Hours:</h5>
                            <ul>
                                <li>
                                    <p> Monday-Friday:</p> <span> 8AM - 6PM</span>
                                </li>
                                <li>
                                    <p>Saturday-Sunday:</p> <span> 8AM - 12PM</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-lg-2">
                    
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4>Useful Links</h4>
                        <ul class="list-unstyled">
                            <li><a href="/">Home</a></li>
                            <li><a href="/about">About</a></li>
                            <li><a href="/contact">Contact</a></li>
                            @if(Auth::guard('donator')->check())
                                <li><a href="{{ route('viewDonations-Donator') }}">Donation History</a></li>
                                <li><a href="/profile">Profile</a></li>
                            @else
                                <li><a href="{{route('admin-login')}}">Admin Panel</a></li>
                                <li><a href="{{route('NGOPanel')}}">NGO Panel</a></li>
                            @endif         
                            
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part footer_3">
                        <h4> our Gallery</h4>
                        <div class="footer_img">
                            <div class="single_footer_img">
                                <img src="/dpanel/img/footer_img/footer_img_1.png" alt="">
                            </div>
                            <div class="single_footer_img">
                                <img src="/dpanel/img/footer_img/footer_img_2.png" alt="">
                            </div>
                            <div class="single_footer_img">
                                <img src="/dpanel/img/footer_img/footer_img_3.png" alt="">
                            </div>
                            <div class="single_footer_img">
                                <img src="/dpanel/img/footer_img/footer_img_4.png" alt="">
                            </div>
                            <div class="single_footer_img">
                                <img src="/dpanel/img/footer_img/footer_img_5.png" alt="">
                            </div>
                            <div class="single_footer_img">
                                <img src="/dpanel/img/footer_img/footer_img_6.png" alt="">
                            </div>
                            <div class="single_footer_img">
                                <img src="/dpanel/img/footer_img/footer_img_7.png" alt="">
                            </div>
                            <div class="single_footer_img">
                                <img src="/dpanel/img/footer_img/footer_img_8.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <div class="col-lg-12">
                    <div class="copyright_text">
                        <P>
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> MedCharity  All rights reserved
                        </P>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--::footer_part end::-->

    <!-- jquery plugins here-->

    <script src="/dpanel/js/jquery-1.12.1.min.js"></script>
    <!-- popper js -->
    <script src="/dpanel/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="/dpanel/js/bootstrap.min.js"></script>
    <!-- easing js -->
    <script src="/dpanel/js/jquery.magnific-popup.js"></script>
    <!-- swiper js -->
    <script src="/dpanel/js/swiper.min.js"></script>
    <script src="/dpanel/js/wow.min.js"></script>
    <script src="/dpanel/js/jquery.smooth-scroll.min.js"></script>
    <!-- swiper js -->
    <script src="/dpanel/js/masonry.pkgd.js"></script>
    <!-- particles js -->
    <script src="/dpanel/js/owl.carousel.min.js"></script>
    <script src="/dpanel/js/jquery.nice-select.min.js"></script>
    <!-- swiper js -->
    <script src="/dpanel/js/slick.min.js"></script>
    <script src="/dpanel/js/jquery.counterup.min.js"></script>
    <script src="/dpanel/js/waypoints.min.js"></script>
    <script src="/dpanel/js/countdown.jquery.min.js"></script>
    <!-- contact js -->
    <script src="/dpanel/js/jquery.ajaxchimp.min.js"></script>
    <script src="/dpanel/js/jquery.form.js"></script>
    <script src="/dpanel/js/jquery.validate.min.js"></script>
    <script src="/dpanel/js/mail-script.js"></script>
    <script src="/dpanel/js/contact.js"></script>
    <!-- custom js -->
    <script src="/dpanel/js/custom.js"></script>

</body>

</html>