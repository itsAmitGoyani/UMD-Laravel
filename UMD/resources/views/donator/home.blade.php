<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Charity</title>
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
</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="/donator"> <img src="/dpanel/img/logo.png" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="ti-menu"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-end" id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item">
                                    <a class="nav-link" href="/donator">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="about.html">about</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="Causes.html">Causes</a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Pages
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="Event.html">Event</a>
                                        <a class="dropdown-item" href="elements.html">Elements</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        blog
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                        <a class="dropdown-item" href="blog.html">blog</a>
                                        <a class="dropdown-item" href="single-blog.html">Single blog</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Profile
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                        @if(Auth::guard('donator')->check())
                                        <a class="dropdown-item" href="/logout">Logout</a>
                                        @else
                                        <a class="dropdown-item" href="/login">Login</a>
                                        <a class="dropdown-item" href="/register">Register</a>
                                        @endif
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">Contact</a>
                                </li>
                                <li class="d-none d-lg-block">
                                    <a class="btn_2" href="#">learn more</a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->
    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7">
                    <div class="banner_text text-center">
                        <div class="banner_text_iner">
                            <h1>Help The <br>
                                Children in Need </h1>
                            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut</p>
                            <a href="#" class="btn_2">Start Donation</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner_video">
                        <div class="banner_video_iner">
                            <img src="/dpanel/img/banner_video.png" alt="">
                            <div class="extends_video">
                                <a id="play-video_1" class="video-play-button popup-youtube" href="https://www.youtube.com/watch?v=pBFQdxA-apI">
                                    <span class="fas fa-play"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    <!-- service part start-->
    <section class="service_part">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-4 col-sm-10">
                    <div class="service_text">
                        <h2>We are CharityPress
                            Funding Network
                            Worldwide.</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna
                            Lorem ipsum dolor sit amet consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna </p>
                        <a href="service.html" class="btn_3">learn more</a>
                    </div>
                </div>
                <div class="col-lg-7 col-xl-6">
                    <div class="service_part_iner">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="single_service_text ">
                                    <i class="flaticon-money"></i>
                                    <h4>Donation</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur elit seiusmod tempor incididunt</p>
                                    <a href="#">donate now</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="single_service_text">
                                    <i class="flaticon-money"></i>
                                    <h4>Adopt A Child</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur elit seiusmod tempor incididunt</p>
                                    <a href="#">contact us</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="single_service_text">
                                    <i class="flaticon-money"></i>
                                    <h4>Become A Volunteer</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur elit seiusmod tempor incididunt</p>
                                    <a href="#">read more</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="single_service_text">
                                    <i class="flaticon-money"></i>
                                    <h4>Donation</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur elit seiusmod tempor incididunt</p>
                                    <a href="#">donate now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service part end-->

    <!-- about part end-->
    <section class="about_us">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div class="about_us_img">
                        <img src="/dpanel/img/top_service.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about_us_text">
                        <h5>
                            2000<br><span>since</span>
                        </h5>
                        <h2>About Believe</h2>
                        <p>According to the research firm Frost & Sullivan, the estimated
                            size of the North American used test and measurement equipment
                            market was $446.4 million in 2004 and is estimated to grow to
                            $654.5 million by 2011. For over 50 years, companies and governments
                            have procured used test and measurement instruments.</p>
                        <div class="banner_item">
                            <div class="single_item">
                                <h2> <span class="count">50</span>k</h2>
                                <h5>Total
                                    Volunteer</h5>
                            </div>
                            <div class="single_item">
                                <h2><span class="count">25</span>k</h2>
                                <h5>Successed
                                    Mission</h5>
                            </div>
                            <div class="single_item">
                                <h2><span class="count">100</span>k</h2>
                                <h5>Total
                                    Collection</h5>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-lg-12">
                    <div class="text-center about_btn">
                        <a class="btn_3 " href="#">learn more</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about part end-->

    <!--::passion part start::-->
    <section class="passion_part passion_section_padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-8">
                    <div class="section_tittle">
                        <h2>Our Causes</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna </p>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4 col-xl-4">
                    <div class="single-home-passion">
                        <div class="card">
                            <img src="/dpanel/img/passion/passion_1.png" class="card-img-top" alt="blog">
                            <div class="card-body">

                                <a href="#">
                                    <h5 class="card-title">Fourth created forth fill
                                        created subdue be </h5>
                                </a>
                                <ul>
                                    <li><img src="/dpanel/img/icon/passion_1.svg" alt=""> Goal: $2500</li>
                                    <li><img src="/dpanel/img/icon/passion_2.svg" alt=""> Raised: $1533</li>
                                </ul>
                                <div class="skill">
                                    <div class="skill-bar skill11 wow slideInLeft animated">
                                        <span class="skill-count11">75%</span>
                                    </div>
                                </div>
                                <a href="#" class="btn_2">read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-4">
                    <div class="single-home-passion">
                        <div class="card">
                            <img src="/dpanel/img/passion/passion_2.png" class="card-img-top" alt="blog">
                            <div class="card-body">
                                <a href="#">
                                    <h5 class="card-title">Fourth created forth fill
                                        created subdue be </h5>
                                </a>
                                <ul>
                                    <li><img src="/dpanel/img/icon/passion_1.svg" alt=""> Goal: $2500</li>
                                    <li><img src="/dpanel/img/icon/passion_2.svg" alt=""> Raised: $1533</li>
                                </ul>
                                <div class="skill">
                                    <div class="skill-bar skill11 wow slideInLeft animated">
                                        <span class="skill-count11">75%</span>
                                    </div>
                                </div>
                                <a href="#" class="btn_2">read more</a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-4">
                    <div class="single-home-passion">
                        <div class="card">
                            <img src="/dpanel/img/passion/passion_3.png" class="card-img-top" alt="blog">
                            <div class="card-body">
                                <a href="#">
                                    <h5 class="card-title">Fourth created forth fill
                                        created subdue be </h5>
                                </a>
                                <ul>
                                    <li><img src="/dpanel/img/icon/passion_1.svg" alt=""> Goal: $2500</li>
                                    <li><img src="/dpanel/img/icon/passion_2.svg" alt=""> Raised: $1533</li>
                                </ul>
                                <div class="skill">
                                    <div class="skill-bar skill11 wow slideInLeft animated">
                                        <span class="skill-count11">75%</span>
                                    </div>
                                </div>
                                <a href="#" class="btn_2">read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::passion part end::-->

    <!-- intro_video_bg start-->
    <section class="intro_video_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-8">
                    <div class="intro_video_iner text-center">
                        <h2>Please raise your hand & Save world </h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna
                            aliqua. Quis ipsum suspendisse ultrices gravida.</p>
                        <a href="#" class="btn_2">Become a Volunteer</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- intro_video_bg part start-->

    <!--::event_part start::-->
    <section class="event_part">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-8">
                    <div class="section_tittle">
                        <h2>Upcoming Event</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="single_event media">
                        <img src="/dpanel/img/event_1.png" class="align-self-center" alt="...">
                        <div class="tricker">10 Jun</div>
                        <div class="media-body align-self-center">
                            <h5 class="mt-0">Volunteeer Idea 2020</h5>
                            <p>Seed the life upon you are creat.</p>
                            <ul>
                                <li><span id="days"></span>days</li>
                                <li><span id="hours"></span>Hours</li>
                                <li><span id="minutes"></span>Minutes</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="single_event media">
                        <img src="/dpanel/img/event_2.png" class="align-self-center" alt="...">
                        <div class="tricker">10 Jun</div>
                        <div class="media-body align-self-center">
                            <h5 class="mt-0">Volunteeer Idea 2020</h5>
                            <p>Seed the life upon you are creat.</p>
                            <ul>
                                <li><span id="days1"></span>days</li>
                                <li><span id="hours1"></span>Hours</li>
                                <li><span id="minutes1"></span>Minutes</li>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="single_event media">
                        <img src="/dpanel/img/event_3.png" class="align-self-center" alt="...">
                        <div class="tricker">10 Jun</div>
                        <div class="media-body align-self-center">
                            <h5 class="mt-0">Volunteeer Idea 2020</h5>
                            <p>Seed the life upon you are creat.</p>
                            <ul>
                                <li><span id="days2"></span>days</li>
                                <li><span id="hours2"></span>Hours</li>
                                <li><span id="minutes2"></span>Minutes</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="single_event media">
                        <img src="/dpanel/img/event_4.png" class="align-self-center" alt="...">
                        <div class="tricker">10 Jun</div>
                        <div class="media-body align-self-center">
                            <h5 class="mt-0">Volunteeer Idea 2020</h5>
                            <p>Seed the life upon you are creat.</p>
                            <ul>
                                <li><span id="days3"></span>days</li>
                                <li><span id="hours3"></span>Hours</li>
                                <li><span id="minutes3"></span>Minutes</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::event_part end::-->

    <!--::blog_part start::-->
    <section class="blog_part padding_bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-8">
                    <div class="section_tittle text-center">
                        <h2>Blog Post</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="single_blog">
                        <div class="appartment_img">
                            <img src="/dpanel/img/blog/blog_1.png" alt="">
                        </div>
                        <div class="single_appartment_content">
                            <a href="blog.html">
                                <h4>First cattle which earthcan get
                                    and see what

                                </h4>
                            </a>
                            <p>et dolore magna aliqua. Quis ipsum susp endisse ultrices gravida.
                                Risus com modo viverra maecenas accumsan lacus vel. </p>
                            <ul class="list-unstyled">
                                <li><a href=""> <span class="flaticon-calendar"></span> </a> May 10, 2019</li>
                                <li><a href=""> <span class="flaticon-comment"></span> </a> 1 comments</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single_blog">
                        <div class="appartment_img">
                            <img src="/dpanel/img/blog/blog_2.png" alt="">
                        </div>
                        <div class="single_appartment_content">
                            <a href="blog.html">
                                <h4>First cattle which earthcan get
                                    and see what

                                </h4>
                            </a>
                            <p>et dolore magna aliqua. Quis ipsum susp endisse ultrices gravida.
                                Risus com modo viverra maecenas accumsan lacus vel.
                            </p>
                            <ul class="list-unstyled">
                                <li><a href=""> <span class="flaticon-calendar"></span> </a> May 10, 2019</li>
                                <li><a href=""> <span class="flaticon-comment"></span> </a> 1 comments</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single_blog">
                        <div class="appartment_img">
                            <img src="img/blog/blog_3.png" alt="">
                        </div>
                        <div class="single_appartment_content">
                            <a href="blog.html">
                                <h4>First cattle which earthcan get
                                    and see what
                                </h4>
                            </a>
                            <p>et dolore magna aliqua. Quis ipsum susp endisse ultrices gravida.
                                Risus com modo viverra maecenas accumsan lacus vel.
                            </p>
                            <ul class="list-unstyled">
                                <li><a href=""> <span class="flaticon-calendar"></span> </a> May 10, 2019</li>
                                <li><a href=""> <span class="flaticon-comment"></span> </a> 1 comments</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::blog_part end::-->

    <!--::our client part start::-->
    <section class="client_part padding_bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="section_tittle text-center">
                        <h2>Who Donate us</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="client_logo owl-carousel">
                        <div class="single_client_logo">
                            <img src="/dpanel/img/client_logo/Logo_1.png" alt="">
                        </div>
                        <div class="single_client_logo">
                            <img src="/dpanel/img/client_logo/Logo_2.png" alt="">
                        </div>
                        <div class="single_client_logo">
                            <img src="/dpanel/img/client_logo/Logo_3.png" alt="">
                        </div>
                        <div class="single_client_logo">
                            <img src="/dpanel/img/client_logo/Logo_4.png" alt="">
                        </div>
                        <div class="single_client_logo">
                            <img src="/dpanel/img/client_logo/Logo_5.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::our client part end::-->

    <!--::footer_part start::-->
    <footer class="footer_part">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-sm-6 col-lg-3">
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
                <div class="col-sm-6 col-lg-2">
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
                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4>Newsletter</h4>
                        <p>Heaven fruitful doesn't over lesser in days. Appear creeping seasons deve behold bearing days
                            open
                        </p>
                        <div id="mc_embed_signup">
                            <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe_form relative mail_part" required>
                                <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address" class="placeholder hide-on-focus" onfocus="this.placeholder = ''" onblur="this.placeholder = ' Email Address '" required="" type="email">
                                <button type="submit" name="submit" id="newsletter-submit" class="email_icon newsletter-submit button-contactForm"><i class="far fa-paper-plane"></i></button>
                                <div class="mt-10 info"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <div class="copyright_text">
                        <P>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </P>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer_icon social_icon">
                        <ul class="list-unstyled">
                            <li><a href="#" class="single_social_icon"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" class="single_social_icon"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" class="single_social_icon"><i class="fas fa-globe"></i></a></li>
                            <li><a href="#" class="single_social_icon"><i class="fab fa-behance"></i></a></li>
                        </ul>
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
    <script src="/dpanel/js/timer.js"></script>
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