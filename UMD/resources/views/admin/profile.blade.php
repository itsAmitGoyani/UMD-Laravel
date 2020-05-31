@extends('admin.layouts.app')

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
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="row pt-3 justify-content-center">
                                <div class="col-lg-6 col-md-6 col-sm-12 border-right-1 prf-col">
                                    <div class="text-center justify-content-center ">
                                        <h4 class="text-primary">{{$admin->name}}</h4>
                                        <p>Name</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 border-right-1 prf-col">
                                    <div class="text-center justify-content-center">
                                        <h4 class="text-muted">{{$admin->email}}</h4>
                                        <p>Email</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection