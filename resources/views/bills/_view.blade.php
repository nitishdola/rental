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
	<table class="table">
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
        
            <?php $pending_bill = 0; ?>
            @if(count($previous_bills))
            @foreach($previous_bills as $k2 => $v2)

            <?php $pending_bill += $v2->total_payble; ?>
            <tr class="warning" id="P_{{$v2->id}}">
                <td> Pending Bill {{ date('F,Y', strtotime($v2->monthyear)) }} </td>
                <td> <span id="PBA_{{$v2->id}}">{{ number_format($v2->total_payble,2,".",",") }}</span> 
                    <a href="javascript:void();" class="pending_amount" onclick="removePending({{$v2->id}});">X</a>
                </td>
            </tr>
            @endforeach
            @endif
	    	<tr style="font-weight:bold">
	    		<td> Total Bill for {{ date('F, Y', strtotime($monthyear)) }}</td>
	    		<td id="total_final_bill"> {{ number_format($bill_details->total_payble + $pending_bill ,2,".",",") }} </td>
	    	</tr>

	    </tbody>
	</table>
</div>
<div class="portlet box danger" id="other-btn">
        <div class="portlet-body">
        		@if($bill_details->paid == 'no')
                {!! Form::open(array('route' => 'bill.pay', 'id' => 'bill_pay', 'class' => 'form-horizontal row-border')) !!}
                    {!! Form::hidden('bill_payment_id[]', $bill_details->id) !!}

                    @foreach($previous_bills as $k21 => $v21)

                    {!! Form::hidden('bill_payment_id[]', $v21->id, ['id'=> 'pending_id_'.$v21->id]) !!}
                    @endforeach


                     <input type="checkbox" value="check" id="paid_cheque"> Check if paid by cheque

                     <br>
                    
                    <div id="cheque" style="display: none;">
                        <div class="form-group {{ $errors->has('cheque_number') ? 'has-error' : ''}}">
                          {!! Form::label('cheque_number', 'Cheque Number', array('class' => 'col-md-2 control-label')) !!}
                          <div class="col-md-5">
                            {!! Form::text('cheque_number', null, ['class' => 'form-control required', 'id' => 'cheque_number', 'placeholder' => 'Cheque Number (if applicable)','autocomplete' => 'off']) !!}
                          </div>
                          {!! $errors->first('cheque_number', '<span class="help-inline">:message</span>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('period_from') ? 'has-error' : ''}}">
                          {!! Form::label('cheque_date', 'Cheque Date', array('class' => 'col-md-2 control-label')) !!}
                          <div class="col-md-9">
                            {!! Form::text('cheque_date', date('Y-m-3',  strtotime("-1 month")), ['class' => 'datepicker form-control required', 'id' => 'cheque_date']) !!}
                          </div>
                          {!! $errors->first('cheque_date', '<span class="help-inline">:message</span>') !!}
                        </div>
                    </div>
                    
                    {!! Form::label('', '', array('class' => 'col-md-2 control-label')) !!}
                    {!! Form:: submit('PAY BILL', ['class' => 'btn btn-success']) !!}
                {!!form::close()!!}
                @else
                	<button class="btn btn-info disabled"> BILL PAID </button>
                @endif
        </div>
    </div>
@else

Bill not yet generated

@endif

@section('pageSpecificScripts')
<script type="text/javascript">
    function removePending(id) {
      $('#P_'+id).hide();
      $('#pending_id_'+id).attr('disabled', 'disabled');
      

      var total_final_bill = 0;
      total_final_bill = $('#total_final_bill').text();
      total_final_bill = parseInt(total_final_bill.replace(/,/g, ''), 10);

      var pending_bill_amount = 0;
      pending_bill_amount = $('#PBA_'+id).text();
      pending_bill_amount = parseInt(pending_bill_amount.replace(/,/g, ''), 10); 

      var bill_amount = 0;
      bill_amount = parseInt(total_final_bill - pending_bill_amount);
      bill_amount = bill_amount.toFixed(2);
      $('#total_final_bill').text(bill_amount);
    }


    $('#paid_cheque').click(function() {
        if ($('#paid_cheque').is(':checked')) {
        $('#cheque').fadeIn();
        }else{
            $('#cheque').fadeOut();
        }
    })
    


</script>
@stop

@section('pageCss')
<style>
.form-group input[type="checkbox"] {
    display: none;
}

.form-group input[type="checkbox"] + .btn-group > label span {
    width: 20px;
}

.form-group input[type="checkbox"] + .btn-group > label span:first-child {
    display: none;
}
.form-group input[type="checkbox"] + .btn-group > label span:last-child {
    display: inline-block;   
}

.form-group input[type="checkbox"]:checked + .btn-group > label span:first-child {
    display: inline-block;
}
.form-group input[type="checkbox"]:checked + .btn-group > label span:last-child {
    display: none;   
}
</style>
@stop