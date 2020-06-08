@extends('ngo.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        @include('partial.customerror')
        @include('partial.success')
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Medicine Stock</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Index</th>
                                        <th>ID</th>
                                        <th>Medicine Name</th>
                                        <th>Category Name</th>
                                        <th>Brand</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach($medicinestocks as $medicinestock)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td><span class="text-muted">#{{ $medicinestock->id }}</span></td>
                                        <td><span class="text-muted">{{ $medicinestock->medicine->name }}</span></td>
                                        <td><span class="text-muted">{{ $medicinestock->medicine->category->categoryname }}</span></td>
                                        <td><span class="text-muted">{{ $medicinestock->medicine->brand }}</span></td>
                                        <td><span class="text-muted">{{ $medicinestock->qty }}</span></td>
                                    </tr>
                                    <?php $i++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection