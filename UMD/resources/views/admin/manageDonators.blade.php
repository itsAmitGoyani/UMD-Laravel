@extends('admin.layouts.app')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        @include('partial.customerror')
        @include('partial.success')

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Block/Warn Donators</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Donators received Bad feedback</h4>
                    </div>
                    <div class="card-body" id="tablediv">
                        <div class="table-responsive">
                            <table class="table header-border table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>Donator ID</th>
                                        <th>Donator Name</th>
                                        <th>City,State</th>
                                        <th>Feedback Description</th>
                                        <th>NGO</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($records as $record)
                                    <tr id="tr{{ $record->donator_id }}">
                                        <td>#{{ $record->donator_id }}</td>
                                        <td><span class="text-muted">{{ $record->donator->name }}</span></td>
                                        <td><span class="text-muted">{{ $record->donator->city }},{{ $record->donator->state }}</span></td>
                                        <td><span class="text-muted">{{ $record->donation->feedback->description }}</span></td>
                                        <td><span class="text-muted">{{ $record->donation->ngo->name}}</span></td>
                                        @if($record->donator->bfcount>2)
                                        <td><a href="/admin/blockdonator/{{$record->donator_id}}" name="block"><span class="btn btn-danger btn-sm">Block</span></a></td>
                                        @else
                                        <td><a href="/admin/warndonator/{{$record->donator_id}}" name="warn"><span class="btn btn-warning btn-sm">Warn</span></a></td>
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