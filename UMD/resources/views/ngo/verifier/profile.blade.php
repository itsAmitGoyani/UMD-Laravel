@extends('ngo.layouts.app')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        @include('partial.customerror')
        @include('partial.success')
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Profile</h4>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12 justify-content-center">
                            <div class="media justify-content-center pt-3">
                                <img src="{{asset('storage' . __('custom.verifierpath') .'/'. $verifier->profileimage)}}" alt="image" height="120" width="120" class="mr-3">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row pt-5 justify-content-center">
                                <div class="col-lg-4 col-md-4 col-sm-12 border-right-1 prf-col">
                                    <div class="text-center justify-content-center ">
                                        <h4 class="text-primary">{{$verifier->name}}</h4>
                                        <p>Name</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 border-right-1 prf-col">
                                    <div class="text-center justify-content-center">
                                        <h4 class="text-muted">{{$verifier->email}}</h4>
                                        <p>Email</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 border-right-1 prf-col">
                                    <div class="text-center justify-content-center">
                                        <h4 class="text-muted">{{$verifier->ngo->name}}</h4>
                                        <p>NGO</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card-footer d-sm-flex justify-content-between">
                        <div class="card-footer-link mb-4 mb-sm-0">
                        <a href="/ngo/verifier/changepassword" class="btn btn-primary mr-2">Change Password</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>


@endsection