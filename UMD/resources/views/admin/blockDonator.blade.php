@extends('admin.layouts.app')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        @include('partial.customerror')
        @include('partial.success')

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Block Donator</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Today</h4>
                    </div>
                    <div class="card-body" id="tablediv">
                        <div class="table-responsive">
                            <table class="table header-border table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>Donator ID</th>
                                        <th>Donator Name</th>
                                        <th>City,State</th>
                                        <th>Feedback</th>
                                        <th>NGO</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($baddonators as $baddonator)
                                    <tr id="tr{{ $baddonator->donator->id }}">
                                        <td>#{{ $baddonator->donator->id }}</td>
                                        <td><span class="text-muted">{{ $baddonator->donator->name }}</span></td>
                                        <td><span class="text-muted">{{ $baddonator->donator->city }},{{ $baddonator->donator->state }}</span></td>
                                        <td><span class="text-muted">{{ $baddonator->donation->feedback->description }}</span></td>
                                        <td><span class="badge badge-rounded badge-outline-warning">{{ $baddonator->donation->ngo->name}}</span></td>
                                        @if($baddonator->donator->bfcount>2)
                                        <td><a href="#" name="block"><span class="btn btn-primary btn-sm">Block</span></a></td>
                                        @else
                                        <td><a href="#" name="warn"><span class="btn btn-primary btn-sm">Warn</span></a></td>
                                        @endif
                                    </tr>
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