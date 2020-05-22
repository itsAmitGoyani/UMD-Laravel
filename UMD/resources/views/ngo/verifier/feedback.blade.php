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
                    <h4>Feedback for DonationID #{{$id}}</h4>
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="welcome-text">Feedback Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('SubmitFeedback-Verifier') }}">
                                @csrf
                                
                                    <input type="hidden" name="did" value="{{ $id }}" />
                                    <div class="form-group col-md-12">
                                        <label>Feedback Category</label>
                                        <select name="category" class="form-control  @error('category') is-invalid @enderror" id="single-select" required>
                                            @foreach($fcategories as $fcategory)
                                            <option value="{{ $fcategory->id }}">{{ $fcategory->categoryname }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Description</label>
                                        <textarea name="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" required autocomplete="name"></textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
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