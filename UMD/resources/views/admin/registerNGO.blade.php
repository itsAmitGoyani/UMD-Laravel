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
                                        <h4 class="text-center mb-4">NGO Registration</h4>
                                        @include('partial.customerror')
                                        @include('partial.success')
                                        <form method="POST" action="{{ route('admin-registerngo') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label><strong>NGO Name</strong></label>
                                                <input type="text" name="name" 
                                                        class="form-control @error('name') is-invalid @enderror" 
                                                        value="{{ old('name') }}" required autocomplete="name">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Address</strong></label>
                                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" 
                                                        rows="2" required cols="20" value="" 
                                                        autocomplete="address">{{ old('address') }}</textarea>
                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Pincode</strong></label>
                                                <input type="number" name="pincode" id="pincode" 
                                                        class="form-control @error('pincode') is-invalid @enderror" 
                                                        value="{{ old('pincode') }}" required autocomplete="pincode">
                                                <span role="alert"><strong id="errpncd" style="Color:red"></strong></span>
                                                @error('pincode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label><strong>City</strong></label>
                                                <input type="text" name="city" id="city" 
                                                        class="form-control @error('city') is-invalid @enderror" 
                                                        value="{{ old('city') }}" readonly required autocomplete="city">
                                                @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label><strong>State</strong></label>
                                                <input type="text" name="state" id="state" 
                                                        class="form-control @error('state') is-invalid @enderror" 
                                                        value="{{ old('state') }}" readonly required autocomplete="state">
                                                @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            
                                            <!-- <div class="form-group">
                                                <label><strong>State</strong></label>
                                                <select class="form-control @error('state') is-invalid @enderror" id="state" name="state" required>
                                                    <option value="">--select state--</option>
                                                    <option value="Gujarat">Gujarat</option>
                                                    <option value="Maharashtra">Maharashtra</option>
                                                    <option value="Rajasthan">Rajasthan</option>
                                                </select>
                                                @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label><strong>City</strong></label>
                                                <select class="form-control @error('city') is-invalid @enderror" id="city" name="city" required>
                                                    <option value="">--select city--</option>
                                                    <option value="Gujarat">Gujarat</option>
                                                    <option value="Maharashtra">Maharashtra</option>
                                                    <option value="Rajasthan">Rajasthan</option>
                                                </select>
                                                @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div> -->
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-block">Register</button>
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
<script>
    $(document).ready(function() {
        $("#pincode").change(function() {
            var pincode = $(this).val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "https://api.postalpincode.in/pincode/" + pincode,
                success: function(data) {

                    if (data[0]["Status"] == "Success") {
                        var err = null;
                        document.getElementById("errpncd").innerText = err;
                        var state = data[0]["PostOffice"][0]["Circle"];
                        var district = data[0]["PostOffice"][0]["District"];
                        document.getElementById("state").value = state;
                        document.getElementById("city").value = district;
                    } else {
                        //console.log(data);
                        var err = "Pincode is not Valid";
                        document.getElementById("errpncd").innerText = err;
                        var state = null
                        var district = null;
                        document.getElementById("state").value = state;
                        document.getElementById("city").value = district;
                    }



                    // console.log(data[0]["PostOffice"][0]["Circle"]);
                    // console.log(data[0]["PostOffice"][0]["District"]);
                },
            });
        });
    });
</script>
<!--**********************************
        Scripts
    ***********************************-->
<!-- Required vendors -->

<script src="vendor/global/global.min.js"></script>
<script src="js/quixnav-init.js"></script>
<!--endRemoveIf(production)-->

@endsection