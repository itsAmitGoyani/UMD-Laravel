@extends('ngo.layouts.app')

@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        @include('partial.customerror')
        @include('partial.success')
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>All Medicine Verifiers</h4>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($verifiers as $verifier)
            <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="media pt-3 pb-3">
                            <img src="{{asset('storage' . __('custom.verifierpath') .'/'. $verifier->profileimage)}}" alt="image" height="80" width="80" class="mr-3">
                            <div class="media-body pl-3">
                                <h5 class="m-b-5">{{ $verifier->name }}</h5>
                                <p>Email :- {{ $verifier->email }}</p>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-sm-flex justify-content-between">
                        <div class="card-footer-link mb-4 mb-sm-0">
                            <p class="card-text text-dark d-inline">Actions</p>
                        </div>
                        <div>
                            <a href="/ngo/manager/verifier/{{$verifier->id}}/edit" class="btn btn-primary mr-2">Edit</a>
                            <form id="delete-form{{$verifier->id}}" action="/ngo/manager/verifier/{{$verifier->id}}" method="POST" style="display: none;">
                                @method('DELETE')
                                @csrf
                            </form>
                            <a href="#" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('delete-form{{$verifier->id}}').submit();">
                                Delete
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection