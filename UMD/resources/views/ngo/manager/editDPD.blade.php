@extends('ngo.layouts.app')

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
                                        <h4 class="text-center mb-4">Edit Donations Per Day for {{$ngo->name}}</h4>
                                        @include('partial.customerror')
                                        @include('partial.success')
                                        <form method="POST" action="{{ route('UpdateDPD-Manager') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label><strong>DPD</strong></label>
                                                <input type="text" name="dpd" class="form-control @error('dpd') is-invalid @enderror" value="{{ $ngo->dpd }}" required autocomplete="dpd">
                                                @error('dpd')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-block">Update</button>
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


@endsection