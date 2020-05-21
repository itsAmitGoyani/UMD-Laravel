@extends('ngo.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<div class="content-body">
    <div class="container-fluid">
        @include('partial.customerror')
        @include('partial.success')
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Taken Donation</h4><br>
                    <span class="ml-0">DonationID #{{ $donation->id }}</span>
                    <span class="ml-2">Donator #{{ $donation->donator->name }}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="welcome-text">Medicine Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('AddMedicine-Verifier') }}">
                                @csrf
                                <div class="form-row">
                                    <input type="hidden" name="did" value="{{ $donation->id }}"/>
                                    <div class="form-group col-md-6">
                                        <label>Medicine Category</label>
                                        <select name="category" class="form-control  @error('category') is-invalid @enderror" id="single-select" required>
                                            @foreach($mcategories as $mcategory)
                                                <option value="{{ $mcategory->id }}">{{ $mcategory->categoryname }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Medicine Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Brand</label>
                                        <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand') }}" required autocomplete="brand">
                                        @error('brand')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div id="expirationdiv">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Expiry Date</label>
                                        <input type="text" name="expdate[]" class="form-control" required>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label>Quantity</label>
                                        <div class="input-group"> 
                                        <input type="number" name="qty[]" class="form-control" required>
                                        <div class="input-group-btn">
                                            <button class="btn btn-success" type="button"  onclick="expirationFields();"> <i class="fa fa-plus fa-lg" aria-hidden="true"></i> </button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Medicines</h4>
                    </div>
                    <div class="card-body" id="tbdiv">
                        <div class="table-responsive">
                            <table class="table header-border table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Medicine Name</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Expiry Date</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dms as $dm)
                                    @foreach($dm->expirations as $expiration)
                                    <tr>
                                        <td>#{{ $dm->id }}</td>
                                        <td><span class="text-muted">{{ $dm->medicine->name }}</span></td>
                                        <td><span class="text-muted">{{ $dm->medicine->category->categoryname }}</span></td>
                                        <td><span class="text-muted">{{ $dm->medicine->brand }}</span></td>
                                        <td><span class="text-muted">{{ $expiration->expirydate }}</span></td>
                                        <td><span class="text-muted">{{ $expiration->qty }}</span></td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-sm-flex justify-content-between">
                        <div class="card-footer-link mb-4 mb-sm-0">
                            <a href="/ngo/verifier/addtostock/{{$donation->id}}" class="btn btn-primary mr-2">Add Medicines to Stock</a>
                        </div>
                        <div>
                            <a href="/ngo/manager/pickupmen/{{$donation->id}}/edit" class="btn btn-primary mr-2">Edit</a>
                            <form id="delete-form{{$donation->id}}" 
                                action="/ngo/manager/pickupmen/{{$donation->id}}" method="POST" style="display: none;">
                                @method('DELETE')
                                @csrf
                            </form>
                            <a href="#" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('delete-form{{$donation->id}}').submit();">
                                Delete
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var room = 1;
function expirationFields() {
 
    room++;
    var objTo = document.getElementById('expirationdiv')
    var divtest = document.createElement("div");
	divtest.setAttribute("class", "form-row removeclass"+room);
	var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<div class="form-group col-md-6"><label>Expiry Date</label><input type="text" name="expdate[]" class="form-control" required></div><div class="form-group col-md-6"><label>Quantity</label><div class="input-group"><input type="number" name="qty[]" class="form-control" required><div class="input-group-btn"><button class="btn btn-danger" type="button" onclick="remove_expirationFields('+ room +');"> <i class="fa fa-minus fa-lg" aria-hidden="true"></i> </button></div></div></div>';
    
    objTo.appendChild(divtest)
}
   function remove_expirationFields(rid) {
	   $('.removeclass'+rid).remove();
   }
</script>
    <script src="{{ asset('vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/select2-init.js') }}"></script>
@endsection