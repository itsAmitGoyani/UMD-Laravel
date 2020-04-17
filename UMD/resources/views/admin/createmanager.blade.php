@extends('admin.home')

@section('content')
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome back!</h4>
                    <span class="ml-1">Create Manager</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Manager</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Manager</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-6 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">NGO Manager</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('addmanager') }}">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control form-control-lg" name="name" type="text" placeholder="Enter a name">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-lg" name="email" type="text" placeholder="Enter a Email">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-lg" name="password" type="text" placeholder="Enter a Password">
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-control-lg" name="ngo_id">
                                        <option value="1">Surat</option>
                                        <option value="2">Mumbai</option>
                                        <option value="3">Vadodra</option>
                                        <option value="4">Ahmedabad</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
            Content body end
***********************************-->

@endsection