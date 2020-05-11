@extends('donator.layouts.app')
@section('content')
<!-- login part -->
<section class="padding_top">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6">
                <!-- <h4 class="widget_title">Newsletter</h4> -->

                <form method="POST" action="{{ route('LoginDonator') }}">
                    @csrf
                    <div class="form-group">
                        <label><strong>Email</strong></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
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
                </form>
                <div class="new-account mt-3">
                    <p>Don't have an account? <a class="text-primary" href="{{ route('RegisterDonator') }}">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- login part end -->

@endsection