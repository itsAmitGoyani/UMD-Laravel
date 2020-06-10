@extends('donator.layouts.app')
@section('content')
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item text-center">
                        <h2>About Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!-- about part end-->
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
<!-- about part end-->
@endsection