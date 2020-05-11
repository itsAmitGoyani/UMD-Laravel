@extends('donator.layouts.app')
@section('content')

    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item text-center">
                            <h2>Donate</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end-->
<!-- login part -->
<!-- <section class="padding_top"> -->
    <div class="container pt-5 pb-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6">
                <!-- <h4 class="widget_title">Newsletter</h4> -->

                <form method="POST" action="{{ route('RegisterDonator') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        
                        <div class="input-group-icon mt-10">
							<div class="form-select" id="default-select_1">
                                <label><strong>NGO Branch</strong></label>
                                    <select class="form-control @error('ngo_id') is-invalid @enderror"
                                            id="ngo_id" name="ngo_id" required>
                                    <option value="">--select NGO--</option>
                                    @foreach($ngos as $ngo)
                                    <option value="{!!$ngo->id!!}">{!!$ngo->name!!}</option>
                                    @endforeach
									</select>
							</div>
                            @error('ngo_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                    <label><strong>Date</strong></label>
                        <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn_3 ">Donate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- </section> -->
<script type="text/javascript">
            $(document).ready(function() {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
            });
</script> 

@endsection