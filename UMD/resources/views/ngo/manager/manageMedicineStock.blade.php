@extends('ngo.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<div class="content-body">
    <div class="container-fluid">
        @include('partial.customerror')
        @include('partial.success')
        <!-- Success Alert -->
        <div class="alert alert-success fade show" id="successdiv">
            <strong>Success!</strong> Medicine Stock updated successfully.
        </div>
        <!-- Error Alert -->
        <div class="alert alert-danger fade show" id="errordiv">
            <strong>Error!</strong> sorry, A problem has been occurred.
        </div>
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Manage Medicine Stock</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row col-12 justify-content-center align-items-center">
                    <div class="card col-lg-6 col-sm-12">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Medicine Name</label>
                                    <select name="mid" class="form-control medi @error('category') is-invalid @enderror" required>
                                        <option value="select">--select--</option>
                                        @foreach($mids as $mid)
                                        <option value="{{$mid->medicine_id}}">{{ $mid->medicine->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('mid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table header-border table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>Medicine Category</th>
                                                <th>Medicine Name</th>
                                                <th>Brand</th>
                                                <th>Qty</th>
                                                <th>Enter Qty</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablebody">
                                            <tr id="trtag"></tr>
                                        </tbody>
                                    </table>
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
        $('#successdiv').hide();
        $('#errordiv').hide();
        $("select.medi").change(function() {
            $('#successdiv').hide();
            $('#errordiv').hide();
            var mid = $(this).val();
            if (mid != "select") {
                $.ajax({
                    type: "GET",
                    url: "/ngo/manager/managemedicinestock/" + mid,
                    success: function(data) {
                        var objTo = document.getElementById('tablebody')
                        $('#trtag').remove();
                        var trtag = document.createElement("tr");
                        trtag.setAttribute("id", "trtag");
                        trtag.innerHTML = '<td><span class="text-muted">' + data["mc"] + '</span></td><td><span class="text-muted">' + data["mn"] + '</span><td><span class="text-muted">' + data["brand"] + '</span></td></td><td><span class="text-muted">' + data["qty"] + '</span></td><td><input type="number" class="form-control" name="qtynumber" id="qtynumber"></td><td><div name="removebtn" id="removebtn"><span class="btn btn-primary btn-sm">Remove</span></div></td>';
                        objTo.appendChild(trtag);
                        var qty = data['qty'];
                        var id = data['id'];
                        $("#removebtn").click(function() {
                            var qtyr = $("#qtynumber").val();
                            if (qtyr <= qty && qtyr > 0) {
                                $.ajax({
                                    type: "GET",
                                    url: "/ngo/manager/removemedicinestock/" + id + "/" + qtyr,
                                    datatype: 'json',
                                    success: function(response) {
                                        console.log(response);
                                        if (response['msg'] == 'Yes') {
                                            $('#successdiv').show();
                                            $('select.medi option:selected').attr("selected",null);
                                            $('select.medi option[value="select"]').attr("selected","selected");
                                            var objTo = document.getElementById('tablebody')
                                            $('#trtag').remove();
                                            var trtag = document.createElement("tr");
                                            trtag.setAttribute("id", "trtag");
                                            objTo.appendChild(trtag);
                                        } else {
                                            $('#errordiv').show();
                                        }
                                    },
                                    error: function(error) {
                                        console.log(error);
                                        $('#errordiv').show();
                                    }
                                });
                                console.log(qtyr);
                            }

                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            } else {
                var objTo = document.getElementById('tablebody')
                $('#trtag').remove();
                var trtag = document.createElement("tr");
                trtag.setAttribute("id", "trtag");
                objTo.appendChild(trtag);
            }
        });

    });
</script>
<script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/plugins-init/select2-init.js') }}"></script>
@endsection