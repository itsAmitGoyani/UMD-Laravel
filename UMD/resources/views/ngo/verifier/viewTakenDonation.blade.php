@extends('ngo.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<div class="content-body">
    <div class="container-fluid">
        @include('partial.customerror')
        @include('partial.success')
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Taken Donation</h4><br>
                    <span class="ml-0">DonationID #{{ $donation->id }}</span>
                    <span class="ml-2">Donator #{{ $donation->donator->name }}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="welcome-text">Medicine Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('AddMedicine-Verifier') }}">
                                @csrf
                                <div class="form-row">
                                    <input type="hidden" name="did" value="{{ $donation->id }}"/>
                                    <div class="form-group col-md-6">
                                        <label>Medicine Category</label>
                                        <select name="category" class="form-control  @error('category') is-invalid @enderror" id="single-select" required>
                                            @foreach($mcategories as $mcategory)
                                                <option value="{{ $mcategory->id }}">{{ $mcategory->categoryname }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Medicine Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Brand</label>
                                        <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand') }}" required autocomplete="brand">
                                        @error('brand')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Expiry Date</label>
                                        <input type="text" name="expdate" class="form-control @error('expdate') is-invalid @enderror" value="{{ old('expdate') }}" required autocomplete="expdate">
                                        @error('expdate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Quantity</label>
                                        <input type="number" name="qty" class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty') }}" required autocomplete="qty">
                                        @error('qty')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/select2-init.js') }}"></script>
@endsection