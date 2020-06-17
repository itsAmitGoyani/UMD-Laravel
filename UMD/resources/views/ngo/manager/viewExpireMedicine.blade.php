@extends('ngo.layouts.app')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        @include('partial.customerror')
        @include('partial.success')
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Expire Medicine</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body" id="tablediv">
                        <div class="table-responsive">
                            <table class="table header-border table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Medicine Name</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($expiremedicines as $expiremedicine)
                                    <tr>
                                        <td>#{{ $expiremedicine->medicine_stock_id }}</td>
                                        <td><span class="text-muted">{{ $expiremedicine->medicine->name }}</span></td>
                                        <td><span class="text-muted">{{ $expiremedicine->medicine->category->categoryname }}</span></td>
                                        <td><span class="text-muted">{{ $expiremedicine->medicine->brand }}</span></td>
                                        <td><span class="text-muted">{{ $expiremedicine->qty }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-sm-flex justify-content-center">
                    <div class="card-footer-link mb-4 mb-sm-0">
                        <a href="/ngo/manager/removemedicine" class="btn btn-primary mr-2">Remove</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection