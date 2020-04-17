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
                                        <h4 class="text-center mb-4">NGO Registration</h4>
                                        @error('errmsg')
                                        <div class="alert alert-dismissable alert-danger">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <li><strong>{!! $message !!}</strong></li>
                                        </div>
                                        @enderror

                                        <form method="POST" action="{{ route('admin-registerngo') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label><strong>NGO Name</strong></label>
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Address</strong></label>
                                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2" required cols="20" value="{{ old('address') }}" autocomplete="address"></textarea>
                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Pincode</strong></label>
                                                <input type="number" name="pincode" class="form-control @error('pincode') is-invalid @enderror" value="{{ old('pincode') }}" required autocomplete="pincode">
                                                @error('pincode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label><strong>State</strong></label>
                                                <select class="form-control @error('state') is-invalid @enderror" id="state" name="state" required>
                                                    <option value="">--select state--</option>
                                                    <option value="Gujarat">Gujarat</option>
                                                    <option value="Maharashtra">Maharashtra</option>
                                                    <option value="Rajasthan">Rajasthan</option>
                                                </select>
                                                @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label><strong>City</strong></label>
                                                <select class="form-control @error('city') is-invalid @enderror" id="city" name="city" required>
                                                    <option value="">--select city--</option>
                                                    <option value="Gujarat">Gujarat</option>
                                                    <option value="Maharashtra">Maharashtra</option>
                                                    <option value="Rajasthan">Rajasthan</option>
                                                </select>
                                                @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                                            </div>

                                        </form>
                                        <!-- <div class="new-account mt-3">
                                        <p>Already have an account? <a class="text-primary" href="page-login.html">Sign in</a></p>
                                    </div> -->
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
<!--**********************************
        Scripts
    ***********************************-->
<!-- Required vendors -->
<script src="vendor/global/global.min.js"></script>
<script src="js/quixnav-init.js"></script>
<!--endRemoveIf(production)-->

@endsection