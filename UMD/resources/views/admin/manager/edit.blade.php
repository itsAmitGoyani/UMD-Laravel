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
                                        <h4 class="text-center mb-4">Edit NGO Manager</h4>
                                        @include('partial.customerror')
                                        @include('partial.success')
                                        <form method="POST" action="/admin-managers/{{$manager->id}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label><strong>Name</strong></label>
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                                        value="{{ $manager->name }}" required autocomplete="name">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Email</strong></label>
                                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" 
                                                        value="{{ $manager->email }}" required autocomplete="email">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Password</strong></label>
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                                        value="" required autocomplete="password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label><strong>NGO Branch</strong></label>
                                                <select class="form-control @error('ngo_id') is-invalid @enderror" id="ngo_id" 
                                                    name="ngo_id" required>
                                                    <option value="{!!$manager->ngo_id!!}" selected >{{ $manager->ngo->name }}</option>
                                                    @foreach($ngos as $ngo)
                                                    <option value="{!!$ngo->id!!}">{!!$ngo->name!!}</option>
                                                    @endforeach
                                                </select>
                                                @error('ngo_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label><strong>Profile Image</strong></label>
                                                <div class="media pb-2">
                                                <img src="{{asset('storage' . __('custom.managerpath') .'/'. $manager->profile_image_url)}}" 
                                                        id="viewimage" class="mr-3" 
                                                        alt="example placeholder avatar" height="100" width="100">
                                                </div>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"  name="pimage" onchange="LoadPhoto(event)">
                                                        <label class="custom-file-label">Choose file</label>
                                                    </div>
                                                    <!-- <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button">Upload</button>
                                                    </div> -->
                                                </div>  
                                            </div>

                                            <!-- <div class="form-group">
                                                <label><strong>Profile Image</strong></label>
                                                <input type="file" class="form-control" name="pimage" onchange="LoadPhoto(event)">
                                                @error('pimage')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div> -->

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

<!--**********************************
        Scripts
    ***********************************-->
<script>
    function LoadPhoto(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('viewimage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<!-- Required vendors -->
<script src="vendor/global/global.min.js"></script>
<script src="js/quixnav-init.js"></script>
<!--endRemoveIf(production)-->

@endsection