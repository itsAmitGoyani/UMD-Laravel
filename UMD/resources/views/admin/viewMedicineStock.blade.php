@extends('admin.layouts.app')

@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="authincation h-100">
            <div class="container-fluid h-100">
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="welcome-text">Select NGO</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="POST" action="{{ route('selectMedicineCategory') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label><strong>NGO</strong></label>
                                            <select class="form-control @error('ngo_id') is-invalid @enderror" id="ngo_id" name="ngo_id" required>
                                                <option value="">--select NGO--</option>
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
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NGO Name</th>
                                                <th>Medicine Name</th>
                                                <th>Category Name</th>
                                                <th>Brand</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(Session::get('medicinestocks'))
                                            @foreach(Session::get('medicinestocks') as $medicinestock)
                                            <tr id="tr{{ $medicinestock->id }}">
                                                <td>#{{ $medicinestock->id }}</td>
                                                <td><span class="text-muted">{{ $medicinestock->ngo->name }}</span></td>
                                                <td><span class="text-muted">{{ $medicinestock->medicine->name }}</span></td>
                                                <td><span class="text-muted">{{ $medicinestock->medicine->category->categoryname }}</span></td>
                                                <td><span class="text-muted">{{ $medicinestock->medicine->brand }}</span></td>
                                                <td><span class="text-muted">{{ $medicinestock->qty }}</span></td>
                                            </tr>
                                            @endforeach
                                            @endif
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


@endsection