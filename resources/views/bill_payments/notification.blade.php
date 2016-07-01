@extends('layouts.admin_default')
@section('title') Notification @stop
@section('pageTitle') Bill Notification for {{ date('F, Y') }} @stop

@section('pageCss')
<style>
@media print {
    .header,.alert_msg, .print_button, .left-side, .content-header,#other-btn {
     display:none;
    }

    #prnt {
     display:block;
    }
    .pending_amount {
        display: none;
    }
}
</style>
@stop

@section('content')
<div class="panel panel-primary">
    <div class="panel-body" id="print">
    	@if(count($bill))
        @foreach($bill as $k => $v)
            <div class="col-md-3" style="padding:4px 0; text-align: center; border: 1px dotted #777">
            <strong>{{ $v['renter_name'] }}</strong>
            <br>
            <?php $rent_bill = 0; $elect_bill = 0;?>
            @foreach($v['bill_info'] as $k1 => $v1)
            <?php $rent_bill += $v1['rent_bill']; ?>
            <?php $elect_bill += $v1['electricity_bill'] ; ?>
            @endforeach
            R - {{ number_format($rent_bill,2,".",",") }} E - {{ number_format($elect_bill,2,".",",") }} <h6>Total {{ number_format($rent_bill+$elect_bill,2,".",",")}}</h6>
            </div>
        @endforeach
        <div class="col-md-12" style="margin-top:20px">
        <button class="btn btn-success print_button" onclick="window.print()"><span class="glyphicon glyphicon-print"></span> PRINT </button>
        </div>
        @else
        	<div class="alert alert-success fade in">
		        <a href="#" class="close" data-dismiss="alert">&times;</a>
		        <strong>Ooops ! No bills found.</strong> 
		    </div>
        @endif
    </div>
</div>
@endsection

