@extends('donator.layouts.app')
@section('content')
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item text-center">
                        <h2>Forgot Password</h2>
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
            <form method="POST" action="{{ route('ForgotPassword-Donator') }}">
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