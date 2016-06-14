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
	    		<td> {{ number_format($unit_rent,2,".",",") }} </td>
	    	</tr>
	    	<?php $other_bill_amount = $unit_rent; ?>
	    	@foreach($result as $k => $v)
	    	<tr>
	    		<td> {{ ucfirst($v->bill_type) }} </td>
	    		<td> {{ $v->bill_amount }} </td>
	    	</tr>
	    	<?php $other_bill_amount += $v->bill_amount; ?>
	    	@endforeach

	    	<tr style="font-weight:bold">
	    		<td> Total Bill </td>
	    		<td> {{ number_format($other_bill_amount,2,".",",") }} </td>
	    	</tr>
	    </tbody>
	</table>
</div>

<div class="portlet box danger">
        <div class="portlet-body">
        		@if(!$check_paid)
                {!! Form::open(array('route' => 'bill.pay', 'id' => 'bill_pay', 'class' => 'form-horizontal row-border')) !!}
                    {!! Form::hidden('rent', $unit_rent) !!}
                    {!! Form::hidden('renter_id', $renterInfo->id) !!}
                    {!! Form::hidden('total_payble', $unit_rent+$other_bill_amount) !!}
                    {!! Form::hidden('monthyear', $monthyear) !!}
                    {!! Form:: submit('PAY BILL', ['class' => 'btn btn-success']) !!}
                {!!form::close()!!}
                @else
                	<button class="btn btn-info disabled"> BILL PAID </button>
                @endif
        </div>
    </div>