@extends('ngo.layouts.app')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        @include('partial.customerror')
        @include('partial.success')
        <!-- Success Alert -->
        <div class="alert alert-success alert-dismissible fade show" id="successdiv">
            <strong>Success!</strong> Donation recevied successfully.
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <!-- Error Alert -->
        <div class="alert alert-danger alert-dismissible fade show" id="errordiv">
            <strong>Error!</strong> A problem has been occurred while updating donation status.
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Picked Up Donations</h4>
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
                                        <th>Pickupman Name</th>
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
                                        <td><span class="text-muted">{{ $donation->pickupman->name }}</span></td>
                                        <td><span class="badge badge-rounded badge-outline-warning">{{ $donation->status }}</span></td>
                                        <td><a href="\ngo\manager\updatepickedupdonations\{{ $donation->id }}" name="receivedbtn"><span class="btn btn-primary btn-sm">Received</span></a></td>
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
        $('#successdiv').hide();
        $('#errordiv').hide();
        $('a[name="receivedbtn"]').click(function(event) {
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
                        //$('#tbdiv').load("pendingdonations #tbdiv");
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