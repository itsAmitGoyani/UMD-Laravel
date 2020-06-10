@extends('admin.layouts.app')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        @include('partial.customerror')
        @include('partial.success')

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Messages</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Donators Messages</h4>
                    </div>
                    <div class="card-body" id="tablediv">
                        <div class="table-responsive">
                            <table class="table header-border table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $messages)
                                    <tr id="tr{{ $messages->id }}">
                                        <td>#{{ $messages->id }}</td>
                                        <td><span class="text-muted">{{ $messages->name }}</span></td>
                                        <td><span class="text-muted">{{ $messages->email }}</span></td>
                                        <td><span class="text-muted">{{ $messages->subject }}</span></td>
                                        <td><span class="text-muted">{{ $messages->message}}</span></td>
                                        <td><a href="/admin/messages/{{$messages->id}}" name="done"><span class="btn btn-primary btn-sm">Done</span></a></td>
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