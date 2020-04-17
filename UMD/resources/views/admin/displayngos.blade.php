@extends('admin.layouts.app')

@section('content')

@if (session()->has('success'))
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
    <div class="alert alert-dismissable alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>
            {!! session()->get('success') !!}
        </strong>
    </div>
    </div>
</div>
@endif


@endsection