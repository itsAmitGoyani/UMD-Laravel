@extends('donator.layouts.app')
@section('content')
@extends('donator.layouts.app')
@section('content')
<!-- login part -->
<section class="padding_top">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6">
                <!-- <h4 class="widget_title">Newsletter</h4> -->

                <form action="#">
                    <div class="form-group">
                        <label><strong>Name</strong></label>
                        <input type="text" name="name" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter name'" placeholder='Enter name' required>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label><strong>Email</strong></label>
                        <input type="email" name="email" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label><strong>Password</strong></label>
                        <input type="password" name="password" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter password'" placeholder='Enter password' required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label><strong>Gender</strong></label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="male" name="inlineDefaultRadiosExample" value="male">
                            <label class="custom-control-label" for="male">Male</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="female" name="inlineDefaultRadiosExample" value="female">
                            <label class="custom-control-label" for="female">Female</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Contact</strong></label>

                        <input type="number" name="contact" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter contact'" placeholder='Enter contact' required>
                        @error('contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label><strong>Address</strong></label>

                        <textarea class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Address'" placeholder='Enter Address' rows="2" name="address"></textarea>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label><strong>Pincode</strong></label>
                        <input type="number" name="pincode" id="pincode" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter pincode'" placeholder='Enter pincode' required>
                        <span role="alert"><strong id="errpncd" style="Color:red"></strong></span>
                        @error('pincode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label><strong>State</strong></label>

                        <input type="text" name="state" id="state" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" placeholder='' readonly required>
                        @error('state')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label><strong>City</strong></label>

                        <input type="text" name="city" id="city" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = ''" placeholder='' readonly required>
                        @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label><strong>Profile Image</strong></label>
                        <div class="media pb-2">
                            <img src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg" id="viewimage" class="mr-3" alt="example placeholder avatar" height="100" width="100">
                        </div>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="pimage" onchange="LoadPhoto(event)">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a class="btn_3 " href="#">Register</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
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

    function LoadPhoto(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('viewimage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<!-- login part end -->

@endsection

@endsection