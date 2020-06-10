@extends('ngo.layouts.app')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Pending Donations</div>
                            <div class="stat-digit">{{$tpd}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Pending to Verify</div>
                            <div class="stat-digit">{{$pvd}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Yesterday's Donations</div>
                            <div class="stat-digit">{{$yd}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Donations</div>
                            <div class="stat-digit">{{$td}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Todo</h4>
                    </div>
                    <div class="card-body px-0">
                        <div class="todo-list">
                            <div class="tdl-holder">
                                <div class="tdl-content widget-todo mr-4">
                                    <ul id="todo_list">
                                        <li><label><input type="checkbox"><i></i><span>View Pickedup Donations</span><a href='#' class="ti-trash"></a></label></li>
                                        <li><label><input type="checkbox"><i></i><span>View Donation History</span><a href='#' class="ti-trash"></a></label></li>
                                    </ul>
                                </div>
                                <div class="px-4">
                                    <input type="text" class="tdl-new form-control" placeholder="Write new item and hit 'Enter'...">
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