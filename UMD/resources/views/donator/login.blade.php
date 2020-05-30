@extends('donator.layouts.app')
@section('content')
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item text-center">
                        <h2>Login</h2>
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
        <div class="col-lg-6">
            <!-- <h4 class="widget_title">Newsletter</h4> -->
            @include('partial.customerror')
            @include('partial.success')
            <form method="POST" action="{{ route('LoginDonator') }}">
                @csrf
                <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'" placeholder='Enter email' value="{{old('email')}}" required>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Password</strong></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter password'" placeholder='Enter password' required>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn_3 ">Login</button>
                </div>
                <div class="form-row d-flex justify-content-between mt-4 mb-2">
                    <div class="form-group">
                        <div class="new-account">
                            <p>Don't have an account? <a class="text-primary" href="{{ route('RegisterDonator') }}">Register</a></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <p><a class="text-primary" href="{{ route('ForgotPassword-Donator') }}">Forgot Password?</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- </section> -->

<!-- login part end -->

@endsection