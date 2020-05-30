@extends('donator.layouts.app')
@section('content')
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item text-center">
                        <h2>Create Password</h2>
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
            <form method="POST" action="{{ route('CreatePassword-Donator') }}">
                @csrf
                <div class="form-group">
                    <label><strong>Email</strong></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Token</strong></label>
                    <input type="text" name="token" class="form-control @error('token') is-invalid @enderror" value="{{ old('token') }}" required>
                    @error('token')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Password</strong></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="" required>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Confirm Password</strong></label>
                    <input type="password" name="confirmpassword" class="form-control @error('confirmpassword') is-invalid @enderror" value="" required>
                    @error('confirmpassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn_3 ">Submit</button>
                </div>
                <div class="text-center mt-3">
                    <p>Go to <a class="text-primary" href="/login">Login</a>?</p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection