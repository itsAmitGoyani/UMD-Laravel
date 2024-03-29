@extends('admin.layouts.app')

@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
    @include('partial.customerror')
    @include('partial.success')
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>All NGOs</h4>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($ngos as $ngo)
            <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ $ngo->name }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            {{ $ngo->address }}. {{ $ngo->pincode }}
                        </p>
                    </div>
                    <div class="card-footer d-sm-flex justify-content-between">
                        <div class="card-footer-link mb-4 mb-sm-0">
                            <p class="card-text text-dark d-inline">{{ $ngo->city }}, {{ $ngo->state }}</p>
                        </div>
                        <div>
                            <a href="/admin/ngos/{{$ngo->id}}/edit" class="btn btn-primary mr-1">Edit</a>
                            <a href="#" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('delete-form').submit();">
                                Delete
                            </a>
                            <form id="delete-form" action="/admin/ngos/{{$ngo->id}}" method="POST" style="display: none;">
                                @method('DELETE')
                                @csrf
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection