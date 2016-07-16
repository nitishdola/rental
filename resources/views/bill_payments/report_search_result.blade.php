@extends('layouts.admin_default')
@section('title') Bill Report @stop
@section('pageTitle')  Bill Report @stop

@section('content')
<div class="panel panel-primary">
    <div class="panel-body">

    {!! Form::open(array('method' => 'get', 'route' => 'bill.report_search_result', 'id' => 'bill_search', 'class' => 'form-horizontal row-border')) !!}
        @include('bill_payments._report_search')
        {!! Form:: submit('Search', ['class' => 'btn btn-success']) !!}
    {!!form::close()!!}

    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-body">
    <h3> Rent Bill </h3>
    	@if(count($results))
        <?php $count = 1; ?>
		<table class="table table-striped table-bordered table-advance table-hover">
		    <thead>
		        <tr>
		            <th>
		                #
		            </th>
		            <th class="hidden-xs">
		                Renter Name
		            </th>
		            <th>
		                Phone Number
		            </th>

		            <th>
		                Month
		            </th>
		            <th>
		                Payment Status/Amount Paid
		            </th>
		        </tr>
		    </thead>
		    <tbody>
		    	<?php $paid = 0; $unpaid = 0; ?>
		        @foreach($results as $k => $v)
		        
		        

		        <tr @if($v->paid == 'no') class="danger" @endif>

			        @if($v->paid == 'no')
			        	<?php $unpaid += $v->total_payble; ?>
			        @endif

			        @if($v->paid == 'yes')
			        	<?php $paid += $v->total_payble; ?>
			        @endif


		            <td> {{ (($results->currentPage() - 1 ) * $results->perPage() ) + $count + $k }} </td>
		            <td class="hidden-xs"> {{ $v->renter['name'] }} </td>
		            <td> {{ $v->renter['phone_number'] }} </td>
		            <td> {{ date('F,Y', strtotime($v->monthyear)) }} </td>
		            <td> {{ strtoupper($v->paid) }} , @if($v->paid == 'no') Pending Amount : {{ $v->total_payble }} @endif  @if($v->paid == 'yes')  Paid on {{$v->pay_date}} @endif </td>
		        </tr>
		        @endforeach
		    </tbody>
		</table>

		<div>
			<b> Total Un-Paid : {{ number_format($unpaid,2,".",",") }}</b>
			<br> <b> Total Paid : {{ number_format($paid,2,".",",") }}</b>
		</div>

		<div class="pagination">
		{!! $results->render() !!}
		</div>

		@else
			No Rent Bill Found !
		@endif
    </div>



    <div class="panel-body">
    <h3> Electricity Bill </h3>
    	@if(count($bill_results))
        <?php $count = 1; ?>
		<table class="table table-striped table-bordered table-advance table-hover">
		    <thead>
		        <tr>
		            <th>
		                #
		            </th>
		            <th class="hidden-xs">
		                Renter Name
		            </th>
		            <th>
		                Phone Number
		            </th>

		            <th>
		                Month
		            </th>
		            <th>
		                Payment Status/Amount Paid
		            </th>
		        </tr>
		    </thead>
		    <tbody>
		    	<?php $epaid = 0; $eunpaid = 0; ?>
		        @foreach($bill_results as $k1 => $v1)
		        
		        <tr @if($v1->paid == 'unpaid') class="danger" @endif>

			        @if($v1->paid == 'unpaid')
			        	<?php $eunpaid += $v1->bill_amount; ?>
			        @endif

			        @if($v1->paid == 'paid')
			        	<?php $epaid += $v1->bill_amount; ?>
			        @endif


		            <td> {{ (($bill_results->currentPage() - 1 ) * $bill_results->perPage() ) + $count + $k }} </td>
		            <td class="hidden-xs"> {{ $v1->renter['name'] }} </td>
		            <td> {{ $v1->renter['phone_number'] }} </td>
		            <td> {{ date('d-m-Y', strtotime($v1->period_from)) }} To {{ date('d-m-Y', strtotime($v1->period_to)) }} </td>
		            <td> {{ strtoupper($v1->paid) }} , Pending Amount : {{ $v1->bill_amount }}   @if($v->paid == 'yes') / {{ $v->bill_amount }} @endif </td>
		        </tr>
		        @endforeach
		    </tbody>
		</table>

		<div>
			<b> Total Un-Paid : {{ number_format($eunpaid,2,".",",") }}</b>
			<br> <b> Total Paid : {{ number_format($epaid,2,".",",") }}</b>
		</div>

		<div class="pagination">
		{!! $bill_results->render() !!}
		</div>

		@else
			No Electricity Bill Found !
		@endif

    </div>
</div>
@endsection


@section('pageSpecificScripts')
<script>
$('.monthpicker').datepicker({
    format: 'mm-yyyy'
});

$('.select2').select2();
</script>
@stop