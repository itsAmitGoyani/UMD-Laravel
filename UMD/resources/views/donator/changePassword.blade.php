@extends('donator.layouts.app')
@section('content')
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item text-center">
                        <h2>Change Password</h2>
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
            <form method="POST" action="{{ route('ChangePassword-Donator') }}">
                @csrf
                <div class="form-group">
                    <label><strong>Old Password</strong></label>
                    <input type="password" name="OldPassword" class="form-control @error('OldPassword') is-invalid @enderror" value="{{ old('OldPassword') }}" required>
                    @error('OldPassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>New Password</strong></label>
                    <input type="password" name="NewPassword" class="form-control @error('NewPassword') is-invalid @enderror" required>
                    @error('NewPassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Confirm Password</strong></label>
                    <input type="password" name="ConfirmPassword" class="form-control @error('ConfirmPassword') is-invalid @enderror" required>
                    @error('ConfirmPassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn_3 ">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection