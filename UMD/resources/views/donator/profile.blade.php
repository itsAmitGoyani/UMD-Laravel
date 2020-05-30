@extends('donator.layouts.app')
@section('content')
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item text-center">
                        <h2>Profile</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb end-->
<!-- login part -->
<!-- <section class="padding_top"> -->
<div class="container pt-5 pb-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-12">
            <!-- <h4 class="widget_title">Newsletter</h4> -->
            @include('partial.customerror')
            @include('partial.success')
            <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12 justify-content-center">
                            <div class="media justify-content-center pt-3">
                                <img src="{{asset('storage' . __('custom.donatorpath') .'/'. $donator->profileimage)}}" alt="image" height="150" width="150" class="mr-3">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row pt-5 justify-content-center">
                                <div class="col-lg-3 col-md-4 col-sm-12 border-right-1 prf-col pt-5">
                                    <div class="text-center justify-content-center ">
                                        <h4 class="text-primary">{{$donator->name}}</h4>
                                        <p>Name</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12 border-right-1 prf-col pt-5">
                                    <div class="text-center justify-content-center">
                                        <h4 class="text-muted">{{$donator->email}}</h4>
                                        <p>Email</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12 border-right-1 prf-col pt-5">
                                    <div class="text-center justify-content-center">
                                        <h4 class="text-muted">{{$donator->contact}}</h4>
                                        <p>Contact</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12 border-right-1 prf-col pt-5">
                                    <div class="text-center justify-content-center">
                                        <h4 class="text-muted">{{$donator->gender}}</h4>
                                        <p>Gender</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-8 col-sm-12 border-right-1 prf-col pt-5">
                                    <div class="text-center justify-content-center">
                                        <h4 class="text-muted">{{$donator->address}}, {{$donator->city}}, {{$donator->state}}. {{$donator->pincode}}</h4>
                                        <p>Address</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="text-center pt-5">
                <a href="/changepassword" class="btn_3 w-25">Change Password</a>
            </div>
        </div>
    </div>
</div>
<!-- </section> -->

<!-- login part end -->

@endsection