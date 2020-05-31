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
                                        <h4 class="text-center mb-4">Add Medicine Category</h4>
                                        @include('partial.customerror')
                                        @include('partial.success')
                                        <form method="POST" action="{{ route('AddMCategory-Verifier') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label><strong>Medicine Category</strong></label>
                                                <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" required autocomplete="category">
                                                @error('category')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-block">Add</button>
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