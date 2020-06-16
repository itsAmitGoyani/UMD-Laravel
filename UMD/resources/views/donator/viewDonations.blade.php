@extends('donator.layouts.app')
@section('content')
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item text-center">
                        <h2>View Donation History</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="whole-wrap">
    <div class="container box_1170">
        <div class="section-top-border">
            <h3 class="mb-30">Pending Donations</h3>
            <div class="progress-table-wrap">
                <div class="progress-table">
                    <div class="table-head">
                        <div class="serial">#</div>
                        <div class="country">NGO Name</div>
                        <div class="visit">Scheduled Date</div>
                        <div class="percentage">Status</div>
                    </div>
                    
                    @foreach($pendingdonations as $pdonation)
                    <div class="table-row">
                        <div class="serial">#</div>
                        <div class="country">{{ $pdonation->ngo->name }}</div>
                        <div class="visit">{{ $pdonation->date }}</div>
                        <div class="percentage">{{ $pdonation->status }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="section-top-border">
            <h3 class="mb-30">Donation History</h3>
            <div class="progress-table-wrap">
                <div class="progress-table">
                    <div class="table-head">
                        <div class="serial">#</div>
                        <div class="country">NGO Name</div>
                        <div class="visit">Date</div>
                    </div>
                    @foreach($donations as $donation)
                    <div class="table-row">
                        <div class="serial">#</div>
                        <div class="country">{{ $donation->ngo->name }}</div>
                        <div class="visit">{{ $donation->date }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection