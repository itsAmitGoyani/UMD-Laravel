@extends('ngo.layouts.app')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        @include('partial.customerror')
        @include('partial.success')
        <!-- Success Alert -->
        <div class="alert alert-success alert-dismissible fade show" id="successdiv">
            <strong>Success!</strong> Order Handed In successfully.
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <!-- Error Alert -->
        <div class="alert alert-danger alert-dismissible fade show" id="errordiv">
            <strong>Error!</strong> A problem has been occurred while handing in order.
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Pending Donations</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Today</h4>
                    </div>
                    <div class="card-body" id="tbdiv">
                        <div class="table-responsive">
                            <table class="table header-border table-responsive-sm" id="tbdonation">
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
                                    <tr id="tr{{ $donation->id }}">
                                        <td>#{{ $donation->id }}</td>
                                        <td><span class="text-muted">{{ $donation->donator->name }}</span></td>
                                        <td><span class="text-muted">{{ $donation->donator->address }}</span></td>
                                        <td><span class="text-muted">{{ $donation->donator->city }},{{ $donation->donator->state }}</span></td>
                                        <td><span class="badge badge-rounded badge-outline-warning">{{ $donation->status }}</span></td>
                                        <td><a href="\ngo\pickupman\updatependingdonation\{{ $donation->id }}" name="handinbtn"><span class="btn btn-primary btn-sm">Take</span></a></td>
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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#successdiv').hide();
        $('#errordiv').hide();
        $('a[name="handinbtn"]').click(function(event) {
            event.preventDefault();
            var trid = $(this).parent('td').parent('tr').attr("id");
            $.ajax({
                type: "GET",
                url: $(this).attr('href'),
                success: function(data) {
                    console.log(data);
                    if (data["msg"] == "Yes") {
                        $('#successdiv').show();
                        $('#' + trid).remove();
                     
                    } else {
                        $('#errordiv').show();
                    }

                },
                error: function(error) {
                    console.log(error);
                    $('#errordiv').show();
                }
            });
        });

    });
</script>

@endsection