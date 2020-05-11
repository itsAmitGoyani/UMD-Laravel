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

            <form method="POST" action="{{ route('Donate') }}">
                @csrf
                <div class="form-group">
                    <label><strong>NGO Branch</strong></label>
                    <select class="form-control @error('ngo_id') is-invalid @enderror" 
                            id="ngo_id" name="ngo_id" required>
                        <option value="">--select NGO--</option>
                        @foreach($ngos as $ngo)
                        <option value="{!!$ngo->id!!}">{!!$ngo->name!!}</option>
                        @endforeach
                    </select>
                    @error('ngo_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Date</strong></label>
                    <input type='text' class="form-control  @error('date') is-invalid @enderror" placeholder="select date" id='datepicker'>
                    @error('date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="text-center">
                    <input type="submit" class="btn_3 " value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- </section> -->
<link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet" />
<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css" rel="stylesheet" />

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">
    //  function getDisabledDates(month){
    //   if( month<0 || month>12){
    //     return [];
    //   }
    //   var disabled = [
    //     ['01/01/2017', '01/02/2017', '01/03/2017'],
    //     ['02/04/2017', '02/05/2017', '02/06/2017'],
    //     ['03/08/2017', '03/09/2017', '03/10/2017'],
    //     ['04/05/2017', '04/06/2017', '04/07/2017'],
    //     ['05/15/2017', '05/16/2017', '05/17/2017'],
    //     ['06/11/2017', '06/12/2017', '06/13/2017'],
    //     ['07/15/2017', '07/16/2017', '07/17/2017'],
    //     ['08/07/2017', '08/08/2017', '08/09/2017'],
    //     ['09/05/2017', '09/06/2017', '09/07/2017'],
    //     ['10/11/2017', '10/12/2017', '10/13/2017'],
    //     ['11/06/2017', '11/07/2017', '11/08/2017'],
    //     ['05/10/2020', '05/09/2020', '05/08/2020'],
    //   ];
    //   return disabled[month];
    //}

    $('#datepicker').datepicker({
        todayHighlight: true,
        updateViewDate: false,
        datesDisabled: ['05/10/2020', '05/09/2020', '05/08/2020']
    }).on('changeMonth', function(e) {
        //   var month = e.date.getMonth();
        //   var disabled = getDisabledDates(month);
        //   $('#datepicker').datepicker('setDatesDisabled', disabled);
    });
</script>

@endsection