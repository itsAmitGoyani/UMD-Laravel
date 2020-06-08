@extends('admin.layouts.app')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Donation History</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="default-tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#today">Today</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#yesterday">Yesterday</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#lastweek">Last Week</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#lastmonth">Last Month</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#lastyear">Last Year</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#all">All</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="today" role="tabpanel">
                                    <div class="pt-4">
                                        <div class="table-responsive">
                                            <table id="dhtables1" class="display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>Index</th>
                                                        <th>ID</th>
                                                        <th>Donator</th>
                                                        <th>NGO</th>
                                                        <th>Pickupman</th>
                                                        <th>Verifier</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach($today as $today)
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td><span class="text-muted">#{{ $today->id }}</span></td>
                                                        <td><span class="text-muted">{{ $today->donator->name }}</span></td>
                                                        <td><span class="text-muted">{{ $today->ngo->name }}</span></td>
                                                        <td><span class="text-muted">{{ $today->pickupman->name }}</span></td>
                                                        <td><span class="text-muted">{{ $today->verifier->name ?? 'Not Verified' }}</span></td>
                                                        <td><span class="text-muted">{{ $today->datetime }}</span></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="yesterday">
                                    <div class="pt-4">
                                        <div class="table-responsive">
                                            <table id="dhtables2" class="display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>Index</th>
                                                        <th>ID</th>
                                                        <th>Donator</th>
                                                        <th>NGO</th>
                                                        <th>Pickupman</th>
                                                        <th>Verifier</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach($yesterday as $yesterday)
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td><span class="text-muted">#{{ $yesterday->id }}</span></td>
                                                        <td><span class="text-muted">{{ $yesterday->donator->name }}</span></td>
                                                        <td><span class="text-muted">{{ $yesterday->ngo->name }}</span></td>
                                                        <td><span class="text-muted">{{ $yesterday->pickupman->name }}</span></td>
                                                        <td><span class="text-muted">{{ $yesterday->verifier->name ?? 'Not Verified' }}</span></td>
                                                        <td><span class="text-muted">{{ $yesterday->datetime }}</span></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="lastweek">
                                    <div class="pt-4">
                                        <div class="table-responsive">
                                            <table id="dhtables3" class="display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>Index</th>
                                                        <th>ID</th>
                                                        <th>Donator</th>
                                                        <th>NGO</th>
                                                        <th>Pickupman</th>
                                                        <th>Verifier</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach($lastweek as $lastweek)
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td><span class="text-muted">#{{ $lastweek->id }}</span></td>
                                                        <td><span class="text-muted">{{ $lastweek->donator->name }}</span></td>
                                                        <td><span class="text-muted">{{ $lastweek->ngo->name }}</span></td>
                                                        <td><span class="text-muted">{{ $lastweek->pickupman->name }}</span></td>
                                                        <td><span class="text-muted">{{ $lastweek->verifier->name ?? 'Not Verified' }}</span></td>
                                                        <td><span class="text-muted">{{ $lastweek->datetime }}</span></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="lastmonth">
                                    <div class="pt-4">
                                        <div class="table-responsive">
                                            <table id="dhtables4" class="display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>Index</th>
                                                        <th>ID</th>
                                                        <th>Donator</th>
                                                        <th>NGO</th>
                                                        <th>Pickupman</th>
                                                        <th>Verifier</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach($lastmonth as $lastmonth)
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td><span class="text-muted">#{{ $lastmonth->id }}</span></td>
                                                        <td><span class="text-muted">{{ $lastmonth->donator->name }}</span></td>
                                                        <td><span class="text-muted">{{ $lastmonth->ngo->name }}</span></td>
                                                        <td><span class="text-muted">{{ $lastmonth->pickupman->name }}</span></td>
                                                        <td><span class="text-muted">{{ $lastmonth->verifier->name ?? 'Not Verified' }}</span></td>
                                                        <td><span class="text-muted">{{ $lastmonth->datetime }}</span></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="lastyear">
                                    <div class="pt-4">
                                        <div class="table-responsive">
                                            <table id="dhtables5" class="display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>Index</th>
                                                        <th>ID</th>
                                                        <th>Donator</th>
                                                        <th>NGO</th>
                                                        <th>Pickupman</th>
                                                        <th>Verifier</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach($lastyear as $lastyear)
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td><span class="text-muted">#{{ $lastyear->id }}</span></td>
                                                        <td><span class="text-muted">{{ $lastyear->donator->name }}</span></td>
                                                        <td><span class="text-muted">{{ $lastyear->ngo->name }}</span></td>
                                                        <td><span class="text-muted">{{ $lastyear->pickupman->name }}</span></td>
                                                        <td><span class="text-muted">{{ $lastyear->verifier->name ?? 'Not Verified' }}</span></td>
                                                        <td><span class="text-muted">{{ $lastyear->datetime }}</span></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="all">
                                    <div class="pt-4">
                                        <div class="table-responsive">
                                        <table id="dhtables6" class="display" style="min-width: 845px">
                                                <thead>
                                                    <tr>
                                                        <th>Index</th>
                                                        <th>ID</th>
                                                        <th>Donator</th>
                                                        <th>NGO</th>
                                                        <th>Pickupman</th>
                                                        <th>Verifier</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach($all as $all)
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td><span class="text-muted">#{{ $all->id }}</span></td>
                                                        <td><span class="text-muted">{{ $all->donator->name }}</span></td>
                                                        <td><span class="text-muted">{{ $all->ngo->name }}</span></td>
                                                        <td><span class="text-muted">{{ $all->pickupman->name }}</span></td>
                                                        <td><span class="text-muted">{{ $all->verifier->name ?? 'Not Verified' }}</span></td>
                                                        <td><span class="text-muted">{{ $all->datetime }}</span></td>
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
            </div>
        </div>
    </div>
</div>




@endsection