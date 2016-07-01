<style>
@media print {
    .header, .left-side, .content-header,#other-btn {
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

@extends('layouts.admin_default')
@section('title') Renters Bill @stop
@section('pageTitle')  View Renters Bill @stop
@section('content')
<div class="col-md-10 col-offset-1">
    <div class="portlet box danger">
        <div class="portlet-body">
            <div id="prnt">

                <div class="row">
                    @if($bill_details)
                    <?php $pending_bill = 0;
                    if(count($previous_bills)) {
                        foreach($previous_bills as $k2 => $v2) {
                            $pending_bill += $v2->total_payble;
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6" style="text-align: center;">
                            <h3>VAISHALI COMPLEX</h3>
                            <h5>GS Road, Paltan Bazar, Guwahati - 781008</h5>
                        </div>

                        <div class="col-md-12" style="text-align: left;">
                        <h5 style="line-height: 23px">Received with thanks from M/s {{ $renterInfo->name }} a sum of Rs. {{ number_format($bill_details->rent+$pending_bill,2,".",",") }} only in cash/cheque @if($bill_details->cheque_number != '') ( No- {{$bill_details->cheque_number}} date {{$bill_details->date }} ) @endif for the following accounts</h5>

                        <br>
                        <p style="line-height: 24px;"> Rent ( {{ date('F, Y', strtotime($bill_details->monthyear))}} ) :  &#x20b9; {{$bill_details->rent}} </p>
                        @if(count($previous_bills))
                            @foreach($previous_bills as $k2 => $v2) {
                            <p style="line-height: 24px;"> Rent( $v2->monthyear) : {{$v2->total_payble}} </p>
                            @endforeach
                        @endif

                        <div style="font-size: 24px">
                            &#x20b9; {{ number_format($bill_details->rent+$pending_bill,2,".",",") }}
                        </div>

                        <div class="col-md-6"></div>
                        <div class="col-md-5" style="text-align: center"><p> For Landlords of </p> <p><h4>VAISHALI COMPLEX</h4></p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
	
@endif
@stop

@section('pageSpecificScripts')
<script type="text/javascript">
    function PrintElem(elem)
    {
       Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Tender</title>');
        /*optional stylesheet*/ 
        mywindow.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" />');
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