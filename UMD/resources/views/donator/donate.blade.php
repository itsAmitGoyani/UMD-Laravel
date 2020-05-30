<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Charity</title>
    <link rel="icon" href="/dpanel/img/favicon.png">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="/dpanel/css/bootstrap.min.css"> -->
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

    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css" rel="stylesheet" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css" rel="stylesheet" />
    

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
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
                                    <a class="nav-link" href="about.html">about</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="Causes.html">Causes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">Contact</a>
                                </li>
                                @if(Auth::guard('donator')->check())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('viewDonations-Donator') }}">Donation History</a>
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

    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item text-center">
                            <h2>Donate</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end-->
    <div class="container pt-5 pb-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6">
                @include('partial.customerror')
                @include('partial.success')
                <form method="POST" action="{{ route('Donate') }}" id="dateform">
                    @csrf
                    <div class="form-group">
                        <label><strong>NGO Branch</strong></label>
                        <select class="form-control @error('ngo_id') is-invalid @enderror" id="ngo_id" name="ngo_id" required>
                            <option value="">--select NGO--</option>
                            @foreach($ngos as $ngo)
                            <option value="{!!$ngo->id!!}">{!!$ngo->name!!}</option>
                            @endforeach
                        </select>
                        @error('ngo_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group pt-5">
                        <label><strong>Date</strong></label>
                        <div class="input-group date">
                            <input type="text" name="date" class="form-control  @error('date') is-invalid @enderror" id="datepicker" readonly required>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                            @error('ngo_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center pt-3">
                        <input type="submit" class="btn_3 " value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- </section> -->

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
                            <li><a href="{{route('admin-login')}}">Admin Panel</a></li>
                            <li><a href="{{route('NGOPanel')}}">NGO Panel</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4>Causes</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Boat Shippment</a></li>
                            <li><a href="">Services</a></li>
                            <li><a href="">Transport Planning</a></li>
                            <li><a href="">Transportation</a></li>
                            <li><a href="">Truck Delivery Checking</a></li>
                        </ul>
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
                            </script> All rights reserved
                        </P>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--::footer_part end::-->

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>


    <script type="text/javascript">
        var disabledates = [];

        $(document).ready(function() {

            $("#ngo_id").change(function() {
                var id = $(this).val();
                // console.log("1:" + id);
                var dataString = '{id:' + id + '}';
                // console.log("2:" + dataString);
                $.ajax({
                    type: "GET",
                    url: "{{url('/disabledates')}}",
                    data: {
                        'id': id
                    },
                    cache: false,
                    success: function(data) {
                        disabledates = data;
                        //  console.log("3: this is disable" + disabledates);
                        $('#datepicker').datepicker('destroy');
                        var date = new Date();
                        var temp = date.getDate() + 1;
                        date.setDate(temp);
                        $('#datepicker').datepicker({
                            format: 'yyyy-mm-dd',
                            startDate: date,
                            todayHighlight: false,
                            updateViewDate: false,
                            datesDisabled: disabledates,
                        });
                    },
                });
            });
        });
    </script>
    <!-- jquery plugins here-->

    <!-- <script src="/dpanel/js/jquery-1.12.1.min.js"></script> -->
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