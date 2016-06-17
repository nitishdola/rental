<style>
@media print {
    .header, .left-side, .content-header,#other-btn {
     display:none;
    }

    #prnt {
     display:block;
    }
}
</style>
<div id="prnt">
<div class="row">
    <ul class="timeline">
        <li>
            <div class="timeline-badge">
                <i class="livicon" data-name="users" data-c="#fff" data-hc="#fff" data-size="18" data-loop="true"></i>
            </div>
            <div class="timeline-panel" style="display:inline-block;">
                <div class="timeline-heading">
                    <h4 class="timeline-title">{{ $renterInfo->name }}</h4>
                </div>
                <div class="timeline-body">
                    <p>
                        Bills for the month of {{ date('F,Y', strtotime($monthyear)) }}
                    </p>
                </div>
            </div>
        </li>
    </ul>
</div>

<div class="row">
    @if($bill_details)
	<table class="table table-striped table-hover">
	    <thead>
	        <tr>
	            <th>Bill Type</th>
	            <th>Amount</th>
	        </tr>
	    </thead>

	    <tbody style="text-align:center">
	    	<tr>
	    		<td> Rent </td>
	    		<td> {{ number_format($bill_details->rent,2,".",",") }} </td>
	    	</tr>
            <?php $other_bill_amount = 0; ?>
	    	@foreach($other_bills as $k => $v)
	    	<tr>
	    		<td> {{ ucfirst($v->bill_type) }} </td>
	    		<td> {{ $v->bill_amount }} </td>
	    	</tr>
	    	<?php $other_bill_amount += $v->bill_amount; ?>
	    	@endforeach

	    	<tr style="font-weight:bold">
	    		<td> Total Bill </td>
	    		<td> {{ number_format($bill_details->total_payble,2,".",",") }} </td>
	    	</tr>
	    </tbody>
	</table>
</div>
</div>
<div class="portlet box danger" id="other-btn">
        <div class="portlet-body">
        		@if($bill_details->paid == 'no')
                {!! Form::open(array('route' => 'bill.pay', 'id' => 'bill_pay', 'class' => 'form-horizontal row-border')) !!}
                    {!! Form::hidden('bill_payment_id', $bill_details->id) !!}
                    {!! Form:: submit('PAY BILL', ['class' => 'btn btn-success']) !!}
                {!!form::close()!!}
                @else
                	<button class="btn btn-info disabled"> BILL PAID </button>
                @endif
        </div>
        <button class="btn btn-success" onclick="window.print()"><span class="glyphicon glyphicon-print"></span> PRINT </button>
    </div>
@else

Bill not yet generated

@endif

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