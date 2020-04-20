@extends('admin.layouts.app')

@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        @if (session()->has('success'))
        <div class="alert alert-dismissable alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>
                {!! session()->get('success') !!}
            </strong>
        </div>
        @endif
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>All Managers</h4>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($managers as $manager)
            <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ $manager->name }}</h5>
                    </div>
                    <div class="card-body">
                        <img src="{{$manager->profile_image_url}}" id="viewimage" class="rounded-circle z-depth-1-half avatar-pic" height="70" width="70">

                        <p class="card-text">
                            {{ $manager->email }}
                        </p>
                    </div>
                    <div class="card-footer d-sm-flex justify-content-between">
                        <div class="card-footer-link mb-4 mb-sm-0">
                            <p class="card-text text-dark d-inline">{{ $manager->ngo->name }}</p>
                        </div>
                        <div>
                            <a href=""> <img class="logo-abbr" src="{{ asset('icons/icons/delete.png')}}"></a>
                            <a href="" class="btn btn-primary">Edit</a>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection