@extends('donator.layouts.app')
@section('content')
<!-- banner part start-->
<section class="banner_part">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-7">
                <div class="banner_text text-center">
                    <div class="banner_text_iner">
                        <h1>Help The <br>
                            People in Need </h1>
                        <p>Donate medicines for people who actualy needs</p>
                        <a href="/donate" class="btn_2">Start Donation</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="banner_video">
                    <div class="banner_video_iner">
                        <img src="/dpanel/img/banner_video.png" alt="">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner part start-->

<!-- service part start-->
<section class="service_part">
    <section class="about_us padding_top">
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
                            2008<br><span>since</span>
                        </h5>
                        <h2>About Believe</h2>
                        <p>According to the research firm Frost & Sullivan, the estimated
                            size of the North American used test and measurement equipment
                            market was $446.4 million in 2004 and is estimated to grow to
                            $654.5 million by 2011. For over 50 years, companies and governments
                            have procured used test and measurement instruments.</p>
                        <div class="banner_item">
                            <div class="single_item">
                                <h2> <span class="count">{{$tds}}</span>k</h2>
                                <h5>Total
                                    Donators</h5>
                            </div>
                            <div class="single_item">
                                <h2><span class="count">{{$tn}}</span></h2>
                                <h5>Total
                                    NGOs</h5>
                            </div>
                            <div class="single_item">
                                <h2><span class="count">{{$td}}</span>k</h2>
                                <h5>Total
                                    Donations</h5>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

</section>
<!-- service part end-->

<!-- ================ contact section start ================= -->
<section class="contact-section section_padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="contact-title">Get in Touch</h2>
            </div>
            <div class="col-lg-8">
                <form class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">

                                <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder='Enter Message'></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder='Enter your name'>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder='Enter email address'>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder='Enter Subject'>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn_3">Send Message <i class="flaticon-right-arrow"></i> </button>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-home"></i></span>
                    <div class="media-body">
                        <h3>Surat, Gujarat.</h3>
                        <p>Silver Hub, 312</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                    <div class="media-body">
                        <h3>00 (440) 9865 562</h3>
                        <p>Mon to Fri 9am to 6pm</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-email"></i></span>
                    <div class="media-body">
                        <h3>support@medcharity.com</h3>
                        <p>Send us your query anytime!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================ contact section end ================= -->

<section class="intro_video_bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-8">
                <div class="intro_video_iner text-center">
                    <h2>Please raise your hand & Save world </h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna
                        aliqua. Quis ipsum suspendisse ultrices gravida.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection