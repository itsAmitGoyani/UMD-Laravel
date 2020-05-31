@extends('admin.layouts.app')

@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="authincation h-100">
            <div class="container-fluid h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-md-9">
                        <div class="authincation-content">
                            <div class="row no-gutters">
                                <div class="col-xl-12">
                                    <div class="auth-form">
                                        <h4 class="text-center mb-4">Change Password</h4>
                                        @include('partial.customerror')
                                        @include('partial.success')
                                        <form method="POST" action="{{ route('ChangePassword-Admin') }}">
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
                                                <button type="submit" class="btn btn-primary btn-block">Update</button>
                                            </div>
                                        </form>
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