@extends('layouts.admin_default')
@section('title') Notification @stop
@section('pageTitle') Bill Notification for {{ date('F, Y') }} @stop

@section('pageCss')
<style>
@media print {
    .header,.alert_msg, .print_button, .left-side, .content-header,#other-btn {
     display:none;
    }

    #print {
     display:block;
     padding: 20px;
     font-size: 6px;
    }
    .pending_amount {
        display: none;
    }
    .paybtn {
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
            <div class="col-xs-4" style="padding:4px 0; text-align: center; border: 1px dotted #777">
            <strong>{{ $v['renter_name'] }}</strong>
            <br>
            <?php $rent_bill = 0; $elect_bill = 0;?>
            @if(isset($v['bill_info']))
                @if(isset($v['bill_info']['rent_bill']))
                    <div class="col-xs-6">
                    <h5>Rent</h5>
                    @if(isset($v['bill_info']['rent_bill']))
                    @foreach($v['bill_info']['rent_bill'] as $k1 => $v1)
                        {{ date('F', strtotime($k1)) }} {{ round($v1) }}<br>
                        <?php $rent_bill += $v1; ?>
                    @endforeach
                    @else
                    No rent bill
                    @endif
                    </div>

                    <div class="col-xs-6">
                    <h5>Electricity</h5>
                    @if(isset($v['bill_info']['electricity_bill']))
                    @foreach($v['bill_info']['electricity_bill'] as $k2 => $v2)
                        {{ $k2 }} {{ round($v2) }}<br>
                        <?php $elect_bill += $v2; ?>
                    @endforeach
                    @else
                    No electricity bill
                    @endif
                    </div>
                @endif
                <div class="col-md-12">
                <p> Total - R {{ $rent_bill }} + E {{ $elect_bill }} = Rs. <?= number_format((float)round($rent_bill+$elect_bill), 2, '.', ''); ?></p>
                <p class="paybtn"><a href="{{route('renter.view_bill', array('renter_id' => $v['renter_id'] ))}}" class="btn btn-danger">PAY</a></p>
                </div>
            @else
            * no bills found
            @endif
            </div>
        @endforeach
        
        @else
        	<div class="alert alert-success fade in">
		        <a href="#" class="close" data-dismiss="alert">&times;</a>
		        <strong>Ooops ! No bills found.</strong> 
		    </div>
        @endif
    </div>
    <button class="btn btn-success print_button" onclick="PrintElem('#print')" ><span class="glyphicon glyphicon-print"></span> PRINT </button>
    
</div>
@endsection

@section('pageSpecificScripts')
<script type="text/javascript">
    function PrintElem(elem)
    {
       Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Notification List</title>');
        /*optional stylesheet*/ 
        css_path = "{{ asset('css/bootstrap.min.css') }}";
        mywindow.document.write('<link rel="stylesheet" href="'+css_path+'" type="text/css" />');
        mywindow.document.write('<style>.paybtn {display: none;}" </style>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>
@stop

