@extends('ngo.layouts.app')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        @include('partial.customerror')
        @include('partial.success')
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hand In Donations</h4>
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
                                        <th>OrderID</th>
                                        <th>Donator Name</th>
                                        <th>Address</th>
                                        <th>City,State</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($donations as $donation)
                                    <tr>
                                        <td>#{{ $donation->id }}</td>
                                        <td><span class="text-muted">{{ $donation->donator->name }}</span></td>
                                        <td><span class="text-muted">{{ $donation->donator->address }}</span></td>
                                        <td><span class="text-muted">{{ $donation->donator->city }},{{ $donation->donator->state }}</span></td>
                                        <td><span class="badge badge-warning">{{ $donation->status }}</span></td>
                                        <td><a href="\ngo\manager\updatereceivedonations\{{ $donation->id }}"><span class="badge badge-primary">Received</span></a></td>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('a').click(function(event) {
            event.preventDefault();
            $.ajax({
                type: "GET",
                url: $(this).attr('href'),
                success: function(data) {
                    console.log(data);
                    $('#tablediv').load(' #tablediv');
                },
            });
        });
    });
</script>

@endsection